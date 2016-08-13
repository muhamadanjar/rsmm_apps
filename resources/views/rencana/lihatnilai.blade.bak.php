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
                    
                    <table class="table table-bordered">
                    @foreach($userharian as $kuh => $vuh)
                		<thead>
                        	<tr class="bg-primary">
                            	<td><i class="fa fa-user"></i> Nama</td>
                                <td colspan="8"><b><i>{{ $vuh->name }}</i></b></td>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php $jumlah_tgl = count($vuh->harian);?>
                            <?php $jumlah_tgl_nilai = $jumlah_tgl * 100;?>
                            <tr>
                            	<td>
                            		<label for="total_tgl_user">Jumlah Tanggal</label>
                                    <input type="text" value="{{ $jumlah_tgl }}" 
                                                placeholder="total tanggal user" 
                                                name="total_tgl_user" class="form-control" />    
                                </td>
                            </tr>
                            
                        	@foreach($vuh->harian as $hariantgl => $ht)
                            	<?php $total_rencanakerja_tgl = count($ht->harian); ?>
                            	<?php $total = 0;$total2 = 0;$bobot = 0;?>
                                
                            	<tr>
                                	<td colspan="5"><b>{{ \AHelper::tgl_indo($ht->tgl) }}</b></td>
                                </tr>
                                
                                @foreach($ht->harian as $krh => $vrh)
                                	<?php
                                                if ($vrh->status == 1) {
                                                    $bobot = 100/$total_rencanakerja_tgl;
                                                    $status_bg = "alert-info";
                                                }else{
                                                    $bobot = $vrh->bobot;
                                                    $status_bg = "alert-warning";
                                                }   
                                                $total2 = $total2 + $bobot; 	
                                    ?>
                                    
                                @endforeach
                                
                                	<tr>
                                    	<td colspan="5">Nilai</td>
                                        <td>
                                        	<div class="col-md-4">
                                            	<input readonly name="nilai_tgl" 
                                                	value="{{$total2}}" class="form-control"
                                                	maxlength="3" data-total-tgl="{{$total2}}" />
                                            </div>
                                        </td>                 
                                   </tr> 
                                
                            @endforeach
                        </tbody>
                    @endforeach
                    </table>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection