<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poll Results</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3490dc;
            color: #fff;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        ul li ul {
            margin-top: 5px;
            margin-left: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>

<body>

    @foreach($allResults as $key=>$result)
    <h1>{{++$key}}. Results for {{ $result['poll']->title }}</h1>

    <p>Description:{{ $result['poll']->description }}</p>

    <table>
        <thead>
            <tr>
                <th>Choice</th>
                <th>Votes</th>
                <th>Voters</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result['choices'] as $choice)
            <tr>
                <td>{{ $choice->text }}</td>
                <td>{{ $result['votes']->where('choice_id', $choice->id)->count() }}</td>
                <td>
                    @foreach($result['votes']->where('choice_id', $choice->id) as $vote)
                    <li>
                        @if($vote->voter)
                            {{ $vote->voter->name }} 
                        @endif
                            {{ $vote->user->name }} ({{ $vote->user->email }})
                    </li>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endforeach
    <a href="{{ route('export') }}" class="btn btn-primary">download the excel file</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    <a href="{{ route('poll.pie_chart_results') }}" class="btn btn-primary">reports</a>

    {{-- <div class="pagination">
        @if ( $allResults->onFirstPage())
            <span>&laquo; Previous</span>
        @else
            <a href="{{ $allResults->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
        @endif
    
        @if ($allResults->hasMorePages())
            <a href="{{ $allResults->nextPageUrl() }}" rel="next">Next &raquo;</a>
        @else
            <span>Next &raquo;</span>
        @endif
    --}}
    {{-- <div class="mt-4">
        {{ $allResults->links('pagination::simple-bootstrap-4') }}
    </div> --}}
    </div>
</body>

</html>
