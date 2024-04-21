<?php

namespace App\Filament\Resources\BankAccountResource\Pages;

use App\Filament\Resources\BankAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBankAccounts extends ListRecords
{
    protected static string $resource = BankAccountResource::class;

 
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("انشاء جديد"),
        ];
    }
}
