<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
class TemplateController extends Controller
{
    public function show($id)
{
    $template = Template::with('creator')->findOrFail($id);
    return view('components/template_profile', compact('template'));
}

}
