<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductImageResource\Pages;
use App\Models\ProductImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductImageResource extends Resource
{
    protected static ?string $model = ProductImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 2;

    // Only show in navigation if needed - you might want to manage images
    // only through the product relation
    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'product_name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\FileUpload::make('image_path')
                    ->label('Image')
                    ->image()
                    ->required()
                    ->directory(function (Forms\Get $get) {
                        $productId = $get('product_id');
                        $product = \App\Models\Product::find($productId);
                        return $product ? 'products/' . $product->slug : 'products';
                    })
                    ->visibility('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1'),

                Forms\Components\Toggle::make('is_primary')
                    ->label('Primary Image')
                    ->default(false)
                    ->helperText('Set as the main product image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.product_name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->square(),

                Tables\Columns\IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductImages::route('/'),
            'create' => Pages\CreateProductImage::route('/create'),
            'edit' => Pages\EditProductImage::route('/{record}/edit'),
//            'view' => Pages\ViewProductImage::route('/{record}'),
        ];
    }
}
