@extends('layouts.adminlte')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rencana Kerja</h3>
              <a href="{{ url('rencana/kerja/create') }}" class="pull-right btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> Tambah</a>
            </div>
            
            <div class="box-body">
              <table id="rencana_kerja" class="table table-bordered table-hover">
                <thead>
                <tr>
                  	<th>Kode Rencana</th>
                  	<th>Rencana Kerja</th>
                  	<th>Dari</th>
                  	<th>Sampai</th>
                  	<th>Keterangan</th>
                  	<th>#</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($rencana as $k => $v)
                	<?php $fa_active = ($v->isactive==0) ? 'fa-circle':'fa-circle-o' ?>
                	<tr>
	                  	<td>{{$v->kode_rencana}}</td>
	                  	<td>{{$v->rencana_kerja}}</td>
	                  	<td>{{$v->dari_tgl}}</td>
	                  	<td>{{$v->sampai_tgl}}</td>
	                  	<td>{{$v->keterangan}}</td>
	                  	<td>
  	                  	<div class="btn-group">
    					            <button data-toggle="dropdown" class="btn btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
        									<ul class="dropdown-menu icons-right dropdown-menu-right">
        										<li><a href="{{ url('rencana/kerja', ['id' => $v->id]) }}/edit"><i class="fa fa-edit"></i> Ubah</a></li>
        										<li data-form="#frmModal-{{$v->id}}" 
        											data-title="Hapus {{ $v->id }}" 
        											data-message="Apa anda yakin menghapus {{ $v->username }} ?">
        											<a class= "frmModal" href="#"><i class="fa fa-trash"></i> Hapus</a>
        										</li>
        										<form action="{{ url('rencana/kerja', array($v->id) ) }}" 
        											method="post" style="display:none" id="frmModal-{{$v->id}}">
        											<input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="_method" value="DELETE" >
        										</form>
                            <li data-form="#frmModal-{{$v->id}}" 
        											data-title="Aktif {{ $v->id }}" 
        											data-message="Apa anda yakin mengaktifkan/menonaktifkan {{ $v->username }} ?">
        											<a class="frmModal" href="#"><i class="fa {{$fa_active}}"></i> Aktif / Non Aktif</a>
        										</li>
        										<form action="{{ url('/rencana/kerja', array($v->id) ) }}/aktif" method="get" style="display:none" id="frmModal-{{$v->id}}"></form>					
        									</ul>
      				          </div>
	                  	</td>
	                </tr>
	                @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                  	<th>Kode Rencana</th>
                  	<th>Rencana Kerja</th>
                  	<th>Dari</th>
                  	<th>Sampai</th>
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