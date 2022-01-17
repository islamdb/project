<div class="card" style="margin-bottom: 2px">
    <div class="card-body">
        <div class="input-group mb-3">
            @if(!$edit)
                <h5 class="card-title">{{ $task['name'] }} &nbsp;</h5>
                <button class="btn btn-warning btn-sm rounded text-white" type="button" wire:click="edit">Edit</button>
            @else
                <input type="text" class="form-control" wire:model.defer="task.name">
                <button class="btn btn-success btn-sm" type="button" wire:click="save">Save</button>
            @endif
        </div>
        <small>Weight is {{ $todos->sum('weight') }}</small>
    </div>
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
            <livewire:components.todo :wire:key="'todo-'.$todo->id" :todo="$todo->id" :projectId="$task['project_id']"/>
        @endforeach
        </tbody>
    </table>
    <div class="card-footer">
        {!! \Orchid\Screen\Fields\Group::make([
                \Orchid\Screen\Actions\ModalToggle::make('Add To Do')
                    ->icon('plus')
                    ->modal('addToDo')
                    ->method('addTodo')
                    ->asyncParameters([
                        'taskId' => $task['id'],
                    ])->modalTitle(__('Add') . 'To Do to ' . $task['name']),
                \Orchid\Screen\Actions\Button::make('Delete')
                    ->icon('trash')
                    ->action(route('platform.project.board', [
                        'project' => $task['project_id'],
                        'method' => 'deleteTask',
                        'id' => $task['id']
                    ]))->confirm(__('Delete').' '.$task['name'])
            ])->autoWidth() !!}
    </div>
</div>
