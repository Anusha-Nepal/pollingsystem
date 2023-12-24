<div class="container">
    <h2>Create a New Poll</h2>

    <form method="POST" action="{{ route('poll.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="choices">Choices (one per line):</label>
            <textarea name="choices" id="choices" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Poll</button>
    </form>

    <a href="{{ route('poll.index') }}" class="btn btn-primary">Back to Polls</a>
</div>
