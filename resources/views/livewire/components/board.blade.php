<div class="row g-0">
    <div class="col-md-4">
        <livewire:components.board-member :projectId="$project['id']" :weight="$project['weight']" :price="$project['price']"/>
    </div>
    <div class="col-md-8">
        <div class="overflow-auto" style="max-height: 75vh">
            @foreach($project['tasks'] as $task)
                <livewire:components.task :wire:key="'task-'.$task['id']" :task="$task" :weight="$project['weight']" :price="$project['price']"/>
            @endforeach
        </div>
    </div>
</div>
