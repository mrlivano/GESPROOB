$(document).on("ready" ,function()
{
    lista_formulacion_evaluacion();
    lista_ejecucion();
    lista_funcionamiento();

//agregar progrmacion para operacion y mantenimiento
      $("#form_AddProgramacion_operacion_mantenieminto").submit(function(event)
      {
          event.preventDefault();
          $.ajax({
              url:base_url+"index.php/programar_pip/AddProgramacion_operacion_mantenimiento",
              type:$(this).attr('method'),
              data:$(this).serialize(),
              success:function(resp){
               if (resp=='1') {
                 swal("REGISTRADO","Se regristró correctamente", "success");
               }
                if (resp=='2') {
                 swal("NO SE REGISTRÓ","NO se regristró ", "error");
               }
              $('#Table_Programar').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion
              $('#table_formulacion_evaluacion').dataTable()._fnAjaxUpdate();
              $('#table_ejecucion').dataTable()._fnAjaxUpdate();
              $('#Table_funcionamiento').dataTable()._fnAjaxUpdate();
             },
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            }
          });
      });
     $("#form_AddProgramacion").submit(function(event)
      {
          event.preventDefault();
          $.ajax({
              url:base_url+"index.php/programar_pip/AddProgramacion",
              type:$(this).attr('method'),
              data:$(this).serialize(),
              success:function(resp){
               //alert(resp);
               if (resp=='1') {
                 swal("REGISTRADO","Se regristró correctamente", "success");
               //  formReset();
               }
                if (resp=='2') {
                 swal("NO SE REGISTRÓ","No se registró ", "error");
               }
              $('#Table_Programar').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion
              $('#table_formulacion_evaluacion').dataTable()._fnAjaxUpdate();
              $('#table_ejecucion').dataTable()._fnAjaxUpdate();
              $('#Table_funcionamiento').dataTable()._fnAjaxUpdate();
             //    formReset();
             },
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            }
          });
      });

});
//listar proyectos de inversion en formulacion y evaluacion

 var lista_formulacion_evaluacion=function()
{
       var table=$("#table_formulacion_evaluacion").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url+"index.php/programar_pip/GetProyectosFormulacionEvaluacion",
                                    "method":"POST",
                                    "dataSrc":""
                                  },
                                "columns":[
                                    {"defaultContent":"<td>#</td>"},
                                    {"data":"codigo_unico_pi"},
                                    {"data":"nombre_pi"},
                                    {"data":"costo_pi"  , render: function (data, type, row) {
                    return "<div style='float:right;'>S/. "+data+"</div>";
                    }},
                                    {"data":"nombre_estado_ciclo"},
                                    /*
                                   {"data": function (data, type, dataToSet) {

                                      if (data.estado_programado !='0') //estap programado
                                      {
                                       // return '<a  href="#"><button type="button" class="btn btn btn-success btn-xs">Programado</button></a>';
                                       return '<h5><span class="label label-success"> Programado</span></h5>';
                                      }
                                      if (data.estado_programado =='0') //no esta progrmado
                                      {
                                        //return '<a  href="#"><button type="button" class="btn btn btn-danger btn-xs">No Programado</button></a>';
                                        return '<h5><span class="label label-danger">No Programado</span></h5>';
                                      }
                                   }},*/
                                    {"data": function (data, type, dataToSet) {
                                        return "<a href='#Ventana_Meta_Presupuestal_PI' onclick='meta_pi_cup("+data.codigo_unico_pi+")'  class='meta_pip btn btn-success btn-xs' data-toggle='modal' data-id='"+data.codigo_unico_pi+"'><i class='fa fa-usd' aria-hidden='true'></i></a>"
                                      }
                                    }
                                ],
                               "language":idioma_espanol
                    });
        AddProgramacion("#table_formulacion_evaluacion",table);
        AddMeta_Pi("#table_formulacion_evaluacion",table);
}
//fin de proyectos de inversion en formulacion y evaluacion
//listar programación por cada proyecto
 var listar_programacion=function(id_pi)
                {
                    var table=$("#Table_Programar").DataTable({
                      "processing": true,
                      "serverSide":false,
                       destroy:true,
                         "ajax":{
                                     url:base_url+"index.php/programar_pip/listar_programacion",
                                     type:"POST",
                                     data :{id_pi:id_pi}
                                    },
                                "columns":[
                                    {"data":"id_pi","visible": false},
                                    {"data":"cartera"},
                                    {"data":"nombre_brecha"},
                                    {"data":"año_prog"},
                                    {"data":"monto_prog"},
                                    {"data":"prioridad_prog"},
                                    {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],
                               "language":idioma_espanol
                    });
                    EliminarProgramacion("#Table_Programar",table);
                }
//fin listar programación por cada proyecto
//Eliminar programacion
var EliminarProgramacion=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_pi=data.id_pi;
                        var id_cartera=data.id_cartera;
                      //  console.log(data);
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
                                          url:base_url+"index.php/programar_nopip/EliminarProgramacion",
                                          type:"POST",
                                          data:
                                          {id_cartera:id_cartera,id_pi:id_pi},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Se eliminó corectamente", ".", "success");
                                            $('#Table_Programar').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                                            $('#table_formulacion_evaluacion').dataTable()._fnAjaxUpdate();
                                            $('#table_ejecucion').dataTable()._fnAjaxUpdate();
                                            $('#Table_Programar_operacion_mantenimiento').dataTable()._fnAjaxUpdate();
                                            $('#Table_funcionamiento').dataTable()._fnAjaxUpdate();

                                          },
                                          error: function ()
                                          {
                                              swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                                          }
                                        });
                              });
                    });
                }
//listar prioridad con su cartera
 var lista_prioridad=function(anio)
                {
                    var table=$("#lista_prioridad_validar").DataTable({
                     // alert(anio);
                      "processing": true,
                      "serverSide":false,
                       destroy:true,
                         "ajax":{
                                     url:base_url+"index.php/programar_pip/listar_prioridad",
                                     type:"POST",
                                     data :{anio:anio}
                                    },
                                "columns":[
                                    {"data":"id_pi","visible": false},
                                    {"data":"cartera"},
                                    {"data":"prioridad"}
                                  ],
                               "language":idioma_espanol
                       });

                }
//fin listar prioridad
$("#Cbx_AnioCartera").change(function() {
                          var anio=$("#Cbx_AnioCartera").val();
                          lista_prioridad(anio);
                            //lista_ejecucion(anio);
                           //listar carteran de proyectos
                        });

//listar programación para operacion y manteniemitno
 var listar_programacion_operacion_mantenimiento=function(id_pi)
                {
                    var table=$("#Table_Programar_operacion_mantenimiento").DataTable({
                      "processing": true,
                      "serverSide":false,
                       destroy:true,
                         "ajax":{
                                     url:base_url+"index.php/programar_pip/listar_programacion_operacion_mantenimiento",
                                     type:"POST",
                                     data :{id_pi:id_pi}
                                    },
                                  "columns":[
                                    {"data":"id_pi","visible": false},
                                    {"data":"cartera"},
                                    {"data":"nombre_brecha"},
                                    {"data":"año_prog"},
                                    {"data":"monto_opera_mant_prog"},
                                    {"data":"prioridad_prog"},
                                    {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],
                               "language":idioma_espanol
                    });
                    EliminarProgramacion("#Table_Programar_operacion_mantenimiento",table);
                }
//fin listar programación  para operacion y manteniemitno
//listar proyectos de inversion en Ejecucion
 var lista_ejecucion=function()
{
       var table=$("#table_ejecucion").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url+"index.php/programar_pip/GetProyectosEjecucion",
                                    "method":"POST",
                                    "dataSrc":""
                                  },
                                "columns":[
                                    {"defaultContent":"<td>#</td>"},
                                    {"data":"id_pi" ,"visible": false},
                                    {"data":"codigo_unico_pi"},
                                    {"data":"nombre_pi"},
                                    {"data":"costo_pi"  , render: function (data, type, row) {
                                        return "<div style='float:right;'>S/. "+data+"</div>";
                                      }},
                                    {"data":"nombre_estado_ciclo"},
                                    {"data": function (data, type, dataToSet) {
                                        return "<a href='#Ventana_Meta_Presupuestal_PI' onclick='meta_pi_cup("+data.codigo_unico_pi+")'  class='meta_pip btn btn-success btn-xs' data-toggle='modal' data-id='"+data.codigo_unico_pi+"'><i class='fa fa-usd' aria-hidden='true'></i></a>"
                                      }
                                    } ],
                               "language":idioma_espanol
                    });
        AddProgramacion("#table_ejecucion",table);
        AddMeta_Pi("#table_ejecucion",table);
}
//fin de proyectos de inversion en Ejecucion

//listar proyectos en operacion y matenimiento
 var lista_funcionamiento=function() //operacion y mantenimiento
{
       var table=$("#Table_funcionamiento").DataTable({
                     "processing": true,
                      "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url+"index.php/programar_pip/GetProyectosFuncionamiento",
                                    "method":"POST",
                                    "dataSrc":""
                                  },
                                "columns":[
                                    {"defaultContent":"<td>#</td>"},
                                    {"data":"id_pi" ,"visible": false},
                                    {"data":"codigo_unico_pi"},
                                    {"data":"nombre_pi"},
                                    {"data":"costo_pi"  , render: function (data, type, row) {
                                        return "<div style='float:right;'>S/. "+data+"</div>";
                                      }},
                                    {"data":"nombre_estado_ciclo"},
                                    {"data": function (data, type, dataToSet) {
return "<a href='#Ventana_Meta_Presupuestal_PI' onclick='meta_pi_cup("+data.codigo_unico_pi+")'  class='meta_pip btn btn-success btn-xs' data-toggle='modal' data-id='"+data.codigo_unico_pi+"'><i class='fa fa-usd' aria-hidden='true'></i></a>"
                                      }
                                    } ],
                               "language":idioma_espanol
                    });
     AddProgramacion_oper_man("#Table_funcionamiento",table);
}

//add programar para formulacion y evaluacion
   var  AddProgramacion=function(tbody,table){
                    $(tbody).on("click","button.programar_pip",function(){
                      var data=table.row( $(this).parents("tr")).data();
                       var  id_pi=data.id_pi;
                       $("#txt_codigo_unico_pi").val(data.codigo_unico_pi);
                      $("#txt_id_pip_programacion").val(data.id_pi);
                      $("#txt_costo_proyecto").val(data.costo_pi);
                      $("#txt_nombre_proyecto").val(data.nombre_pi);

                        listar_aniocartera();
                        listar_programacion(id_pi);

                    });
                }
                //add programar para operacion y manteniemito
   var  AddProgramacion_oper_man=function(tbody,table){
                    $(tbody).on("click","button.programar_pip_operacion_mantenimiento",function(){
                      var data=table.row( $(this).parents("tr")).data();
                       var  id_pi=data.id_pi;
                       $("#txt_codigo_unico_pi_").val(data.codigo_unico_pi);
                      $("#txt_id_pip_programacion_").val(data.id_pi);
                      $("#txt_costo_proyecto_").val(data.costo_pi);
                      $("#txt_nombre_proyecto_").val(data.nombre_pi);
                        listar_aniocartera_();
                        listar_programacion_operacion_mantenimiento(id_pi);
                  });
                }
                var listar_aniocartera_=function(valor){ //listar ani cartera operacion y mantenimiento
                     html="";
                    $("#Cbx_AnioCartera_").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/programar_pip/GetAnioCartera",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_cartera"]+"> "+registros[i]["anio"]+" </option>";
                            };
                            $("#Cbx_AnioCartera_").html(html);
                            $('select[name=Cbx_AnioCartera_]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_AnioCartera_]').change();
                            $('.selectpicker').selectpicker('refresh');
                            listar_Brecha_();//listar brecha
                        }
                    });
                }
                var listar_Brecha_=function(valor){
                     html="";
                    $("#cbxBrecha_").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/MantenimientoBrecha/GetBrecha",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_brecha"]+"> "+registros[i]["nombre_brecha"]+" </option>";
                            };
                            $("#cbxBrecha_").html(html);
                            $('select[name=cbxBrecha_]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=cbxBrecha_]').change();
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
                 var listar_aniocartera=function(valor){
                    var html="";
                    $("#Cbx_AnioCartera").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/programar_pip/GetAnioCartera",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_cartera"]+"> "+registros[i]["anio"]+" </option>";
                            };
                            $("#Cbx_AnioCartera").html(html);
                            $('select[name=Cbx_AnioCartera]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_AnioCartera]').change();
                            $('.selectpicker').selectpicker('refresh');

                            listar_Brecha();//listar brecha
                             var anio=$("#Cbx_AnioCartera").val();
                             lista_prioridad(anio);
                            // alert(anio);

                        }
                    });
                }

                var listar_Brecha=function(valor){
                     html="";
                    $("#cbxBrecha").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/MantenimientoBrecha/GetBrecha",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_brecha"]+"> "+registros[i]["nombre_brecha"]+" </option>";
                            };
                            $("#cbxBrecha").html(html);
                            $('select[name=cbxBrecha]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=cbxBrecha]').change();
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
                var listar_Meta=function(valor){
                    var html="";
                    $("#cbx_Meta").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/Meta/listar_correlativo",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_correlativo_meta"]+"> "+registros[i]["cod_correlativo"]+" </option>";
                            };
                            $("#cbx_Meta").html(html);
                            $('select[name=cbx_Meta]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=cbx_Meta]').change();
                            $('.selectpicker').selectpicker('refresh');
                        }
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
