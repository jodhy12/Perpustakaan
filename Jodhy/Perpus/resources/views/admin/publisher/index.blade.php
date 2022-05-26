@extends('layouts.admin')
@section('header', 'Publisher')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('publishers.create') }}" class="btn btn-primary">Create new publisher</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Total Books</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publishers as $index => $publisher)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $publisher->name }}</td>
                                    <td>{{ $publisher->email }}</td>
                                    <td>{{ $publisher->phone_number }}</td>
                                    <td>{{ $publisher->address }}</td>
                                    <td class="text-center">{{ count($publisher->books) }}</td>
                                    <td>{{ $publisher->created_at }}</td>
                                    <td>
                                        <a href="{{ route('publishers.edit', $publisher->id) }}"
                                            class="btn btn-warning">Edit</a>

                                        <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST">
                                            <input type="submit" class="btn btn-danger" value="Delete"
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
                {{-- <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </div> --}}
            </div>
        </div>
    </div>
    <!-- /.card -->
@endsection
