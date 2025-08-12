<?php

namespace App\Filament\Resources\PatientResultResource\Pages;

use App\Filament\Resources\PatientResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientResult extends EditRecord
{
    protected static string $resource = PatientResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
