<x-app-layout>
    @can('modify-status', App\Models\TaskStatus::class)
    <h1>{{__('status.editStatus')}}</h1>
    {{ html()->modelForm($status, 'PATCH', route('task_statuses.update', $status))->open() }}
        @include('status.form')
        {{ html()->submit('Обновить')->class('btn btn-primary') }}
    {{ html()->closeModelForm() }}
    @endcan
</x-app-layout>