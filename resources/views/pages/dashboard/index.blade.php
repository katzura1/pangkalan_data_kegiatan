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
            <div class="col-lg-6">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Selamat Datang</h5>
                    </div>
                    <div class="card-body">

                        <p class="card-text">
                            Selamat datang di aplikasi sistem informasi pengelolaan data kegiatan kegiatan
                            legistlatif.
                        </p>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Rangkuman Data</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Sudah terdapat <b>{{ $data['jumlah_kegiatan']??0 }}</b> kegiatan yang telah dibuat dan <b>{{
                                $data['jumlah_user']??0 }}</b> pengguna yang terdaftar.
                        </p>
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