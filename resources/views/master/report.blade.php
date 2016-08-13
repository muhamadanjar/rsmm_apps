@extends('app')
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-8 col-md-offset-2">                  
                  <div class="panel panel-default">
                     <div class="panel-heading">Laporan</div>
                     <div class="panel-body">
                        <form role="form" id="rekap-tanggal" method="post" action="{{ url('/laporan/rekap') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Dari Tanggal</label>
                                 <input type="text" placeholder="Dari Tanggal" name="daritgl" value="{{ old('daritgl') }}" class="form-control dateField">
                              </div>   
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Sampai Tanggal</label>
                                 <input type="text" placeholder="Sampai" name="sampaitgl" value="{{ old('sampaitgl') }}" class="form-control dateField">
                              </div>
                           </div>
                           <div class="col-md-offset-6 col-md-6">
                              <div class="form-group">
                                 <label>Pengguna</label>
                                 <select name="pengguna" class="form-control">
                                    <option value="all">----- Semua -----</option>
                                    @foreach($users as $k => $v)
                                       <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <button type="submit" class="btn btn-sm btn-default">Submit</button>   
                              </div>
                           </div>
                           
             
                           
                        </form>
                        <table class="table table-responsive">
                        @if(isset($rekap))
                           @foreach($users as $s => $vs)
                              <tr class="alert alert-info">
                                 <th>Username</th>
                                 <th>:</th>
                                 <th>{{$vs->name}}</th>   
                              </tr>
                              <tr>
                                 <td colspan="3">
                                    @foreach($tgl as $kt => $vt)
                                       <b>{{ \AHelper::tgl_indo($vt->tgl) }}</b>
                                       <table class="table table-responsive">
                                          <tr>
                                             <th>#</th>
                                             <th>Rencana Kerja Harian</th>
                                             <th>Aktifitas</th>
                                             <th>Dari Jam</th>
                                             <th>Sampai Jam</th>
                                             <th>Nama</th>
                                          </tr>
                                          @foreach($rekap as $k => $v)
                                             @if($v->id == $vs->id)
                                                @if($v->tgl == $vt->tgl)
                                             <tr>
                                                <th></th>
                                                <td>{{$v->rencanaharian}}</td>
                                                <td>{!! $v->aktifitas!!}</td>
                                                <td>{{$v->darijam}}</td>
                                                <td>{{$v->sampaijam}}</td>
                                                <td>{{$v->name}}</td>
                                             </tr>
                                                @endif
                                             @endif
                                          @endforeach
                                       </table>
                                       @endforeach
                                       
                                    
                                    
                                 </td>
                              </tr>
                           @endforeach
                           @if(count($rekap) > 0)
                           <div class="col-md-2">
                              <a href="{{ url('/laporan/rekap/xl-rsmm') }}"><img width="30" class="img img-responsive" src="{{ asset('/images/icons/xls.png') }}"></a>
                           </div>               
                           @else
                              Data Tidak Ada
                           @endif

                        @endif
                        </table>
                        
                        
                     </div>
                  </div>
      </div>
   </div>
</div>
@endsection
@stop