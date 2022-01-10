 $(document).on("ready" ,function(){

                listarEntidad();//listar entidad

	$("#form-addEntidad").submit(function(event)//para añadir una nueva entidad
	{
		event.preventDefault();
    $('#validarEntidad').data('formValidation').validate();
        if(!($('#validarEntidad').data('formValidation').isValid()))
        {
            return;
        }
		$.ajax(
		{
			url : base_url+"index.php/Entidad/AddEntidad",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				var registros=eval(resp);

				for(var i=0; i<registros.length; i++)
				{
					if(registros[i]["VALOR"]==1)
					{
						swal("",registros[i]["MENSAJE"], "success");
            $('#form-addEntidad')[0].reset();
            $("#VentanaRegistraEntidad").modal("hide");
					}
					else
					{
						swal('',registros[i]["MENSAJE"],'error' );
            $("#VentanaRegistraEntidad").modal("hide");
					}

					/*swal("",  registros[i]["MENSAJE"], "success");*/
				}
			$('#table-entidad').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
			},
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $("#VentanaRegistraEntidad").modal("hide");
            }
		});
	});  

	$("#form-ActulizarEntidad").submit(function(event)//Actualizar la entidad
	{
		event.preventDefault();
    $('#validarEntidadM').data('formValidation').validate();
        if(!($('#validarEntidadM').data('formValidation').isValid()))
        {
            return;
        }
		$.ajax(
		{
			url : base_url+"index.php/Entidad/UpdateEntidad",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal("", resp, "success");

				$('#table-entidad').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

				$("#VentanaModificarEntidad").modal("hide");
			},
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $("#VentanaModificarEntidad").modal("hide");
            }
		});
	});   

			});
			  
           
             /* listar y lista en tabla entidadr*/ 
                var listarEntidad=function()
                {
                    var table=$("#table-entidad").DataTable({
                     "processing":true,
                     "serverSide":false,
                     "order":[[2,'asc'],[3,'asc']],
                     destroy:true,
                         "ajax":{
                                    "url":base_url+"index.php/Entidad/GetEntidad",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_entidad","visible" : false},
                                    {"data":"id_sector","visible": false},
                                    {"data":"nombre_sector"},
                                    {"data":"nombre_entidad"},
                                    {"data":"siglas_entidad"},
                                    

                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarEntidad'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                  SectorDataEntidad("#table-entidad",table);  //obtener data de entidad para actualizar   
                  SectorDataEliminar("#table-entidad",table) ;
                }
                var SectorDataEntidad=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_sector=data.id_sector;//ojo
                        var id_entidadM=$('#txt_IdModificarEntidar').val(data.id_entidad);
                        var nombre_entidadM=$('#txt_NombreEntidadM').val(data.nombre_entidad);
                        var denominacion_entidadM=$('#txt_DenominacionEntidadM').val(data.siglas_entidad);
                      $('select[name=listaSectorModificar]').val(id_sector);
                      $('select[name=listaSectorModificar]').change();

                    });
                }
                var SectorDataEliminar=function(tbody,table){//eliminar entidad
                    $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_entidad=data.id_entidad;
                         swal({
                                title: "Desea eliminar la Entidad?",
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
                                          url:base_url+"index.php/Entidad/EliminarEntidad",
                                          type:"POST",
                                          data:{id_entidad:id_entidad},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Eliminado!", "Se elimino corectamente la entidad.", "success");
                                            $('#table-entidad').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

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

           /* function lista()
					{
						event.preventDefault();
						$.ajax({
							"url":base_url+"index.php/MSectorEntidadSpu/GetEntidad",
							type:"POST",
							success:function(respuesta){
								alert(respuesta);
							

							}
						});
					}*/
