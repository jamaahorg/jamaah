<?php

namespace App\Filament\Superman\Resources\Users\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Superman\Resources\Users\UsersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsers extends EditRecord
{
    protected static string $resource = UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
