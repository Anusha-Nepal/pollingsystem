<form method="POST" action="{{ route('poll.delete', $poll->id) }}">
    @csrf
    <input type="hidden" name="_method" value="DELETE">

    <button type="submit">Delete Poll</button>
</form>
