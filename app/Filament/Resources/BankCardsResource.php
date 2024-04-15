<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankCardsResource\Pages;
use App\Filament\Resources\BankCardsResource\RelationManagers;
use App\Models\BankAccount;
use App\Models\BankCard;
use App\Models\Deportations;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankCardsResource extends Resource
{
    protected static ?string $model = BankCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Work';

  
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('بيانات الحساب المصرفي')
             ->schema([
                TextInput::make('numder')->required()->name('رقم_البطاقة'),
                TextInput::make('password')->required()->name('الرقم_السري'),
                Select::make('bank_account_id')->required()->label('الحساب')
                ->options(BankAccount::all()->pluck('name', 'id'))
                ->searchable(),
            
                ])->columnSpan(3)->columns(2),
        ])->columns(3)
        
        
        ;


        /**S Section::make('الترحيلات')
             ->schema([               
                    Select::make('bank_account_id')->required()->label(' البطاقه عند')
                 ->options(User::all()->pluck('name', 'id'))
                 ->suffixAction(
                    ActionsAction::make('ترحيل_البطاقة')
                        ->icon('heroicon-m-clipboard')
                        ->requiresConfirmation()
                        ->action(function ($state) {
                            Deportations::create([
                                
                            ]);
                        }),
                        
                    )
                 ->searchable(),


            ])->columnSpan(1),
* */
    }

    public static function table(Table $table): Table
    {
        

        return $table
            ->columns([
                TextColumn::make('numder')->label('رقم البطاقة'),
                TextColumn::make('password')->label('الرقم السري'),
                TextColumn::make('tayp')->label('النوع '),
                TextColumn::make('bankAccount.bank.name')->label('البنك'),
                TextColumn::make('bankAccount.name')->label('الحساب'),
                TextColumn::make('bankAccount.client.name')->label('العميل'),
                TextColumn::make('note')->label('ملاحظة'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
             ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DeportationsRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankCards::route('/'),
            'create' => Pages\CreateBankCards::route('/create'),
            'edit' => Pages\EditBankCards::route('/{record}/edit'),
        ];
    }
}
