<?php

namespace App\Filament\Jamaah\Resources\TransactionCategoryResource\Pages;

use App\Filament\Jamaah\Resources\TransactionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionCategories extends ListRecords
{
    protected static string $resource = TransactionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
