@extends('layout.dashboard')

@section('title')
    Categories
@endsection


@section('content')
    <div class=" mb-3">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-outline-primary">Create</a>
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-outline-danger">Trash</a>
    </div>
    {{-- {{ $categories }} --}}

    <x-alert />


    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <input type="text" name="name" class="form-control mx-2" placeholder="Enter Category Name"
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
                <th>Category</th>
                <th>Number Of Products</th>
                <th>parent</th>
                <th>Created At</th>
                <th>Status</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @if (empty($categories))
                <td colspan="7" class="text-center">
                    No Categories Found
                </td>
            @else
                @foreach ($categories as $category)
                    <tr>
                        <td><img width="50px" class="" src="{{ asset("storage/$category->image") }}"alt=""></td>
                        <td>{{ $category->id }}</td>
                        <td><a href="{{ route('dashboard.categories.show',[$category->id]) }}">{{ $category->name }}</a></td>
                        <td>{{$category->products_count }}</td>
                        <td>{{ $category->parent ? $category->parent->name : 'Main Category'}}</td>
                        <td>{{ $category->status }}</td>
                        <td>
                            <a href="{{ route('dashboard.categories.edit', [$category->id]) }}" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('dashboard.categories.destroy', [$category->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}
@endsection
