<?php

namespace App\Filament\Resources\ImagesRelationManagerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';
    protected static ?string $recordTitleAttribute = 'image_path';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_path')
                    ->label('Image')
                    ->image()
                    ->required()
                    ->directory('products/' . $this->getOwnerRecord()->slug)
                    ->visibility('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1'),

                Forms\Components\Toggle::make('is_primary')
                    ->label('Primary Image')
                    ->default(false)
                    ->helperText('Set as the main product image')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set, RelationManager $livewire) {
                        if ($state) {
                            // Get the related model name from the relation manager
                            $model = $livewire->getRelationship()->getRelated();
                            // Reset any other primary images
                            $model::where('product_id', $this->getOwnerRecord()->id)
                                ->where('is_primary', true)
                                ->update(['is_primary' => false]);
                        }
                    }),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->square(),

                Tables\Columns\IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        // Add the product ID if it's a new record
                        $data['product_id'] = $this->getOwnerRecord()->id;
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->defaultSort('is_primary', 'desc');
    }
}
