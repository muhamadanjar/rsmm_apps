@extends('layouts.adminlte')
@section('content')

	<div class="row">
		<div class="col-xs-12">
          	<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Data Role</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	            	<table id="kuesioner_tiga" class="display" cellspacing="0" width="100%">
					    <thead>
					        <tr>
					            <th>Role</th>
					        </tr>
					    </thead>
					    <tfoot>
					        <tr>
					            <th>Role</th>
					        </tr>
					    </tfoot>
					    <tbody>
					    	@foreach ($role as $key => $v)
					    	<tr>
					            <td>{{ $v->name }}</td>					            
					        </tr>	
					    	@endforeach
					        
					       
					    </tbody>
					</table>

	            </div>
           	</div>
        </div>
	</div>
	
	
@stop