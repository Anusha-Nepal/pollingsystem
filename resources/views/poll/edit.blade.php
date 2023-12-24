


    <div class="container">
        <h2>Edit Poll</h2>
        <form method="POST" action="{{ route('poll.update', $poll->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $poll->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ $poll->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Poll</button>
        </form>
        <a href="{{ route('poll.index') }}" class="btn btn-secondary">Cancel</a>
    </div>

