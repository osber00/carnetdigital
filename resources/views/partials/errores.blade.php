@if(count($errors) > 0)
    @foreach($errors->all() as $error)
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Ups algo salió mal!</h4>
			{{$error}}
		</div>
    @endforeach
@endif