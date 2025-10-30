<?php

namespace App\Filament\Superman\Resources\Users;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use App\Filament\Superman\Resources\Users\Pages\ListUsers;
use App\Filament\Superman\Resources\Users\Pages\CreateUsers;
use App\Filament\Superman\Resources\Users\Pages\EditUsers;
use App\Filament\Superman\Resources\UsersResource\Pages;
use App\Filament\Superman\Resources\UsersResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user';

    public static function getNavigationLabel(): string
    {
        return __('common.users');
    }

    public static function getPluralLabel(): ?string
    {
        return __('common.users');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('common.name'))
                    ->required(),
                Select::make('roles')
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
                TextColumn::make('name')->label(__('common.name')),
                TextColumn::make('email')->label(__('common.email')),
                TextColumn::make('created_at')->label(__('common.register_date')),
            ])
            ->filters([
                //
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
            'index' => ListUsers::route('/'),
            'create' => CreateUsers::route('/create'),
            'edit' => EditUsers::route('/{record}/edit'),
        ];
    }
}
