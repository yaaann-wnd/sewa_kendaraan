<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DriverResource\Pages;
use App\Filament\Resources\DriverResource\RelationManagers;
use App\Models\Driver;
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

class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Driver';

    protected static ?string $pluralModelLabel = 'Driver';

    protected static ?string $navigationGroup = 'Kelola';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_driver')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'Ada' => 'Ada',
                        'Sibuk' => 'Sibuk',
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
                TextColumn::make('nama_driver')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Sibuk' => 'danger',
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
                            ->body('Driver berhasil diedit.'),
                    ),
                Tables\Actions\DeleteAction::make()
                    ->modalWidth('md')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('Driver berhasil dihapus.'),
                    )
                    ->modalHeading('Hapus Driver')
                    ->modalDescription('Yakin ingin menghapus driver? Tindakan ini tidak bisa diulang.')
                    ->modalSubmitActionLabel('Iya, hapus driver')
                    ->modalCancelActionLabel('Batal'),
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
            'index' => Pages\ManageDrivers::route('/'),
        ];
    }
}
