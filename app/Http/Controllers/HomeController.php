<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Template::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }
        $templates = Template::orderBy('created_at', 'desc')->paginate(9);


        return view('index', compact('templates'));
    }
}
