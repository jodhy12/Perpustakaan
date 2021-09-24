@extends('layouts.admin')
@section('header', 'Peminjaman')
@push('css') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />
@endpush
@section('content')
    <component id="controller">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" @click="tambahData()" class="btn btn-sm btn-primary pull-right">
                            Tambah Transaksi
                        </a>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="status">
                            <option value="0">Filter By Status</option>
                            <option value="1">Dipinjamkan</option>
                            <option value="2">Dikembalikan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="date" name="date" placeholder="Filter By Tanggal Pinjam">
                    </div>
                </div>         
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Nama Peminjam</th>
                            <th>Lama Pinjam (Hari)</th>
                            <th>Total Buku</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
<script type="text/javascript">
    var actionUrl= '{{ url("data/peminjaman") }}';
  var columns = [
      {data: 'tgl_pinjam', class: 'text-center', orderable: true},
      {data: 'tgl_kembali', class: 'text-center', orderable: true},
      {data: 'anggota.nama', class: 'text-center', orderable: true},
      {data: 'lama_pinjam', class: 'text-center',orderable: true},
      {data: 'lama_pinjam', class: 'text-center',orderable: true},
      {data: 'lama_pinjam', class: 'text-center', orderable: true},
      {data: 'status', class: 'text-center', orderable: true},
      {render: function(index, row, data, meta){
      return ` <a href="#" class="btn btn-sm btn-warning" onclick="controller.ubahData(event,${meta.row})">Edit</a>
      <a href="#" class="btn btn-sm btn-success" onclick="controller.ubahData(event,${meta.row})">Detail</a> 
      <a href="#" class="btn btn-sm btn-danger" onclick="controller.hapusData(event, ${data.id})">Delete</a>`;
            },orderable: false, class: 'text-center'
        },
  ];
</script>
<script src="{{ asset('js/data.js') }}"></script>
<script type="text/javascript">
$('select[name=status]').on('change', function() {
        status = $('select[name=status]').val();
        if(status == 0){
            controller.table.ajax.url(actionUrl).load();
        } else {
            controller.table.ajax.url(actionUrl+'?status='+status).load();
        }
    });

//   datepicker
$( function() {
    $( "#date" ).datepicker();
  } );
</script>
@endpush