<div class="mb-3">
    <a href="{{ route('service.create', ['property' => $property->id]) }}" class="btn btn-primary">Create Service</a>
</div>
<div class="row g-10">
    @foreach ($property->services as $service)
        <div class="service col-md-4">
            <div class="card-xl-stretch me-md-6">
                <!--begin::Overlay-->
                <a class="d-block overlay" data-fslightbox="lightbox-hot-sales" href="{{ Storage::url($service->image) }}">
                    <!--begin::Image-->
                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                        style="background-image:url('{{ Storage::url($service->image) }}')"></div>
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
                    <a href="#"
                        class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">{{ $service->name }}</a>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3">{{ $service->description }}</div>
                    <!--end::Text-->
                    <!--begin::Text-->
                    <div class="fs-6 fw-bold mt-5 d-flex flex-stack">
                        <!--begin::Action-->
                        <a href="{{ route('service.edit', [$property, $service]) }}" class="btn btn-warning">Edit</a>
                        <!-- Delete Service Button/Form -->
                        <form action="{{ route('property.service.destroy', [$property, $service]) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this service?')"
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
</div>
