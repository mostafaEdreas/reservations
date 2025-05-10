@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Service</h1>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="{{ old('name', $service->name) }}" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $service->description) }}</textarea>
        </div>

        <!-- Price -->
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control" 
                   value="{{ old('price', $service->price) }}" step="0.01" required>
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ old('status', $service->status) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $service->status) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Service</button>
    </form>
</div>
@endsection
