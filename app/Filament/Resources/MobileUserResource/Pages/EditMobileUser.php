<?php

namespace App\Filament\Resources\MobileUserResource\Pages;

use App\Filament\Resources\MobileUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMobileUser extends EditRecord
{
    protected static string $resource = MobileUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
