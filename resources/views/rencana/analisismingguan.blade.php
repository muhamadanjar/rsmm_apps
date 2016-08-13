@extends('app')

@section('content')
<?php
	$readonly = (Auth::user()->hasRole('admin')) ?  '' : 'readonly';
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Analisis Mingguan</h4></div>
				<div class="panel-body">
                	<div class="col-md-12">

                    	@foreach($mingguan as $k => $v)
                        	<div class="row table">
                                <div class="alert alert-info">
                                    <div class="col-md-2"><i class="fa fa-user"></i><b> Nama User :</b></div> 
                                    <i>{{ $v->name }}</i>
                                </div>
                            </div>
                            @if(count($v->mingguan) > 0)
							@foreach($v->mingguan as $k2 => $v2)
                           
                            <div class="row">
                            	<div class="col-md-12">
                                	<i class="fa fa-calendar"></i> 
                                    <b>{{ \AHelper::tgl_indo($v2->daritgl) }} - 
                                    {{ \AHelper::tgl_indo($v2->sampaitgl) }}</b>
                                    <a class="btn btn-primary" 
                                            data-toggle="collapse" href="#collapseExample-{{$k}}-{{$k2}}" 
                                            aria-expanded="false" 
                                            aria-controls="collapseExample-{{$k}}"><i class="fa fa-folder"></i>
                                    Buka/Tutup</a>
                                    <a class="btn btn-primary" 
                                            data-toggle="collapse" href="#collapseColumn-{{$k}}-{{$k2}}" 
                                            aria-expanded="false" 
                                            aria-controls="collapseColumn-{{$k}}"><i class="fa fa-folder"></i>
                                    Grafik</a>
                                    Nilai Perminggu <span class="badge">{{ round($v2->nilaimingguanv2,2) }}</span>
                                	Nilai Gabungan <span class="badge">{{ round($v2->nilai_gabungan,2) }}</span> 
                                    <span class="badge">{{ $v2->nilai_status }}</span>    
                                </div>
                                
                            </div>
                            <div class="row"><div class="col-md-offset-2">&nbsp;</div></div>
                            <div class="row">
                            	<div class="collapse" id="collapseExample-{{$k}}-{{$k2}}">
                                	@if(count($v2->harian) > 0)
                                    @foreach($v2->harian as $k3 => $v3)
                                        <table class="table table-bordered">
                                        	<thead>
                                            	<tr class="bg-info">
                                                	<td colspan="6">{{ \AHelper::tgl_indo($v3['tgl']) }}</td>
                                                    <td>{{ $v3['jumlahaktifitasjam'] }} Jam</td>
                                                </tr>
                                            </thead>
                                        	<thead>
                                            	<tr>
                                                	<th>Rencana Harian</th>
                                                    
                                                    <th>Dari Jam</th>
                                                    <th>Sampai Jam</th>
                                                    <th>Aktifitas</th>
                                                    <th>Dari Jam</th>
                                                    <th>Sampai Jam</th>
                                                    <th>{{ $v3['nilaiharian'] }}</th>
                                                </tr>
                                            </thead>
                                        <?php $total = 0;$total2 = 0;$bobot = 0;?>
                                        @if(count($v3['hariantgl']) > 0)
                                        <?php $total_rencanakerja_tgl = count($v3['hariantgl']);  ?>
                                        @foreach($v3['hariantgl'] as $k4 =>$v4)
                                        	<?php
												$status_bg = ($v4->status == 1) ? 'alert-success':'alert-warning';
												$btn_bobot = ($v4->bobot > 0) ? 'btn-success':'btn-warning';
												if($v4->status == 1){
													if($v4->bobot > 0){
														$bobot = $v4->bobot;	
													}else{
														$bobot = 100/$total_rencanakerja_tgl;
													}
												}else{
													if($v4->bobot > 0){
														$bobot = $v4->bobot;	
													}else{
														$bobot = 50/$total_rencanakerja_tgl;
													}
												}
                                                $total2 = $total2 + $bobot; 	
                                            ?>
                                        	<tbody>
                                            	<tr class="{{ $status_bg }}">
                                                	<td>{{$v4->rencanaharian}}</td>
                                                    <td>{{$v4->darijam}}</td>
                                                    <td>{{$v4->sampaijam}}</td>
                                                    <td>{{$v4->aktifitas}}</td>
                                                    <td>{{$v4->aktifitas_darijam}}</td>
                                                    <td>{{$v4->aktifitas_sampaijam}}</td>
                									<td> 
                                                    </td>
                                                </tr>
                                            </tbody>
                                       	@endforeach
                                        @else
                                        <tbody>
                                        	<tr>
                                            	<td>Data tidak ada</td>
                                            </tr>
                                        </tbody>
                                        @endif
                                        <tr>
                                        	<td colspan="7">
                                            	<a class="btn btn-success" 
                                            		data-toggle="collapse" href="#collapsepie-{{$k}}-{{$k2}}-{{$k3}}" 
                                            		aria-expanded="false"><i class="fa fa-dashboard"></i></a>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td colspan="7">
                                            	<div class="collapse" id="collapsepie-{{$k}}-{{$k2}}-{{$k3}}">
                                               		<div class="piegrafik" id="pie-{{$k}}-{{$k2}}-{{$k3}}"
                                                        data-berhasil="{{ $v3['nilaiharian'] }}" 
                                                        data-gagal="{{ 100 - $v3['nilaiharian'] }}">
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        </table>
                                    @endforeach
                            		@endif
                                </div>
                            </div>
                            <div class="collapse" id="collapseColumn-{{$k}}-{{$k2}}">
                            	<div class="column"
                                	data-title="Rencana Kerja {{ \AHelper::tgl_indo($v2->daritgl) }} - 
                                    {{ \AHelper::tgl_indo($v2->sampaitgl) }}"
                                    data-berhasil="{{ implode(',', $v2->nilai_hari_terlaksana) }}" 
                                    data-tberhasil="{{ implode(',', $v2->nilai_hari_tterlaksana) }}">
                                </div>
                            </div>
                            <div class="row">
                            	
                            </div>
                            
                         
                            @endforeach 
                            @endif
                            
                                                     

                            
                        @endforeach
                    </div>
                	
                    
                </div>
            </div>
        </div>
   </div>
</div>

@endsection

@stop