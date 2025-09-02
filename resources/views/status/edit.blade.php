<x-app-layout>
    @can('modify', App\Models\TaskStatus::class)
        <h1>{{__('status.editStatus')}}</h1>
        {{ html()->modelForm($status, 'PATCH', route('task_statuses.update', $status))->open() }}
            @include('status.form')
            <div class="mt-2">
                {{ html()->submit('Обновить')->class('btn btn-primary') }}
            </div>
        {{ html()->closeModelForm() }}
    @endcan
</x-app-layout>