@extends('layouts.layout')

@section('title', 'SupirBook - Your Booking')

@section('content')
    <h2>Riwayat Booking</h2>
    <div class="history-table-container">
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @if ($bookings->isEmpty())
            <p>You have no booking history.</p>
        @else
            <table>
                <thead>
                    <tr>
                        {{-- <th>Nama</th> --}}
                        <th>Tujuan</th>
                        <th>Titik Jemput</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Divisi</th>
                        <th>No Telepon</th>
                        <th>Jumlah Penumpang</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Action Button</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            {{-- <td data-label="Nama">{{ $booking->customer->name }}</td> --}}
                            <td data-label="Tujuan">{{ $booking->destination }}</td>
                            <td data-label="Titik Jemput">{{ $booking->pickup_location }}</td>
                            <td data-label="Tanggal Keberangkatan">{{ $booking->booking_datetime }}</td>
                            <td data-label="Divisi">{{ $booking->customer->division }}</td>
                            <td data-label="No Telepon">{{ $booking->customer->phone }}</td>
                            <td data-label="Jumlah Penumpang">{{ $booking->passenger }}</td>
                            <td data-label="Catatan">{{ $booking->note }}</td>
                            <td data-label="Status">{{ $booking->status }}</td>
                            <td data-label="Action Button">
                                @if ($booking->status === 'confirmed')
                                    <form action="{{ route('booking.done', $booking->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit"
                                            style="text-align: center; display: block; margin-top: 10px;">Done</button>
                                    </form>
                                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit"
                                            style="text-align: center; display: block; margin-top: 10px;">Cancel</button>
                                    </form>
                                @else
                                    <button disabled
                                        style="text-align: center; display: block; margin-top: 10px; color: gray;">Done</button>
                                    <button disabled
                                        style="text-align: center; display: block; margin-top: 10px; color: gray;">Cancel</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection