<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pegawai';

    protected static ?string $navigationGroup = 'Data';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        $isCreate = $form->getOperation() === "create";
        return $form
            ->schema([
                Section::make('User Info')->id('user')->schema([
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(User::class, 'email', ignoreRecord: true)
                        ->label('Email'),
                    Select::make('roles')->multiple()->relationship('roles', 'name'),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->label('Password')
                        ->visible($isCreate),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->password()
                        ->required()
                        ->visible($isCreate)
                        ->label('Konfirmasi Password')
                        ->same('password'),
                ])->columns(2),
                Section::make('Info Pegawai')->id('personal')->schema([
                    Forms\Components\TextInput::make('nip')
                        ->required()
                        ->label('NIP'),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Nama Pegawai'),
                    Select::make('jk')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])
                        ->required()
                        ->label('Jenis Kelamin'),
                    Select::make('jabatan')->options([
                        'Kepala Dinas' => 'Kepala Dinas',
                        'Sekretaris Dinas' => 'Sekretaris Dinas',
                        'Kepala Sub Bagian' => 'Kepala Sub Bagian',
                        'Kepala Bidang' => 'Kepala Bidang',
                        'Kepala UPTD' => 'Kepala UPTD',
                        'Kepala Seksi' => 'Kepala Seksi',
                    ])->label('Jabatan'),
                    Select::make('bidang')->options([
                        'Umum' => 'Umum',
                        'kepegawaian dan Tata Laksana' => 'kepegawaian dan Tata Laksana',
                        'Perencanaan dan Program' => 'Perencanaan dan Program',
                        'Keuangan' => 'Keuangan',
                        'Bina Hukum Syariat Islam dan HAM' => 'Bina Hukum Syarat Islam dan HAM',
                        'Penyuluhan, Syiar Islam dan Tenaga Dair' => 'Penyuluhan, Syiah Islam dan Tenaga Dinas',
                        'Peribadatan, syiar Islam dan Pengembangan Sarana' => 'Peribadatan, syiah Islam dan Pengembangan Sarana',
                        'Pengelolaan Mesjid Raya Baiturrahman' => 'Pengelolaan Mesjid Raya Baiturrahman',
                        'Pengembangan dan Pemahaman SDM' => 'Pengembangan dan Pemahaman SDM',
                    ])
                        ->label('Bidang'),
                    Forms\Components\TextInput::make('notelp')->label('No. Telp'),
                ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nip')->label('NIP')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nip')->label('NIP')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('jabatan')->label('Jabatan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('bidang')->label('Bidang')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('notelp')->label('No. Telp')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
