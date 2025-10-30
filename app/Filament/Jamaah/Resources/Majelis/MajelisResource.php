<?php

namespace App\Filament\Jamaah\Resources\Majelis;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Filament\Jamaah\Resources\Majelis\Pages\ListMajelis;
use App\Filament\Jamaah\Resources\Majelis\Pages\CreateMajelis;
use App\Filament\Jamaah\Resources\Majelis\Pages\EditMajelis;
use App\Filament\Jamaah\Resources\MajelisResource\Pages;
use App\Filament\Jamaah\Resources\MajelisResource\RelationManagers;
use App\Models\Jamaah;
use App\Models\Majelis;
use Filament\Facades\Filament;
use Filament\Forms;
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
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';
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

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('common.name'))
                    ->required(),
                TextInput::make('website')
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
                TextColumn::make('name')->label(__('common.name')),
                TextColumn::make('website')->label(__('common.website')),
                TextColumn::make('type')->label(__('common.type')),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ListMajelis::route('/'),
            'create' => CreateMajelis::route('/create'),
            'edit' => EditMajelis::route('/{record}/edit'),
        ];
    }
}
