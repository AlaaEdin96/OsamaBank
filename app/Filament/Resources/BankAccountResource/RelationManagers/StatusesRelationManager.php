<?php

namespace App\Filament\Resources\BankAccountResource\RelationManagers;

use App\Models\BankAccount;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusesRelationManager extends RelationManager
{
    protected static string $relationship = 'statuses';

    public function form(Form $form): Form
    {
        return $form
        ->schema([        
            // Select::make('bank_account_id')->required()->label('الحساب')
            // ->options(BankAccount::all()->pluck('name', 'id'))
            // ->searchable(),
            Select::make('statuses')->required()->label('الحالة')
            ->options([
                'مطابق' => 'مطابق',
                'غير مطابق' => 'غير مطابق',
                'تم التسجيل' => 'تم التسجيل',
                'تم الايداع' => 'تم الايداع',
                'تم الحجز' => 'تم الحجز',
                'تم التنفيد' => 'تم التنفيد',
            ])->columnSpanFull()
        ]);
}
    

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                 TextColumn::make('user.name'),
                TextColumn::make('statuses')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'draft' => 'gray',
                    'reviewing' => 'warning',
                    'published' => 'success',
                    'rejected' => 'danger',
                }),
            ])
            ->filters([
                
               //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
               // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
