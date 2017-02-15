@extends('layouts.adminlte')

@section('adminlte-contentheader')
	<h1>404 Error Page</h1>
  <ol class="breadcrumb">
      <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">403 error</li>
  </ol>
@endsection

@section('content')
<div class="error-page">
    <h2 class="headline text-yellow"> 403</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p>
          Anda tidak bisa mengakses halaman ini.
          Sementara, kamu mungkin bisa <a href="{{url('home')}}">kembali ke halaman utama</a>.
        </p>

        <form class="search-form">
            <div class="input-group">
              <input type="text" name="search" class="form-control" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                </button>
              </div>
            </div>
        </form>
    </div>
</div>
@endsection