@extends('layouts.admin')
@section('header', 'Catalog')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Catalog</h3>
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
                                        {{ date('H:i:s - d M Y', strtotime($catalog->created_at)) }}
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
            <!-- /.card -->
        @endsection
