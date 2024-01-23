<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class VoteController extends Controller
{
    public function showVoteForm($pollId)
    {
        
        $poll = Poll::findOrFail($pollId);
        $choices = Choice::where('polls_id', $pollId)->get(); 

        
        $userHasVoted = Vote::where('user_id', auth()->id())->where('polls_id', $pollId)->exists(); 

       
        return view('poll.vote', compact('poll', 'choices', 'userHasVoted'));
    }

    public function submitVote(Request $request, $pollId)
    {
       $poll = Poll::findOrFail($pollId);
        $userHasVoted = Vote::where('user_id', auth()->id())->where('polls_id', $pollId)->exists();
       
        if ($userHasVoted) {
            return redirect()->route('poll.index')->with('error', 'You have already voted on this poll.');
        }
        if ($poll->end_date_with_time <= Carbon::now('Asia/Kathmandu')) {
            return redirect()->route('poll.index')->with('error', 'This poll has already expired. You cannot vote on it anymore.');
        }

        $vote = new Vote();
        $vote->user_id = auth()->id();
        $vote->polls_id = $pollId;
        $vote->choice_id = $request->input('choice');
        $vote->save();

        return redirect()->route('poll.index')->with('success', 'Vote submitted successfully.');
    }
    public function showAllPollResults()
    {
        $polls = Poll::all();
    
        $allResults = [];
    
        
        foreach ($polls as $poll) {
            
            $votes = Vote::where('polls_id', $poll->id)->get();
    
           
            $choices = Choice::where('polls_id', $poll->id)->get();
    
            
            $allResults[] = [
                'poll' => $poll,
                'votes' => $votes,
                'choices' => $choices, 
            ];
        }
    
        return view('poll.results', ['allResults' => $allResults]);
    }
    public function pieChartResults()
{
    $allResults = $this->getAllPollResults();

    return view('poll.pie_chart_results', ['allResults' => $allResults]);
}

    public function showExportView()
    {
        return view('export');
    }
    public function export()
    {
        $allResults = $this->getAllPollResults();
    
        return Excel::download(new UsersExport($allResults), 'poll_results.xlsx');
    }
    
    protected function getAllPollResults()
    {
        $polls = Poll::all();
        $allResults = [];
    
        foreach ($polls as $poll) {
            $votes = Vote::where('polls_id', $poll->id)->get();
            $choices = Choice::where('polls_id', $poll->id)->get();
    
            $allResults[] = [
                'poll' => $poll,
                'votes' => $votes,
                'choices' => $choices,
            ];
        }
    
        return $allResults;
    }
}