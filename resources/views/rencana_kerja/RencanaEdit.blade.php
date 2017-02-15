@extends('layouts.adminlte')

@section('content')


<form role="form" method="POST" enctype="multipart/form-data" action="{{ url('rencana/kerja',array($rencana->id)) }}">
<input name="_method" type="hidden" value="PUT">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h6 class="box-title"><i class="fa fa-user"></i> Tambah Rencana Kerja</h6>
					<a href="{{ url('rencana/kerja') }}" class="pull-right btn btn-sm btn-primary">
						<i class="fa fa-mail-reply"></i> Kembali</a>
				
				</div>
				<div class="box-body">
					
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<div class="form-group">
							<label>Kode Rencana</label>
							<input type="text" class="form-control" id="kode_rencana" name="kode_rencana" value="{{ $rencana->kode_rencana }}">
							<div class="col-md-6">
								
							</div>
						</div>

						<div class="form-group">
							<label>Kode Grup Rencana</label>
							
							<select class="form-control" name="kode_grup_rencana" id="kode_grup_rencana">
								@foreach (range('A','Z') as $char)
									<option>{{ $char }}</option>
								@endforeach
							</select>
							<div class="col-md-6">
								
							</div>
						</div>

						<div class="form-group">
							<label>Rencana Kerja</label>
							<input type="text" class="form-control" name="rencana_kerja" value="{{ $rencana->rencana_kerja }}">
							<div class="col-md-6">
								
							</div>
						</div>

						<div class="form-group">
							<label>Dari Tanggal</label>
							<input  class="form-control" name="dari_tgl" id="dari_tgl" type="text" value="{{ $rencana->dari_tgl }}">
							<div class="col-md-6">

							</div>
						</div>

						<div class="form-group">
							<label >Sampai Tanggal</label>
							<input type="text" class="form-control" name="sampai_tgl" id="sampai_tgl" value="{{ $rencana->sampai_tgl }}">
							<div class="col-md-6">
								
							</div>
						</div>

						<div class="form-group">
							<label >Keterangan</label>
							<input type="text" class="form-control" name="keterangan" value="{{ $rencana->keterangan }}">
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