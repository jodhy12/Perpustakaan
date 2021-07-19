@extends('layouts.admin')
@section('header','Katalog')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Katalog</h3>
                </div>
                <form method="post" action="{{ url('data/katalog/'.$katalog->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Katalog</label>
                        <input type="text" class="form-control" name="nama" value="{{ $katalog->nama }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit" >Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection