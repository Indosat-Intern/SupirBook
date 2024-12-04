<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Filament\Exports\BookingExporter;
use App\Services\WhatsAppNotificationService; // Import the WhatsAppNotificationService
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Booking';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->disabled()
                    ->required(),
                Forms\Components\Select::make('driver_id')
                    ->relationship('driver', 'name')
                    ->disabled()
                    ->required(),
                Forms\Components\DateTimePicker::make('booking_datetime')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('destination')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('pickup_location')
                    ->disabled()
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'pending' => 'Pending',
                        'done' => 'Done',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('driver.name')
                    ->label('Driver Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking_datetime')
                    ->label('Booking Datetime')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('destination')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pickup_location')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                        'info' => 'done',
                    ])
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->label('Confirm')
                    ->icon('heroicon-o-check-circle')
                    ->action(function (Booking $record, WhatsAppNotificationService $whatsAppService) {
                        // Send WhatsApp notification on confirmation
                        if ($record->status === 'pending') {
                            $record->status = 'confirmed';
                            $record->save();

                            // Send the WhatsApp notification to the driver
                            $driver = $record->driver;
                            $message = "Your booking has been confirmed!\n"
                                . "Destination: " . $record->destination . "\n"
                                . "Pickup Location: " . $record->pickup_location . "\n"
                                . "Date and Time: " . $record->booking_datetime . "\n"
                                . "Passengers: " . $record->passenger;
                            
                            try {
                                $whatsAppService->sendWhatsAppMessage('+6289526310302wwww', $message);
                            } catch (\Exception $e) {
                                // Handle the exception
                                throw new \Exception('Failed to send WhatsApp notification.');
                            }
                        }
                    })
                    ->requiresConfirmation(), // You can add a confirmation modal before sending the WhatsApp message
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Export All Bookings')
                    ->exporter(BookingExporter::class),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
                    ->exporter(BookingExporter::class)
                    ->label('Export Selected'),
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
            'index' => Pages\ListBookings::route('/'),
        ];
    }
}
