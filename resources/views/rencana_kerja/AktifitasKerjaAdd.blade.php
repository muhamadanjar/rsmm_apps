@extends('layouts.adminlte')

@section('content')


<form role="form" method="POST" enctype="multipart/form-data" action="{{ url('rencana/aktifitas') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="fa fa-user"></i> Tambah Aktifitas Kerja</h6>
					<a href="{{ url('rencana/aktifitas') }}" class="pull-right btn btn-sm btn-primary">
						<i class="fa fa-mail-reply"></i> Kembali</a>
				
				</div>
				<div class="box-body">
					
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group">
							<label>Rencana Kerja</label>
							<input type="text" class="form-control" name="aktifitas_kerja">
							<div class="col-md-6">
								
							</div>
						</div>


						<div class="form-group">
							<label >Keterangan</label>
							<input type="text" class="form-control" name="keterangan" >
							<div class="col-md-6">
								
							</div>
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
		            	
		            </div>

					
				</div>
			</div>

			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="icon-user"></i> Permission</h6>
				</div>
				<div class="box-body">
					
		            <div class="form-group">
		            
		            </div>
		            

					
				</div>
			</div>

			

		</div>
	</div>
</form>

@endsection