<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Choice;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    public function create($pollId)
    {
        $poll = Poll::findOrFail($pollId);
        return view('choice.create', compact('poll'));
    }

    public function index($pollId)
    {
        $poll = Poll::findOrFail($pollId);
        $choices = $poll->choices;

        return view('choice.index', compact('poll', 'choices'));
    }


    
    public function store(Request $request, $pollId)
{
    $request->validate([
        'text' => [
            'required',
            'string',
            'max:255',
            'unique:choices,text,NULL,id,poll_id,' . $pollId,
        ],
    ], [
        'text.unique' => 'Please enter a unique choice.',
    ]);
    

    $poll = Poll::findOrFail($pollId);

    // Check if the previous choice exists
    if ($poll->choices->count() >= 2 && empty($request->input('text'))) {
        return redirect()->route('poll.show', $poll->id)->withErrors(['text' => 'Please enter the second choice before adding the third one.'])->withInput();
    }

    $choice = new Choice([
        'text' => $request->input('text'),
    ]);

    $poll->choices()->save($choice);

    return redirect()->route('poll.show', $poll->id)->with('success', 'Choice added successfully!');
}

}
 


