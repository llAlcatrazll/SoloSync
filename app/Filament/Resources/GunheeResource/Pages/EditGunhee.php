<?php

namespace App\Filament\Resources\GunheeResource\Pages;

use App\Filament\Resources\GunheeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGunhee extends EditRecord
{
    protected static string $resource = GunheeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
