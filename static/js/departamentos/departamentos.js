$(document).ready(function(){
	cargar_acciones(id_usuario);
    cargar_usuario(id_usuario);
    cargar_departamentos(id_usuario);
	accesos(id_usuario);
});

function asignar_departamento(id_departamento,id_usuario,id){
	if($('#'+id_departamento).is(':checked')){
		var status = 1;
	}else{
		var status = 0;
	}
    $.ajax({
        'url' : base_url + 'departamentos/asignar_departamento',
        'type' : 'post',
        'data' : {
            'id_departamento' : id_departamento,
            'id_usuario' : id_usuario,
			'status' : status,
			'id' : id
        },
        'datatype' : 'json',
        'success' : function(obj){
            console.log(obj['resultado']);
			if(obj['resultado'] == true){
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
					  toast.addEventListener('mouseenter', Swal.stopTimer)
					  toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				  })
				  
				  Toast.fire({
					icon: 'success',
					title: 'Se ha modificado el departamento'
				  })
			}
        }
    });
}

function cargar_usuario(id_usuario){
    $.ajax({
        'url' : base_url + 'usuarios/cargar_usuario',
        'type' : 'post',
        'data' : {'id_usuario' : id_usuario},
        'datatype' : 'json',
        'success' : function(obj){
            $('#nombre-usuario').text(obj.datos_usuario.nombre);
            $('#correo-usuario').text(obj.datos_usuario.correo);
            $('#telefono-usuario').text(obj.datos_usuario.telefono);
            $('#fecha-usuario').text(obj.datos_usuario.fecha_registro);
        }
    })
    
}

function cargar_departamentos(id_usuario){
    var content = "";
    $('#departamentos').html();
    $.ajax({
        'url' : base_url + 'departamentos/traer_departamentos',
		'type' : 'post',
		'data' : {'id_usuario':id_usuario},
        'datatype' : 'json',
        'success' : function(obj){
            $.each(obj, function(i,elemento){
				if(elemento.status == 1){
					var status = "checked";
				}else{
					var status = "";
				}

                content += '<div class="col-xl-3 col-sm-6 py-2">'+
                '<div class="card bg-light h-100">'+
                    '<div class="card-body">'+
                        '<div class="rotate">'+
                            elemento.icono+
                       '</div>'+
                        '<h6 class="text-uppercase">'+elemento.nombre+'</h6>'+
                        '<div class="form-row">'+
                            '<div class="col-8">'+elemento.texto+'</div>'+
                            '<div class="col-4">'+
                               ' <div class="form-row">'+
                                    '<div class="col-6">'+
                                        '<a href=""><h5><i class="fa fa-cog" aria-hidden="true"></i></h5></a>'+
                                    '</div>'+
                                    '<div class="col-6">'+
                                        '<div class="custom-control custom-switch" style="margin-top: 3%;">'+
                                            '<input type="checkbox" class="custom-control-input" onchange="asignar_departamento('+elemento.id_departamento+','+id_usuario+','+elemento.id+')" id="'+elemento.id_departamento+'" '+status+'>'+
                                            '<label class="custom-control-label" for="'+elemento.id_departamento+'" style="font-size: 200px;"></label>'+
                                        '</div>'+
                                   ' </div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
            });
           $('#departamentos').html(content);
        }
    })
}

function cargar_acciones(id_usuario){
	var content = "";
	$.ajax({
		'url' : base_url + 'departamentos/traer_acciones',
		'type' : 'post',
		'data' : {'id_usuario':id_usuario},
		'datatype' : 'json',
		'success' : function(obj){
			$.each(obj,function(i,elemento){
				content += '<tr>'+
					'<td><span style="font-size: 16px;">'+elemento.accion+'</span></td>'+
					'<td><span style="font-size: 15px;">'+elemento.fecha_accion+'</span></td>'+
				'</tr>';
			});
			$('#tabla-acciones').append(content);
		}
	})
}

function accesos(id_usuario){
	var content = "";
	$('#switch-acceso').html('');
	$.ajax({
		'url' : base_url + 'usuarios/cargar_accesos',
		'type' : 'post',
		'data' : {'id_usuario' : id_usuario},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj[0].link_dashboard == 1){
				content += "<div class='col-sm-4 col-12'><div class='custom-control custom-switch'>"+
				"<input type='checkbox' onchange='status_acceso("+id_usuario+",`link_dashboard`)' class='custom-control-input' id='link_dashboard' checked>"+
				'<label class="custom-control-label" for="link_dashboard">link_dashboard</label></div></div>';
			}else{
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_dashboard`)" class="custom-control-input" id="link_dashboard">'+
				'<label class="custom-control-label" for="link_dashboard">link_dashboard</label></div></div>';
			}

			if(obj[0].link_usuarios == 1){
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_usuarios`)" class="custom-control-input" id="link_usuarios" checked>'+
				'<label class="custom-control-label" for="link_usuarios">link_usuarios</label></div></div>';
			}else{
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_usuarios`)" class="custom-control-input" id="link_usuarios">'+
				'<label class="custom-control-label" for="link_usuarios">link_usuarios</label></div></div>';
			}

			if(obj[0].link_proveedores == 1){
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_proveedores`)" class="custom-control-input" id="link_proveedores" checked>'+
				'<label class="custom-control-label" for="link_proveedores">link_proveedores</label></div></div>';
			}else{
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_proveedores`)" class="custom-control-input" id="link_proveedores">'+
				'<label class="custom-control-label" for="link_proveedores">link_proveedores</label></div></div>';
			}

			if(obj[0].link_gastos == 1){
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_gastos`)" class="custom-control-input" id="link_gastos" checked>'+
				'<label class="custom-control-label" for="link_gastos">link_gastos</label></div></div>';
			}else{
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_gastos`)" class="custom-control-input" id="link_gastos">'+
				'<label class="custom-control-label" for="link_gastos">link_gastos</label></div></div>';
			}

			if(obj[0].link_ingresos == 1){
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_ingresos`)" class="custom-control-input" id="link_ingresos" checked>'+
				'<label class="custom-control-label" for="link_ingresos">link_ingresos</label></div></div>';
			}else{
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_ingresos`)" class="custom-control-input" id="link_ingresos">'+
				'<label class="custom-control-label" for="link_ingresos">link_ingresos</label></div></div>';
			}

			if(obj[0].link_cuentas == 1){
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_cuentas`)" class="custom-control-input" id="link_cuentas" checked>'+
				'<label class="custom-control-label" for="link_gastos">link_cuentas</label></div></div>';
			}else{
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_cuentas`)" class="custom-control-input" id="link_cuentas">'+
				'<label class="custom-control-label" for="link_cuenta">link_cuentas</label></div></div>';
			}

			if(obj[0].link_configuracion == 1){
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_configuracion`)" class="custom-control-input" id="link_configuracion" checked>'+
				'<label class="custom-control-label" for="link_configuracion">link_configuracion</label></div></div>';
			}else{
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_configuracion`)" class="custom-control-input" id="link_configuracion">'+
				'<label class="custom-control-label" for="link_configuracion">link_configuracion</label></div></div>';
			}

			if(obj[0].link_clientes == 1){
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_clientes`)" class="custom-control-input" id="link_clientes" checked>'+
				'<label class="custom-control-label" for="link_clientes">link_clientes</label></div></div>';
			}else{
				content += '<div class="col-sm-4 col-12"><div class="custom-control custom-switch">'+
				'<input type="checkbox" onchange="status_acceso('+id_usuario+',`link_clientes`)" class="custom-control-input" id="link_clientes">'+
				'<label class="custom-control-label" for="link_clientes">link_clientes</label></div></div>';
			}
			$('#switch-acceso').html(content);
		}
	});
}

function status_acceso(id_usuario,acceso){
	if($('#'+acceso).is(':checked')){
		var link = 1;
	}else{
		var link = 0;
	}
	$.ajax({
		'url' : base_url + 'usuarios/agregar_acceso',
		'type' : 'post',
		'data' : {
			'id_usuario' : id_usuario,
			'acceso' : acceso,
			'link' : link
		},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj.resultado == true){
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
					  toast.addEventListener('mouseenter', Swal.stopTimer)
					  toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				  })
				  
				  Toast.fire({
					icon: 'success',
					title: 'El acceso ' + acceso + ' se ha modificado'
				  })
			}
		}
	})
	//alert(id_usuario + ' ' + id_acceso);
}
