<?php

namespace App\Filament\Superman\Resources;

use App\Filament\Superman\Resources\JamaahResource\Pages;
use App\Filament\Superman\Resources\JamaahResource\RelationManagers;
use App\Models\Jamaah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JamaahResource extends Resource
{
    protected static ?string $model = Jamaah::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Jamaah';
    protected static ?string $pluralLabel = 'Jamaah';

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
                Forms\Components\Select::make("type")
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
                Tables\Columns\TextColumn::make('name')->label(__('common.name')),
                Tables\Columns\TextColumn::make('website')->label(__('common.website')),
                Tables\Columns\TextColumn::make('type')->label(__('common.type')),
            ])
            ->filters([
                Filters\SelectFilter::make('type')
                    ->label(__('common.type'))
                    ->options([
                        'masjid' => 'Masjid',
                        'majelis' => 'Majelis',
                    ])
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListJamaahs::route('/'),
            'create' => Pages\CreateJamaah::route('/create'),
            'edit' => Pages\EditJamaah::route('/{record}/edit'),
        ];
    }
}
