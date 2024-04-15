<?php

namespace App\Filament\Resources\BankCardsResource\RelationManagers;

use App\Models\BankCard;
use App\Models\Deportations;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DeportationsRelationManager extends RelationManager
{
    protected static string $relationship = 'deportations';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('deportations_to')->required()->label('ترحيل الي')
            ->options(User::all()->pluck('name', 'id'))
            ->searchable(), 
            TextInput::make('note')->required()->name('ملاحظة'),

        ]);

    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('deportationsTo.name'),
                 TextColumn::make('confirmFrom.name'),
                 TextColumn::make('note'),  
                TextColumn::make('bankCard.numder'),  
                TextColumn::make('user.name'),  
               
                IconColumn::make('confirmation')
    ->icon(fn (string $state): string => match ($state) {
        '1' => 'heroicon-o-check-badge',
        '0' => 'heroicon-o-clock',
    })->color(fn (string $state): string => match ($state) {
         '0' => 'warning',
        '1' => 'success',
     })
   
])
 
            ->filters([

        
     
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                
                Tables\Actions\Action::make('Confirm')
                ->action(fn ( Deportations $st) =>
                 $st->update([
                           'confirmation'=>true,
                           'confirm_from'=>Auth::id()
                ])
                )->disabled(fn (Deportations $st)=> $st->confirmation)            
                ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
