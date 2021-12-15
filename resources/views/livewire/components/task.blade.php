<div class="card" style="margin-bottom: 2px">
    <div class="card-body">
        <h5 class="card-title">{{ $task['name'] }}</h5>
        <table class="table">
            <thead>
            <th class="text-center" style="width: 2%">
                #
            </th>
            <th style="width: 51%">To Do</th>
            <th style="width: 20%">Weight</th>
            <th style="width: 27%">Member</th>
            </thead>
            <tbody>
            @foreach($todos as $todo)
                <livewire:components.todo :id="'todo-'.$todo->id" :todo="$todo->id" :projectId="$task['project_id']"/>
            @endforeach
            </tbody>
        </table>
        {!! \Orchid\Screen\Actions\ModalToggle::make('Add To Do')
                ->icon('plus')
                ->modal('addToDo')
                ->method('addTodo')
                ->asyncParameters([
                    'taskId' => $task['id'],
                ])->modalTitle(__('Add') . 'To Do to ' . $task['name']) !!}
    </div>
</div>
