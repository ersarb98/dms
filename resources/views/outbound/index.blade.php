@extends('layouts.app')
@section('pageTitle', 'Order Delivery')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Order Delivery</span>
                <a href="{{ route('deliveries.index') }}" class="btn btn-primary">Create</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Order</th>
                            <th>Waktu Pengeluaran</th>
                            <th>Jenis Dokumen</th>
                            <th>Nomor Dokumen</th>
                            <th>Tanggal Dokumen</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deliveries as $index => $delivery)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $delivery->order_number }}</td>
                                <td>{{ $delivery->release_time }}</td>
                                <td>{{ $delivery->document_type }}</td>
                                <td>{{ $delivery->document_number }}</td>
                                <td>{{ $delivery->document_date }}</td>
                                <td>
                                    @if ($delivery->FL_STATUS === 'N')
                                        Pending
                                    @elseif ($delivery->FL_STATUS === 'Y')
                                        Accepted
                                    @elseif ($delivery->FL_STATUS === 'X')
                                        Reject
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>
                                    <!-- Add buttons or links for actions like edit, delete -->
                                    <a href="{{ route('deliveries.show', $delivery->id) }}" class="btn btn-warning btn-sm">Detail</a>
                                    <!-- Delete Button triggers modal -->
                                    @if ($delivery->FL_STATUS === 'N')
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $delivery->id }}"
                                            data-toggle="modal" data-target="#deleteModal">Delete</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this delivery?
                </div>
                <div class="modal-footer">
                    <form id="delete-form" action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach click event to all delete buttons
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var deliveryId = this.getAttribute('data-id');
                    var form = document.getElementById('delete-form');
                    form.action = '/outbound/' + deliveryId; // Set the action URL dynamically
                });
            });
        });
    </script>
@endpush
