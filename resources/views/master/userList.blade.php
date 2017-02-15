@extends('layouts.adminlte')
@section('title','User')
@section('page-header')
	<div class="page-header">
		<div class="page-title">
			<h3>User <small>List user</small></h3>
		</div>

		<div id="reportrange" class="range">
			<div class="visible-xs header-element-toggle">
				<a class="btn btn-primary btn-icon"><i class="fa fa-mail-reply"></i></a>
			</div>
			<div class="date-range"></div>
			<span class="label label-danger">9</span>
		</div>
	</div>
@endsection

@section('breadcrumb')
<div class="breadcrumb-line">
	<ul class="breadcrumb">
		<li><a href="#">Home</a></li>
		<li><a href="#">Master</a></li>
		<li class="active">User</li>
	</ul>
	<div class="visible-xs breadcrumb-toggle">
		<a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
	</div>
</div>
@endsection
@section('content')
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-default">
				
				<div class="box-header with-border">
					<h6 class="box-title"><i class="icon-user"></i> Daftar User</h6>
					<a href="{{ url('pengaturan/user/tambah') }}" class="pull-right btn btn-sm btn-primary">
						<i class="fa fa-plus"></i> Tambah</a>
				</div>
				<div class="box-body no-padding">
		            <a class="btn btn-app">
		                <i class="fa fa-edit"></i> Edit
		            </a>
		            <a class="btn btn-app">
		                <i class="fa fa-play"></i> Play
		            </a>
		            <a class="btn btn-app">
		                <i class="fa fa-repeat"></i> Repeat
		            </a>
		            <a class="btn btn-app">
		                <i class="fa fa-pause"></i> Pause
		            </a>
		            <a class="btn btn-app">
		                <i class="fa fa-save"></i> Save
		            </a>
		            <a class="btn btn-app">
		                <span class="badge bg-yellow">3</span>
		                <i class="fa fa-bullhorn"></i> Notifications
		            </a>
		            <a class="btn btn-app">
		                <span class="badge bg-green">300</span>
		                <i class="fa fa-barcode"></i> Products
		            </a>
		            <a class="btn btn-app">
		                <span class="badge bg-purple">891</span>
		                <i class="fa fa-users"></i> Users
		            </a>
		            <a class="btn btn-app">
		                <span class="badge bg-teal">67</span>
		                <i class="fa fa-inbox"></i> Orders
		            </a>
		            <a class="btn btn-app">
		                <span class="badge bg-aqua">12</span>
		                <i class="fa fa-envelope"></i> Inbox
		            </a>
		            <a class="btn btn-app">
		                <span class="badge bg-red">531</span>
		                <i class="fa fa-heart-o"></i> Likes
		            </a>
		            
					<table class="table table-hover table-bordered">
						<tr>
							<th>Username</th>
							<th>Email</th>
							<th>Nama</th>
							<th>Role</th>
						</tr>
						
						@foreach($users as $key => $v)
                        <?php $class_active = ($v->isactive==0) ? 'btn-danger':'' ?>
                        <?php $fa_active = ($v->isactive==0) ? 'fa-circle':'fa-circle-o' ?>

						<tr>
							<td>{{ $v->username }}</td>
							<td>{{ $v->email }}</td>
							<td>{{ $v->name }}</td>
							<td>
								<div class="btn-group">
					                <button data-toggle="dropdown" class="btn {{ $class_active }} btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
									<ul class="dropdown-menu icons-right dropdown-menu-right">
										<li><a href="{{ url('pengaturan/user/ubah', ['id' => $v->id]) }}"><i class="fa fa-edit"></i> Ubah</a></li>
										<li data-form="#frmModal-{{$v->id}}" 
											data-title="Hapus {{ $v->id }}" 
											data-message="Apa anda yakin menghapus {{ $v->username }} ?">
											<a class= "frmModal" href="#"><i class="fa fa-trash"></i> Hapus</a>
										</li>
										<form action="{{ url('pengaturan/user/hapus', array($v->id) ) }}" 
											method="post" style="display:none" id="frmModal-{{$v->id}}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
										</form>
                                        <li data-form="#frmAktif-{{$v->id}}" 
											data-title="Aktif {{ $v->id }}" 
											data-message="Apa anda yakin mengaktifkan/menonaktifkan {{ $v->username }} ?">
											<a class="frmModal" href="#"><i class="fa {{$fa_active}}"></i> Aktif / Non Aktif</a>
										</li>
										<form action="{{ url('/pengaturan/user/aktif', array($v->id)) }}" method="get" style="display:none" id="frmAktif-{{$v->id}}"></form>					
									</ul>
				                </div>
							</td>
						</tr>
						@endforeach
					</table>
                    
                    
				</div>
				<div class="box-footer clearfix">
					*) Kuning = Non AKtif || Abu abu = Aktif
	              	{!! $page !!}
	            </div>
			</div>
		</div>
	</div>
@endsection