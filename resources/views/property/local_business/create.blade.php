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
                        Create New Local Business
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
                <form action="{{ route('local-business.store', ['property' => $property->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf


                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Business Name</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Enter the business's name."></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" name="title"
                            placeholder="Business Name" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Category</span>
                        </label>
                        <!--end::Label-->
                        <div class="w-100">
                            <div class="form-floating border rounded">
                                <!--begin::Select2-->
                                <select id="category_id" class="form-select form-select-solid lh-1 py-3" name="category_id"
                                    data-placeholder="Select a category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Business's Description</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Enter business's Description"></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea name="description" class="form-control form-control-solid" rows="5" cols="40" required></textarea>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-3">
                            <span>Business Image</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Allowed file types: png, jpg, jpeg."></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Image input wrapper-->
                        <div class="mt-1">
                            <!--begin::Image placeholder-->
                            <style>
                                .image-input-placeholder {
                                    background-image: url('assets/media/svg/files/blank-image.svg');
                                }

                                [data-theme="dark"] .image-input-placeholder {
                                    background-image: url('assets/media/svg/files/blank-image-dark.svg');
                                }
                            </style>
                            <!--end::Image placeholder-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty"
                                data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-100px h-100px" style="background-image: url('')"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Edit-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="image" id="image" class="form-control"
                                        accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="image_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                        </div>
                        <!--end::Image input wrapper-->
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">GMB / Google Map Url</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Enter youtube url"></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="url" class="form-control form-control-solid" name="google_map"
                            placeholder="Google Map">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Directions URL</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Enter youtube url"></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="url" class="form-control form-control-solid" name="directions_url"
                            placeholder="Directions Url">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Website / External URL</span>
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                title="Enter youtube url"></i>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="url" class="form-control form-control-solid" name="external_url"
                            placeholder="External Url">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <div>
                        <button type="submit" class="btn btn-primary">Add Local Business</button>
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
        <!--end::Javascript-->
    </div>
@endsection
