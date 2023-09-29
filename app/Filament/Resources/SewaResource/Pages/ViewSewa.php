<?php

namespace App\Filament\Resources\SewaResource\Pages;

use App\Filament\Resources\SewaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSewa extends ViewRecord
{
    protected static string $resource = SewaResource::class;

    protected static string $view = 'livewire.sewa.detail-sewa-wrapper';
}
