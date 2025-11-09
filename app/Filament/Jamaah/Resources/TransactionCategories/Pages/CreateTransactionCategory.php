<?php

namespace App\Filament\Jamaah\Resources\TransactionCategories\Pages;

use App\Filament\Jamaah\Resources\TransactionCategories\TransactionCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransactionCategory extends CreateRecord
{
    protected static string $resource = TransactionCategoryResource::class;
}
