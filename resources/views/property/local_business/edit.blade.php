@extends('template')

@section('content')
    <form action="{{ route('local-business.update', ['property' => $property->id, 'localBusiness' => $localBusiness->id]) }}"
        method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ $localBusiness->title }}" required>
        </div>

        <div>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $localBusiness->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" rows="5" cols="40">{{ $localBusiness->description }}</textarea>
        </div>

        <div>
            <label>Image</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <div>
            <label>Google Map Link</label>
            <input type="url" value="{{ $localBusiness->google_map }}" name="google_map">
        </div>

        <div>
            <label>Directions URL</label>
            <input type="url" value="{{ $localBusiness->directions_url }}" name="directions_url">
        </div>

        <div>
            <label>External URL</label>
            <input type="url" value="{{ $localBusiness->external_url }}" name="external_url">
        </div>

        <div>
            <button type="submit">Update Local Business</button>
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
