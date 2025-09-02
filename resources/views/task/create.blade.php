<x-app-layout>
    @can('modify', App\Models\Task::class)
        <h1>{{__('task.create')}}</h1>
        {{ html()->modelForm($task, 'POST', route('tasks.store'))->open() }}
            @include('task.form')
            <div class="mt-2">
                {{ html()->submit('Создать')->class('btn btn-primary') }}
            </div>
        {{ html()->closeModelForm() }}
    @endcan
</x-app-layout>