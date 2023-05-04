@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Order</h3>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label for="">Filter By Date</label>
                                <input type="date" name="date" value="{{ Request::get('date') ?? '' }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">Filter By Status</label>
                                <select name="status" class="form-select">
                                    <option value=""> -->Select Status<-- </option>
                                    <option value="in progress"
                                        {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="delivered" {{ Request::get('status') == 'delivered' ? 'selected' : '' }}>
                                        Delivery</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="cancelled" {{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                    <option value="our-for-delivery"
                                        {{ Request::get('status') == 'our-for-delivery' ? 'selected' : '' }}>Our for
                                        delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered table-triped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tracking_no</th>
                                <th>Username</th>
                                <th>Payment Mode</th>
                                <th>OrderDate</th>
                                <th>Status Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->stracking_no }}</td>
                                    <td>{{ $item->fullname }}</td>
                                    <td>{{ $item->payment_mode }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $item->status_message }}</td>
                                    <td><a href="{{ url('admin/orders/' . $item->id) }}"
                                            class="btn btn-sm btn-info">View</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Order Item.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2 float-end">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
