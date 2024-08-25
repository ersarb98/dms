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
                <!-- Search Input -->
                <div class="mb-3">
                    <input type="text" id="filter-input" class="form-control" placeholder="Filter by text...">
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order Info</th>
                            <th>Master Document</th>
                            <th>Regular Document</th>
                            <th>Yard</th>
                            <th>Total Container</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-body">
                        <!-- Data will be inserted here by JavaScript -->
                    </tbody>
                    <div id="no-data" class="text-center" style="display: none;">
                        <p class="text-muted">No Data</p>
                    </div>
                </table>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script>
        // Sample data
        const data = [{
                no: 1,
                orderInfo: 'Order 001',
                masterDocument: 'Doc 001',
                regularDocument: 'Reg Doc 001',
                yard: 'Yard A',
                totalContainer: 10,
                status: 'Pending',
                action: '<button class="btn btn-primary">View</button>'
            },
            {
                no: 2,
                orderInfo: 'Order 002',
                masterDocument: 'Doc 002',
                regularDocument: 'Reg Doc 002',
                yard: 'Yard B',
                totalContainer: 15,
                status: 'Completed',
                action: '<button class="btn btn-primary">View</button>'
            }
            // Add more data as needed
        ];

        // Function to populate the table
        function populateTable(data) {
            const tableBody = document.getElementById('data-table-body');
            const noData = document.getElementById('no-data');

            tableBody.innerHTML = ''; // Clear existing data

            if (data.length === 0) {
                noData.style.display = 'block'; // Show "No Data" message
            } else {
                noData.style.display = 'none'; // Hide "No Data" message
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${item.no}</td>
                    <td>${item.orderInfo}</td>
                    <td>${item.masterDocument}</td>
                    <td>${item.regularDocument}</td>
                    <td>${item.yard}</td>
                    <td>${item.totalContainer}</td>
                    <td>${item.status}</td>
                    <td>${item.action}</td>
                `;
                    tableBody.appendChild(row);
                });
            }
        }

        // Populate the table with sample data
        populateTable(data);

        // Real-time filtering functionality
        $('#filter-input').on('input', function() {
            const query = $(this).val().toLowerCase();
            const filteredData = data.filter(item =>
                item.orderInfo.toLowerCase().includes(query) ||
                item.masterDocument.toLowerCase().includes(query) ||
                item.regularDocument.toLowerCase().includes(query) ||
                item.yard.toLowerCase().includes(query) ||
                item.status.toLowerCase().includes(query)
            );
            populateTable(filteredData);
        });

        // Later, replace sample data with AJAX call
        // $.ajax({
        //     url: 'your-api-endpoint',
        //     method: 'GET',
        //     success: function(response) {
        //         populateTable(response.data);
        //     },
        //     error: function(error) {
        //         console.error('Error fetching data:', error);
        //     }
        // });
    </script>
@endpush
