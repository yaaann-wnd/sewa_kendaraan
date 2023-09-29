<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'User';

    protected static ?string $pluralModelLabel = 'User';

    protected static ?string $navigationGroup = 'Kelola';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Username')
                    ->autocomplete(false)
                    ->columnSpanFull(),
                TextInput::make('email')
                    ->label('Email'),
                Select::make('role_id')
                    ->relationship(
                        name: 'role',
                        titleAttribute: 'nama_role',
                        modifyQueryUsing: fn (Builder $query) => $query->whereNot('id', 1)
                    )
                    ->native(false),
                TextInput::make('password')
                    ->password()
                    ->minLength(5)
                    ->autocomplete(false)
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('role.nama_role'),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->whereNot('role_id', 1))
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalWidth('md')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Berhasil')
                            ->body('User berhasil dihapus.'),
                    )
                    ->modalHeading('Hapus User')
                    ->modalDescription('Yakin ingin menghapus user? Tindakan ini tidak bisa diulang.')
                    ->modalSubmitActionLabel('Iya, hapus user')
                    ->modalCancelActionLabel('Batal'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
