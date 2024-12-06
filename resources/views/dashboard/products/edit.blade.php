@extends('layout.dashboard')

@section('title')
    Edit Products
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data" id="quickForm">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name Of Products</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ $product->name }}">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug Of Products</label>
                                <input type="text" name="slug"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ $product->slug }}">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price Of Products</label>
                                <input type="text" name="price"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ $product->price }}">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <label for="floatingTextarea2">Description</label>
                                <textarea class="form-control" name="description" placeholder="Write Description Here" id="floatingTextarea2"
                                    style="height: 100px">{{ $product->description }}</textarea>
                            </div>
                            

                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Of Products</label>
                                <input type="text" name="price"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ $product->category->name }}">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tag Of Products</label>
                                <input type="text" name="price"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ $product->category->name }}">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mt-4 mb-4">
                                @if ($product->image)
                                    <img width="50px" class="" src="{{ asset("storage/$product->image") }}"alt="">
                                @endif
                                <label for="exampleInputEmail1">Image</label>
                                <br>
                                <input type="file" name="image">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                    value="active" @checked($product->status)>
                                <label class="form-check-label" for="exampleRadios1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                    value="archived" @checked($product->status)>
                                <label class="form-check-label" for="exampleRadios2">
                                    Archevied
                                </label>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
