<x-app-layout>
    <h1>{{__('label.edit')}}</h1>
    {{ html()->modelForm($label, 'PATCH', route('labels.update', $label))->open() }}
        @include('label.form')
        <div class="mt-2">
            {{ html()->submit(__('layout.update'))->class('btn btn-primary') }}
        </div>
    {{ html()->closeModelForm() }}
</x-app-layout>