<?php

namespace App\Filament\Widgets;

use App\Models\Sewa;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class SewaTerbaru extends BaseWidget
{
    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Sewa::orderBy('created_at')->take(5)
            )
            ->columns([
                TextColumn::make('nama_penyewa'),
                TextColumn::make('status_sewa'),
            ]);
    }
}
