<?php

namespace App\Filament\Jamaah\Resources\TransactionCategories;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Jamaah\Resources\TransactionCategories\Pages\ListTransactionCategories;
use App\Filament\Jamaah\Resources\TransactionCategories\Pages\CreateTransactionCategory;
use App\Filament\Jamaah\Resources\TransactionCategories\Pages\EditTransactionCategory;
use App\Filament\Jamaah\Resources\TransactionCategoryResource\Pages;
use App\Filament\Jamaah\Resources\TransactionCategoryResource\RelationManagers;
use App\Models\TransactionCategory;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionCategoryResource extends Resource
{
    protected static ?string $model = TransactionCategory::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-squares-2x2';
    protected static string | \UnitEnum | null $navigationGroup = 'Transactions';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransactionCategories::route('/'),
            'create' => CreateTransactionCategory::route('/create'),
            'edit' => EditTransactionCategory::route('/{record}/edit'),
        ];
    }
}
