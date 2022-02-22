@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
            <div class="col-lg">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title"></h5>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table_data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Pelaksana Kegiatan</th>
                                    <th>Detail</th>
                                    <th>Export</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
                    data : 'pelaksana_kegiatan'
                },
                {
                    data : 'id',
                    orderable : false,
                    render : function(data, type, row){
                        return '<a class="btn btn-info btn-sm" href="{{ url("kegiatan/detail") }}/'+data+'" target="_blank"> <i class="fa fa-eye"></i> Detail</a>';
                    }
                },
                {
                    data : 'id',
                    orderable : false,
                    render : function(data, type, row){
                        return '<a class="btn btn-danger btn-sm" href="{{ url("kegiatan/pdf") }}/'+data+'" target="_blank"> <i class="fa fa-file-pdf"></i> PDF</a>';
                    }
                },
            ]
        })

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });
</script>
@endpush