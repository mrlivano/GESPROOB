// $(document).on("ready" ,function()
// {
//     listaServicioPublicoAsociado();
//     $("#form-UpdateServicioAsociado").submit(function(event)
//     {
//         event.preventDefault();
//         $('#ValidarServicio').data('formValidation').resetField($('#textarea_servicio_publicoAA'));
//         $('#ValidarServicio').data('formValidation').validate();
//         if(!($('#ValidarServicio').data('formValidation').isValid()))
//         {
//             return;
//         }

//         $.ajax({
//             url:base_url+"index.php/ServicioPublico/UpdateServicioAsociado",
//             type:$(this).attr('method'),
//             data:$(this).serialize(),
//             success:function(resp)
//             {
//                 swal("",resp, "success");
//                 $('#UpdateServicioAsociado').modal('hide');
//                 $('#tableServicioPublicoAsociado').dataTable()._fnAjaxUpdate();
//             },
//             error: function ()
//             {
//                 swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
//                 $('#UpdateServicioAsociado').modal('hide');
//             }
//         });
//     });    
// });

// function guardarServicio()
// {
//     event.preventDefault();
//     $('#frmRegistroServicioPublico').data('formValidation').validate();
//     if(!($('#frmRegistroServicioPublico').data('formValidation').isValid()))
//     {
//         return;
//     }
//     $.ajax({
//         url:base_url+"index.php/ServicioPublico/AddServicioAsociado",
//         type:'POST',
//         encoding:"UTF-8",
//         data:$('#frmRegistroServicioPublico').serialize(),
//         success:function(resp)
//         {
//             resp=JSON.parse();
//             swal(resp.proceso, resp.mensaje, (resp.proceso=="Correcto" ? "success":"error"));
//             $('#tableServicioPublicoAsociado').dataTable()._fnAjaxUpdate();
//             $("#VentanaRegistraServicioAsociado").modal("hide");
//         },
//         error: function ()
//         {
//             swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error");
//             $("#VentanaRegistraServicioAsociado").modal("hide");
//         }
//     });

// }

// $(function()
// {
//     $('#frmRegistroServicioPublico').formValidation(
//     {
//         framework: 'bootstrap',
//         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
//         live: 'enabled',
//         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
//         trigger: null,
//         fields:
//         {
//             textarea_servicio_publicoA:
//             {
//                 validators:
//                 {
//                     notEmpty:
//                     {
//                         message: '<b style="color: red;">El campo "Nombre de Servicio Público asociado" es requerido.</b>'
//                     }
//                 }
//             }
//         }
//     });
    
//     $('#ValidarServicio').formValidation(
//     {
//         framework: 'bootstrap',
//         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
//         live: 'enabled',
//         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
//         trigger: null,
//         fields:
//         {
//             textarea_servicio_publicoAA:
//             {
//                 validators:
//                 {
//                     notEmpty:
//                     {
//                         message: '<b style="color: red;">El campo "Nombre de Servicio Público asociado" es requerido.</b>'
//                     }
//                 }
//             }
//         }
//     });
// });
			   
// var listaServicioPublicoAsociado=function()
// {
//     var table=$("#tableServicioPublicoAsociado").DataTable({

//     "processing":true,
//     "serverSide":false,
//     destroy:true,
//     "ajax":{
//         "url":base_url+"index.php/ServicioPublico/GetServicioAsociado",
//         "method":"POST",
//         "dataSrc":""
//     },
//     "columns":[
//         {"data":"id_serv_pub_asoc"},
//         {"data":"nombre_serv_pub_asoc"},
//         {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#UpdateServicioAsociado'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
//     ],
//     "language":idioma_espanol
//     });
//     ServicioPublicoDataActualizar("#tableServicioPublicoAsociado",table) ;
//     EliminarServicioLista("#tableServicioPublicoAsociado",table);//TRAER LA DATA DE LAS BRECHAS PARA ELIMINAR  
// }

// var ServicioPublicoDataActualizar=function(tbody,table)
// {
//     $(tbody).on("click","button.editar",function()
//     {
//         var data=table.row( $(this).parents("tr")).data();
//         var id_servicio_publicoA=$('#id_servicio_publicoA').val(data.id_serv_pub_asoc);
//         var textarea_servicio_publicoAA=$('#textarea_servicio_publicoAA').val(data.nombre_serv_pub_asoc);

//     });
// }

// var EliminarServicioLista=function(tbody,table)
// {
//     $(tbody).on("click","button.eliminar",function()
//     {
//         var data=table.row( $(this).parents("tr")).data();
//         var id_servicio=data.id_serv_pub_asoc;
//         swal({
//                 title: "Esta seguro que desea eliminar el servicio?",
//                 text: "",
//                 type: "warning",
//                 showCancelButton: true,
//                 cancelButtonText:"Cerrar" ,
//                 confirmButtonColor: "#DD6B55",
//                 confirmButtonText: "SI,Eliminar",
//                 closeOnConfirm: false
//             },
//         function()
//         {
//             $.ajax({
//                 url:base_url+"index.php/ServicioPublico/EliminarServicioPublico",
//                 type:"POST",
//                 data:{id_servicio:id_servicio},
//                 success:function(respuesta)
//                 {
//                     swal("ELIMINADO!", "Se elimino correctamente la brecha.", "success");
//                     $('#tableServicioPublicoAsociado').dataTable()._fnAjaxUpdate();
//                 },
//                 error: function ()
//                 {
//                     swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
//                 }
//             });
//         });
//     });
// }

// var idioma_espanol=
// {
//     "sProcessing":     "Procesando...",
//     "sLengthMenu":     "Mostrar _MENU_ registros",
//     "sZeroRecords":    "No se encontraron resultados",
//     "sEmptyTable":     "Ningún dato disponible en esta tabla",
//     "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//     "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//     "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//     "sInfoPostFix":    "",
//     "sSearch":         "Buscar:",
//     "sUrl":            "",
//     "sInfoThousands":  ",",
//     "sLoadingRecords": "Cargando...",
//     "oPaginate": 
//     {
//         "sFirst":    "Primero",
//         "sLast":     "Último",
//         "sNext":     "Siguiente",
//         "sPrevious": "Anterior"
//     },
//     "oAria": 
//     {
//         "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//     }
// }
