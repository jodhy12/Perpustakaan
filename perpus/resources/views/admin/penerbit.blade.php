@extends('layouts.admin')
@section('header','Penerbit')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins\datatables-bs4\css\dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins\datatables-responsive\css\responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins\datatables-buttons\css\buttons.bootstrap4.min.css') }}">

@endpush
@section('content')
<component id="controller">
            <div class="card">
                <div class="card-header">
                    <a href="#" @click="tambahData()" class='btn btn-sm btn-primary pull-right'>Tambah Penerbit</a>
                </div>
                <div class="card-body">
                    <table id=datatable class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Penerbit</th>
                                <th>Email</th>
                                <th>Telp</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

  <!-- Modal -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
       <form :action="actionUrl" method="post" autocomplete="off" @submit="submitForm($event, data.id)">
        <div class="modal-header">
            <h4 class="modal-title" v-if="!editStatus">Tambah Penerbit</h4>
            <h4 class="modal-title" v-if="editStatus">Edit Penerbit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @csrf
            <input type="hidden" name="_method" value="PUT" v-if = "editStatus">
            <div class="form-group">
                <label>Nama Penerbit</label>
                <input type="text" class="form-control" name="nama_penerbit" :value="data.nama_penerbit" required="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" :value="data.email"  required="">
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" name="telp" :value="data.telp" required="">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat" :value="data.alamat" required="">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>

       </form>
      </div>
    </div>
  </div>
</component>
@endsection
@push('js')
<script src="{{ asset('plugins\datatables\jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins\datatables-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins\datatables-responsive\js\dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins\datatables-responsive\js\responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
  var actionUrl= '{{ url("data/penerbit") }}';
  var columns = [
      {data: 'nama_penerbit', class: 'text-center', orderable: true},
      {data: 'email', class: 'text-center', orderable: true},
      {data: 'telp', class: 'text-center', orderable: true},
      {data: 'alamat', class: 'text-center', orderable: true},
      {render: function(index, row, data, meta){
      return ` <a href="#" class="btn btn-sm btn-warning" onclick="controller.ubahData(event,${meta.row})">Edit</a><a href="#" class="btn btn-sm btn-danger" onclick="controller.hapusData(event, ${data.id})">Delete</a>`;
            },orderable: false, class: 'text-center'
        },
  ];
</script>
<script src="{{ asset('js/data.js') }}"></script>
@endpush