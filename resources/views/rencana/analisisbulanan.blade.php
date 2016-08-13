@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Analisis Bulanan</h4></div>
				<div class="panel-body">
                	<div class="col-md-12">
                    	@foreach($bulanan as $kb => $vb)
                        	<div class="row table">
                                <div class="alert alert-info">
                                    <div class="col-md-2"><i class="fa fa-user"></i><b> Nama User :</b></div> 
                                    <i>{{ $vb->name }}</i>
                                </div>
                            </div>
                            @foreach($vb->bulanan as $k => $v)
                            <div class="row">
                            	<div class="col-md-12">
                                	<div class="alert alert-success">
                                        <div class="col-md-2"><i class="fa fa-user"></i><b> Bulan :</b></div> 
                                        <i> {{$v['bulan']}}</i> 
                                        || Nilai Rata - rata : <b>{{$v['nilai_rata_rata']}}</b>
                                    </div>
                                </div>
                            	@foreach($v['mingguan'] as $k2 => $v2)
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-9">
                                        <i class="fa fa-calendar"></i> 
                                        <b>{{ \AHelper::tgl_indo($v2->daritgl) }} - 
                                        {{ \AHelper::tgl_indo($v2->sampaitgl) }}</b>
                                        <a class="btn btn-primary" 
                                                data-toggle="collapse" href="#collapseColumn-{{$kb}}-{{$k}}-{{$k2}}" 
                                                aria-expanded="false" 
                                                aria-controls="collapseColumn-{{$k}}"><i class="fa fa-folder"></i>
                                        Grafik</a>
                                        Nilai Perminggu <span class="badge">{{ round($v2->nilaimingguanv2,2) }}</span>
                                        Nilai Gabungan <span class="badge">{{ round($v2->nilai_gabungan,2) }}</span> 
                                        <span class="badge">{{ $v2->nilai_status }}</span>    
                                    </div> 
                                </div>
                                <div class="row"><div class="col-md-offset-2">&nbsp;</div></div>
                               
                                <div class="collapse col-md-6" id="collapseColumn-{{$kb}}-{{$k}}-{{$k2}}">
                                    <div class="column"
                                        data-title="Rencana Kerja {{ \AHelper::tgl_indo($v2->daritgl) }} - 
                                        {{ \AHelper::tgl_indo($v2->sampaitgl) }}"
                                        data-berhasil="{{ implode(',', $v2->nilai_hari_terlaksana) }}" 
                                        data-tberhasil="{{ implode(',', $v2->nilai_hari_tterlaksana) }}">
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop