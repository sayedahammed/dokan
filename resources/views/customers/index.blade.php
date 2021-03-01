@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 order-last order-md-first">
                <div class="card">
                    <div class="card-body">
                        <h4>Customers <a href="{{ route('customers.index') }}" class="btn btn-sm"> <i class="fas fa-sync-alt"></i> </a></h4>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        <a href="{{ route('customers.show', $customer->id) }}">
                                            {{ $customer->name }}
                                        </a>
                                    </td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ date("d-M-Y g:i a", strtotime($customer->created_at)) }}</td>
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
                        <h5>Add Customer</h5>
                        <form action="{{ route('customers.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name" placeholder="Enter customer name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control form-control-sm" name="phone" id="phone" placeholder="Enter phone number" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add Customer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
