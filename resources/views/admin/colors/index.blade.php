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
                        Color List
                        <a href="{{ url('admin/colors/create') }}" class="btn btn-primary btn-sm float-end">Add Color</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($colors as $color)
                                <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td>{{ $color->code }}</td>
                                    <td>{{ $color->status ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ url('admin/colors/' . $color->id . '/edit') }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="{{ url('admin/colors/' . $color->id . '/delete') }}" class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteColorModal{{ $color->id }}">Delete</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteColorModal{{ $color->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Color Deleted</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ url('admin/colors/' . $color['id']) }}">
                                                <div class="modal-body">
                                                    <h6>Are you sure you want to delete this color <strong class="text-primary">{{ $color->name }}</strong> ?</h6>
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
                                    <td colspan="5">No Colors</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div class="float-end">
                        {{$colors->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
