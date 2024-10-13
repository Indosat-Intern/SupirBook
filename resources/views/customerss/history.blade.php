@extends('layouts.layout')

@section('title', 'SupirBook - Your Booking')

@section('content')
    <h2>Riwayat Booking</h2>
    <div class="history-table-container">
        @if ($bookings->isEmpty())
            <p>You have no booking history.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tujuan</th>
                        <th>Titik Jemput</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Divisi</th>
                        <th>No Telepon</th>
                        <th>Jumlah Penumpang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td data-label="Nama">{{ $booking->customer->name }}</td>
                            <td data-label="Tujuan">{{ $booking->destination }}</td>
                            <td data-label="Titik Jemput">{{ $booking->pickup_location }}</td>
                            <td data-label="Tanggal Keberangkatan">{{ $booking->booking_datetime }}</td>
                            <td data-label="Divisi">{{ $booking->customer->division }}</td>
                            <td data-label="No Telepon">{{ $booking->customer->phone }}</td>
                            <td data-label="Jumlah Penumpang">{{ $booking->passenger }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
