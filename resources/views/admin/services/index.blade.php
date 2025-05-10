@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Services List</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Add New Service</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
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
                    @if( $service->status) 
                        <span class="badge badge-pill badge-success">Active</span>
                    @else
                        <span class="badge badge-pill badge-warning">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <!-- Delete form -->
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')">Delete</button>
                    </form>
                    <form action="{{ route('admin.services.change-status', $service->id) }}" method="POST" style="display:inline;">
                        @csrf @method('patch')
                        <button class="btn btn-sm btn-{{ $service->status ? 'warning' : 'info' }}" onclick="return confirm('change this service status?')">{{ $service->status ? 'Unactive' : 'active' }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
