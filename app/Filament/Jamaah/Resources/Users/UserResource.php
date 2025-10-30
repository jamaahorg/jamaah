<?php

namespace App\Filament\Jamaah\Resources;

use App\Filament\Jamaah\Resources\UserResource\Pages;
use App\Filament\Jamaah\Resources\UserResource\RelationManagers;
use App\Models\Role;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Select::make("user_id")
                    ->label(__('common.name'))
                    ->options(
                        User::whereNotIn('id', function ($query) {
                            $query->select('user_id')
                                ->from('jamaah_user')
                                ->where('jamaah_id', Filament::getTenant()->id);
                        })
                            ->pluck("name", "id")
                    )
                    ->lazy()
                    ->searchable()
                    ->required(),
                Select::make("role")
                    ->label(__('common.role'))
                    ->options([
                        'admin' => 'Admin',
                        'staff' => 'Staff',
                    ])
                    ->default("admin")
                    ->selectablePlaceholder(false)
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('common.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('common.email'))
                    ->searchable(),
                ViewColumn::make('role')
                    ->label(__('common.role'))
                    ->view("tables.columns.select-role")
            ])
            ->actions([
                DeleteAction::make()
                    ->before(function (DeleteAction $action, User $record) {
                        DB::transaction(function () use ($record) {
                            // revoke user role
                            $record->removeRole($record->getRoleNames()[0]);

                            // remove user from jamaah
                            $tenant = Filament::getTenant();
                            $tenant->users()->detach($record->id);
                        });

                        Notification::make()
                            ->title('User Deleted')
                            ->success()
                            ->send();
                        $action->cancel(); // use cancel otherwise user will be permanently deleted
                    }),
            ])
            ->recordUrl(null)
            ->bulkActions([]);
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
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
