<div class="grid grid-cols-1 gap-4">
    @foreach ($stats as $stat)
        <div class="rounded-xl shadow p-4 border-l-4 border-{{ $stat['color'] }}-600" style="background-color: #18181B;">
            <div class="text-sm font-semibold mb-2" style="color: #44DE75">{{ $stat['label'] }}</div>
            <div class="text-2xl font-bold mb-2 text-green-600">{{ $stat['value'] }}</div>
            @if (!empty($stat['description']))
                <div class="mt-1 flex items-center text-sm text-gray-600">
                    @if (!empty($stat['descriptionIcon']))
                        <x-dynamic-component :component="$stat['descriptionIcon']" class="w-8 h-8 mr-1 text-{{ $stat['color'] }}-600" />
                    @endif
                    {{ $stat['description'] }}
                </div>
            @endif
        </div>
    @endforeach
</div>
