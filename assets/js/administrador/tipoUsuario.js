$(document).on("ready" ,function()
{
	listarTipoUsuario();

  $("#form-addUserType").submit(function(event)
  {
    event.preventDefault();
    if($('#validateAddTypeUser').data('formValidation').isValid()) {
      $.ajax(
      {
        url : base_url+"index.php/Usuario/addTipoUsuario",
        type : $(this).attr('method'),
        data : $(this).serialize(),
        success : function(resp)
        {
          if(resp==1)
          {
            swal("REGISTRADO!", "Tipo de Usuario Registrado Correctamente", "success");

          }
          

          $('#table-tipoUsuario').dataTable()._fnAjaxUpdate();

          $('#modalRegistrarTipoUsuario').modal('hide');
        },
              error: function ()
              {
                  swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                  $('#modalRegistrarTipoUsuario').modal('hide');
              }
      });
    }
  });

  $("#form-updateUserType").submit(function(event)
  {
    event.preventDefault();
    if($('#validateUpdateTypeUser').data('formValidation').isValid()) {
      $.ajax(
      {
        url : base_url+"index.php/Usuario/updateTipoUsuario",
        type : $(this).attr('method'),
        data : $(this).serialize(),
        success : function(resp)
        {
          swal("REGISTRADO!", "", "success");

          $('#table-tipoUsuario').dataTable()._fnAjaxUpdate();

          $('#modalEditarTipoUsuario').modal('hide');
        },
              error: function ()
              {
                  swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                  $('#modalEditarTipoUsuario').modal('hide');
              }
      });
    }
  });

});

var listarTipoUsuario=function()
{
    var table=$("#table-tipoUsuario").DataTable({
     "processing":true,
     "serverSide":false,
     destroy:true,

         "ajax":{
                    "url":base_url+"index.php/Usuario/ListarTipoUsuario",
                    "method":"POST",
                    "dataSrc":""
                    },
                "columns":[
                    {"data":"id_usuario_tipo", "visible" : false},
                    {"data":"cod_usuario_tipo"},
                    {"data":"desc_usuario_tipo"},
                    {"defaultContent":"<button type='button'  class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#modalEditarTipoUsuario'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                ],

                "language":idioma_espanol
    });
    cargoData22("#table-tipoUsuario",table);
    eliminarTipoUsuario("#table-tipoUsuario",table);
}

var  cargoData22=function(tbody,table) {
  $(tbody).on("click","button.editar",function(){
      var data=table.row( $(this).parents("tr")).data();
      var id_usuario_tipo=$('#txt_idUsuarioTipo').val(data.id_usuario_tipo);
      var cod_usuario_tipo=$('#txt_codUsuarioTipoM').val(data.cod_usuario_tipo);
      var desc_usuario_tipo=$('#txt_descUsuarioTipoM').val(data.desc_usuario_tipo);
  });
}

var eliminarTipoUsuario=function(tbody,table){
  $(tbody).on("click","button.eliminar",function(){
        var data=table.row( $(this).parents("tr")).data();
        var id_usuario_tipo=data.id_usuario_tipo;
         swal({
                title: "Desea eliminar el Registro ?",
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
                          url:base_url+"index.php/Usuario/deleteTipoUsuario",
                          type:"POST",
                          data:{id_usuario_tipo:id_usuario_tipo},
                  success:function(respuesta){
                                 var registros=jQuery.parseJSON(respuesta);
                                 console.log(registros);
                                 if(registros.flag==1){
                                  swal("Eliminado.",registros.msg, "success");
                                  $('#table-tipoUsuario').dataTable()._fnAjaxUpdate();
                                 }
                                 else{
                                  swal("Error.",registros.msg, "error");
                                  $('#table-tipoUsuario').dataTable()._fnAjaxUpdate();
                                 }
                           }
                           ,
                                error: function ()
                                {
                                    swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                                }
                        });
              });
    });
}
