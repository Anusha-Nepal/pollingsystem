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


        .chart-container {
            width: 200px;
            height: 200px; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    @foreach($allResults as $result)
    <h1>Results for {{ $result['poll']->title }}</h1>

    <p>Description:{{ $result['poll']->description }}</p>

    <div class="chart-container">
        <canvas id="chart-{{ $result['poll']->id }}"></canvas>
    </div>

    <ul>
        @foreach($result['choices'] as $choice)
        <li>
            {{ $choice->text }}: {{ $result['votes']->where('choice_id', $choice->id)->count() }} votes
            @if($result['votes']->where('choice_id', $choice->id)->count() > 0)
            <ul>
                @foreach($result['votes']->where('choice_id', $choice->id) as $vote)
                <li>
                    @if($vote->voter)
                        {{ $vote->voter->name }} voted
                    @endif

                    <ul>
                        <li>{{ $vote->user->name }} ({{ $vote->user->email }})</li>
                    </ul>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>

    @endforeach

    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>

    <script>
 
        @foreach($allResults as $result)
        var ctx = document.getElementById('chart-{{ $result['poll']->id }}').getContext('2d');
        var data = {
            labels: @json($result['choices']->pluck('text')),
            datasets: [{
                data: @json($result['choices']->map(function($choice) use($result) {
                    return $result['votes']->where('choice_id', $choice->id)->count();
                })),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                ],
            }],
        };
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
        });
        @endforeach
    </script>

</body>

</html>
