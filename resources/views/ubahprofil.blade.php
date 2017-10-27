@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        {{ session()->get('message') }}
    @endif
    {{--form untuk ubah nama dan email--}}
    <div class="content">
        <h2>Edit Profile</h2>
        <hr>
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
                    <h6>Upload your photo here</h6>
                    <input type="file" class="form-control">
                </div>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">
                <h3>Personal info</h3>

                <form class="form-horizontal" action="{{ route('edit.profil') }}" role="form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="nama" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" action="{{ route('edit.password') }}" role="form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password Lama</label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password_lama" minlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password Baru</label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password_baru" minlength="6" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirm password</label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="konfirmasi_password_baru" minlength="6"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection