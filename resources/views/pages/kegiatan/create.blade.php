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
            <div class="col-lg-12">
                <div class="card card-danger card-outline">
                    <form id="form_kegiatan" method="POST" enctype="multipart/form-data">
                        <div class="card-header">
                            <h5 class="card-title">Form Kegiatan</h5>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama_kegiatan">Nama Kegiatan</label>
                                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                            minlength="3" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                        <input type="date" class="form-control" id="tanggal_kegiatan"
                                            name="tanggal_kegiatan" minlength="3" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                                        <input type="text" class="form-control" id="lokasi_kegiatan"
                                            name="lokasi_kegiatan" minlength="3" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="pelaksana_kegiatan">Pelaksana Kegiatan</label>
                                        <select name="pelaksana_kegiatan" id="pelaksana_kegiatan"
                                            class="form-control select" required>
                                            <option value="">Pilih</option>
                                            <option value="ketua">Ketua</option>
                                            <option value="wakil ketua">Wakil Ketua</option>
                                            <option value="kom1">Kom1</option>
                                            <option value="kom2">Kom2</option>
                                            <option value="kom3">Kom3</option>
                                            <option value="kom4">Kom4</option>
                                            <option value="kom5">Kom5</option>
                                            <option value="banggar">Banggar</option>
                                            <option value="banmus">Banmus</option>
                                            <option value="bk">BK</option>
                                            <option value="bapemperda">Bapemperda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama_pimpinan">Nama Pimpinan</label>
                                        <input type="text" class="form-control" id="nama_pimpinan" name="nama_pimpinan"
                                            minlength="3" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="pendamping">Pendamping</label>
                                        <input type="text" class="form-control" id="pendamping" name="pendamping"
                                            minlength="3" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                                        <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control"
                                            required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="card-title">Foto Kegiatan</div>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                            <div class="form-group">
                                <input type="file" name="kegiatan[]" id="kegiatan[]" placeholder="Kegiatan 1"
                                    accept="images/*" required>
                            </div>
                        </div>
                    </form>
                </div>
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
        $('#form_kegiatan').submit(function(e){
            e.preventDefault();
            var formData = new FormData(this[0]);
            $.ajax({
                url : "{{ route('kegiatan.save') }}",
                type : "POST",
                data : formData,
                processData : false,
                contentType : false,
                beforeSend : function(){
                    $('button[type=submit]').prop('disabled',true);
                },
                complete : function(){
                    $('button[type=submit]').removeAttr('disabled');
                },
                success : function(response){
                    if(response.status == 'success'){
                        swal.fire({
                            title : 'Berhasil',
                            text : 'Data berhasil disimpan',
                            type : 'success',
                            showConfirmButton : false,
                            timer : 1500
                        });
                        setTimeout(function(){
                            window.location.href = "{{ route('kegiatan.index') }}";
                        }, 1500);
                    }else{
                        swal.fire({
                            title : 'Gagal',
                            text : 'Data gagal disimpan',
                            type : 'error',
                            showConfirmButton : false,
                            timer : 1500
                        });
                    }
                }
            })
        })
    })
</script>
@endpush