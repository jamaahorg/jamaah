<?php

namespace App\Filament\Jamaah\Resources;

use App\Filament\Jamaah\Resources\MajelisResource\Pages;
use App\Filament\Jamaah\Resources\MajelisResource\RelationManagers;
use App\Models\Jamaah;
use App\Models\Majelis;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Testing\Constraints\NotSoftDeletedInDatabase;

class MajelisResource extends Resource
{
    protected static ?string $model = Jamaah::class;
    protected static ?string $tenantOwnershipRelationshipName = 'parent';
    protected static ?string $tenantRelationshipName = 'children';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Majelis';
    protected static ?string $label = 'Majelis';

    public static function shouldRegisterNavigation(): bool
    {
        // Set only visible to type of masjid
        return Filament::getTenant()->type == "masjid";
    }

    public static function canAccess(): bool
    {
        // Set only visible to type of masjid
        return Filament::getTenant()->type == "masjid";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('common.name'))
                    ->required(),
                Forms\Components\TextInput::make('website')
                    ->label(__('common.website'))
                    ->suffix('.jamaah.com')
                    ->prefixIcon('heroicon-m-globe-alt')
                    ->required()
                    ->alphaDash()
                    ->unique(table: Jamaah::class, column: "website", ignoreRecord: true),
            ])
            ->columns(1)
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('common.name')),
                Tables\Columns\TextColumn::make('website')->label(__('common.website')),
                Tables\Columns\TextColumn::make('type')->label(__('common.type')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                NotSoftDeletedInDatabase::class
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
            'index' => Pages\ListMajelis::route('/'),
            'create' => Pages\CreateMajelis::route('/create'),
            'edit' => Pages\EditMajelis::route('/{record}/edit'),
        ];
    }
}
