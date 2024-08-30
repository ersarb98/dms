@extends('layouts.app')
@section('pageTitle', 'Set Realisasi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Set Realisasi List</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success mt-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Display Error Message -->
                        @if (session('error'))
                            <div class="alert alert-danger mt-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('realisasi.search') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="containerNumber">Container Number:</label>
                                <input type="text" id="containerNumber" name="containerNumber" class="form-control"
                                    placeholder="Enter container number" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Search</button>
                        </form>


                        @if (isset($operations))
                            @if ($operations->isEmpty())
                                <p class="mt-4">No results found.</p>
                            @else
                                <table class="table table-striped mt-4">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Order Number</th>
                                            <th>Container ID</th>
                                            <th>Container Number</th>
                                            <th>Pending Job</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($operations as $operation)
                                            <tr>
                                                <td>{{ $operation->id }}</td>
                                                <td>{{ $operation->nomor_order }}</td>
                                                <td>{{ $operation->id_job_container }}</td>
                                                <td>{{ $operation->no_cont }}</td>
                                                <td>{{ $operation->jenis_job }}</td>
                                                <td>{{ $operation->status }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#createJobModal"
                                                        data-id="{{ $operation->id }}"
                                                        data-container="{{ $operation->no_cont }}">Set Realisasi</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Confirmation Modal -->
    <div class="modal fade" id="createJobModal" tabindex="-1" aria-labelledby="createJobModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createJobModalLabel">Confirm Set Realisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Mohon Pastikan Data Sudah Benar</p>
                    <form id="createJobForm" action="{{ route('realisasi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="containerId" id="modalContainerId">
                        <input type="hidden" name="containerNumber" id="modalContainerNumber">
                        <button type="submit" class="btn btn-primary">Ya, Set Realisasi</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        var createJobModal = document.getElementById('createJobModal');
        createJobModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var containerId = button.getAttribute('data-id'); // Extract info from data-id attribute
            var containerNumber = button.getAttribute(
                'data-container'); // Extract info from data-container attribute

            var modalContainerIdInput = createJobModal.querySelector('#modalContainerId');
            var modalContainerNumberInput = createJobModal.querySelector('#modalContainerNumber');

            modalContainerIdInput.value =
                containerId; // Update the modal's hidden input field with the container ID
            modalContainerNumberInput.value =
                containerNumber; // Update the modal's hidden input field with the container number
        });
    </script>
@endpush
