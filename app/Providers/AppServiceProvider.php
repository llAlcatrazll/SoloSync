<?php

namespace App\Providers;

use App\Filament\Resources\DragonsListResource\Pages\ListDragonsLists;
use Filament\Facades\Filament;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\Table;
// use Filament\Tables\Table;
use Filament\Tables\Tables;
use Filament\Tables\View\TablesRenderHook;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

// https://filamentexamples.com/tutorial/render-hooks-cheat-sheet
// https://filamentphp.com/api/3.x/Filament/Tables/Table.html
// MORE DETAILED DOCUMENTATION OF FILAMENT
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register my custom guild colors
        FilamentColor::register([
            'Gunhee' => Color::hex('#FFDC67'),
            'Gunheealt' => Color::hex('#FF9030'),
            'Dragons' => Color::hex('#F85130'),
            'GunheeMini' => Color::hex('#F6FF00'),
            'SoloXSlayer' => Color::hex('#65E3BB'),
            'Superb' => Color::hex('#50CAFF'),
            'RNG' => Color::hex('#6BFF7C'),
        ]);
        FilamentView::registerRenderHook(
            PanelsRenderHook::SIDEBAR_FOOTER,
            fn (): View => view('footer'),
        );
        FilamentView::registerRenderHook(
            TablesRenderHook::TOOLBAR_TOGGLE_COLUMN_TRIGGER_BEFORE,
            // fn (): string => '<button type="button">My Hook Button</button>'
            fn (): string => Blade::render('@livewire("log-dragons")'),
            // scopes: ListDragonsLists::class
        );
    }

    protected function getPageTitle(): string
    {
        return ucfirst(last(explode('/', request()->path()))) ?? 'Dashboard';
    }

    protected function getPageBreadcrumbs(): array
    {
        $segments = explode('/', request()->path());
        $accumulatedPath = '';
        $breadcrumbs = [];

        foreach ($segments as $segment) {
            $accumulatedPath .= '/'.$segment;
            $breadcrumbs[] = [
                'label' => ucfirst($segment),
                'url' => url($accumulatedPath),
            ];
        }

        return $breadcrumbs;
    }
}
