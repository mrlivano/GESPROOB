$(document).on("ready" ,function()
{
  ListarEspecialidad();

  $("#form-addEspecialidad").submit(function(event)
  {
    event.preventDefault();
    if($('#validateAddEspecialidad').data('formValidation').isValid()) {
      $.ajax(
      {
        url : base_url+"index.php/Especialidad/addEspecialidad",
        type : $(this).attr('method'),
        data : $(this).serialize(),
        success : function(resp)
        {
          swal("REGISTRADO!", "Espacialidad Registrado Correctamente", "success");

          $('#table-especialidad').dataTable()._fnAjaxUpdate();

          $('#modalRegistrarEspecialidad').modal('hide');
        },
              error: function ()
              {
                  swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                  $('#modalRegistrarEspecialidad').modal('hide');
              }
      });
    }
  });

  $("#form-updateEspecialidad").submit(function(event)
  {
    event.preventDefault();
    if($('#validateUpdateEspecialidad').data('formValidation').isValid()) {
      $.ajax(
      {
        url : base_url+"index.php/Especialidad/updateEspecialidad",
        type : $(this).attr('method'),
        data : $(this).serialize(),
        success : function(resp)
        {
          swal("REGISTRADO!", "", "success");

          $('#table-especialidad').dataTable()._fnAjaxUpdate();

          $('#modalEditarEspecialidad').modal('hide');
        },
              error: function ()
              {
                  swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                  $('#modalEditarEspecialidad').modal('hide');
              }
      });
    }
  });

});

var ListarEspecialidad=function()
{
    var table=$("#table-especialidad").DataTable({
     "processing":true,
     "serverSide":false,
     destroy:true,

         "ajax":{
                    "url":base_url+"index.php/Especialidad/ListarEspecialidad",
                    "method":"POST",
                    "dataSrc":""
                    },
                "columns":[
                    {"data":"id_esp", "visible" : false},
                    {"data":"nombre_esp"},
                    {"defaultContent":"<button type='button'  class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#modalEditarEspecialidad'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                ],

                "language":idioma_espanol
    });
    cargaDataEspecialidad("#table-especialidad",table);
    eliminarEspecialidad("#table-especialidad",table);
}

var  cargaDataEspecialidad=function(tbody,table) {
  $(tbody).on("click","button.editar",function(){
      var data=table.row( $(this).parents("tr")).data();
      var id_esp=$('#txt_id_esp').val(data.id_esp);
      var nombre_esp=$('#txt_nombre_esp_M').val(data.nombre_esp);
  });
}

var eliminarEspecialidad=function(tbody,table){
  $(tbody).on("click","button.eliminar",function(){
        var data=table.row( $(this).parents("tr")).data();
        var id_esp=data.id_esp;
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
                          url:base_url+"index.php/Especialidad/deleteEspecialidad",
                          type:"POST",
                          data:{id_esp:id_esp},
                  success:function(respuesta){
                                 var registros=jQuery.parseJSON(respuesta);
                                 console.log(registros);
                                 if(registros.flag==1){
                                  swal("Eliminado.",registros.msg, "success");
                                  $('#table-especialidad').dataTable()._fnAjaxUpdate();
                                 }
                                 else{
                                  swal("Error.",registros.msg, "error");
                                  $('#table-especialidad').dataTable()._fnAjaxUpdate();
                                 }
                           }
                           ,
                                error: function ()
                                {
                                    swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                                }
                        });
              });
    });
}
