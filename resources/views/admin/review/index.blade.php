@extends('layouts.admin')

@section('style')
    <style>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Review</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name Product</th>
                                <th>Rate</th>
                                <th>User</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($listReview as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset($item->orderItem->product->productImages[0]->image) }}"
                                            alt="">
                                        {{ $item->orderItem->product->name }}
                                    </td>
                                    <td>
                                        @php
                                            $rating = $item->rating;
                                            $full_stars = floor($rating);
                                            $half_stars = round($rating - $full_stars, 1) * 10;
                                        @endphp
                                        <span class="stars" style="color: #F39C12">
                                            @for ($i = 0; $i < $full_stars; $i++)
                                                <i class="fa-sharp fa-solid fa-star"></i>
                                            @endfor
                                            @if ($half_stars > 0)
                                                <i class="fa-solid fa-star-half-stroke"></i>
                                            @endif
                                            @for ($i = $full_stars + 1; $i < 5; $i++)
                                                <i class="fa-regular fa-star"></i>
                                            @endfor

                                        </span>
                                    </td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#view-{{ $item->id }}">View Comment</button>
                                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                            data-bs-target="#reply-{{ $item->id }}">Reply</button>
                                    </td>
                                </tr>
                                {{-- start modal reply-comment --}}
                                <div class="modal fade" id="reply-{{ $item->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <form action="{{ url('admin/orders/reply/' . $item->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Comment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="reply_user_id" value="{{ $item->user_id }}"
                                                        hidden>
                                                    <div class="mb-2">
                                                        <label for="">Comment</label>
                                                        <textarea name="comment" rows="3"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- end modal reply-comment --}}

                                {{-- start modal view comment --}}
                                <div class="modal fade" id="view-{{ $item->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Comment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="m-2">
                                                    <label for="">Outstanding Feature</label>
                                                    <input type="text" class="form-control" id="outstanding_feature"
                                                        name="outstanding_feature" readonly
                                                        value="{{ $item->outstanding_feature }}">
                                                </div>

                                                <div class="m-2">
                                                    <label for="">Transportation</label>
                                                    <input type="text" class="form-control" id="transportation"
                                                        name="transportation" readonly value="{{ $item->transportation }}">
                                                </div>

                                                <div class="mb-2">
                                                    <label for="">Comment</label>
                                                    <textarea name="comment" id="comment" rows="3" readonly>{{ $item->comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end modal view comment --}}
                            @empty
                                <tr>
                                    <td colspan="4">No review</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div class="float-end">
                        {{ $listReview->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
