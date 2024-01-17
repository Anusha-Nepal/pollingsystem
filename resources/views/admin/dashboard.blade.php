
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            margin-top: 50px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        h1 {
            color: #343a40;
            margin-bottom: 20px;
        }

        .card {
            margin-top: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-logout {
            margin-top: 10px;
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }

        .btn-view-poll {
            background-color: #007bff;
            color: #fff;
        }

        .btn-view-poll:hover {
            background-color: #0056b3;
        }

        .pagination {
            margin-top: 20px;
        }

        .btn-info {
            background-color: #17a2b8;
            color: #fff;
            margin-top: 10px;
        }

        .btn-info:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        
    
        <div class="card">
            <div class="card-body">
                <h3>Total Users: {{ $totalUsers }}</h3>
                <h3>Total Polls: {{ $totalPolls }}</h3>
    
                <h3>Poll Results:</h3>
                @foreach($polls as $poll)
                    <div class="mt-4">
                        <h4>{{ $poll->title }}</h4>
                        <p>Total Votes: {{ $poll->votes->count() }}</p>
    
                        <ul>
                            @foreach($poll->votes as $vote)
                                <li>{{ $vote->user->name }} ({{ $vote->user->email }})</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

                <!-- Display pagination links with previous and next buttons -->
                <div class="mt-4">
                    {{ $polls->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        
            <div class="mt-4">
                <a href="{{ route('admin.poll.results', ['pollId' => $poll->id]) }}" class="btn btn-info">View Poll Results</a>
            </div>

            @include('admin.roles_permissions')
            @include('admin.users_roles')

            <form action="{{ route('admin.logout') }}" method="post" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-danger btn-logout">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>