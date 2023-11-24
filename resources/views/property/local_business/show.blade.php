<div class="mb-3">
    <a href="{{ route('local-business.create', ['property' => $property->id]) }}" class="btn btn-primary">Add Local
        Business</a>
</div>
<div class="row g-10">

    @foreach ($local_businesses as $business)
        <div class="guide col-md-4">
            <div class="card-xl-stretch me-md-6">
                <div class="m-0">
                    <div class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                        {{ $business->title }}</div>
                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">Category:
                        {{ $business->category->name }}</div>

                    @if (!empty($business->google_map))
                        <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">Video URL:
                            {{ $business->google_map }}
                        </div>
                    @endif

                    @if ($business->image)
                        <div class="m-0">
                            <img src="{{ Storage::url($business->image) }}" alt="" class="guide-image"
                                style="width: 100%;">
                        </div>
                    @endif
                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">
                        <p>Description: {{ $business->description }}</p>
                    </div>

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
                </div>
            </div>
    @endforeach
</div>
