@extends('layouts.adminlte')

@section('content')
	<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="http://placehold.it/128" alt="Gambar UMKM">

              <h3 class="profile-username text-center">{{$profil->i_1}}</h3>

              <p class="text-muted text-center">--</p>

              

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tentang Kuesioner</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Nama Pemilik</strong>
              <p class="text-muted">{{$profil->i_2}}</p>
              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat Perusahaan</strong>
              <p class="text-muted">{{$profil->i_3}}</p>
              <hr>

              <strong><i class="fa fa-phone margin-r-5"></i> No HP / Telepon</strong>
              <p class="text-muted">{{$profil->i_4}}</p>
              <hr>

              <strong><i class="fa fa-envelope margin-r-5"></i> Alamat E-mail</strong>
              <p class="text-muted">
                <p class="text-muted">{{$profil->i_5}}</p>
              </p>
              <hr>

              <strong><i class="fa fa-globe margin-r-5"></i> Alamat Website</strong>
              <p class="text-muted">
                <p class="text-muted">{{$profil->i_6}}</p>
              </p>
              <hr>

              <strong><i class="fa fa-users margin-r-5"></i> Jumlah Karyawan</strong>
              <p class="text-muted">
                <p class="text-muted">{{$profil->i_7}} Orang</p>
              </p>
              <hr>

              


              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>{{$profil->iv_1}}.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              
              <li class="active"><a href="#umkm" data-toggle="tab">UMKM</a></li>
              <li><a href="#lain" data-toggle="tab">Lainnya</a></li>
              
            </ul>
            <div class="tab-content">
              
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="umkm">

                <div class="row">
                  <div class="col-xs-12">
                    <h2 class="page-header">
                      <i class="fa fa-globe"></i> Deskripsi.
                      <small class="pull-right"></small>
                    </h2>
                  </div>
                  <!-- /.col -->
                </div>

                

                <b><p>Dalam melakukan proses usahanya, sudah dilakukan pembagian pekerjaan untuk masing-masing karyawan (Seperti bagian administrasi, produksi, pemasaran, dll). </p></b>
                <p class="text-yellow">{{ $sudahbelum[$profil->i_8] }}</p>

                <b><p>Apakah UMKM sudah mempunyai legalitas usaha.</p></b>
                <p class="text-yellow">{{ $sudahbelum[$profil->i_9] }}</p>

                <b><p>Apabila jabawan butir b sudah, legalitas yang dimiliki berupa.</p></b>
                <p class="text-yellow">{{ $sudahbelum[$profil->i_10] }}</p>

                <b><p>Sebutkan produk yang dihasilkan oleh UMKM Saudara, dan sebutkan mana yang merupakan produk utama?</p></b>
                <p class="text-yellow">{{ $profil->i_11 }}</p>

                <b><p>Apakah Produk yang dihasilkan sudah mempunyai Merkyang terdaftar di Kementerian Hukum dan HAM?</p></b>
                <p class="text-yellow">{{ $sudahbelum[$profil->i_12] }}</p>

                <b><p>Apabila produk Saudara sudah mempunyai ijin edar?</p></b>
                <p class="text-yellow">{{ $sudahbelum[$profil->i_13] }}</p>

                <b><p>Berapakah rata-rata pertahun volume produksi untuk produk utama yang Saudara.</p></b>
                <p class="text-yellow">{{ $profil->i_14 }}</p>

                <b><p>Berapakah rata-rata pertahun nilai produksi untuk produk utama yang Saudara hasilkan:</p></b>
                <p class="text-yellow">{{ $profil->i_15 }}</p>

                <b><p>Mohon disebutkan area pemasaran untuk produk Saudara:</p></b>
                <p class="text-yellow">{{ $profil->i_16 }}</p>
              </div>

              <div class="tab-pane" id="lain">
                
              </div>

              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@stop