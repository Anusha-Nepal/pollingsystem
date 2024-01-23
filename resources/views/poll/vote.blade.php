
<html>
    <head>
     
        <style>
            .container {
                max-width: 600px;
                margin: auto;
                padding: 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }

            select {
                width: 100%;
                padding: 10px;
                font-size: 16px;
            }

            button {
                display: inline-block;
                padding: 10px 20px;
                font-size: 18px;
                background-color: #007bff;
                color: #fff;
                border: none;
                cursor: pointer;
            }

            button:hover {
                background-color: #0056b3;
            }

            .btn-secondary {
                margin-left: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Vote on Poll: {{ $poll->title }}</h2>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
@php
  use Carbon\Carbon;  
@endphp
            @if(!$userHasVoted)
            @if($poll->end_date_with_time <= Carbon::now('Asia/Kathmandu'))
            <p>This poll has already expired on {{ $poll->end_date_with_time }}. You cannot vote on it anymore.</p>
        @else
            <p>End date and time of the poll: {{ $poll->end_date_with_time }}</p>
            <form method="POST" action="{{ route('vote.submit', ['pollId' => $poll->id]) }}">
                @csrf
        
                <div class="form-group">
                    <label for="choices">Select a choice</label>
                    <select name="choice" id="choices" class="form-control">
                        @foreach($choices as $choice)
                            <option value="{{ $choice->id }}">{{ $choice->text }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Vote</button>
            </form>
        @endif
        
            @else
                <p>You have already voted on this poll.</p>
            @endif

            <a href="{{ route('poll.index') }}" class="btn btn-secondary">Back to Polls</a>
        </div>
    </body>
</html>
