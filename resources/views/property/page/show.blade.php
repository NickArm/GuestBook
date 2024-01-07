<div class="mb-3">
    <a href="{{ route('page.create', ['property' => $property->id]) }}" class="btn btn-primary">Create Page</a>
</div>
<div class="row g-10">
<h3>Pages</h3>
@if ($faqs->isEmpty())
    <p>Still No Pages for this property</p>
@else
    <div class="m-0">
        <?php $i = 0; ?>
        @foreach ($pages as $page)
            <?php $i++; ?>
            <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse"
                data-bs-target="#kt_job_4_{{ $i }}" aria-expanded="false">
            <!--begin::Icon-->
            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen036.svg-->
																	<span class="svg-icon toggle-on svg-icon-primary svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
																			<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																	<!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
																	<span class="svg-icon toggle-off svg-icon-1">
																		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																			<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
																			<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
																			<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
																		</svg>
																	</span>
																	<!--end::Svg Icon-->
																</div>
																<!--end::Icon-->

                <!--begin::Title-->
                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                    {{ $page->title }}
                </h4>
                <!--end::Title-->
            </div>
            <!--end::Heading-->
            <div id="kt_job_4_{{ $i }}" class="fs-6 ms-1 collapse" style="">
                <!--begin::Text-->
                <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">
                    {{ $page->content }}
                    <div class="mt-4">
                    <button type="button" class="btn btn-light-warning btn-sm" onclick="location.href='{{ route('page.edit', [$property->id, $page->id]) }}'">Edit Page</button>
                    <form action="{{ route('property.page.destroy', ['property' => $property->id, 'page' => $page->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light-danger btn-sm" onclick="return confirm('Are you sure?')">Delete Page</button>
                    </form>

                    </div>
                </div>
               
            </div>
            <div class="separator separator-dashed"></div>
        @endforeach
    </div>
@endif
</div>
