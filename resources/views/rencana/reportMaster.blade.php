@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Report Master</h4></div>
				<div class="panel-body">
					
                    	<div class="row">
                    		<div class="col-md-4">
                    			<table class="table table-bordered">
		                    		<tr>
		                    			<th>Laporan Per Minggu</th>
		                    		</tr>
		                    		<tr>
		                    			<td>
			                    			<a class="btn" href="{{ url('custom/reportnilai') }}">
					                        	<img class="img-responsive" width="35" src="{{ asset('images/icons/xls.png') }}"/>
					                        </a>
				                        </td>
		                    		</tr>
		                    	</table>
                    		</div>
                    		<div class="col-md-4">
	                    		<form  class="form-horizontal" name="rekapHarian" 
	                    		role="form" method="POST" 
	                    		action="{{ url('/laporan/rekapharian') }}">
	                    			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                    			<table class="table table-bordered">
			                    		<tr>
			                    			<th>Laporan Rencana Per Harian</th>
			                    		</tr>
			                    		<tr>
			                    			<td>
			                    				<div class="form-group">
						                            <label class="control-label col-md-3"><b>Nama Pengguna</b> </label>
						                            <div class="col-md-6">
						                                <select name="users" class="form-control">
						                                	@foreach($users as $k => $v)
						                                    <option value="{{ $v->id }}">{{ $v->name }}</option>
						                                    @endforeach
						                            	</select>
						                            </div>
						                            <div><button class="btn btn-success">Proses</button></div>
						                        </div>
						                        <div class="col-md-6">
						                        	<div class="form-group">
						                            	<label><strong>Dari Tanggal</strong></label>
						                            	<input type="text" placeholder="Dari Tanggal" name="daritgl" value="{{ old('daritgl') }}" class="form-control dateField">
						                            </div>   
						                        </div>
						                        <div class="col-md-6">
					                              	<div class="form-group">
					                                	<label><strong>Sampai Tanggal</strong></label>
					                                	<input type="text" placeholder="Sampai" name="sampaitgl" value="{{ old('sampaitgl') }}" class="form-control dateField">
					                            	</div>
					                           	</div>
				                        	</td>
			                    		</tr>
			                    	</table>
			                    </form>		
                    		</div>
                    		<div class="col-md-4">
                    			<table class="table table-bordered">
		                    		<tr>
		                    			<th></th>
		                    		</tr>
		                    		<tr>
		                    			<td>
		                    				
			                        	</td>
		                    		</tr>
		                    	</table>
                    		</div>
                    	</div>

                    	@if(isset($rekap))
                    	<div class="row">
                    		
                    		<table class="table table-responsive table-bordered">
                    			

                    			@foreach($rekap as $k => $v)
                    			<tr>
                    				<tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>{{ $v->name }}</th>
                                    </tr>
                    			</tr>
	                    			@if(isset($v->harian))
	                    			@foreach($v->harian as $k2 => $v2)
	                    		<tr>
	                    			<tr>
	                                	<td>{{ \AHelper::tgl_indo($v2['tgl']) }}</td>
	                                </tr>
	                    		</tr>
	                    		<tr>
                    				<tr>
                                        <th>#</th>
                                        <th>Rencana Kerja Harian</th>
                                        <th>Aktifitas</th>
                                        <th>Dari Jam</th>
                                        <th>Sampai Jam</th>
                                        
                                    </tr>
                    			</tr>
                    					@if(isset($v2['hariantgl']))
	                    				@foreach($v2['hariantgl'] as $k3 => $v3)
	                    		<tr>
                                	<td>#</td>
                                	<td>{{$v3->rencanaharian}}</td>
                                	<td>{!! $v3->aktifitas!!}</td>
                                	<td>{{$v3->darijam}}</td>
                                	<td>{{$v3->sampaijam}}</td>
                                	
                                </tr>	
	                    				@endforeach
	                    				@endif
	                    			@endforeach
	                    			@endif
                    			@endforeach
                    		</table>
                    	</div>
                    	@endif
                    	
                        
                    


				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@stop