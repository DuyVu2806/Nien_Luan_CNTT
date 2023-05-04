@extends('layouts.admin')

@section('content')
    <div class="card mb-2">
        <div class="card-header">
            <h3>
                Order Detail
                <a href="{{ url('admin/orders/') }}" class="btn btn-info btn-sm float-end mx-1">BACK</a>
                <a href="{{ url('admin/invoice/'.$order->id.'/generate') }}" class="btn btn-primary btn-sm float-end mx-1 text-light">Download Invoice</a>
                <a href="{{ url('admin/invoice/'.$order->id )}}" target="_blank" class="btn btn-warning btn-sm float-end mx-1 text-light">View Invoice</a>
            </h3>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Order Detail</h5>
                    <hr>
                    <h6>Order Id: <span>{{ $order->id }}</span></h6>
                    <h6>Tracking_No: <span>{{ $order->stracking_no }}</span></h6>
                    <h6>Ordered Date: <span>{{ $order->created_at }}</span></h6>
                    <h6>Payment Mode: <span>{{ $order->payment_mode }}</span></h6>
                    @if ($order->status_message === 'cancelled')
                    @endif

                    @switch($order->status_message)
                        @case('cancelled')
                            <button class="btn btn-outline-danger text-uppercase w-100" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">{{ $order->status_message }}</button>
                        @break

                        @case('delivered')
                            <button class="btn btn-outline-success text-uppercase w-100">{{ $order->status_message }}</button>
                        @break

                        @default
                            <button class="btn btn-outline-success text-uppercase w-100" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">{{ $order->status_message }}</button>
                        @break
                    @endswitch

                    {{-- Start modal status_message --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ url('/admin/orders/' . $order->id) }}" method="POST" role="form">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Status Message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="min-height: 150px">
                                        <select class="form-select" name="status_message">
                                            <option value="in progress"
                                                {{ $order->status_message == 'in progress' ? 'selected' : '' }}>In Progress
                                            </option>
                                            <option value="pending"
                                                {{ $order->status_message == 'pending' ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="delivered"
                                                {{ $order->status_message == 'delivered' ? 'selected' : '' }}>Delivery
                                            </option>
                                            <option value="cancelled"
                                                {{ $order->status_message == 'cancelled' ? 'selected' : '' }}>Cancelled
                                            </option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End modal status_message --}}
                </div>

                <div class="col-md-6">
                    <h5>User Detail</h5>
                    <hr>
                    <h6>Full Name: <span>{{ $order->fullname }}</span></h6>
                    <h6>Email: <span>{{ $order->email }}</span></h6>
                    <h6>Phone: <span>{{ $order->phone }}</span></h6>
                    <h6>Address: <span>{{ $order->address }}</span></h6>
                    <h6>Pin Code: <span>{{ $order->pincode }}</span></h6>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr class="table-active">
                <th class="text-center" width='5%'>Number</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($order->orderItem as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td><img src="{{ asset($item->product->productImages[0]->image) }}" alt="" height="50px"
                            width="50px"></td>
                    <td>{{ $item->product->name }}</td>
                    <td>$ {{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>$ {{ $item->quantity * $item->price }}</td>
                    @php
                        $total += $item->quantity * $item->price;
                    @endphp
                </tr>
            @endforeach
            <tr class="table-active">
                <td colspan="5">Total Amount: </td>
                <td colspan="1">${{ $total }}</td>
            </tr>
        </tbody>
    </table>
@endsection
