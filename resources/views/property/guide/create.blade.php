@extends('template')

@section('content')
    <form action="{{ route('guide.store', $property) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Title</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Video URL</label>
            <input type="url" name="video_url">
        </div>
        <div>
            <label>Video File</label>
            <input type="file" name="video_file" accept="video/*">
        </div>
        <div>
            <label>Guide Content</label>
            <textarea name="content" rows="5" cols="40"></textarea>
        </div>
        <div>
            <button type="submit">Add Guide</button>
        </div>
    </form>


    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('js/components/util.js') }}"></script>
    <script src="{{ asset('js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('js/custom/apps/user-management/users/list/export-users.js') }}"></script>
    <script src="{{ asset('js/custom/apps/user-management/users/list/add.js') }}"></script>
    <script src="{{ asset('js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('js/custom/widgets.js') }}"></script>
    <script src="{{ asset('js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
@endsection
