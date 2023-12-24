
    <div class="container">
        <h2>{{ $poll->title }}</h2>
        <p>{{ $poll->description }}</p>
        <p>Number of Votes: {{ $votes }}</p>
        
        <form method="POST" action="{{ route('choice.store', $poll->id) }}">
            @csrf
            <div class="form-group">
                <label for="choice">Add Choice:</label>
                <input type="text" name="text" id="choice" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Choice</button>
        </form>

        
        <h3>Choices:</h3>
        <ul>
            @forelse ($poll->choices as $choice)
                <li>{{ $choice->text }}</li>
            @empty
                <p>No choices available for this poll.</p>
            @endforelse
        </ul>

        <form method="POST" action="{{ route('poll.vote', $poll->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary">Vote</button>
        </form>
        <a href="{{ route('choice.index', $poll->id) }}" class="btn btn-success">View Choices</a>
        <a href="{{ route('poll.index') }}" class="btn btn-primary">Back to Polls</a>
    </div>

