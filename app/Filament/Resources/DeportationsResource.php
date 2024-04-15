<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeportationsResource\Pages;
use App\Filament\Resources\DeportationsResource\RelationManagers;
use App\Models\BankCard;
use App\Models\Deportations;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DeportationsResource extends Resource
{
    protected static ?string $model = Deportations::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Work';


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
                 Select::make('bank_card_to')->required()->label('رقم البطاقة')
                ->options(BankCard::all()->pluck('numder', 'id'))
                ->searchable(),
                 
                TextInput::make('note')->required()->name('ملاحظة')->columnSpan(2),

            ])->columns(4),
          
        ]);

        
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('deportationsTo.name'),
             TextColumn::make('confirmFrom.name'),
             TextColumn::make('note'),  
            TextColumn::make('bankCard.numder')->searchable(),  
            TextColumn::make('user.name'),  
           
            IconColumn::make('confirmation')
->icon(fn (string $state): string => match ($state) {
    '1' => 'heroicon-o-check-badge',
    '0' => 'heroicon-o-clock',
})->color(fn (string $state): string => match ($state) {
     '0' => 'warning',
    '1' => 'success',
 })

])->bulkActions([])
            ->filters([
                //
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
