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
                                <?php if ($owner->owner_image) { ?>
                                <img src="{{ asset('storage/' . $property->main_image) }}" alt="image" />
                                <?php } else { ?>
                                <img src="{{ asset('media/misc/no_image.jpg') }}" alt="image" />
                                <?php }?>
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
                                    <div class="fs-5 fw-bold">Contact Number</div>
                                    <div class="fw-semibold fs-6 text-gray-400">
                                        {{ $property->phone }}</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fs-5 fw-bold">Check In Time</div>
                                    <div class="fw-semibold fs-6 text-gray-400">{{ $property->check_in_time }}</div>
                                    <div class="fs-5 fw-bold">Check Out Time</div>
                                    <div class="fw-semibold fs-6 text-gray-400">{{ $property->check_out_time }}
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

                </div>
            </div>
        </div>
    </div>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9">
            <!--begin::Navs-->
            <ul class="nav nav-tabs nav-line-tabs nav-stretch nav-line-tabs-2x border-transparent fs-5 fw-bold">
                <!--begin::Nav item for Property Guides-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->is('property/' . $property->id . '/guides') ? 'active' : '' }}"
                        href="{{ route('property.show', ['id' => $property->id, 'tab' => 'guides']) }}">Property
                        Guides</a>
                </li>
                <!--end::Nav item-->

                <!--begin::Nav item for Property Services-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->is('property/' . $property->id . '/services') ? 'active' : '' }}"
                        href="{{ route('property.show', ['id' => $property->id, 'tab' => 'services']) }}">Property
                        Services</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item for FAQs-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->is('property/' . $property->id . '/faqs') ? 'active' : '' }}"
                        href="{{ route('property.show', ['id' => $property->id, 'tab' => 'faqs']) }}">FAQs</a>
                </li>
                <!--end::Nav item-->

                <!--begin::Nav item for Local Recommendations-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->is('property/' . $property->id . '/local-recommendations') ? 'active' : '' }}"
                        href="{{ route('property.show', ['id' => $property->id, 'tab' => 'local-recommendations']) }}">Local
                        Recommendations</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item for Property Pages-->
                <li class="nav-item mt-2">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->is('property/' . $property->id . '/pages') ? 'active' : '' }}"
                        href="{{ route('property.show', ['id' => $property->id, 'tab' => 'pages']) }}">Property
                        Pages</a>
                </li>
                <!--end::Nav item-->

            </ul>
            <!--begin::Navs-->
            <div class="tab-content mt-5" id="myTabContent">
                {{-- @include('property.guide.show')
                        @include('property.faq.show')
                        @include('property.local_business.show')
                        @include('property.service.show') 
                        @include('property.page.show')--}}

                <div class="tab-content mt-5" id="myTabContent">
                    @if (!empty($tabContent))
                        @include($tabContent)
                    @else
                        {{-- Include some default content or nothing --}}
                    @endif
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

    




    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('js/components/util.js') }}"></script>
    <script src="{{ asset('js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="{{ asset('js/custom/apps/user-management/users/list/export-users.js') }}"></script>
    <script src="{{ asset('js/custom/apps/user-management/users/list/add.js') }}"></script>
    <script src="{{ asset('plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
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
