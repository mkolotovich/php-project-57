<x-app-layout>
    @can('modify', App\Models\TaskStatus::class)
        <h1>{{__('status.create')}}</h1>
        {{ html()->modelForm($status, 'POST', route('task_statuses.store'))->open() }}
            @include('status.form')
            <div class="mt-2">
                {{ html()->submit('Создать')->class('btn btn-primary') }}
            </div>
        {{ html()->closeModelForm() }}
    @endcan
</x-app-layout>