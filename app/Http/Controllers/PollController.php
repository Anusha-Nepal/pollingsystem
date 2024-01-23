<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Poll;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::paginate(10);
        return view('poll.index', compact('polls'));
    }

    public function create()
    {
        return view('poll.create');
    }

 

    public function store(Request $request)
{
    $currentDate = now();

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'choices' => 'required|array',
        'choices.*' => 'distinct|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ]);

    $start_date_with_time = Carbon::parse($request->input('start_date'))->toDateTimeString();
    $end_date_with_time = Carbon::parse($request->input('end_date'))->toDateTimeString();

    // Check if the start date is in the past
    if ($currentDate > $start_date_with_time) {
        return redirect()->route('poll.index')->with('error', 'Poll start date has passed. Cannot create poll.');
    }

    // Create poll data
    $pollData = [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'choices' => $request->input('choices'),
        'start_date_with_time' => $start_date_with_time, 
        'end_date_with_time' => $end_date_with_time,
    ];
   

   
    $poll = auth()->user()->polls()->create($pollData);

    foreach ($request->input('choices') as $choiceText) {
        $choice = new Choice(['text' => trim($choiceText)]);
        $poll->choices()->save($choice);
    }

    return redirect()->route('poll.index')->with('success', 'Poll created successfully!');
}

    


    public function show($id)
    {
        
        $poll = Poll::findOrFail($id);
        $votes = $poll->votes()->count();
    
        return view('poll.show', compact('poll', 'votes'));
    }
    


    public function update(Request $request, $id)
{
    $poll = Poll::findOrFail($id);

    if ($this->canEditPoll($poll)) {
        $input = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $currentDate = now();
        $end_date_with_time = Carbon::parse($poll->end_date_with_time);

        if ($currentDate > $end_date_with_time) {
            return redirect()->route('poll.index')->with('error', 'Poll start date has passed. Cannot update poll.');
        }

        $poll->update([
            'title' => $input['title'],
            'description' => $input['description'],
        ]);


        return redirect()->route('poll.index')->with('success', 'Poll updated successfully!');
    } else {
        return redirect()->route('poll.index')->with('error', 'You are not authorized to update this poll.');
    }
}


private function canEditPoll($poll)
{
    return $poll->user_id == auth()->user()->id;
}

    
 public function delete(Request $request, $pollId)
{

    $poll = Poll::findOrFail($pollId);

 
    if ($request->user()->id !== $poll->user_id) {
        return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this poll.');
    }

    $poll->delete();

    return redirect()->route('dashboard')->with('success', 'Poll deleted successfully.');
}

    public function edit(Request $request, $pollId)
{
    $poll = Poll::findOrFail($pollId);
    if ($request->user()->id !== $poll->user_id) {
        return redirect()->route('dashboard')->with('error', 'You are not authorized to edit this poll.');
    }
    return view('poll.edit', compact('poll'));
}



public function search(Request $request)
{
    $pollName = $request->input('poll_name');
    $creatorName = $request->input('creator_name');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $search = $request->input('search');

    $query = Poll::query();

    if ($pollName) {
        $query->where('title', 'like', '%' . $pollName . '%');
    }

    if ($creatorName) {
        $query->whereHas('user', function ($userQuery) use ($creatorName) {
            $userQuery->where('name', 'like', '%' . $creatorName . '%');
        });
    }

    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    $polls = $query->paginate(10);

    return view('poll.index', compact('polls'));
}

}



