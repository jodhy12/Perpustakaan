@extends('layouts.admin')
@section('header','Pengarang')
@push('css')
    <style type="text/css">

    </style>
@endpush
@section('content')
<component id="controller">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" @click="tambahData()" class='btn btn-sm btn-primary pull-right'>Tambah Pengarang</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 30px" class="text-center">No.</th>
                                <th class="text-center">Nama Pengarang</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Telp</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_pengarang as $num => $pengarang)
                            <tr>
                                <td>{{ $num+1 }}.</td>
                                <td>{{ $pengarang->nama_pengarang }}</td>
                                <td>{{ $pengarang->email }}</td>
                                <td>{{ $pengarang->telp }}</td>
                                <td>{{ $pengarang->alamat }}</td>
                                <td class="text-right">
                                    <a href="#" @click="ubahData({{ $pengarang }})" class="btn btn-warning btn-sm">Ubah</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                    
                                </td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>

  <!-- Modal -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
       <form action="#" method="post" autocomplete="off">
        <div class="modal-header">
            <h5 class="modal-title" v-if ="!editstatus">Tambah Pengarang</h5>
            <h5 class="modal-title" v-if ="editstatus">Edit Pengarang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @csrf
            <div class="form-group">
                <label>Nama Katalog</label>
                <input type="text" class="form-control" name="nama_pengarang" required="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" required="">
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" name="telp" required="">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Simpan</button>
          </div>

       </form>
      </div>
    </div>
  </div>
</component>
@endsection
@push('js')
<script type="text/javascript">
    var controller = new Vue({
        el : '#controller',
        data : {
            editstatus = false,
        },
        mounted: function() {

        },
        methods: {
            tambahData() {
                this.editstatus = false ;
                $('#modal-default').modal();
            },
            ubahData(pengarang){
                this.editstatus = true ;
                $('#modal-default').modal();
            }
        }
    });
</script>
@endpush