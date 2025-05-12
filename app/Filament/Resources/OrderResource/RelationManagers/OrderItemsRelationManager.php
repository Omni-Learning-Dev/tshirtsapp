<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Product;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    protected static ?string $recordTitleAttribute = 'product_name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->options(Product::pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $product = Product::find($state);
                            $set('product_name', $product->name);
                            $set('price', $product->price);
                            $set('subtotal', $product->price * 1); // Default quantity is 1
                        }
                    }),

                Forms\Components\TextInput::make('product_name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->default(1)
                    ->minValue(1)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $price = $get('price');
                        $set('subtotal', $price * $state);
                    }),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('ZWL $')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $quantity = $get('quantity');
                        $set('subtotal', $state * $quantity);
                    }),

                Forms\Components\TextInput::make('subtotal')
                    ->numeric()
                    ->required()
                    ->prefix('ZWL $')
                    ->disabled(),

                Forms\Components\KeyValue::make('options')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('ZWL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtotal')
                    ->money('ZWL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('options')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        // Calculate the subtotal
                        $data['subtotal'] = $data['price'] * $data['quantity'];
                        return $data;
                    })
                    ->after(function ($record, $livewire) {
                        // Recalculate order totals
                        $this->recalculateOrderTotals($livewire);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function ($record, $livewire) {
                        // Recalculate order totals
                        $this->recalculateOrderTotals($livewire);
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($record, $livewire) {
                        // Recalculate order totals
                        $this->recalculateOrderTotals($livewire);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function ($livewire) {
                            // Recalculate order totals
                            $this->recalculateOrderTotals($livewire);
                        }),
                ]),
            ]);
    }

    // Helper method to recalculate order totals when items change
    protected function recalculateOrderTotals($livewire)
    {
        $order = $livewire->getOwnerRecord();

        // Calculate the new subtotal based on order items
        $subtotal = $order->orderItems->sum('subtotal');
        $order->subtotal = $subtotal;

        // Keep the shipping and tax values
        // Then recalculate the total
        $order->total = $order->subtotal + $order->shipping + $order->tax;
        $order->save();

        // Refresh the form
        $livewire->refresh();
    }
}
