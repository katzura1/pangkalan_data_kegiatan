@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Ubah Kegiatan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
                    <li class="breadcrumb-item active">Ubah</li>
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
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                            minlength="3" value="{{ $item->nama_kegiatan }}" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                        <input type="date" class="form-control" id="tanggal_kegiatan"
                                            name="tanggal_kegiatan" minlength="3" value="{{ $item->tanggal_kegiatan }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="lokasi_kegiatan">Lokasi Kegiatan</label>
                                        <input type="text" class="form-control" id="lokasi_kegiatan"
                                            name="lokasi_kegiatan" minlength="3" value="{{ $item->lokasi_kegiatan }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="pelaksana_kegiatan">Pelaksana Kegiatan</label>
                                        <select name="pelaksana_kegiatan" id="pelaksana_kegiatan"
                                            class="form-control select" required>
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
                                            minlength="3" value="{{ $item->nama_pimpinan }}" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="pendamping">Pendamping</label>
                                        <input type="text" class="form-control" id="pendamping" name="pendamping"
                                            minlength="3" value="{{ $item->pendamping }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                                        <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control"
                                            required>{{ $item->deskripsi_kegiatan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="card-title">Tambah Foto Kegiatan</div>
                        </div>
                        <div class="card-body">
                            <table class="table" id="tb_foto">
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <button type="button" class="btn btn-primary" id="btn_tambah_foto">Tambah
                                                Foto</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </form>
                    <div class="card-header">
                        <div class="card-title">Foto Kegiatan</div>

                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped" id="tb_foto_kegiatan">
                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $i = 0}} --}}
                                @forelse ($item->kegiatan_foto as $item)
                                {{-- {{ $i = $i+1 }} --}}
                                <tr>
                                    {{-- <td>{{ $i }}</td> --}}
                                    <td><a href="{{ Storage::url($item->foto) }}" target="_blank">{{ $item->foto
                                            }}</a>
                                    </td>
                                    <td>
                                        <form
                                            action="{{ route('kegiatan.foto.delete',['id'=>$item->id,'idp'=>$item->kegiatan_id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">Foto Tidak Ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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

@push('after-scripts')
<script>
    $(document).ready(function(){
        $('#form_kegiatan').submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url : "{{ route('kegiatan.save') }}",
                type : "POST",
                data : formData,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                type: 'POST',
                beforeSend : function(){
                    $('button[type=submit]').prop('disabled',true);
                },
                complete : function(){
                    $('button[type=submit]').removeAttr('disabled');
                },
                success : function(result){
                    if(result.code == 200){
                        swal.fire({
                            title : 'Berhasil',
                            text : 'Data berhasil disimpan',
                            icon : 'success',
                            showConfirmButton : false,
                            timer : 1500
                        });
                        setTimeout(function(){
                            window.location.href = "{{ route('kegiatan.index') }}";
                        }, 1500);
                    }else{
                        swal.fire({
                            title : 'Gagal',
                            text : result.message??'Data gagal disimpan',
                            icon : 'error',
                            showConfirmButton : false,
                            timer : 1500
                        });
                    }
                },
                error : function(xhr, ajax, opt){
                    Swal.fire({
                        title : 'Gagal',
                        text : 'Data gagal disimpan',
                        icon : 'error',
                        showConfirmButton : false,
                        timer : 1500
                    });
                }
            })
        })

        function row(){
            var tr = `
            <tr>
                <td>
                    <div class="form-group">
                        <input type="file" class="form-control" name="kegiatan[]" id="kegiatan[]"
                            placeholder="Kegiatan 1" accept="image/*">
                    </div>
                </td>
            </tr>
            `;
            return tr;
        }

        $('#btn_tambah_foto').on('click', function(){
            var len1 = $('#tb_foto_kegiatan tbody tr').length;
            var len2 = $('#tb_foto tbody tr').length;
            if(len1+len2 == 10){
                swal.fire({
                    title : 'Gagal',
                    text : 'Maksimal 10 foto',
                    icon : 'error',
                    showConfirmButton : false,
                    timer : 1500
                });
            }else{
                $('#tb_foto tbody').append(row());
            }
        })
    })
</script>
@endpush