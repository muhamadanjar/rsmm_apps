@extends('layouts.adminlte')
@section('content')
	
		<div class="panel panel-default">
			<div class="panel-heading">
			 	<h6 class="panel-title"><i class="icon-file"></i> Statistik Web</h6>
			</div>	
			<div class="form-actions text-left">
		    	
		    </div>
			    <div class="datatable">
				    <table class="table table-striped table-bordered">
				        <thead>
				            <tr>
				                <th>IP</th>
				                <th>Browser</th>
				                <th>OS</th>
								<th>Tanggal</th>
								<th>Hits</th>
				            </tr>
				        </thead>
				        <tbody>
				        @foreach($statistik as $key => $p)
				        										
							<tr>
				                <td><span class="label label-success">{{ $p->ip }}</span></td>
				                <td>{{ $p->browser }}</td>
				                <td>{{ $p->os }}</td>
								<td>{{ $p->date_create }}</td>
								<td class="text-center"><span class="label label-info">{{ $p->hits }}</span></td>
				            </tr>
						@endforeach
				        </tbody>
				    </table>           
			    </div>
		</div>	

@stop