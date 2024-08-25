@extends('layouts.app')
@section('pageTitle', 'Order Delivery Detail')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Order Delivery Detail
            </div>
            <div class="card-body">
                <h5>Order Information</h5>
                <p><strong>Nomor Order:</strong> {{ $delivery->order_number }}</p>
                <p><strong>Waktu Pengeluaran:</strong> {{ $delivery->release_time }}</p>
                <p><strong>Jenis Dokumen:</strong> {{ $delivery->document_type }}</p>
                <p><strong>Nomor Dokumen:</strong> {{ $delivery->document_number }}</p>
                <p><strong>Tanggal Dokumen:</strong> {{ $delivery->document_date }}</p>
                <p><strong>Status:</strong>
                    @if ($delivery->FL_STATUS === 'N')
                        Pending
                    @elseif ($delivery->FL_STATUS === 'Y')
                        Accepted
                    @elseif ($delivery->FL_STATUS === 'X')
                        Reject
                    @else
                        Unknown
                    @endif
                </p>

                <h5>Container Details</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No Kontainer</th>
                            <th>Ukuran Kontainer</th>
                            <th>Jenis Kontainer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($delivery->orderDeliveryDtl as $container)
                            <tr>
                                <td>{{ $container->no_cont }}</td>
                                <td>{{ $container->size }}</td>
                                <td>{{ $container->type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
