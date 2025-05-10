@extends('layouts.client')

@section('content')
<div class="container">
    <h2>Services List</h2>
 

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->price }}</td>
                <td>
                    <a href="{{ route('client.reservations.create', $service->id) }}" class="btn btn-sm btn-primary">reserve</a>
                    <!-- Delete form -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
