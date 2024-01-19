<!DOCTYPE html>
<html>

<head>
    <title>Xceltec</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        .active {
            color: blue !important;
        }
    </style>
</head>



<body>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('developer.js') }}"></script>
    @if (session('token'))
    <?php $displayName = session('first_name') . " " . session('last_name') ?>
    <?php $user_id = session('user_id') ?? 0 ?>
    <?php $userType = session('user_type') ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard | {{$userType =='user' ? $displayName : $userType }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                @if (session('user_type')=="admin")
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">UserList</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('registration') ? ' active' : '' }}" href="{{ route('registration') }}">Registration Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('technology') ? ' active' : '' }}" href="{{ route('technology') }}">Technology Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('technologies.index') ? ' active' : '' }}" href="{{ route('technologies.index') }}">Go to Technologies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->routeIs('map') ? ' active' : '' }}" href="{{ route('map') }}">Map Report</a>
                    </li>
                </ul>

                @endif
                <div class="ms-auto">
                    @if (session('user_type')=="user")
                    <a class="btn btn-primary text-white" style="border-radius: 0%; border: none" href="{{ route('userEdit', ['id' => $user_id]) }}">Profile</a>
                    @endif
                    <a class="btn btn-danger text-white" style="border-radius: 0%; background: red; border: none" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    @endif