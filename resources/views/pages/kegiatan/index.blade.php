@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Halaman Kegiatan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item active">Kegiatan</li>
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
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-3">
                                <h5 class="card-title">Data Kegiatan</h5>
                            </div>
                            <div class="col-9">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary btn-sm btn-add">
                                        <i class="fa fa-plus"></i> Tambah Kegiatan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table_data">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Tanggal</th>
                                                <th>Lokasi</th>
                                                <th>Pelaksana</th>
                                                <th>Nama Pimpinan</th>
                                                <th>Pendamping</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
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
@endsection

@push('after-scripts')
<script>
    $(document).ready(function(){
        var table = $('#table_data').DataTable({
            ajax : {
                url : "{{ route('kegiatan.data') }}",
                type : "POST",
                data : {
                    _token : "{{ csrf_token() }}"
                },
            },
            processing : true,
            order : [],
            columns : [
                {
                    data : 'id',
                    orderable : false,
                    searchable : false,
                    className : 'no-export',
                },
                {
                    data : 'nama_kegiatan',
                },
                {
                    data : 'tanggal_kegiatan',
                },
                {
                    data : 'lokasi_kegiatan'
                },
                {
                    data : 'pelaksana_kegiatan'
                },
                {
                    data : 'nama_pimpinan'
                },
                {
                    data : 'pendamping'
                },
                {
                    data : 'id',
                    orderable : false,
                    searchable : false,
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
                                <button class="dropdown-item btn-pdf" href="#"><i
                                        class="fa fa-file-pdf"></i> PDF</button>
                            </div>
                        </div>
                        `;
                    }
                }
            ]
        })

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        $('.btn-add').on('click', function(){
            window.location.href="{{ route('kegiatan.create') }}";
        })

        $('#table_data tbody').on('click', '.btn-edit' , function(){
            var data = table.row($(this).parents('tr')).data();
            window.location.href="{{ url('kegiatan/edit') }}/"+data.id;
        })

        $('#table_data tbody').on('click', '.btn-pdf' , function(){
            var data = table.row($(this).parents('tr')).data();
            window.open("{{ url('kegiatan/pdf') }}/"+data.id);
        })

        $('#table_data tbody').on('click', '.btn-delete', function(){
            var data = table.row($(this).parents('tr')).data();
            $.ajax({
                url : "{{ url('/kegiatan/delete') }}/"+data['id'],
                type : "POST",
                data : {
                    _token : "{{ csrf_token() }}"
                },
                beforeSend : function(){},
                complete : function(data){},
                success : function(data){
                    if(data.code == 200){
                        Swal.fire({
                            icon: 'success',
                            // title: 'Oops...',
                            text: 'Data Successfully delete!',
                            timer : 1500,
                        });
                        table.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });
                    }
                },
                error : function(ajax, opt, xhr){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            })
        })
    })
</script>
@endpush