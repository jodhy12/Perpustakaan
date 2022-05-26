@extends('layouts.admin')
@section('header', 'Publisher')

@section('css')

@endsection

@section('content')
    <div id="controller">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary" @click="addData">
                            Create new Publisher
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($publishers as $index => $publisher)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $publisher->name }}</td>
                                        <td>{{ $publisher->email }}</td>
                                        <td>{{ $publisher->phone_number }}</td>
                                        <td>{{ $publisher->address }}</td>
                                        <td class="text-right">
                                            <a href="#" @click="editData({{ $publisher }})"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <a href="#" @click="deleteData({{ $publisher->id }})"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Publisher</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form :action="actionUrl" method="POST">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter name" required
                                    :value="publisher.name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email" required
                                    :value="publisher.email">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" class="form-control"
                                    placeholder="Enter phone number" required :value="publisher.phone_number">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter address"
                                    required :value="publisher.address">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    <!-- /.card -->
@endsection

@section('js')
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    publisher: {},
                    actionUrl: '{{ route('publishers.store') }}',
                    editStatus: false
                }
            },
            mounted() {

            },
            methods: {
                addData() {
                    this.publisher = {}
                    this.actionUrl = '{{ route('publishers.store') }}'
                    this.editStatus = false
                    $('#modal-default').modal()
                },
                editData(data) {
                    this.publisher = data
                    this.actionUrl = '{{ route('publishers.store') }}/' + this.publisher.id
                    this.editStatus = true
                    $('#modal-default').modal()
                },
                deleteData(id) {
                    this.actionUrl = '{{ route('publishers.store') }}/' + id
                    if (confirm("Are you sure ? ")) {
                        axios.post(this.actionUrl, {
                                _method: 'delete'
                            })
                            .then(response => {
                                location.reload()
                            });
                    }
                }
            }

        }).mount('#controller')
    </script>

@endsection
