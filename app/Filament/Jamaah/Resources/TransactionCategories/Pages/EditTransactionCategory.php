<?php

namespace App\Filament\Jamaah\Resources\TransactionCategories\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Jamaah\Resources\TransactionCategories\TransactionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransactionCategory extends EditRecord
{
    protected static string $resource = TransactionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
