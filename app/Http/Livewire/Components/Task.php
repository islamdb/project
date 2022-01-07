<?php

namespace App\Http\Livewire\Components;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Task extends Component
{
    public $task;

    public $weight;

    public $price;

    public $edit = false;

    public function edit()
    {
        $this->edit = true;
    }

    public function save()
    {
        DB::table('tasks')
            ->where('id', $this->task['id'])
            ->update([
                'name' => $this->task['name']
            ]);

        $this->edit = false;
    }

    public function mount($task, $weight, $price)
    {
        $this->task = $task;
        $this->weight = $weight;
        $this->price = $price;
    }

    public function render()
    {
        return view('livewire.components.task', [
            'todos' => DB::table('todos')
                ->select(['id', 'weight'])
                ->where('task_id', $this->task['id'])
                ->get(),
            'members' => $members = Member::query()
                ->where('user_id', auth()->id())
                ->get()
        ]);
    }
}
