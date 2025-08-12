<?php

namespace App\Filament\Resources\GeneDrugResource\Pages;

use App\Filament\Resources\GeneDrugResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeneDrugs extends ListRecords
{
    protected static string $resource = GeneDrugResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
