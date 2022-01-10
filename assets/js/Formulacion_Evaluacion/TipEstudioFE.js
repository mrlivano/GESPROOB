$(document).on("ready" ,function()
{
    listaTipEstudioFE();
    $("#form-addTipoEstudioFE").submit(function(event)//para añadir nueva funcion
    {
        event.preventDefault();
        $('#ValidarNuevoTipoEstudio').data('formValidation').resetField($('#txt_tipoEstudioFE'));
        $('#ValidarNuevoTipoEstudio').data('formValidation').validate();
        if(!($('#ValidarNuevoTipoEstudio').data('formValidation').isValid()))
        {
            return;
        }
        $.ajax({
            url:base_url+"index.php/TipEstudioFE/AddTipoEstudioFE",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                swal("",resp, "success");
                $('#form-addTipoEstudioFE')[0].reset();
                $("#VentanaTipoEstudio").modal("hide");
                $('#table-TipEstudioFE').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#form-addTipoEstudioFE')[0].reset();
                $("#VentanaTipoEstudio").modal("hide");
            }
        });
    });

    $("#form-UpdateTipoEstudioFE").submit(function(event)//para añadir nueva funcion
    {
        event.preventDefault();
        $('#ActualizarTipoEstudio').data('formValidation').resetField($('#txt_tipoEstudioFEModi'));
        $('#ActualizarTipoEstudio').data('formValidation').validate();
        if(!($('#ActualizarTipoEstudio').data('formValidation').isValid()))
        {
            return;
        }
        $.ajax({
            url:base_url+"index.php/TipEstudioFE/UpdateTipoEstudioFE",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                swal("",resp, "success");
                $('#form-UpdateTipoEstudioFE')[0].reset();
                $("#ventanaActualizarTipoEstudio").modal("hide");
                $('#table-TipEstudioFE').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $("#ventanaActualizarTipoEstudio").modal("hide");
            }
        });
    });
});

$(function()
{
    $('#ValidarNuevoTipoEstudio').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            txt_tipoEstudioFE:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Tipo de Estudio" es requerido.</b>'
                    }
                }
            }
        }
    });
    $('#ActualizarTipoEstudio').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            txt_tipoEstudioFEModi:
            {
                validators: 
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Tipo de Estudio" es requerido.</b>'
                    }
                }
            }
        }
    });
});

var listaTipEstudioFE=function()
{
    var table=$("#table-TipEstudioFE").DataTable({
    "processing": true,
    "serverSide":false,
    destroy:true,

        "ajax":{
                "url":base_url+"index.php/TipEstudioFE/GetTipEstudioFE",
                "method":"POST",
                "dataSrc":""
                },
            "columns":[
                {"data":"id_tipo_est","visible": false},
                {"data":"nombre_tipo_est"},
                {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#ventanaActualizarTipoEstudio'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
            ],
        "language":idioma_espanol
    });
    FENivelEstudio("#table-TipEstudioFE",table);
    EliminarTipoLista("#table-TipEstudioFE",table);
}

var  FENivelEstudio=function(tbody,table){
    $(tbody).on("click","button.editar",function()
    {
        var data=table.row( $(this).parents("tr")).data();
          $("#id_tipoEstudioFEModi").val(data.id_tipo_est);
          $("#txt_tipoEstudioFEModi").val(data.nombre_tipo_est);
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

var EliminarTipoLista=function(tbody,table)
{
    $(tbody).on("click","button.eliminar",function()
    {
        var data=table.row( $(this).parents("tr")).data();
        var id_tipo_est=data.id_tipo_est;
        swal({
                title: "Esta seguro que desea eliminar el tipo?",
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
            url:base_url+"index.php/TipEstudioFE/deleteTipoEstudioFE",
            type:"POST",
            data:{id_tipoEstudioFE:id_tipo_est},
            success:function(respuesta)
            {
                swal("ELIMINADO!", "SE ELIMINO UN TIPO DE ESTUDIO EN FORMULACION Y EVALUACION", "success");
                $('#table-TipEstudioFE').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
            });
        });
    });
}
