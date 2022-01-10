 $(document).on("ready" ,function(){
              ListarEvaluacionFE();
               ListarEvaluador();
                            //REGISTARAR ESTADO ETAPA
   $("#form-AddEtapaEstudio").submit(function(event)
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/EstadoEtapa_FE/AddEstadoEtapa_FE",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           //alert(resp);
                           if (resp=='1') {
                             swal("REGISTRADO","Se regristró correctamente", "success");
                             formReset();
                           }
                            if (resp=='2') {
                             swal("NO SE REGISTRÓ","NO se regristró ", "error");
                           }
                          $('#table-EstadoEtapa').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion   
                             formReset();
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  });
//REGISTARAR situacion
   $("#form-AddSituacion").submit(function(event)
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEsituacion/AddSituacion",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           //alert(resp);
                           if (resp=='1') {
                             swal("REGISTRADO","Se registró correctamente", "success");
                             formReset();
                           }
                            if (resp=='2') {
                             swal("NO SE REGISTRÓ","NO se regristró ", "error");
                           }
                          $('#table-EvaluacionFE').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion   
                             formReset();
                         },
                        error: function ()
                        {
                            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                        }
                      });
                  });
   //REGISTARAR asiganar persona
   $("#form-AddAsiganarPersona").submit(function(event)
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/Estudio_Inversion/AddAsiganarPersona",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           //alert(resp);
                           if (resp=='1') {
                             swal("REGISTRADO","Se regristró correctamente", "success");
                             formReset();
                           }
                            if (resp=='2') {
                             swal("NO SE REGISTRÓ","NO se regristró ", "error");
                           }
                          $('#table-EvaluacionFE').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion   
                             formReset();
                         },
                        error: function ()
                        {
                            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                        }
                      });
                  });
//limpiar campos
          function formReset()
          {
          document.getElementById("form-AddSituacion").reset();
           document.getElementById("form-AddAsiganarPersona").reset();
          }            
     
      });

 //listar estado etapa en el modal
 var listarEstadoEtapa=function(id_etapa_estudio)
                {
                    var table=$("#table-EstadoEtapa").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    url:base_url+"index.php/EstadoEtapa_FE/GetEstadoEtapa_FE",
                                    type:"POST",
                                    data:{id_etapa_estudio:id_etapa_estudio}
                                    },
                                "columns":[
                                    {"data":"id_etapa_estudio","visible": false},
                                    {"data":"denom_estado_fe"},
                                    {"data":"fecha"}
                                    //{"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaupdateEstadoFE'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });                       
                }
 //LISTAR DENOMINACION DE EvaluacionFE Y EVALUACION EN TABLA
                var ListarEvaluacionFE=function()
                {
                    var table=$("#table-EvaluacionFE").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url+"index.php/EvaluacionFE/GetEvaluacionFE",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                               "columns":[
                                    {"data":"id_pi","visible": false},
                                    {"data":"codigo_unico_est_inv",
                                    "mRender": function ( data, type, full ) {
                                     return '<a style="font-weight:normal;font-size:15" type="button" class="VerDetalleEvaluacion btn btn-link" data-toggle="modal" data-target="#VerDetalleEvaluacion" href="/codigo_unico_est_inv/' + data + '">' + data+ '</a>';
                                      }
                                    },
                                    {"data":"nombre_est_inv"},
                                    {"data":"provincia"},
                                    {"data":"distrito"},
                                    {"data":"denom_nivel_estudio"},

                                    {"data":"nombres"},
                                    {"data":"costo_estudio"},
                                    {"data":"denom_situacion_fe"},
                                    {"data":"avance_fisico",
                                      "mRender":function (data,type, full) {
                                         return "<td class='project_progress'><div class='progress progress_sm'><div class='progress-bar bg-green' role='progressbar' data-transitiongoal='57' style='width: "+data+"%;'></div></div><small>"+data+" % Complete</small></td>";
                                    }},

{"defaultContent":"<button type='button' class='EstadoFE btn btn-success btn-xs' data-toggle='modal' data-target='#VentanaEstadoFE'><i class='fa fa-dashboard' aria-hidden='true'></i></button><button type='button' class='Situacion btn btn-warning btn-xs' data-toggle='modal' data-target='#VentanaSituacionActual'><i class='fa fa-flag' aria-hidden='true'></i></button>"}                            
                                ],
                                 "language":idioma_espanol
                    });
                   // DenominacionFE("#table-DenominacionFE",table);   
                   $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
        
        new $.fn.DataTable.Buttons(table, {
          buttons: [
           {
            "extend": "colvis",
            "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
            "className": "btn btn-white btn-primary btn-bold",
            columns: ':not(:first):not(:last)'
            },
            {
            "extend": "copy",
            "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "csv",
            "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "excel",
            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "pdf",
            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "print",
            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
            "className": "btn btn-white btn-primary btn-bold",
            autoPrint: false,
            message: 'This print was produced using the Print button for DataTables'
            }     
           
          ]
        } );
        table.buttons().container().appendTo( $('.tableTools-container-evaluacion') );                           
                     ListarEvaluacion("#table-EvaluacionFE",table);     
                      SituacionActual("#table-EvaluacionFE",table);  
                     RegistarPersona("#table-EvaluacionFE",table);          
                }
//FIN LISTAR PROYECTOS QUE SE ENCUENTRARN EN EVALUACION
//LISTAR DETALLE DE SITUACION ACTUAL DE UNA PIP EN EVALUACION
var DetalleSitActPipEvaluacion=function(codigo_unico_est_inv)
  {
    html1="";
     $("#table-DetSitActEvaluacionFE").html(html1);
    $.ajax({
    "url":base_url+"index.php/EvaluacionFE/GetDetallesituacionActual",
    type:"post",
    data:{codigo_unico_est_inv:codigo_unico_est_inv},
     success:function(respuesta)
                      {
                         var registros = eval(respuesta);  
                          
                         html1+="<thead> <tr> <th  class='active'><h5>ID</h5></th><th  class='active'><h5>CODIGO UNICO </h5></th> <th class='active'><h5>NOMBRE DEL ESTUDIO </h5></th><th class='active'><h5>EVALUADOR</h5></th>  <th class='active'><h5>CARGO</h5></th><th class='active'><h5>OBSERVACIONES</h5></th><th class='active'><h5>FECHA</h5></th></tr></thead>"
                         for (var i = 0; i <registros.length;i++) {
                              html1 +="<tbody> <tr><th>"+registros[i]["id_est_inv"]+"</th><th>"+registros[i]["codigo_unico_est_inv"]+"</th><th>"+registros[i]["nombre_est_inv"]+"</th><th>"+registros[i]["Evaluador"]+"</th><th>"+registros[i]["desc_cargo"]+"</th><th>"+registros[i]["observacion"]+"</th><th>"+registros[i]["fecha"]+"</th></tr>";    
                          //alert(suma);
                           };               
                             html1 +="</tbody>";
                         $("#table-DetSitActEvaluacionFE").html(html1);
                             
                      }
                    });
    }
  
  //FIN LISTAR DETALLE DE SITUACION ACTUAL DE UNA PIP EN EVALUACION
          var  ListarEvaluacion=function(tbody,table){
                             $(tbody).on("click","a.VerDetalleEvaluacion",function(){
                              var data=table.row( $(this).parents("tr")).data();
                               var codigo_unico_est_inv=data.codigo_unico_est_inv;
                               DetalleSitActPipEvaluacion(codigo_unico_est_inv);
                          });
                      }
 var  SituacionActual=function(tbody,table){
                    $(tbody).on("click","button.Situacion",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var txt_IdEtapa_Estudio=$('#txt_IdEtapa_Estudio').val(data.id_etapa_estudio);
                         listarsituacionFE();
                  });
                }
                 //para registar estado de FE
                 var  RegistarEstadoFE=function(tbody,table){
                    $(tbody).on("click","button.EstadoFE",function(){
                        var data=table.row( $(this).parents("tr")).data();
                         var id_etapa_estudio=data.id_etapa_estudio;
                        var txt_IdEtapa_Estudio_FE=$('#txt_IdEtapa_Estudio_FE').val(data.id_etapa_estudio);
                         listarEstadoFE();
                         listarEstadoEtapa(id_etapa_estudio);
                  });
                }
           var listarEstadoFE=function(valor){
                     html="";
                    $("#Cbx_EstadoFE").html(html); 
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/FEestado/get_FEestado",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_estado"]+"> "+registros[i]["denom_estado_fe"]+" </option>";   
                            };
                            $("#Cbx_EstadoFE").html(html);
                            $('select[name=Cbx_EstadoFE]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_EstadoFE]').change();
                            $('.selectpicker').selectpicker('refresh'); 
                        }
                    });
                }
                var ListarEvaluador=function()
                {
                    var table=$("#table-AsignarEvaluador").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/EvaluacionFE/GetEvaluadores",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_persona","visible": false},
                                    {"data":"nombres"},
                                    {"data":"apellido_P"},
                                    {"data":"desc_cargo"},
                                    {"data":"especialidad"},
                                    {"data":"grado_academico"}
                                ],

                                "language":idioma_espanol
                    });
                   // EtapaDenominacion("#table-AsignarEvaluador",table);

                }
                var listarsituacionFE=function(valor){
                     html="";
                    $("#Cbx_Situacion").html(html); 
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/FEsituacion/get_FEsituacion",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_situacion_fe"]+"> "+registros[i]["denom_situacion_fe"]+" </option>";   
                            };
                            $("#Cbx_Situacion").html(html);
                            $('select[name=Cbx_Situacion]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_Situacion]').change();
                            $('.selectpicker').selectpicker('refresh'); 
                        }
                    });
                }
/*Asiganar Persona*/
 var  RegistarPersona=function(tbody,table){
                    $(tbody).on("click","button.AsignarPersona",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var txt_IdEtapa_Estudio_p=$('#txt_IdEtapa_Estudio_p').val(data.id_etapa_estudio);
                         listarPersonaFE();
                        
                  });
                }
  var listarPersonaFE=function(valor){
                     html="";
                    $("#Cbx_Persona").html(html); 
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/Estudio_Inversion/get_persona",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_persona"]+"> "+registros[i]["nombres_apell"]+" </option>";   
                            };
                            $("#Cbx_Persona").html(html);
                            $('select[name=Cbx_Persona]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_Persona]').change();
                            $('.selectpicker').selectpicker('refresh'); 
                             listarCargoFE();
                        }
                    });
                }

                  var listarCargoFE=function(valor){
                     html="";
                    $("#Cbx_Cargo").html(html); 
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/Estudio_Inversion/get_cargo",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_cargo"]+"> "+registros[i]["desc_cargo"]+" </option>";   
                            };
                            $("#Cbx_Cargo").html(html);
                            $('select[name=Cbx_Cargo]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_Cargo]').change();
                            $('.selectpicker').selectpicker('refresh'); 
                        }
                    });
                }

            /*      function lista()
          {
            event.preventDefault();
            $.ajax({
              "url": base_url+"index.php/EvaluacionFE/GetEvaluadores",
              type:"POST",
              success:function(respuesta){
                alert(respuesta);GetEvaluadores
              

              }
            });
          }*/

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

  