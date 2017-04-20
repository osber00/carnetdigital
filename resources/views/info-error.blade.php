<!DOCTYPE HTML>
<html lang="Es">
<head>
	<meta charset="utf-8">
	<title>CECAR Virtual | Carnet Digital</title>
	<link href="{{asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css' />
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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
					<img src="{{asset('images/pirate-error.png')}}">
					<div id="error">¡Error!</div>
					<p style="color: red">No verificado</p>
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
</body>
</html>		