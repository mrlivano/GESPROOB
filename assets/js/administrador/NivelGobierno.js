$(document).on("ready" ,function()
{
	listaNivelGobierno();/*llamar a mi datatablet listar funcion*/
	//abrir el modal para registrar

	//REGISTARAR NUEVA nivel de gobierno
	$("#form-AddNivelGobierno").submit(function(event)
	{
		event.preventDefault();
		if($('#validarAddNivelGobierno').data('formValidation').isValid()) {
			$.ajax(
			{
				url : base_url+"index.php/NivelGobierno/AddNivelGobierno",
				type : $(this).attr('method'),
				data : $(this).serialize(),
				success : function(resp)
				{
					swal(resp,"", "success");

					$('#dynamic-table-NivelGobierno').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion

					formReset();

					$('#VentanaRegNivelGobierno').modal('hide');
				},
        error: function ()
        {
            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            $('#VentanaRegNivelGobierno').modal('hide');
        }
			});
		}
	});

	//limpiar campos
	function formReset()
	{
		document.getElementById("form-AddNivelGobierno").reset();
		document.getElementById("form-EditNivelGobierno").reset();
	}
	//formulario para ediotar

	$("#form-EditNivelGobierno").submit(function(event)
	{
		event.preventDefault();
		if($('#validarEditNivelGobierno').data('formValidation').isValid()) {
			$.ajax(
			{
				url : base_url+"index.php/NivelGobierno/UpdateNivelGobierno",
				type : $(this).attr('method'),
				data : $(this).serialize(),
				success : function(resp)
				{
					swal(resp,"", "success");

					$('#dynamic-table-NivelGobierno').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion

					formReset();

					$('#VentanaEditNivelGobierno').modal('hide');
				},
        error: function ()
        {
            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            $('#VentanaEditNivelGobierno').modal('hide');
        }
			});
		}
	});
});

         /*listra */
                var listaNivelGobierno=function()
                {
                    var myTable=$("#dynamic-table-NivelGobierno").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/NivelGobierno/get_NivelGobierno",
                  "method":"POST",
                  "dataSrc":""
                                    },
                                "columns":[

                                   {"data":"id_nivel_gob", "visible" : false},
                                  {"data":"nombre_nivel_gob"},
                                  {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaEditNivelGobierno'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>"}
                               ],

                                "language":idioma_espanol
                    });
        NivelGobiernoData("#dynamic-table-NivelGobierno",myTable);  //CARGAR LA DATA PARA MOSTRAR EN EL MODAL
        EliminarNivelGobiernoData("#dynamic-table-NivelGobierno",myTable);
                }

                var  NivelGobiernoData=function(tbody,myTable){
                    $(tbody).on("click","button.editar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        var txt_IdNivelGobiernoM=$('#txt_IdNivelGobiernoM').val(data.id_nivel_gob);
                        var txt_NombreNivelGobiernoM=$('#txt_NombreNivelGobiernoM').val(data.nombre_nivel_gob);


                    });
                }
var EliminarNivelGobiernoData=function(tbody,myTable){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        var id_nivel_gob=data.id_nivel_gob;
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
                                          url:base_url+"index.php/NivelGobierno/EliminarNivelGobierno",
                                          type:"POST",
                                          data:{id_nivel_gob:id_nivel_gob},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Se eliminó corectamente.", "", "success");
                                            $('#dynamic-table-NivelGobierno').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

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
