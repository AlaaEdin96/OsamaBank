<?php

namespace App\Filament\Resources\BankCardsResource\Pages;

use App\Filament\Resources\BankCardsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBankCards extends ListRecords
{
    protected static string $resource = BankCardsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
