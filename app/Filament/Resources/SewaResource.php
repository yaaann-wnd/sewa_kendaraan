<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SewaResource\Pages;
use App\Filament\Resources\SewaResource\RelationManagers;
use App\Models\Sewa;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SewaResource extends Resource
{
    protected static ?string $model = Sewa::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Sewa';

    protected static ?string $pluralModelLabel = 'Sewa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_penyewa')
                    ->required()
                    ->minLength(5)
                    ->columnSpanFull(),
                DatePicker::make('tgl_mulai')
                    ->required()
                    ->native(false)
                    ->label('Tanggal mulai sewa')
                    ->live(),
                DatePicker::make('tgl_selesai')
                    ->required()
                    ->native(false)
                    ->label('Tanggal selesai sewa')
                    ->minDate(function (Get $get) {
                        $tanggal = $get('tgl_mulai');

                        return $tanggal;
                    }),
                Select::make('penyetuju_1')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('role_id', 2)
                    )
                    ->label('Penyetuju 1')
                    ->native(false)
                    ->required(),
                Select::make('penyetuju_2')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('role_id', 3)
                    )
                    ->label('Penyetuju 2')
                    ->native(false)
                    ->required()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_penyewa')
                    ->searchable(),
                TextColumn::make('tgl_mulai')
                    ->sortable(),
                TextColumn::make('tgl_selesai')
                    ->sortable(),
                TextColumn::make('status_sewa')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu persetujuan atasan' => 'warning',
                        'Menunggu persetujuan direktur' => 'warning',
                        'Disewakan' => 'info',
                        'Ditolak' => 'danger',
                        'Selesai' => 'success'
                    })
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (Auth::user()->role_id == 2) {
                    return $query->where([
                        ['status_sewa', 'Menunggu persetujuan atasan'],
                        ['status_penyetuju', null]
                    ]);
                } elseif (Auth::user()->role_id == 3) {
                    return $query->where([
                        ['status_sewa', 'Menunggu persetujuan direktur'],
                        ['status_penyetuju', 1]
                    ]);
                }

                return $query;
            })
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn () => Auth::user()->role_id == 1),
                Tables\Actions\ViewAction::make()
                    ->hidden(fn () => Auth::user()->role_id == 1),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSewas::route('/'),
            'create' => Pages\CreateSewa::route('/create'),
            'edit' => Pages\EditSewa::route('/{record}/edit'),
            'view' => Pages\ViewSewa::route('/{record}'),

        ];
    }
}
