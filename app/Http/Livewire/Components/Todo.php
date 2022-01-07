<?php

namespace App\Http\Livewire\Components;

use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Todo extends Component
{
    public $todo;

    public $projectId;

    public function updatedTodo()
    {
        $data = $this->todo;
        $data['updated_at'] = now();
        if (empty($data['member_id'])) {
            $data['member_id'] = null;
        }
        unset($data['id']);

        DB::table('todos')
            ->where('id', $this->todo['id'])
            ->update($data);

        $this->emit('todo');
    }

    public function delete()
    {
        DB::table('todos')
            ->where('id', $this->todo['id'])
            ->delete();
    }

    public function mount($todo, $projectId)
    {
        $this->todo = (array)DB::table('todos')
            ->select(['id', 'member_id', 'name', 'weight'])
            ->find($todo);

        $this->projectId = $projectId;
    }

    public function render()
    {
        $members = Member::query()
            ->where('user_id', auth()->id())
            ->get();

        return view('livewire.components.todo', [
            'members' => $members
        ]);
    }
}
