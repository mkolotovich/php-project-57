<x-app-layout>
    <h1 class="mb-5">{{__('label.labels')}}</h1>
    <div class="w-full flex items-center">
        <div>
        </div>
        @if (Auth::user())
            <div class="ml-auto">
                <a href="{{route('labels.create')}}" class="btn btn-primary me-1">{{__('label.create')}}</a>
            </div>
        @endif
    </div>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>{{__('status.id')}}</th>
                <th>{{__('status.name')}}</th>
                <th>{{__('task.description')}}</th>
                <th>{{__('status.createdAt')}}</th>
                @if (Auth::user())
                    <th>{{__('status.actions')}}</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
                <tr>
                    <td>{{$label->id }}</td>
                    <td>{{$label->name }}</td>
                    <td>{{$label->description}}</td>
                    <td>{{$label->created_at }}</td>
                    @if (Auth::user())
                        <td class="d-flex">
                            <a href="{{route('labels.edit', $label->id)}}" class="btn btn-primary me-1">{{__('status.edit')}}</a>
                            <a href="{{route('labels.destroy', $label->id)}}" data-confirm="{{__('layout.confirm')}}?" data-method="delete" rel="nofollow">{{__('status.remove')}}</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>