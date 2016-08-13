@extends('app')

@section('content')
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<a href="{{ route('useradd') }}" class="btn btn-success">Tambah</a>
				<div class="panel-heading">Daftar User</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<tr>
							<th>Username</th>
							<th>Email</th>
							<th>Nama</th>
							<th>Role</th>
						</tr>
						
						@foreach($users as $key => $v)
                        <?php $class_active = ($v->isactive==0) ? 'btn-warning':'' ?>
						<tr>
							<td>{{ $v->username }}</td>
							<td>{{ $v->email }}</td>
							<td>{{ $v->name }}</td>
							<td>
								<div class="btn-group">
					                <button data-toggle="dropdown" class="btn {{ $class_active }} btn-icon dropdown-toggle" type="button"><i class="icon-cog4"></i><span class="caret"></span></button>
									<ul class="dropdown-menu icons-right dropdown-menu-right">
										<li><a href="{{ route('useredit', ['id' => $v->id]) }}"><i class="icon-quill2"></i> Ubah</a></li>
										<li data-form="#frm-{{$v->id}}" 
											data-title="Hapus {{ $v->id }}" 
											data-message="Apa anda yakin menghapus {{ $v->username }} ?">
											<a class= "formConfirm" href="#"><i class="fa fa-bell"></i> Hapus</a>
										</li>
										<form action="{{ route('userdelete', array($v->id) ) }}" method="get" style="display:none" id="frm-{{$v->id}}"></form>
                                        <li data-form="#frmaktif-{{$v->id}}" 
											data-title="Aktif {{ $v->id }}" 
											data-message="Apa anda yakin mengaktifkan/menonaktifkan {{ $v->username }} ?">
											<a class= "formConfirm" href="#"><i class="fa fa-bell"></i> Aktif / Non Aktif</a>
										</li>
										<form action="{{ route('useraktifnon', array($v->id) ) }}" method="get" style="display:none" id="frmaktif-{{$v->id}}"></form>					
									</ul>
				                </div>
							</td>
						</tr>
						@endforeach
					</table>
                    
                    *) Kuning = Non AKtif || Abu abu = Aktif
				</div>
			</div>
		</div>
	</div>
@endsection