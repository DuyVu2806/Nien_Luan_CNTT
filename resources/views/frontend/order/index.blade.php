@extends('layouts.app')

@section('title', 'Order')

@section('content')
    <div class="py-3 py-md-2 bg-light">
        <div class="mt-2 py-3">
            <div class="col-md-12">
                <h4 class="mb-4">My Orders</h4>
                <hr>
                <table class="table table-bordered">
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
                                <td>{{$item->id}}</td>
                                <td>{{$item->stracking_no}}</td>
                                <td>{{$item->fullname}}</td>
                                <td>{{$item->payment_mode}}</td>
                                <td>{{$item->created_at->format('d-m-Y')}}</td>
                                <td>{{$item->status_message}}</td>
                                <td><a href="{{url('order/'.$item->id)}}" class="btn btn-sm btn-info">View</a></td>
                            </tr>                            
                        @empty
                            <tr><td colspan="7">No Order Item. <a href="{{url('all-product')}}">Order now</a></td></tr>
                        @endforelse

                    </tbody>
                </table>
                <div>
                    {{$orders->links()}}
                </div>
                
            </div>
        </div>
    </div>
@endsection