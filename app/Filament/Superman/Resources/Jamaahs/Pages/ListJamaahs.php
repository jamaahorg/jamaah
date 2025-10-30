<?php

namespace App\Filament\Superman\Resources\JamaahResource\Pages;

use App\Filament\Superman\Resources\JamaahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJamaahs extends ListRecords
{
    protected static string $resource = JamaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
