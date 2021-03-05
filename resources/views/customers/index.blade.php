@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 order-last order-md-first">
                @if($message = session('delete-success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h4>Customers <a href="{{ route('customers.index') }}" class="btn btn-sm"> <i class="fas fa-sync-alt"></i> </a></h4>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Orders</th>
                                    <th>Actions</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td><a href="{{ route('customers.show', $customer->id) }}">
                                            <i class="fas fa-shopping-cart"></i> View Orders ({{ $customer->orders->count() }})
                                        </a></td>
                                    <td>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you want to delete?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                    <td>{{ date("d/m/Y", strtotime($customer->created_at)) }}</td>
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
                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" id="name" placeholder="e.g: John Doe" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" maxlength="11" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="e.g: 018XXXXXXXX" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Add Customer</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <h5>Search Customer</h5>
                        <form action="{{ route('customers.search') }}" method="get">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="number" class="form-control form-control-sm @if (session('customer-not-found')) is-invalid @endif" name="phone" id="phone" placeholder="e.g: 018XXXXXXXX" required>
                                @if( $message = session('customer-not-found'))
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
