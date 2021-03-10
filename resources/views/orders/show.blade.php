@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm mb-2"><i class="fas fa-backward"></i> Back</a>
        <div class="row">
            <div class="col-md-12">
               @if($message = session('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4>Order No: {{ $order->order_no }}</h4>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
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
</td>
                                    <td>{{ date("d-M-Y g:i a", strtotime($order->created_at)) }} </td>
                                    <td>{{ date("d-M-Y g:i a", strtotime($order->updated_at)) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
