
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
@csrf
                    <div class="card-body">
                        <h5>Welcome, {{ Auth::user()->name }}!</h5>

                        <div class="mb-3">
                            <h6>Create a New Poll:</h6>
                            <form method="POST" action="{{ route('poll.create') }}">
                                @csrf
                                <label for="poll-title">Poll Title:</label>
                                <input type="text" id="poll-title" name="title" required>
                                <button type="submit" class="btn btn-primary">Create Poll</button>
                            </form>
                        </div>

                        

                     
                        <div class="mb-3">
                            <h6>Your Polls:</h6>
                            <ul>
                                @foreach($userPolls as $poll)
                                    <li>{{ $poll->title }} - <a href="{{ route('poll.show', $poll->id) }}">View</a> | <a href="{{ route('poll.edit', $poll->id) }}">Edit</a> | <a href="{{ route('poll.delete', $poll->id) }}">Delete</a></li>
                                @endforeach
                            </ul>
                        </div>

                       
                        <div class="mb-3">
                            <h6>Your Voting History:</h6>
                            <ul>
                                @foreach($votingHistory as $vote)
                                    <li>You voted on the poll "{{ $vote->poll->title }}" - <a href="{{ route('poll.show', $vote->poll->id) }}">Details</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>