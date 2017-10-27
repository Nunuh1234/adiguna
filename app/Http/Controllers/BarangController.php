<?php

namespace App\Http\Controllers;

use App\Kategori;
use foo\bar;
use Illuminate\Http\Request;
use App\Barang;
use Illuminate\Support\Facades\Input;

class BarangController extends Controller
{
    public function tampilDaftarBarang(Request $request)
    {
        $jumlah = 6;
        if ($request->kategori == 'Semua_kategori'){
            return view('barang', [
                'barang' => Barang::orderBy('nama')->orderBy('updated_at', 'desc')->paginate($jumlah),
                'kategori' => $request->kategori,
                'no' => 0
            ]);
        }
        else{
            $kategori = str_replace('_', ' ', $request->kategori);
            if (Kategori::isAvailable($kategori)){
                return view('barang', [
                    'barang' => Barang::where('kategori_id', '=', Kategori::getIdByName($kategori))->orderBy('nama')->orderBy('updated_at', 'desc')->paginate($jumlah),
                    'kategori' => $request->kategori,
                    'no' => 0
                ]);
            }
            return back()->with('message', 'Maaf, kategori "'.$kategori.'" tidak tersedia!');
        }
    }

    public function hapus(Request $request)
    {
        Barang::find($request->id)->delete();
        return back()->with('message', 'Berhasil dihapus!');
    }

    public function ubahBarang(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'kategori_id' => 'required'
        ]);

        Barang::find($request->id)->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok,
        ]);

        if (Input::has('dir')){
            $this->validate($request, [
                'dir' => 'image|mimes:jpeg,jpg,png,tif'
            ]);
            Input::file('dir')->move('img', 'barang-'.$request->id.'.'.Input::file('dir')->getClientOriginalExtension());
            Barang::find($request->id)->update([
                'dir' => 'img/barang-'.$request->id.'.'.Input::file('dir')->getClientOriginalExtension()
            ]);

            return back()->with('message', 'Berhasil memperbarui data beserta gambar barang!');
        }

        return back()->with('message', 'Berhasil memperbarui data!');
    }

    public function tambah(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'kategori_id' => 'required'
        ]);

        $barang = Barang::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok,
        ]);

        if (Input::has('dir')){
            $this->validate($request, [
                'dir' => 'image|mimes:jpeg,jpg,png,tif'
            ]);
            Input::file('dir')->move('img', 'barang-'.$barang->id.'.'.Input::file('dir')->getClientOriginalExtension());
            $barang->update([
                'dir' => 'img/barang-'.$barang->id.'.'.Input::file('dir')->getClientOriginalExtension()
            ]);
        }

        return back()->with('message', 'Berhasil menambahkan '.$barang->nama.'!');
    }
}
