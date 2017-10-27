@extends('layouts.admin')

@section('konten')
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
            {{ str_replace('_', ' ', $kategori) }}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ route('barang', ['kategori' => 'Semua_kategori']) }}">Semua kategori</a></li>
            @foreach(\App\Kategori::all() as $item)
                <li><a href="{{ route('barang', ['kategori' => str_replace(' ', '_', $item->nama)]) }}">{{ $item->nama }}</a></li>
            @endforeach
        </ul>
    </div>
    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambah">Tambah barang</button>
    @if(session()->has('message'))
        {{ session()->get('message') }}
    @endif
    <div id="tambah" class="modal fade" role="dialog" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah barang</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambah.barang') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <label>Foto (kosongi jika tidak ada)</label>
                        <input type="file" accept="image/jpeg" name="dir">
                        <label>Nama</label>
                        <input type="text" name="nama" required>
                        <label>Kategori</label>
                        <select name="kategori_id">
                            @foreach(\App\Kategori::all() as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        <label>Harga</label>
                        <input type="number" name="harga" min="0" required>
                        <label>Stok</label>
                        <input name="stok" type="number" min="0" required>
                        <label>Keterangan</label>
                        <textarea name="keterangan"></textarea>
                        <input type="submit" value="Simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
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
                        <button type="button" data-toggle="modal" data-target="#edit-{{ $item->id }}">Edit/Lihat</button>
                        <button onclick="if (confirm('Apakah anda yakin ingin menghapus {{ $item->nama }}?')){ event.preventDefault();document.getElementById('hapus-{{ $item->id }}').submit();}">Hapus</button>
                    </div>
                </td>
            </tr>
            <form id="hapus-{{ $item->id }}" action="{{ route('hapus.barang') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $item->id }}">
            </form>
            <div id="edit-{{ $item->id }}" class="modal fade" role="dialog" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit <b><i>{{ $item->nama }}</i></b></h4>
                        </div>
                        <div class="modal-body">
                            <a href="{{ (is_null($item->dir)) ? asset('img/noimage.jpg') : asset($item->dir) }}">
                                <img src="{{ (is_null($item->dir)) ? asset('img/noimage.jpg') : asset($item->dir) }}" class="img-responsive center-block">
                            </a>
                            <p>Terakhir diedit pada {{ $item->updated_at->diffForHumans() }}</p>
                            <form action="{{ route('edit.barang') }}" enctype="multipart/form-data" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <label>Foto (kosongi jika tidak diganti)</label>
                                <input type="file" accept="image/jpeg" name="dir">
                                <label>Nama</label>
                                <input type="text" value="{{ $item->nama }}" name="nama" required>
                                <label>Kategori</label>
                                <select name="kategori_id">
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori()->nama }}</option>
                                    @foreach(\App\Kategori::all() as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                                <label>Harga</label>
                                <input type="number" value="{{ $item->harga }}" name="harga" min="0" required>
                                <label>Stok</label>
                                <input name="stok" type="number" value="{{ $item->stok }}" min="0" required>
                                <label>Keterangan</label>
                                <textarea name="keterangan">{{ (is_null($item->keterangan)) ? '-' : $item->keterangan }}</textarea>
                                <input type="submit" value="Simpan">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    {{ $barang->links() }}
@endsection