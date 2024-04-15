<?php

namespace App\Filament\Resources\DeportationsResource\Pages;

use App\Filament\Resources\DeportationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeportations extends ListRecords
{
    protected static string $resource = DeportationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
