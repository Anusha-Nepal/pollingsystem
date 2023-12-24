 <div class="container">
        <h2>Choices for "{{ $poll->title }}"</h2>
        <ul>
            @forelse ($choices as $choice)
                <li>{{ $choice->text }}</li>
            @empty
                <p>No choices available for this poll.</p>
            @endforelse
        </ul>
        <a href="{{ route('poll.show', $poll->id) }}" class="btn btn-primary">Back to Poll</a>
    </div>
