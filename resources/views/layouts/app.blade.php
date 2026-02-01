<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <h2 style="text-align:center">User Management System</h2>
    <hr>

    @if(session('success'))
        <p style="color:green; text-align:center;">
            {{ session('success') }}
        </p>
    @endif

    <div style="width:60%; margin:auto;">
        @yield('content')
    </div>

</body>
</html>
