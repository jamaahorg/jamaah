<?php

namespace App\Filament\Jamaah\Pages;

use Filament\Schemas\Schema;
use App\Models\Jamaah;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JamaahRegistration extends RegisterTenant
{
    public static function getLabel(): string
    {
        return __("common.register_jamaah");
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('website')
                    ->suffix('.jamaah.com')
                    ->prefixIcon('heroicon-m-globe-alt')
                    ->required()
                    ->alphaDash()
                    ->unique(table: Jamaah::class, column: "website"),


                Select::make("type")->options([
                    'masjid' => 'Masjid',
                    'majelis' => 'Majelis',
                ])
                    ->default('masjid')
                    ->selectablePlaceholder(false)
                    ->required()
            ]);
    }

    protected function handleRegistration(array $data): Jamaah
    {

        $jamaah = DB::transaction(function () use ($data) {
            $user = Auth::user();
            $jamaah = Jamaah::create($data);
            $jamaah->users()->attach($user);

            setPermissionsTeamId($jamaah->id);
            $user->assignRole('admin');

            return $jamaah;
        });

        return $jamaah;
    }
}
