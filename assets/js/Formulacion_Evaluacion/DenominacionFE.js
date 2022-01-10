 $(document).on("ready" ,function(){
              ListarDenominacionFE();
               $("#form-addDenominacionFE").submit(function(event)//para añadir nueva funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/DenominacionFE/AddDenominacionFE",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           var registros = eval(resp);
                            for (var i = 0; i < registros.length; i++) {
                               if(registros[i]["VALOR"]==1){
                                    swal("",registros[i]["MENSAJE"], "success");
                                   $('#form-addDenominacionFE')[0].reset();
                                   $("#VentanaDenominacionFE").modal("hide");
                               }else{
                                      swal('',registros[i]["MENSAJE"],'error' )
                               }
                               
                            };
                          $('#table-DenominacionFE').dataTable()._fnAjaxUpdate();

                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  });
                $("#form-UpdateDenominacionFE").submit(function(event)//Actualizar deominacion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/DenominacionFE/UpdateDenominacionFE",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                           $('#table-DenominacionFE').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
						    $("#VentanaDenominacionModFE").modal("hide");
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  });
			});
 //LISTAR DENOMINACION DE FORMULACION Y EVALUACION EN TABLA
                var ListarDenominacionFE=function()
                {
                    var table=$("#table-DenominacionFE").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/DenominacionFE/GetDenominacionFE",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_denom_fe","visible": false},
                                    {"data":"denom_fe"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaDenominacionModFE'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                   DenominacionFE("#table-DenominacionFE",table);
				    Eliminardenominacion("#table-DenominacionFE",table);

                }
//LISTAR DENOMINACION DE FORMULACION Y EVALUACION EN TABLA
              var  DenominacionFE=function(tbody,table){
                  $(tbody).on("click","button.editar",function(){
                      var data=table.row( $(this).parents("tr")).data();
                           $("#txt_IdDenominacionModiFE").val(data.id_denom_fe);
                          $("#txt_DenominacionModiFE").val(data.denom_fe);
                  });
              }
			  
			  
			    var Eliminardenominacion=function(tbody,table){
              $(tbody).on("click","button.eliminar",function(){
				
                    var data=table.row( $(this).parents("tr")).data();
                    var id_denom_fe=data.id_denom_fe;
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
                                      url:base_url+"index.php/DenominacionFE/EliminarD",
                                      type:"POST",
                                      data:{id_denom_fe:id_denom_fe},
                                      success:function(respuesta){
                                       //var registros=jQuery.parseJSON(respuesta);
									   
                                       if(respuesta==1){
                                        swal("Elimando.","Denominacion", "success");
                                        $('#table-DenominacionFE').dataTable()._fnAjaxUpdate();
                                       }
                                       else{
                                        swal("Error.","Denominacion", "error");
                                        $('#table-DenominacionFE').dataTable()._fnAjaxUpdate();
                                       }
                                       },
                                        error: function ()
                                        {
                                            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
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
