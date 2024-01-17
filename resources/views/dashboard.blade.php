<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user dashboard</title>
    <h1>Welcome to the Polling App</h1>

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

        /* Navigation bar styles */
        .navbar {
            background-color: #007bff;
            padding: 10px;
            text-align: center;
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
    <h5>Welcome, {{ Auth::user()->name }}!</h5>
</head>

<body>
    @if(Session::has('error'))
<p >{{ Session::get('error') }}</p>
@endif
    <div class="navbar">
        <a href="#">Home</a>
        <a href="{{ route('poll.create') }}">Create Poll</a>
        
       <a href ="{{route('poll.index')}}"> Polls</a>

       {{-- <a href="{{ route('dashboard.voted-polls') }}">Voted Polls</a> --}}

        <form method="POST" action="{{ route('logout') }}" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
                                            
                                            
</div>
 </div>
</div>
</body>

</html>

    

    
