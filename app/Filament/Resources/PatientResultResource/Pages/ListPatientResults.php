<?php

namespace App\Filament\Resources\PatientResultResource\Pages;

use App\Filament\Resources\PatientResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientResults extends ListRecords
{
    protected static string $resource = PatientResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
