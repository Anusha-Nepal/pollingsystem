<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id', 'start_date_with_time', 'end_date_with_time'];

    protected $dates = ['end_date_with_time'];

public function user()
{
    return $this->belongsTo(User::class);
}
public function votes()
{
    return $this->hasMany(Vote::class, 'polls_id', 'id');
}
    
public function choices()
{
    return $this->hasMany(Choice::class, 'polls_id', 'id');
}



public function mostVotedChoice()
{
    return $this->choices()->withCount('votes')->orderByDesc('votes_count')->first();
}

public function voteCounts()
{
    return $this->choices()->withCount('votes')->get()->pluck('votes_count', 'id');
}

public function scopePollFilter($query,$filter){

    if($filter['poll_name']??false){
        $query->where('title','like','%'.$filter['poll_name'].'%') ;
    }
    if ($filter['creator_name'] ?? false) {
        $query->whereHas('user', function ($query) use ($filter) {
            $query->where('name', 'like', '%' . $filter['creator_name'] . '%');
        });
}
if ($filter['start_date'] ||$filter['end_date']??false){
    $query->whereBetween('start_date',[$filter['start_date'],$filter['end_date']]);
}}
}

