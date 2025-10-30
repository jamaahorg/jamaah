<?php

namespace App\Filament\Superman\Resources\UsersResource\Pages;

use App\Filament\Superman\Resources\UsersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUsers extends CreateRecord
{
    protected static string $resource = UsersResource::class;
    protected static bool $canCreateAnother = false;
}
