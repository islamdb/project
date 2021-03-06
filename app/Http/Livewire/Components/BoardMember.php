<?php

namespace App\Http\Livewire\Components;

use App\Models\Project;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BoardMember extends Component
{
    public $projectId;

    public $weight;

    public $price;

    protected $listeners = [
        'todo' => 'updatedTodo'
    ];

    public function updatedTodo()
    {
        $project = Project::query()
            ->select([
                'id', 'name', 'price',
                'weight' => Todo::query()
                    ->selectRaw('sum(weight)')
                    ->join('tasks as t', 't.id', 'task_id')
                    ->whereColumn('projects.id', 'project_id')
            ])
            ->find($this->projectId);

        $this->weight = $project->weight;
        $this->price = $project->price;
    }

    public function mount($projectId, $weight, $price)
    {
        $this->projectId = $projectId;
        $this->weight = $weight;
        $this->price = $price;
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
            'members' => $members,
            'usedPrice' => 0
        ]);
    }
}
