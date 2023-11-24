<div class="mb-3">
    <a href="{{ route('service.create', ['property' => $property->id]) }}" class="btn btn-primary">Create Service</a>
</div>
<div class="row g-10">
    @foreach ($property->services as $service)
        <div class="service col-md-4">
            <div class="card-xl-stretch me-md-6">
                <div class="m-0">
                    <div class="fs-4 text-gray-900 fw-bold text-hover-primary text-gray-900 lh-base">
                        {{ $service->name }}</div>

                    <!-- Display other service attributes similarly. Update below lines according to the attributes of service -->

                    <img src="{{ Storage::url($service->image) }}" alt="" class="service-image"
                        style="width: 100%;">
                    <div class="fw-semibold fs-5 text-gray-600 text-gray-900 my-4">
                        <p>Description: {{ $service->description }}</p>
                    </div>

                    <a href="{{ route('service.edit', [$property, $service]) }}" class="btn btn-warning">Edit</a>

                    <!-- Delete Service Button/Form -->
                    <form action="{{ route('property.service.destroy', [$property, $service]) }}" method="POST"
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
