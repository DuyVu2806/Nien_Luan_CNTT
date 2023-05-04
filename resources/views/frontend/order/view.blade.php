@extends('layouts.app')

@section('title', 'Order')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <style>
        .product-name {
            font-size: 11pt;
            font-weight: 600;
            color: #000;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            width: 10px;
        }

        textarea {
            width: 100%;
            height: 120px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            resize: none;
        }
    </style>
@endsection

@section('content')
    @php
        $total = 0;
    @endphp
    <div class="py-3 py-md-2 bg-light">
        <div class="mt-2 py-3">
            <div class="col-md-12">
                <h4>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> My Order Detail: {{ $order->stracking_no }}
                    <a href="{{ url('order') }}" class="btn btn-sm btn-info float-right">BACK</a>
                </h4>
            </div>
            <hr>
            <div class="row ml-1 mr-1">
                <div class="col-md-5 card card-body">
                    <h4 class="mb-3 font-weight-bold">Personal information</h4>
                    <div class="mb-3">
                        <label for="" style="font-size: 16pt">Name:</label> <span
                            class="h5 text-dark">{{ $order->fullname }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="" style="font-size: 16pt">Email:</label> <span
                            class="h5 text-dark">{{ $order->email }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="" style="font-size: 16pt">Phone:</label> <span
                            class="h5 text-dark">{{ $order->phone }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="" style="font-size: 16pt">Address:</label> <span
                            class="h5 text-dark">{{ $order->address }}</span>
                    </div>
                </div>
                <div class="col-md-7 card card-body">
                    <h4 class="font-weight-bold">Product information</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Price</th>
                                @if ($order->status_message == 'delivered')
                                    <th width>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItem as $item)
                                <tr>
                                    <td class="product-name">{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="d-flex justify-content-center">
                                        @if (isset($item->product_color_id))
                                            <div
                                                style=" width: 30px; height: 30px; background-color: {{ $item->productColor->color->code }};">
                                            </div>
                                        @else
                                            @foreach ($item->product->productColors as $itemColor)
                                                <div
                                                    style=" width: 30px; height: 30px; background-color: {{ $itemColor->color->code }};">
                                                </div>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td class="text-center">${{ $item->price }}</td>
                                    
                                        <td style="line-height: 100%">
                                            @if ($order->status_message == 'delivered' && $item->rstatus == false)
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                data-toggle="modal" data-target="#Modal-{{ $item->id }}">
                                                Reivew
                                            </button>
                                            {{-- Modal Evaluate rating --}}
                                            <form role="form" action="{{ url('review/' . $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal fade" id="Modal-{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Product
                                                                    Reviews
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="rateYo_{{ $item->id }}" class="mb-2 rateYo">
                                                                </div>
                                                                <input type="hidden" name="rating"
                                                                    id="rateYo_{{ $item->id }}_rating" value="5">
                                                                <input type="hidden" name="product_id" id="product_id"
                                                                    value={{ $item->product_id }}>
                                                                <div class="m-2">
                                                                    <label for="">Outstanding Feature</label>
                                                                    <input type="text" class="form-control"
                                                                        id="outstanding_feature" name="outstanding_feature">
                                                                </div>

                                                                <div class="m-2">
                                                                    <label for="">Transportation</label>
                                                                    <input type="text" class="form-control"
                                                                        id="transportation" name="transportation">
                                                                </div>

                                                                <div class="mb-2">
                                                                    <label for="">Comment</label>
                                                                    <textarea name="comment" id="comment" rows="3"></textarea>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary evaluate-btn"
                                                                    data-product-id="{{ $item->product_id }}"
                                                                    data-id="{{ $item->id }}">Evaluation</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            {{-- End Modal Evaluate rating --}}
                                            @else
                                            <h6 class="text-center text-success">Rated</h6>
                                            @endif
                                        </td>
                                    
                                </tr>
                                @php
                                    $total += $item->quantity * $item->price;
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="3">Total:</td>
                                <td class="text-center">
                                    ${{ $total }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(function() {
            $('.rateYo').each(function() {
                var id = $(this).attr('id');
                $(this).rateYo({
                    rating: 5,
                    halfStar: true,
                }).on("rateyo.set", function(e, data) {
                    $('#' + id + '_rating').val(data.rating);
                });
            });

        });

        $(".evaluate-btn").click(function() {
            var rating = $(this).closest(".modal-content").find(".rateYo").rateYo("rating");
            var comment = $(this).closest(".modal-content").find(".modal-body #comment").val();
            var outstanding_feature = $(this).closest(".modal-content").find(
                ".modal-body #outstanding_feature").val();
            var transportation = $(this).closest(".modal-content").find(".modal-body #transportation")
                .val();
            var productId = $('#product_id').val();
            var id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/review/" + id,
                data: {
                    rating: rating,
                    comment: comment,
                    outstanding_feature: outstanding_feature,
                    transportation: transportation,
                    productId: productId
                },
                success: function(data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your message here',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        $('#Modal-' + productId).modal('hide');
                        location.reload();
                    });
                }
            });
        });
    </script>
@endsection
