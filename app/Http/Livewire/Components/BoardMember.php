<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BoardMember extends Component
{
    public $projectId;

    protected $listeners = [
        'todo' => 'updatedTodo'
    ];

    public function updatedTodo()
    {

    }

    public function mount($projectId)
    {
        $this->projectId = $projectId;
    }

    public function render()
    {
        $members = \App\Models\Todo::query()
            ->select(['m.name', DB::raw('sum(weight) as weight')])
            ->whereRelation('task.project', 'id', $this->projectId)
            ->leftJoin('members as m', 'm.id', 'member_id')
            ->groupBy('m.name')
            ->orderBy('m.name')
            ->get();

        return view('livewire.components.board-member', [
            'members' => $members
        ]);
    }
}