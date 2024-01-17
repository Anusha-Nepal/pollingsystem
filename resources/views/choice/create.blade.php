<div class="container">
    <h2>Create a New Choice for "{{ $poll->title }}"</h2>
    <form method="POST" action="{{ route('choice.store', $poll->id) }}">
        @csrf
        <div class="form-group">
            <label for="text">Choice Text:</label>
            <input type="text" name="text" id="text" class="form-control" required>
        </div> 

        <div class="form-group">
            <label>Choose from the following options:</label>

            @foreach ($choices as $choice)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="selected_choices[]" value="{{ $choice->id }}">
                    <label class="form-check-label">{{ $choice->text }}</label>
                </div>
                
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Create Choice</button>
    </form>
    <a href="{{ route('poll.show', $poll->id) }}" class="btn btn-primary">Back to Poll</a>
</div> 