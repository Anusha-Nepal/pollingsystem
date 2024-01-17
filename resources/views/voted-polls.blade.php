
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        color: #343a40;
    }

    .container {
        margin-top: 50px;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #3490dc;
        margin-bottom: 20px;
    }

    p {
        font-size: 16px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin-top: 10px;
    }

    li {
        margin-bottom: 15px;
        padding: 10px;
        background-color: #f1f1f1;
        border-radius: 4px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    a {
        text-decoration: none;
        color: #3490dc;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    .btn {
        background-color: #3490dc;
        color: #ffffff;
        text-decoration: none;
        padding: 8px 16px;
        margin-top: 20px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease-in-out;
    }

    .btn:hover {
        background-color: #2779bd;
    }

    .btn-primary {
        background-color: #3490dc;
    }
</style>

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
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>

