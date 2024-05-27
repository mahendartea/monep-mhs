<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\Agenda;
use App\Models\Notification;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationLabel = 'Pemberitahuan';

    protected static ?string $navigationGroup = 'Agenda';

    public static function getNavigationBadge(): ?string
    {
        return Notification::where('status', true)->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Form Input Pemberitahuan')->id('data')->schema([
                    Select::make('agenda_id')
                        ->label('Agenda')
                        ->options(
                            Agenda::orderBy('tgl')->pluck('judul_agenda', 'id')
                        )->required(),
                    FileUpload::make('file_undangan')
                        ->label('Undangan')
                        ->downloadable()
                        ->previewable(true)
                        ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']),
                    Forms\Components\Toggle::make('status')->label('Status')->default(true),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agenda.judul_agenda')
                    ->label('Judul Agenda')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agenda.no_rapat')
                    ->label('Nomor Rapat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agenda.tgl')
                    ->date('d F Y')
                    ->label('Tgl Agenda')
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_undangan')
                    ->icon('heroicon-s-cloud-arrow-down')
                    ->label('Undangan')
                    ->color('primary'),
                Tables\Columns\ToggleColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ])
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
