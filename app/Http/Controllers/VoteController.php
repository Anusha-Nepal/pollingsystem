<?php

namespace App\Http\Controllers;


use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(Request $request, $pollId)
    {
        $poll = Poll::findOrFail($pollId);

        // Check if the user has already voted on this poll
        if ($poll->votes()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('poll.index')->with('error', 'You have already voted on this poll.');
        }

        // Create a new vote for the authenticated user
        Vote::create([
            'user_id' => auth()->id(),
            'poll_id' => $poll->id,
        ]);

        return redirect()->route('poll.index')->with('success', 'Vote submitted successfully!');
    }
}

