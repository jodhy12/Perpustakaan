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
                                    <a href="#" @click='hapusData({{ $pengarang->id }})' class="btn btn-danger btn-sm">Hapus</a>
                                    
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
       <form :action="actionUrl" method="post" autocomplete="off">
        <div class="modal-header">
            <h5 class="modal-title" v-if ="!editStatus">Tambah Pengarang</h5>
            <h5 class="modal-title" v-if ="editStatus">Edit Pengarang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @csrf
            <input type="hidden" name="_method" value="PUT" v-if = "editStatus">
            <div class="form-group">
                <label>Nama Pengarang</label>
                <input type="text" class="form-control" name="nama_pengarang" :value="data.nama_pengarang" required="">
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
          <div class="modal-footer">
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
<script type="text/javascript">
    var controller = new Vue({
        el : '#controller',
        data : {
            editStatus : false,
            data: {},
            actionUrl: ''
        },
        mounted: function() {

        },
        methods: {
            tambahData() {
                this.editStatus = false ;
                this.data = {};
                this.actionUrl="{{ url('data/pengarang') }}";
                $('#modal-default').modal();
            },
            ubahData(pengarang){
                this.editStatus = true ;
                this.data = pengarang;
                this.actionUrl="{{ url('data/pengarang') }}" + '/' + pengarang.id;
                $('#modal-default').modal();
            },
            hapusData(id){
                this.actionUrl="{{ url('data/pengarang') }}";
                if(confirm("Are You Sure?")){
                    axios.post(this.actionUrl+'/'+id, {_method:"DELETE"}).then(response=>{
                        location.reload;
                    });
                }
            }
        }
    });
</script>
@endpush