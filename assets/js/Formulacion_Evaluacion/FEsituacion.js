 $(document).on("ready" ,function(){

              listaFEsituacion();
                $("#form-addSituacionFE").submit(function(event)//para añadir nueva funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEsituacion/add_FEsituacion",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                          $('#table-SituacioFE').dataTable()._fnAjaxUpdate();
						  $('#VentanaSituacion').modal('hide');

                         },
                          error: function ()
                          {
                              $('#VentanaSituacion').modal('hide');
                              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                          }
                      });
                  });
                $("#form-UpdateSituacionFE").submit(function(event)//Actualizar funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEsituacion/update_FEsituacion",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                           $('#table-SituacioFE').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
						    $('#VentanasituacioFE').modal('hide');
                         },
                          error: function ()
                          {
                              $('#VentanasituacioFE').modal('hide');
                              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                          }
                      });
                  });
			});
                var listaFEsituacion=function()
                {
                    var table=$("#table-SituacioFE").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/FEsituacion/get_FEsituacion",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_situacion_fe","visible": false,},
                                    {"data":"denom_situacion_fe"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanasituacioFE'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                    SituacioFE("#table-SituacioFE",table);
                  	EliminarSituacion("#table-SituacioFE",table);
                }

                var SituacioFE=function(tbody,table){
                       $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_situacion_fe=$('#id_situacion_fe').val(data.id_situacion_fe);
                        var denom_situacion_fe=$('#denom_situacion_fe').val(data.denom_situacion_fe);
                    });
                }


                /*fin listar funcion*/

                var EliminarSituacion=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_situacion_fe=data.id_situacion_fe;
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
                                          url:base_url+"index.php/FEsituacion/EliminarSituacion",
                                          type:"POST",
                                          data:{id_situacion_fe:id_situacion_fe},
                                          success:function(respuesta){
                                           var registros=jQuery.parseJSON(respuesta);
                                           if(registros.flag==0){
                                            swal("Elimando.",registros.msg, "success");
                                            $('#table-SituacioFE').dataTable()._fnAjaxUpdate();
                                           }
                                           else{
                                            swal("Error.",registros.msg, "error");
                                            $('#table-SituacioFE').dataTable()._fnAjaxUpdate();
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
