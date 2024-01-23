<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $allResults;

    public function __construct($allResults)
    {
        $this->allResults = $allResults;
    }

    public function collection()
{
    $data = [];

    foreach ($this->allResults as $result) {
        $pollTitle = $result['poll']->title;
        $votesCount = $result['votes']->count();
        
        // Group votes by choice_id and count votes for each choice
        $choicesVotesCount = $result['votes']->groupBy('choice_id')
            ->map->count();

        // Get the text of each choice along with its votes count
        $choices = $result['choices']->map(function ($choice) use ($choicesVotesCount) {
            $votesCount = $choicesVotesCount->get($choice->id, 0);
            return "{$choice->text} ({$votesCount} votes)";
        })->implode(', ');

        $data[] = [
            'Poll Title' => $pollTitle,
            'Votes Count' => $votesCount,
            'Choices' => $choices,
        ];
    }

    return new Collection($data);
}


    public function headings(): array
    {
        return [
            'Poll Title',
            'Votes Count',
            'Max Votes Choice',
           
        ];
    }
}
