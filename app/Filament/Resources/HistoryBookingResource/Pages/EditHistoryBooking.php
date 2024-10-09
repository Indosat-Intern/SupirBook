<?php

namespace App\Filament\Resources\HistoryBookingResource\Pages;

use App\Filament\Resources\HistoryBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryBooking extends EditRecord
{
    protected static string $resource = HistoryBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
