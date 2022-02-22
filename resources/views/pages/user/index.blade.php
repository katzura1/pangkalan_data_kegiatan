@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Halaman User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4">
                                <h5 class="card-title">Kelola Data User</h5>
                            </div>
                            <div class="col-lg-8">
                                <div class="pull-right">
                                    <button class="btn btn-sm btn-primary btn-add">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <table class="table table-striped table-sm" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="modal_user" aria-hidden="true">
    <form id="form_user" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username" class="form-control-label">Username</label>
                        <input type="hidden" name="id">
                        <input type="text" name="username" id="username" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-control-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="level" class="form-control-label">Level</label>
                        <select name="level" id="level" class="form-control form-control-sm select" required>
                            <option value="">Select</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Password</label>
                        <input type="text" name="password" id="password" class="form-control form-control-sm" required>
                        <span class="help-text">Biarkan kosong jiak tidak ingin mengubah password</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('after-scripts')
<script>
    $(document).ready(function(){
        var table = $('#table_data').DataTable({
            ajax : {
                url : "{{ route('user.data') }}",
                type : "POST",
                data : function(d){
                    d._token = "{{ csrf_token() }}";
                },
            },
            processing : true,
            order : [],
            columns : [
                {
                    data : 'id',
                    orderable : false,
                    className : 'no-export',
                },
                {
                    data : 'username'
                },
                {
                    data : 'name'
                },
                {
                    data : 'level'
                },
                {
                    data : 'id',
                    orderable : false,
                    className : 'no-export',
                    render : function(data, type, row){
                        return `
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary btn-flat">Action</button>
                            <button type="button"
                                class="btn btn-sm btn-primary btn-flat dropdown-toggle dropdown-icon"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <button class="dropdown-item btn-edit" href="#"><i
                                        class="fa fa-edit"></i> Edit</button>
                                <button class="dropdown-item btn-delete" href="#"><i
                                        class="fa fa-trash"></i> Delete</button>
                            </div>
                        </div>
                        `;
                    }
                }
            ]
        });

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        $('.btn-add').click(function(){
            $('#modal_user .modal-title').html('Add User');
            $('#modal_user input[name=id]').val('');
            $('#modal_user input[name=username]').val('');
            $('#modal_user input[name=name]').val('');
            $('#modal_user select[name=level]').val('').change();
            $('#modal_user input[name=password]').val('');
            $('#modal_user input[name=password]').prop('required', true);
            $('.help-text').hide();
            $('#modal_user').modal('show');
        })

        $('#form_user').submit(function(e){
            e.preventDefault();
            if(confirm('Are you sure want to submit?')){
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url : "{{ route('user.save') }}",
                    type : "POST",
                    data : formData,
                    contentType : false,
                    processData : false,
                    beforeSend : function(){
                        $('#modal_user button[type=submit]').prop('disabled', true);
                    },
                    complete : function(result){
                        $('#modal_user button[type=submit]').removeAttr('disabled');
                    },
                    success : function(data){
                        if(data['code'] == 200){
                            $('#modal_user').modal('hide');
                            table.ajax.reload();
                        }else{
                            Swal.fire({
                                title : 'Error',
                                text : data['message']??"Data not saved",
                                icon : 'error'
                            })
                        }
                    },
                    error : function(xhr, status, error){
                        Swal.fire({
                            title : 'Error',
                            text : xhr.responseText??"Data not saved",
                            icon : 'error'
                        })
                    }
                })
            }
        })

        $('#table_data tbody').on('click','.btn-edit', function(){
            var row = table.row($(this).parents('tr')).data();
            $('#modal_user .modal-title').html('Edit User');
            $('#modal_user input[name=id]').val(row.id);
            $('#modal_user input[name=username]').val(row.username);
            $('#modal_user input[name=name]').val(row.name);
            $('#modal_user select[name=level]').val(row.level).change();
            $('#modal_user input[name=password]').prop('required', false);
            $('help-text').show();
            $('#modal_user').modal('show');
        })

        $('#table_data tbody').on('click', '.btn-delete', function(){
            var row = table.row($(this).parents('tr')).data();
            if(confirm('Are you sure want to delete this data?')){
                $.ajax({
                    url : "{{ route('user.delete') }}",
                    type : "POST",
                    data : {
                        _token : "{{ csrf_token() }}",
                        id : row.id
                    },
                    beforeSend : function(){
                        $('.btn-delete').prop('disabled', true);
                    },
                    complete : function(result){
                        $('.btn-delete').removeAttr('disabled');
                    },
                    success : function(data){
                        if(data['code'] == 200){
                            table.ajax.reload();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data['message']??'Data not deleted',
                            })
                        }
                    },
                    error : function(xhr, status, error){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: xhr+' : '+error,
                        })
                    }
                })
            }
        })
    })
</script>
@endpush