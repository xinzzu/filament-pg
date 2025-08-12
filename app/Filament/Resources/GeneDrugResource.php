<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneDrugResource\Pages;
use App\Models\Gene;
use App\Models\Drug;
use App\Models\GeneDrug;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class GeneDrugResource extends Resource
{
    protected static ?string $model = GeneDrug::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationLabel = 'Hubungan Obat & Gen';
    protected static ?string $slug = 'gene-drug';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('gene_id')
                    ->label('Gene')
                    ->options(Gene::pluck('name', 'gene_id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('drug_id')
                    ->label('Drug')
                    ->options(Drug::pluck('name', 'drug_id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Textarea::make('recommendation')
                    ->label('Recommendation')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('gene.name')
                    ->label('Gene')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('drug.name')
                    ->label('Drug')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('recommendation')
                    ->label('Recommendation')
                    ->limit(50),
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
            'index' => Pages\ListGeneDrugs::route('/'),
            'create' => Pages\CreateGeneDrug::route('/create'),
            'edit' => Pages\EditGeneDrug::route('/{record}/edit'),
        ];
    }
}
