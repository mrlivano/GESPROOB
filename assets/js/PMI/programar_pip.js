function mostrarPrioridad(proyecto)
{
    $.getJSON(base_url+"index.php/criterio/getPrioridad?id_project="+proyecto,function(json)
    {
        $("#txt_prioridad").val(json[0]['n']);
    });
}

function mostrarPrioridad_operacion_mantenimiento(proyecto)
{
    $.getJSON(base_url+"index.php/criterio/getPrioridad?id_project="+proyecto,function(json){
        $("#txt_prioridad_").val(json[0]['n']);
    });
}

function guardarPrioridad(id_proyecto){
  var c=0;
  var arrayValorizacion=new Array();
  $("#frmPrioridad :input[name*='tx_peso_']").each(function(){
    var criterio=(($(this).attr("id")).split('tx_peso_'))[1];
    arrayValorizacion[c]=[$('input:radio[name=rb_'+criterio+']:checked').val(),$("#tx_ptje_"+criterio).val(),$("#tx_peso_"+criterio).val()];
    c++;
  });
  var formData={id_proyecto:id_proyecto,arrayValorizacion:arrayValorizacion};
  $.ajax({
      url:base_url+"index.php/criterio/addPrioridad",
      type:"POST",
      data:formData,
      dataType:'json',
      success:function(data){
        if(data==true)
          swal("","Se grabaron los datos!","success");
        else
          swal("","Error... no se grabaron los datos","error");
      },
      error: function ()
      {
          swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
      }
  });
}
function total(){
    var total=0;
    $("#frmPrioridad :input[name*='tx_peso_']").each(function(){
      if($(this).val()!='')
        total=total+parseFloat($(this).val());
    });
    $("#tx_ptjeTotal").val(total.toFixed(2));
}
function puntaje(id,valor,peso){
    $("#tx_ptje_"+id).val(valor);
    $("#tx_peso_"+id).val(valor*peso/100);
    total();
}
$(document).on("ready" ,function(){
     lista_formulacion_evaluacion();/*llamar a mi datatablet listar proyectosinverision*/
     lista_ejecucion();
     lista_funcionamiento();

     $("#txt_anio1").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio2").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio3").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });

    $("#txt_anio4").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio5").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio6").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_saldoprogramar").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_saldoprogramar_oper").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio1_").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio2_").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio3_").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio4_").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio5_").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio6_").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
//agregar progrmacion para operacion y mantenimiento

    $('#form_AddProgramacion_operacion_mantenieminto').formValidation({
      excluded: ':disabled',
      fields:
      {
        cbxBrecha_:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Brecha" es requerido.</b>'
            }
          }
        },
        txt_saldoprogramar_:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Saldo a Programar" es requerido.</b>'
            },
            regexp:
            {
                regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                message: '<b style="color: red;">El campo "Saldo" debe ser númerico.</b>'
            }

          }
        },
        txt_anio1_:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Monto Programación" es requerido.</b>'
            },
            regexp:
            {
                regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                message: '<b style="color: red;">El campo "Monto Programación" debe ser númerico.</b>'
            }

          }
        },
        txt_anio2_:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Monto Programación" es requerido.</b>'
            },
            regexp:
            {
                regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                message: '<b style="color: red;">El campo "Monto Programación" debe ser númerico.</b>'
            }

          }
        },
        txt_anio3_:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Monto Programación" es requerido.</b>'
            },
            regexp:
            {
                regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                message: '<b style="color: red;">El campo "Monto Programación" debe ser númerico.</b>'
            }
          }
        },
        txt_anio4_:{
          validators:{
            regexp:
            {
                regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                message: '<b style="color: red;">El campo "Saldo" debe ser númerico.</b>'
            }
          }
        },
        txt_anio5_:{
          validators:{
            regexp:
            {
                regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                message: '<b style="color: red;">El campo "Saldo" debe ser númerico.</b>'
            }
          }
        },
        txt_anio6_:{
          validators:{
            regexp:
            {
                regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                message: '<b style="color: red;">El campo "Saldo" debe ser númerico.</b>'
            }
          }
        },
      }
    });
    $("body").on("click","#send_addProgramacion_operacion_mantenieminto",function(e){
      $('#form_AddProgramacion_operacion_mantenieminto').data('formValidation').validate();
      if($('#form_AddProgramacion_operacion_mantenieminto').data('formValidation').isValid()==true){
          $('#form_AddProgramacion_operacion_mantenieminto').submit();
          var txt_codigo_unico_pi_=$("#txt_codigo_unico_pi_").val();
          var txt_nombre_proyecto_=$("#txt_nombre_proyecto_").val();
          var txt_costo_proyecto_=$("#txt_costo_proyecto_").val();
          var txt_pia_oper=$("#txt_pia_oper").val();
          var txt_pim_oper=$("#txt_pim_oper").val();
          var txt_devengado_oper=$("#txt_devengado_oper").val();
          $('#form_AddProgramacion_operacion_mantenieminto').each(function(){
            this.reset();
          });
          $("#txt_codigo_unico_pi_").val(txt_codigo_unico_pi_);
          $("#txt_nombre_proyecto_").val(txt_nombre_proyecto_);
          $("#txt_costo_proyecto_").val(txt_costo_proyecto_);
          $("#txt_pia_oper").val(txt_pia_oper);
          $("#txt_pim_oper").val(txt_pim_oper);
          $("#txt_devengado_oper").val(txt_devengado_oper);

          $('.selectpicker').selectpicker('refresh');
          $('#form_AddProgramacion_operacion_mantenieminto').data('formValidation').resetForm();
      }
    });
    $("#form_AddProgramacion_operacion_mantenieminto").submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/programar_pip/AddProgramacion_operacion_mantenimiento",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                if (resp=='1')
                {
                    swal("REGISTRADO","Se regristró correctamente", "success");
                }
                if (resp=='2')
                {
                    swal("NO SE REGISTRÓ","NO se regristró ", "error");
                }

                $('#Table_funcionamiento').dataTable()._fnAjaxUpdate();
                $('#Table_Programar_operacion_mantenimiento').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            }
        });
    });
    $('#form_AddProgramacion').formValidation({
      excluded: ':disabled',
      fields:
      {
        cbxBrecha:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Brecha" es requerido.</b>'
            }
          }
        },
        txt_saldoprogramar:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Saldo a Programar" es requerido.</b>'
            },
            regexp:
            {
                regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                message: '<b style="color: red;">El campo "Saldo" debe ser númerico.</b>'
            }
          }
        },
        txt_anio1:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Monto de Programación" es requerido.</b>'
            },
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Monto de Programación" debe ser númerico.</b>'
                    }
          }
        },
        txt_anio2:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Monto de Programación" es requerido.</b>'
            },
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Monto de Programación" debe ser númerico.</b>'
                    }
          }
        },
        txt_anio3:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Monto de Programación" es requerido.</b>'
            },
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Monto de Programación" debe ser númerico.</b>'
                    }
          }
        },
      }
    });
    $("body").on("click","#send_addProgramacion",function(e){
      $('#form_AddProgramacion').data('formValidation').validate();
      if($('#form_AddProgramacion').data('formValidation').isValid()==true){
          $('#form_AddProgramacion').submit();
          var txt_codigo_unico_pi=$("#txt_codigo_unico_pi").val();
          var txt_nombre_proyecto=$("#txt_nombre_proyecto").val();
          var txt_costo_proyecto=$("#txt_costo_proyecto").val();
          var txt_pia_fye=$("#txt_pia_fye").val();
          var txt_pim_pia_fye=$("#txt_pim_pia_fye").val();
          var txt_devengado_pia_fye=$("#txt_devengado_pia_fye").val();
          $('#form_AddProgramacion').each(function(){
            this.reset();
          });
          $("#txt_codigo_unico_pi").val(txt_codigo_unico_pi);
          $("#txt_nombre_proyecto").val(txt_nombre_proyecto);
          $("#txt_costo_proyecto").val(txt_costo_proyecto);
          $("#txt_pia_fye").val(txt_pia_fye);
          $("#txt_pim_pia_fye").val(txt_pim_pia_fye);
          $("#txt_devengado_pia_fye").val(txt_devengado_pia_fye);

          $('.selectpicker').selectpicker('refresh');
          $('#form_AddProgramacion').data('formValidation').resetForm();
      }
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
    $("#form_AddMeta_Pi").submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/programar_pip/AddMeta_PI",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp){
             //alert(resp);
             if (resp=='1') {
               swal("REGISTRADO","Se regristró correctamente", "success");

               formReset();
                //location.reload();
                setTimeout("location.reload()", 5000);
             }
              if (resp=='2') {
               swal("NO SE REGISTRÓ","NO se regristró ", "error");

             }
            $('#Table_meta_pi').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion

               formReset();
               //location.reload();
               setTimeout("location.reload()", 5000);
           },
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            }
        });
    });
    function formReset()
    {
      document.getElementById("form_AddProgramacion").reset();
      document.getElementById("form_AddMeta_Pi").reset();
    }

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
            {"data":"codigo_unico_pi"},
            {"data":"nombre_pi"},
            {"data":"nombre_funcion"},
            {"data":"costo_pi"},
            {"data":"nombre_estado_ciclo"},
            {"data": function (data, type, dataToSet)
                {
                    if (data.estado_programado !='0')
                    {
                        return '<h5><span class="label label-success"> Programado</span></h5><div>'+data.anioProgramacion+'</div>';
                    }
                    if (data.estado_programado =='0')
                    {
                        return '<h5><span class="label label-danger">No Programado</span></h5>';
                    }
                }
            },
            {"data":'nombre_pi',render:function(data,type,row)
                {
                    return "<center>  <button type='button' title='Programar' onclick=mostrarPrioridad('"+row.id_pi+"'); class='programar_pip btn btn-warning btn-xs' id='bt_"+row.id_pi+"' data-toggle='modal' data-target='#Ventana_Programar'><i class='fa fa-file-powerpoint-o ' aria-hidden='true'></i></button></center>";//
                }
            }
        ],
        "language":idioma_espanol
    });
    AddProgramacion("#table_formulacion_evaluacion",table);
    AddMeta_Pi("#table_formulacion_evaluacion",table);
}

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
            {"data":"anio_prog"},
            {"data":"monto_prog"},
            {"data":"prioridad_prog"},
            {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
        ],
        "language":idioma_espanol
    });
    EliminarProgramacion("#Table_Programar",table);
}

var EliminarProgramacion=function(tbody,table)
{
    $(tbody).on("click","button.eliminar",function(){
        var data=table.row( $(this).parents("tr")).data();
        var id_pi=data.id_pi;
        var id_cartera=data.id_cartera;
        swal({
            title: "Desea eliminar ?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"Cerrar" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si,Eliminar",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
                url:base_url+"index.php/programar_nopip/EliminarProgramacion",
                type:"POST",
                data:{
                  id_cartera: id_cartera,
                  id_pi: id_pi
                },
                success:function(respuesta)
                {
                    swal("Se eliminó corectamente", ".", "success");
                    $(tbody).dataTable()._fnAjaxUpdate();
                    $('#Table_funcionamiento').dataTable()._fnAjaxUpdate();
                    $('#table_ejecucion').dataTable()._fnAjaxUpdate();
                    $('#table_formulacion_evaluacion').dataTable()._fnAjaxUpdate();
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
            {"data":"avanceFinanciero", "visible": false },
            {"data":"id_pi" ,"visible": false},
            {"data":"codigo_unico_pi"},
            {"data":"nombre_pi"},
            {"data":"nombre_funcion"},
            {"data":"costo_pi"},
            {"data":"nombre_estado_ciclo"},
            {"data": function (data, type, dataToSet)
                {
                    if (data.estado_programado !='0')
                    {
                        return '<h5><span class="label label-success"> Programado</span></h5><div>'+data.anioProgramacion+'</div>';
                    }
                    if (data.estado_programado =='0')
                    {
                        return '<h5><span class="label label-danger">No Programado</span></h5>';
                    }
                }
            },
            {"data":'nombre_pi',render:function(data,type,row)
                {
                    return "<center> <button type='button' title='Programar' onclick=mostrarPrioridad('"+row.id_pi+"'); id='bt_"+row.id_pi+"'  class='programar_pip btn btn-warning btn-xs' data-toggle='modal' data-target='#Ventana_Programar'><i class='fa fa-file-powerpoint-o ' aria-hidden='true'></i></button></center>";
                }
            }
        ],
        "language":idioma_espanol
    });
    AddProgramacion("#table_ejecucion",table);
    AddMeta_Pi("#table_ejecucion",table);
}
//fin de proyectos de inversion en Ejecucion
//listar proyectos de inversion en Funcionamiento
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
                                    {"data":"id_pi" ,"visible": false},
                                    {"data":"codigo_unico_pi"},
                                    {"data":"nombre_pi"},
                                    {"data":"nombre_funcion"},
                                    {"data":"costo_pi"},
                                    {"data":"nombre_estado_ciclo"},
                                    {"data": function (data, type, dataToSet) {

                                      if (data.estado_programado !='0') //estap programado
                                      {
                                       // return '<a  href="#"><button type="button" class="btn btn btn-success btn-xs">Programado</button></a>';
                                       /* var cadena=data.anioProgramacion.split(' ');
                                       var string='';
                                       for(var i=0;i<cadena.length;i++){
                                        var item=cadena[i].split(':');
                                        string+='<a class="linkItem" title="S/. '+item[1]+'">'+item[0]+'<a> ';
                                       }*/
                                       //cadena=data.anioProgramacion;
                                       return '<h5><span class="label label-success"> Programado</span></h5><div>'+data.anioProgramacion+'</div>';

                                       //return '<h5><span class="label label-success"> Programado</span></h5>';
                                      }
                                      if (data.estado_programado =='0') //no esta progrmado
                                      {
                                        //return '<a  href="#"><button type="button" class="btn btn btn-danger btn-xs">No Programado</button></a>';
                                        return '<h5><span class="label label-danger">No Programado</span></h5>';
                                      }
                                   }},
                                   {"data":'nombre_pi',render:function(data,type,row){
                                      return "<center><button type='button' title='Programar' onclick=mostrarPrioridad_operacion_mantenimiento('"+row.id_pi+"');  id='bt_"+row.id_pi+"'  class='programar_pip_operacion_mantenimiento btn btn-warning btn-xs' data-toggle='modal' data-target='#Ventana_Programar_operacion_mantenimiento'><i class='fa fa-file-powerpoint-o ' aria-hidden='true'></i></button></center>";
                                      }
                                    },
                                       /*{"defaultContent":"<center><button type='button' title='Programar' class='programar_pip_operacion_mantenimiento btn btn-warning btn-xs' data-toggle='modal' data-target='#Ventana_Programar_operacion_mantenimiento'><i class='fa fa-file-powerpoint-o ' aria-hidden='true'></i></button></center>"}*/
                                ],
                               "language":idioma_espanol
                    });
     AddProgramacion_oper_man("#Table_funcionamiento",table);
     AddMeta_Pi("#Table_funcionamiento",table);
}
//fin de proyectos de inversion en Funcionamiento
//listar meta proyecto
 var listar_meta_pi=function(id_pi)
                {
                    var table=$("#Table_meta_pi").DataTable({
                      "processing": true,
                      "serverSide":false,
                      destroy:true,
                      "ajax":{
                                     url:base_url+"index.php/programar_nopip/listar_metas_pi",
                                     type:"POST",
                                     data :{id_pi:id_pi}
                                    },
                                "columns":[
                                    {"data":"id_meta_pi","visible": false},
                                    {"data":"anio"},
                                    {"data":"pia_meta_pres"},
                                    {"data":"pim_acumulado"},
                                    {"data":"certificacion_acumulado"},
                                    {"data":"compromiso_acumulado"},
                                    {"data":"devengado_acumulado"},
                                    {"data":"girado_acumulado"},
                                    {"defaultContent":"<button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],
                               "language":idioma_espanol
                    });
                    EliminarMetaPresupuestalPi("#Table_meta_pi",table);
                }

var EliminarMetaPresupuestalPi=function(tbody,table)
{
    $(tbody).on("click","button.eliminar",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var id_meta_pi=data.id_meta_pi;
        swal({
            title: "Desea eliminar ?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"Cerrar" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si,Eliminar",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
                url:base_url+"index.php/programar_pip/Eliminar_meta_prepuestal_pi",
                type:"POST",
                data:{id_meta_pi:id_meta_pi},
                success:function(respuesta)
                {
                    swal("Se eliminó corectamente", "", "success");
                    $('#Table_meta_pi').dataTable()._fnAjaxUpdate();
                    $('#table_formulacion_evaluacion').dataTable()._fnAjaxUpdate();
                    $('#table_ejecucion').dataTable()._fnAjaxUpdate();
                    $('#Table_funcionamiento').dataTable()._fnAjaxUpdate();
                },
                error: function ()
                {
                    swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error");
                }
            });
        });
    });
}

var  AddMeta_Pi=function(tbody,table){
                    $(tbody).on("click","button.meta_pip",function(){
                      var data=table.row( $(this).parents("tr")).data();
                       var  id_pi=data.id_pi;
                       $("#txt_codigo_unico_pi_mp").val(data.codigo_unico_pi);
                      $("#txt_id_pip_programacion_mp").val(data.id_pi);
                      $("#txt_costo_proyecto_mp").val(data.costo_pi);
                      $("#txt_nombre_proyecto_mp").val(data.nombre_pi);
                      listar_Meta();
                      listar_meta_presupuestal();
                       listar_meta_pi(id_pi);
                    });
                }

//add programar para formulacion y evaluacion
var  AddProgramacion=function(tbody,table)
{
    $(tbody).on("click","button.programar_pip",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var  id_pi=data.id_pi;
        var avanceFinanciero=data.avanceFinanciero;
        //alert(avanceFinanciero);
        $("#txt_codigo_unico_pi").val(data.codigo_unico_pi);
        $('#spanAvanceFinanciero').text(avanceFinanciero);
        $("#txt_id_pip_programacion").val(data.id_pi);
        $("#txt_costo_proyecto").val(data.costo_pi);
        $("#txt_nombre_proyecto").val(data.nombre_pi);
        if(data.ultimo_pia_meta_pres!=null && data.ultimo_pia_meta_pres!='')
        $("#txt_pia_fye").val(data.ultimo_pia_meta_pres);
        if(data.devengado_acumulado_total!=null && data.devengado_acumulado_total!='')
        $("#txt_devengado_pia_fye").val(data.devengado_acumulado_total);
        if(data.ultimo_pim_meta_pres!=null && data.ultimo_pim_meta_pres!='')
        $("#txt_pim_pia_fye").val(data.ultimo_pim_meta_pres);
        if(data.nombre_estado_ciclo=='IDEA' || data.nombre_estado_ciclo=='FORMULACION Y EVALUACION')
        {
            $("#ct_anio").css("display","none");
        }
        else
        {
            $("#ct_anio").css("display","");
        }
        $("#txt_saldoprogramar").val(data.saldo);
        listar_aniocartera();
        listar_programacion(id_pi);
    });
}
                //add programar para operacion y manteniemito
var AddProgramacion_oper_man=function(tbody,table)
{
    $(tbody).on("click","button.programar_pip_operacion_mantenimiento",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var  id_pi=data.id_pi;
        $("#txt_codigo_unico_pi_").val(data.codigo_unico_pi);
        $("#txt_id_pip_programacion_").val(data.id_pi);
        $("#txt_costo_proyecto_").val(data.costo_pi);
        $("#txt_nombre_proyecto_").val(data.nombre_pi);
        if(data.ultimo_pia_meta_pres!='' && data.ultimo_pia_meta_pres!=null)
            $("#txt_pia_oper").val(data.ultimo_pia_meta_pres);
        if(data.devengado_acumulado_total!='' && data.devengado_acumulado_total!=null)
            $("#txt_devengado_oper").val(data.devengado_acumulado_total);
        if(data.ultimo_pim_meta_pres!='' && data.ultimo_pim_meta_pres!=null)
            $("#txt_pim_oper").val(data.ultimo_pim_meta_pres);
        if(data.nombre_estado_ciclo=='IDEA' || data.nombre_estado_ciclo=='FORMULACION Y EVALUACION')
        {
            $("#ct_anio").css("display","none");
        }
        else
        {
            $("#ct_anio").css("display","");
        }
        $("#txt_saldoprogramar_oper").val(data.saldo);
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
                            $("#Cbx_AnioCartera_").trigger("change");
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
                           // $('select[name=cbxBrecha_]').change();
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

                             $("#Cbx_AnioCartera").trigger("change");

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
                            //$('select[name=cbxBrecha]').change();
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
                 /*para listar nombres de las metas*/
                var listar_meta_presupuestal=function(valor){
                     var html="";
                    $("#cbx_meta_presupuestal").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/Meta/listar_meta_presupuestal",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_meta_pres"]+"> "+registros[i]["nombre_meta_pres"]+" </option>";
                            };
                            $("#cbx_meta_presupuestal").html(html);
                            $('select[name=cbx_meta_presupuestal]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=cbx_meta_presupuestal]').change();
                            $('.selectpicker').selectpicker('refresh');
                        }
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

var format = function(num){
    var str = num.replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0)
    {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++)
    {
        if(str[j] != ",")
        {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1))
            {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};
