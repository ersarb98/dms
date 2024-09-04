@extends('layouts.app')
@section('pageTitle', 'Gate Out')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Gate Out Form</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif      
                        <form action="{{ route('gate.outsearch') }}" method="GET">
                            <div class="form-group">
                                <label for="containerNumber">Nomor Container</label>
                                <input type="text" name="containerNumber" id="containerNumber" class="form-control"
                                    placeholder="Enter container number">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Search</button>
                        </form>

                        @if (isset($jobOperations) && $jobOperations->isNotEmpty())
                            <div class="mt-4">
                                <h5>Search Results:</h5>
                                <ul class="list-group">
                                    @foreach ($jobOperations as $jobOperation)
                                        <li class="list-group-item">
                                            <strong>Container Number:</strong> {{ $jobOperation->no_cont }}<br>
                                            <strong>Location Start:</strong> {{ $jobOperation->lokasi_awal }}<br>
                                            <strong>Location End:</strong> {{ $jobOperation->lokasi_akhir }}<br>
                                            <strong>Status:</strong> {{ $jobOperation->status }}<br>

                                            <form action="{{ route('gate.setGateOut', $jobOperation->id) }}" method="POST"
                                                class="mt-2">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">Set Gate Out</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif(isset($containerNumber))
                            <div class="alert alert-warning mt-4">
                                No results found for container number: <strong>{{ $containerNumber }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
