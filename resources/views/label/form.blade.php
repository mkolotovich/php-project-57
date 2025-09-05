<div>
    {{  html()->label(__('layout.name'), 'name') }}
</div>
<div class="mt-2">
    {{  html()->input('text', 'name')->class('rounded border-gray-300 w-1/3') }}
</div>
@error('name')
    <div class="text-rose-600">{{ $message }}</div>
@enderror
<div class="mt-2">
    {{  html()->label(__('task.description'), 'description') }}
</div>
<div>
    {{  html()->textarea('description')->class('rounded border-gray-300 w-1/3 h-32') }}
</div>