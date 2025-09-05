<x-app-layout>
    @can('modify', App\Models\Label::class)
        <h1>{{__('label.create')}}</h1>
        {{ html()->modelForm($label, 'POST', route('labels.store'))->open() }}
            @include('label.form')
            <div class="mt-2">
                {{ html()->submit(__('status.new'))->class('btn btn-primary') }}
            </div>
        {{ html()->closeModelForm() }}
    @endcan
</x-app-layout>