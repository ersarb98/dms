<!-- resources/views/inbound/show.blade.php -->
@extends('layouts.app')

@section('pageTitle', 'Order Receiving Details')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Order Receiving Details</span>
                <button id="backButton" class="btn btn-primary">Back to List</button>
            </div>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Order Number</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->order_number }}</dd>

                    <dt class="col-sm-3">Tipe Dokumen</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->tipe_dokumen }}</dd>

                    <dt class="col-sm-3">Nomor Dokumen</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->nomor_dokumen }}</dd>

                    <dt class="col-sm-3">Tanggal Dokumen</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($orderReceiving->tanggal_dokumen)->format('d-m-Y') }}</dd>

                    <dt class="col-sm-3">Pengirim</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->pengirim }}</dd>

                    <dt class="col-sm-3">Shipping Line</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->shipping_line }}</dd>

                    <dt class="col-sm-3">Voyage</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->voyage }}</dd>

                    <dt class="col-sm-3">Vessel</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->vessel }}</dd>

                    <dt class="col-sm-3">Asal</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->asal }}</dd>

                    <dt class="col-sm-3">Waktu Gate In</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($orderReceiving->waktu_gate_in)->format('d-m-Y H:i') }}
                    </dd>

                    <dt class="col-sm-3">Catatan</dt>
                    <dd class="col-sm-9">{{ $orderReceiving->catatan }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        @if ($orderReceiving->status === 'N')
                            <span class="badge bg-warning">Pending</span>
                        @elseif ($orderReceiving->status === 'Y')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </dd>
                </dl>

                <!-- If you want to show related containers, add another table here -->
                <h5>Containers</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Container Number</th>
                            <th>Type</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderReceiving->containers as $container)
                            <!-- Assuming you have a relationship set up -->
                            <tr>
                                <td>{{ $container->no_cont }}</td>
                                <td>{{ $container->type }}</td>
                                <td>{{ $container->size }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Handle Back button click
                document.getElementById('backButton').addEventListener('click', function() {
                    // Check if there's a stored URL in sessionStorage
                    var lastPage = sessionStorage.getItem('lastPage');
                    if (lastPage) {
                        window.location.href = lastPage; // Navigate to the last page
                    } else {
                        // Fallback if there's no lastPage stored
                        window.history.back();
                    }
                });
            });
        </script>
    @endpush

@endsection
