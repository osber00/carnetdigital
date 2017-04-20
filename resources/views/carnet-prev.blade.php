<!DOCTYPE html>
<html>
<head>
	<title>Carnet Estudiantil (Virtualidad)</title>
	<link rel="stylesheet" type="text/css" href="{{asset('dist/css/carnet.css')}}">

</head>
<body>
	<div class="content">
		<h3>Carnet Estudiantil (Virtualidad)</h3>
		<div class="anverso">
			<div class="logo">
		    	<img src="{{asset('images/logocecar.png')}}">
			</div>
			<div class="nombre">
				{{$user->nombre}}
			</div>
			<div class="franja">
				<h2>Estudiante</h2>
				<div class="programa">{{$user->programa->programa}}</div>
			</div>
			<div class="foto">
				<img src="{{asset('fotos')}}/{{$user->foto}}" class="foto-user">
			</div>
			<div class="facultad">
				{{$user->programa->facultad->facultad}}
			</div>
			<div class="codeqr">
				<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(80)->generate( url('/qr',[$user->id]) ) ) }} ">
			</div>
			<img src="{{asset('images/franja.png')}}" class="cromatica">
		</div>
		<div class="reverso">
			<div class="texto">
				Este carnet es personal e intransferible, para efectos de identificación interna institucional de la Corporación Universitaria del Caribe - CECAR.
				En caso de pérdida se debe presentar copia de la denuncia a la oficina de Admisiones, Registro y Control Académico
			</div>
			<div class="firma">
				<img src="{{asset('images/firma.png')}}" class="img-firma">
				<span class="txt-firma">Maria Romero de Albis</span>
				
				<span class="txt-autoridad">DIRECTORA CENTRO DE ADMISIONES, REGISTRO Y CONTROL ACADÉMICO</span>
			</div>
			<div class="estudiante">
				{{$user->nombre}} - {{$user->identificacion}}
			</div>
			<img src="{{asset('images/franja.png')}}" class="cromatica">
		</div>
	</div>
</body>
</html>