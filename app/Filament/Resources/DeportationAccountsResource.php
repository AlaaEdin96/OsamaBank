<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeportationAccountsResource\Pages;
use App\Filament\Resources\DeportationAccountsResource\RelationManagers;
use App\Models\BankAccount;
use App\Models\BankCard;
use App\Models\DeportationAccount;
use App\Models\DeportationAccounts;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
 use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DeportationAccountsResource extends Resource
{
    protected static ?string $model = DeportationAccount::class;

 
    protected static ?string $navigationGroup = 'ترحيلات';

    protected static ?string $pluralModelLabel = "حسابات";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
                Section::make('بيانات الحساب المصرفي')
            //->description('يرجى كتابة كل البيانات المطلوبة لأنشاء حساب مصرفي مع تحميل صورة الرقم الوطنى وصورة الباسبور')   
            ->schema([
                Select::make('deportations_to')->required()->label('ترحيل الي')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable(), 
                 Select::make('bank_account_id')->required()->label('الحساب')
                ->options(BankAccount::all()->pluck('name', 'id'))
                ->searchable(),
                 
                TextInput::make('note')->required()->name('ملاحظة'),

            ])->columns(3),
          
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('user.name')->label('المرسل'),  
            TextColumn::make('deportationsTo.name')->label('المستقبل'),
            TextColumn::make('confirmFrom.name')->label('نأكيد من'),
            TextColumn::make('bankAccount.name')->searchable()->label('الحساب'),  
            TextColumn::make('note')->label('الوصف'),             
            IconColumn::make('confirmation')
->icon(fn (string $state): string => match ($state) {
    '1' => 'heroicon-o-check-badge',
    '0' => 'heroicon-o-clock',
})->color(fn (string $state): string => match ($state) {
     '0' => 'warning',
    '1' => 'success',
 })

])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
              //  Tables\Actions\EditAction::make(),
              Tables\Actions\Action::make('Confirm')->label('تأكيد')
                    ->requiresConfirmation()
                    ->action(fn ( DeportationAccount $st) =>
                 $st->update([
                           'confirmation'=>true,
                           'confirm_from'=>Auth::id()
                ])
                )->disabled(fn (DeportationAccount $st)=> $st->confirmation) , 
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeportationAccounts::route('/'),
          //  'create' => Pages\CreateDeportationAccounts::route('/create'),
          //  'edit' => Pages\EditDeportationAccounts::route('/{record}/edit'),
        ];
    }
}
