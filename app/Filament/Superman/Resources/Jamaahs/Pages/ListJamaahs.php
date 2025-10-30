<?php

namespace App\Filament\Superman\Resources\Jamaahs\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Superman\Resources\Jamaahs\JamaahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJamaahs extends ListRecords
{
    protected static string $resource = JamaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
