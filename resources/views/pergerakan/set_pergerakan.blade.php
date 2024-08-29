@extends('layouts.app')
@section('pageTitle', 'Set Pergerakan')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Set Pergerakan List</h3>
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
                        <form action="{{ route('pergerakan.search') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="containerNumber">Container Number:</label>
                                <input type="text" id="containerNumber" name="containerNumber" class="form-control" placeholder="Enter container number" required>
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
                                            <th>Finished Job</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($operations as $operation)
                                            <tr>
                                                <td>{{ $operation->id }}</td>
                                                <td>{{ $operation->nomor_order }}</td>
                                                <td>{{ $operation->container_id }}</td>
                                                <td>{{ $operation->no_cont }}</td>
                                                <td>{{ $operation->jenis_job }}</td>
                                                <td>{{ $operation->status }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createJobModal" data-id="{{ $operation->container_id }}" data-container="{{ $operation->no_cont }}">Create New Job</button>
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
    <div class="modal fade" id="createJobModal" tabindex="-1" aria-labelledby="createJobModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createJobModalLabel">Create New Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createJobForm" action="{{ route('pergerakan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="containerId" id="modalContainerId">
                        <input type="hidden" name="containerNumber" id="modalContainerNumber">
    
                        <div class="mb-3">
                            <label for="jenisJob" class="form-label">Jenis Job</label>
                            <select class="form-select" id="jenisJob" name="jenis_job" required>
                                <option value="" disabled selected>Select Job Type</option>
                                <option value="LIFT ON">LIFT ON</option>
                                <option value="LIFT OFF">LIFT OFF</option>
                                <option value="RELOCATION">RELOCATION</option>
                                <option value="INSPECTION">INSPECTION</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lokasiAkhir" class="form-label">Lokasi Akhir</label>
                            <input type="text" class="form-control" id="lokasiAkhir" name="lokasi_akhir" required>
                        </div>
                        <div class="mb-3">
                            <label for="tierAkhir" class="form-label">Tier</label>
                            <input type="text" class="form-control" id="tierAkhir" name="tier_akhir" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')
    <script>
        var createJobModal = document.getElementById('createJobModal');
        createJobModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var containerId = button.getAttribute('data-id'); // Extract info from data-id attribute
            var containerNumber = button.getAttribute('data-container'); // Extract info from data-container attribute
            
            var modalContainerIdInput = createJobModal.querySelector('#modalContainerId');
            var modalContainerNumberInput = createJobModal.querySelector('#modalContainerNumber');
            
            modalContainerIdInput.value = containerId; // Update the modal's hidden input field with the container ID
            modalContainerNumberInput.value = containerNumber; // Update the modal's hidden input field with the container number
        });
    </script>
@endpush