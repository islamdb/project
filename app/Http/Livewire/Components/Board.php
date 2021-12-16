<?php

namespace App\Http\Livewire\Components;

use App\Models\Project;
use App\Models\Todo;
use Livewire\Component;

class Board extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = Project::query()
            ->select([
                'id', 'price',
                'weight' => Todo::query()
                    ->selectRaw('sum(weight)')
                    ->join('tasks as t', 't.id', 'task_id')
                    ->whereColumn('projects.id', 'project_id')
            ])
            ->with([
                'tasks' => function ($q) {
                    return $q->select(['id', 'project_id', 'name'])
                        ->orderBy('position');
                }
            ])
            ->where('id', $project)
            ->first()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.components.board');
    }
}
