 $(document).on("ready" ,function(){
              ListarEtapasFE();
                    $("#form-addEtapasFE").submit(function(event)//para añadir nueva funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/EtapasFE/AddEtapasFE",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                          $('#table-EtapasFE').dataTable()._fnAjaxUpdate();
						  $('#VentanaEtapasFE').modal('hide');
						 

                         },
                          error: function ()
                          {
                              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                          }
                      });
                  });

                  //actualizar etapa
                  $("#form-EtapasDenominacion").submit(function(event)//para añadir nueva funcion
                {
                    event.preventDefault();
                    $.ajax({
                        url:base_url+"index.php/EtapasFE/UpdateEtapasFE",
                        type:$(this).attr('method'),
                        data:$(this).serialize(),
                        success:function(resp){
                         swal("",resp, "success");
                        $('#table-EtapasFE').dataTable()._fnAjaxUpdate();
						$('#VentanaEtapasDenominacion').modal('hide');

                       },
                        error: function ()
                        {
                            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                        }
                    });
                });


			});
 //LISTAR DENOMINACION DE FORMULACION Y EVALUACION EN TABLA
                var ListarEtapasFE=function()
                {
                    var table=$("#table-EtapasFE").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/EtapasFE/GetEtapasFE",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_etapa_fe","visible": false},
                                    {"data":"denom_etapas_fe"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaEtapasDenominacion'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                    EtapaDenominacion("#table-EtapasFE",table);
                    EliminarEtapa("#table-EtapasFE",table);
                }
//LISTAR DENOMINACION DE FORMULACION Y EVALUACION EN TABLA
            var  EtapaDenominacion=function(tbody,table){
                $(tbody).on("click","button.editar",function(){
                    var data=table.row( $(this).parents("tr")).data();
                         $("#id_etapa_fe").val(data.id_etapa_fe);
                        $("#denom_etapas_fe").val(data.denom_etapas_fe);
                });
            }

            var EliminarEtapa=function(tbody,table){
              $(tbody).on("click","button.eliminar",function(){
                    var data=table.row( $(this).parents("tr")).data();
                    var id_etapa_fe=data.id_etapa_fe;
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
                                      url:base_url+"index.php/EtapasFE/EliminarEtapa",
                                      type:"POST",
                                      data:{id_etapa_fe:id_etapa_fe},
                                      success:function(respuesta){
                                       var registros=jQuery.parseJSON(respuesta);
                                       if(registros.flag==0){
                                        swal("Elimando.",registros.msg, "success");
                                        $('#table-EtapasFE').dataTable()._fnAjaxUpdate();
                                       }
                                       else{
                                        swal("Error.",registros.msg, "error");
                                        $('#table-EtapasFE').dataTable()._fnAjaxUpdate();
                                       }
                                       }
                                    });
                          });
                });
            }

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
