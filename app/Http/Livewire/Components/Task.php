<?php

namespace App\Http\Livewire\Components;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Task extends Component
{
    public $task;

    public function mount($task)
    {
        $this->task = $task;
    }

    public function render()
    {
        return view('livewire.components.task', [
            'todos' => DB::table('todos')
                ->select(['id'])
                ->where('task_id', $this->task['id'])
                ->get(),
            'members' => $members = Member::query()
                ->where('user_id', auth()->id())
                ->get()
        ]);
    }
}
