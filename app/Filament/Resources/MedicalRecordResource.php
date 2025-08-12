<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalRecordResource\Pages;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Drug;
use Filament\Forms;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class MedicalRecordResource extends Resource
{
    protected static ?string $model = MedicalRecord::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Rekam Medis';
    protected static ?string $navigationGroup = 'Healthcare';
    protected static ?int $navigationSort = 1;

    /**
     * Form Schema for Creating & Editing
     */
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('patient_id')
                    ->label('Pasien')
                    ->relationship('patient', 'full_name')
                    ->searchable()
                    ->required(),

                Select::make('doctor_id')
                    ->label('Dokter')
                    ->relationship('doctor', 'full_name')
                    ->searchable()
                    ->required(),

                MultiSelect::make('drug_allergies')
                    ->label('Alergi Obat')
                    ->relationship('patient.drugAllergies', 'name')
                    ->searchable()
                    ->preload()
                    ->saveRelationshipsUsing(fn($record, $state) => $record->patient->drugAllergies()->sync($state)),

                MultiSelect::make('drugs')
                    ->label('Obat yang Dikonsumsi')
                    ->relationship('drugs', 'name')
                    ->searchable()
                    ->preload(),

                TextInput::make('height')
                    ->label('Tinggi Badan (cm)')
                    ->numeric()
                    ->minValue(50)
                    ->maxValue(250)
                    ->reactive(),

                TextInput::make('weight')
                    ->label('Berat Badan (kg)')
                    ->numeric()
                    ->minValue(20)
                    ->maxValue(300)
                    ->reactive()
                    ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                        $height = $get('height');
                        if ($height) {
                            $bmi = round($state / (($height / 100) ** 2), 2);
                            $set('bmi', $bmi);
                        }
                    }),

                TextInput::make('bmi')
                    ->label('Indeks Massa Tubuh (BMI)')
                    ->numeric()
                    ->disabled(),

                TextInput::make('standard_blood_sugar')
                    ->label('Gula Darah Normal (mg/dL)')
                    ->numeric()
                    ->minValue(50)
                    ->maxValue(250),

                TextInput::make('fasting_blood_sugar')
                    ->label('Gula Darah Puasa (mg/dL)')
                    ->numeric()
                    ->minValue(50)
                    ->maxValue(250),

                Toggle::make('diabetes_mellitus_diagnosis')
                    ->label('Diagnosis Diabetes Melitus')
                    ->default(false),

                Textarea::make('other_disease')
                    ->label('Penyakit Lain')
                    ->nullable(),

                TextInput::make('hba1c_results')
                    ->label('Hasil Pemeriksaan HbA1C')
                    ->nullable(),

                TextInput::make('irs1_rs1801278')
                    ->label('Gen IRS1 rs1801278 Sequencing')
                    ->nullable(),

                Textarea::make('prescription')
                    ->label('Resep Dokter')
                    ->required(),

                Textarea::make('notes')
                    ->label('Catatan')
                    ->nullable(),
            ]);
    }

    /**
     * Table Columns for Listing
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.full_name')
                    ->label('Pasien')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('doctor.full_name')
                    ->label('Dokter')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('height')
                    ->label('Tinggi (cm)')
                    ->sortable(),

                TextColumn::make('weight')
                    ->label('Berat (kg)')
                    ->sortable(),

                TextColumn::make('bmi')
                    ->label('BMI')
                    ->sortable(),

                TextColumn::make('standard_blood_sugar')
                    ->label('Gula Darah Normal')
                    ->sortable(),

                TextColumn::make('fasting_blood_sugar')
                    ->label('Gula Darah Puasa')
                    ->sortable(),

                TextColumn::make('diabetes_mellitus_diagnosis')
                    ->label('Diabetes Melitus')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? '✅ Ya' : '❌ Tidak'),

                TextColumn::make('other_disease')
                    ->label('Penyakit Lain')
                    ->limit(30)
                    ->tooltip(fn($state) => $state),

                TextColumn::make('irs1_rs1801278')
                    ->label('Gen IRS1 rs1801278')
                    ->sortable()
                    ->limit(20),

                TextColumn::make('drugs.name')
                    ->label('Obat yang Dikonsumsi')
                    ->badge()
                    ->separator(', ')
                    ->limit(50),

                TextColumn::make('patient.drugAllergies.name')
                    ->label('Alergi Obat')
                    ->badge()
                    ->separator(', ')
                    ->limit(50),

                TextColumn::make('prescription')
                    ->label('Resep Dokter')
                    ->limit(50)
                    ->tooltip(fn($state) => $state),

                TextColumn::make('created_at')
                    ->label('Tanggal Periksa')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('patient_id')
                    ->label('Filter by Pasien')
                    ->relationship('patient', 'full_name'),

                Tables\Filters\SelectFilter::make('doctor_id')
                    ->label('Filter by Dokter')
                    ->relationship('doctor', 'full_name'),

                Tables\Filters\TernaryFilter::make('diabetes_mellitus_diagnosis')
                    ->label('Diabetes Melitus')
                    ->nullable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    /**
     * Define Relations (If Any)
     */
    public static function getRelations(): array
    {
        return [];
    }

    /**
     * Define Page Routes
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedicalRecords::route('/'),
            'create' => Pages\CreateMedicalRecord::route('/create'),
            'edit' => Pages\EditMedicalRecord::route('/{record}/edit'),
        ];
    }
}
