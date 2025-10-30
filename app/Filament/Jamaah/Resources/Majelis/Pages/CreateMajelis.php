<?php

namespace App\Filament\Jamaah\Resources\MajelisResource\Pages;

use App\Filament\Jamaah\Resources\MajelisResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateMajelis extends CreateRecord
{
    protected static string $resource = MajelisResource::class;
    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Append jamaah type
        $data['type'] = "majelis";
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {

            $majelis = static::getModel()::create($data);

            // Attach Majelis to parent
            $jamaah = Filament::getTenant();
            $majelis->parent()->associate($jamaah)->save();
            // End Attach Majelis to parent

            // Attach User to new created Majelis
            $user = auth()->user();
            $majelis->users()->attach($user);
            $user->assignRole('admin');
            // End Attach User to new created Majelis

            return $majelis;
        });
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
