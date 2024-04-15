<?php

namespace App\Filament\Resources\BankCardsResource\Pages;

use App\Filament\Resources\BankCardsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBankCards extends EditRecord
{
    protected static string $resource = BankCardsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
