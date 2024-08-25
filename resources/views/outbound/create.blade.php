@extends('layouts.app')
@section('pageTitle', 'Create Order Delivery')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Delivery
                    </div>
                    <div class="card-body">
                        <form action="{{ route('deliveries.store') }}" method="POST">
                            @csrf

                            <!-- Create Section -->
                            <div class="mb-3">
                                <h5>Create</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="order_number" class="form-label">Nomor Order</label>
                                        <input type="text" class="form-control" id="order_number" name="order_number"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="release_time" class="form-label">Waktu Pengeluaran</label>
                                        <input type="datetime-local" class="form-control" id="release_time"
                                            name="release_time" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Document Section -->
                            <div class="mb-3">
                                <h5>Document</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="document_type" class="form-label">Jenis Dokumen</label>
                                        <input type="text" class="form-control" id="document_type" name="document_type"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="document_number" class="form-label">Nomor Dokumen</label>
                                        <input type="text" class="form-control" id="document_number"
                                            name="document_number" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="document_date" class="form-label">Tanggal Dokumen</label>
                                        <input type="date" class="form-control" id="document_date" name="document_date"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Truk Section -->
                            <div class="mb-3">
                                <h5>Truk</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="truck_type" class="form-label">Jenis Truk</label>
                                        <input type="text" class="form-control" id="truck_type" name="truck_type"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="license_plate" class="form-label">Nomor Polisi</label>
                                        <input type="text" class="form-control" id="license_plate" name="license_plate"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Container Section -->
                            <div class="mb-3">
                                <h5>Container</h5>
                                <div id="container-section">
                                    <div class="row container-item">
                                        <div class="col-md-4">
                                            <label for="container_number" class="form-label">Nomor Kontainer</label>
                                            <input type="text" class="form-control" name="container_number[]" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="container_size" class="form-label">Ukuran Kontainer</label>
                                            <input type="text" class="form-control" name="container_size[]" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ukuran_cont" class="form-label">Ukuran Cont</label>
                                            <input type="number" class="form-control" name="ukuran_cont[]" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end pt-3">
                                            <button type="button" class="btn btn-danger remove-container">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-2">
                                    <button type="button" id="add-container" class="btn btn-secondary">Add
                                        Container</button>
                                </div>
                            </div>

                            <!-- Tujuan and Catatan Section -->
                            <div class="mb-3">
                                <h5>Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="destination" class="form-label">Tujuan</label>
                                        <input type="text" class="form-control" id="destination" name="destination"
                                            required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="notes" class="form-label">Catatan</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('add-container').addEventListener('click', function() {
            let containerSection = document.getElementById('container-section');
            let newContainer = document.createElement('div');
            newContainer.classList.add('row', 'container-item');
            newContainer.innerHTML = `
            <div class="col-md-4">
                <label for="container_number" class="form-label">Nomor Kontainer</label>
                <input type="text" class="form-control" name="container_number[]" required>
            </div>
            <div class="col-md-4">
                <label for="container_size" class="form-label">Ukuran Kontainer</label>
                <input type="text" class="form-control" name="container_size[]" required>
            </div>
            <div class="col-md-4">
                <label for="ukuran_cont" class="form-label">Ukuran Cont</label>
                <input type="number" class="form-control" name="ukuran_cont[]" required>
            </div>
            <div class="col-md-2 d-flex align-items-end pt-3">
                <button type="button" class="btn btn-danger remove-container">Remove</button>
            </div>

        `;
            containerSection.appendChild(newContainer);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-container')) {
                e.target.closest('.container-item').remove();
            }
        });
    </script>
@endpush
