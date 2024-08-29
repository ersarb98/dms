@extends('layouts.app')
@section('pageTitle', 'Operation List')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Operation List</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($operations->isEmpty())
                            <p>No operations found.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order Number</th>
                                        <th>Container Number</th>
                                        <th>Job Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($operations as $operation)
                                        <tr>
                                            <td>{{ $operation->id }}</td>
                                            <td>{{ $operation->nomor_order ?? $operation->jobContainer->jobHdr->nomor_order }}
                                            </td>
                                            <td>{{ $operation->no_cont ?? $operation->jobContainer->no_cont }}</td>
                                            <td>{{ $operation->jenis_job }}</td>
                                            <td>{{ $operation->status }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
