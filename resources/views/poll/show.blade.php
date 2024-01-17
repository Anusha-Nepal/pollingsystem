
    <div class="container">
        <h2>Polls You Have Voted On</h2>

        @if($votedPolls->isEmpty())
            <p>You haven't voted on any polls yet.</p>
        @else
            <ul>
                @foreach($votedPolls as $vote)
                    <li>
                        You voted on the poll "{{ $vote->poll->title }}" - 
                        <a href="{{ route('poll.show', ['id' => $vote->poll->id]) }}">Details</a>
                        <a href="{{ route('poll.results', $poll->id) }}">View Results</a>
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>

