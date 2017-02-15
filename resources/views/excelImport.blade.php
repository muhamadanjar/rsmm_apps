@extends('layouts.adminlte')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-file-excel-o"></i> Import Kuesioner (XLSX)</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/excel/import') }}" 
                    enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="file" class="col-md-2 control-label">File Excel</label>

                            <div class="col-md-4">
                                <input id="file" type="file"  name="file" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <select name="bagian" class="form-control">
                                    <option value="bagian_satu">Bagian 1</option>
                                    <option value="bagian_dua">Bagian 2</option>
                                    <option value="bagian_tiga">Bagian 3</option>
                                    <option value="bagian_empat">Bagian 4</option>
                                    <option value="full">Semua</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Import XLS
                                </button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
