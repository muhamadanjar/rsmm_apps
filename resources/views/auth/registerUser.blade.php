@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Daftar User</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/cauth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-md-4 control-label">Username</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="username" value="{{ old('username') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nik</label>
							<div class="col-md-6">
								<input type="text" class="form-control" readonly name="nik" value="{{ $kode }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Alamat</label>
							<div class="col-md-6">
								
								<textarea class="form-control" name="alamat"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">TTL</label>
							<div class="col-md-2">
								<input type="text" class="form-control dateField" name="ttl"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Divisi</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="divisi_id"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">TTL</label>
							<div class="col-md-6">
								<input type="file" name="photo"/>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
