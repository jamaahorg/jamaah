<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Althinect\FilamentSpatieRolesPermissions\Middleware\SyncSpatiePermissionsWithFilamentTenants;
use App\Filament\Superman\Pages\Dashboard;
use App\Http\Middleware\SupermanMiddleware;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use DutchCodingCompany\FilamentSocialite\Provider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SupermanPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('superman')
            ->path('superman')
            ->login()
            ->colors([
                'primary' => Color::Orange,
            ])

            // Discoveries
            ->discoverClusters(in: app_path('Filament/Superman/clusters'), for: 'App\\Filament\\Superman\\Clusters')
            ->discoverWidgets(in: app_path('Filament/Superman/Widgets'), for: 'App\\Filament\\Superman\\Widgets')
            ->discoverResources(in: app_path('Filament/Superman/Resources'), for: 'App\\Filament\\Superman\\Resources')
            ->discoverPages(in: app_path('Filament/Superman/Pages'), for: 'App\\Filament\\Superman\\Pages')
            ->pages([
                Dashboard::class,
            ])

            // Plugins
            ->plugin(FilamentSocialitePlugin::make()
                ->providers([
                    Provider::make("google")
                        ->label("google")
                ])
                ->slug('superman'))
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())

            // Middlewares
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                // SupermanMiddleware::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
