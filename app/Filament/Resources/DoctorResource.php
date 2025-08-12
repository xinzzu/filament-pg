<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use App\Models\Specialization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Dokter';
    protected static ?string $slug = 'doctors';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label('Nama Lengkap')
                    ->unique(
                        table: 'doctors', // sesuaikan nama tabel
                        column: 'full_name',
                        ignoreRecord: true
                    )
                    ->required()
                    ->maxLength(50)
                    ->placeholder('Masukkan Nama Lengkap'),

                Forms\Components\Select::make('specialization_id')
                    ->label('Spesialisasi')
                    ->options(Specialization::pluck('name', 'specialization_id'))
                    ->searchable()
                    ->required()
                    ->placeholder('Pilih spesialisasi dokter'),

                Forms\Components\TextInput::make('str_id')
                    ->label('Nomor STR')
                    ->unique(
                        table: 'doctors', // sesuaikan nama tabel
                        column: 'str_id',
                        ignoreRecord: true
                    )
                    ->required()
                    ->maxLength(50)
                    ->placeholder('Masukkan nomor STR'),

                Forms\Components\TextInput::make('practice_location')
                    ->label('Lokasi Praktik')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan lokasi praktik dokter'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Dokter')
                    ->required()
                    ->placeholder('tambahkan deskripsi dokter'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Nama Lengkap')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('specialization.name')
                    ->label('Spesialisasi')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('str_id')
                    ->label('Nomor STR')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('practice_location')
                    ->label('Lokasi Praktik')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Deskripsi dokter')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                EditAction::make()->label('Edit'),
                DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('Hapus Massal'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
