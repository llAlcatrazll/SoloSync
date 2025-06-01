<?php

namespace App\Filament\Resources\DragonsListResource\Pages;

use App\Filament\Resources\DragonsListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Facades\FilamentView;
// use Filament\Support\Facades\FilamentView;
// use Filament\Tables\View\TablesRenderHook;
use Filament\Tables\View\TablesRenderHook;
use Illuminate\Support\Facades\Blade;

class ListDragonsLists extends ListRecords
{
    protected static string $resource = DragonsListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return false;
    }

    // public function mount(): void
    // {
    //     parent::mount();

    //     FilamentView::registerRenderHook(
    //         TablesRenderHook::TOOLBAR_TOGGLE_COLUMN_TRIGGER_AFTER,
    //         fn (): string => '<button>Test Button</button>'
    //     );
    // }

    public function boot(): void
    {
        FilamentView::registerRenderHook(
            TablesRenderHook::TOOLBAR_REORDER_TRIGGER_AFTER,
            fn (): string => Blade::render('@livewire("log-dragons")'),
        );
    }
}
