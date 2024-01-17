<?php
namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Vote;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userPolls = Poll::where('user_id', Auth::id())->get();
        $votingHistory = Vote::where('user_id', Auth::id())->with('poll')->get();
    
        return view('dashboard', compact('userPolls', 'votingHistory'));
    }
    public function votedPolls()
{
    $user = Auth::user();
    $votedPolls = $user->votes()->with('poll')->get();
    return view('poll.show', compact('votedPolls'));
}
//     public function showDashboard()
// {
   
//     $userPolls = Poll::where('user_id', Auth::id())->get();
//     $votingHistory = Vote::where('user_id', Auth::id())->with('poll')->get();

//     return view('dashboard', compact('userPolls', 'votingHistory'));
// }


}
