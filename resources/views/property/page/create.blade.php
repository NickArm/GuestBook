@extends('template')

@section('content')
    <div class="container">
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Create New Page
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <div class="card card-flush h-lg-100">

            <div class="card-body pt-5">
                <form action="{{ route('page.store', $property) }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Page Name</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Enter the pages's name."></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" name="title"
                            placeholder="Page Name">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Page Content</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Here you put your content"></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea id="kt_docs_tinymce_basic" class="form-control form-control-solid" name="content"></textarea>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>

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
        <script src="{{ asset('plugins/custom/tinymce/tinymce.bundle.js ') }}"></script>
        <script>
            var options = {
                selector: "#kt_docs_tinymce_basic",
                height: "480"
            };
            tinymce.init(options);
        </script>
        <!--end::Javascript-->
    </div>
@endsection
