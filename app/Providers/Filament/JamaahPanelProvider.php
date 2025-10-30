<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Althinect\FilamentSpatieRolesPermissions\Middleware\SyncSpatiePermissionsWithFilamentTenants;
use App\Filament\Jamaah\Pages\Dashboard;
use App\Filament\Jamaah\Pages\JamaahProfile;
use App\Filament\Jamaah\Pages\JamaahRegistration;
use App\Http\Middleware\UserMiddleware;
use App\Models\Jamaah;
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

class JamaahPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('jamaah')
            ->path('jamaah')
            ->login()
            ->colors([
                'primary' => Color::Green,
            ])

            // Tenant Configs
            ->tenant(Jamaah::class)
            ->tenantRegistration(JamaahRegistration::class)
            ->tenantProfile(JamaahProfile::class)

            // Discoveries
            ->discoverClusters(in: app_path('Filament/Jamaah/clusters'), for: 'App\\Filament\\Jamaah\\Clusters')
            ->discoverResources(in: app_path('Filament/Jamaah/Resources'), for: 'App\\Filament\\Jamaah\\Resources')
            ->discoverPages(in: app_path('Filament/Jamaah/Pages'), for: 'App\\Filament\\Jamaah\\Pages')
            ->discoverWidgets(in: app_path('Filament/Jamaah/Widgets'), for: 'App\\Filament\\Jamaah\\Widgets')
            ->pages([
                Dashboard::class,
            ])

            // Plugins
            ->plugin(FilamentSocialitePlugin::make()->providers([
                Provider::make("google")
                    ->label("google")
            ])->slug('jamaah')->registration(true))


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
                // UserMiddleware::class
            ])
            ->tenantMiddleware([
                SyncSpatiePermissionsWithFilamentTenants::class,
            ], isPersistent: true)
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
