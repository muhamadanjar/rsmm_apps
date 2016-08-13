@extends('app')

@section('content')

<?php
	$id = '';
	$daritgl = '';
	$sampaitgl = '';
	$rencanamingguan = '';
	
if (isset($rkmingguan)) {
	if($rkmingguan->id){
		$id = $rkmingguan->id;
		$daritgl = $rkmingguan->daritgl;
		$sampaitgl = $rkmingguan->sampaitgl;
		$rencanamingguan = $rkmingguan->rencanamingguan;
		$user_id = $rkmingguan->user_id;

	}
}


?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Rencana Kerja Mingguan</div>
				<div class="panel-body">
					@include('errors.errors_all')
					@if($status == 'add')
					<table class="table table-bordered">
						<tr>
							<th>Rencana Mingguan</th>
							<th>Dari Tanggal</th>
							<th>Sampai Tanggal</th>
                            <th>Nama User</th>
							<th>#</th>
                            
						</tr>
						
						@foreach($mingguan as $key => $v)
						<tr>
							<td>{!! $v->rencanamingguan !!}</td>
							<td>{{ \AHelper::tgl_indo($v->daritgl) }}</td>
							<td>{{ \AHelper::tgl_indo($v->sampaitgl) }}</td>
                            <td>{{ $v->name }}</td>
							<td>
								<div class="btn-group">
					                <button data-toggle="dropdown" class="btn btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
									<ul class="dropdown-menu icons-right dropdown-menu-right">
										<li><a href="{{ route('mingguanedit', ['id' => $v->id]) }}"><i class="icon-quill2"></i> Ubah</a></li>
										<li data-form="#frm-{{$v->id}}" 
											data-title="Hapus {{ $v->id }}" 
											data-message="Apa anda yakin menghapus {{ $v->id }} ?">
											<a class= "formConfirm" href="#"><i class="fa fa-bell"></i> Hapus</a>
										</li>
										<form action="{{ route('mingguandelete', array($v->id) ) }}" method="get" style="display:none" id="frm-{{$v->id}}"></form>					
									</ul>
				                </div>
							</td>
						</tr>
						@endforeach
					</table>
					@endif
					<form class="form-horizontal" id="rencanaminggu" role="form" method="POST" action="{{ url('/rencanakerja/mingguan/post') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $id }}">
						<input type="hidden" name="status" value="{{ $status }}">

						<div class="form-group">
							<label class="col-md-2 control-label">Dari Tanggal</label>
							<div class="col-md-2">
								<input type="text" class="form-control dateField"  name="daritgl" value="{{ $daritgl }}">
							</div>
							<label class="col-md-2 control-label">Sampai Tanggal</label>
							<div class="col-md-2">
								<input type="text" class="form-control dateField"  name="sampaitgl" value="{{ $sampaitgl }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Rencana Kerja Mingguan</label>
							<div class="col-md-8">
								<!--<input type="text" class="form-control tinymce_rsmmm_" name="rencanamingguan" value="{{ $rencanamingguan }}">-->
								<textarea name="rencanamingguan" class="form-control" >{{ $rencanamingguan }}</textarea>
							</div>
	
						</div>
                        
                        <div class="form-group">
							@if(\Auth::user()->hasRole('admin'))
							<label class="col-md-2 control-label">Isi Sebagai</label>
							<div class="col-md-5">
								<select name="user_id" class="form-control" >
									@foreach($users as $k => $v)
										@if($status == 'edit')
											@if($user_id == $v->id)
											<option value="{{$v->id}}" selected="selected">{{ $v->name }}</option>
											@else
											<option value="{{$v->id}}">{{ $v->name }}</option>
											@endif
										@else		
										<option value="{{$v->id}}">{{ $v->name }}</option>
										@endif
									
									@endforeach
								</select>
							</div>
							@else
							<input name="user_id" value="{{ \Auth::user()->id }}" type="hidden" />
							@endif
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-2">
								<button type="submit" class="btn btn-primary">
									Simpan
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