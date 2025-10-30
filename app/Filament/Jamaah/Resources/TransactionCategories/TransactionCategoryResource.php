<?php

namespace App\Filament\Jamaah\Resources;

use App\Filament\Jamaah\Resources\TransactionCategoryResource\Pages;
use App\Filament\Jamaah\Resources\TransactionCategoryResource\RelationManagers;
use App\Models\TransactionCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionCategoryResource extends Resource
{
    protected static ?string $model = TransactionCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Transactions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTransactionCategories::route('/'),
            'create' => Pages\CreateTransactionCategory::route('/create'),
            'edit' => Pages\EditTransactionCategory::route('/{record}/edit'),
        ];
    }
}
