@extends('app')

@section('content')
<?php
	$readonly = (Auth::user()->hasRole('admin')) ?  '' : 'readonly';
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Analisis Harian</h4></div>
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
         
                    <hr>
                    
					<?php if(isset($katakunci)) $kata = $katakunci; ?>
	                <?php $jumlah_tgl_nilai =0;?>
					<div class="col-md-12">
                    	@foreach($userharian as $kuh => $vuh)
                        	<?php $total_user = 0;?>
                            
                            <div class="row table">
                                <div class="alert alert-info">
                                    <div class="col-md-2"><i class="fa fa-user"></i> Nama User :</div> 
                                    <b><i>{{ $vuh->name }}</i></b>
                                </div>
                            </div>
                            <div class="row table">
								<?php $jumlah_tgl = count($vuh->harian);?>
                                <?php $jumlah_tgl_nilai = $jumlah_tgl * 100;?>
                                
                                <div class="alert alert-success">
                                	<div class="col-md-2">Jumlah Tanggal</div>

                                        <input type="text" value="{{ $jumlah_tgl }}" 
                                           placeholder="total tanggal user" 
                                           name="total_tgl_user" class="form-control" />

                                </div>

                                
                            </div>
                            <div class="row"><div class="col-md-offset-2">&nbsp;</div></div>
                            @foreach($vuh->harian as $hariantgl => $ht)
                            <div class="row">
                            	<div class="col-md-12">
                                	<i class="fa fa-calendar"></i> <b>{{ \AHelper::tgl_indo($ht->tgl) }}</b>
                                    <a class="btn btn-primary" 
                                            data-toggle="collapse" href="#collapseExample-{{$kuh}}-{{$hariantgl}}" 
                                            aria-expanded="false" 
                                            aria-controls="collapseExample-{{$kuh}}"><i class="fa fa-folder"></i>
                                    Buka/Tutup</a>
                                </div>
                            </div>
                            <div class="row"><div class="col-md-offset-2">&nbsp;</div></div>
                            <div class="row">
                            	<div class="collapse" id="collapseExample-{{$kuh}}-{{$hariantgl}}">
                                	<table class="table table-bordered" >
                                    	<thead>
                                        	<tr>
                                            	<th>#</th>
                                                <th>Rencana Kerja Harian</th>
                                                <th>Aktifitas</th>
                                                <th>Dari Jam</th>
                                                <th>Sampai Jam</th>
                                                <th><i class="fa fa-tachometer"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
 
                                                <?php $total_rencanakerja_tgl = count($ht->hariantgl); 
												?>
                                                <?php $total = 0;$total2 = 0;$bobot = 0;$ttt = 0;?>
                                                @foreach($ht->hariantgl as $krh => $vrh)
                                                <?php
													$status_bg = ($vrh->status == 1) ? 'alert-info':'alert-warning';
													$btn_bobot = ($vrh->bobot > 0) ? 'btn-success':'btn-warning';
													if($vrh->status == 1){
														$status_t = 'Selesai';
													}else{
														$status_t = 'Belum Selesai';
													}    	
                                                ?>
                                                
                                                <tr class="alert {{$status_bg}}">
                                                    <th></th>
                                                    <td>{{$vrh->rencanaharian}}</td>
                                                    <td>{{$vrh->aktifitas}}</td>
                                                    <td>{{$vrh->darijam}}</td>
                                                    <td>{{$vrh->sampaijam}}</td>
                                                    <td>
                                                    	
                                                        	<span class="badge">{{ $status_t }}</span>

                                                    </td>
                                                        
                                                </tr>
                                                
                                                @endforeach
                                               
                                                <tr>
                                                    <td colspan="5">Nilai</td>
                                                    <td><b>{{$ht->nilaiharian}} %</b>
                                                       
                                                    </td>
                                                        
                                                </tr> 
                                                <?php $total_user = $total_user + $total2; ?>
                                                <?php $total_user = $total_user/$jumlah_tgl_nilai*100; ?>
                                                
                                                
                                                </tbody>
                                            </table>
                                </div>
                            </div>
                                
                                        
                                       
                            @endforeach
                        
                        @endforeach
                       	
					</div>
					

					

				</div> <!-- Panel -->
			</div>
		</div>
	</div>
</div>

@endsection