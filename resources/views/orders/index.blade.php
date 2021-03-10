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
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_no }}</td>
                                    <td>
                                        <a href="{{ route('customers.show', $order->customer->id) }}">
                                            {{ $order->customer->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if(!$order->status)
                                            <form action="{{ route('orders.update', $order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn mr-2 btn-success btn-sm">
                                                    Complete Order
                                                </button>
                                            </form>
                                        @else
                                            <i class="fas fa-check-circle"></i> Delivered
                                        @endif
                                    </td>
                                    <td>{{ date("d/m/Y", strtotime($order->created_at)) }}</td>
                                    <td>{{ date("d/m/Y", strtotime($order->updated_at)) }}</td>
                                    <td>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Delete Order" class="btn btn-danger btn-sm" onclick="return confirm('Are you want to delete?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
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
