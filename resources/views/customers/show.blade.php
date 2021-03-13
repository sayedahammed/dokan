@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm mb-2"><i class="fas fa-backward"></i> Back</a>
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if($message = session('delete-success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @elseif($message = session('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif
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
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->orders()->latest()->get() as $order)
                                <tr>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ date("d/m/Y", strtotime($order->created_at)) }}</td>
                                    <td>
                                        @if(!$order->status)
                                            <i class="fas fa-industry"></i> On Progress
                                        @else
                                            <i class="fas fa-check-circle"></i> Delivered
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->status)
                                            {{ date("d/m/Y", strtotime($order->updated_at)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        @if(!$order->status)
                                            <form action="{{ route('orders.update', $order->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn mr-1 btn-success btn-sm">
                                                    Complete
                                                </button>
                                            </form>
                                        @endif

                                        <a href="" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#editOrder"><i class="fas fa-edit"></i> Edit</a>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editOrder" tabindex="-1" role="dialog" aria-labelledby="editOrderModalLabel" aria-hidden="true">
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
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you want to delete?')">
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
            <div class="col-md-3">
               <div class="card">
                   <div class="card-body">
                       <h5>Add Order</h5>
                       <form action="{{ route('orders.store') }}" method="post">
                           @csrf
                           <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                           <div class="form-group">
                               <label for="order_no">Order No</label>
                               <input type="number" required class="form-control form-control-sm @error('order_no') is-invalid @enderror" name="order_no" id="order_no" placeholder="e.g: 78765">
                               @error('order_no')
                               <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                           <div class="form-group">
                               <label for="order_date">Date</label>
                               <input type="date" value="{{ date('Y-m-d') }}" required class="form-control form-control-sm @error('order_date') is-invalid @enderror" name="order_date" id="order_date">
                               @error('order_date')
                               <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                           </div>
                           <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add Order</button>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection
