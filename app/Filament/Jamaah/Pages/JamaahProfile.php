<?php

namespace App\Filament\Jamaah\Pages;

use Filament\Schemas\Schema;
use App\Models\Jamaah;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile;

class JamaahProfile extends EditTenantProfile
{
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    public static function getLabel(): string
    {
        return __("common.jamaah_profile");
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('website')
                    ->suffix('.jamaah.com')
                    ->prefixIcon('heroicon-m-globe-alt')
                    ->required()
                    ->alphaDash()
                    ->unique(table: Jamaah::class, column: "website"),
            ]);
    }
}
