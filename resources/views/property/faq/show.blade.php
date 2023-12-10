<div class="mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFAQModal"
        onclick="handleModalOpen()">Add FAQ</button>
</div>
<h3>FAQs</h3>
@if ($faqs->isEmpty())
    <p>No FAQs available for this property.</p>
@else
    <div class="m-0">
        <?php $i = 0; ?>
        @foreach ($faqs as $faq)
            <?php $i++; ?>
            <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse"
                data-bs-target="#kt_job_4_{{ $i }}" aria-expanded="false">
                <!--begin::Icon-->
                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                    <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span
                            class="path2"></span></i>
                    <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span
                            class="path2"></span><span class="path3"></span></i>
                </div>
                <!--end::Icon-->

                <!--begin::Title-->
                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                    {{ $faq->question }}
                </h4>
                <!--end::Title-->
            </div>
            <!--end::Heading-->
            <div id="kt_job_4_{{ $i }}" class="fs-6 ms-1 collapse" style="">
                <!--begin::Text-->
                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                    {{ $faq->answer }}
                </div>
            </div>
        @endforeach
    </div>
@endif
