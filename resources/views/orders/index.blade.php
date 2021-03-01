@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Orders</h4>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Order No</th>
                                    <th>Status</th>
                                    <th>Ordered At</th>
                                    <th>Delivered At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('customers.show', $order->customer->id) }}">
                                            {{ $order->customer->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}">
                                            {{ $order->order_no }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($order->status)
                                            <span class="text-success">Delivered</span> <i class="fas fa-check-circle"></i>
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td>{{ date("d-M-Y g:i a", strtotime($order->created_at)) }}</td>
                                    <td>{{ date("d-M-Y g:i a", strtotime($order->updated_at)) }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
