<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;
use App\Mail\OrderReceipt;
use Illuminate\Support\Facades\Mail;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('printInvoice')
                ->label('Print Invoice')
                ->icon('heroicon-o-printer')
                ->url(fn ($record) => route('invoice.print', $record))
                ->openUrlInNewTab(),

            Actions\Action::make('downloadInvoice')
                ->label('Download Invoice')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn ($record) => route('invoice.download', $record))
                ->openUrlInNewTab(),

            Actions\Action::make('emailReceipt')
                ->label('Email Receipt')
                ->icon('heroicon-o-envelope')
                ->action(function ($record) {
                    Mail::to($record->email)
                        ->queue(new OrderReceipt($record));

                    // Use the correct notification method
                    Notification::make()
                        ->title('Receipt Emailed')
                        ->body("Receipt has been emailed to {$record->email}")
                        ->success()
                        ->send();
                }),

            Actions\DeleteAction::make(),
        ];
    }
}
