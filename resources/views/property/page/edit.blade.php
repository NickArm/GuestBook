@extends('template')

@section('content')
    <div class="container">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex align-items-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 align-items-center my-0">Edit Page</h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Card-->
        <div class="card card-flush h-lg-100">
            <!--begin::Card body-->
            <div class="card-body pt-5">
                <!--begin::Form-->
                <form action="{{ route('page.update', [$property, $page]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!--begin::Input group-->
                    <div class="mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Page Name</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" name="title" value="{{ $page->title }}" placeholder="Page Name" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Page Content</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea id="kt_docs_tinymce_basic" class="form-control form-control-solid" name="content">{{ $page->content }}</textarea>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <script src="{{ asset('plugins/custom/tinymce/tinymce.bundle.js ') }}"></script>
        <script>
            var options = {
                selector: "#kt_docs_tinymce_basic",
                height: "480"
            };
            tinymce.init(options);
        </script>
@endsection
