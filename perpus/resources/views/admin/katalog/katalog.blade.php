@extends('layouts.admin')
@section('header','Katalog')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('data/katalog/create') }}" class='btn btn-sm btn-primary pull-right'>Tambah Katalog</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">No</th>
                            <th class="text-center">Nama Katalog</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_katalog as $num => $katalog)
                        <tr>
                            <td>{{ $num+1 }}.</td>
                            <td>{{ $katalog->nama }}</td>
                            <td class="text-right">
                                <a href="" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection