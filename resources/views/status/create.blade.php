<x-app-layout>
    @can('modify-status', App\Models\TaskStatus::class)
        <h1>{{__('status.create')}}</h1>
        {{ html()->modelForm($status, 'POST', route('task_statuses.store'))->open() }}
            @include('status.form')
            {{ html()->submit('Создать')->class('btn btn-primary') }}
        {{ html()->closeModelForm() }}
    @endcan
</x-app-layout>