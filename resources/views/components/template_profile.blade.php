<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $template->title }} - Template Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-gray-900">



    <!-- Main Content -->
    <main class="max-w-6xl mx-auto p-6">
        <div class="grid md:grid-cols-2 gap-10">
            <!-- Thumbnail Preview -->
            <div>
                <img src="{{ asset('storage/' . $template->thumbnail) }}"
                    alt="{{ $template->title }} Preview"
                    class="rounded-lg shadow w-full object-cover max-h-[400px]">
            </div>

            <!-- Template Details -->
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $template->title }}</h1>
                <p class="text-gray-600 mb-4">{{ $template->description }}</p>

                <!-- Tags -->
                <div class="mb-4">
                    <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 text-xs font-semibold rounded-full">
                        #{{ $template->type }}
                    </span>
                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 text-xs font-semibold rounded-full">
                        ⭐ {{ $template->star_count }}
                    </span>
                    <span class="inline-block bg-green-100 text-green-700 px-3 py-1 text-xs font-semibold rounded-full">
                        ⬇️ {{ $template->download_count }}
                    </span>
                </div>

                <!-- Author Info -->
                <div class="mb-6 text-sm text-gray-500">
                    Uploaded by
                    <span class="text-gray-800 font-medium">
                        {{ $template->creator->name ?? 'Unknown' }}
                    </span>
                    · {{ $template->updated_at->format('F d, Y') }}
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap gap-4">
                    @if ($template->preview_url)
                    <a href="{{ $template->preview_url }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded"
                        target="_blank" rel="noopener noreferrer">
                        Live Preview
                    </a>
                    @endif

                    @if ($template->repo_url)
                    <a href="{{ $template->repo_url }}"
                        class="bg-gray-800 hover:bg-gray-900 text-white font-semibold px-6 py-2 rounded"
                        target="_blank" rel="noopener noreferrer">
                        GitHub Repo
                    </a>
                    @endif

                    <form action="{{ route('home', $template->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
                            Download
                        </button>
                    </form>
                    <a href="{{ url('/template/' . $template->id . '/push-to-github') }}"
                        class="bg-gray-800 hover:bg-gray-900 text-white font-semibold px-6 py-2 rounded">
                        Push to My GitHub
                    </a>
                </div>
            </div>
        </div>

        <!-- Optional Content Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-3">Template Content</h2>
            <div class="bg-gray-50 border rounded p-4 text-sm leading-relaxed whitespace-pre-wrap">
                {{ $template->content }}
            </div>
        </div>
    </main>
</body>

</html>