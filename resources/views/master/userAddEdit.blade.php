@extends('layouts.adminlte')


@section('content')
<form role="form" method="POST" enctype="multipart/form-data" action="{{ url('/pengaturan/user/add-edit') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="fa fa-user"></i> Tambah User</h6>
					<a href="{{ url('pengaturan/user') }}" class="pull-right btn btn-sm btn-primary">
						<i class="fa fa-mail-reply"></i> Kembali</a>
				
				</div>
				<div class="box-body">
					
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="status" value="{{ $status }}">
						
						@if($status =='edit')
						<input type="hidden" name="id" value="{{ $id }}">

						@endif
						
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username">
							<div class="col-md-6">
								
							</div>
						</div>

						<div class="form-group">
							<label>Nama Lengkap</label>
							<input  class="form-control" name="name" type="text">
							<div class="col-md-6">

							</div>
						</div>

						<div class="form-group">
							<label >Email</label>
							<input type="text" class="form-control" name="email" >
							<div class="col-md-6">
								
							</div>
						</div>
						
						@if($status == 'edit')
						
						<input type="hidden" class="form-control" name="oldpassword">
							
						@endif

						<div class="form-group">
							<label >Password</label>
							<input type="password" class="form-control" name="password" >
							<div class="col-md-6">
								
							</div>
						</div>
                      
                        
						<div class="form-group">
							<label >Level</label>
							<select name="level" class="form-control">
								<option value="9">Operator</option>
							</select>
							
						</div>

						<div class="form-group">
							<label>Image</label>
							<input type="file" class="styled" name="image">
							<p class="help-block">Example block-level help text here.</p>
						</div>
						<div class="form-group">
							
							<button type="submit" class="btn btn-primary">
								Simpan
							</button>
							
						</div>

					
				</div>
			</div>
		</div>
		<div class="col-md-3">

			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="icon-user"></i> Role</h6>
				</div>
				<div class="box-body">
		            <div class="form-group">
		            	@foreach($role as $k => $v)
		                <div>
		                	<label>
			                  	<input type="radio" class="minimal" name="role" value="{{$v->name}}">
			                  	{{$v->name}}
			                </label>
		                </div>
		                
		                @endforeach
		            </div>

					
				</div>
			</div>

			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="icon-user"></i> Permission</h6>
				</div>
				<div class="box-body">
					
		            <div class="form-group">
		            @foreach($permission as $k => $v)
		            <div>
		                <label>
		                  	<input type="checkbox" class="minimal" name="permission[]" value="{{$v->name}}">
		                  	{{$v->name}}
		                </label>
		            </div>
		            @endforeach
		            </div>
		            

					
				</div>
			</div>

			

		</div>
	</div>
</form>
@endsection

