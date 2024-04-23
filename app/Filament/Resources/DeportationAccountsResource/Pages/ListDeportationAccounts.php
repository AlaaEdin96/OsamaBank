<?php

namespace App\Filament\Resources\DeportationAccountsResource\Pages;

use App\Filament\Resources\DeportationAccountsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDeportationAccounts extends ListRecords
{
    protected static string $resource = DeportationAccountsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("انشاء جديد"),
        ];
    }
}
