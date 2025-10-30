<?php

namespace App\Filament\Superman\Resources\Users\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Superman\Resources\Users\UsersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
