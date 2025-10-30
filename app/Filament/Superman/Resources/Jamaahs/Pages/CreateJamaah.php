<?php

namespace App\Filament\Superman\Resources\JamaahResource\Pages;

use App\Filament\Superman\Resources\JamaahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJamaah extends CreateRecord
{
    protected static string $resource = JamaahResource::class;
    protected static bool $canCreateAnother = false;
}
