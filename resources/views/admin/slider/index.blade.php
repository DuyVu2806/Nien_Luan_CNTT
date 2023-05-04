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
                    <h3>
                        Silder List
                        <a href="{{ url('admin/sliders/create') }}" class="btn btn-primary btn-sm float-end">Add Slider</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                        <img src="{{ asset($slider->image) }}" width="70px" height="70px" alt="">
                                    </td>
                                    <td>{{ $slider->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ url('admin/sliders/' . $slider->id . '/edit') }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteSliderModal{{ $slider->id }}">Delete</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteSliderModal{{ $slider->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Slider Deleted</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ url('admin/sliders/' . $slider['id']) }}" method="GET">
                                                @csrf
                                                <div class="modal-body">
                                                    <h6>Are you sure you want to delete this slider <strong
                                                            class="text-primary">{{ $slider->title }}</strong> ?</h6>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Yes. Delete</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6">No Slider Found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
