<?php

namespace App\Filament\Resources\KendaraanResource\Pages;

use App\Filament\Resources\KendaraanResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageKendaraans extends ManageRecords
{
    protected static string $resource = KendaraanResource::class;

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
                        ->body('Kendaraan berhasil ditambahkan.'),
                )
                ->label('Tambah kendaraan')
                ->icon('heroicon-o-plus-small'),
        ];
    }
}
