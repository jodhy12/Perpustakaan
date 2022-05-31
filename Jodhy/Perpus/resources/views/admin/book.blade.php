@extends('layouts.admin')
@section('header', 'Book')

@section('content')
    <div id="controller">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" autocomplete="off" placeholder="search from title"
                        v-model="search">
                </div>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary" @click="addData">Create New Book</button>
            </div>
        </div>

        <hr style="background-color: #eee">

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12" v-for="book in filteredList">
                <div class="info-box" @click="editData(book)" style="cursor: pointer">
                    <div class="info-box-content">
                        <span class="info-box-text h5">@{{ book.title }} (@{{ book.qty }})</span>
                        <span class="info-box-number">Rp. @{{ numberWithSpaces(book.price) }},-<small></small></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Book</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form :action="actionUrl" method="post" @submit="submitForm($event, book.id)">

                        <div class="modal-body">
                            @csrf

                            <input type="hidden" name="_method" value="put" v-if="editStatus">

                            <div class="form-group">
                                <label>ISBN</label>
                                <input type="number" name="isbn" class="form-control" required :value="book.isbn">
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required :value="book.title">
                            </div>

                            <div class="form-group">
                                <label>Year</label>
                                <input type="number" name="year" class="form-control" required :value="book.year">
                            </div>

                            <div class="form-group">
                                <label>Publisher</label>
                                <select name="publisher_id" class="form-control">
                                    @foreach ($publishers as $publisher)
                                        <option :selected="book.publisher_id === {{ $publisher->id }}"
                                            value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Author</label>
                                <select name="author_id" class="form-control">
                                    @foreach ($authors as $author)
                                        <option :selected="book.author_id === {{ $author->id }}"
                                            value="{{ $author->id }}">
                                            {{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Catalog</label>
                                <select name="catalog_id" class="form-control">
                                    @foreach ($catalogs as $catalog)
                                        <option :selected="book.catalog_id === {{ $catalog->id }}"
                                            value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Qty Stok</label>
                                <input type="number" name="qty" class="form-control" required :value="book.qty">
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" required :value="book.price">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn"
                                :class="{ 'btn-danger': editStatus, 'btn-default': editStatus != true }"
                                @click="deleteData(book.id)">
                                <span v-if="editStatus">Delete</span>
                                <span v-else>Cancel</span>
                            </button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection

@section('js')
    <script>
        const actionUrl = '{{ route('books.index') }}'
        const apiUrl = '{{ route('api.books') }}'

        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    msg: 'Hello',
                    books: [],
                    search: '',
                    book: {},
                    actionUrl,
                    editStatus: true
                }
            },

            mounted() {
                this.get_books()
            },

            methods: {
                get_books() {
                    const _this = this
                    $.ajax({
                        url: apiUrl,
                        method: 'GET',
                        success: data => {
                            _this.books = JSON.parse(data)
                        },
                        error: error => {
                            console.log(error)
                        }
                    })
                },

                numberWithSpaces(x) {
                    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                },

                addData() {
                    this.book = {}
                    this.editStatus = false
                    $('#modal-default').modal()
                },

                editData(book) {
                    this.book = book
                    this.editStatus = true
                    $('#modal-default').modal()
                },
                deleteData(id) {
                    if (!this.editStatus) {
                        $('#modal-default').modal('hide')
                    } else {
                        if (confirm('are you sure ?')) {
                            axios.post(this.actionUrl + '/' + id, {
                                    _method: 'delete'
                                })
                                .then(resp => {
                                    alert('Data has been removed')
                                    location.reload(true)
                                })
                        }
                    }
                },
                submitForm(e, id) {
                    e.preventDefault()
                    const actionUrl = !this.editStatus ? this.actionUrl : this.actionUrl + '/' + id
                    axios.post(actionUrl, new FormData($(event.target)[0]))
                        .then(resp => {
                            alert('Data has been saved')
                            location.reload(true)
                        })
                        .catch(err => console.log(err))

                }
            },

            computed: {
                filteredList() {
                    return this.books.filter(book => {
                        return book.title.toLowerCase().includes(this.search.toLowerCase())
                    })
                }
            }
        }).mount('#controller')
    </script>
@endsection
