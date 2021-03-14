@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 order-last order-md-first">
                <div class="card">
                    <div class="card-body">
                        <h4>Orders <a href="{{ route('orders.index') }}" class="btn btn-sm"> <i class="fas fa-sync-alt"></i> </a></h4>
                        @if($message = session('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
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
                                           <i class="fas fa-industry"></i> On Progress
                                        @else
                                            <i class="fas fa-check-circle"></i> Delivered
                                        @endif
                                    </td>
                                    <td>{{ date("d/m/Y", strtotime($order->created_at)) }}</td>
                                    <td>
                                        @if($order->status)
                                            {{ date("d/m/Y", strtotime($order->updated_at)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        @if(!$order->status)
                                            <form action="{{ route('orders.complete', $order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn mr-1 btn-success btn-sm">
                                                    Complete
                                                </button>
                                            </form>
                                        @endif

                                        <a href="" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#editOrder{{ $order->id }}"><i class="fas fa-edit"></i> Edit</a>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editOrder{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="editOrderModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="order_no">Order No</label>
                                                                <input type="text" class="form-control" name="order_no" value="{{ $order->order_no }}" id="order_no" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="order_date">Order Date</label>
                                                                <input type="date" class="form-control" name="order_date" value="{{ $order->order_date  }}" id="order_date" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('orders.destroy', $order->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Delete Order" class="btn btn-danger mr-1 btn-sm" onclick="return confirm('Are you want to delete?')">
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
