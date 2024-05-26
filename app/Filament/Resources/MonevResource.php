<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonevResource\Pages;
use App\Filament\Resources\MonevResource\RelationManagers;
use App\Models\Agenda;
use App\Models\Monev;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonevResource extends Resource
{
    protected static ?string $model = Monev::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static ?string $navigationLabel = 'Monitoring & Evaluasi';

    protected static ?string $navigationGroup = 'Agenda';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('agenda_id')->options(Agenda::all()->pluck('judul_agenda', 'id'))->label('Agenda')
                    ->preload(),
                Forms\Components\FileUpload::make('file_monev')->label('File Monev')->required()
                    ->downloadable()
                    ->previewable(true)
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']),
                Forms\Components\FileUpload::make('file_absen')->label('File Absensi')->required()
                    ->downloadable()
                    ->previewable(true)
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']),
                Forms\Components\Textarea::make('notulen_rapat')->label('Notulen Rapat')->required(),
                Forms\Components\Toggle::make('status')->label('Status')->required()->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agenda.judul_agenda')->label('Judul Agenda')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('file_monev')->label('File Monev')
                    ->icon('heroicon-s-cloud-arrow-down')
                    ->label('File Monev')
                    ->color('primary')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('file_absen')->label('File Absensi')
                    ->icon('heroicon-s-cloud-arrow-down')
                    ->label('File Undangan')
                    ->color('primary')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('agenda.tgl')->label('Tanggal Agenda')->date('d F Y')->sortable(),
                Tables\Columns\ToggleColumn::make('status')->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMonevs::route('/'),
            'create' => Pages\CreateMonev::route('/create'),
            'edit' => Pages\EditMonev::route('/{record}/edit'),
        ];
    }
}
