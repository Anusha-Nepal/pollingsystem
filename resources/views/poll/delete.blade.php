<div class="container">
    <h2>Delete Poll</h2>

    <p>Are you sure you want to delete the poll "{{ $poll->title }}"?</p>

    <form action="{{ route('poll.delete', $poll->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Soft Delete</button>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Cancel</a>
    </form>
</div>
