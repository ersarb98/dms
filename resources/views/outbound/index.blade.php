@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Welcome to the Outbound Index Page</h1>
            <p>This is a basic example of an index page.</p>
            <button id="getDataButton">Get Data</button>
            <p id="responseMessage"></p>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#getDataButton').click(function() {
                $.ajax({
                    url: '/outbound/data',
                    method: 'GET',
                    success: function(response) {
                        $('#responseMessage').text(response.message);
                    },
                    error: function(xhr) {
                        $('#responseMessage').text('An error occurred.');
                    }
                });
            });
        });
    </script>
@endpush
