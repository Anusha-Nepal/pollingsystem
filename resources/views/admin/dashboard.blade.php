<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            background-color: #007bff;
            padding: 10px;
            text-align: left; 
            display: flex;
            justify-content: flex-start; 
            align-items: center; 
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        .navbar a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @if(Session::has('error'))
        <p>{{ Session::get('error') }}</p>
    @endif
    @if(Session::has('sucess'))
    <p>{{ Session::get('sucess') }}</p>
@endif

    <div class="navbar">
        <a href="{{ route('admin.dashboard') }}">Home</a>
        <a href="{{ route('poll.results') }}">View Poll Results</a>
        <a href="{{ route('admin.users_roles') }}"> Assign roles and  Permissions</a>
        {{-- <a href="{{ route('admin.roles_permissions') }}">create Roles</a> --}}
        
        <form method="POST" action="{{ route('logout') }}" style="margin-left: auto;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Welcome, {{ Auth::user()->name }}!</h1>
                <h3>Total Users: {{ $totalUsers }}</h3>
                <h3>Total Polls: {{ $totalPolls }}</h3>
                {{-- @include('admin.roles_permissions')
                @include('admin.users_roles') --}}
            </div>
        </div>
    </div>
</body>

</html>
