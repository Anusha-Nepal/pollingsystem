<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::all();
        return view('poll.index', compact('polls'));
    }

    public function create()
    {
        // Show the form to create a new poll
        return view('poll.create');
    }

 

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'choices' => 'required|string',
        ]);

        $poll = auth()->user()->polls()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        
      

        $choices = explode("\n", $request->input('choices'));
        foreach ($choices as $choiceText) {
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
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $poll = Poll::findOrFail($id);
    $poll->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);

    
    return redirect()->route('poll.index')->with('success', 'Poll updated successfully!');
}
public function delete($id)
{
    $poll = Poll::findOrFail($id);

    $poll->votes()->delete();
    $poll->delete();

    return redirect()->route('poll.index')->with('success', 'Poll deleted successfully!');
}


    public function edit($id)
{
    // Retrieve the poll by ID and pass it to the view
    $poll = Poll::findOrFail($id);
    return view('poll.edit', compact('poll'));
}

}
