@extends('layout.dashboard')


@section('title')
    products
@endsection


@section('content')
    <div class=" mb-3">
        {{-- <a href="{{ route('dashboard.products.create') }}" class="btn btn-outline-primary">Create</a>
        <a href="{{ route('dashboard.products.trash') }}" class="btn btn-outline-danger">Trash</a> --}}
    </div>
    {{-- {{ $products }} --}}

    <x-alert />


    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <input type="text" name="name" class="form-control mx-2" placeholder="Enter product Name"
            value="{{ request('name') }}" />
        <select name="status">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button type="submit" class="btn btn-dark mx-2">Filter</button>
    </form>


    <table class="table m-auto">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Product</th>
                <th>Category</th>
                <th>Store</th>
                <th>Price</th>
                <th>Created At</th>
                <th>Status</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @if (empty($products))
                <td colspan="7" class="text-center">
                    No products Found
                </td>
            @else
                @foreach ($products as $product)
                    <tr>
                        <td><img width="50px" class="" src="{{ asset("storage/$product->image") }}"alt=""></td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->store->name }}</td>
                        <td>{{ $product->price.'$'}}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a href="{{ route('dashboard.products.edit', [$product->id]) }}" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.products.destroy', [$product->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}
@endsection
