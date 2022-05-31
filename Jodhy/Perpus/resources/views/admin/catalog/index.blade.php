@extends('layouts.admin')
@section('header', 'Catalog')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('catalogs.create') }}" class="btn btn-primary">Create new Catalog</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Total Books</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catalogs as $index => $catalog)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $catalog->name }}</td>
                                    @if (count($catalog->books) === 0)
                                        <td class="text-center">No Book</td>
                                    @else
                                        <td class="text-center">{{ count($catalog->books) }}</td>
                                    @endif
                                    <td class="text-center">
                                        {{ dateFormat($catalog->created_at) }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('catalogs.edit', $catalog->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="POST">
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete"
                                                onclick="return confirm('are you sure ?')">
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
@endsection

@section('js')
    <!-- CSS Scoped -->
    <style>
        .row {
            margin: 0 auto;
        }

        td a.btn {
            margin: 5px;
        }

    </style>
@endsection
