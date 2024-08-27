@extends('layouts.app')
@section('pageTitle', 'Approval Order Receiving')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Approval Order Receiving</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Tipe Dokumen</th>
                            <th>Nomor Dokumen</th>
                            <th>Tanggal Dokumen</th>
                            <th>Pengirim</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->tipe_dokumen }}</td>
                                <td>{{ $order->nomor_dokumen }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->tanggal_dokumen)->format('d-m-Y') }}</td>
                                <td>{{ $order->pengirim }}</td>
                                <td>
                                    <a href="{{ route('receiving.show', $order->id) }}" class="btn btn-info btn-sm">
                                        View Details
                                    </a>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal"
                                        data-action="{{ route('approval.approve', $order->id) }}"
                                        data-type="approve">Approve</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal"
                                        data-action="{{ route('approval.reject', $order->id) }}"
                                        data-type="reject">Reject</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Confirmation -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to <span id="actionType"></span> this order?
                </div>
                <div class="modal-footer">
                    <form id="action-form" method="POST">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        sessionStorage.setItem('lastPage', window.location.href);

        // JavaScript to handle the action in the modal
        var confirmModal = document.getElementById('confirmModal');
        confirmModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var action = button.getAttribute('data-action');
            var type = button.getAttribute('data-type');
            var actionForm = document.getElementById('action-form');

            actionForm.action = action; // Set the form action URL
            document.getElementById('actionType').innerText = type; // Set the action type text
        });
    </script>
@endpush
