<?php

namespace App\Filament\Superman\Resources\Jamaahs;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteAction;
use App\Filament\Superman\Resources\Jamaahs\Pages\ListJamaahs;
use App\Filament\Superman\Resources\Jamaahs\Pages\CreateJamaah;
use App\Filament\Superman\Resources\Jamaahs\Pages\EditJamaah;
use App\Filament\Superman\Resources\JamaahResource\Pages;
use App\Filament\Superman\Resources\JamaahResource\RelationManagers;
use App\Models\Jamaah;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JamaahResource extends Resource
{
    protected static ?string $model = Jamaah::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Jamaah';
    protected static ?string $pluralLabel = 'Jamaah';

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
                Select::make("type")
                    ->label(__('common.type'))
                    ->options([
                        'masjid' => 'Masjid',
                        'majelis' => 'Majelis',
                    ])
                    ->selectablePlaceholder(false)
                    ->required()

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('common.name')),
                TextColumn::make('website')->label(__('common.website')),
                TextColumn::make('type')->label(__('common.type')),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label(__('common.type'))
                    ->options([
                        'masjid' => 'Masjid',
                        'majelis' => 'Majelis',
                    ])
            ])
            ->recordActions([
                DeleteAction::make(),
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
            'index' => ListJamaahs::route('/'),
            'create' => CreateJamaah::route('/create'),
            'edit' => EditJamaah::route('/{record}/edit'),
        ];
    }
}
