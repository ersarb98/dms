@extends('layouts.app')
@section('pageTitle', 'Set Inspeksi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Set Inspeksi</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('realisasi.search') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="containerNumber">Container Number:</label>
                                <input type="text" id="containerNumber" name="containerNumber" class="form-control"
                                    placeholder="Enter container number" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
    </script>
@endpush
