@extends('layout.admin')

@section('title', 'Category')

@section('main')
    <div class="container-fluid">
        @if (session('message'))
            <div class="alert alert-primary fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('message') }}</strong>
            </div>

            <script>
                $(".alert").alert();
            </script>
        @endif
        <div class="row align-items-center">
            <div class="col-lg-6">
                <a href="{{ route('category.create') }}" class="btn btn-outline-primary rounded-0"
                    title="Add New Category"><i class="fa fa-plus"></i></a>
                <a href="{{ route('category.recycle_bin') }}" class="btn btn-outline-warning rounded-0"
                    title="RecycleBin"><i class="fa fa-trash"></i></a>
            </div>
            <div class="col-lg-6">
                <form action="" method="get">
                    <div class="form-group d-flex">
                        <input type="text" class="form-control rounded-0" name="keyword" placeholder="Search...">
                        <button type="submit" class="btn btn-success rounded-0"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Product Counts </th>
                    <th>Status</th>
                    <th>HandleAction</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $cat->id }}</td>
                        <td>
                            <a href="{{ route('category.show', $cat->id) }}">{{ $cat->name }}</a>
                        </td>
                        <td style="width: 15%;">{{ $cat->products->count() }}</td>
                        <td>{!! $cat->status == 1
                            ? "<span class='badge badge-success rounded-0'>Show</span>"
                            : "<span class='badge badge-danger rounded-0'>Hide</span>" !!}</td>
                        <td style="width: 20%;">
                            <form action="{{ route('category.destroy', $cat->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <a href="{{ route('category.edit', $cat->id) }}"
                                    class="btn btn-outline-success rounded-0"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-outline-danger rounded-0"><i
                                        class="fa fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
@endsection
