$(document).on("ready", function()
{
    lista_oficinas();

    /*llamar a mi datatablet listar funcion*/
    $("#btn_nuevoOficina").click(function()//para que cargue el como una vez echo click sino repetira datos
    {
        listaSubGerenciaCombo();//para llenar el combo de agregar
    });

    $("#form-AddOficina").submit(function(event)//para añadir nuevo division funcional
    {
        event.preventDefault();
        if($('#validarAddOficina').data('formValidation').isValid()) {
          $.ajax(
          {
              url : base_url + "index.php/Oficina/AddOficina",
              type : $(this).attr('method'),
              data : $(this).serialize(),
              success : function(resp)
              {
                  swal("", resp, "success");

                  $('#table-Oficina').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion

                  $('#VentanaRegistraOficina').modal('hide');
              },
              error: function ()
              {
                  swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                  $('#VentanaRegistraOficina').modal('hide');
              }
          });
        }
    });

    $("#form-UpdateOficina").submit(function(event)//Actualizar off
    {
        event.preventDefault();
        if($('#validarUpdateOficina').data('formValidation').isValid()) {
          $.ajax(
          {
              url : base_url + "index.php/Oficina/UpdateOficina",
              type : $(this).attr('method'),
              data : $(this).serialize(),
              success : function(resp)
              {
                  swal("", resp, "success");

                  $('#table-Oficina').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                  $('#VentanaUpdateOficina').modal('hide');
              },
              error: function ()
              {
                  swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                  $('#VentanaUpdateOficina').modal('hide');
              }
          });
        }
    });
    //fin de  funcional
});

/*listra funcion*/
var lista_oficinas = function () {
    var table = $("#table-Oficina").DataTable({
        "processing": true,
        "serverSide": false,
        destroy: true,

        "ajax": {
            "url": base_url + "index.php/Oficina/GetOficina",
            "method": "POST",
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_oficina", "visible" : false},
            {"data": "id_subgerencia", "visible" : false},
            {"data": "denom_oficina"},
            {"data": "denom_subgerencia"},
            {"data": "denom_gerencia"},
            {"data": "nombre_ue"},
            {"defaultContent": "<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaUpdateOficina'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button><button type='button' class='meta btn btn-success btn-xs' data-toggle='modal' data-target='#VentanaMetaOficina'><i class='ace-icon fa fa-list-alt bigger-120'></i></button>"}
        ],

        "language": idioma_espanol
    });
    OficinasData("#table-Oficina", table);  //obtener data de gerencia para agregar  AGREGAR
    EliminarOficina("#table-Oficina", table);
};

var listaSubGerenciaCombo = function (valor)//COMO CON LAS FUNCIONES PARA AGREGAR DIVIVISION FUNCIONAL
{
    html = "";
    $("#listaSubGerencia").html(html);
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/SubGerencia/GetSubGerencia",
        type: "POST",
        success: function (respuesta) {
            // alert(respuesta);
            var registros = eval(respuesta);
            for (var i = 0; i < registros.length; i++) {
                html += "<option value=" + registros[i]["id_subgerencia"] + "> " + registros[i]["denom_subgerencia"] + " </option>";
            }

            $("#listaSubGerencia").html(html);//para modificar las entidades
            $("#listaSubGerenciaM").html(html);//para modificar las entidades

            $('select[name=listaSubGerenciaM]').val(valor).change();//PARA AGREGAR UN COMBO PSELECIONADO
            //$('select[name=listaGerenciaCM]').change();

            $('.selectpicker').selectpicker('refresh');
        }
    });
};

var listaMetaCombo = function (sec_ejec)//COMO CON LAS FUNCIONES PARA AGREGAR DIVIVISION FUNCIONAL
{
    html = "";
    $("#listarMetaO").html(html);
    var fecha = new Date();
    var anio_meta = fecha.getFullYear();
    var sec_ejec  = sec_ejec;
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/Oficina/listarMeta",
        type: "POST",
        data:
            {
            anio_meta : anio_meta,
            sec_ejec  : sec_ejec
            },
        success: function (respuesta) {
            // alert(respuesta);
            var registros = eval(respuesta);
            html+="<option value=''>Seleccione una opción</option>"
            for (var i = 0; i < registros.length; i++) {
                html += "<option value=" + registros[i]["sec_func"] + "> " + registros[i]["sec_func"] +" - "+ registros[i]["act_proy"] +" - "+ registros[i]["nombre"] + " </option>";
            }

            $("#listarMetaO").html(html);//para modificar las entidades

            $('.selectpicker').selectpicker('refresh');
        }
    });
};

var listaMetaOficina = function (id_oficina,anio_meta)
    {
        id_oficina=id_oficina;
        anio_meta=anio_meta;
        var table=$("#tablaMetaOficina").DataTable({
            "processing": true,
            "serverSide":false,
            destroy:true,
            "ajax":{
                url:base_url+"index.php/Oficina/listar_metas_oficina",
                type:"POST",
                data :{id_oficina:id_oficina,
                        anio_meta:anio_meta}
            },
            "columns":
            [
                {"data":"sec_func"},
                {"data":"finalidad"},
                {"data":"act_proy"},
                {"data":"nombre"},
                {"data":"id_oficinameta",
                    render: function(data, type, row)
                    {
                        return "<button type='button' class='btn btn-danger btn-xs' onclick=eliminarMetaOficina(" + data + ",this)><i class='fa fa-trash-o'></i></button>";
                    }
                }
            ],
            "language":idioma_espanol
        });
    }

    function eliminarMetaOficina(id_oficinameta, element) 
  {
    swal({
      title: "Se eliminará la Meta. ¿Realmente desea proseguir con la operación?",
      text: "",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Cerrar",
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI,Eliminar",
      closeOnConfirm: false
    }, function() {
      paginaAjaxJSON({
        "id_oficinameta": id_oficinameta
      }, base_url + 'index.php/Oficina/eliminarMeta', 'POST', null, function(objectJSON) {
        objectJSON = JSON.parse(objectJSON);
        swal({
          title: '',
          text: objectJSON.mensaje,
          type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
        }, function() {});
        $('#tablaMetaOficina').dataTable()._fnAjaxUpdate();
      }, false, true);
    });
  }

var OficinasData = function (tbody, table) {
    $(tbody).on("click", "button.editar", function () {
        var data = table.row($(this).parents("tr")).data();
        var txt_id_oficina_m = $('#txt_id_oficina_m').val(data.id_oficina);
        var txt_id_subgerencia_m = data.id_subgerencia;
        var txt_denom_oficina_m = $('#txt_denom_oficina_m').val(data.denom_oficina);
        listaSubGerenciaCombo(txt_id_subgerencia_m);
    });
    $(tbody).on("click", "button.meta", function () {
        var data = table.row($(this).parents("tr")).data();
        var txt_id_oficina = $('#txt_id_oficina').val(data.id_oficina);
        var txt_denom_oficina = $('#txt_oficina').val(data.denom_oficina+" - "+data.denom_subgerencia+" - "+data.denom_gerencia);
        var txt_denom_ue = $('#txt_unidad_ejecutora').val(data.codigo_ue+" - "+data.nombre_ue);
        var txt_ue = $('#txt_ue').val(data.codigo_ue);
        listaMetaCombo(data.codigo_ue);
        var fecha = new Date();
        var año = fecha.getFullYear();
        listaMetaOficina(data.id_oficina,año);
    });
};

var EliminarOficina=function(tbody,table){
      $(tbody).on("click","button.eliminar",function(){
        var data=table.row($(this).parents("tr")).data();
        var id_oficina=data.id_oficina;
        swal({
                     title: "Desea eliminar el Registro?",
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
              url:base_url+"index.php/Oficina/EliminarOficina",
              type:"POST",
              data:{id_oficina:id_oficina},
              success:function(resp){
                var registros=jQuery.parseJSON(resp);
                if(registros.flag==0)
                {
                  swal("",registros.msg,"success");
                  $('#table-Oficina').dataTable()._fnAjaxUpdate();
                }
                else{
                  swal("",registros.msg,"error");
                  $('#table-Oficina').dataTable()._fnAjaxUpdate();
                }
              },
              error: function ()
              {
                  swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
              }
            });
        });
      });
    }

/* Idioma DT*/
var idioma_espanol =
    {
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
    };
