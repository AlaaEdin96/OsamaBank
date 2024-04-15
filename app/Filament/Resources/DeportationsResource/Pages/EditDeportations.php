<?php

namespace App\Filament\Resources\DeportationsResource\Pages;

use App\Filament\Resources\DeportationsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeportations extends EditRecord
{
    protected static string $resource = DeportationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
