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
                                <img src="{{ asset('storage/' . $property->main_image) }}" alt="image" />
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




                                    <!--begin::Indicator label-->
                                    <a href="/property/{{ $property->id }}/edit" class="btn btn-sm btn-primary me-2">Edit
                                        the
                                        Property</a>
                                    <!--end::Indicator label-->
                                    </a>
                                    <a href="/property/new" class="btn btn-sm btn-primary me-2">Add New Property</a>
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
                                href="#kt_tab_pane_2">FAQs</a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-toggle="tab"
                                href="#kt_tab_pane_3">Local Recommendations</a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-toggle="tab"
                                href="#kt_tab_pane_4">Property Services</a>
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
                            <div class="row g-10">
                                @foreach ($property->guides as $guide)
                                    <div class="guide col-md-4">
                                        <div class="card-xl-stretch me-md-6">
                                            <div class="m-0">
                                                <div
                                                    class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                                    {{ $guide->title }}</div>
                                                <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">Category ID:
                                                    {{ $guide->category_id }}</div>

                                                @if ($guide->video_url)
                                                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">Video
                                                        URL:
                                                        {{ $guide->video_url }}</div>
                                                @endif
                                                <div class="m-0">
                                                    <img src="{{ Storage::url($guide->image) }}" alt=""
                                                        class="guide-image" style="width: 100%;">

                                                </div>
                                                @if ($guide->video_file)
                                                    <video width="320" height="240" controls>
                                                        <source src="{{ Storage::url($guide->video_file) }}"
                                                            type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endif

                                                <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">
                                                    <p>{{ $guide->content }}</p>
                                                </div>

                                                <a href="{{ route('guide.edit', [$property, $guide]) }}"
                                                    class="btn btn-warning">Edit</a>

                                                <!-- Delete Guide Button/Form -->
                                                <form action="{{ route('property.guide.destroy', [$property, $guide]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this guide?')"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            <div class="mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addFAQCategoryModal">Add
                                    FAQ Category</button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addFAQModal" onclick="handleModalOpen()">Add FAQ</button>
                            </div>
                            <h3>FAQs</h3>
                            @if ($faqs->isEmpty())
                                <p>No FAQs available for this property.</p>
                            @else
                                <div class="m-0">
                                    <?php $i = 0; ?>
                                    @foreach ($faqs as $faq)
                                        <?php $i++; ?>
                                        <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#kt_job_4_{{ $i }}"
                                            aria-expanded="false">
                                            <!--begin::Icon-->
                                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i>
                                            </div>
                                            <!--end::Icon-->

                                            <!--begin::Title-->
                                            <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                                                {{ $faq->question }}
                                            </h4>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Heading-->
                                        <div id="kt_job_4_{{ $i }}" class="fs-6 ms-1 collapse"
                                            style="">
                                            <!--begin::Text-->
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                                                {{ $faq->answer }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif


                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                            <div class="mb-3">
                                <a href="{{ route('local-business.create', ['property' => $property->id]) }}"
                                    class="btn btn-primary">Add Local Business</a>
                            </div>
                            <div class="row g-10">



                                @foreach ($local_businesses as $business)
                                    <div class="guide col-md-4">
                                        <div class="card-xl-stretch me-md-6">
                                            <div class="m-0">
                                                <div
                                                    class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                                    {{ $business->title }}</div>
                                                <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">Category ID:
                                                    {{ $business->category_id }}</div>
                                                <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">Video URL:
                                                    {{ $business->google_map }}</div>
                                            </div>

                                            @if ($business->image)
                                                <div class="m-0">
                                                    <img src="{{ Storage::url($business->image) }}" alt=""
                                                        class="guide-image" style="width: 100%;">
                                                </div>
                                            @endif



                                            <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">
                                                <p>Content: {{ $business->description }}</p>
                                            </div>

                                            <a href="{{ route('local-business.edit', [$property, $business]) }}"
                                                class="btn btn-warning">Edit</a>

                                            <!-- Delete Guide Button/Form -->
                                            <form action="{{ route('local-business.destroy', [$property, $business]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this business?')"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                            <div class="mb-3">
                                <a href="{{ route('service.create', ['property' => $property->id]) }}"
                                    class="btn btn-primary">Create Service</a>
                            </div>
                            <div class="row g-10">
                                @foreach ($property->services as $service)
                                    <div class="service col-md-4">
                                        <div class="card-xl-stretch me-md-6">
                                            <div class="m-0">
                                                <div
                                                    class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                                                    {{ $service->name }}</div>

                                                <!-- Display other service attributes similarly. Update below lines according to the attributes of service -->

                                                <img src="{{ Storage::url($service->image) }}" alt=""
                                                    class="service-image" style="width: 100%;">
                                                <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">
                                                    <p>Description: {{ $service->description }}</p>
                                                </div>

                                                <a href="{{ route('service.edit', [$property, $service]) }}"
                                                    class="btn btn-warning">Edit</a>

                                                <!-- Delete Service Button/Form -->
                                                <form
                                                    action="{{ route('property.service.destroy', [$property, $service]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this service?')"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Remove</button>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- MODALS -->
    <!-- Add FAQ Category Modal -->
    <div class="modal fade" id="addFAQCategoryModal" tabindex="-1" aria-labelledby="addFAQCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFAQCategoryModalLabel">Add FAQ Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('faq_category.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add a new FAQ Modal -->
    <div class="modal fade" id="addFAQModal" tabindex="-1" aria-labelledby="addFAQModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFAQModalLabel">Add a new FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('faq.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
                        <div class="mb-3">
                            <label for="faq_category" class="form-label">Select Category</label>
                            <select class="form-control" id="faq_category" name="category_id" required
                                onchange="checkNewCategorySelected(this);">
                                <!-- Existing categories -->
                                @foreach ($faq_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                <!-- Option to add a new category -->
                                <option value="new">Add New Category</option>
                            </select>
                        </div>
                        <!-- Input for the new category name (hidden by default) -->
                        <div class="mb-3" id="newCategoryInput" style="display: none;">
                            <label for="new_category_name" class="form-label">New Category Name</label>
                            <input type="text" class="form-control" id="new_category_name" name="new_category_name">
                        </div>
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer</label>
                            <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add FAQ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Script to toggle the new category input based on dropdown selection -->




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
    <script>
        function checkNewCategorySelected(selectElem) {
            const newCategoryInputDiv = document.getElementById('newCategoryInput');
            if (selectElem.value === 'new') {
                newCategoryInputDiv.style.display = 'block';
            } else {
                newCategoryInputDiv.style.display = 'none';
            }
        }

        function handleModalOpen() {
            const faqCategorySelect = document.getElementById('faq_category');
            if (faqCategorySelect.options.length === 1 && faqCategorySelect.options[0].value === 'new') {
                document.getElementById('newCategoryInput').style.display = 'block';
            }
        }
    </script>


    <!--end::Custom Javascript-->
@endsection
