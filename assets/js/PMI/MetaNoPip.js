$(document).on("ready" ,function()
{
    lista_no_pip();/*llamar a mi datatablet listar proyectosinverision*/
    listar_Meta();
    listar_meta_presupuestal();
    /*listar_meta_pi(id_pi);*/
    $("#txt_pia").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_pim").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_certificado").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_compromiso").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_devengado").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txt_girado").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });

    $("#form_AddProgramacion").submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/programar_nopip/AddProgramacion",
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
                $('#Table_Programar').dataTable()._fnAjaxUpdate();
                $('#table_NoPip').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
        });
    });
    $("#form_AddMeta_Pi").submit(function(event)
    {
        event.preventDefault();
        $('#validarMeta').data('formValidation').resetField($('#txt_anio_meta'));
        $('#validarMeta').data('formValidation').resetField($('#txt_codigo_unico_pi_mp'));
        $('#validarMeta').data('formValidation').resetField($('#txt_nombre_proyecto_mp'));
        $('#validarMeta').data('formValidation').resetField($('#txt_costo_proyecto_mp'));
        $('#validarMeta').data('formValidation').resetField($('#cbx_meta_presupuestal'));        
        $('#validarMeta').data('formValidation').resetField($('#cbx_Meta'));          
        $('#validarMeta').data('formValidation').resetField($('#txt_pia'));
        $('#validarMeta').data('formValidation').resetField($('#txt_pim'));
        $('#validarMeta').data('formValidation').resetField($('#txt_certificado'));
        $('#validarMeta').data('formValidation').resetField($('#txt_compromiso'));
        $('#validarMeta').data('formValidation').resetField($('#txt_devengado'));
        $('#validarMeta').data('formValidation').resetField($('#txt_girado'));
        $('#validarMeta').data('formValidation').validate();
        if(!($('#validarMeta').data('formValidation').isValid()))
        {
            return;
        }
        $.ajax({
            url:base_url+"index.php/programar_nopip/AddMeta_PI",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                if (resp=='1') 
                {
                    swal("REGISTRADO","Se regristró correctamente", "success");
                    formReset();
                }
                if (resp=='2') 
                {
                    swal("NO SE REGISTRÓ","NO se regristró ", "error");
                }
                $('#Table_meta_pi').dataTable()._fnAjaxUpdate();
                formReset();
            },
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
function formatNumber(value) 
{
    nStr += '';
    var x = value.split('.');
    var x1 = x[0];
    alert(x1);

    x1.replace(/\D/g, "")
            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            return 
}

$(function()
{
    $('#validarMeta').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,        
        fields:
        {
            txt_anio_meta:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Año" es requerido.</b>'
                    },
                    regexp:
                    {
                        regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
                        message: '<b style="color: red;">El campo "Año" debe ser un numero de 4 digitos.</b>'
                    }
                }
            },
            cbx_meta_presupuestal:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Meta Presupuestal" es requerido.</b>'
                    }
                }
            },
            cbx_Meta:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Correlativo Meta" es requerido.</b>'
                    }
                }
            },
            txt_pia:
            {
                validators: 
                {
    
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "PIA" debe ser númerico.</b>'
                    }
                }
            },
            txt_pim:
            {
                validators: 
                {
     
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "PIM" debe ser númerico.</b>'
                    }
                }
            },
            txt_certificado:
            {
                validators: 
                {
    
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Certificado" debe ser númerico.</b>'
                    }
                }
            },
            txt_compromiso:
            {
                validators: 
                {

                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Compromiso" debe ser númerico.</b>'
                    }
                }
            },
            txt_devengado:
            {
                validators: 
                {
     
                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Devengado" debe ser númerico.</b>'
                    }
                }
            },
            txt_girado:
            {
                validators: 
                {

                    regexp:
                    {
                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        message: '<b style="color: red;">El campo "Girado" debe ser númerico.</b>'
                    }
                }
            }
        }
    });
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
                                    {"data":"costo_pi"},
                                    {"data":"desc_tipo_nopip"},
                                    {"defaultContent":"<center><button type='button' title='Meta Presupuestal PIP' class='meta_pip btn btn-success btn-xs' data-toggle='modal' data-target='#Ventana_Meta_Presupuestal_PI'><i class='fa fa-usd' aria-hidden='true'></i></button></center>"}
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
                                          success:function(respuesta){
                                            //alert(respuesta);
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
var  AddMeta_Pi=function(tbody,table)
{
    $(tbody).on("click","button.meta_pip",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var  id_pi=data.id_pi;
        $("#txt_codigo_unico_pi_mp").val(data.codigo_unico_pi);
        $("#txt_id_pip_programacion_mp").val(data.id_pi);
        $("#txt_costo_proyecto_mp").val(data.costo_pi);
        $("#txt_nombre_proyecto_mp").val(data.nombre_pi);
        //listar_Meta();
        //listar_meta_presupuestal();
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
