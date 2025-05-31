<?php

namespace App\Filament\Resources\GunheeResource\Pages;

use App\Enums\GuildAttribution;
use App\Filament\Resources\GunheeResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListGunhees extends ListRecords
{
    protected static string $resource = GunheeResource::class;

    protected $listeners = ['newmemberAdded' => '$refresh'];

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            Tab::make('All Guilds')
                ->badgeColor('Success'),
            Tab::make('Gunhee')
                ->badgeColor('Gunhee')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::Gunhee)),
            Tab::make('GunheeAlt')
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::GunheeAlt)),
            Tab::make('Dragons')
                ->badgeColor('Dragons')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::Dragons)),
            Tab::make('GunheeMini')
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::GunheeMini)),
            Tab::make('SoloXSlayer')
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::SoloXSlayer)),
            Tab::make('Superb')
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::Superb)),
            Tab::make('RNG')
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('guild_attribution', GuildAttribution::RNG)),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            GunheeResource\Widgets\AddNewMember::class,
        ];
    }

    public function getTitle(): string
    {
        return false;
    }
}
