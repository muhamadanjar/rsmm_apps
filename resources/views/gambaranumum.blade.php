@extends('layouts.adminlte')

@section('content')

    <!-- =========================================================== -->
    <!--Bagian 1-->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info collapsed-box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Bagian 1</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$i7['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($i7['hasil'] as $i7_k => $i7_v)
                                        <tr>
                                            <td><b><i>{{ $i7['kategori'][$i7_k] }}</i></b></td>
                                            <td>{{ $i7_v['frekuensi'] }}</td>
                                            <td>{{ $i7_v['presentase'] }} %</td>
                                            

                                        </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_i7"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$i9['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($i9['hasil'] as $i9_k => $i9_v)
                                        <tr>
                                            <td><b><i>{{ $i9['kategori'][$i9_k] }}</i></b></td>
                                            <td>{{ $i9_v['frekuensi'] }}</td>
                                            <td>{{ $i9_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_i9"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">Legalitas yang Dimiliki</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($i10['hasil'] as $i10_k => $i10_v)
                                        <tr>
                                            <td><b><i>{{ $i10['kategori'][$i10_k] }}</i></b></td>
                                            <td>{{ $i10_v['frekuensi'] }}</td>
                                            <td>{{ $i10_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_i10"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">Apakah Produk yang dihasilkan sudah mempunyai Merk yang terdaftar di Kementerian Hukum dan HAM</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($i12['hasil'] as $i12_k => $i12_v)
                                        <tr>
                                            <td><b><i>{{ $i12['kategori'][$i12_k] }}</i></b></td>
                                            <td>{{ $i12_v['frekuensi'] }}</td>
                                            <td>{{ $i12_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_i12"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">Apabila produk Saudara sudah mempunyai ijin edar?</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($i13['hasil'] as $i13_k => $i13_v)
                                        <tr>
                                            <td><b><i>{{ $i13['kategori'][$i13_k] }}</i></b></td>
                                            <td>{{ $i13_v['frekuensi'] }}</td>
                                            <td>{{ $i13_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_i13"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">Jenis produk apa yang saudara hasilkan?</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($pangan['hasil'] as $pangan_k => $pangan_v)
                                        <tr>
                                            <td><b><i>{{ $pangan['kategori'][$pangan_k] }}</i></b></td>
                                            <td>{{ $pangan_v['frekuensi'] }}</td>
                                            <td>{{ $pangan_v['presentase'] }} %</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_pangan"></div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div>
    </div>
    <!-- Bagian 2 -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning collapsed-box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Bagian 2</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_2['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_2['hasil'] as $ii_2_k => $ii_2_v)
                                        <tr>
                                            <td><b><i>{{ $ii_2['kategori'][$ii_2_k] }}</i></b></td>
                                            <td>{{ $ii_2_v['frekuensi'] }}</td>
                                            <td>{{ $ii_2_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii2"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_3['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_3['hasil'] as $ii_3_k => $ii_3_v)
                                        <tr>
                                            <td><b><i>{{ $ii_3['kategori'][$ii_3_k] }}</i></b></td>
                                            <td>{{ $ii_3_v['frekuensi'] }}</td>
                                            <td>{{ $ii_3_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii3"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_3_a['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_3_a['hasil'] as $ii_3_a_k => $ii_3_a_v)
                                        <tr>
                                            <td><b><i>{{ $ii_3_a['kategori'][$ii_3_a_k] }}</i></b></td>
                                            <td>{{ $ii_3_a_v['frekuensi'] }}</td>
                                            <td>{{ $ii_3_a_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii3a"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_4['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_4['hasil'] as $ii_4_k => $ii_4_v)
                                        <tr>
                                            <td><b><i>{{ $ii_4['kategori'][$ii_4_k] }}</i></b></td>
                                            <td>{{ $ii_4_v['frekuensi'] }}</td>
                                            <td>{{ $ii_4_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_6['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_6['hasil'] as $ii_6_k => $ii_6_v)
                                        <tr>
                                            <td><b><i>{{ $ii_6['kategori'][$ii_6_k] }}</i></b></td>
                                            <td>{{ $ii_6_v['frekuensi'] }}</td>
                                            <td>{{ $ii_6_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii6"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_7_a['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_7_a['hasil'] as $ii_7_a_k => $ii_7_a_v)
                                        <tr>
                                            <td><b><i>{{ $ii_7_a['kategori'][$ii_7_a_k] }}</i></b></td>
                                            <td>{{ $ii_7_a_v['frekuensi'] }}</td>
                                            <td>{{ $ii_7_a_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii7_a"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_7_b['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_7_b['hasil'] as $ii_7_b_k => $ii_7_b_v)
                                        <tr>
                                            <td><b><i>{{ $ii_7_b['kategori'][$ii_7_b_k] }}</i></b></td>
                                            <td>{{ $ii_7_b_v['frekuensi'] }}</td>
                                            <td>{{ $ii_7_b_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii7_b"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_7_c['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_7_c['hasil'] as $ii_7_c_k => $ii_7_c_v)
                                        <tr>
                                            <td><b><i>{{ $ii_7_c['kategori'][$ii_7_c_k] }}</i></b></td>
                                            <td>{{ $ii_7_c_v['frekuensi'] }}</td>
                                            <td>{{ $ii_7_c_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii7_c"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$ii_7_d['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($ii_7_d['hasil'] as $ii_7_d_k => $ii_7_d_v)
                                        <tr>
                                            <td><b><i>{{ $ii_7_d['kategori'][$ii_7_d_k] }}</i></b></td>
                                            <td>{{ $ii_7_d_v['frekuensi'] }}</td>
                                            <td>{{ $ii_7_d_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_ii7_d"></div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div>
    </div>
    <!-- Bagian 3 -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary collapsed-box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Bagian 3</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">{{$iii_1['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_1['hasil'] as $iii_1_k => $iii_1_v)
                                        <tr>
                                            <td><b><i>{{ $iii_1['kategori'][$iii_1_k] }}</i></b></td>
                                            <td>{{ $iii_1_v['frekuensi'] }}</td>
                                            <td>{{ $iii_1_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_1"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Jika Sudah Mendapatkan informasi produk, dari mana mendapatkan informasi tentang SNI tersebut? </div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_2_a['hasil'] as $iii_2_a_k => $iii_2_a_v)
                                        <tr>
                                            <td><b><i>{{ $iii_2_a['kategori'][$iii_2_a_k] }}</i></b></td>
                                            <td>{{ $iii_2_a_v['frekuensi'] }}</td>
                                            <td>{{ $iii_2_a_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_2"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Bagaimana pemahaman Saudara terhadap SNI</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_3['hasil'] as $iii_3_k => $iii_3_v)
                                        <tr>
                                            <td><b><i>{{ $iii_3['kategori'][$iii_3_k] }}</i></b></td>
                                            <td>{{ $iii_3_v['frekuensi'] }}</td>
                                            <td>{{ $iii_3_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_3"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Bagaimana pemahaman Saudara terhadap SNI</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_4['hasil'] as $iii_4_k => $iii_4_v)
                                        <tr>
                                            <td><b><i>{{ $iii_4['kategori'][$iii_4_k] }}</i></b></td>
                                            <td>{{ $iii_4_v['frekuensi'] }}</td>
                                            <td>{{ $iii_4_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_4"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">{{$iii_5['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_5['hasil'] as $iii_5_k => $iii_5_v)
                                        <tr>
                                            <td><b><i>{{ $iii_5['kategori'][$iii_5_k] }}</i></b></td>
                                            <td>{{ $iii_5_v['frekuensi'] }}</td>
                                            <td>{{ $iii_5_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_5"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">{{$iii_6['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_6['hasil'] as $iii_6_k => $iii_6_v)
                                        <tr>
                                            <td><b><i>{{ $iii_6['kategori'][$iii_6_k] }}</i></b></td>
                                            <td>{{ $iii_6_v['frekuensi'] }}</td>
                                            <td>{{ $iii_6_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_6"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">{{$iii_7['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_7['hasil'] as $iii_7_k => $iii_7_v)
                                        <tr>
                                            <td><b><i>{{ $iii_7['kategori'][$iii_7_k] }}</i></b></td>
                                            <td>{{ $iii_7_v['frekuensi'] }}</td>
                                            <td>{{ $iii_7_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_7"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">{{$iii_8['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_8['hasil'] as $iii_8_k => $iii_8_v)
                                        <tr>
                                            <td><b><i>{{ $iii_8['kategori'][$iii_8_k] }}</i></b></td>
                                            <td>{{ $iii_8_v['frekuensi'] }}</td>
                                            <td>{{ $iii_8_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_8"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">{{$iii_10['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_10['hasil'] as $iii_10_k => $iii_10_v)
                                        <tr>
                                            <td><b><i>{{ $iii_10['kategori'][$iii_10_k] }}</i></b></td>
                                            <td>{{ $iii_10_v['frekuensi'] }}</td>
                                            <td>{{ $iii_10_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_10"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-primary">
                                <div class="panel-heading">{{$iii_11['judul']}}</div>
                                <div class="panel-body">
                                    <table class="table">
                                        
                                        <tr>
                                            <th>#</th>
                                            <th>Frekuensi</th>
                                            <th>Presentasi</th>

                                        </tr>
                                        @foreach($iii_11['hasil'] as $iii_11_k => $iii_11_v)
                                        <tr>
                                            <td><b><i>{{ $iii_11['kategori'][$iii_11_k] }}</i></b></td>
                                            <td>{{ $iii_11_v['frekuensi'] }}</td>
                                            <td>{{ $iii_11_v['presentase'] }} %</td>

                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="chart_iii_11"></div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div>
    </div>
    
    

    <!--Bagian 3-->


    
	

@endsection

@section('js_tambahan')
<script type="text/javascript">
$(function () {

    Highcharts.theme = {
        colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
                 '#FF9655', '#FFF263', '#6AF9C4'],
        chart: {
            backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                ]
            },
        },
        title: {
            style: {
                color: '#000',
                font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
            }
        },
        subtitle: {
            style: {
                color: '#666666',
                font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
            }
        },

        legend: {
            itemStyle: {
                font: '9pt Trebuchet MS, Verdana, sans-serif',
                color: 'black'
            },
            itemHoverStyle:{
                color: 'gray'
            }   
        }
    };
    //Highcharts.setOptions(Highcharts.theme);
    Highcharts.chart('chart_i7', {
        colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
                 '#FF9655', '#FFF263', '#6AF9C4'],
        chart: {
            type: 'bar'
        },
        plotOptions: {
            bar: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false,

            },

        },
     
        xAxis: {
            categories: ['1-4', '5-19', '20-99', 'Lebih dari 100']
        },
        title: {
            text: 'I7'  
        },
        series: [{
            data: [<?=implode(',', $i7['data'])?>]        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_i9', {
        chart: {
        	type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: ['Sudah','Belum']
        },

        title: {
            text: 'I9'  
        },
        series: [{
            data: <?=json_encode($i9['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_i10', {
        chart: {
            type: 'bar'
        },
        plotOptions: {
            bar: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
     
        xAxis: {
            categories: ['TDP', 'UIU', 'Lainnya']
        },
        title: {
            text: 'I10'  
        },
        series: [{
            data: [<?=implode(',', $i10['data'])?>]        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_i12', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: ['Sudah','Belum']
        },

        title: {
            text: 'I12'  
        },
        series: [{
            data: <?=json_encode($i12['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_i13', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: ['Belum','Sudah']
        },

        title: {
            text: 'I13'  
        },
        series: [{
            data: <?=json_encode($i13['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_pangan', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: ['Pangaan','Non Pangan']
        },

        title: {
            text: 'Pangan'  
        },
        series: [{
            data: <?=json_encode($pangan['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    //Bagian 2

    Highcharts.chart('chart_ii2', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($ii_2['kategori'])?>
        },

        title: {
            text: 'ii 2'  
        },
        series: [{
            data: <?=json_encode($ii_2['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    Highcharts.chart('chart_ii3', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($ii_3['kategori'])?>
        },

        title: {
            text: 'ii 3'  
        },
        series: [{
            data: <?=json_encode($ii_3['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    Highcharts.chart('chart_ii3a', {
        chart: {
            type: 'bar'
        },
        plotOptions: {
            bar: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
     
        xAxis: {
            categories: <?=json_encode($ii_3_a['kategori'])?>
        },
        title: {
            text: 'II 3 A'  
        },
        series: [{
            data: [<?=implode(',', $ii_3_a['data'])?>]        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    Highcharts.chart('chart_ii4', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($ii_4['kategori'])?>
        },

        title: {
            text: 'ii 4'  
        },
        series: [{
            data: <?=json_encode($ii_4['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    Highcharts.chart('chart_ii6', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($ii_6['kategori'])?>
        },

        title: {
            text: 'ii 6'  
        },
        series: [{
            data: <?=json_encode($ii_6['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    Highcharts.chart('chart_ii7_a', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($ii_7_a['kategori'])?>
        },

        title: {
            text: 'ii 7 A'  
        },
        series: [{
            data: <?=json_encode($ii_7_a['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    Highcharts.chart('chart_ii7_b', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($ii_7_b['kategori'])?>
        },

        title: {
            text: 'ii 7 B'  
        },
        series: [{
            data: <?=json_encode($ii_7_b['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    Highcharts.chart('chart_ii7_c', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($ii_7_c['kategori'])?>
        },

        title: {
            text: 'ii 7 C'  
        },
        series: [{
            data: <?=json_encode($ii_7_c['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    Highcharts.chart('chart_ii7_d', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($ii_7_d['kategori'])?>
        },

        title: {
            text: 'ii 7 D'  
        },
        series: [{
            data: <?=json_encode($ii_7_d['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    //Bagian 3
    Highcharts.chart('chart_iii_1', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: ['Belum','Sudah']
        },

        title: {
            text: 'iii_1'  
        },
        series: [{
            data: <?=json_encode($iii_1['data'],JSON_NUMERIC_CHECK)?>        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_2', {
        chart: {
            type: 'bar'
        },
        plotOptions: {
            bar: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
     
        xAxis: {
            categories: <?=json_encode($iii_2_a['kategori'])?>
        },
        title: {
            text: 'III 2'  
        },
        series: [{
            data: [<?=implode(',', $iii_2_a['data'])?>]        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_3', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($iii_3['kategori'])?>
        },

        title: {
            text: 'III 3'  
        },
        series: [{
            data: <?=json_encode($iii_3['data'],JSON_NUMERIC_CHECK)?>       
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_4', {
        chart: {
            type: 'pie'
        },
        colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
                 '#FF9655', '#FFF263', '#6AF9C4'],
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($iii_4['kategori'])?>
        },

        title: {
            text: 'III 4'  
        },
        series: [{
            data: <?=json_encode($iii_4['data'],JSON_NUMERIC_CHECK)?>       
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_5', {
        chart: {
            type: 'bar'
        },
        plotOptions: {
            bar: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
     
        xAxis: {
            categories: <?=json_encode($iii_5['kategori'])?>
        },
        title: {
            text: 'III 5'  
        },
        series: [{
            data: [<?=implode(',', $iii_5['data'])?>]        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_6', {
        chart: {
            type: 'pie'
        },
        colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', 
                 '#FF9655', '#FFF263', '#6AF9C4'],
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($iii_6['kategori'])?>
        },

        title: {
            text: 'III 6'  
        },
        series: [{
            data: <?=json_encode($iii_6['data'],JSON_NUMERIC_CHECK)?>       
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_7', {
        chart: {
            type: 'pie'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        xAxis: {
            categories: <?=json_encode($iii_7['kategori'])?>
        },

        title: {
            text: 'III 7'  
        },
        series: [{
            data: <?=json_encode($iii_7['data'],JSON_NUMERIC_CHECK)?>       
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_8', {
        chart: {
            type: 'bar'
        },
        plotOptions: {
            bar: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
     
        xAxis: {
            categories: <?=json_encode($iii_8['kategori'])?>
        },
        title: {
            text: 'III 8'  
        },
        series: [{
            data: [<?=implode(',', $iii_8['data'])?>]        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_10', {
        chart: {
            type: 'bar'
        },
        plotOptions: {
            bar: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
     
        xAxis: {
            categories: <?=json_encode($iii_10['kategori'])?>
        },
        title: {
            text: 'III 10'  
        },
        series: [{
            data: [<?=implode(',', $iii_10['data'])?>]        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });

    Highcharts.chart('chart_iii_11', {
        chart: {
            type: 'bar'
        },
        plotOptions: {
            bar: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,

                },
                showInLegend: false
            }
        },
     
        xAxis: {
            categories: <?=json_encode($iii_11['kategori'])?>
        },
        title: {
            text: 'III 11'  
        },
        series: [{
            data: [<?=implode(',', $iii_11['data'])?>]        
        }],
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}%</b>'
        },
        credits: {
            enabled:false,
        }
    });
    
});
</script>
@endsection