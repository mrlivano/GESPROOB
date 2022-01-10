// $(document).on("ready" ,function()
// {              
//     listaIndicador();

//     $("#form-addIndicador").submit(function(event)
//     {
//         event.preventDefault();
//         $('#validarIndicador').data('formValidation').resetField($('#txt_NombreIndicador'));
//         $('#validarIndicador').data('formValidation').resetField($('#txtArea_DefIndicador'));
//         $('#validarIndicador').data('formValidation').resetField($('#txt_UnidadMedida'));
        
//         $('#validarIndicador').data('formValidation').validate();
//         if(!($('#validarIndicador').data('formValidation').isValid()))
//         {
//             return;
//         }
//         $.ajax({
//             url:base_url+"index.php/Indicador/AddIndicador",
//             type:$(this).attr('method'),
//             data:$(this).serialize(),
//             success:function(resp)
//             {
//                 var registros = eval(resp);
//                 for (var i = 0; i < registros.length; i++) 
//                 {
//                     if(registros[i]["VALOR"]==1)
//                     {
//                         swal("",registros[i]["MENSAJE"], "success");
//                         $('#form-addIndicador')[0].reset();
//                         $("#VentanaRegistraIndicador").modal("hide");
//                     }
//                     else
//                     {
//                         swal('',registros[i]["MENSAJE"],'error' )
//                     }
//                 };
//                 $('#table-Indicador').dataTable()._fnAjaxUpdate();
//             },
//             error: function ()
//             {
//                 swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
//                 $('#form-addIndicador')[0].reset();
//                 $("#VentanaRegistraIndicador").modal("hide");
//             }
//         });
//     });

//     $("#form-ActualizarIndicador").submit(function(event)
//     {
//         event.preventDefault();
//         $('#actualizarIndicador').data('formValidation').resetField($('#txt_NombreIndicadorU'));
//         $('#actualizarIndicador').data('formValidation').resetField($('#txtArea_DefIndicadorU'));
//         $('#actualizarIndicador').data('formValidation').resetField($('#txt_UnidadMedidaU'));
        
//         $('#actualizarIndicador').data('formValidation').validate();
//         if(!($('#actualizarIndicador').data('formValidation').isValid()))
//         {
//             return;
//         }
//         $.ajax({
//             url:base_url+"index.php/Indicador/UpdateIndicador",
//             type:$(this).attr('method'),
//             data:$(this).serialize(),
//             success:function(resp)
//             {
//                 swal("ACTUALIZADO!", resp, "success");
//                 $('#form-ActualizarIndicador')[0].reset();
//                 $("#VentanaModificarIndicador").modal("hide");
//                 $('#table-Indicador').dataTable()._fnAjaxUpdate();
//             },
//             error: function ()
//             {
//                 swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
//                 $('#form-ActualizarIndicador')[0].reset();
//                 $("#VentanaModificarIndicador").modal("hide");
//             }
//         });

//     });     
// });


// $(function()
// {
//     $('#validarIndicador').formValidation(
//     {
//         framework: 'bootstrap',
//         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
//         live: 'enabled',
//         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
//         trigger: null,
//         fields:
//         {
//             txt_NombreIndicador:
//             {
//                 validators:
//                 {
//                     notEmpty:
//                     {
//                         message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
//                     }
//                 }
//             },
//             txtArea_DefIndicador:
//             {
//                 validators: 
//                 {
//                     notEmpty:
//                     {
//                         message: '<b style="color: red;">El campo "Definición" es requerido.</b>'
//                     }
//                 }
//             },
//             txt_UnidadMedida:
//             {
//                 validators: 
//                 {
//                     notEmpty:
//                     {
//                         message: '<b style="color: red;">El campo "Unidad de Medida" es requerido.</b>'
//                     }
//                 }
//             }
//         }
//     });
//     $('#actualizarIndicador').formValidation(
//     {
//         framework: 'bootstrap',
//         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
//         live: 'enabled',
//         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
//         trigger: null,
//         fields:
//         {
//             txt_NombreIndicadorU:
//             {
//                 validators:
//                 {
//                     notEmpty:
//                     {
//                         message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
//                     }
//                 }
//             },
//             txtArea_DefIndicadorU:
//             {
//                 validators: 
//                 {
//                     notEmpty:
//                     {
//                         message: '<b style="color: red;">El campo "Definicion" es requerido.</b>'
//                     }
//                 }
//             },
//             txt_UnidadMedidaU:
//             {
//                 validators: 
//                 {
//                     notEmpty:
//                     {
//                         message: '<b style="color: red;">El campo "Unidad de Medida" es requerido.</b>'
//                     }
//                 }
//             }
//         }
//     });
// });

// var listaIndicador=function() 
// {
//     var table=$("#table-Indicador").DataTable({
//      "processing":true,
//      "serverSide":false,
//      destroy:true,
//         "ajax":{
//             "url":base_url +"index.php/Indicador/GetIndicador",
//             "method":"POST",
//             "dataSrc":""
//         },
//         "columns":[
//             {"data":"id_indicador"},
//             {"data":"nombre_indicador"},
//             {"data":"definicion_indicador"},
//              {"data":"unidad_medida_indicador"},
//            {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarIndicador'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
//         ],

//         "language":idioma_espanol
//     });  
//     IndicadorData("#table-Indicador",table);                          
//     EliminarIndicador("#table-Indicador",table);
// }

// var IndicadorData=function(tbody,table)
// {
//     $(tbody).on("click","button.editar",function(){
//         var data=table.row( $(this).parents("tr")).data();
//         var id_indicador=$('#txt_IdIndicadorModif').val(data.id_indicador);
//         var nombre_indicador=$('#txt_NombreIndicadorU').val(data.nombre_indicador);
//         var definicion_indicador=$('#txtArea_DefIndicadorU').val(data.definicion_indicador);
//         var unidad_medida_indicador=$('#txt_UnidadMedidaU').val(data.unidad_medida_indicador);
//     });
// }

// var EliminarIndicador=function(tbody,table)
// {
//     $(tbody).on("click","button.eliminar",function(){
//         var data=table.row( $(this).parents("tr")).data();
//         var id_indicador=data.id_indicador;
//         swal({
//                 title: "Esta seguro que desea eliminar el indicador?",
//                 text: "",
//                 type: "warning",
//                                 showCancelButton: true,
//                                 cancelButtonText:"Cerrar" ,
//                                 confirmButtonColor: "#DD6B55",
//                                 confirmButtonText: "SI,Eliminar",
//                                 closeOnConfirm: false
//             },
//         function(){
//             $.ajax({
//             url:base_url+"index.php/Indicador/DeleteIndicador",
//             type:"POST",
//             data:{id_indicador:id_indicador},
//             success:function(respuesta)
//             {
//                swal("ELIMINADO!", "Se elimino correctamente el indicador.", "success");
//               $('#table-Indicador').dataTable()._fnAjaxUpdate();
//             },
//             error: function ()
//             {
//                 swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
//             }
//             });
//         });
//     });
// }
