@extends('template')

@section('content')
    <div class="container">
        <h1>Edit Service</h1>

        <form action="{{ route('service.update', ['service' => $service->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" name="name" placeholder="Service Name" value="{{ $service->name }}">
            <textarea name="description" placeholder="Service Description">{{ $service->description }}</textarea>

            <!-- Display the current image if it exists -->
            @if ($service->image)
                <img src="/path/to/images/directory/{{ $service->image }}" alt="Service Image">
            @endif

            <input type="file" name="image">

            <div id="builder"></div>
            <input type="hidden" name="definition" id="definition" value="{{ $service->definition }}">

            <input type="submit" value="Update Service">
        </form>

        <link href="https://cdn.form.io/formiojs/formio.full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.form.io/formiojs/formio.full.min.js"></script>
        <script>
            const builderElement = document.getElementById('builder');
            const definitionElement = document.getElementById('definition');

            const serviceDefinition = JSON.parse(definitionElement.value); // Convert stored JSON string to JS object

            const formBuilder = Formio.builder(builderElement, {
                components: serviceDefinition
            }, {});

            formBuilder.then((instance) => {
                instance.on('change', (schema) => {
                    definitionElement.value = JSON.stringify(schema.components);
                    console.log('Form Definition Updated:', definitionElement
                    .value); // log for debugging purposes
                });
            });
        </script>
    </div>
@endsection
