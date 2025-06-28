<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
    @forelse ($templates as $template)
        <div class="border rounded-xl shadow-md p-4 hover:shadow-lg transition duration-200 bg-white">
            <!-- Make the whole card clickable -->
            <a href="{{ route('template.show', $template->id) }}" class="block">
                <!-- Thumbnail -->
                <img src="{{ asset('storage/' . $template->thumbnail) }}"
                    alt="{{ $template->title }}"
                    class="rounded-lg mb-4 h-48 w-full object-cover">

                <!-- Title -->
                <h2 class="text-lg font-semibold text-gray-800 mb-1 line-clamp-1">
                    {{ $template->title }}
                </h2>

                <!-- Description -->
                <p class="text-sm text-gray-600 line-clamp-2">
                    {{ Str::limit($template->description, 100) }}
                </p>

                <!-- Stats -->
                <div class="mt-4 flex justify-between items-center text-xs text-gray-500">
                    <span>⭐ {{ $template->star_count }}</span>
                    <span>⬇ {{ $template->download_count }}</span>
                </div>
            </a>

            <!-- External Actions -->
            <div class="mt-4 flex flex-col gap-2">
                @if ($template->preview_url)
                    <a href="{{ $template->preview_url }}" target="_blank"
                        class="text-blue-600 hover:underline text-sm">
                        🔗 Live Preview
                    </a>
                @endif

                <a href="{{ url('/template/' . $template->id . '/push-to-github') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium text-center px-4 py-2 rounded transition">
                    Push to My GitHub
                </a>
            </div>
        </div>
    @empty
        <p class="text-center col-span-full text-gray-600">No templates found.</p>
    @endforelse
</div>

<!-- Pagination (place it outside the loop) -->
<div class="mt-6">
    {{ $templates->links() }}
</div>
