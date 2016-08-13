@extends('app')

@section('content')

<?php
	$id = '';
	$date_now = date('Y-m-d H:i:s');
	$rencanaharian = old('rencanaharian');
	$aktifitas = '';
	$darijam = '';
	$sampaijam = '';
	$keterangan = '';
	$tgl = date('Y-m-d');
	$aktifitas_sampaijam = '';
	$aktifitas_darijam = '';
	$form_readonly ='';
	$date_expired = '';
	$disabled_btn = '';
	
	$minggu_id = (isset($minggu->id)) ? $minggu->id : 0;
	$status = 'add';
if (isset($rkharian)) {
	if($rkharian->id){
		$id = $rkharian->id;
		$rencanaharian = $rkharian->rencanaharian;
		$aktifitas = $rkharian->aktifitas;
		$darijam = $rkharian->darijam;
		$sampaijam = $rkharian->sampaijam;
		$keterangan = $rkharian->keterangan;
		$tgl = $rkharian->tgl;
		$user_id = $rkharian->user_id;
		$status = 'edit';
		$date_expired = $rkharian->tgl;
		$date_expired = new DateTime($date_expired);
		$date_expired->setTime(17, 00);
		$date_expired_f = $date_expired->format('Y-m-d H:i:s');
		$minggu_id = $rkharian->mingguan_id;
		//$date_expired = date_create($date_expired);
		//$date_expired = date_format($date_expired,'Y-m-d H:i:s');
		//dd(($date_expired));
		
		//$date_expired = date('Y-m-d H:i:s', strtotime($date_expired_f . ' +1 day'));
		$date_expired = date('Y-m-d H:i:s', strtotime($date_expired_f));

		if ($date_expired < $date_now) {
			echo 'Udah Lewat broh';
			$form_readonly = 'readonly';
			$disabled_btn = 'disabled';
		}  
	}
}


?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Rencana Kerja Harian {{$minggu_id}}</div>
				<div class="panel-body">
					@include('errors.errors_all')
					
									
					@if($status == 'add')
                    <div class="row">
                    <div class="col-md-12">
                    <div class="datatable">
					<table id="table-datatable" class="table table-datatable table-bordered">
						<thead>
                        <tr>
							<th>Rencana Harian</th>
							<th>Tanggal</th>
							<th>Dari Jam</th>
							<th>Sampai Jam</th>
							<th>Username</th>
							<th>#</th>
						</tr>
                        </thead>
						
						
						<tbody>
                        @foreach($harian as $key => $v)
						<?php $btncek = ($v->tgl < date('Y-m-d')) ? 'btn-warning' : ''; ?>
                        <tr>
							<td>{!! $v->rencanaharian !!}</td>
							<td>{{ \AHelper::tgl_indo($v->tgl) }}</td>
							<td>{{$v->darijam }}</td>
							<td>{{$v->sampaijam }}</td>
							<td>{{$v->name }}</td>
							<td>
								<div class="btn-group">
					                <button data-toggle="dropdown" class="btn {{$btncek}} btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
									<ul class="dropdown-menu icons-right dropdown-menu-right">
										<li><a href="{{ route('harianedit', ['id' => $v->id]) }}"><i class="icon-quill2"></i> Ubah</a></li>
										<li data-form="#frm-{{$v->id}}" 
											data-title="Hapus {{ $v->id }}" 
											data-message="Apa anda yakin menghapus {{ $v->id }} ?">
											<a class= "formConfirm" href="#"><i class="fa fa-bell"></i> Hapus </a>
										</li>
										<form action="{{ route('hariandelete', array($v->id) ) }}" method="get" style="display:none" id="frm-{{$v->id}}"></form>
										
														
									</ul>
				                </div>
							</td>
						</tr>
                        @endforeach
                        </tbody>
						
					</table>
                    
                    
                    </div>
                    
                    </div>
                    </div>
					@endif
                    <hr>
                    <div class="row">
                    <div class="col-md-12">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/rencanakerja/harian/post') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $id }}">


						<div class="form-group">
							<label class="col-md-2 control-label">Rencana Kerja</label>
							<div class="col-md-6">
								<!--<input type="text" class="form-control" name="rencanaharian" value="{{ $rencanaharian }}">-->
								<textarea class="form-control" name="rencanaharian" {{ $form_readonly }}>{{ $rencanaharian }}</textarea>
							</div>
							<div class="col-md-2">
								<input class="form-control dateField" name="tgl" value="{{ $tgl }}" {{ $form_readonly }}/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Dari Jam</label>
							<div class="col-md-2">
								<input type="text" class="form-control timeField"  name="darijam" value="{{ $darijam }}" {{ $form_readonly }}>
							</div>
							<label class="col-md-2 control-label">Sampai Jam</label>
							<div class="col-md-2">
								<input type="text" class="form-control timeField"  name="sampaijam" value="{{ $sampaijam }}" {{ $form_readonly }}>
							</div>
						</div>
						<input type="hidden" class=""  name="minggu_id" value="{{ $minggu_id }}">
						<div class="form-group">
							<label class="col-md-2 control-label">Aktivitas yang dilakukan</label>
							<div class="col-md-6">
								<!--<input  class="form-control tinymce_rsmmm" name="aktifitas" type="multiple" value="{{ $aktifitas }}">-->
								<textarea class="form-control" name="aktifitas" {{ $form_readonly }}>{{ $aktifitas }}</textarea>
								
							</div>
							<label class="col-md-2 control-label">Status Pekerjaan</label>
							<div class="col-md-2">
								<select name="status" class="form-control">
									<option value="0">Belum Selesai</option>
									<option value="1">Selesai</option>
                                    <option value="2">Berlanjut</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Dari Jam</label>
							<div class="col-md-2">
								<input type="text" class="form-control timeField" {{ $form_readonly }} name="aktifitas_darijam" value="{{ $aktifitas_darijam }}">
							</div>
							<label class="col-md-2 control-label">Sampai Jam</label>
							<div class="col-md-2">
								<input type="text" class="form-control timeField" {{ $form_readonly }} name="aktifitas_sampaijam" value="{{ $aktifitas_sampaijam }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Keterangan</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="keterangan" value="{{ $keterangan}}" {{ $form_readonly }}>
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
							<label class="col-md-2 control-label">Tanggal Kadaluarsa</label>
							<i>{{ $date_expired }}</i>
							<input name="date_expired" value="{{ $date_expired }}" id="date_expired" type="hidden" />
							<input name="date_now" value="{{ $date_now }}" id="date_now" type="hidden" />
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-2">
								<button type="submit" class="btn btn-primary {{$disabled_btn}}">
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
	</div>
</div>
@endsection