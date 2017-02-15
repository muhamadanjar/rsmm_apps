@extends('template.londinium')
@section('content')
	<?php
		if ($aksi == 'edit') {
			$id_layer = $layer->id_layer;
			$layername = $layer->layername;
			$layerurl = $layer->layerurl;
			$layer_ = $layer->layer;
			$na = $layer->na;
			$orderlayer = $layer->orderlayer;
			$tipelayer = $layer->tipelayer; 
			$option_opacity = $layer->option_opacity;
			$option_visible = $layer->option_visible;$option_mode =$layer->option_mode;
			$jsonfield = $layer->jsonfield;

		}else{
			$id_layer = '';
			$layername = '';
			$layerurl = '';$layer_='';
			$na = '';
			$orderlayer = '';$tipelayer = '';$option_opacity ='';
			$option_visible = '';$option_mode ='';
			$jsonfield = '';
		}
	?>
    <form action="{{ url('admin/layer/tambah') }}" method="post" >
	    <div class="panel panel-default">
		
			<div class="panel-heading">
			 	<h6 class="panel-title"><i class="icon-file"></i> Layer</h6>
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id_layer" value="{{ $id_layer }}">

			<div class="panel-body">             
				<div class="row">
		            <div class="col-md-12">
		            	<div class="form-group">
		            		
		            		<label for="layername" class="col-md-2 control-label-kiri">Nama Layer</label>
		            		<div class="col-md-3">
		            			<input name="layername" class="form-control" value="{{ $layername }}" />
		            		</div>
		            	</div>
		            </div>

		            <div class="col-md-12">

		            	<div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Layer URL</label>
                            <div class="col-md-8">
                                <div class="input-group">
									<input name="layerurl" id="layerurl" class="form-control" value="{{ $layerurl }}" />
                                    <span class="input-group-btn">
										<button id="btn-load-layerurl" type="button" class="btn btn-default">Load Data</button>
									</span>
								</div>
                            </div>
                           

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Layer</label>
                            <div class="col-md-3">
                                <input name="layer" class="form-control" value="{{ $layer_ }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Non Aktif</label>
                            <div class="col-md-8">
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="switch switch-mini" name="na" type="checkbox"  value="1" @if($na =='1') checked="checked" @endif>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Urutan Layer</label>
                            <div class="col-md-1">
                               <input name="orderlayer" class="form-control" value="{{ $orderlayer }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Tipe Layer</label>
                            <div class="col-md-5">
                        		<select name="tipelayer" class="form-control">
		                            <option value="-">------</option>
		                           	<option value="dynamic" @if($tipelayer =='dynamic') selected="selected" @endif>dynamic</option>
		                            <option value="feature" @if($tipelayer =='feature') selected="selected" @endif>feature</option>
		                            <option value="image" @if($tipelayer =='image') selected="selected" @endif>image</option>
		                            <option value="tiled" @if($tipelayer =='tiled') selected="selected" @endif>tiled</option>
		                        </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Layer Opacity</label>
                            <div class="col-md-1">
                               <input name="option_opacity" class="form-control" value="{{ $option_opacity }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Layer Visiblity</label>
                            <div class="col-md-1">
                               <div class="checkbox">
                                    <label class="checkbox-info">
                                        <input name="option_visible" class="styled" type="checkbox" 
                                        @if($option_visible =='1') checked="checked" @endif value="1" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="layername" class="col-md-2 control-label-kiri">Layer Mode</label>
                            <div class="col-md-8">
                        		<select name="option_mode" class="form-control">
		                            <option value="0" @if($option_mode =='0') selected="selected" @endif>0 - MODE_SNAPSHOT</option>
		                            <option value="1" @if($option_mode =='1') selected="selected" @endif>1 - MODE_ONDEMAND</option>
		                            <option value="2" @if($option_mode =='2') selected="selected" @endif>2 - MODE_SELECTION</option>
		                        </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label-kiri">Hak Akses</label>
                            <div class="col-md-3">
                                {!! $level !!}
                            </div>
                        </div>
                    </div>
                    
                    <input name="jsonfield" id="jsonfield" type="hidden" class="form-control" value="{{ $jsonfield }}" />
                    <code class="jsonfield_code"></code>
                    <div class="col-md-12">
                        <div class="form-actions text-right">
                            <div class="col-md-11 col-md-offset-1">
                                <a href="{{ url('admin/layer') }}" class="btn btn-default">Reset</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

		            
		        </div>
	        </div>
		</div>	
	</form>
           
@endsection

@section('js_tambahan')
    <script type="text/javascript" src="{{ asset('3.12compact/init.js')}}"></script>
	<script type="text/javascript" src="{{ asset('esriGetFields.js') }}"></script>
    
@endsection		
				
	


@stop