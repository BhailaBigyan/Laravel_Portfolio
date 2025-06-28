@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <form action="{{ route('template.push.username') }}" method="GET">
        <input type="hidden" name="template_id" value="{{ $template_id }}">

        <label for="username" class="block font-medium text-gray-700 mb-2">Your GitHub Username</label>
        <input type="text" name="username" id="username" required
            class="w-full border px-3 py-2 rounded mb-4 focus:outline-none focus:ring">

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Push to GitHub</button>
    </form>
</div>
@endsection
