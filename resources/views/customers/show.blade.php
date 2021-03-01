@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm mb-2"><i class="fas fa-backward"></i> Back</a>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h4><strong>{{ $customer->name }}</strong>'s Orders</h4>
                        <hr>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Status</th>
                                    <th>Order At</th>
                                    <th>Delivery At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->orders as $order)
                                <tr>
                                    <td><a href="{{ route('orders.show', $order->id) }}">{{ $order->order_no }}</a></td>
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
            <div class="col-md-3">
               <div class="card">
                   <div class="card-body">
                       <h5>Add Order</h5>
                       <form action="{{ route('orders.store') }}" method="post">
                           @csrf
                           <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                           <div class="form-group">
                               <label for="order_no">Order No</label>
                               <input type="text" class="form-control form-control-sm" name="order_no" id="order_no" placeholder="Enter order no">
                           </div>
                           <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add Order</button>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection
