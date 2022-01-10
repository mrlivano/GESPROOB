$(document).on("ready" ,function()
{
    listaBrecha();
    $("#btn-NuevaBrecha").click(function()
    {
        listaSerPubAsocCombo();    
    });

    $("#frmAddBrecha").submit(function(event)
    {
        event.preventDefault();
        $('#validarBrecha').data('formValidation').resetField($('#cbxServPubAsoc'));
        $('#validarBrecha').data('formValidation').resetField($('#txt_NombreBrecha'));
        $('#validarBrecha').data('formValidation').resetField($('#txtArea_DescBrecha'));        
        $('#validarBrecha').data('formValidation').validate();
        if(!($('#validarBrecha').data('formValidation').isValid()))
        {
            return;
        }
        $.ajax({
            url:base_url+"index.php/MantenimientoBrecha/AddBrecha",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                var registros = eval(resp);
                for (var i = 0; i < registros.length; i++) 
                {
                   if(registros[i]["VALOR"]==1)
                   {
                       swal("",registros[i]["MENSAJE"], "success");
                       $('#frmAddBrecha')[0].reset();
                       $("#VentanaRegistraBrecha").modal("hide");
                   }
                   else
                   {
                        swal('',registros[i]["MENSAJE"],'error' )
                   }
                };
                $('#table-brecha').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $("#VentanaRegistraBrecha").modal("hide");
            }
        });
    });
    
    $("#form-ActualizarBrecha").submit(function(event)
    {
        event.preventDefault();
        $('#ActualizarBrecha').data('formValidation').resetField($('#cbxSerPubAsocModificar'));
        $('#ActualizarBrecha').data('formValidation').resetField($('#txt_IdBrechaModif'));
        $('#ActualizarBrecha').data('formValidation').resetField($('#txtArea_DescBrechaU'));        
        $('#ActualizarBrecha').data('formValidation').validate();
        if(!($('#ActualizarBrecha').data('formValidation').isValid()))
        {
            return;
        }
        $.ajax({
            url:base_url+"index.php/MantenimientoBrecha/UpdateBrecha",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                swal("ACTUALIZADO!", resp, "success");
                $('#form-ActualizarBrecha')[0].reset();
                $("#VentanaModificarBrecha").modal("hide");
                $('#table-brecha').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#form-ActualizarBrecha')[0].reset();
                $("#VentanaModificarBrecha").modal("hide");
            }
        });
    }); 
    
               
    listaIndicador();

    $("#form-addIndicador").submit(function(event)
    {
        event.preventDefault();
        $('#validarIndicador').data('formValidation').resetField($('#txt_NombreIndicador'));
        $('#validarIndicador').data('formValidation').resetField($('#txtArea_DefIndicador'));
        $('#validarIndicador').data('formValidation').resetField($('#txt_UnidadMedida'));
        
        $('#validarIndicador').data('formValidation').validate();
        if(!($('#validarIndicador').data('formValidation').isValid()))
        {
            return;
        }
        $.ajax({
            url:base_url+"index.php/Indicador/AddIndicador",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                var registros = eval(resp);
                for (var i = 0; i < registros.length; i++) 
                {
                    if(registros[i]["VALOR"]==1)
                    {
                        swal("",registros[i]["MENSAJE"], "success");
                        $('#form-addIndicador')[0].reset();
                        $("#VentanaRegistraIndicador").modal("hide");
                    }
                    else
                    {
                        swal('',registros[i]["MENSAJE"],'error' )
                    }
                };
                $('#table-Indicador').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#form-addIndicador')[0].reset();
                $("#VentanaRegistraIndicador").modal("hide");
            }
        });
    });

    $("#form-ActualizarIndicador").submit(function(event)
    {
        event.preventDefault();
        $('#actualizarIndicador').data('formValidation').resetField($('#txt_NombreIndicadorU'));
        $('#actualizarIndicador').data('formValidation').resetField($('#txtArea_DefIndicadorU'));
        $('#actualizarIndicador').data('formValidation').resetField($('#txt_UnidadMedidaU'));
        
        $('#actualizarIndicador').data('formValidation').validate();
        if(!($('#actualizarIndicador').data('formValidation').isValid()))
        {
            return;
        }
        $.ajax({
            url:base_url+"index.php/Indicador/UpdateIndicador",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                swal("ACTUALIZADO!", resp, "success");
                $('#form-ActualizarIndicador')[0].reset();
                $("#VentanaModificarIndicador").modal("hide");
                $('#table-Indicador').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#form-ActualizarIndicador')[0].reset();
                $("#VentanaModificarIndicador").modal("hide");
            }
        });

    }); 

    listaServicioPublicoAsociado();
    $("#form-UpdateServicioAsociado").submit(function(event)
    {
        event.preventDefault();
        $('#ValidarServicio').data('formValidation').resetField($('#textarea_servicio_publicoAA'));
        $('#ValidarServicio').data('formValidation').validate();
        if(!($('#ValidarServicio').data('formValidation').isValid()))
        {
            return;
        }

        $.ajax({
            url:base_url+"index.php/ServicioPublico/UpdateServicioAsociado",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                swal("",resp, "success");
                $('#UpdateServicioAsociado').modal('hide');
                $('#tableServicioPublicoAsociado').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#UpdateServicioAsociado').modal('hide');
            }
        });
    }); 
});

$(function()
{
    $('#frmRegistroServicioPublico').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            textarea_servicio_publicoA:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Nombre de Servicio Público asociado" es requerido.</b>'
                    }
                }
            }
        }
    });
    
    $('#ValidarServicio').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            textarea_servicio_publicoAA:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Nombre de Servicio Público asociado" es requerido.</b>'
                    }
                }
            }
        }
    });

    $('#validarIndicador').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            txt_NombreIndicador:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                    }
                }
            },
            txtArea_DefIndicador:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Definición" es requerido.</b>'
                    }
                }
            },
            txt_UnidadMedida:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Unidad de Medida" es requerido.</b>'
                    }
                }
            }
        }
    });
    $('#actualizarIndicador').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            txt_NombreIndicadorU:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                    }
                }
            },
            txtArea_DefIndicadorU:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Definicion" es requerido.</b>'
                    }
                }
            },
            txt_UnidadMedidaU:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Unidad de Medida" es requerido.</b>'
                    }
                }
            }
        }
    });
    $('#validarBrecha').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            cbxServPubAsoc:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Servicio Público asociado" es requerido.</b>'
                    }
                }
            },
            txt_NombreBrecha:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                    }
                }
            },
            txtArea_DescBrecha:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Descripcion" es requerido.</b>'
                    }
                }
            }
        }
    });
    $('#ActualizarBrecha').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            cbxSerPubAsocModificar:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Servicio Público Asociado" es requerido.</b>'
                    }
                }
            },
            txt_IdBrechaModif:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                    }
                }
            },
            txtArea_DescBrechaU:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Descripcion" es requerido.</b>'
                    }
                }
            }
        }
    });
});

var listaServicioPublicoAsociado=function()
{
    var table=$("#tableServicioPublicoAsociado").DataTable({

    "processing":true,
    "serverSide":false,
    destroy:true,
    "ajax":{
        "url":base_url+"index.php/ServicioPublico/GetServicioAsociado",
        "method":"POST",
        "dataSrc":""
    },
    "columns":[
        {"data":"id_serv_pub_asoc"},
        {"data":"nombre_serv_pub_asoc"},
        {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#UpdateServicioAsociado'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
    ],
    "language":idioma_espanol
    });
    ServicioPublicoDataActualizar("#tableServicioPublicoAsociado",table) ;
    EliminarServicioLista("#tableServicioPublicoAsociado",table);//TRAER LA DATA DE LAS BRECHAS PARA ELIMINAR  
}

var ServicioPublicoDataActualizar=function(tbody,table)
{
    $(tbody).on("click","button.editar",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var id_servicio_publicoA=$('#id_servicio_publicoA').val(data.id_serv_pub_asoc);
        var textarea_servicio_publicoAA=$('#textarea_servicio_publicoAA').val(data.nombre_serv_pub_asoc);

    });
}

var EliminarServicioLista=function(tbody,table)
{
    $(tbody).on("click","button.eliminar",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var id_servicio=data.id_serv_pub_asoc;
        swal({
                title: "Esta seguro que desea eliminar el servicio?",
                text: "",
                type: "warning",
                showCancelButton: true,
                cancelButtonText:"Cerrar" ,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "SI,Eliminar",
                closeOnConfirm: false
            },
        function()
        {
            $.ajax({
                url:base_url+"index.php/ServicioPublico/EliminarServicioPublico",
                type:"POST",
                data:{id_servicio:id_servicio},
                success:function(respuesta)
                {
                    swal("ELIMINADO!", "Se elimino correctamente la brecha.", "success");
                    $('#tableServicioPublicoAsociado').dataTable()._fnAjaxUpdate();
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
    "oPaginate": 
    {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": 
    {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}

function guardarServicio()
{
    event.preventDefault();
    $('#frmRegistroServicioPublico').data('formValidation').validate();
    if(!($('#frmRegistroServicioPublico').data('formValidation').isValid()))
    {
        return;
    }
    $.ajax({
        url:base_url+"index.php/ServicioPublico/AddServicioAsociado",
        type:'POST',
        encoding:"UTF-8",
        data:$('#frmRegistroServicioPublico').serialize(),
        success:function(resp)
        {
            resp=JSON.parse();
            swal(resp.proceso, resp.mensaje, (resp.proceso=="Correcto" ? "success":"error"));
            $('#tableServicioPublicoAsociado').dataTable()._fnAjaxUpdate();
            $("#VentanaRegistraServicioAsociado").modal("hide");
        },
        error: function ()
        {
            swal("Error", "Usted no tiene permisos para realizar esta acción", "error");
            $("#VentanaRegistraServicioAsociado").modal("hide");
        }
    });

}

var listaSerPubAsocCombo=function(id_serv_pub_asoc)
{
    html="";
    $("#cbxServPubAsoc").html(html);
    $("#cbxSerPubAsocModificar").html(html); 
    event.preventDefault(); 
    $.ajax({
        "url":base_url +"index.php/ServicioPublico/GetServicioAsociado",
        type:"POST",
        success:function(respuesta)
        {
            var registros = eval(respuesta);
            for (var i = 0; i <registros.length;i++) 
            {
                html +="<option value="+registros[i]["id_serv_pub_asoc"]+"> "+ registros[i]["nombre_serv_pub_asoc"]+" </option>";   
            };
            $("#cbxServPubAsoc").html(html);
            $("#cbxSerPubAsocModificar").html(html);
            $('select[name=cbxSerPubAsocModificar]').val(id_serv_pub_asoc)
            $('select[name=cbxSerPubAsocModificar]').change();
            $('.selectpicker').selectpicker('refresh'); 
        }
    });
}

var listaBrecha=function() 
{
    var table=$("#table-brecha").DataTable({
    "processing":true,
    "serverSide":false,
    destroy:true,
        "ajax":{
            "url":base_url +"index.php/MantenimientoBrecha/GetBrecha",
            "method":"POST",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_brecha"},
            {"data":"id_serv_pub_asoc"},
            {"data":"nombre_serv_pub_asoc"}, //DATO DEL SERVICIO PUB ASOCIADO PARA ENVIAR DATO AL COMBO ACTUALIZAR Y SE MANTENGA EL VALOR
            {"data":"nombre_brecha"},
            {"data":"descripcion_brecha"},
            {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarBrecha'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
        ],

        "language":idioma_espanol
    });  
    BrechaData("#table-brecha",table); //TRAER LA DATA DE LAS BRECHAS PARA ACTUALIZAR
    EliminarBrechaLista("#table-brecha",table);//TRAER LA DATA DE LAS BRECHAS PARA ELIMINAR             
}

var BrechaData=function(tbody,table){
    $(tbody).on("click","button.editar",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var id_brecha=$('#txt_IdBrechaModif').val(data.id_brecha);
        var id_serv_pub_asoc=data.id_serv_pub_asoc;
        var nombre_brecha=$('#txt_NombreBrechaU').val(data.nombre_brecha);
        var descripcion_brecha=$('#txtArea_DescBrechaU').val(data.descripcion_brecha);
        listaSerPubAsocCombo(id_serv_pub_asoc);
    });
}

var EliminarBrechaLista=function(tbody,table)
{
    $(tbody).on("click","button.eliminar",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var id_brecha=data.id_brecha;
        swal({
            title: "Esta seguro que desea eliminar la brecha?",
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
                url:base_url+"index.php/MantenimientoBrecha/DeleteBrecha",
                type:"POST",
                data:{id_brecha:id_brecha},
                success:function(respuesta)
                {
                    swal("ELIMINADO!", "Se elimino correctamente la brecha.", "success");
                    $('#table-brecha').dataTable()._fnAjaxUpdate();
                },
                error: function ()
                {
                    swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                }        
            });
        });
    });
}

var listaIndicador=function() 
{
    var table=$("#table-Indicador").DataTable({
     "processing":true,
     "serverSide":false,
     destroy:true,
        "ajax":{
            "url":base_url +"index.php/Indicador/GetIndicador",
            "method":"POST",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_indicador"},
            {"data":"nombre_indicador"},
            {"data":"definicion_indicador"},
             {"data":"unidad_medida_indicador"},
           {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarIndicador'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
        ],

        "language":idioma_espanol
    });  
    IndicadorData("#table-Indicador",table);                          
    EliminarIndicador("#table-Indicador",table);
}

var IndicadorData=function(tbody,table)
{
    $(tbody).on("click","button.editar",function(){
        var data=table.row( $(this).parents("tr")).data();
        var id_indicador=$('#txt_IdIndicadorModif').val(data.id_indicador);
        var nombre_indicador=$('#txt_NombreIndicadorU').val(data.nombre_indicador);
        var definicion_indicador=$('#txtArea_DefIndicadorU').val(data.definicion_indicador);
        var unidad_medida_indicador=$('#txt_UnidadMedidaU').val(data.unidad_medida_indicador);
    });
}

var EliminarIndicador=function(tbody,table)
{
    $(tbody).on("click","button.eliminar",function(){
        var data=table.row( $(this).parents("tr")).data();
        var id_indicador=data.id_indicador;
        swal({
                title: "Esta seguro que desea eliminar el indicador?",
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
            url:base_url+"index.php/Indicador/DeleteIndicador",
            type:"POST",
            data:{id_indicador:id_indicador},
            success:function(respuesta)
            {
               swal("ELIMINADO!", "Se elimino correctamente el indicador.", "success");
              $('#table-Indicador').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
            });
        });
    });
}
