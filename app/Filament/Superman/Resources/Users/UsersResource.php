<?php

namespace App\Filament\Superman\Resources;

use App\Filament\Superman\Resources\UsersResource\Pages;
use App\Filament\Superman\Resources\UsersResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getNavigationLabel(): string
    {
        return __('common.users');
    }

    public static function getPluralLabel(): ?string
    {
        return __('common.users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('common.name'))
                    ->required(),
                Forms\Components\Select::make('roles')
                    ->label(__('common.role'))
                    ->relationship('roles', 'name')
                    ->selectablePlaceholder(false)
                    ->required()
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('common.name')),
                Tables\Columns\TextColumn::make('email')->label(__('common.email')),
                Tables\Columns\TextColumn::make('created_at')->label(__('common.register_date')),
            ])
            ->filters([
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
