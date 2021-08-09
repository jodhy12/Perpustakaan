@extends('layouts.admin')
@section('header', 'Buku')
@push('css')  
@endpush
@section('content')
    <component id= "controller">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" v-model="search" class="form-control" autocomplete="off" placeholder="Cari Buku Berdasarkan Judul">
                    <a href="#" @click="tambahData()" class='btn btn-sm btn-primary pull-right ml-1 text-bold'>Tambah Buku</a>
                   
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12" v-for='buku in filteredList'>
                <div class="info-box" >
                    <div class="info-box-content">
                        <span class="info-box-text h3" v-on:click="ubahData(buku)">
                            @{{ buku.judul }}(@{{ buku.qty_stok }})
                        </span>
                        <span class="info-box-number" v-on:click="ubahData(buku)">Rp. @{{ formatPrice(buku.harga_pinjam) }}-<small></small></span>  
                        <button v-on:click="hapusData(buku.id)" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</button> 
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
            <h4 class="modal-title" v-if="!editStatus">Tambah Buku</h4>
            <h4 class="modal-title" v-if="editStatus">Edit Buku</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @csrf
                <input type="hidden" name="_method" value="PUT" v-if = "editStatus">
                <div class="form-group">
                 <label>ISBN</label>
                 <input type="text" class="form-control" name="isbn" :value="data.isbn" required="">
                </div>
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" :value="data.judul"  required="">
                </div>
                <div class="form-group">
                    <label>Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" :value ="data.penerbit"  required="">
                </div>
                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" class="form-control" name="id_pengarang" :value="data.id_pengarang"  required="">
                </div>
                <div class="form-group">
                    <label>Katalog</label>
                    <input type="text" class="form-control" name="id_katalog" :value="data.id_katalog"  required="">
                </div>
                <div class="form-group">
                    <label>Stok</label>
                    <input type="text" class="form-control" name="qty_stok" :value="data.qty_stok" required="">
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga_pinjam" :value="data.harga_pinjam" required="">
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
<script type="text/javascript">
    var actionUrl = '{{ url('data/buku') }}';
    var controller = new Vue({
        el : '#controller',
        data : {
            search:'',
            data_buku:[],
            editStatus : false,
            data: {},
            actionUrl: actionUrl,
        },
        mounted: function() {
            this.databuku();
        },
        methods: {
            databuku(){
                const _this = this;
                $.ajax({
                    url : actionUrl,
                    method : 'GET',
                    success : function(data) {
                        _this.data_buku = JSON.parse(data);
                    },
                    error : function(error){
                        console.log(error);
                    }
                });
            },
            formatPrice(value){
                let val = (value/1).toFixed(0).replace('.',',');
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",")
            },
            tambahData() {
                this.editStatus = false ;
                this.data = {};
                this.actionUrl="{{ url('data/buku') }}";
                $('#modal-default').modal();
            },
            ubahData(buku){
                this.editStatus = true ;
                this.data = buku;
                this.actionUrl="{{ url('data/buku') }}" + '/' + buku.id;
                $('#modal-default').modal();
            },
            hapusData(id) {
            if (confirm("Are You Sure?")) {
                // $(event.target).parents('tr').remove();
                axios.post(this.actionUrl + '/' + id, { _method: "DELETE" })
                // .then(response => {
                    // this.actionUrl="{{ url('data/buku') }}" + '/' + id;
                    //  alert('Data '+ id + ' berhasil di hapus');
                    // location.reload;
                    
                    //  });
                }
            },
        },
        computed : {
            filteredList() {
                return this.data_buku.filter(buku =>{ 
                return buku.judul.toLowerCase().includes(this.search.toLowerCase())
            })

            }

        },
    });
</script>
@endpush