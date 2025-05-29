<?php

namespace App\Filament\Resources\GunheeResource\Pages;

use App\Filament\Resources\GunheeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGunhees extends ListRecords
{
    protected static string $resource = GunheeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
