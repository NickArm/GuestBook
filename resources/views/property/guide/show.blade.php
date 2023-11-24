<div class="mb-3">
    <a href="{{ route('guide.create', ['property' => $property->id]) }}" class="btn btn-primary">Create Guide</a>
</div>
<div class="row g-10">
    @foreach ($property->guides as $guide)
        <div class="guide col-md-4">
            <div class="card-xl-stretch me-md-6">
                <div class="m-0">
                    <div class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                        {{ $guide->title }}</div>
                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">Category:
                        {{ $guide->category->name }}</div>

                    @if ($guide->video_url)
                        <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">Video
                            URL:
                            {{ $guide->video_url }}</div>
                    @endif
                    <div class="m-0">
                        <img src="{{ Storage::url($guide->image) }}" alt="" class="guide-image"
                            style="width: 100%;">

                    </div>
                    @if ($guide->video_file)
                        <video width="320" height="240" controls>
                            <source src="{{ Storage::url($guide->video_file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif

                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">
                        <p>{{ $guide->content }}</p>
                    </div>

                    <a href="{{ route('guide.edit', [$property, $guide]) }}" class="btn btn-warning">Edit</a>

                    <!-- Delete Guide Button/Form -->
                    <form action="{{ route('property.guide.destroy', [$property, $guide]) }}" method="POST"
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
