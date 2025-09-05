<x-app-layout>
    @can('modify', App\Models\Label::class)
        <h1>{{__('label.edit')}}</h1>
        {{ html()->modelForm($label, 'PATCH', route('labels.update', $label))->open() }}
            @include('label.form')
            <div class="mt-2">
                {{ html()->submit(__('layout.update'))->class('btn btn-primary') }}
            </div>
        {{ html()->closeModelForm() }}
    @endcan
</x-app-layout>