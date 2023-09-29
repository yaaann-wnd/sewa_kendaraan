<?php

namespace App\Filament\Resources\SewaResource\Pages;

use App\Filament\Resources\SewaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateSewa extends CreateRecord
{
    protected static string $resource = SewaResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Berhasil')
            ->body('Data sewa kendaraan berhasil ditambah.');
    }
}
