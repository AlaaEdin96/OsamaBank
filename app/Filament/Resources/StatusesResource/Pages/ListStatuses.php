<?php

namespace App\Filament\Resources\StatusesResource\Pages;

use App\Filament\Resources\StatusesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuses extends ListRecords
{
    protected static string $resource = StatusesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
