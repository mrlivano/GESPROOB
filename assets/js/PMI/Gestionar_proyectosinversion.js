$(document).on("ready", function()
{
    listar_proyectos_inversion();

    $("#form_AddEstadoCiclo").submit(function(event) 
    {
        event.preventDefault();
        $('#validarCicloPI').data('formValidation').validate();
        if (!($('#validarCicloPI').data('formValidation').isValid())) 
        {
            return;
        }
        $.ajax({

            url:base_url+"index.php/bancoproyectos/AddEstadoCicloPI",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                resp = JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));
                $('#Table_Estado_Ciclo').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
        });
    });
});


var listar_proyectos_inversion = function() 
{
    var table = $("#table_proyectos_inversion").DataTable({
        "processing": true,
        "serverSide": false,
        destroy: true,
        "ajax": {
            "url": base_url + "index.php/bancoproyectos/GetProyectoInversion",
            "method": "POST",
            "dataSrc": ""
        },
        "columns":[
        {"data": function (data, type) 
            {
                return "<a onclick='editarProyectoInversion("+data.id_pi+")'  class='btn btn-primary btn-xs'><i class='fa fa-edit' aria-hidden='true'></i></a>"
            }
        }, 
        { "data": "id_pi", "visible": false }, 
        { "data": "codigo_unico_pi" },
        { "data": "nombre_pi" }, 
        { "data": "costo_pi" }, 
        { "data": "nombre_estado_ciclo" }, 
        { "data": "fecha_viabilidad_pi" }, 
        { "data": function (data, type) 
            {
                return "<div class='btn-group'><button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button' aria-expanded='false'>Opciones <span class='caret'>"+
                "</span></button><ul class='dropdown-menu'>"+
                "<li><button type='button' class='ubicacion_geografica btn btn-primary btn-xs all' data-toggle='modal' data-target='#venta_ubicacion_geografica'><i class='fa fa-map-marker' aria-hidden='true'></i> Ubicación</button></li>"+
                "<li><button type='button' onclick='agregarRubro("+data.id_pi+")' class='btn btn-info btn-xs all' ><i class='fa fa-spinner' aria-hidden='true'></i> Rubro</button></li>"+
                "<li><button type='button' class='btn btn-warning btn-xs all' onclick='modalidadEjecucion("+data.id_pi+")'><i class='fa fa-flag' aria-hidden='true'> Modalidad de Ejecución</i></button></li>"+
                "<li><button type='button' class='btn btn-success btn-xs all' onclick='estadoCiclo("+data.id_pi+")'><i class='fa fa-paw' aria-hidden='true'> Ver Estado Ciclo</i></button></li>"+
                "<li><button type='button' class='btn btn-info btn-xs all' onclick='operacionMantenimieto("+data.id_pi+")'><i class='fa fa-building' aria-hidden='true'> Operación y Mantenimiento</i></button></li>"+
                "<li><button type='button' class='btn btn-primary btn-xs all' onclick='metaPresupuestal("+data.id_pi+")'><i class='fa fa-list' aria-hidden='true'> Meta</i></button></li>"+                
                "</ul></div>";
            }
        }
    ],
        "language": idioma_espanol
    });
    AddListarUbigeo("#table_proyectos_inversion", table);
}

var filtrarProyectoInversion1 = function(idUnidadEjecutora,idOficina) 
{
    var table = $("#table_PIPs_filtro").DataTable({
    "processing": true,
    "serverSide": false,
    destroy: true,
    "ajax": 
    {
        url: base_url + "index.php/bancoproyectos/filtrarProyectoInversion",
        type: "POST",
         data:{"idUnidadEjecutora":idUnidadEjecutora,
                "idOficina":idOficina
                },
        "dataSrc":"",
    },
    "columns": [
       {"data": function (data, type) 
            {
                return "<a onclick='editarProyectoInversion("+data.id_pi+")'  class='btn btn-primary btn-xs'><i class='fa fa-edit' aria-hidden='true'></i></a>"
            }
        }, 
        { "data": "id_pi", "visible": false }, 
        { "data": "codigo_unico_pi" },
        { "data": "nombre_pi" }, 
        { "data": "costo_pi" }, 
        { "data": "nombre_estado_ciclo" }, 
        { "data": "fecha_viabilidad_pi" }, 
        { "data": function (data, type) 
            {
                return "<div class='btn-group'><button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button' aria-expanded='false'>Opciones <span class='caret'>"+
                "</span></button><ul class='dropdown-menu'>"+
                "<li><button type='button' class='ubicacion_geografica btn btn-primary btn-xs all' data-toggle='modal' data-target='#venta_ubicacion_geografica'><i class='fa fa-map-marker' aria-hidden='true'></i> Ubicación</button></li>"+
                "<li><button type='button' onclick='agregarRubro("+data.id_pi+")' class='btn btn-info btn-xs all' ><i class='fa fa-spinner' aria-hidden='true'></i> Rubro</button></li>"+
                "<li><button type='button' class='btn btn-warning btn-xs all' onclick='modalidadEjecucion("+data.id_pi+")'><i class='fa fa-flag' aria-hidden='true'> Modalidad de Ejecución</i></button></li>"+
                "<li><button type='button' class='btn btn-success btn-xs all' onclick='estadoCiclo("+data.id_pi+")'><i class='fa fa-paw' aria-hidden='true'> Ver Estado Ciclo</i></button></li>"+
                "<li><button type='button' class='btn btn-info btn-xs all' onclick='operacionMantenimieto("+data.id_pi+")'><i class='fa fa-building' aria-hidden='true'> Operación y Mantenimiento</i></button></li>"+
                "<li><button type='button' class='btn btn-primary btn-xs all' onclick='metaPresupuestal("+data.id_pi+")'><i class='fa fa-list' aria-hidden='true'> Meta</i></button></li>"+                
                "</ul></div>";
            }
        }],
       "language": idioma_espanol
    });
    AddListarUbigeo("#table_PIPs_filtro", table);
}
function editarProyectoInversion(codigo)
{
    paginaAjaxDialogo(null, 'Editar Proyecto de Inversión', {codigo: codigo}, base_url+'index.php/ProyectoInversion/editar', 'GET', null, null, false, true);
}

function agregarRubro(codigo)
{
    paginaAjaxDialogo(null, 'Rubro del Proyecto de Inversión', {codigo:codigo}, base_url+'index.php/PMI_RubroPi/insertar', 'GET', null, null, false, true);
}

function modalidadEjecucion(codigo)
{
    paginaAjaxDialogo(null, 'Modalidad de Ejecución', {codigo:codigo}, base_url+'index.php/PMI_ModalidadPi/insertar', 'GET', null, null, false, true);
}

function estadoCiclo(codigo)
{
    paginaAjaxDialogo(null, 'Ciclo', {codigo:codigo}, base_url+'index.php/PMI_EstadoPi/insertar', 'GET', null, null, false, true);
}

function operacionMantenimieto(codigo)
{
    paginaAjaxDialogo(null, 'Operación y Mantenimiento', {codigo:codigo}, base_url+'index.php/PMI_OperacionMantenimientoPi/insertar', 'GET', null, null, false, true);
}

function metaPresupuestal(codigo)
{
    paginaAjaxDialogo(null, 'Meta Presupuestal', {codigo:codigo}, base_url+'index.php/PMI_MetaPresupuestalPi/insertar', 'GET', null, null, false, true);
}

var AddListarUbigeo = function(tbody, table) 
{
    $(tbody).on("click", "button.ubicacion_geografica", function() {
        var data = table.row($(this).parents("tr")).data();
        var id_pi = data.id_pi;
        var nombre_pi = data.nombre_pi;
        $("#txt_id_pip").val(data.id_pi);
        $("#nombreProyecto").val(nombre_pi);
        listar_provincia();
        listar_ubigeo_pi(id_pi);

        setTimeout('initialize()',500);
    });
}

var listar_ubigeo_pi = function(id_pi) 
{
    var table = $("#TableUbigeoProyecto_x").DataTable({
    "processing": true,
    "serverSide": false,
    destroy: true,
    "ajax": 
    {
        url: base_url + "index.php/bancoproyectos/Get_ubigeo_pip",
        type: "POST",
        data: { id_pi: id_pi }
    },
    "columns": [
        {"data": "provincia"}, 
        {"data": "distrito"}, 
        {"data": "latitud"}, 
        {"data": "longitud"}, 
        {"data": "url_img",
            "render": function(data, type, row, meta) 
            {
                if (data == null) 
                {
                    return '<p>Sin Imagen</p>';
                } 
                else 
                {
                    url = base_url + "uploads/ImgUbicacionProyecto/" + data;
                    return '<a href="'+url+'" target="_blank"><img height="20" width="20" src="' + url + '" /></a>';
                }
            }
        },
        {"data": 'id_ubigeo_pi',
            render: function(data, type, row) 
            {
                return "<button type='button'  data-toggle='tooltip'  class='editar btn btn-danger btn-xs' data-toggle='modal' onclick=eliminarUbigeo(" + data + ",this)><i class='ace-icon fa fa-trash-o bigger-120'></i></button>";
            
            }
        }],
        "language": idioma_espanol
    });
}

var eliminarUbigeo = function(id_ubigeo_pi, element) 
{
    swal({
        title: "Se eliminará el Ubigeo. ¿Realmente desea proseguir con la operación?",
        text: "",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cerrar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "SI,Eliminar",
        closeOnConfirm: false
    }, function() {
        paginaAjaxJSON({
            "id_ubigeo_pi": id_ubigeo_pi
        }, base_url + 'index.php/bancoproyectos/eliminarUbigeo', 'POST', null, function(objectJSON) {
            objectJSON = JSON.parse(objectJSON);
            swal({
                title: '',
                text: objectJSON.mensaje,
                type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
            }, function() {});
            $(element).parent().parent().remove();
        }, false, true);
    });
}

function agregarUbigeoPi()
{
    event.preventDefault();
    $('#validarUbigeoPiPip').data('formValidation').validate();
    if(!($('#validarUbigeoPiPip').data('formValidation').isValid()))
    {
        return;
    }
    var formData=new FormData($("#form_AddUbigeo")[0]);
    $.ajax({
        type:"POST",
        enctype: 'multipart/form-data',
        url:base_url+"index.php/bancoproyectos/Add_ubigeo_proyecto",
        data: formData,
        cache: false,
        contentType:false,
        processData:false,
        success:function(resp)
        {
            resp = JSON.parse(resp);
            ((resp.proceso == 'Correcto') ? swal(resp.proceso, resp.mensaje, "success") : swal(resp.proceso, resp.mensaje, "error"));
            $('#TableUbigeoProyecto_x').dataTable()._fnAjaxUpdate();
        },
        error: function ()
        {
            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
        }
    });
}

$("#cbx_provincia").change(function() 
{
    var nombre_distrito = $("#cbx_provincia").val();
    listar_distrito(nombre_distrito);
});

var listar_provincia = function(valor) 
{
    html = "";
    $("#cbx_provincia").html(html);
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/bancoproyectos/listar_provincia",
        type: "POST",
        success: function(respuesta3) {
            var registros = eval(respuesta3);
            for (var i = 0; i < registros.length; i++) {
                html += "<option  value=" + registros[i]["provincia"] + "> " + registros[i]["provincia"] + " </option>";
            };
            $("#cbx_provincia").html(html);
            $('select[name=cbx_provincia]').val(valor);
            $('select[name=cbx_provincia]').change();
            $('.selectpicker').selectpicker('refresh');
        }
    });
}

var listar_distrito = function(nombre_distrito) 
{
    var html = "";
    $("#cbx_distrito").html(html);
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/bancoproyectos/listar_distrito",
        type: "POST",
        data: {
            nombre_distrito: nombre_distrito
        },
        success: function(respuesta3) {
            var registros = eval(respuesta3);
            for (var i = 0; i < registros.length; i++) {
                html += "<option  value=" + registros[i]["id_ubigeo"] + "> " + registros[i]["distrito"] + " </option>";
            };
            $("#cbx_distrito").html(html);
            $('.selectpicker').selectpicker('refresh');
        }
    });
}

var idioma_espanol = {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
