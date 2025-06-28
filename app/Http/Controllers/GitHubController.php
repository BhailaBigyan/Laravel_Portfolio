<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Template;
use App\Models\user_github_repos;
use App\Models\UserGitHubRepo;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;

class GitHubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')
            ->with(['scope' => 'repo'])
            ->redirect();
    }

    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();
        session(['github_token' => $githubUser->token]);
        return redirect('/');
    }

    public function pushFromTemplate($id)
    {
        $token = session('github_token');
        if (!$token) {
            return redirect('/github/redirect');
        }

        $template = Template::findOrFail($id);
        $sourceRepo = $template->repo_url;

        $userResponse = Http::withToken($token)->get('https://api.github.com/user');
        if (!$userResponse->successful()) {
            return response()->json(['error' => 'Failed to fetch user info'], 401);
        }
        $username = auth()->user()->username;

        $newRepoName = strtolower(str_replace(' ', '-', $template->title)) . '-' . uniqid();
        $createRepo = Http::withToken($token)->post('https://api.github.com/user/repos', [
            'name' => $newRepoName,
            'description' => 'Imported from ThemeNest',
            'private' => false,
        ]);

        if (!$createRepo->successful()) {
            return response()->json(['error' => 'Failed to create repo', 'details' => $createRepo->json()], 500);
        }

        $tempDir = storage_path('app/temp/' . $newRepoName);
        if (file_exists($tempDir)) {
            exec("rm -rf " . escapeshellarg($tempDir));
        }
        mkdir($tempDir, 0755, true);

        $authenticatedSourceRepo = preg_replace(
            '/^https:\/\/github\.com\//',
            "https://$username:$token@github.com/",
            $sourceRepo
        );
        exec("git clone " . escapeshellarg($authenticatedSourceRepo) . ' ' . escapeshellarg($tempDir) . " 2>&1", $cloneOutput, $cloneStatus);

        if ($cloneStatus !== 0) {
            return response()->json(['error' => 'Failed to clone source repo', 'output' => $cloneOutput]);
        }

        chdir($tempDir);

        exec("git branch --show-current", $branchOutput);
        $branch = trim($branchOutput[0] ?? 'main');

        exec("git remote remove origin");
        $remoteUrl = "https://$username:$token@github.com/$username/$newRepoName.git";
        exec("git remote add origin " . escapeshellarg($remoteUrl));

        exec("git rev-parse --verify HEAD 2>/dev/null", $headCheckOutput, $headStatus);
        if ($headStatus !== 0) {
            exec("git config user.name 'ThemeNest Bot'");
            exec("git config user.email 'bot@themenest.com'");
            exec("git add .");
            exec("git commit -m 'Initial commit from ThemeNest'");
        }

        exec("git push -u origin " . escapeshellarg($branch) . " 2>&1", $pushOutput, $pushStatus);
        if ($pushStatus !== 0) {
            return response()->json([
                'error' => 'Failed to push to new repo',
                'output' => $pushOutput
            ]);
        }

        exec("git push --tags");

        user_github_repos::create([
            'user_id' => auth()->id(),
            'template_id' => $template->id,
            'github_username' => $username,
            'repo_url' => "https://github.com/$username/$newRepoName",
        ]);

        exec("rm -rf " . escapeshellarg($tempDir));

        $template->repo_url = "https://github.com/$username/$newRepoName";
        $template->save();

        return redirect('/')->with('success', 'Template successfully pushed to your GitHub!');
    }
}
