<?php

namespace App\Filament\Jamaah\Resources\TransactionCategoryResource\Pages;

use App\Filament\Jamaah\Resources\TransactionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransactionCategory extends EditRecord
{
    protected static string $resource = TransactionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
