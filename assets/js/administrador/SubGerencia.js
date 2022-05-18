$(document).on("ready", function()
{
    lista_subgerencias();

    /*llamar a mi datatablet listar funcion*/
    $("#btn_NuevaSubGerencia").click(function()//para que cargue el como una vez echo click sino repetira datos
    {
        listaGerenciaCombo();//para llenar el combo de agregar
    });

    $("#form-AddSubGerencia").submit(function(event)//para añadir nuevo division funcional
    {
        event.preventDefault();
        if($('#validarAddSubGerencia').data('formValidation').isValid()) {
          $.ajax(
          {
              url : base_url + "index.php/SubGerencia/AddSubGerencia",
              type : $(this).attr('method'),
              data : $(this).serialize(),
              success : function(resp)
              {
                  swal("", resp, "success");

                  $('#table-SubGerencia').dataTable()._fnAjaxUpdate();

                  $('#VentanaRegistraSubGerencia').modal('hide');
              },
              error: function ()
              {
                  swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                  $('#VentanaRegistraSubGerencia').modal('hide');
              }
          });
        }
    });

    $("#form-ModificarSubGerencia").submit(function(event)//Actualizar funcion
    {
        event.preventDefault();
        if($('#validarModificarSubGerencia').data('formValidation').isValid()) {
          $.ajax(
          {
              url : base_url + "index.php/SubGerencia/UpdateSubGerencia",
              type : $(this).attr('method'),
              data : $(this).serialize(),
              success : function (resp)
              {
                  swal("", resp, "success");

                  $('#table-SubGerencia').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                  $('#VentanaUpdateSubGerencia').modal('hide');
              },
              error: function ()
              {
                  swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                  $('#VentanaUpdateSubGerencia').modal('hide');
              }
          });
        }
    });
    //fin de  funcional
});

/*listra funcion*/
var lista_subgerencias = function () {
    var table = $("#table-SubGerencia").DataTable({
        "processing": true,
        "serverSide": false,
        destroy: true,

        "ajax": {
            "url": base_url + "index.php/SubGerencia/GetSubGerencia",
            "method": "POST",
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_subgerencia", "visible" : false},
            {"data": "id_gerencia", "visible" : false},
            {"data": "denom_gerencia"},
            {"data": "denom_subgerencia"},
            {"defaultContent": "<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaUpdateSubGerencia'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button><button type='button' class='meta btn btn-success btn-xs' data-toggle='modal' data-target='#VentanaMetaSubGerencia'><i class='ace-icon fa fa-list-alt bigger-120'></i></button>"}
        ],

        "language": idioma_espanol
    });
    SubGerenciaData("#table-SubGerencia", table);  //obtener data de gerencia para agregar  AGREGAR
    EliminarSubGerencia("#table-SubGerencia", table);
};

var listaGerenciaCombo = function (valor)//COMO CON LAS FUNCIONES PARA AGREGAR DIVIVISION FUNCIONAL
{
    html = "";
    $("#listaGerenciaC").html(html);
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/Gerencia/GetGerencia",
        type: "POST",
        success: function (respuesta) {
            // alert(respuesta);
            var registros = eval(respuesta);
            for (var i = 0; i < registros.length; i++) {
                html += "<option value=" + registros[i]["id_gerencia"] + "> " + registros[i]["denom_gerencia"] + " </option>";
            }

            $("#listaGerenciaC").html(html);//para modificar las entidades
            $("#listaGerenciaCM").html(html);//para modificar las entidades

            $('select[name=listaGerenciaCM]').val(valor).change();//PARA AGREGAR UN COMBO PSELECIONADO
            //$('select[name=listaGerenciaCM]').change();

            $('.selectpicker').selectpicker('refresh');
        }
    });
};

var listaMetaComboSG = function (sec_ejec)//COMO CON LAS FUNCIONES PARA AGREGAR DIVIVISION FUNCIONAL
{
    html = "";
    $("#listarMetaSG").html(html);
    var fecha = new Date();
    var anio_meta = fecha.getFullYear();
    var sec_ejec  = sec_ejec;
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/SubGerencia/listarMeta",
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
                html += "<option value=" + registros[i]["sec_func"] + "> " + registros[i]["sec_func"] +" - "+ registros[i]["nombre"] + " </option>";
            }

            $("#listarMetaSG").html(html);//para modificar las entidades

            $('.selectpicker').selectpicker('refresh');
        }
    });
};

var listaMetaSubGerencia = function (id_subgerencia,anio_meta)
    {
        id_subgerencia=id_subgerencia;
        anio_meta=anio_meta;
        var table=$("#tablaMetaSubGerencia").DataTable({
            "processing": true,
            "serverSide":false,
            destroy:true,
            "ajax":{
                url:base_url+"index.php/SubGerencia/listar_metas_subgerencia",
                type:"POST",
                data :{id_subgerencia:id_subgerencia,
                        anio_meta:anio_meta}
            },
            "columns":
            [
                {"data":"sec_func"},
                {"data":"finalidad"},
                {"data":"act_proy"},
                {"data":"nombre"},
                {"data":"id_subgerenciameta",
                    render: function(data, type, row)
                    {
                        return "<button type='button' class='btn btn-danger btn-xs' onclick=eliminarMetaSubGerencia(" + data + ",this)><i class='fa fa-trash-o'></i></button>";
                    }
                }
            ],
            "language":idioma_espanol
        });
    }

    function eliminarMetaSubGerencia(id_subgerenciameta, element) 
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
        "id_subgerenciameta": id_subgerenciameta
      }, base_url + 'index.php/SubGerencia/eliminarMeta', 'POST', null, function(objectJSON) {
        objectJSON = JSON.parse(objectJSON);
        swal({
          title: '',
          text: objectJSON.mensaje,
          type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
        }, function() {});
        $('#tablaMetaSubGerencia').dataTable()._fnAjaxUpdate();
      }, false, true);
    });
  }

var SubGerenciaData = function (tbody, table) {
    $(tbody).on("click", "button.editar", function () {
        var data = table.row($(this).parents("tr")).data();
        var txt_id_subgerencia_m = $('#txt_id_subgerencia_m').val(data.id_subgerencia);
        var txt_id_gerencia_m = data.id_gerencia;
        var txt_denom_subgerencia_m = $('#txt_denom_subgerencia_m').val(data.denom_subgerencia);
        listaGerenciaCombo(txt_id_gerencia_m);
    });
    $(tbody).on("click", "button.meta", function () {
        var data = table.row($(this).parents("tr")).data();
        var txt_id_subgerencia = $('#txt_id_subgerencia').val(data.id_subgerencia);
        var txt_denom_oficina = $('#txt_subgerencia').val(data.denom_subgerencia+" - "+data.denom_gerencia);
        var txt_denom_ue = $('#txt_unidad_ejecutoraSG').val(data.codigo_ue+" - "+data.nombre_ue);
        var txt_ue = $('#txt_ueSG').val(data.codigo_ue);
        listaMetaComboSG(data.codigo_ue);
        var fecha = new Date();
        var año = fecha.getFullYear();
        listaMetaSubGerencia(data.id_subgerencia,año);
    });
};

    var EliminarSubGerencia=function(tbody,table){
      $(tbody).on("click","button.eliminar",function(){
        var data=table.row($(this).parents("tr")).data();
        var id_subgerencia=data.id_subgerencia;
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
              url:base_url+"index.php/SubGerencia/EliminarSubGerencia",
              type:"POST",
              data:{id_subgerencia:id_subgerencia},
              success:function(resp){
                var registros=jQuery.parseJSON(resp);
                if(registros.flag==0)
                {
                  swal("",registros.msg,"success");
                  $('#table-SubGerencia').dataTable()._fnAjaxUpdate();
                }
                else{
                  swal("",registros.msg,"error");
                  $('#table-SubGerencia').dataTable()._fnAjaxUpdate();
                }
              },
              error: function ()
              {
                  swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
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
