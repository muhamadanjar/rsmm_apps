@extends('layouts.adminlte')
@section('content')

	<div class="row">
		<div class="col-xs-12">
          	<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Data Kuesioner</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	            	<table id="kuesioner_tiga" class="display" cellspacing="0" width="100%">
					    <thead>
					        <tr>
					            <th>Nomor Kuesioner</th>
					            <th>Nomor BSN</th>
					            <th>Nama Surveyor</th>
					            <th>Tanngal Survey</th>
					            <th>Propinsi</th>
					            <th>Kuesioner</th>
					        </tr>
					    </thead>
					    <tfoot>
					        <tr>
					            <th>Nomor Kuesioner</th>
					            <th>Nomor BSN</th>
					            <th>Nama Surveyor</th>
					            <th>Tanngal Survey</th>
					            <th>Propinsi</th>
					            <th>Kuesioner</th>
					        </tr>
					    </tfoot>
					    <tbody>
					    	@foreach ($kuesioner_tiga as $key => $v)
					    	<tr>
					            <td>{{ $v->nomor_kuesioner }}</td>
					            <td>{{ $v->nomor_bsn }}</td>
					            <td>{{ $v->nama_surveyor }}</td>
					            <td>{{ $v->tgl_survey }}</td>
					            <td>{{ $v->propinsi }}</td>
					            <td>
					            	
					            	<div class="btn-group">
									    <button data-toggle="dropdown" class="btn btn-icon btn-success dropdown-toggle" type="button"><i class="icon-cog4 caret"></i></button>
											<ul class="dropdown-menu icons-right dropdown-menu-right">
												<li data-form="#frmKuesioner-{{ $v->id }}" data-title="Kuesioner" 
												data-message="Kuesioner">
													<a class="frmKuesioner" href="#"><i class="icon-info"></i> Buka</a>
												</li>
												<form method="get" 
													action="#"
													style="display:none" 
													id="frmKuesioner-{{$v->id}}">
												</form>
												
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
	</div>
	
	
@stop