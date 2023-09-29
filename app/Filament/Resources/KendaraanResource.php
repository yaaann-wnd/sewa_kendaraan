<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KendaraanResource\Pages;
use App\Filament\Resources\KendaraanResource\RelationManagers;
use App\Models\Kendaraan;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Kendaraan';

    protected static ?string $pluralModelLabel = 'Kendaraan';

    protected static ?string $navigationGroup = 'Kelola';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_kendaraan')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'Ada' => 'Ada',
                        'Sedang digunakan' => 'Sedang digunakan',
                    ])
                    ->required()
                    ->hiddenOn('create')
                    ->columnSpanFull()
                    ->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kendaraan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Sedang digunakan' => 'danger',
                        'Ada' => 'success'
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalWidth('md')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Kendaraan berhasil diedit.'),
                    ),
                Tables\Actions\DeleteAction::make()
                    ->modalWidth('md')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Kendaraan berhasil dihapus.'),
                    )
                    ->modalHeading('Hapus Kendaraan')
                    ->modalDescription('Yakin ingin menghapus kendaraan? Tindakan ini tidak bisa diulang.')
                    ->modalSubmitActionLabel('Iya, hapus kendaraan')
                    ->modalCancelActionLabel('Batal')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKendaraans::route('/'),
        ];
    }
}
