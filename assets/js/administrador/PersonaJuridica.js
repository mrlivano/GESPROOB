$(document).on("ready" ,function()
{
	listarpersonaR();//para mostrar lista de las personas

	$("#form-addPersonaJuridica").submit(function(event)
	{
		event.preventDefault();
		$('#validarPersonaJuridica').data('formValidation').validate();
        if(!($('#validarPersonaJuridica').data('formValidation').isValid()))
        {
            return;
        }
		$.ajax(
		{
			url : base_url+"index.php/Persona_Juridica/AddPersonal",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				resp = JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));
				$('#table-PersonaJuridica').dataTable()._fnAjaxUpdate();
				$('#VentanaRegistraPersonaJuridica').modal('hide');
				formReset();
				
			},
            error: function ()
            {
            	$('#VentanaRegistraPersonaJuridica').modal('hide');
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            }
		});
	});

	//limpiar campos
	function formReset()
	{
		document.getElementById("form-addPersonaJuridica").reset();
		document.getElementById("form-UpdatePersonaJuridica").reset();
	}

	$("#form-UpdatePersonaJuridica").submit(function(event)//para modificar la  division Personal
	{
		event.preventDefault();
		$('#validarEdicionPersonaJuridica').data('formValidation').validate();
        if(!($('#validarEdicionPersonaJuridica').data('formValidation').isValid()))
        {
            return;
        }
		$.ajax(
		{
			url : base_url+"index.php/Persona_Juridica/UpdatePersonal",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				resp = JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));
				$('#table-PersonaJuridica').dataTable()._fnAjaxUpdate();
				formReset();
				$('#VentanaModificarPersonaJuridica').modal('hide');
			},
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                $('#VentanaModificarPersonaJuridica').modal('hide');
            }
		});
	});
});

	/* listar y lista en tabla entidad*/
	var listarpersonaR=function()
	{
		var table=$("#table-PersonaJuridica").DataTable(
		{
			"processing" : true,
			"serverSide" : true,
			"destroy" : true,
      		"language" : idioma_espanol,
			"ajax" :
			{
				"url" : base_url+"index.php/Persona_Juridica/GetPersonal",
				"method" : "POST",
				"dataSrc" : "data"
			},
			"columns" : [
				{"data" : "id_persona_juridica" ,"visible": false},
				{ "data" : "ruc" },
				{ "data" : "razon_social" },
				{ "data" : "representante_legal" },
				{ "data" : "direccion" },
				{ "data" : "telefono" },
				{ "data" : "correo" },
				{ "defaultContent" : "<button type='button'  class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarPersonaJuridica'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>" }]
		});

		$('#table-PersonaJuridica_filter input').unbind();

		$('#table-PersonaJuridica_filter input').bind('keyup', function(e)
		{
			if(e.keyCode==13)
			{
				table.search(this.value).draw();
			}
		});

		personalDataR("#table-PersonaJuridica", table);  //obtener data de la division Personal para agregar  AGREGAR
		EliminarPersonalR("#table-PersonaJuridica", table);
	}

	var  personalDataR=function(tbody,table)
	{
		$(tbody).on("click", "button.editar", function()
		{
			var data=table.row( $(this).parents("tr")).data();
			var txt_idpersonamR=$('#txt_idpersonamR').val(data.id_persona_juridica);
			var txt_razon_socialm=$('#txt_razon_socialm').val(data.razon_social);
			var txt_representante_legalm=$('#txt_representante_legalm').val(data.representante_legal);
			var txt_rucm=$('#txt_rucm').val(data.ruc);
			var txt_direccionRm=$('#txt_direccionRm').val(data.direccion);
			var txt_telefonoRm=$('#txt_telefonoRm').val(data.telefono);
			var txt_correoRm=$('#txt_correoRm').val(data.correo);

		});

	}
	
var EliminarPersonalR=function(tbody,table)
{
 	$(tbody).on("click","button.eliminar",function()
 	{
        var data=table.row( $(this).parents("tr")).data();
        var id_persona_juridica=data.id_persona_juridica;
        swal({
            title: "Desea eliminar el Registro ?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"Cerrar" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,Eliminar",
            closeOnConfirm: false
          },
        function()
        {
            $.ajax({
                url:base_url+"index.php/Persona_Juridica/EliminarPersonal",
                type:"POST",
                data:{id_persona_juridica:id_persona_juridica},
                success:function(respuesta)
                {
                   	var registros=jQuery.parseJSON(respuesta);
                   	if(registros.flag==0)
                   	{
                    	swal("Eliminado.",registros.msg, "success");
                    	$('#table-PersonaJuridica').dataTable()._fnAjaxUpdate();
                   	}
                   	else
                   	{
                    	swal("Error.",registros.msg, "error");
                    	$('#table-PersonaJuridica').dataTable()._fnAjaxUpdate();
                   	}
                },
	            error: function ()
	            {
	                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
	            }
            });
        });
    });
}

   /*listra Persona*/
	 var listaPersonaJCombo=function(valor)//COMO CON LAS PersonaES PARA AGREGAR DIVIVISION Personal
	 {
			 var html="";
			 $("#listaPersonaC").html(html);
			 event.preventDefault();
			 $.ajax({
					 "url":base_url +"index.php/Personal/GetPersona",
					 type:"POST",
					 success:function(respuesta){
							// alert(respuesta);
						var registros = eval(respuesta);
							 for (var i = 0; i <registros.length;i++) {
								 html +="<option value="+registros[i]["id_Persona"]+"> "+ registros[i]["codigo_Persona"]+": "+registros[i]["nombre_Persona"]+" </option>";
							 };
							 $("#listaPersonaC").html(html);//para modificar las entidades
							 $("#listaPersonaCM").html(html);//para modificar las entidades
							 $('select[name=listaPersonaCM]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
							 $('select[name=listaPersonaCM]').change();
							 $('.selectpicker').selectpicker('refresh');
					 }
			 });
	 }
	 /*fin listar Persona*/

var idioma_espanol=
{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
