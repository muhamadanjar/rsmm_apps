@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Rencana Kerja Harian</div>
				<div class="panel-body">
                	<form action="" class="form-horizontal" role="form" method="POST">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                    	<div class="form-group">
                            <label class="control-label col-md-2"><b>Nama Pengguna</b> </label>
                            <div class="col-md-5">
                                <select name="users" class="form-control">
                                	@foreach($users as $k => $v)
                                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                                    @endforeach
                            	</select>
                            </div>
                            <div><button class="btn btn-success">Proses</button></div>
                        </div>
                    </form>
                    <table class="table table-responsive">
                    	
                   
                    @foreach($nilai as $k => $v)
                    	<tr class="bg-primary">
                        	<td>Nama : </td>
                            <td>{{ $v['name'] }} </td>
                        </tr>
                        @if(isset($v['minggu']))
                        @foreach($v['minggu'] as $k2 => $v2)
                        	@if(isset($v2['daritgl']) &&  isset($v2['sampaitgl']))
                            <tr>
                                <td>Tanggal</td>
                                <td><b>{{ \AHelper::tgl_indo($v2['daritgl']) }} - 
                                {{ \AHelper::tgl_indo($v2['sampaitgl']) }}</b></td>
                            </tr>
                            @endif
                            
                            @if(isset($v2['bobot_minggu']))
                            <tr>
                                <td>Bobot Minggu</td>
                                <td>{{ $v2['bobot_minggu'] }}</td>
                            </tr>
                            @endif
                            
                            <tr>
                                <td colspan="2">
                                <div class="piegrafik" id="pie-{{$k}}{{$k2}}"
                                    data-title="Rencana Kerja "
                                    data-berhasil="{{ $v2['bobot_minggu'] }}" 
                                    data-gagal="{{ (100 - $v2['bobot_minggu']) }}">    
                                        </div>                        
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        
                        
                        
                        
                        

                            
                        
            
                    @endforeach
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@stop