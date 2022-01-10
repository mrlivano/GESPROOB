$(document).on("ready" ,function()
{
	listaModalidadE(); //LLAMAR AL METODO LISTAR MODALIDAD DE EJECUCION

	//AGREGAR UN MODALIDAD DE EJECUCION
	$("#form-addModalidadE").submit(function(event)
	{
		event.preventDefault();
    if($('#validarAddModalidadE').data('formValidation').isValid())
    {
			$.ajax(
			{
				url : base_url+"index.php/ModalidadEjecucion/AddModalidadE",
				type : $(this).attr('method'),
				data : $(this).serialize(),
				success : function(resp)
				{
					swal("REGISTRADO!", resp, "success");

					$('#table-ModalidadE').dataTable()._fnAjaxUpdate();    //SIRVE PARA REFRESCAR LA TABLA

					$('#VentanaRegistraModalidadEjecucion').modal('hide');
				},
        error: function ()
        {
            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            $('#VentanaRegistraModalidadEjecucion').modal('hide');
        }
			});
    }
	});
	//FIN DE AGREGAR UNA MODALIDAD DE EJECUCION
});

//-------------- MANTENIMIENTO MODALIDAD DE EJECUCION--------------------------

/*LISTAR LAS MODALIDADES DE EJECUCION EN UN DATATABLE*/
                var listaModalidadE=function()
                {
                    var table=$("#table-ModalidadE").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url +"index.php/ModalidadEjecucion/GetModalidadE",
                                    "method":"POST",
                                                                 "dataSrc":""
       },
       //para llenado y busqueda por todo los campos
                                "columns":[
                                    {"data":"id_modalidad_ejec","visible" : false},
                                    {"data":"nombre_modalidad_ejec"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarModalidadE'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
            ModalidadEData("#table-ModalidadE",table); //TRAER DATOS PARA ACTUALIZAR
			EliminarModalidad("#table-ModalidadE",table);

                }
/*FIN DE LISTAR MODALIDAD EJECUCION EN UN DATATABLE*/

//ACTUALIZAR MODALIDAD DE EJECUCION
$("#form-ActualizarModalidadE").submit(function(event)
{
	event.preventDefault();
	if($('#validarActualizarModalidadE').data('formValidation').isValid())
	{
		$.ajax(
		{
			url : base_url+"index.php/ModalidadEjecucion/UpdateModalidadE",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal("MODIFICADO!", resp, "success");

				$('#table-ModalidadE').dataTable()._fnAjaxUpdate();

				$('#VentanaModificarModalidadE').modal('hide');
			},
      error: function ()
      {
          swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
          $('#VentanaModificarModalidadE').modal('hide');
      }
		});
	}
});
//FIN ACTUALIZAR MODALIDAD DE EJECUCION

          // CAMPOS QUE SE ACTUALIZARAN DE LA MODALIDAD DE EJECUCION
        ModalidadEData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_brecha=$('#txt_IdModalidadEModif').val(data.id_modalidad_ejec);
                        var nombre_brecha=$('#txt_NombreModalidadEU').val(data.nombre_modalidad_ejec);
                    });
                }
				
				
				
				
				
		var EliminarModalidad=function(tbody,myTable){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        var id_modalidad_ejecn=data.id_modalidad_ejec;
                        console.log(data);
                         swal({
                                title: "Desea eliminar ?",
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
                                          url:base_url+"index.php/ModalidadEjecucion/Eliminar",
                                          type:"POST",
                                          data:{id_codigo:id_modalidad_ejecn},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Se elimino corectamente.", "", "success");
                                            $('#table-ModalidadE').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                                          },
                                          error: function ()
                                          {
                                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                                          }
                                          
                                        });
                              });
                    });
                }

				
          // FIN DE CAMPOS QUE SE ACTUALIZARAN DE LA MODALIDAD EJECUCION
//-------------- FIN MANTENIMIENTO MODALIDAD DE EJECUCION----------------------
