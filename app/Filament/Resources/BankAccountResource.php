<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankAccountResource\Pages;
use App\Filament\Resources\BankAccountResource\RelationManagers;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Joshembling\ImageOptimizer\Components\SpatieMediaLibraryFileUpload;

class BankAccountResource extends Resource
{
    protected static ?string $model = BankAccount::class;
    protected static ?string $pluralModelLabel = "الحسابات المصرفية";
 
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'العمل';

    public static function form(Form $form): Form
    {

        return $form
->schema([
    Group::make()->schema([
        Section::make('بيانات شخصية ')
        ->headerActions([
            Action::make('طباعـــة')
            ->url( 
 
         fn ( $state): string => route('pdf',$state )
            )
            ->openUrlInNewTab()
        ])
    
        ->schema([
            TextInput::make('id')->label('#ID')
            ->readonly()->columnSpanFull()     ,
            TextInput::make('name')->required()->name('الاسم')->columnSpanFull(),
            TextInput::make('phone')->required()->name('الهاتف'),
            TextInput::make('numder_id')->required()->name('الرقم_الوطنى'),
            TextInput::make('id_card')->required()->name('رقم_جواز_السفر'),           
            
           Select::make('client_id')->required()->label('العميل')
          ->options(Client::all()->pluck('name', 'id'))
          ->searchable(),
            ])->columns(2),
         
         Section::make('بيانات البنك')->description('في حال لايوجد لديه حساب يرجى ترك المدخلات فارغة')
         ->schema([
            TextInput::make('account_number')->name('رقم_الحساب'),
            TextInput::make('iban_number')->name('الايبان'),

            Select::make('bank_id')->label('البنك')
            ->options(Bank::all()->pluck('name', 'id'))
             ->searchable(),
 
         ]),

         Section::make('بيانات التواصل')->schema([
            TextInput::make('email')->name('الايميل'),
            TextInput::make('phone_contact')->name('رقم_التواصل'),

         ]),
]),
Group::make([
    
])->schema([
Section::make('ملفات')->schema([
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
]),
// Section::make('ملاحظات')->schema([
//     Textarea::make('notes'),

//  ]),

])

        ]);





        

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#IDC'),
                TextColumn::make('name')->searchable()->label('الاسم'),
                TextColumn::make('statuses')->label('الحالة الجديدة')->badge(),

                SpatieMediaLibraryImageColumn::make('avatar')->collection('avatars')->label('الصور')

            ])->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('is_featured')
                ->label('Featured'),
                Filter::make('is_featured')
    ->query(fn (Builder $query): Builder => $query->where('name', true))
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
            RelationManagers\CardsRelationManager::class,
           // RelationManagers\StatusesRelationManager::class,
            RelationManagers\FinancesRelationManager::class,
            RelationManagers\NotesRelationManager::class,


        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankAccounts::route('/'),
            'create' => Pages\CreateBankAccount::route('/create'),
            'edit' => Pages\EditBankAccount::route('/{record}/edit'),
        ];
    }
}
