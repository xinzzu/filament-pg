<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use App\Models\MobileUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Hash;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;
    protected static ?string $navigationLabel = 'Pasien';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('medical_record_number')
                    ->label('Nomor Rekam Medis')
                    ->disabled() // Disable manual input
                    ->dehydrated(), // Keep value when submitting form

                Forms\Components\DatePicker::make('diabetes_diagnosis_date')
                    ->label('Tanggal Diagnosis Diabetes')
                    ->nullable()
                    ->helperText('Kosongkan jika belum terdiagnosis'),

                Forms\Components\TextInput::make('full_name')
                    ->label('Nama Lengkap')
                    ->required(),

                Forms\Components\TextInput::make('national_id')
                    ->label('Nomor Identitas Nasional')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->required(),

                Forms\Components\DatePicker::make('date_of_birth')
                    ->label('Tanggal Lahir')
                    ->required(),

                Forms\Components\Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'male' => 'Laki-laki',
                        'female' => 'Perempuan',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->rows(3)
                    ->required(),

                Forms\Components\TextInput::make('phone_number')
                    ->label('Nomor Telepon')
                    ->required(),

                Forms\Components\Select::make('religion')
                    ->label('Agama')
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Buddha' => 'Buddha',
                        'Konghucu' => 'Konghucu',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('occupation')
                    ->label('Pekerjaan')
                    ->required(),

                Forms\Components\TextInput::make('education')
                    ->label('Pendidikan')
                    ->required(),

                Forms\Components\Select::make('marital_status')
                    ->label('Status Pernikahan')
                    ->options([
                        'single' => 'Belum Menikah',
                        'married' => 'Menikah',
                        'divorced' => 'Cerai',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('medical_record_number')->label('Nomor Rekam Medis'),
                Tables\Columns\TextColumn::make('full_name')->label('Nama Lengkap'),
                Tables\Columns\TextColumn::make('phone_number')->label('Nomor Telepon'),
                Tables\Columns\TextColumn::make('birth_place')->label('Tempat Lahir'),
                Tables\Columns\TextColumn::make('date_of_birth')->label('Tanggal Lahir')->date(),
            ])
            ->actions([
                Action::make('Generate Mobile User')
                    ->label('Buat Akun Mobile')
                    ->icon('heroicon-o-user-plus')
                    ->action(fn(Patient $record) => self::generateMobileUser($record))
                    ->requiresConfirmation()
                    ->visible(fn(Patient $record) => !MobileUser::where('patient_id', $record->patient_id)->exists()),
            ]);
    }

    public static function generateMobileUser(Patient $patient)
    {
        MobileUser::create([
            'patient_id' => $patient->patient_id,
            'medical_record_number' => $patient->medical_record_number,
            'password' => Hash::make('defaultpassword'),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
