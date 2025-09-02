<x-app-layout>
    @can('modify', App\Models\Task::class)
        <h1>{{__('task.edit')}}</h1>
        {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->open() }}
            @include('task.form')
            <div class="mt-2">
                {{ html()->submit('Обновить')->class('btn btn-primary') }}
            </div>
        {{ html()->closeModelForm() }}
    @endcan
</x-app-layout>