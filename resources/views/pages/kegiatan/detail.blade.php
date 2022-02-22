@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Kegiatan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
                    <li class="breadcrumb-item active">Detail</li>
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
                        <h5 class="card-title">Data Kegiatan</h5>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                        minlength="3" value="{{ $item->nama_kegiatan }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                    <input type="date" class="form-control" id="tanggal_kegiatan"
                                        name="tanggal_kegiatan" minlength="3" value="{{ $item->tanggal_kegiatan }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                                    <input type="text" class="form-control" id="lokasi_kegiatan" name="lokasi_kegiatan"
                                        minlength="3" value="{{ $item->lokasi_kegiatan }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pelaksana_kegiatan">Pelaksana Kegiatan</label>
                                    <select name="pelaksana_kegiatan" id="pelaksana_kegiatan"
                                        class="form-control select" readonly>
                                        <option value="">Pilih</option>
                                        <option value="ketua" {{ $item->pelaksana_kegiatan=='ketua'?'selected':''
                                            }}>Ketua</option>
                                        <option value="wakil ketua" {{ ($item->
                                            pelaksana_kegiatan == 'wakil ketua'?'selected':'') }}>Wakil Ketua
                                        </option>
                                        <option value="kom1" {{ $item->pelaksana_kegiatan=='kom1'?'selected':''
                                            }}>Kom1</option>
                                        <option value="kom2" {{ $item->pelaksana_kegiatan=='kom2'?'selected':''
                                            }}>Kom2</option>
                                        <option value="kom3" {{ $item->pelaksana_kegiatan=='kom3'?'selected':''
                                            }}>Kom3</option>
                                        <option value="kom4" {{ $item->pelaksana_kegiatan=='kom4'?'selected':''
                                            }}>Kom4</option>
                                        <option value="kom5" {{ $item->pelaksana_kegiatan=='kom5'?'selected':''
                                            }}>Kom5</option>
                                        <option value="banggar" {{ $item->
                                            pelaksana_kegiatan=='banggar'?'selected':''
                                            }}>Banggar</option>
                                        <option value="banmus {{ $item->pelaksana_kegiatan=='bamnus'?'selected':''
                                            }}">Banmus</option>
                                        <option value="bk" {{ $item->pelaksana_kegiatan=='bk'?'selected':''
                                            }}>BK</option>
                                        <option value="bapemperda" {{ $item->
                                            pelaksana_kegiatan=='bapemperda'?'selected':''
                                            }}>Bapemperda</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nama_pimpinan">Nama Pimpinan</label>
                                    <input type="text" class="form-control" id="nama_pimpinan" name="nama_pimpinan"
                                        minlength="3" value="{{ $item->nama_pimpinan }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pendamping">Pendamping</label>
                                    <input type="text" class="form-control" id="pendamping" name="pendamping"
                                        minlength="3" value="{{ $item->pendamping }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                                    <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control"
                                        readonly>{{ $item->deskripsi_kegiatan }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="card-title">Foto Kegiatan</div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($item->kegiatan_foto as $foto)
                            <div class="col-6">
                                <img src="{{ Storage::url($foto['foto']) }}" alt="Foto Kegiatan"
                                    style="max-height: 250px">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection