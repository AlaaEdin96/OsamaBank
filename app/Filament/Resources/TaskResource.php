<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\BankAccount;
use App\Models\Deportations;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
 use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
 use Illuminate\Support\Facades\Auth;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;
   
   // protected static ?string $label = 't';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = "المهام اليوميه";

    public static function form(Form $form): Form
    {
        return $form
        ->schema([        
             Select::make('bank_account_id')->required()->label('الحساب')
             ->options(BankAccount::all()->pluck('name', 'id'))
             ->searchable(),
             Select::make('statuses_old')->required()->label('الحالة')
             ->options([
                 'تم التسجيل' => 'تم التسجيل',
                 'مطابق' => 'مطابق',
                 'توكيل' => 'توكيل',
                 'غير مطابق' => 'غر مطابق',
                 'قيد التنفيد' => 'قيد التنفيد',
                 'تم التنفيد' => 'تم التنفيد',
                 
             ])->columnSpanFull()
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table   
        ->columns([
            TextColumn::make('user.name')->label('تاكيد من'),
            TextColumn::make('statuses_old')->label('الحالة القديمة')->badge(),
            TextColumn::make('bankAccount.name')->searchable()->label('حساب'),  
            TextColumn::make('statuses_now')->label('الحالة الجديدة')->badge(),
            SpatieMediaLibraryImageColumn::make('avatar')->collection('avatars')->circular(),
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
            ])
            
            ->actions([Tables\Actions\Action::make('Confirm')
            ->form([
                SpatieMediaLibraryFileUpload::make('attachment')
    ->image()
    ->multiple()
    ->collection('avatars')
    ->optimize('webp')
    ->imageEditor()
    ->reorderable()
   // ->deletable(false)
   //->maxSize(680)
    ->openable()
    ->uploadingMessage('Uploading attachment...')
    ->maxFiles(5)
    ->resize(50),
                
             Select::make('statuses_now')->required()->label('الحالة')
             ->options([
                 'تم التسجيل' => 'تم التسجيل',
                 'مطابق' => 'مطابق',
                 'توكيل' => 'توكيل',
                 'غير مطابق' => 'غر مطابق',
                 'قيد التنفيد' => 'قيد التنفيد',
                 'تم التنفيد' => 'تم التنفيد',
                 'الرقم الوطني غير مربوط' => 'الرقم الوطني غير مربوط',
                 'خطاء' => 'خطاء',

                 
             ])])->action(function( Task $st,array $data){
                $st->update([
                    'confirmation'=>true,
                    'statuses_now'=>$data['statuses_now'],
                    'confirmation_by_user_id'=>Auth::id()
                ]); 
              BankAccount::find($st->bank_account_id)->update(['statuses'=>$data['statuses_now'],]); 
            
        })
            ->disabled(fn (Task $st)=> $st->confirmation) ,             
               
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }
}
