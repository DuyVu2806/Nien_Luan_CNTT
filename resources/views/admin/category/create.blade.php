@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3> Add Category
                    <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm float-end">BACK</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Slug</label>
                            <input type="text" name="slug" class="form-control">
                            @error('slug')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description</label>
                            <input type="text" name="description" class="form-control">
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                            @error('quantity')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">Status</label><br>
                            <input type="checkbox" name="Status">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Meta title</label>
                            <textarea type="text" name="meta_title" class="form-control" rows="3"></textarea>
                            @error('meta_title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Meta description</label>
                            <textarea type="text" name="meta_description" class="form-control" rows="3"></textarea>
                            @error('meta_description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary text-white float-end">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
