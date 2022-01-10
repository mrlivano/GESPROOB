// $(document).on("ready" ,function(){

//   listaEstadoCicloInversion();/*llamar a mi datatablet listar funcion*/
//     $("#btn_importar_cartera").click(function()//para que cargue el como una vez echo click sino repetira datos
//           {
//        //actualizar la tabla al momento de importar
//         $('#table-ProyectoInversionProgramado').dataTable()._fnAjaxUpdate();
//       });
//   //limpiar campos
//   function formReset()
//   {
//   document.getElementById("form-Importar").reset();
//   }

//   //formulario para subir

//   $("#form-Importar").submit(function (event) {
//       //stop submit the form, we will post it manually.
//       event.preventDefault();
//       // Get form
//       var form = $('#form-Importar')[0];

//       // Create an FormData object
//       var data = new FormData(form);

//       // If you want to add an extra field for the FormData
//       //data.append("CustomField", "This is some extra data, testing");

//       // disabled the submit button
//       //$("#btnSubmit").prop("disabled", true);

//       $.ajax({
//           type: "POST",
//           enctype: 'multipart/form-data',
//           url: base_url+"index.php/Importar/addImportar",
//           data: data,
//           processData: false,
//           contentType: false,
//           cache: false,
//           timeout: 600000,
//           success: function (data) {
//               //$("#result").text(data);
//               swal(data,"", "success");
//               //console.log("SUCCESS : ", data);
//               //$("#btnSubmit").prop("disabled", false);
//               $('#table-ProyectoInversionProgramado').dataTable()._fnAjaxUpdate();
//                formReset();
//                VentanaImportar.close()


//           },
//           error: function (e) {
//             var msg = "No se subio el archivo, consulte con el administrador del sistema";
//             swal(msg,"", "error");
//              $('#table-ProyectoInversionProgramado').dataTable()._fnAjaxUpdate();
//               formReset();
//             //$("#result").text(e.responseText);
//             //console.log("ERROR : ", e);
//             //$("#btnSubmit").prop("disabled", false);

//           }
//       });

//   });

// });
// 			   /*listra */
              

                
              
//         /*Idioma de datatablet table-sector */
//             var idioma_espanol=
//                 {
//                     "sProcessing":     "Procesando...",
//                     "sLengthMenu":     "Mostrar _MENU_ registros",
//                     "sZeroRecords":    "No se encontraron resultados",
//                     "sEmptyTable":     "Ningún dato disponible en esta tabla",
//                     "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//                     "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//                     "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//                     "sInfoPostFix":    "",
//                     "sSearch":         "Buscar:",
//                     "sUrl":            "",
//                     "sInfoThousands":  ",",
//                     "sLoadingRecords": "Cargando...",
//                     "oPaginate": {
//                         "sFirst":    "Primero",
//                         "sLast":     "Último",
//                         "sNext":     "Siguiente",
//                         "sPrevious": "Anterior"
//                     },
//                     "oAria": {
//                         "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//                         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//                     }
//                 }


