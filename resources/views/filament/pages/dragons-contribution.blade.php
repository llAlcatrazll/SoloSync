<x-filament-panels::page>
    <div class="flex gap-4">
        {{-- Main Content --}}
        <div class="w-full">
            @livewire(\App\Filament\Resources\DragonsListResource\Pages\ListDragonsLists::class)
        </div>

        {{-- Right Sidebar --}}
        <div class="">
            <div class="flex gap-2 p-2" style="padding:10px; gap:5px; "> @livewire('widgets.dragons-count-widget')
                @livewire('widgets.dragons-count-widget')</div>
            <div class="flex gap-2 p-2"> @livewire('widgets.dragons-count-widget')
                @livewire('widgets.dragons-count-widget')</div>
        </div>
    </div>
</x-filament-panels::page>
