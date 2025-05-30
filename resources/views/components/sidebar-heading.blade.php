<div class="px-4 py-3">
    <h2 class="text-lg font-bold text-white">{{ $title }}</h2>
    <ul class="text-sm text-gray-400 space-y-1 mt-2">
        @foreach ($breadcrumbs as $crumb)
            <li>
                <a href="{{ $crumb['url'] }}" class="hover:text-white">
                    {{ $crumb['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
