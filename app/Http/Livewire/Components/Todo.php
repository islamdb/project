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

    public function finished()
    {
        DB::table('todos')
            ->where('id', $this->todo['id'])
            ->update([
                'status' => 'FINISH'
            ]);
    }

    public function unfinished()
    {
        DB::table('todos')
            ->where('id', $this->todo['id'])
            ->update([
                'status' => 'START'
            ]);
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
            ->select(['id', 'member_id', 'name', 'weight', 'status'])
            ->find($todo);

        $this->projectId = $projectId;
    }

    public function render()
    {
        $members = Member::query()
            ->where('user_id', auth()->id())
            ->get();

        $this->todo = (array)DB::table('todos')
            ->select(['id', 'member_id', 'name', 'weight', 'status'])
            ->find($this->todo['id']);

        return view('livewire.components.todo', [
            'members' => $members
        ]);
    }
}
