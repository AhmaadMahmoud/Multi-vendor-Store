@extends('layout.dashboard')

@section('title')
    Edit Categories
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
                    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data" id="quickForm">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name Of Category</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                                    value="{{ $category->name }}">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <label for="floatingTextarea2">Description</label>
                                <textarea class="form-control" name="description" placeholder="Write Description Here" id="floatingTextarea2"
                                    style="height: 100px">{{ $category->description }}</textarea>
                            </div>

                            <select name="parent_id" class="form-select mt-4" aria-label="Default select example">
                                <option value="">Primary Category</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>

                            <div class="form-group mt-4 mb-4">
                                @if ($category->image)
                                    <img width="50px" class="" src="{{ asset("storage/$category->image") }}"alt="">
                                @endif
                                <label for="exampleInputEmail1">Image</label>
                                <br>
                                <input type="file" name="image">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                    value="active" @checked($category->status)>
                                <label class="form-check-label" for="exampleRadios1">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                    value="archived" @checked($category->status)>
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
