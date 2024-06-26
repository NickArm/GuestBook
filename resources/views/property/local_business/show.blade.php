<div class="mb-3">
    <a href="{{ route('local-business.create', ['property' => $property->id]) }}" class="btn btn-primary">Add Local
        Business</a>
</div>
<div class="row g-10">

    @if ($local_businesses->isEmpty())
        <div class="guide col-md-12">
            <div class="card-xl-stretch me-md-6 text-center fw-semibold fs-1 text-gray-400">
                There are no Businesses yet.
            </div>
        </div>
    @else
        @foreach ($local_businesses as $business)
            <div class="guide col-md-4">
                <div class="card-xl-stretch me-md-6">

                    <!--begin::Overlay-->
                    <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                        href="{{ Storage::url($business->image) }}">
                        <!--begin::Image-->
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                            style="background-image:url('{{ Storage::url($business->image) }}')"></div>
                        <!--end::Image-->
                        <!--begin::Action-->
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                            <i class="bi bi-eye-fill fs-2x text-white"></i>
                        </div>
                        <!--end::Action-->
                    </a>
                    <!--end::Overlay-->
                    <!--begin::Body-->
                    <div class="mt-5">
                        <!--begin::Title-->
                        <a href="{{ route('local-business.edit', [$property, $business]) }}"
                            class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">{{ $business->title }}</a>
                        <!--end::Title-->
                        <div class="fs-8 fw-semibold text-gray-400"><span class="fs-86 fw-semibold text-gray-400">{{ $business->category->name }}</span></div>
                        <!--begin::Text-->
                        <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3">{{ $business->description }}</div>
                        <!--end::Text-->
                        <!--begin::Text-->
                        <div class="fs-6 fw-bold mt-5 d-flex flex-stack">
                            <!--begin::Action-->
                            <a href="{{ route('local-business.edit', [$property, $business]) }}"
                                class="btn btn-warning">Edit</a>

                            <!-- Delete Guide Button/Form -->
                            <form action="{{ route('local-business.destroy', [$property, $business]) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this business?')"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                            <!--end::Action-->
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Body-->

                </div>
            </div>
        @endforeach
    @endif
</div>
