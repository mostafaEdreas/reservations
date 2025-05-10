@extends('layouts.client')

@section('content')
<div class="container">
    <h1>Create Reservation</h1>



    <form action="{{ route('client.reservations.store' , $service->id) }}" method="POST">
        @csrf
        {{-- Show Service Name --}}
        <div class="form-group">
            <label>Service Name</label>
            <input type="text" class="form-control" value="{{ $service->name }}" readonly>
        </div>
        
        {{-- Reservation Date --}}
        <div class="form-group">
            <label>Reservation Date</label>
            <input type="datetime-local" name="reservation_date" class="form-control" value="{{ old('reservation_date') }}">
        </div>

        <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
</div>
@endsection
