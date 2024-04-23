<?php

namespace App\Filament\Resources\StatusesResource\Pages;

use App\Filament\Resources\StatusesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatuses extends EditRecord
{
    protected static string $resource = StatusesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
