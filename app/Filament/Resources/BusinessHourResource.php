<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessHourResource\Pages;
use App\Filament\Resources\BusinessHourResource\RelationManagers;
use App\Models\BusinessHour;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusinessHourResource extends Resource
{
    protected static ?string $model = BusinessHour::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('day_of_week')
                    ->options([
                        0 => 'Sunday',
                        1 => 'Monday',
                        2 => 'Tuesday',
                        3 => 'Wednesday',
                        4 => 'Thursday',
                        5 => 'Friday',
                        6 => 'Saturday',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('open_time')
                    ->seconds(false)
                    ->hidden(fn (callable $get) => $get('is_closed'))
                    ->required(),
                Forms\Components\TimePicker::make('close_time')
                    ->seconds(false)
                    ->hidden(fn (callable $get) => $get('is_closed'))
                    ->required(),
                Forms\Components\Toggle::make('is_closed')
                    ->label('Closed')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day_of_week')
                    ->formatStateUsing(fn (int $state): string => [
                        0 => 'Sunday',
                        1 => 'Monday',
                        2 => 'Tuesday',
                        3 => 'Wednesday',
                        4 => 'Thursday',
                        5 => 'Friday',
                        6 => 'Saturday',
                    ][$state])
                    ->sortable(),
                Tables\Columns\TextColumn::make('open_time')
                    ->time(),
                Tables\Columns\TextColumn::make('close_time')
                    ->time(),
                Tables\Columns\IconColumn::make('is_closed')
                    ->boolean(),
            ])
            ->defaultSort('day_of_week')
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBusinessHours::route('/'),
            'create' => Pages\CreateBusinessHour::route('/create'),
            'edit' => Pages\EditBusinessHour::route('/{record}/edit'),
        ];
    }
}
