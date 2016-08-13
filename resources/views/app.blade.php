<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Realsoft Media </title>

	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/fontawesome/css/font-awesome.min.css') }}">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/datatable_rsmm.css') }}" rel="stylesheet">
	<!--<link href="{{ asset('/css/rsmm.css') }}" rel="stylesheet">-->

	<link rel="icon" href="{{ asset('images/rsmm.png')}}">


	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">RSMM - APP</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Rencana<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/rencanakerja/mingguan') }}">Mingguan</a></li>
							<li><a href="{{ url('/rencanakerja/harian') }}">Harian</a></li>
						</ul>
					</li>
                    <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Analisis<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">

							<li><a href="{{ url('/rencanakerja/analisis/harian') }}">Analisis Harian</a></li>
                            <li><a href="{{ url('/rencanakerja/analisis/mingguan') }}">Analisis Mingguan</a></li>
                            <li><a href="{{ url('/rencanakerja/analisis/bulanan') }}">Analisis Bulanan</a></li>
                            <li><a href="{{ url('/rencanakerja/nilai/harian') }}">Lihat Nilai Harian</a></li>
                            <li><a href="{{ url('/rencanakerja/nilai/mingguan') }}">Lihat Nilai Mingguan</a></li>
							
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="#">Laporan <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/laporan/index') }}">Master</a></li>
							<li><a href="{{ url('/laporan/harian-mingguan') }}">Harian Mingguan</a></li>
							<li><a href="{{ url('/laporan') }}">Harian</a></li>
							
						</ul>
					</li>
					
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li>
					<a class="rt-clock wow fadeInLeft">
				        <span class="date"></span>&nbsp;
				        <span class="hours">00</span>:
				        <span class="minutes">00</span>:
				        <span class="seconds">00</span>
				    </a>
				    </li>						
					
					@if (Auth::guest())
						<li><a href="{{ url('/cauth/login') }}">Login</a></li>
						<li><a href="{{ url('/cauth/register') }}">Register</a></li>
					@else
                    	<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                            role="button" aria-expanded="false">Custom<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/custom/analisisharian') }}">Analisis Harian</a></li>
                                <li><a href="{{ url('/custom/analisismingguan') }}">Analisis Mingguan</a></li>
                                <li><a href="{{ url('/custom/analisisbulanan') }}">Analisis Bulanan</a></li>

                            </ul>
                        </li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}  <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
                            	<li><img src="{{ url('images/users') }}/{{ Auth::user()->photo }}" class="img-thumbnail img-responsive" width="50" ></li>
                                <li class="divider"></li>
								<li><a href="{{ url('/user/ubah') }}">Ubah Profil</a></li>
								
								<li><a href="{{ url('/user') }}">Daftar User</a></li>
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>

				                    
				               
		</div>
	</nav>

	@if(Session::has('messageError'))
		<p class="bg-danger"></p>
		<div class="alert alert-danger" role="alert">
		  	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		  	<span class="sr-only">Error:</span>
		  	{!! Session::get('messageError') !!}
		</div>
		
	@endif
	

			

	@yield('content')
	@include('vendor.modal')
    <div id="hgchart"></div>


	<!-- Scripts -->
	<script type="text/javascript" src="{{ url('vendor/jqueryui/js/jquery-1.10.2.js')}}"></script>
	<script type="text/javascript" src="{{ url('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('vendor/jqueryui/js/jquery-ui-1.10.4.custom.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('vendor/moment/min/moment-with-langs.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('vendor/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

	<script type="text/javascript" src="{{ asset('vendor/timepicker/timepicker.min.js') }}"></script>
   	<script type="text/javascript" src="{{ asset('vendor/highcharts/highcharts.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('rsmm.js') }}"></script>

	

</body>
</html>
