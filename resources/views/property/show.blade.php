@extends('template')

@section('content')
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->

        <!--end::Card header-->
        <div class="card-body pt-9 pb-0">
            <div class="card mb-5 mb-xxl-8">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ asset('media/avatars/300-1.jpg') }}" alt="image" />
                                <div
                                    class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                </div>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center my-4">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $property->title }}</a>

                                    </div>

                                </div>

                                <!--end::User-->
                                <!--begin::Actions-->
                                <div class="d-flex my-4">
                                    <a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr012.svg-->
                                        <span class="svg-icon svg-icon-3 d-none">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Follow</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator progress-->
                                    </a>
                                    <a href="/property/new" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_offer_a_deal">Add New Property</a>

                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="fs-5 fw-bold">Address</div>
                                    <div class="fw-semibold fs-6 text-gray-400">
                                        {{ $property->address }}, {{ $property->country }}</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fs-5 fw-bold">Check In Time</div>
                                    <div class="fw-semibold fs-6 text-gray-400">{{ $property->check_in_time }}</div>
                                    <div class="fs-5 fw-bold">Check Out Time</div>
                                    <div class="fw-semibold fs-6 text-gray-400">{{ $property->check_ouy_time }}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fs-5 fw-bold">PIN</div>
                                    <div class="fw-semibold fs-6 text-gray-400">{{ $property->pin }}</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <!--begin::Navs-->
                    <ul class="nav nav-tabs nav-line-tabs nav-stretch  nav-line-tabs-2x border-transparent fs-5 fw-bold">
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-toggle="tab"
                                href="#kt_tab_pane_1">Property Guides</a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-toggle="tab"
                                href="#kt_tab_pane_2">Projects</a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-toggle="tab"
                                href="#kt_tab_pane_3">Campaigns</a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-toggle="tab"
                                href="#kt_tab_pane_4">Documents</a>
                        </li>
                        <!--end::Nav item-->
                    </ul>
                    <!--begin::Navs-->
                    <div class="tab-content mt-5" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel"
                            aria-labelledby="kt_tab_pane_1">
                            <div class="mb-3">
                                <a href="{{ route('guide.create', ['property' => $property->id]) }}"
                                    class="btn btn-primary">Create Guide</a>
                            </div>
                            @foreach ($property->guides as $guide)
                                <div class="guide">
                                    <h4>{{ $guide->title }}</h4>
                                    <p>Category ID: {{ $guide->category_id }}</p>
                                    <p>Video URL: {{ $guide->video_url }}</p>
                                    <!-- If you store the actual video file, you can embed it using HTML5 video tags or any video player of your choice -->
                                    <video width="320" height="240" controls>
                                        <source src="{{ asset('path/to/video/folder/' . $guide->video_file) }}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <a href="{{ route('guide.edit', [$property, $guide]) }}" class="btn btn-warning">Edit
                                        Guide</a>
                                    <!-- Delete Guide Button/Form -->
                                    <form action="{{ route('property.guide.destroy', [$property, $guide]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this guide?')"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete Guide</button>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">Tab
                            content 2</div>
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">Tab
                            content 4</div>
                        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">Tab
                            content 5</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <!--end::Custom Javascript-->
@endsection
