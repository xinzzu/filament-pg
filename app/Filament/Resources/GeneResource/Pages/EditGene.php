<?php

namespace App\Filament\Resources\GeneResource\Pages;

use App\Filament\Resources\GeneResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGene extends EditRecord
{
    protected static string $resource = GeneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
