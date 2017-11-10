@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        {{ session()->get('message') }}
    @endif
    <div class="container-fluid">
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Baru</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tambah.barang') }}" enctype="multipart/form-data" method="post">
                            {{ csrf_field() }}
                            <label>Foto (kosongi jika tidak ada)</label>
                            <br>
                            <input type="file" accept="image/jpeg" name="dir">
                            <hr>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 control-label">Nama</label>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" name="nama" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 control-label">Kategori</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="kategori_id">
                                            @foreach(\App\Kategori::all() as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 control-label">Harga</label>
                                    <div class="col-md-3">
                                        <input class="form-control" type="number" name="harga" min="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 control-label">Stok</label>
                                    <div class="col-md-3">
                                        <input class="form-control" name="stok" type="number" min="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-md-2 control-label">Keterangan</label>
                                    <div class="col-md-5">
                                        <textarea name="keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer form-group">
                                <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel
                                </button>
                                <button type="submit" class="btn btn-info btn-simple">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-2">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ str_replace('_', ' ', $kategori) }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('barang', ['kategori' => 'Semua_kategori']) }}">Semua kategori</a>
                        </li>
                        @foreach(\App\Kategori::all() as $item)
                            <li>
                                <a href="{{ route('barang', ['kategori' => str_replace(' ', '_', $item->nama)]) }}">{{ $item->nama }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambah">Tambah
                    barang
                </button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tabel Barang</h4>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($barang as $item)
                                <tr>
                                    <td>{{ ($barang->currentpage() * $barang->perpage()) + (++$no) - $barang->perpage() }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kategori()->nama }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" data-toggle="modal"
                                                    data-target="#edit-{{ $item->id }}">Edit/Lihat
                                            </button>
                                            <button onclick="if (confirm('Apakah anda yakin ingin menghapus {{ $item->nama }}?')){ event.preventDefault();document.getElementById('hapus-{{ $item->id }}').submit();}">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <form id="hapus-{{ $item->id }}" action="{{ route('hapus.barang') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                </form>
                                <div class="modal fade" id="edit-{{ $item->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Edit
                                                    <b><i>{{ $item->nama }}</i></b></h4>
                                            </div>
                                            <div class="modal-body">
                                                <a href="{{ (is_null($item->dir)) ? asset('img/t-logo.png') : asset($item->dir) }}">
                                                    <img src="{{ (is_null($item->dir)) ? asset('img/t-logo.png') : asset($item->dir) }}"
                                                         class="img-responsive center-block">
                                                </a>
                                                <p>Terakhir diedit pada {{ $item->updated_at->diffForHumans() }}</p>
                                                <form action="{{ route('edit.barang') }}" enctype="multipart/form-data"
                                                      method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <label>Foto (kosongi jika tidak diganti)</label>
                                                    <input type="file" accept="image/jpeg" name="dir">
                                                    <br>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-md-2 control-label">Nama</label>
                                                            <div class="col-md-3">
                                                                <input class="form-control" type="text"
                                                                       value="{{ $item->nama }}"
                                                                       name="nama" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-md-2 control-label">Kategori</label>
                                                            <div class="col-md-3">
                                                                <select class="form-control" name="kategori_id">
                                                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori()->nama }}</option>
                                                                    @foreach(\App\Kategori::all() as $k)
                                                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-md-2 control-label">Harga</label>
                                                            <div class="col-md-3">
                                                                <input class="form-control" type="number"
                                                                       value="{{ $item->harga }}"
                                                                       name="harga" min="0"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-md-2 control-label">Stok</label>
                                                            <div class="col-md-3">
                                                                <input class="form-control" name="stok" type="number"
                                                                       value="{{ $item->stok }}" min="0"
                                                                       required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-md-2 control-label">Keterangan</label>
                                                            <div class="col-md-5">
                                                                    <textarea
                                                                            name="keterangan">{{ (is_null($item->keterangan)) ? '-' : $item->keterangan }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer form-group">
                                                        <button type="button" class="btn btn-default btn-simple"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="submit" class="btn btn-info btn-simple">Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $barang->links() }}
@endsection