<html>
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            max-width: 800px;
            margin: 50px auto; }

        h2 {
            color: #3490dc;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #3490dc;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #3490dc;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2077c8;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            transition: box-shadow 0.3s ease;
        }

        li:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn {
            display: inline-block;
            background-color: #3490dc;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2077c8;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            li {
                padding: 10px;
            }

            .btn {
                padding: 8px 16px;
            }

            form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="{{ route('poll.search') }}" method="GET">
            <div>
            <label for="poll_name">Search polls:</label>
            <input type="text" id="poll_name" name="poll_name" placeholder="Search polls" required>
            </div>
            <div>
            <label for="creator_name">Search by users:</label>
            <input type="text" id="creator_name" name="creator_name" placeholder="Search by users" required>
         </div>
            <div>
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" placeholder="Start Date">
            </div>

            <div>
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" placeholder="End Date">
            </div>

            <button type="submit" name="search">Search</button>
        </form>

        <h2>List of Polls</h2>

        <ul>
            @foreach($polls as $key=>$poll)
                <div>
                   {{++$key}}.Created by: {{ $poll->user->name ?? 'Unknown Creator' }}
                </div>
                <li>
                    <div>
                        <a href="{{ route('vote.form',["pollId"=>$poll->id]) }}" target="_blank" rel="noopener noreferrer">url</a>
                    </div>
                    <p>
                        <strong>Title:</strong> {{ $poll->title }}<br>
                        <strong>Description:</strong> {{ $poll->description }}<br>
                        <strong>Start Date:</strong> {{ $poll->start_date_with_time }}<br>
                        <strong>End Date:</strong> {{ $poll->end_date_with_time }}
                    </p>
                    <a href="{{ route('poll.delete', ['id' => $poll->id]) }}" class="btn btn-primary">Delete</a>
                    <a href="{{ route('poll.edit', ['id' => $poll->id]) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('vote.form', ['pollId' => $poll->id]) }}" class="btn btn-primary">Vote on Poll</a>
                </li>
            @endforeach
        </ul>

        <div class="pagination">
            @if ($polls->onFirstPage())
                <span>&laquo; Previous</span>
            @else
                <a href="{{ $polls->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
            @endif

            @if ($polls->hasMorePages())
                <a href="{{ $polls->nextPageUrl() }}" rel="next">Next &raquo;</a>
            @else
                <span>Next &raquo;</span>
            @endif
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>
</body>
</html>
