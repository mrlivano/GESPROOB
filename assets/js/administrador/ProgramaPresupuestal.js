$(document).on("ready" ,function()
{
	listaProgramaP();
	//LLAMAR AL METODO PROGRAMA PRESUPUESTAL

	//AGREGAR UN PROGRAMA PRESUPUESTAL
	$("#form-addProgramaP").submit(function(event)
	{
		event.preventDefault();
		if($('#validarAddProgramaP').data('formValidation').isValid()) {
			$.ajax(
			{
				url : base_url+"index.php/ProgramaPresupuestal/AddProgramaP",
				type : $(this).attr('method'),
				data : $(this).serialize(),
				success : function(resp)
				{
					var obj = JSON.parse(resp);
					if (obj.flag == 0) {

						swal("REGISTRADO!", obj.msg, "success");

						$('#table-ProgramaPresupuestal').dataTable()._fnAjaxUpdate();

						$('#VentanaRegistraProgramaP').modal('hide');

					} else if(obj.flag==1) {

						swal("NO SE REGISTRÓ!", obj.msg, "error");

						$('#table-ProgramaPresupuestal').dataTable()._fnAjaxUpdate();

						$('#VentanaRegistraProgramaP').modal('hide');
					}
				},
        error: function ()
        {
            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            $('#VentanaRegistraProgramaP').modal('hide');
        }
			});
		}
	});

	$("#form-ActualizarProgramaP").submit(function(event)
	{
			event.preventDefault();
			if($('#validarActualizarProgramaP').data('formValidation').isValid()) {
				$.ajax(
				{
					url : base_url+"index.php/ProgramaPresupuestal/UpdateProgramaP",
					type : $(this).attr('method'),
					data : $(this).serialize(),
					success : function(resp)
					{
						swal("ACTUALIZADO!", '', "success");

						$('#table-ProgramaPresupuestal').dataTable()._fnAjaxUpdate();

						$('#VentanaModificarProgramaP').modal('hide');
					},
          error: function ()
          {
              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
              $('#VentanaModificarProgramaP').modal('hide');
          }
				});
			}
   });
});
	//FIN DE AGREGAR PROGRAMA PRESUPUESTAL

//-------------- MANTENIMIENTO DE PROGRAMA  PRESUPUESTAL----------------------

                var listaProgramaP=function()
                {
                    var table=$("#table-ProgramaPresupuestal").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url +"index.php/ProgramaPresupuestal/GetProgramaP",
                                    "method":"POST",
                                     "dataSrc":""
                                    },
       //para llenado y busqueda por todo los campos
                                "columns":[
                                    {"data":"id_programa_pres", "visible" : false},
                                    {"data":"cod_programa_pres"},
                                    {"data":"nombre_programa_pres"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarProgramaP'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                    ProgramaPData("#table-ProgramaPresupuestal",table); //TRAER LA DATA RUBRO DE EJECUCION PARA ACTUALIZARLA
              		EliminarProgramaP("#table-ProgramaPresupuestal",table);
                }


//ACTUALIZAR UN ROGRAMA P
      var ProgramaPData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_programa_pres=$('#txt_IdProgramaPU').val(data.id_programa_pres);
                        var cod_programa_pres=$('#txt_CodigoProgramaPU').val(data.cod_programa_pres);
                        var nombre_programa_pres=$('#txt_NombreProgramaPU').val(data.nombre_programa_pres);
                    });
                }
//FIN ACTUALIZAR UN ROGRAMA P
//ELIMINAR PROGRAMA P
                var EliminarProgramaP=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_programa_pres=data.id_programa_pres;
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
                                          url:base_url+"index.php/ProgramaPresupuestal/EliminarProgramaP",
                                          type:"POST",
                                          data:{id_programa_pres:id_programa_pres},
                                          success:function(respuesta){
                                                    var registros=jQuery.parseJSON(respuesta);
                                                      if(registros.flag==0)
                                                      {
                                                        swal("Eliminado",registros.msg, "success");
                                                         $('#table-ProgramaPresupuestal').dataTable()._fnAjaxUpdate();
                                                      }
                                                      else
                                                      {
                                                        swal("",registros.msg,"error");
                                                        $('#table-ProgramaPresupuestal').dataTable()._fnAjaxUpdate();
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

    // FIN DE CAMPOS QUE SE ACTUALIZARAN EN EL ROGRAMA P
//-------------- FIN MANTENIMIENTO DE ROGRAMA P----------------------
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
