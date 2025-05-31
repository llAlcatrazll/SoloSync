<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

// https://filamentexamples.com/tutorial/render-hooks-cheat-sheet
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
        // FilamentView::registerRenderHook(
        //     PanelsRenderHook::SIDEBAR_NAV_START,
        //     fn (): View => view('components.sidebar-heading', [
        //         'title' => $this->getPageTitle(),
        //         'breadcrumbs' => $this->getPageBreadcrumbs(),
        //     ])
        // );
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
