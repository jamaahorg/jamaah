<?php

namespace App\Filament\Jamaah\Resources\TransactionCategories\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Jamaah\Resources\TransactionCategories\TransactionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionCategories extends ListRecords
{
    protected static string $resource = TransactionCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
