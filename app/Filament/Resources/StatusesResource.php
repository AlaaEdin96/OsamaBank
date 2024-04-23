<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatusesResource\Pages;
use App\Filament\Resources\StatusesResource\RelationManagers;
use App\Models\Statuses;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusesResource extends Resource
{
    protected static ?string $model = Statuses::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'ادمن';
    protected static ?string $pluralModelLabel = "الحالات";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('statuses')->required()->label('الحالة')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#ID'),
                TextColumn::make('statuses')->label('الحالة'),
                TextColumn::make('user.name')->label('المدخل'),
                TextColumn::make('created_at'),
            ])
            //->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
     
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                  //  Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStatuses::route('/'),
            //'create' => Pages\CreateStatuses::route('/create'),
         //   'edit' => Pages\EditStatuses::route('/{record}/edit'),
        ];
    }
}
