@extends('template')

@section('content')
    <div class="container">
        <h1>{{ $service->name }}</h1>

        <!-- Display the current image if it exists -->
        @if ($service->image)
            <img src="/path/to/images/directory/{{ $service->image }}" alt="Service Image">
        @endif

        <p>{{ $service->description }}</p>

        <!-- Render the Form using Form.io -->
        <div id="formio"></div>

        <script src="https://cdn.form.io/formiojs/formio.full.min.js"></script>
        <script>
            const serviceDefinition = {!! $service->definition !!}; // Convert stored JSON to JS object

            Formio.createForm(document.getElementById('formio'), {
                components: serviceDefinition
            });
        </script>
    </div>
@endsection
