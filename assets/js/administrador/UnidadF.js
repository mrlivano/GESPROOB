$(document).on("ready" ,function()
{
    listaUnidadF();//LLAMAR AL METODO LISTAR UNIDAD EJECUTORA

    //AGREGAR UNA UNIDAD EJECUTORA
    $("#form-addUnidadF").submit(function(event)
    {
        event.preventDefault();
        if($('#validarAddUnidadF').data('formValidation').isValid()) {
          $.ajax(
          {
              url : base_url+"index.php/UnidadF/AddUnidadF",
              type : $(this).attr('method'),
              data : $(this).serialize(),
              success : function(resp)
              {
                  swal("REGISTRADO!", resp, "success");

                  $('#table-UnidadF').dataTable()._fnAjaxUpdate();    //SIRVE PARA REFRESCAR LA TABLA

                  $('#VentanaRegistraUnidadFormuladora').modal('hide');
              },
              error: function ()
              {
                  swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                  $('#VentanaRegistraUnidadFormuladora').modal('hide');
              }
          });
        }
    });
    //FIN DE AGREGAR UNA UNIDAD EJECUTORA
});

//-------------- MANTENIMIENTO UNIDAD EJECUTORA----------------------
/*LISTAR UNIDAD DE EJECUCION EN UN DATATABLE*/
                var listaUnidadF=function()
                {
                    var table=$("#table-UnidadF").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url +"index.php/UnidadF/GetUnidadF",
                                    "method":"POST",
                                     "dataSrc":""
                               },
       //para llenado y busqueda por todo los campos
                                "columns":[
                                    {"data":"id_uf","visible":false},
                                    {"data":"Nombre_uf"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarUnidadF'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                    UnidadFData("#table-UnidadF",table);//TRAER LA DATA DE UA UNIDAD EJECUTORA PARA ACTUALIZARLA
                    EliminarUnidadF("#table-UnidadF",table);
                }
/*FIN DE LISTAR UNIDAD DE EJECUCION EN UN DATATABLE*/

    //ACTUALIZAR UNA UNIDAD EJECUTORA
    $("#form-ActualizarUnidadF").submit(function(event)
    {
        event.preventDefault();
        if($('#validarActualizarUnidadF').data('formValidation').isValid()) {
          $.ajax(
          {
              url : base_url+"index.php/UnidadF/UpdateUnidadF",
              type : $(this).attr('method'),
              data : $(this).serialize(),
              success : function(resp)
              {
                  swal("MODIFICADO!", resp, "success");

                  $('#table-UnidadF').dataTable()._fnAjaxUpdate();

                  $('#VentanaModificarUnidadF').modal('hide');
              },
              error: function ()
              {
                  swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                  $('#VentanaModificarUnidadF').modal('hide');
              }
          });
        }
    });
    //FIN ACTUALIZAR UNIDAD EJECUTORA

    // CAMPOS QUE SE ACTUALIZARAN DE LA UNIDAD EJECUTORA
        UnidadFData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_uf=$('#txt_IdUnidadFModif').val(data.id_uf);
                        var Nombre_uf=$('#txt_NombreUnidadFU').val(data.Nombre_uf);
                    });
                }
                var EliminarUnidadF=function(tbody,myTable){
                              $(tbody).on("click","button.eliminar",function(){
                                    var data=myTable.row( $(this).parents("tr")).data();
                                    var id_modalidad_ejecn=data.id_uf;
                                    console.log(data);
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
                                                      url:base_url+"index.php/UnidadF/Eliminar",
                                                      type:"POST",
                                                      data:{id_codigo:id_modalidad_ejecn},
                                                      success:function(respuesta){
                                                        //alert(respuesta);
                                                        swal("Se elimino corectamente.", "", "success");
                                                        $('#table-UnidadF').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                                                      },
                                                      error: function ()
                                                      {
                                                          swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                                                      }
                                                    });
                                          });
                                });
                            }
    // FIN DE CAMPOS QUE SE ACTUALIZARAN DE LA UNIDAD EJECUTORA

//-------------- FIN MANTENIMIENTO UNIDAD EJECUTORA---------------------
