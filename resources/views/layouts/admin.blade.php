<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel App') }}</title>

    {{-- Add Bootstrap 4.1 (since you use it) --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    {{-- Add your app CSS --}}
    @stack('styles')
</head>
<body>
    <form method="POST" id="logout" action="{{ route('logout') }}">
        @csrf
    </form>
    {{-- Navigation --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('admin/services') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.services.index') }}">Services</a>
                </li>
                <li class="nav-item {{ request()->is('admin/reservations') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.reservation.index') }}">Reservations</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"href="javascript:void(0)"> {{ auth()->user()->role ?? 'guest'}}</a>

                          <a class="dropdown-item"href="javascript:void(0)" onclick= "document.getElementById('logout').submit()">logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    {{-- Content --}}
    <main class="py-4 container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            {{-- Success Alert --}}
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </main>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    @stack('scripts')
</body>
</html>
