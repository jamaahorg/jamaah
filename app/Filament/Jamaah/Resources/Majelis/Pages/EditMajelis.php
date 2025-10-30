<?php

namespace App\Filament\Jamaah\Resources\MajelisResource\Pages;

use App\Filament\Jamaah\Resources\MajelisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMajelis extends EditRecord
{
    protected static string $resource = MajelisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
