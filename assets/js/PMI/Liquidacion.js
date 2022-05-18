$(document).on("ready" ,function()
{
    lista_liquidacion();
    $("#form_EditLiquidacion").submit(function(event)
    {
        event.preventDefault();
        $('#validarLiquidacionM').data('formValidation').validate();
        if(!($('#validarLiquidacionM').data('formValidation').isValid()))
        {
          return;
        }
        var formData=new FormData($("#form_EditLiquidacion")[0]);
        $.ajax({
            type:"POST",
            enctype:'multipart/form-data',
            url:base_url+"index.php/Liquidacion/editarLiquidacion",
            data: formData,
            cache: false,
            contentType:false,
            processData:false,
            success:function(resp)
            {
                resp = JSON.parse(resp);
                ((resp.proceso == 'Correcto') ? swal(resp.proceso, resp.mensaje, "success") : swal(resp.proceso, resp.mensaje, "error"));
                $('#table_liquidacion').dataTable()._fnAjaxUpdate();
                formReset();
                $('#ventana_editar_liquidacion').modal('hide');
            },
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            }
        });
    });

    $("#form_AddLiquidacion").submit(function(event)
    {
        event.preventDefault();
        $('#validarLiquidacion').data('formValidation').validate();
        if(!($('#validarLiquidacion').data('formValidation').isValid()))
        {
          return;
        }
        $.ajax({
            url:base_url+"index.php/Liquidacion/AddLiquidacion",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                resp = JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));
                $('#table_liquidacion').dataTable()._fnAjaxUpdate();
                $('#ventana_registrar_liquidacion').modal('hide');
                formReset();
            },
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
            }
        });
    });

     function formReset()
          {
          document.getElementById("form_AddLiquidacion").reset();
          document.getElementById("form_EditLiquidacion").reset();
          }
});
//listar proyectos de inversion en formulacion y evaluacion
 var lista_liquidacion=function()
{
   var table=$("#table_liquidacion").DataTable({
                     "ajax":{
                                "url":base_url+"index.php/Liquidacion/listar_liquidacion",
                                "method":"POST",
                                "dataSrc":""
                              },
                            "columns":[
                                {"data":"id_descripcion", "visible" : false},
                                {"defaultContent":"<td>#</td>"},
                                {"data":"descripcion"},
                                {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#ventana_editar_liquidacion'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>"}
                          ],
                           "language":idioma_espanol
                });
   LiquidacionData("#table_liquidacion",table);
   Eliminar_liquidacionData("#table_liquidacion",table);
}

var  LiquidacionData=function(tbody,table)
{
    $(tbody).on("click","button.editar",function(){
        var data=table.row( $(this).parents("tr")).data();
        var txt_id_descripcion=$('#txt_id_descripcion').val(data.id_descripcion);
        var txt_descripcion_m=$('#txt_descripcion_m').val(data.descripcion);
    });
}

var Eliminar_liquidacionData=function(tbody,table)
{
    $(tbody).on("click","button.eliminar",function(){
        var data=table.row( $(this).parents("tr")).data();
        var id_descripcion=data.id_descripcion;
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
                          url:base_url+"index.php/Liquidacion/Eliminar_liquidacion",
                          type:"POST",
                          data:{id_descripcion:id_descripcion},
                          success:function(respuesta){
                            //alert(respuesta);
                            swal("Eliminado!", "Se elimino corectamente.", "success");
                            $('#table_liquidacion').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                          },
                            error: function ()
                            {
                                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
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
