@extends('app')
@section('content')

<div class="container-fluid">
	<div class="row">
   		<div class="col-md-8 col-md-offset-2">                  
        	<div class="panel panel-default">
            <div class="panel-heading">Laporan</div>
            	<div class="panel-body">
                	<form role="form" id="rekap-tanggal" method="post" action="">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-md-6">
                              <div class="form-group">
                                 <label>Dari Tanggal</label>
                                 <input type="text" placeholder="Dari Tanggal" 
                                 name="daritgl" value="{{ old('daritgl') }}" 
                                 class="form-control dateField">
                              </div>   
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Sampai Tanggal</label>
                                 <input type="text" placeholder="Sampai Tanggal" 
                                 name="sampaitgl" value="{{ old('sampaitgl') }}" 
                                 class="form-control dateField">
                              </div>
                           </div>
                    </form>
                </div>
            </div>
        </div>
   	</div>
</div>