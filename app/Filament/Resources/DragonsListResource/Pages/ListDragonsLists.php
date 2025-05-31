<?php

namespace App\Filament\Resources\DragonsListResource\Pages;

use App\Filament\Resources\DragonsListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

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
}
