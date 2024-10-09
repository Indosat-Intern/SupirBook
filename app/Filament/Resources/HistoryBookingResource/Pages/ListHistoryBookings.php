<?php

namespace App\Filament\Resources\HistoryBookingResource\Pages;

use App\Filament\Resources\HistoryBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistoryBookings extends ListRecords
{
    protected static string $resource = HistoryBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
