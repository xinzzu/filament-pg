<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MobileUserResource\Pages;
use App\Models\MobileUser;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class MobileUserResource extends Resource
{
    protected static ?string $model = MobileUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('Pasien')
                    ->options(Patient::pluck('full_name', 'patient_id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(
                        fn($state, callable $set) =>
                        $set('medical_record_number', Patient::where('patient_id', $state)->value('medical_record_number'))
                    ),

                Forms\Components\TextInput::make('medical_record_number')
                    ->label('Nomor Rekam Medis')
                    ->disabled()
                    ->required()
                    ->dehydrated(),

                Forms\Components\TextInput::make('password')
                    ->label('Kata Sandi')
                    ->password()
                    ->required()
                    ->dehydrated(fn($state) => !empty($state))
                    ->afterStateHydrated(fn($component) => $component->state('')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.full_name')->label('Nama Pasien'),
                Tables\Columns\TextColumn::make('medical_record_number')->label('Nomor Rekam Medis'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat Pada')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMobileUsers::route('/'),
            'create' => Pages\CreateMobileUser::route('/create'),
            'edit' => Pages\EditMobileUser::route('/{record}/edit'),
        ];
    }
}
