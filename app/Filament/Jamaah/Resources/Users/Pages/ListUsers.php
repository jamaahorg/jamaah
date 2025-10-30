<?php

namespace App\Filament\Jamaah\Resources\UserResource\Pages;

use App\Filament\Jamaah\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function updateRole($record, $column, $value)
    {
        DB::transaction(function () use ($record, $value) {
            $user = User::find($record);
            $user->removeRole($value === "admin" ? "staff" : "admin");
            $user->assignRole($value);
        });

        Notification::make()
            ->title('Role Updated')
            ->success()
            ->send();
        // $this->resolveTableRecord($record)?->update([$column => $value]);
    }
}
