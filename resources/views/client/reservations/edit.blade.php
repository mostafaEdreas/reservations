@extends('layouts.client')

@section('content')
<div class="container">
    <h1>Edit Reservation</h1>



    <form action="{{ route('client.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Show Service Name --}}
        <div class="form-group">
            <label>Service Name</label>
            <input type="text" class="form-control" value="{{ $reservation->service?->name }}" readonly>
        </div>

        {{-- Reservation Date --}}
        <div class="form-group">
            <label>Reservation Date</label>
            <input type="datetime-local" name="reservation_date" class="form-control"
                value="{{ old('reservation_date', date('Y-m-d\TH:i', strtotime($reservation->reservation_date))) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Reservation</button>
    </form>
</div>
@endsection
