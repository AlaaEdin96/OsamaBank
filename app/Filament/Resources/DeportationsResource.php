<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeportationsResource\Pages;
use App\Filament\Resources\DeportationsResource\RelationManagers;
use App\Models\BankCard;
use App\Models\Deportations;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
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
                 Select::make('bank_card_id')->required()->label('رقم البطاقة')
                ->options(BankCard::all()->pluck('numder', 'id'))
                ->searchable(),
                 
                TextInput::make('note')->required()->name('ملاحظة'),

            ])->columns(3),
          
        ]);

        
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('deportationsTo.name'),
             TextColumn::make('confirmFrom.name'),
             TextColumn::make('note'),  
            TextColumn::make('bankCard.numder')->searchable()->label('رقم البطاقة'),  
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
                )->disabled(fn (Deportations $st)=> $st->confirmation) ,

                Tables\Actions\Action::make('modal')
                //->action(fn ( Deportations $st) =>null)
                ->form([
                    Select::make('authorId')
                        ->label('Author')
                        ->options(User::query()->pluck('name', 'id'))
                        ->required(),
                ])
                ->modalContent(

                    //fn ($record) => view('welcome', ['record' => $record])
                ),
                /////////////////////////////
                Tables\Actions\Action::make('create')
    ->steps([
        Step::make('Name')
            ->description('Give the category a unique name')
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str()->slug($state))),
                TextInput::make('slug')
                    ->disabled()
                    ->required()
                   // ->unique(Category::class, 'slug'),
            ])
            ->columns(2),
        Step::make('Description')
            ->description('Add some extra details')
            ->schema([
                MarkdownEditor::make('description'),
            ]),
        Step::make('Visibility')
            ->description('Control who can view it')
            ->schema([
                Toggle::make('is_visible')
                    ->label('Visible to customers.')
                    ->default(true),
            ]),
    ])

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
