<?php

namespace App\Filament\Pages;

use App\Enums\GuildAttribution;
use Filament\Pages\Page;

class DragonsContribution extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dragons-contribution';

    protected static ?string $navigationGroup = 'Contribution';

    public static function getNavigationLabel(): string
    {
        return 'Dragons';
    }

    public static function getNavigationIcon(): ?string
    {
        return GuildAttribution::Dragons->getIcon();
    }

    // FOR CUSTOM PAGES IMPORTING RESOURCES IMPORT THE LIST NOT THE RESOURCE ITSELF
    public function getLivewireComponents(): array
    {
        return [
            'listDragonContributions' => \App\Filament\Resources\DragonsListResource\Pages\ListDragonsLists::class,
        ];
    }
}
