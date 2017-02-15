@extends('layouts.adminlte')
@section('content')
	<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">FORMULIR PENILAIAN KARYAWAN</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        
        <div class="box-body">
	        
        	<h3>Data Karyawan</h3>
	        <hr>

	        <div class="row">
	        	<div class="col-md-6">
	            	
	            	<div>
		              	<div class="box-body">
			                <div class="form-group">
			                  	<label for="nama">Nama</label>
			                  	<select class="form-control select2" id="nama" name="name" style="width: 100%;">
				                  	<option selected="selected">Alabama</option>
				                  <option>Alaska</option>
				                  <option>California</option>
				                  <option>Delaware</option>
				                  <option>Tennessee</option>
				                  <option>Texas</option>
				                  <option>Washington</option>
				                </select>
				                
			                </div>
			                <div class="form-group">
			                  	<label for="tgl_masuk_kerja">Tgl. Masuk Kerja</label>
			                  	<div class="input-group date">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input type="text" class="form-control" id="tgl_masuk_kerja" placeholder="Tgl. Masuk Kerja">
				                </div>
			                  
			                </div>
			                
		              	</div>
		            </div>
	            </div>
	            <div class="col-md-6">
	            	
	            	<div>
		              	<div class="box-body">
			                <div class="form-group">
			                  	<label for="jabatan">Jabatan</label>
			                  	<input type="text" class="form-control" id="jabatan" readonly placeholder="Nama">
			                </div>
			                <div class="form-group">
			                  	<label for="pendidikan_terakhir">Pendidikan Terakhir</label>
			                  	<input type="text" class="form-control" id="pendidikan_terakhir" readonly placeholder="Pendidikan Terakhir">
			                </div>
		              	</div>
		            </div>
	            </div>
	        	
	        </div>


	        <h3>Data Absensi</h3>
	        <hr>

	        <div class="row">
	        	<div class="col-md-6">
	       			<div class="box-body">
	       				<div class="form-group">
	       					<div class="col-md-3">Sakit :</div>
	       					<div class="col-md-2"><input type="text" class="form-control" /></div>
	       					[ hari x (-0,5)]  +  [ hari x (-1)] = }
	       				</div>
	       				<div class="form-group">
	       					<div class="col-md-3">Izin :</div>
	       					<div class="col-md-2"><input type="text" class="form-control" /></div>
	       					[ hari x (-0,5)]  +  [ hari x (-1)] =  }
	       				</div>
	       				<div class="form-group">
	       					<div class="col-md-3">Mangkir :</div>
	       					<div class="col-md-2"><input type="text" class="form-control" /></div>
	       					[ hari x (-1,0)]  +  [ hari x (-2)] = }
	       				</div>
		              
		            </div>
	            </div>
	            <div class="col-md-6">
	            	
	            </div>
	        	
	        </div>
	        <hr>

	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="box-body">
	        			<table class="table table-bordered">
			                <tr>
			                  <th>#</th>
			                  <th>Kriteria</th>
			                  <th>Nilai</th>
			                  <th>Ket</th>
			                </tr>
			                @forelse($kriteria as $k => $v)
			                <tr>
			                  	<td>{{$v->id}}.</td>
			                  	<td>{{$v->kriteria}}</td>
			                  	<td>
			                  		<div class="col-md-3">
			                  			<input type="text" class="form-control" id="nilai" name="nilai[]" placeholder="Nilai">	
			                  		</div>
			                  	</td>
			                  	<td><a class="btn btn-sm btn-primary">Show</a></td>
			                </tr>
			                @empty
			                <tr>
			                  	<td colspan="4">Data Tidak ada</td>
			                </tr>
			                @endforelse
			                <tr>
			                  	<td colspan="2">NB: Nilai = 1 s/d 5 (lihat Panduan Penilaian Karyawan)   NILAI TOTAL (<b>NT</b>) :</td>
			                  	
			                  	<td>
			                  		<div class="col-md-3">
			                  			<input type="text" class="form-control" id="total" name="total[]" placeholder="Total">	
			                  		</div>
			                  	</td>
			                  	<td></td>
			                </tr>
			                <tr>
			                  	<td colspan="2">NILAI FINAL (NF) = (NT) – (NA) = ( …….. ) – ( .……. )  = </td>
			                  	
			                  	<td>
			                  		<div class="col-md-3">
			                  			<input type="text" class="form-control" id="totalfinal" name="totalfinal" placeholder="Total">	
			                  		</div>
			                  	</td>
			                  	<td></td>
			                </tr>
			                
			               
			            </table>
	        		</div>
	        	</div>
	        </div>
          
        </div>
        
        <div class="box-footer">
         
        </div>
    </div>
    
@endsection