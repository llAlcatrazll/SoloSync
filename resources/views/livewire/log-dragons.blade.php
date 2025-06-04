<div>
    <x-filament::button wire:click="openForm">
        Log Dragons Contribution
    </x-filament::button>
    @if ($showForm)
        <div x-data="{ show: @entangle('showForm') }" x-show="show" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-xl w-full max-w-md" @click.away="show = false">
                <form wire:submit="create" class="space-y-4">
                    {{ $this->form }}
                    <x-filament::button color="gray" type="button"
                        x-on:click="show = false">Cancel</x-filament::button>
                    <x-filament::button type="submit">Submit</x-filament::button>
                </form>
                <x-filament-actions::modals />
            </div>
        </div>
    @endif
</div>

{{-- <div>
    <x-filament::button wire:click="openForm">
        Log Dragons Contribution
    </x-filament::button>

    @if ($showForm)
        <div x-data="{ show: @entangle('showForm') }" x-show="show" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-xl w-full max-w-md" @click.away="show = false">
                <h2 class="text-lg font-bold mb-4">Submit Feedback</h2>

                <form wire:submit.prevent="submit" class="space-y-4">
                    <label for="title">Week Count</label>
                    <x-filament::input.wrapper>

                        <x-filament::input type="text" wire:model="name" placeholder="1" />
                    </x-filament::input.wrapper>
                    <label for="title">Contribution</label>
                    <x-filament::input.wrapper>

                        <x-filament::input type="text" wire:model="name" placeholder="2250" />
                    </x-filament::input.wrapper>
                    <label for="title">Rage Count</label>
                    <x-filament::input.wrapper>

                        <x-filament::input type="text" wire:model="name" placeholder="50" />
                    </x-filament::input.wrapper>
                    <x-filament::button color="gray" type="button"
                        x-on:click="show = false">Cancel</x-filament::button>
                    <x-filament::button type="submit">Submit</x-filament::button>
                </form>
            </div>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div> --}}
