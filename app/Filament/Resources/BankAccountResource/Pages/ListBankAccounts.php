<?php

namespace App\Filament\Resources\BankAccountResource\Pages;

use App\Filament\Resources\BankAccountResource;
use App\Models\Statuses;
use Filament\Actions;
 use Filament\Resources\Pages\ListRecords;
 use Filament\Resources\Components\Tab;
 use Illuminate\Database\Eloquent\Builder;

class ListBankAccounts extends ListRecords
{
    protected static string $resource = BankAccountResource::class;

 
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label("انشاء جديد"),
        ];
    }


    public function getTabs(): array
{
     $tabs['all'] = Tab::make('الكل');
     $statuses=Statuses::all();
     foreach ($statuses as $key => $value) {
        $tabs[$value->statuses] =Tab::make($value->statuses)
     ->modifyQueryUsing(fn (Builder $query) => $query->where('statuses_id', $value->id));
     }
     return $tabs;

}
}
