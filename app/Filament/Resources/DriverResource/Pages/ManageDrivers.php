<?php

namespace App\Filament\Resources\DriverResource\Pages;

use App\Filament\Resources\DriverResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageDrivers extends ManageRecords
{
    protected static string $resource = DriverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth('md')
                ->createAnother(false)
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Berhasil')
                        ->body('Driver berhasil ditambahkan.'),
                )
                ->label('Tambah driver')
                ->icon('heroicon-o-plus-small')
        ];
    }
}
