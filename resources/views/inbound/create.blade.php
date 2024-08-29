@extends('layouts.app')
@section('pageTitle', 'Create Order Receiving')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Receiving
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inbound.store') }}" method="POST">
                            @csrf
                            <h4>Order</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="order_number">Order Number</label>
                                    <input type="text" id="order_number" name="order_number" class="form-control"
                                        required readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tipe_dokumen">Tipe Dokumen</label>
                                    <input type="text" id="tipe_dokumen" name="tipe_dokumen" class="form-control"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nomor_dokumen">Nomor Dokumen</label>
                                    <input type="text" id="nomor_dokumen" name="nomor_dokumen" class="form-control"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_dokumen">Tanggal Dokumen</label>
                                    <input type="date" id="tanggal_dokumen" name="tanggal_dokumen" class="form-control"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pengirim">Pengirim</label>
                                    <input type="text" id="pengirim" name="pengirim" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_line">Shipping Line</label>
                                    <input type="text" id="shipping_line" name="shipping_line" class="form-control"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="voyage">Voyage</label>
                                    <input type="text" id="voyage" name="voyage" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="vessel">Vessel</label>
                                    <input type="text" id="vessel" name="vessel" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="asal">Asal</label>
                                    <input type="text" id="asal" name="asal" class="form-control" required>
                                </div>
                            </div>

                            <h4>Gate In</h4>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="waktu_gate_in">Waktu Gate In</label>
                                    <input type="datetime-local" id="waktu_gate_in" name="waktu_gate_in"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="catatan">Catatan</label>
                                    <textarea id="catatan" name="catatan" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <h4>Containers</h4>
                            <div id="container-section">
                                <!-- Container inputs will be added here dynamically -->
                            </div>
                            <button type="button" id="add-container" class="btn btn-secondary mb-3">Add Container</button>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
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
        // Function to add a container input section
        function addContainer() {
            const containerSection = document.getElementById('container-section');

            const containerDiv = document.createElement('div');
            containerDiv.classList.add('container-input', 'mb-3');
            containerDiv.innerHTML = `
            <div class="row">
                <div class="col-md-4">
                    <label for="nomor_kontainer">Nomor Kontainer</label>
                    <input type="text" name="nomor_kontainer[]" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="tipe_kontainer">Tipe Kontainer</label>
                    <input type="text" name="tipe_kontainer[]" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="ukuran_kontainer">Ukuran Kontainer</label>
                    <input type="text" name="ukuran_kontainer[]" class="form-control" required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-container">X</button>
                </div>
            </div>
        `;

            containerSection.appendChild(containerDiv);
        }

        // Add event listener to the "Add Container" button
        document.getElementById('add-container').addEventListener('click', addContainer);

        // Add event listener to dynamically remove container inputs
        document.getElementById('container-section').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-container')) {
                e.target.closest('.container-input').remove();
            }
        });

        // Initial call to add one container input section by default
        addContainer();

        document.addEventListener('DOMContentLoaded', function() {
            // Function to generate a unique order number
            function generateUniqueOrderNumber() {
                const timestamp = new Date().getTime(); // Current timestamp
                const randomSalt = Math.random().toString(36).substring(2, 10); // Random salt
                return `REC-${timestamp}-${randomSalt}`; // Example format: ORD-1628302918101-xf2g4w6t
            }

            // Set the generated order number to the input field
            const orderNumberInput = document.getElementById('order_number');
            if (orderNumberInput) {
                orderNumberInput.value = generateUniqueOrderNumber();
            }
        });
    </script>
@endpush
