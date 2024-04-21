<?php

namespace App\Filament\Resources\DeportationAccountsResource\Pages;

use App\Filament\Resources\DeportationAccountsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeportationAccounts extends EditRecord
{
    protected static string $resource = DeportationAccountsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
