$(document).on("ready" ,function()
{
    listar_no_pip();

    $("#form_AddOperacionMantenimiento").submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/bancoproyectos/AddOperacionMantenimiento",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp){
            if (resp=='1') {
                swal("REGISTRADO","Se regristró correctamente", "success");
                formReset();
            }
            if (resp=='2') {
                swal("NO SE REGISTRÓ","NO se regristró ", "error");
            }
            $('#Table_OperacionMantenimiento').dataTable()._fnAjaxUpdate();
                formReset();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
        });
    });

    $("#form_AddTipoNoPip").submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/bancoproyectos/AddTipoNoPip",
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
                $('#Table_TipoNoPip').dataTable()._fnAjaxUpdate();
                $('#table_no_pip').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
        });
    });

    $("#form_AddEstadoCiclo").submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/bancoproyectos/AddEstadoCicloPI",
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
                $('#Table_Estado_Ciclo').dataTable()._fnAjaxUpdate();
                $('#table_no_pip').dataTable()._fnAjaxUpdate();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
        });
    });
});

var listar_no_pip=function()
{
    var table=$("#table_no_pip").DataTable({
        "processing": true,
        "serverSide":false,
        "destroy":true,
        "ajax":{
            "url":base_url+"index.php/bancoproyectos/GetNOPIP",
            "method":"POST",
            "dataSrc":""
        },
        "columns":
        [
            {"data": function (data, type) 
                {
                    return "<a onclick='editarProyectoInversion("+data.id_pi+")'  class='btn btn-primary btn-xs'><i class='fa fa-edit' aria-hidden='true'></i></a>"
                }
            }, 
            {"data":"codigo_unico_pi"},
            {"data":"nombre_pi"},
            {"data":"costo_pi"},
            {"data":"desc_tipo_nopip"},
            {"data": function (data, type) 
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
        "language":idioma_espanol
    });
    AddListarUbigeo("#table_no_pip", table);
}

function editarProyectoInversion(codigo)
{
    paginaAjaxDialogo(null, 'Editar Inversiones OARR', {codigo: codigo}, base_url+'index.php/ProyectoInversion/inversionOARReditar', 'GET', null, null, false, true);
}

function agregarRubro(codigo)
{
    paginaAjaxDialogo(null, 'Rubro del Proyecto de Inversión', {codigo:codigo}, base_url+'index.php/PMI_RubroPi/insertar', 'GET', null, null, false, true);
}

function modalidadEjecucion(codigo)
{
    paginaAjaxDialogo(null, 'Modalidad de Ejecución', {codigo:codigo}, base_url+'index.php/PMI_ModalidadPi/insertar', 'GET', null, null, false, true);
}

function metaPresupuestal(codigo)
{
    paginaAjaxDialogo(null, 'Meta Presupuestal', {codigo:codigo}, base_url+'index.php/PMI_MetaPresupuestalPi/insertar', 'GET', null, null, false, true);
}
function estadoCiclo(codigo)
{
    paginaAjaxDialogo(null, 'Ciclo', {codigo:codigo}, base_url+'index.php/PMI_EstadoPi/insertar', 'GET', null, null, false, true);
}

function operacionMantenimieto(codigo)
{
    paginaAjaxDialogo(null, 'Operación y Mantenimiento', {codigo:codigo}, base_url+'index.php/PMI_OperacionMantenimientoPi/insertar', 'GET', null, null, false, true);
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
        setTimeout('chargemap()',500);
    });
}

var listar_ubigeo_pi=function(id_pi)
{
    var table=$("#TableUbigeoProyecto_x").DataTable({
    "processing": true,
    "serverSide":false,
    destroy:true,
    "ajax":{
        url:base_url+"index.php/bancoproyectos/Get_ubigeo_pip",
        type:"POST",
        data :{id_pi:id_pi}
        },
        "columns":[
            {"data":"provincia"},
            {"data":"distrito"},
            {"data":"latitud"},
            {"data":"longitud"},
            {"data":"url_img",
                "render": function(data) 
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
            {"data":'id_ubigeo_pi',render:function(data,type,row){
                return "<button type='button'  data-toggle='tooltip'  class='editar btn btn-danger btn-xs' data-toggle='modal' onclick=eliminarUbigeo("+data+",this)><i class='ace-icon fa fa-trash-o bigger-120'></i></button>";
            }}
        ],
        "language":idioma_espanol
    });
}

function agregarUbigeo()
{
    event.preventDefault();
    $('#validarUbigeoPi').data('formValidation').validate();
    if(!($('#validarUbigeoPi').data('formValidation').isValid()))
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
    var nombre_distrito=$("#cbx_provincia").val();
    listar_distrito(nombre_distrito);
});

var listar_provincia=function(valor)
{
    html="";
    $("#cbx_provincia").html(html);
    event.preventDefault();
    $.ajax({
        "url":base_url +"index.php/bancoproyectos/listar_provincia",
        type:"POST",
        success:function(respuesta3)
        {
            var registros = eval(respuesta3);
            for (var i = 0; i <registros.length;i++)
            {
                html +="<option  value="+registros[i]["provincia"]+"> "+registros[i]["provincia"]+" </option>";
            };
            $("#cbx_provincia").html(html);
            $('select[name=cbx_provincia]').val(valor);
            $('select[name=cbx_provincia]').change();
            $('.selectpicker').selectpicker('refresh');
        }
    });
}
var listar_distrito=function(nombre_distrito)
{
    var html="";
    $("#cbx_distrito").html(html);
    event.preventDefault();
    $.ajax({
        "url":base_url +"index.php/bancoproyectos/listar_distrito",
        type:"POST",
        data :{nombre_distrito:nombre_distrito},
        success:function(respuesta3)
        {
            var registros = eval(respuesta3);
            for (var i = 0; i <registros.length;i++) 
            {
                html +="<option  value="+registros[i]["id_ubigeo"]+"> "+registros[i]["distrito"]+" </option>";
            };
            $("#cbx_distrito").html(html);
            $('.selectpicker').selectpicker('refresh');
        }
    });
}

var eliminarUbigeo=function(id_ubigeo_pi,element)
{
    if(!confirm('Se esta seguro de eliminar. ¿Realmente desea proseguir con la operaición?'))
    {
      return;
    }
    paginaAjaxJSON({ "id_ubigeo_pi" : id_ubigeo_pi }, base_url+'index.php/bancoproyectos/eliminarUbigeo', 'POST', null, function(objectJSON)
    {
      objectJSON=JSON.parse(objectJSON);
      swal(
      {
        title: '',
        text: objectJSON.mensaje,
        type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
      },
      function(){});
      $(element).parent().parent().remove();
    }, false, true);
}

 //listar tipo no pip
 var listar_TipoNoPip=function(id_pi)
                {
                    var table=$("#Table_TipoNoPip").DataTable({
                      "processing": true,
                      "serverSide":false,
                       destroy:true,
                         "ajax":{
                                     url:base_url+"index.php/bancoproyectos/Get_TipoNoPip",
                                     type:"POST",
                                     data :{id_pi:id_pi}
                                    },
                                "columns":[
                                    {"data":"id_nopip","visible": false},
                                    {"data":"desc_tipo_nopip"},
                                    {"data":"fecha_nopip"},
                                    //{"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaupdateEstadoFE'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],
                               "language":idioma_espanol
                    });

                }

  //listar y agregar Tipologia no Pip
          var  AddTipologiaNOPIP=function(tbody,table){
                    $(tbody).on("click","button.ver_tipologia_nopip",function(){
                      var data=table.row( $(this).parents("tr")).data();
                       var  id_pi=data.id_pi;
                      $("#txt_id_pip_Tipologia").val(data.id_pi);
                      $("#nombreProyectoTipologia").val(data.nombre_pi);
                        listar_TipologiaNoPip();//combox
                        listar_TipoNoPip(id_pi);
                    });
                }

                


 var listar_TipologiaNoPip=function(valor){
                    var html="";
                    $("#Cbx_TipoNoPip").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/TipologiaInversion/get_tipo_no_pip",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_tipo_nopip"]+"> "+registros[i]["desc_tipo_nopip"]+" </option>";
                            };
                            $("#Cbx_TipoNoPip").html(html);
                            $('select[name=Cbx_TipoNoPip]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_TipoNoPip]').change();
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
                 var listar_TipologiaNoPipRegistro=function(valor){
                    var html="";
                    $("#Cbx_TipoNoPip_i").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/TipologiaInversion/get_tipo_no_pip",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_tipo_nopip"]+"> "+registros[i]["desc_tipo_nopip"]+" </option>";
                            };
                            $("#Cbx_TipoNoPip_i").html(html);
                            $("#Cbx_TipoNoPip_m").html(html);//para modificar las entidades
                            $('select[name=Cbx_TipoNoPip_m]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_TipoNoPip_m]').change();
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
