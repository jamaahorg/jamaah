<?php

namespace App\Filament\Jamaah\Resources\Majelis\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Jamaah\Resources\Majelis\MajelisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMajelis extends EditRecord
{
    protected static string $resource = MajelisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
