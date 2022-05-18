 $(document).on("ready" ,function(){
              listaFEestado();
                $("#form-addEstadoFE").submit(function(event)//para añadir nueva funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEestado/add_FEestado",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
						   $('#VentanaEstadoFE').modal('hide');
                          $('#table-FEestado').dataTable()._fnAjaxUpdate();

                         },
                        error: function ()
                        {
                            $('#VentanaEstadoFE').modal('hide');
                            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                        }
                      });
                  });
                $("#form-updateEstadoFE").submit(function(event)//Actualizar funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEestado/updateFEestado",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                           $('#table-FEestado').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
						    $('#VentanaupdateEstadoFE').modal('hide');
                         },
                        error: function ()
                        {
                            $('#VentanaupdateEstadoFE').modal('hide');
                            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                        }
                      });
                  });
			});
                var listaFEestado=function()
                {
                    var table=$("#table-FEestado").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/FEestado/get_FEestado",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_estado","visible": false},
                                    {"data":"denom_estado_fe"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaupdateEstadoFE'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                    FEestado("#table-FEestado",table);
                    EliminarEstado("#table-FEestado",table);
                }

                var FEestado=function(tbody,table){
                       $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_estado=$('#id_estado').val(data.id_estado);
                        var denom_estado_fe=$('#denom_estado_fe').val(data.denom_estado_fe);
                    });
                }


                /*fin listar funcion*/

                var EliminarEstado=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_estado=data.id_estado;
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
                                          url:base_url+"index.php/FEestado/EliminarEstado",
                                          type:"POST",
                                          data:{id_estado:id_estado},
                                          success:function(respuesta){
                                           var registros=jQuery.parseJSON(respuesta);
                                           if(registros.flag==0){
                                            swal("Elimando.",registros.msg, "success");
                                            $('#table-FEestado').dataTable()._fnAjaxUpdate();
                                           }
                                           else{
                                            swal("Error.",registros.msg, "error");
                                            $('#table-FEestado').dataTable()._fnAjaxUpdate();
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
