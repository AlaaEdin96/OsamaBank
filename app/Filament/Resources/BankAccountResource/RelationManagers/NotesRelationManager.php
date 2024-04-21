<?php

namespace App\Filament\Resources\BankAccountResource\RelationManagers;

use App\Models\BankAccount;
use App\Models\BankCard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class NotesRelationManager extends RelationManager
{
  
    protected static string $relationship = 'Notes';
 
    protected static ?string $badge = 'new';

    protected static ?string $badgeColor = 'success';


    protected static ?string $title = 'ملاحظات';





    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('content')->label('الوصف')
                    ->required()
                    ->maxLength(255),
                    // Forms\Components\TextInput::make('user_id')->extraAttributes(
                    //     fn ($state): array => ['user_id' => Auth::id()]
                    // ),     
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('content'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
