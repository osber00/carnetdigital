<!DOCTYPE HTML>
<html lang="Es">
<head>
	<meta charset="utf-8">
	<title>CECAR Virtual | Carnet Digital</title>
	<link href="{{asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<!-- Custom Theme files -->
	<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
	<!-- Custom Theme files -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!--webfont-->
	<link href='http://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="{{asset('js/move-top.js')}}"></script>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script>
</head>
<body>
	<div class="" id="logo">
		<div class="header-top">	
			<div class="container">
				<a href="index.html"><img src="{{asset('images/logo.png')}}" alt=""/></a>
			</div>	
		</div>	
	</div>    
	<div class="main">
		<div class="" id="services">
			<div class="container">
				<div class="service_top" id="service_top">
					<h3>CERTIFICA QUE:</h3>
					<img src="{{asset('fotos')}}/{{$user->foto}}" id="foto">
					<p><strong class="mayus">{{$user->nombre}}</strong>, con número de identificación <strong>{{$user->identificacion}}</strong> está matriculado en el programa de <strong class="mayus">{{$user->programa->programa}}</strong> adscrito a la {{$user->programa->facultad->facultad}}  </p>
					<p style="font-size: 0.7em;color: red">Si estos datos no coinciden el documento físico, puede ser considerado como suplantación</p>
					<span id="vig">VIGILADA MINEDUCACIÓN</span>
					<img src="{{asset('images/cecar-certificate2.png')}}" >
				</div>
			</div>
		</div>
	</div>
	<div  id="contact">
		<div class="copy">
			<div class="container">
				<p style="color: # fff">&copy;{{date('Y')}} | <a href="http://cecarvirtual.edu.co" target="blank"> CECAR Virtual</a></p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var isMobile = {
		    Android: function() {
		        return navigator.userAgent.match(/Android/i);
		    },
		    BlackBerry: function() {
		        return navigator.userAgent.match(/BlackBerry/i);
		    },
		    iOS: function() {
		        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		    },
		    Opera: function() {
		        return navigator.userAgent.match(/Opera Mini/i);
		    },
		    Windows: function() {
		        return navigator.userAgent.match(/IEMobile/i);
		    },
		    any: function() {
		        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		    }
		};

		if(isMobile.any() ) alert('From Mobile');
	</script>	
</body>
</html>		