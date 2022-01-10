function mostrarPrioridad(proyecto){
  $.getJSON(base_url+"index.php/criterio/getPrioridad/"+proyecto,function(json){
    $("#txt_prioridad").val(json[0]['n']);
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
          swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
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
$(document).on("ready" ,function()
{
    lista_no_pip();
    $("#txt_saldoprogramar").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_anio1").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("body").on("click","#send_addProgramacion",function(e){
        $('#validarRegistroProgramarNoPip').data('formValidation').validate();
        if(!($('#validarRegistroProgramarNoPip').data('formValidation').isValid()))
        {
            return;
        }
        $('#form_AddProgramacion').submit();
        var txt_codigo_unico_pi=$("#txt_codigo_unico_pi").val();
        var txt_nombre_proyecto=$("#txt_nombre_proyecto").val();
        var txt_costo_proyecto=$("#txt_costo_proyecto").val();
        var txt_pia_fye=$("#txt_pia_fye").val();
        var txt_pim_pia_fye=$("#txt_pim_pia_fye").val();
        var txt_devengado_pia_fye=$("#txt_devengado_pia_fye").val();
        $('#form_AddProgramacion').each(function()
        { 
            this.reset();
        });
        $("#txt_codigo_unico_pi").val(txt_codigo_unico_pi);
        $("#txt_nombre_proyecto").val(txt_nombre_proyecto);
        $("#txt_costo_proyecto").val(txt_costo_proyecto);
        $("#txt_pia_fye").val(txt_pia_fye);
        $("#txt_pim_pia_fye").val(txt_pim_pia_fye);
        $("#txt_devengado_pia_fye").val(txt_devengado_pia_fye);

        $('.selectpicker').selectpicker('refresh');
        $('#form_AddProgramacion')[0].reset();
    });
     $("#form_AddProgramacion").submit(function(event)
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/programar_nopip/AddProgramacion",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           //alert(resp);
                           if (resp=='1') {
                             swal("REGISTRADO","Se regristró correctamente", "success");
                             //formReset();
                           }
                            if (resp=='2') {
                             swal("NO SE REGISTRÓ","NO se regristró ", "error");
                           }
                          $('#Table_Programar').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion
                          $('#table_NoPip').dataTable()._fnAjaxUpdate();
                            // formReset();
                         }
                         ,
                        error: function ()
                        {
                            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                        }
                      });
                  });
     $("#form_AddMeta_Pi").submit(function(event)
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/programar_nopip/AddMeta_PI",
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
                          $('#Table_meta_pi').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion
                             
                             formReset();
                         }
                         ,
                        error: function ()
                        {
                            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
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
var lista_no_pip=function()
{
    var table=$("#table_NoPip").DataTable({
    "processing": true,
    "serverSide":false,
    destroy:true,
    "ajax":{
            "url":base_url+"index.php/programar_nopip/Get_no_pip",
            "method":"POST",
            "dataSrc":""                                    
            },
        "columns":[
            {"defaultContent":"<td>#</td>"},
            {"data":"codigo_unico_pi"},
            {"data":"nombre_pi"},
            {"data":"nombre_funcion"},
            {"data":"costo_pi"},
            {"data":"desc_tipo_nopip"},
            {"data": function (data, type, dataToSet) {

                if (data.estado_programado !='0')
                {
                    return '<h5><span class="label label-success"> Programado</span></h5><div>'+data.anioProgramacion+'</div>';
                }
                if (data.estado_programado =='0') //no esta progrmado
                {
                    return '<h5><span class="label label-danger">No Programado</span></h5>';
                }
            }},
            {"data":'nombre_pi',render:function(data,type,row)
                {
                    return "<center> <button type='button' title='Programar' class='programar_pip btn btn-warning btn-xs' data-toggle='modal' data-target='#Ventana_Programar' onclick=mostrarPrioridad('"+row.id_pi+"'); id='bt_"+row.id_pi+"'  ><i class='fa fa-file-powerpoint-o ' aria-hidden='true'></i></button></center>";
                }
            },
        ],
        "language":idioma_espanol
    });
    AddProgramacion("#table_NoPip",table);
    AddMeta_Pi("#table_NoPip",table);
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
                                     url:base_url+"index.php/programar_nopip/listar_programacion",
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
                                          success:function(respuesta)
                                          {
                                            swal("Se eliminó corectamente", ".", "success");
                                            $('#Table_Programar').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                                            $('#table_NoPip').dataTable()._fnAjaxUpdate();
                                          },
                                          error: function ()
                                          {
                                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                                          }
                                        });
                              });
                    });
                }



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
                    EliminarMetaPresupuestal("#Table_meta_pi",table);
                }
//Eliminar Meta Presupuestal
var EliminarMetaPresupuestal=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_meta_pi=data.id_meta_pi;
                        console.log(data);
                         swal({
                                title: "Desea eliminar?",
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
                                          url:base_url+"index.php/programar_nopip/EliminarMetaPI",
                                          type:"POST",
                                          data:{id_meta_pi:id_meta_pi},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Se eliminó corectamente", ".", "success");
                                            $('#Table_meta_pi').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                                          },
                                          error: function ()
                                          {
                                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                                          }
                                        });
                              });
                    });
                }
//Agregar META PIP
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

//add operacion y manteniemito
   var  AddProgramacion=function(tbody,table){
                    $(tbody).on("click","button.programar_pip",function(){
                      var data=table.row( $(this).parents("tr")).data();
                       var  id_pi=data.id_pi;
                       $("#txt_codigo_unico_pi").val(data.codigo_unico_pi);
                      $("#txt_id_pip_programacion").val(data.id_pi);
                      $("#txt_costo_proyecto").val(data.costo_pi);
                      $("#txt_nombre_proyecto").val(data.nombre_pi);
                      $("#txt_pia_nopip").val(data.ultimo_pia_meta_pres);
                      $("#txt_devengado_nopip").val(data.devengado_acumulado_total);
                      $("#txt_pim_nopip").val(data.ultimo_pim_meta_pres);
if (parseFloat(data.ultimo_pim_meta_pres)>0) {
 // alert("nuevo");
    costopi=parseFloat(data.costo_pi)-parseFloat(data.ultimo_pim_meta_pres)-parseFloat(data.devengado_acumulado_total);
                    $("#txt_saldoprogramar").val(costopi); 
}
if (data.ultimo_pim_meta_pres==""|| parseFloat(data.ultimo_pim_meta_pres)=="0.00") {
 // alert("vacio");
    costopi=parseFloat(data.costo_pi)-parseFloat(data.ultimo_pia_meta_pres)-parseFloat(data.devengado_acumulado_total);
                    $("#txt_saldoprogramar").val(costopi); 
}

                 

                        listar_aniocartera();
                        listar_programacion(id_pi);

                    });
                }
                 var listar_aniocartera=function(valor){
                     html="";
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
$(function()
{   
    $('#validarRegistroProgramarNoPip').formValidation({
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúreseeee que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {

            Cbx_AnioCartera:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Año cartera" es requerido.</b>'
                    }
                }
            },
            cbxBrecha:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Brecha " es requerido.</b>'
                    }
                }
            },
            txt_saldoprogramar:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Saldo" es requerido.</b>'
                    },
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Monto de Operación" debe ser númerico.</b>'
                    }
                }
            },
            txt_anio1:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Monto Programación" es requerido.</b>'
                    },
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Monto Programación" debe ser númerico.</b>'
                    }
                }
            },
        }
    });
});
