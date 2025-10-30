<?php

namespace App\Filament\Superman\Resources\Jamaahs\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Superman\Resources\Jamaahs\JamaahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJamaah extends EditRecord
{
    protected static string $resource = JamaahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
