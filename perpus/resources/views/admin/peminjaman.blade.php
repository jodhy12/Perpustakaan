@extends('layouts.admin')
@section('header', 'Peminjaman')
@push('css') 
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" /> --}}
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
{{-- Radio --}}
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

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
                        <input type="text" class="form-control" id="tanggalfilter" name="date" placeholder="Filter By Tanggal Pinjam">
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
                    <h4 class="modal-title" v-if="!editStatus">Tambah Peminjaman</h4>
                    <h4 class="modal-title" v-if="editStatus">Edit Peminjaman</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="PUT" v-if = "editStatus">
                    <div class="container">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Anggota</label>
                                </div>
                                <div class="col-md-9">
                                    <select name="anggota" id="" class="form-control">
                                        <option value="">-- Anggota --</option>
                                            @foreach ($data['anggota'] as $anggota)
                                                <option :selected="datas.id_anggota == {{ $anggota['id'] }} " value = "{{ $anggota['id'] }}"> {{ $anggota['nama'] }} </option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>    
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Tanggal</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="tanggalpinjam" name="tglpinjam"  required="" placeholder="Pinjam">
                                </div>
                                <div class="col-md-1">
                                    -
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="tanggalkembali" name="tglkembali"    required="" placeholder="Kembali">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Buku</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control select2" multiple="multiple" name="buku[]">
                                        @foreach ( $databuku as $buku)
                                        <option> {{ $buku['judul'] }} </option>
                                        @endforeach
                                </select>
                                </div>    
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Status</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                          <input type="radio" name="r2" checked id="radioDanger1">
                                          <label for="radioDanger1">
                                              Masih Dipinjam
                                          </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                          <input type="radio" name="r2" checked id="radioDanger2">
                                          <label for="radioDanger2">
                                              Sudah Dikembalikan
                                          </label>
                                        </div>
                                      </div>
                                </div>
                            </div>      
                        </div>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script> --}}
{{-- Data Picker --}}
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
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
      return ` 
      <a href="#" class="btn btn-sm btn-warning" onclick="controller.ubahData(event,${meta.row})">
        Edit
      </a>
      <a href="#" class="btn btn-sm btn-success" onclick="controller.ubahData(event,${meta.row})">
        Detail
      </a> 
      <a href="#" class="btn btn-sm btn-danger" onclick="controller.hapusData(event, ${data.id})">
        Delete
      </a>`;
            },orderable: false, class: 'text-center'
        },
  ];
</script>
<script src="{{ asset('js/data.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
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
    $( "#tanggalfilter" ).datepicker({ format: 'dd/mm/yyyy' });
    $( "#tanggalpinjam" ).datepicker({ format: 'dd/mm/yyyy' });
    $( "#tanggalkembali" ).datepicker({ format: 'dd/mm/yyyy' });
  } );
  //Select 2
  $( function () {
         $(".select2").select2();
   });
</script>
@endpush