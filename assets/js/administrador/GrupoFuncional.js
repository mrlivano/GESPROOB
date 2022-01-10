$(document).on("ready" ,function()
{
    lista();
    $("#btn_nuevoGrupoFuncional").click(function()
    {
        listarDivisionFcombo();
    });
    $("#SelecDivisionFF").change(function()
    {
        listarSectorcombo();
    });
    listarGrupoF();
	$("#form-AddGrupoFuncional").submit(function(event)
	{
		event.preventDefault();
        $('#agregarGrupoFuncional').data('formValidation').validate();
        if(!($('#agregarGrupoFuncional').data('formValidation').isValid()))
        {
            return;
        }
		$.ajax(
		{
			url : base_url+"index.php/GrupoFuncional/AddGrupoFuncional",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
                if (resp == "1")
                {
                    swal("","Codigo Grupo Funcional Duplicado", "error");
                }
                if (resp == "0") 
                {
                    swal("","Añadido Correctamente!", "success");
          
                }
                $('#table-listarGrupoFuncional').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                $('#VentanaRegistraGrupoF').modal('hide');
			},
            error:function()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#VentanaRegistraGrupoF').modal('hide');
            }
		});
	});

	$("#form-UpadataGrupoFuncional").submit(function(event)//Actualizar funcion
	{
		event.preventDefault();

        $('#editarGrupoFuncional').data('formValidation').validate();
        if(!($('#editarGrupoFuncional').data('formValidation').isValid()))
        {
            return;
        }

		$.ajax(
		{
			url : base_url+"index.php/GrupoFuncional/UpdateGrupoFuncional",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal("",resp, "success");

				$('#table-listarGrupoFuncional').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

				$('#VentanaUpdateGrupoF').modal('hide');
			},
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#VentanaUpdateGrupoF').modal('hide');
            }
		});
	});
    

			});
			   /*listra funcion*/

                var listaFuncionCombo=function(valor)//COMO CON LAS FUNCIONES PARA AGREGAR DIVIVISION FUNCIONAL
                {
                    html="";
                    $("#listaFuncionC").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/Funcion/GetFuncion",
                        type:"POST",
                        success:function(respuesta){
                           // alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_funcion"]+"> "+ registros[i]["codigo_funcion"]+": "+registros[i]["nombre_funcion"]+" </option>";
                            };
                            $("#listaFuncionC").html(html);//para modificar las entidades

                            $("#listaFuncionCM").html(html);//para modificar las entidades
                            $('select[name=listaFuncionCM]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=listaFuncionCM]').change();

                            $('.selectpicker').selectpicker('refresh');
                            //listaFuncionCombo(); //PARA LLENAR CON EXACTITUD LOS DATOS
                        }
                    });
                }
                /*fin listar funcion*/
	var listarDivisionFcombo=function(valor_idDivision, valor_id_sector)
	{
		event.preventDefault();

		var htmlTemp="";

		$("#SelecDivisionFF").html(htmlTemp);

		$.ajax(
		{
			"url" : base_url+"index.php/DivisionFuncional/GetDivisionFuncional",
			"type" : "POST",
			"success" : function(respuesta)
			{
				var registros=eval(respuesta);

				for (var i=0; i<registros.length; i++)
				{
					htmlTemp+="<option value="+registros[i]["id_div_funcional"]+"> "+ registros[i]["codigo_div_funcional"]+" : "+registros[i]["nombre_div_funcional"]+" </option>";
				}

				$("#SelecDivisionFF").html(htmlTemp);
				$("#SelecDivisionFFF").html(htmlTemp);
				$('select[name=SelecDivisionFFF]').val(valor_idDivision);//PARA AGREGAR UN COMBO PSELECIONADO
				$('select[name=SelecDivisionFFF]').change();

				$('.selectpicker').selectpicker('refresh');

				listarSectorcombo(valor_id_sector);
			}
		});
	}

	var listarSectorcombo=function(varlor)
	{
		event.preventDefault();

		var htmlTemp="";

		$("#SelecSector").html(htmlTemp);

		$.ajax(
		{
			"url" : base_url +"index.php/Sector/GetSector",
			"type" : "POST",
			"success" : function(respuesta)
			{
				var registros=eval(respuesta);

				for(var i=0; i<registros.length; i++)
				{
					htmlTemp+="<option value="+registros[i]["id_sector"]+">"+registros[i]["nombre_sector"]+"</option>";
				}

				$("#SelecSector").html(htmlTemp);
				$("#SelecSectorF").html(htmlTemp);
				$('select[name=SelecSectorF]').val(varlor);//PARA AGREGAR UN COMBO PSELECIONADO
				$('select[name=SelecSectorF]').change();

				$('.selectpicker').selectpicker('refresh');
			}
		});
	}

                /*fin crea tabla division funcional*/
	/*crear tabla dinamica servicio publico asociado */
	var listarGrupoF=function()
	{
		var table=$("#table-listarGrupoFuncional").DataTable(
		{
			"processing" : true,
			"serverSide" : false,
			"order": [[1,'asc']],
			"destroy" : true,
			"language" : idioma_espanol,
			"ajax" :
			{
				"url" :  base_url+"index.php/GrupoFuncional/GetGrupoFuncional",
				"method" : "POST",
				"dataSrc" : ""
			},
			"columns" : [
			{ "data" : "id_grup_funcional","visible" : false },
			{ "data" : "codigo_grup_funcional" },
			{ "data" : "nombre_grup_funcional" },
			{ "data" : "id_div_funcional" },
			{ "data" : "codigo_div_funcional" },
			{ "data" : "nombre_div_funcional" },
			{ "data" : "id_sector" },
			{ "data" : "nombre_sector" },
			{ "defaultContent" : "<button type='button'  class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaUpdateGrupoF'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>" }]
		});

		GrupoFuncionalData("#table-listarGrupoFuncional", table);  //obtener data de la division funcional para agregar  AGREGAR
		EliminarGruFuncional("#table-listarGrupoFuncional", table);
	}

var GrupoFuncionalData=function(tbody,table)
{
	$(tbody).on("click", "button.editar", function()
	{
		var data=table.row($(this).parents("tr")).data();
		var id_division_funcional=data.id_div_funcional;
		var id_sector=data.id_sector;
		var txt_idGfuncionF=$('#txt_idGfuncionF').val(data.id_grup_funcional);
		var txt_codigoGfuncionF=$('#txt_codigoGfuncionF').val(data.codigo_grup_funcional);
		var txt_nombreGfuncionF=$('#txt_nombreGfuncionF').val(data.nombre_grup_funcional);

		listarDivisionFcombo(id_division_funcional, id_sector);//para agregar division  funcional

		$('select[name=SelecSectorF]').val(id_sector);//PARA AGREGAR UN COMBO PSELECIONADO
		$('select[name=SelecSectorF]').change();
	});
}
                var EliminarGruFuncional=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_grup_funcional=data.id_grup_funcional;
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
                              function(){
                                    $.ajax({
                                          url:base_url+"index.php/GrupoFuncional/EliminarGFuncional",
                                          type:"POST",
                                          data:{id_grup_funcional:id_grup_funcional},
                                          success:function(resp)
                                            {
                                                resp = JSON.parse(resp);
                                                swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto'?'success':'error'));
                                                 $('#table-listarGrupoFuncional').dataTable()._fnAjaxUpdate();
                                            },
                                            error: function ()
                                            {
                                                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                                            }

                                        });
                              });
                    });
                }

        /*Idioma de datatablet table-sector */
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

 $(function() {
     $('#agregarGrupoFuncional').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
             txt_codigoGfuncion: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Código" es requerido.</b>'
                     },
                     stringLength: {
                         max: 4,
                         message: '<b style="color: red;">El campo "Código" debe tener como máximo 04 caracteres.</b>'
                     },
                     regexp: {
                          regexp: /^[0-9]+$/,
                         message: '<b style="color: red;">El campo "Código" debe contener solamente números.</b>'
                     }
                 }
             },
        txt_nombreGfuncion: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                     },
                     stringLength: {
                         max: 199,
                         message: '<b style="color: red;">El campo "Nombre" debe tener como máximo 199 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Nombre" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
     $('#editarGrupoFuncional').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
             txt_codigoGfuncionF: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Código" es requerido.</b>'
                     },
                     stringLength: {
                         max: 4,
                         message: '<b style="color: red;">El campo "Código" debe tener como máximo 04 caracteres.</b>'
                     },
                     regexp: {
                          regexp: /^[0-9]+$/,
                         message: '<b style="color: red;">El campo "Código" debe contener solamente números.</b>'
                     }
                 }
             },
        txt_nombreGfuncionF: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                     },
                     stringLength: {
                         max: 199,
                         message: '<b style="color: red;">El campo "Nombre" debe tener como máximo 199 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Nombre" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
 });


        function lista()
					{
						event.preventDefault();
						$.ajax({
              "url": base_url+"index.php/MFuncion/GetGrupoFuncional",
							type:"POST",
							success:function(respuesta){
								/*alert(respuesta);
							*/

							}
						});
					}
