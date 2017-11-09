@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        {{ session()->get('message') }}
    @endif
    {{--form untuk ubah nama dan email--}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header" data-background-color="purple">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="card-content">
                                <form class="form-horizontal" action="{{ route('edit.profil') }}" role="form"
                                      method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="nama"
                                                   value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="email" name="email"
                                                   value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">Update
                                        Profil
                                    </button>
                                    <div class="clearfix"></div>
                                </form>
                                <form class="form-horizontal" action="{{ route('edit.password') }}" role="form"
                                      method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Password Lama</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="password" name="password_baru" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Password Baru</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="password" name="password_baru" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Confirm Password</label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="password" name="password_lama"
                                                   minlength="6" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">Update
                                        Password
                                    </button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-profile">
                            <div class="card-avatar">
                                <a href="#">
                                    <img src="img/ulin.jpg" alt="Foto"/>
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="category text-gray"><i>{{ Auth::user()->hak_akses }}</i></h6>
                                <h4 class="card-title">{{ Auth::user()->name }}</h4>
                                <p class="card-content">
                                    {{ Auth::user()->email }}
                                </p>
                                <a href="#" class="btn btn-primary btn-round">Edit</a>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection