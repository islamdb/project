<?php

namespace App\Http\Livewire\Components;

use App\Models\Project;
use Livewire\Component;

class Board extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = Project::query()
            ->select(['id'])
            ->with([
                'tasks' => function ($q) {
                    return $q->select(['id', 'project_id', 'name'])
                        ->orderBy('position');
                }
            ])
            ->first()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.components.board');
    }
}
