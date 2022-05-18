 $(document).on("ready" ,function(){
           //sector
                  listaSector();/*llamar a mi datatablet listarSector*/
                  listaSectorCombo();//para listar en un combo los sectores
                
                  $("#form-addSector").submit(function(event)//para añadir nuevo sector
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MSectorEntidadSpu/AddSector",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           //alert(resp);
                            swal("",resp, "success");
                           $('#table-sector').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet     
                           listaSectorCombo();//llamado para la recarga al añadir un nuevo secto
                         },
                          error: function ()
                          {
                              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                          }
                      });
                  });          
                 //fin sector añadir sector
                 //para actualizar los sectores
                 $("#form-ActulizarSector").submit(function(event)//para añadir nuevo sector
                {
                             
                                            event.preventDefault();  
                 
                                          $.ajax({
                                              url:base_url+"index.php/MSectorEntidadSpu/UpdateSector",
                                              type:$(this).attr('method'),
                                              data:$(this).serialize(),
                                              success:function(resp){
                                                swal("",resp, "success");
                                               $('#table-sector').dataTable()._fnAjaxUpdate();
                                                listaSectorCombo();//llamado para la recarga al añadir un nuevo secto
                                               //listaSector();

                                              },
                                              error: function ()
                                              {
                                                  swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                                              }

                                          });

                });  
                 //fin para actualizar los sectores
            //fin sector
            //inicio  entidades

                listarEntidad();//listar entidad
                $("#form-addEntidad").submit(function(event)//para añadir una nueva entidad
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MSectorEntidadSpu/AddEntidad",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           //alert(resp);
                            swal("",resp, "success");
                           $('#table-entidad').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                         },
                        error: function ()
                        {
                            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                        }
                      });
                  });  

                  $("#form-ActulizarEntidad").submit(function(event)//Actualizar la entidad
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MSectorEntidadSpu/UpdateEntidad",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                           $('#table-entidad').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                         },
                        error: function ()
                        {
                            swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                        }
                                  });
                  });         

    

			});
			   /*metodos de sector lista sector*/
             var listaSector=function()
                {
                    var table=$("#table-sector").DataTable({
                     "processing":true,
                     "serverSide":false,
                      "bAutoWidth": false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url +"index.php/MSectorEntidadSpu/GetSector",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_sector","visible": false},
                                    {"data":"nombre_sector"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarSector'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                 SectorData("#table-sector",table);  //obtener data de sector para agregar  AGREGAR  	
                 EliminarSectorLista("#table-sector",table);	   	
              }
                
                var SectorData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_sector=$('#txt_IdModificar').val(data.id_sector);
                        var nombre_sector=$('#txt_NombreSectorM').val(data.nombre_sector);

                    });
                }
                var EliminarSectorLista=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_sector=data.id_sector;
                         swal({
                                title: "Desea eliminar El sector?",
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
                                          url:base_url+"index.php/MSectorEntidadSpu/EliminarSector",
                                          type:"POST",
                                          data:{id_sector:id_sector},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Eliminado!", "Se elimino corectamente el sector.", "success");
                                            $('#table-sector').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                                          },
                                          error: function ()
                                          {
                                              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                                          }
                                        });
                              });
                    });
                }


                 listaSectorCombo=function()
                 {
                    html="";
                    $("#listaSector").html(html);
                    $("#listaSectorModificar").html(html);
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/MSectorEntidadSpu/GetSector",
                        type:"POST",
                        success:function(respuesta){
                          // alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_sector"]+"> "+registros[i]["nombre_sector"]+" </option>";   
                            };
                            $("#listaSector").html(html);
                            $("#listaSectorModificar").html(html);//para modificar las entidades
                            $('.selectpicker').selectpicker('refresh');        
                        }
                    });
                 }
                /* fin metodos de sector de  sector*/
        //metodos de entidades
           
             /* listar y lista en tabla entidadr*/ 
                var listarEntidad=function()
                {
                    var table=$("#table-entidad").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url+"index.php/MSectorEntidadSpu/GetEntidad",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_entidad","visible": false},
                                    {"data":"id_sector","visible": false},
                                    {"data":"nombre_sector"},
                                    {"data":"nombre_entidad"},
                                    {"data":"denominacion_entidad"},
                                    

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
                        var denominacion_entidadM=$('#txt_DenominacionEntidadM').val(data.denominacion_entidad);
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
                                          url:base_url+"index.php/MSectorEntidadSpu/EliminarEntidad",
                                          type:"POST",
                                          data:{id_entidad:id_entidad},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Eliminado!", "Se elimino corectamente la entidad.", "success");
                                            $('#table-entidad').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

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
