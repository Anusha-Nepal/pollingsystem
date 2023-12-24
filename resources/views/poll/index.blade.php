
    <div class="container">
        <h2>List of Polls</h2>
        <ul>
            @foreach($polls as $poll)
                <li>{{ $poll->title }} - {{ $poll->description }}</li>
            @endforeach
        </ul>
        <a href="{{ route('poll.create') }}" class="btn btn-primary">Create Poll</a>
    </div>