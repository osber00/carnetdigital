$(document).on('ready',inicio);

function inicio() {
	fnModalEdicionUsuario();
	fnBtnFileLista();
	fnBtnFoto();
}

function fnModalEdicionUsuario() {
	$("#dataEstudiantes").on("click",".edicion",function(e){
		e.preventDefault();
		let enlace = $(this).attr('data-url');
		//console.log(enlace);
		nombre 			= $('#formEdicionUsuario').find('#nombre').val('');
		nombre 			= $('#formEdicionUsuario').find('#nombre').attr({"placeholder":"Espere por favor..."});
		identificacion 	= $('#formEdicionUsuario').find('#identificacion').val('');
		identificacion 	= $('#formEdicionUsuario').find('#identificacion').attr({'placeholder':'Espere por favor...'});
		email 			= $('#formEdicionUsuario').find('#email').val('');
		email 			= $('#formEdicionUsuario').find('#email').attr({'placeholder':'Espere por favor...'});;
		programa_id 	= $('#formEdicionUsuario').find('#programa_id').val('');
		user_id 		= $('#formEdicionUsuario').find('#user_id').val('');
		user_id_foto	= $('#formFoto').find('#user_id_foto').val('');
		botonFoto 		= $('#formFoto').find('#botonFoto');
		let cargando 	= "<i class='fa fa-cog fa-spin'></i> Cargando información, por favor espere...";
		$('#myModalLabel').html(cargando);
		//console.log(enlace);
		$.ajax({
			url: enlace,
			type: 'GET',
			success: function(response){
				//console.log(response.usuario.nombre);
				$('#myModalLabel').html("Modificar información del usuario");
				//console.log(botonFoto+'/'+response.usuario.foto);
				nombre.val(response.usuario.nombre);
				identificacion.val(response.usuario.identificacion);
				email.val(response.usuario.email);
				programa_id.val(response.usuario.programa_id);
				user_id.val(response.usuario.id);
				user_id_foto.val(response.usuario.id);
				botonFoto.attr({'src':'http://carnetdigital.app/fotos/'+response.usuario.foto});
				
				//botonFoto.attr({'src':botonFoto+'/'+response.usuario.foto});
			},
			errors: function(err){
				console.log(err);
			}
		});
	});
}

function fnBtnFileLista() {
	$('#right').on('click','.botonForLista',function(e){
		e.preventDefault();
		$(this).siblings('.fieldFileLista').click();
		//$('#fieldFilelista').click();
	});
}

function fnBtnFoto() {
	$('#forEdicionUsuario').on('click','#botonFoto',function(e){
		e.preventDefault();
		$(this).siblings('.fieldFileLista').click();
		//$('#fieldFilelista').click();
	});
}