<?php

namespace App\Filament\Jamaah\Resources\UserResource\Pages;

use App\Filament\Jamaah\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected static bool $canCreateAnother = false;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $jamaah = Filament::getTenant();
            $user = User::find($data["user_id"]);

            // Attach User into current active Jamaah
            $jamaah->users()->attach($user);
            $user->assignRole($data["role"]);
            // End Attach User into current active Jamaah

            return $user;
        });
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
