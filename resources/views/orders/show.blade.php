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
                        <h4><strong>Order No:</strong> {{ $order->order_no }}</h4>
                        <hr>
                        <p><strong>Customer Name:</strong> {{ $order->customer->name }}</p>
                        <p><strong>Status:</strong>
                            @if($order->status)
                                <span class="text-success">Delivered</span> <i class="fas fa-check-circle"></i>
                            @else
                                Pending <i class="fas fa-industry"></i>
                            @endif
                        </p>
                        <p><strong>Order Date:</strong> {{ date("d-M-Y g:i a", strtotime($order->created_at)) }} </p>
                        <p><strong>Delivery Date:</strong> {{ date("d-M-Y g:i a", strtotime($order->updated_at)) }} </p>

                        @if(!$order->status)
                            <form action="{{ route('orders.update', $order->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?')">Confirm Delivery</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
