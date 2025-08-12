<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResultResource\Pages;
use App\Models\Gene;
use App\Models\Patient;
use App\Models\PatientResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class PatientResultResource extends Resource
{
    protected static ?string $model = PatientResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationLabel = 'Hasil Pemeriksaan Pasien';
    protected static ?string $slug = 'patient-results';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Pasien')
                    ->options(Patient::pluck('full_name', 'patient_id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('gene_id')
                    ->label('Gen')
                    ->options(Gene::pluck('name', 'gene_id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('status')
                    ->label('Status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.full_name')
                    ->label('Pasien')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('gene.name')
                    ->label('Gen')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientResults::route('/'),
            'create' => Pages\CreatePatientResult::route('/create'),
            'edit' => Pages\EditPatientResult::route('/{record}/edit'),
        ];
    }
}
