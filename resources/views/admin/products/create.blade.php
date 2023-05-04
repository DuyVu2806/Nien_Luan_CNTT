@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Add Product
                        <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab-pane" aria-selected="false">SEO
                                    tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="detail-tab" data-bs-toggle="tab"
                                    data-bs-target="#detail-tab-pane" type="button" role="tab"
                                    aria-controls="detail-tab-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="tab"
                                    data-bs-target="#color-tab-pane" type="button" role="tab"
                                    aria-controls="color-tab-pane" aria-selected="false">Colors</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="">Category</label>
                                    <select name="category_id" id="" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Product name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="">Product slug</label>
                                    <input type="text" class="form-control" name="slug">
                                </div>
                                <div class="mb-3">
                                    <label for="">Select Brand</label>
                                    <select name="brand_id" id="" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Small Description (500 Words)</label>
                                    <textarea name="small_description" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Description </label>
                                    <textarea class="description" name="description"></textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel"
                                aria-labelledby="seotag-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="">Meta title</label>
                                    <input type="text" class="form-control" name="meta_title">
                                </div>
                                <div class="mb-3">
                                    <label for="">Meta Description (500 Words)</label>
                                    <textarea name="meta_description" class="form-control" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="detail-tab-pane" role="tabpanel"
                                aria-labelledby="detail-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Original Price</label>
                                            <input type="text" name="original_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Quantity</label>
                                            <input type="text" name="quantity" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Trending</label>
                                            <input type="checkbox" name="trending">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Status</label>
                                            <input type="checkbox" name="status">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="">Upload Product Image</label>
                                    <input type="file" multiple class="form-control" name="image[]">
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel"
                                aria-labelledby="color-tab" tabindex="0">
                                <div class="mb-4">
                                    <label for="">Select Color</label>
                                    <hr>
                                    <div class="row">
                                        @forelse ($colors as $color)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">
                                                    Color:<input type="checkbox" name="colors[{{$color->id}}]"
                                                        value="{{ $color->id }}">
                                                    {{ $color->name }} <br>
                                                    Quantity: <input type="number" name="colorquantity[{{$color->id}}]"
                                                        style="width:70px ; border: 1px solid">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-3">
                                                <h3>No Color Found</h3>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea.description',
        width: 1100,
        height: 300,
        plugins: 'link image code', // Thêm các plugin bạn muốn sử dụng
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
    });
</script>
@endsection


