@extends('layouts.client')

@section('content')
<div class="container">
    <h1>Reservations</h1>



    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Service</th>
                <th>User</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->service?->name ?? '-' }}</td>
                    <td>{{ $reservation->user?->name ?? '-' }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->status_text  }}</td>
                    <td>
                        <a href="{{ route('client.reservations.edit', $reservation->id) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('client.reservations.cancel', $reservation->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('patch')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">CANCEL</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No reservations found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
