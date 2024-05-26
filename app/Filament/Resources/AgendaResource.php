<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Agenda';

    protected static ?string $navigationGroup = 'Agenda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Agenda')->id('agenda')->schema([
                    Grid::make([
                        'default' => 1,
                        'md' => 2,
                    ])
                        ->schema([
                            Forms\Components\TextInput::make('no_rapat')->label('Nomor Rapat')->required(),
                            Forms\Components\TextInput::make('judul_agenda')->label('Judul Agenda')->required(),
                            Forms\Components\Textarea::make('perihal')->label('Perihal'),
                            Forms\Components\DatePicker::make('tgl')->label('Tanggal Agenda')->required(),
                            Forms\Components\TimePicker::make('pukul_mulai')->label('Mulai Pukul'),
                            Forms\Components\TimePicker::make('pukul_selesai')->label('Selesai Pukul'),
                            Forms\Components\Select::make('user_id')->label('Pimpinan Rapat')
                                ->options(User::all()->pluck('name', 'id'))
                                ->searchable(),
                            Forms\Components\TextInput::make('tempat')->label('Tempat'),
                            Forms\Components\Textarea::make('notulensi')->label('Notulen'),
                            Forms\Components\FileUpload::make('file')
                                ->label('File Agenda')
                                ->downloadable()
                                ->previewable(true)
                                ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']),
                            Forms\Components\Toggle::make('status')->label('Status')->required()->default(true),
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_rapat')->label('Nomor Rapat')->searchable()->sortable(),
                TextColumn::make('judul_agenda')->label('Judul Agenda')->searchable()->sortable(),
                TextColumn::make('user.name')->label('Pimpinan Rapat')->searchable()->sortable(),
                TextColumn::make('tgl')->label('Tanggal Agenda')->date('d F Y')->sortable(),
                TextColumn::make('pukul_mulai')->label('Mulai Pukul')
                    ->formatStateUsing(function ($record) {
                        return Carbon::parse($record->pukul_mulai)->format('H:i') . ' WIB';
                    })->sortable(),
                CheckboxColumn::make('status')->label('Status'),
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
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}
