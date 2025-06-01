<div>
    <x-filament::button wire:click="openForm">
        Leave Feedback
    </x-filament::button>

    @if ($showForm)
        <div x-data="{ show: @entangle('showForm') }" x-show="show" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl w-full max-w-md" @click.away="show = false">
                <h2 class="text-lg font-bold mb-4">Submit Feedback</h2>

                <form wire:submit.prevent="submit" class="space-y-4">
                    <x-filament::input label="Your Message" wire:model.defer="message" name="message" type="text" />
                    <div class="flex justify-end space-x-2">
                        <x-filament::button color="gray" type="button"
                            x-on:click="show = false">Cancel</x-filament::button>
                        <x-filament::button type="submit">Submit</x-filament::button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>
