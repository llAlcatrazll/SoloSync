<?php

namespace App\Filament\Resources\DragonsListResource\Pages;

use App\Filament\Resources\DragonsListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDragonsList extends EditRecord
{
    protected static string $resource = DragonsListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
