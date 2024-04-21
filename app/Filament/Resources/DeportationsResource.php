<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeportationsResource\Pages;
 use App\Models\BankCard;
use App\Models\Deportations;
use App\Models\User;
  use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
 use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
 use Illuminate\Support\Facades\Auth;

class DeportationsResource extends Resource
{
    protected static ?string $model = Deportations::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'ترحيلات';

    protected static ?string $pluralModelLabel = "بطاقات";

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
                Section::make('بيانات الحساب المصرفي')
            ->description('يرجى كتابة كل البيانات المطلوبة لأنشاء حساب مصرفي مع تحميل صورة الرقم الوطنى وصورة الباسبور')   
            ->schema([
                Select::make('deportations_to')->required()->label('ترحيل الي')
                ->options(User::all()->pluck('name', 'id'))
                ->searchable(), 
                 Select::make('bank_card_id')->required()->label('رقم البطاقة')
                ->options(BankCard::all()->pluck('numder', 'id'))
                ->searchable(),
                TextInput::make('password')->required()->name('كلمة السر'),

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
            TextColumn::make('bankCard.numder')->searchable()->label('رقم البطاقة'),  
            IconColumn::make('bankCard.password')->label('تم'),
            TextColumn::make('note')->label('الوصف'),             
            IconColumn::make('confirmation')->label('تم')
            ->icon(fn (string $state): string => match ($state) {
    '1' => 'heroicon-o-check-badge',
    '0' => 'heroicon-o-clock',
})->color(fn (string $state): string => match ($state) {
     '0' => 'warning',
    '1' => 'success',
 })

])->defaultSort('created_at', 'desc')

            ->filters([
            ])
            
            ->actions(
                [
                    Tables\Actions\Action::make('Confirm')->label('تأكيد')
                    ->requiresConfirmation()
                    ->action(fn ( Deportations $st) =>
                 $st->update([
                           'confirmation'=>true,
                           'confirm_from'=>Auth::id()
                ])
                )->disabled(fn (Deportations $st)=> $st->confirmation) ,             
               
            ])->bulkActions([
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
            'index' => Pages\ListDeportations::route('/'),
            'create' => Pages\CreateDeportations::route('/create'),
          //  'edit' => Pages\EditDeportations::route('/{record}/edit'),
        ];
    }
}
