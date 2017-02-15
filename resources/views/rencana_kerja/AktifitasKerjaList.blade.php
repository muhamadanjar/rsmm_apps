@extends('layouts.adminlte')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Aktifitas Kerja</h3>
              <a href="{{ url('rencana/aktifitas/create') }}" class="pull-right btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> Tambah</a>
            </div>
            
            <div class="box-body">
              <table id="rencana_kerja" class="table table-bordered table-hover">
                <thead>
                <tr>
                  	
                  	<th>Aktifitas Kerja</th>
                  	
                  	<th>Keterangan</th>
                  	<th>#</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($aktifitas as $k => $v)
                	<?php $fa_active = ($v->isactive==0) ? 'fa-circle':'fa-circle-o' ?>
                	<tr>
	                  	
	                  	<td>{{$v->aktifitas_kerja}}</td>
	                  	
	                  	<td>{{$v->keterangan}}</td>
	                  	<td>
  	                  	<div class="btn-group">
    					            <button data-toggle="dropdown" class="btn btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
        									<ul class="dropdown-menu icons-right dropdown-menu-right">
        										<li><a href="{{ url('rencana/aktifitas', ['id' => $v->id,'edit']) }}"><i class="fa fa-edit"></i> Ubah</a></li>
        										<li data-form="#frmModal-{{$v->id}}" 
        											data-title="Hapus {{ $v->id }}" 
        											data-message="Apa anda yakin menghapus {{ $v->username }} ?">
        											<a class= "frmModal" href="#"><i class="fa fa-trash"></i> Hapus</a>
        										</li>
        										<form action="{{ url('rencana/aktifitas', array($v->id) ) }}" 
        											method="post" style="display:none" id="frmModal-{{$v->id}}">
        											<input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="DELETE" >
        										</form>
                            <li data-form="#frmModal-{{$v->id}}" 
        											data-title="Aktif {{ $v->id }}" 
        											data-message="Apa anda yakin mengaktifkan/menonaktifkan {{ $v->username }} ?">
        											<a class="frmModal" href="#"><i class="fa {{$fa_active}}"></i> Aktif / Non Aktif</a>
        										</li>
        										<form action="{{ url('/rencana/aktifitas', array($v->id,'aktif') ) }}" method="get" style="display:none" id="frmModal-{{$v->id}}"></form>					
        									</ul>
      				          </div>
	                  	</td>
	                </tr>
	                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                  	<th>Aktifitas Kerja</th>
                    <th>Keterangan</th>
                    <th>#</th>
                </tr>
                </tfoot>
              </table>
            </div>
            
        </div>          
    </div>

</div>

@endsection