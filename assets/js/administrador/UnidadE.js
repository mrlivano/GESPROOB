$(document).on("ready" ,function()
{
	listaUnidadE();//LLAMAR AL METODO LISTAR UNIDAD EJECUTORA

	//AGREGAR UNA UNIDAD EJECUTORA
	$("#form-addUnidadE").submit(function(event)
	{
		event.preventDefault();
		if(!$('#validarAddUnidadE').data('formValidation').isValid())
      { return;
      }
      else
      {
		$.ajax(
		{
			url : base_url+"index.php/UnidadE/AddUnidadE",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal("REGISTRADO!", resp, "success");

				$('#table-UnidadE').dataTable()._fnAjaxUpdate();

				$('#VentanaRegistraUnidadEjecutora').modal('hide');
			},
      error: function ()
      {
          swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
          $('#VentanaRegistraUnidadEjecutora').modal('hide');
      }
		});
	}
	});
	//FIN DE AGREGAR UNA UNIDAD EJECUTORA
});

//-------------- MANTENIMIENTO UNIDAD EJECUTORA----------------------
/*LISTAR UNIDAD DE EJECUCION EN UN DATATABLE*/
                var listaUnidadE=function()
                {
                    var table=$("#table-UnidadE").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url +"index.php/UnidadE/GetUnidadE",
                                    "method":"POST",
                                     "dataSrc":""
                               },
       //para llenado y busqueda por todo los campos
                                "columns":[
                                    {"data":"id_ue", "visible" : false},
																		{"data":"codigo_ue"},
                                    {"data":"nombre_ue"},
                                    {"data":"direccion", "visible" : false},
                                    {"data":"distrito", "visible" : false},
                                    {"data":"provincia", "visible" : false},
                                    {"data":"region", "visible" : false},
                                    {"data":"telefono", "visible" : false},
                                    {"data":"RUC", "visible" : false},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarUnidadE'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                    UnidadEData("#table-UnidadE",table);//TRAER LA DATA DE UA UNIDAD EJECUTORA PARA ACTUALIZARLA
						Eliminarunidad("#table-UnidadE",table);
                }
/*FIN DE LISTAR UNIDAD DE EJECUCION EN UN DATATABLE*/

//ACTUALIZAR UNA UNIDAD EJECUTORA
$("#form-ActualizarUnidadE").submit(function(event)
{
  console.log($('#validarActualizarUnidadE').data('formValidation').isValid())
	event.preventDefault();
	if(true) {
   
		$.ajax(
		{
			url : base_url+"index.php/UnidadE/UpdateUnidadE",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal("MODIFICADO!", resp, "success");

				$('#table-UnidadE').dataTable()._fnAjaxUpdate();

				$("#VentanaModificarUnidadE").modal("hide");
			},
      error: function ()
      {
          swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
          $("#VentanaModificarUnidadE").modal("hide");
      }
		});
	}
});
//FIN ACTUALIZAR UNIDAD EJECUTORA

    // CAMPOS QUE SE ACTUALIZARAN DE LA UNIDAD EJECUTORA
        UnidadEData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_ue=$('#txt_IdUnidadEModif').val(data.id_ue);
												var codigo_ue =$('#txtCodigoUE_M').val(data.codigo_ue);
                        var nombre_ue=$('#txt_NombreUnidadEU').val(data.nombre_ue);
                        var direccion=$('#txtDireccion').val(data.direccion);
                        var distrito=$('#txtDistrito').val(data.distrito);
                        var provincia=$('#txtProvincia').val(data.provincia);
                        var region=$('#txtRegion').val(data.region);
                        var telefono=$('#txtTelefono').val(data.telefono);
                        var RUC=$('#txtRUC').val(data.RUC);
                    });
                }



		var Eliminarunidad=function(tbody,myTable){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        var id_modalidad_ejecn=data.id_ue;
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
                                          url:base_url+"index.php/UnidadE/Eliminar",
                                          type:"POST",
                                          data:{id_codigo:id_modalidad_ejecn},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Se elimino correctamente.", "", "success");
                                            $('#table-UnidadE').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                                          },
                                          error: function ()
                                          {
                                              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                                          }
                                        });
                              });
                    });
                }
    // FIN DE CAMPOS QUE SE ACTUALIZARAN DE LA UNIDAD EJECUTORA

//-------------- FIN MANTENIMIENTO UNIDAD EJECUTORA---------------------
