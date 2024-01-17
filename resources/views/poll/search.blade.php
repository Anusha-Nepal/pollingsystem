<<h1>Poll Search Results</h1>
@foreach ($polls as $poll)
    <div>
        <h3>{{ $poll->title }}</h3>
        <p>Start Date: {{ $poll->start_date }}</p>
        <p>End Date: {{ $poll->end_date }}</p>
    </div>
@endforeach


<h1>Poll Search Results by creator</h1>
@foreach ($users as $user)
    <div>
        <h3>{{ $user->name }}</h3>
    </div>

@endforeach 
{{-- <h1>Poll Search Results by date</h1>
@foreach ($start_dates as $start_date)
    <div>
        <h3>{{ $start_date->name }}</h3>
    </div>

@endforeach  --}}