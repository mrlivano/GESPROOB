$(document).on("ready" ,function()
{
	listaEstadoCicloInversion();/*llamar a mi datatablet listar funcion*/
	//abrir el modal para registrar

	//REGISTARAR NUEVA tipologia inversion
	$("#form-AddEstadoCicloInversion").submit(function(event)
	{
		event.preventDefault();
		if($('#validacionAddEstadoCicloInversion').data('formValidation').isValid()) {
			$.ajax(
			{
				url : base_url+"index.php/EstadoCicloInversion/AddEstadoCicloInversion",
				type : $(this).attr('method'),
				data : $(this).serialize(),
				success : function(resp)
				{
					swal("REGISTRADO!", "", "success");

					$('#dynamic-table-EstadoCicloInversion').dataTable()._fnAjaxUpdate();

					$('#VentanaRegEstadoCicloInversion').modal('hide');
				},
        error: function ()
        {
            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            $('#VentanaRegEstadoCicloInversion').modal('hide');
        }
			});
		}
	});

	//limpiar campos
	function formReset()
	{
		document.getElementById("form-AddEstadoCicloInversion").reset();
		document.getElementById("form-EditEstadoCicloInversion").reset();
	}

	//formulario para ediotar
	$("#form-EditEstadoCicloInversion").submit(function(event)
	{
		event.preventDefault();
		if($('#validarEditEstadoCicloInversion').data('formValidation').isValid()) {
			$.ajax(
			{
				url : base_url+"index.php/EstadoCicloInversion/UpdateEstadoCicloInversion",
				type : $(this).attr('method'),
				data : $(this).serialize(),
				success : function(resp)
				{
					swal(resp,"", "success");

					$('#dynamic-table-EstadoCicloInversion').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion

					formReset();

					$('#VentanaEditEstadoCicloInversion').modal('hide');
				},
        error: function ()
        {
            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            $('#VentanaEditEstadoCicloInversion').modal('hide');
        }
			 });
		}
	});
});

			   /*listra */
                var listaEstadoCicloInversion=function()
                {
                    var myTable=$("#dynamic-table-EstadoCicloInversion").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/EstadoCicloInversion/get_EstadoCicloInversion",
									"method":"POST",
									"dataSrc":""
                                    },
                                "columns":[
                                   {"defaultContent":" <label class='pos-rel'><input type='checkbox' class='ace' /><i class='lbl'></i></label>" ,"visible": false},
                                    {"data":"id_estado_ciclo","visible" : false},
                                    {"data":"nombre_estado_ciclo"},
                                    {"data":"descripcion_estado_ciclo"},
                                 {"defaultContent":"</button><button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaEditEstadoCicloInversion'><i class='glyphicon glyphicon-pencil' aria-hidden='true'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='glyphicon glyphicon-trash' aria-hidden='true'></i></button>"}
                               ],

                                "language":idioma_espanol
                    });
        EstadoCicloData("#dynamic-table-EstadoCicloInversion",myTable);  //CARGAR LA DATA PARA MOSTRAR EN EL MODAL
        EliminarEstadoCicloData("#dynamic-table-EstadoCicloInversion",myTable);
                }

                var  EstadoCicloData=function(tbody,myTable){
                    $(tbody).on("click","button.editar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        var txt_IdEstadoCicloInversionM=$('#txt_IdEstadoCicloInversionM').val(data.id_estado_ciclo);
                        var txt_NombreEstadoCicloInversionM=$('#txt_NombreEstadoCicloInversionM').val(data.nombre_estado_ciclo);
                        var txt_DescripcionEstadoCicloInversionM=$('#txt_DescripcionEstadoCicloInversionM').val(data.descripcion_estado_ciclo);

                    });
                }
var EliminarEstadoCicloData=function(tbody,myTable){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        var id_estado_ciclo=data.id_estado_ciclo;
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
                                          url:base_url+"index.php/EstadoCicloInversion/EliminarEstadoCicloInversion",
                                          type:"POST",
                                          data:{id_estado_ciclo:id_estado_ciclo},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Se eliminó correctamente!", "", "success");
                                            $('#dynamic-table-EstadoCicloInversion').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                                          },
                                          error: function ()
                                          {
                                              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
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
