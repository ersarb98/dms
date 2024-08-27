@extends('layouts.app')
@section('pageTitle', 'Order Receiving')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Order Receiving</span>
                <a href="{{ route('receiving.index') }}" class="btn btn-primary">Create</a>
            </div>
            <div class="card-body">
                @if ($orderReceivings->isEmpty())
                    <p>No records found.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Tipe Dokumen</th>
                                <th>Nomor Dokumen</th>
                                <th>Tanggal Dokumen</th>
                                <th>Pengirim</th>
                                <th>Waktu Gate In</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderReceivings as $orderReceiving)
                                <tr>
                                    <td>{{ $orderReceiving->order_number }}</td>
                                    <td>{{ $orderReceiving->tipe_dokumen }}</td>
                                    <td>{{ $orderReceiving->nomor_dokumen }}</td>
                                    <td>{{ \Carbon\Carbon::parse($orderReceiving->tanggal_dokumen)->format('d-m-Y') }}</td>
                                    <td>{{ $orderReceiving->pengirim }}</td>
                                    <td>{{ \Carbon\Carbon::parse($orderReceiving->waktu_gate_in)->format('d-m-Y H:i') }}
                                    </td>
                                    <td>{{ $orderReceiving->catatan }}</td>
                                    <td>
                                        @if ($orderReceiving->status === 'N')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($orderReceiving->status === 'Y')
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('receiving.show', $orderReceiving->id) }}"
                                            class="btn btn-info btn-sm">
                                            View Details
                                        </a>
                                        @if ($orderReceiving->status === 'N')
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $orderReceiving->id }}">
                                                Delete
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        sessionStorage.setItem('lastPage', window.location.href);

        // JavaScript to handle modal form submission
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var id = button.getAttribute('data-id'); // Extract info from data-* attributes
                var form = deleteModal.querySelector('#delete-form');
                form.action = '/inbound/' + id; // Update form action to the correct route
            });
        });
    </script>
@endpush
