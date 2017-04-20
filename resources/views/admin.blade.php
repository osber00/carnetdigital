@extends ('base')
@section('seccion')
<h1>
Inicio
	<small>Control panel</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
</ol>
@endsection
@section('estadisticas')@endsection

@section('left')
<div class="box box-primary">
	<div class="box-header with-border">
	<h3 class="box-title">Registros de usuarios</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	@if(Session::has('exito'))
		<div class="alert bg-aqua alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check-square"></i> Hecho!</h4>
			La información se guardó correctamente
		</div>
	@endif
	@if(Session::has('no-file'))
		<div class="alert bg-red alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Ups algo salió mal!</h4>
			No se encontró archivo
		</div>
	@endif
	@if(Session::has('no-formato'))
		<div class="alert bg-red alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Ups algo salió mal!</h4>
			Este formato no se puede procesar
		</div>
	@endif
	@include('partials.errores')
		<table id="dataEstudiantes" class="table table-bordered table-striped">
			<thead>
				<tr>
				  <th>Nombre</th>
				  <th>Identificación</th>
				  <th>Programa</th>
				  <th>Correo</th>
				  <th>Editar</th>
				  <th>Carnet</th>
				</tr>
			</thead>
			<tbody>
				@foreach($usuarios as $usuario)
				<tr id="{{$usuario->id}}">
					<td>{{$usuario->nombre}}</td>
					<td>{{$usuario->identificacion}}</td>
					<td>{{str_limit($usuario->programa->programa,15)}}</td>
					<td>{{str_limit($usuario->email,10)}}</td>
					<td class="text-center"><button type="button" class="btn btn-flat bg-light-blue-gradient edicion" data-url="{{action('CarnetController@getUsuarioEdicion',[$usuario->id])}}" data-toggle="modal" data-target="#forEdicionUsuario"> <i class="fa fa-cog"></i> Editar</button></td>
					<td class="text-center"><a href="{{action('CarnetController@getCarnet',[$usuario->id])}}" class="btn btn-flat bg-teal" target="blank"><i class="fa fa-user"></i> Carnet</a></td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>Nombre</th>
					<th>Identificación</th>
					<th>Programa</th>
					<th>Correo</th>
					<th>Editar</th>
					<th>Carnet</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="box-footer text-center">
    	
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="forEdicionUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-primary" id="myModalLabel">Modificar información del usuario</h4>
      </div>
      <div class="modal-body bg-light-blue-gradient">
        <form action="{{action('CarnetController@postUsuarioEdicion')}}" method="POST" id="formEdicionUsuario">
        	{{csrf_field()}}
        	<input type="hidden" name="user_id" id="user_id" value="">
        	<div class="form-group">
		        <label for="nombre">Nombre</label>
		        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Esperando..." autocomplete="off" required>
	        </div>
	        <div class="form-group">
		        <label for="identificacion">identificacion</label>
		        <input type="text" name="identificacion" class="form-control" id="identificacion" placeholder="Esperando..." autocomplete="off" required>
	        </div>
	        <div class="form-group">
		        <label for="email">Email</label>
		        <input type="text" name="email" class="form-control" id="email" placeholder="Esperando..." autocomplete="off" required>
	        </div>
	        <div class="form-group">
	         <label for="mesa_id">Seleccione programa</label>
		        <select class="form-control" name="programa_id" id="programa_id" required>
		        	@foreach($programas as $programa)
		        	<option value="{{$programa->id}}">{{$programa->programa}}</option>
		        	@endforeach
		        </select>
	        </div>
	        <div class="form-group">
        		<input type="submit" class="btn bg-light-blue-gradient btn-block btn-flat" value="Guardar Información">
	        </div>
        	</form>
      </div>
      <div class="modal-footer">
      		<form action="{{action('CarnetController@postFoto')}}" method="POST" enctype="multipart/form-data" id="formFoto">
      			{{csrf_field()}}
      			<input type="hidden" name="user_id_foto" id="user_id_foto" value="" />
      			<h4 class="modal-title text-primary">Modificar foto (Click sobre imagen)</h4>
      			<div class="form-group">
      				<input type="file" name="foto" id="foto" class="fieldFileLista"/>
      				<img src="" id="botonFoto" >
      			</div>
	        	<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancelar</button>
      			<input type="submit" class="btn bg-light-blue-gradient btn-flat" value="Guardar">	
      		</form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('right')
<style type="text/css">
    .fieldFileLista{
    position: absolute;
    visibility: hidden;
    width: 0;
    z-index: -9999;
	}
	.botonForLista{
		border: dashed 2px #fff;
		font-size: 1.2em;
	}
	.procesar{
		font-size: 1.2em;
	}
	.form-masivo{
		margin-bottom: 2em;
	}

</style>
<div class="box box-solid bg-light-blue-gradient">
	<div class="box-header">
		<div class="pull-right box-tools">
			<button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
		</div>
		<i class="fa fa-user-plus"></i>
		<h3 class="box-title">
			Registro de estudiantes
		</h3>
	</div>
	<div class="box-body">
		<form action="{{action('CarnetController@postUsuario')}}" method="POST">
			{{csrf_field()}}
			<div class="form-group">
				<label for="nombre">Nombre Completo</label>
				<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre Completo" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="identificacion">Número de Identificación</label>
				<input type="text" name="identificacion" id="identificacion" class="form-control" placeholder="Identificación" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="programa">Programa</label>
				<select name="programa_id" id="programa" class="form-control">
					@foreach($programas as $programa)
					<option value="{{$programa->id}}">{{$programa->programa}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="email">Correo Electrónico</label>
				<input type="text" name="email" id="email" class="form-control" placeholder="Correo electrónico" autocomplete="off" />
			</div>
	</div>
	<div class="box-footer no-border">
		<div class="row">
			<div class="col-xs-12">
				<input type="submit" value="Guardar Registro" class="btn pull-right bg-light-blue-gradient" />
			</div>
		</form>
		</div>
	</div>
</div>

<div class="box box-solid bg-teal-gradient">
	<div class="box-header">
		<i class="fa fa-th"></i>
		<h3 class="box-title">Registro Masivo a programas | <a href="{{asset('formato/usuarios-carnet-digital.xlsx')}}"><i class="fa fa-cloud-download"></i> Formato</a></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body border-radius-none">
		@foreach($programas as $programa)
		<form action="{{action('CarnetController@postUsuariosMasivos')}}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="programa_id" value="{{$programa->id}}" />
			<div class="form-group form-masivo">
				<button class="btn bg-teal btn-sm btn-lg btn-flat col-md-6 botonForLista"><i class="fa fa-cloud-upload"></i> {{str_limit($programa->programa,7)}}</button>
				<input type="file" name="lista"  class="fieldFileLista" />
				<input type="submit" class="btn bg-light-blue-gradient btn-sm btn-lg btn-flat col-md-6 procesar" value="Procesar lista"/>
			</div>
		</form>
		<br/>
		@endforeach
	</div>
	<div class="box-footer no-border">
		<div class="row">
			<div class="col-xs-12">
				
			</div>
		</div>
	</div>
</div>
@endsection