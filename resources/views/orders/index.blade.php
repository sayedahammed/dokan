@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 order-last order-md-first">
                <div class="card">
                    <div class="card-body">
                        <h4>Orders <a href="{{ route('orders.index') }}" class="btn btn-sm"> <i class="fas fa-sync-alt"></i> </a></h4>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Customer Name</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}">
                                            {{ $order->order_no }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('customers.show', $order->customer->id) }}">
                                            {{ $order->customer->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($order->status)
                                            <span class="text-success">Delivered</span> <i class="fas fa-check-circle"></i>
                                        @else
                                            Pending <i class="fas fa-industry"></i>
                                        @endif
                                    </td>
                                    <td>{{ date("d/m/Y", strtotime($order->created_at)) }}</td>
                                    <td>{{ date("d/m/Y", strtotime($order->updated_at)) }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 order-first order-md-last">
                <div class="card">
                    <div class="card-body">
                        <h5>Search Order</h5>
                        <form action="{{ route('orders.search') }}" method="get">
                            <div class="form-group">
                                <label for="order_no">Order No</label>
                                <input type="number" class="form-control form-control-sm @if (session('order-not-found')) is-invalid @endif" name="order_no" id="order_no" placeholder="e.g: 78765" required>
                                @if( $message = session('order-not-found'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
