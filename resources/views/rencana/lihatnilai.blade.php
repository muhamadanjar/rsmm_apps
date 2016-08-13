@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Lihat Nilai</h4></div>
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
                    @if(isset($userharian))
					
                    <table class="table table-bordered">
                    @foreach($userharian as $kuh => $vuh)
                		<?php  $total_user = 0;?>
                        <thead>
                        	<tr class="bg-primary">
                            	<td><i class="fa fa-user"></i> Nama</td>
                                <td colspan="8"><b><i>{{ $vuh['users'] }}</i></b></td>
                            </tr>
                        </thead>
                        <tbody>
                        	@if(isset($vuh['tgl_user']))
                            <?php $total_tgl = count($vuh['tgl_user']);$total_nilai_user = $total_tgl*100; ?>
                            @foreach($vuh['tgl_user'] as $k)
                                <tr>
                                    <td>{{ \AHelper::tgl_indo($k['tgl']) }}</td>
                                    <td>{{ $k['nilai'] }}</td>                 
                                </tr>
                                <?php  $total_user += $k['nilai'];?> 
                                
                            @endforeach
                            @endif
                            @if(isset($vuh['tgl_user']))
                            <tr>
                                <td>Total</td>
                                <td>{{ $total_user }}</td>
                                
                            </tr>
                            <tr>
                            	<td>Belum Selesai</td>
                            	<td>{{ ($total_nilai_user - $total_user) }}</td>
                            </tr>
                            	
                            <tr>
                                <td colspan="3">
                                	<div class="piegrafik" id="pie-{{$kuh}}"
 										id="pie-{{$kuh}}"
                                    	data-berhasil="{{ $total_user }}" 
                                    	data-gagal="{{ ($total_nilai_user - $total_user) }}">
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    @endforeach
                    </table>
                    
                    
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection