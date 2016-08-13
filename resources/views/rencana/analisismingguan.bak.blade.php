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
                                	<i class="fa fa-calendar"></i> <b>{{ \AHelper::tgl_indo($v2->daritgl) }} - {{ \AHelper::tgl_indo($v2->sampaitgl) }}</b>
                                    <a class="btn btn-primary" 
                                            data-toggle="collapse" href="#collapseExample-{{$k}}-{{$k2}}" 
                                            aria-expanded="false" 
                                            aria-controls="collapseExample-{{$k}}"><i class="fa fa-folder"></i>
                                    Buka/Tutup</a>
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
                                                	<td colspan="8">{{ \AHelper::tgl_indo($v3['tgl']) }}</td>
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
                                                    <th> </th>
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
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <input name="bobot" value="{{ $bobot }}" {{$readonly}} 
                                                            placeholder="bobot" class="form-control bobotText"
                                                            maxlength="3"  /> 
                                                            </div>
                                                            <div data-harianid="{{$v4->id}}" 
                                                                data-bobot="{{ $bobot }}"> 
                                                                <a class="btn {{$btn_bobot}} btn-harian-proses">
                                                                    <i class="fa fa-floppy-o"></i>
                                                                </a>
                                                            </div>
                                                        </div>
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
                                        </table>
                                    @endforeach
                            		@endif
                                </div>
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