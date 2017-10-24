@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        {{ session()->get('message') }}
    @endif
    {{--form untuk ubah nama dan email--}}
    <form action="{{ route('edit.profil') }}">
        {{ csrf_field() }}
        <label>Nama</label>
        <input type="text" name="nama" value="{{ Auth::user()->name }}">
        <label>Email</label>
        <input type="email" name="email" value="{{ Auth::user()->email }}">
        <input type="submit" value="Simpan">
    </form>
    {{--form untuk ubah password--}}
    <form action="{{ route('edit.password') }}">
        {{ csrf_field() }}
        <label>Password lama</label>
        <input type="password" name="password_lama" minlength="6" required>
        <label>Password baru</label>
        <input type="password" name="password_baru" minlength="6" required>
        <label>Konfirmasi password baru</label>
        <input type="password" name="konfirmasi_password_baru" minlength="6" required>
        <input type="submit" value="Simpan">
    </form>
@endsection