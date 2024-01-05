<div class="mb-3">
    <a href="{{ route('guide.create', ['property' => $property->id]) }}" class="btn btn-primary">Create Guide</a>
</div>
<div class="row g-10">

    @if ($property->guides->isEmpty())
        <div class="guide col-md-12">
            <div class="card-xl-stretch me-md-6 text-center fw-semibold fs-1 text-gray-400">
                There are no Property Guides yet.
            </div>
        </div>
    @else
        @foreach ($property->guides as $guide)
            <div class="guide col-md-4">
                <div class="card-xl-stretch me-md-6">

                    <?php if ($guide->video_url) {?>

                    <!--begin::Image-->
                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5"
                        style="background-image:url('{{ Storage::url($guide->image) }}')"
                        data-fslightbox="lightbox-video-tutorials" href="{{ $guide->video_url }}">
                        <img src="{{ asset('media/svg/misc/video-play.svg ') }}"
                            class="position-absolute top-50 start-50 translate-middle" alt="" />
                    </a>
                    <!--end::Image-->
                    <?php } else { ?>

                    <!--begin::Image-->
                    <!--begin::Overlay-->
                    <a class="d-block overlay" data-fslightbox="lightbox-hot-sales"
                        href="{{ Storage::url($guide->image) }}">
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                            style="background-image:url('{{ Storage::url($guide->image) }}')"></div>
                        <!--end::Image-->
                        <!--begin::Action-->
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                            <i class="bi bi-eye-fill fs-2x text-white"></i>
                        </div>
                        <!--end::Action-->
                        <?php }?>

                    </a>
                    <!--end::Overlay-->

                    <!--begin::Body-->
                    <div class="mt-5">
                        <!--begin::Title-->
                        <a href="{{ route('guide.edit', [$property, $guide]) }}"
                            class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">
                            {{ $guide->title }}</a>
                        <!--end::Title-->
                        <div class="fs-7 fw-semibold text-gray-400">Category:
                        <span class="fs-7 fw-semibold text-gray-400">{{ $guide->category->name }}</span></div>
                        <!--begin::Text-->
                        <div class="fw-semibold fs-5 text-gray-600 text-dark mt-3">{{ $guide->content }}</div>
                        <!--end::Text-->
                        <!--begin::Text-->
                        <div class="fs-6 fw-bold mt-5 d-flex flex-stack">
                                <!--begin::Action-->
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
