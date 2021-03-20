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
                        @if($message = session('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-sm table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Orders</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>
                                        <a href="{{ route('customers.show', $customer->id) }}">
                                            <i class="fas fa-eye"></i> {{ $customer->orders->count() }} Orders
                                        </a>
                                    </td>
                                    <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                                    <td class="d-flex">
                                        <a href="" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#editOrder{{ $customer->id }}"><i class="fas fa-edit"></i></a>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editOrder{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="editOrderModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('customers.update', $customer->id) }}" method="post">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" name="name" value="{{ $customer->name }}" id="name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone">Phone</label>
                                                                <input type="text" class="form-control" name="phone" value="{{ $customer->phone  }}" id="phone" required>
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

                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Delete Customer" class="btn btn-danger btn-sm" onclick="return confirm('Are you want to delete?')">
                                                <i class="fas fa-trash"></i>
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
