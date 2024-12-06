@extends('layout.dashboard')

@section('title',$category->name)


    @section('breadcrumb')
    @parent
        <li class="breadcrumb-item active">Categories</li>
        <li class="breadcrumb-item active">{{ $category->name }}</li>
    @endsection


@section('content')
    <table class="table m-auto">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>store</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
                @foreach ($category->products as $product)
                    <tr>
                        <td><img width="50px" class="" src="{{ asset("storage/$product->image") }}"alt=""></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->created_at }}</td>
                    </tr>
                @endforeach


        </tbody>
    </table>
@endsection
