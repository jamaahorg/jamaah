<?php

namespace App\Filament\Jamaah\Resources\Majelis\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Jamaah\Resources\Majelis\MajelisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMajelis extends ListRecords
{
    protected static string $resource = MajelisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
