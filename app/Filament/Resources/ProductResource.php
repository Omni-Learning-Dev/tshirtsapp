<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImagesRelationManagerResource\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Shop';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Product Information')
                    ->schema([
                        Forms\Components\TextInput::make('product_name')
                            ->required()
                            ->maxLength(255)
                            ->label('Product Name'),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01),

                        Forms\Components\Textarea::make('description')
                            ->rows(5)
                            ->maxLength(1000)
                            ->columnSpan('full'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Product Options')
                    ->schema([
                        Forms\Components\TagsInput::make('sizes')
                            ->placeholder('Add sizes')
                            ->helperText('Press Enter to add a size')
                            ->default(['S', 'M', 'L', 'XL', 'XXL']),

                        Forms\Components\TagsInput::make('colors')
                            ->placeholder('Add colors')
                            ->helperText('Press Enter to add a color')
                            ->default(['Black', 'White', 'Navy']),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sizes')
                    ->badge()
                    ->separator(',')
                    ->color('success'),

                Tables\Columns\TextColumn::make('colors')
                    ->badge()
                    ->separator(',')
                    ->color('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button(),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ImagesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'view' => Pages\ViewProduct::route('/{record}'),
        ];
    }

}
