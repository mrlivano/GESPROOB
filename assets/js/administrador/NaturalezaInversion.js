 $(document).on("ready", function() {
     listaNaturalezaInversion(); /*llamar a mi datatablet listar funcion*/
     //abrir el modal para registrar
     //REGISTARAR NUEVA NATURALEZA INVERSION
     $("#form-AddNaturalezaInversion").submit(function(event) {
         event.preventDefault();
         $.ajax({
             url: base_url + "index.php/TipologiaInversion/AddNaturalezaInversion",
             type: $(this).attr('method'),
             data: $(this).serialize(),
             success: function(resp) {
                 if (resp == '1') {
                     swal("Se registró...", "", "success");
                     formReset();
                 }
                 if (resp == '2') {
                     swal("NO se registró...", "", "error");
                 }
                 $('#dynamic-table-NaturalezaInversion').dataTable()._fnAjaxUpdate(); //para actualizar mi datatablet datatablet   funcion
                 $('#VentanaRegistrarNaturalezaInversion').modal('hide');
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#VentanaRegistrarNaturalezaInversion').modal('hide');
            }
         });
     });
     //limpiar campos
     function formReset() {
         document.getElementById("form-AddNaturalezaInversion").reset();
     }
     $("#form-EditNaturalezaInversion").submit(function(event) {
         event.preventDefault();
         $.ajax({
             url: base_url + "index.php/TipologiaInversion/UpdateNaturalezaInversion",
             type: $(this).attr('method'),
             data: $(this).serialize(),
             success: function(resp) {
                 swal(resp, "", "success");
                 $('#dynamic-table-NaturalezaInversion').dataTable()._fnAjaxUpdate(); //para actualizar mi datatablet datatablet   funcion
                 $('#VentanaRegNaturalezaInversion').modal('hide');
             },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#VentanaRegNaturalezaInversion').modal('hide');
            }
         });
     });
 });
 /*listra funcion*/
 var listaNaturalezaInversion = function() {
     var myTable = $("#dynamic-table-NaturalezaInversion").DataTable({
         "processing": true,
         "serverSide": false,
         destroy: true,
         "ajax": {
             "url": base_url + "index.php/TipologiaInversion/get_NaturalezaInversion",
             "method": "POST",
             "dataSrc": ""
         },
         "columns": [{
             "data": "id_naturaleza_inv",
             "visible": false
         }, {
             "data": "nombre_naturaleza_inv"
         }, {
             "defaultContent": "<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaRegNaturalezaInversion'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"
         }],
         "language": idioma_espanol
     });
     NaturalezaData("#dynamic-table-NaturalezaInversion", myTable); //CARGAR LA DATA PARA MOSTRAR EN EL MODAL
     EliminarNaturalezaData("#dynamic-table-NaturalezaInversion", myTable);
 }
 var NaturalezaData = function(tbody, myTable) {
     $(tbody).on("click", "button.editar", function() {
         var data = myTable.row($(this).parents("tr")).data();
         var txt_IdNaturalezaM = $('#txt_IdNaturalezaM').val(data.id_naturaleza_inv);
         var txt_NombreNaturalezaM = $('#txt_NombreNaturalezaM').val(data.nombre_naturaleza_inv);
     });
 }
 var EliminarNaturalezaData = function(tbody, table) {
     $(tbody).on("click", "button.eliminar", function() {
         var data = table.row($(this).parents("tr")).data();
         var id_naturaleza_inv = data.id_naturaleza_inv;
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
         }, function() {
             $.ajax({
                 url: base_url + "index.php/TipologiaInversion/EliminarNaturalezaInversion",
                 type: "POST",
                 data: {
                     id_naturaleza_inv: id_naturaleza_inv
                 },
                 success: function(respuesta) {
                     //alert(respuesta);
                     swal("Se eliminó corectamente", ".", "success");
                     $('#dynamic-table-NaturalezaInversion').dataTable()._fnAjaxUpdate(); //para actualizar mi datatablet datatablet
                 },
                error: function ()
                {
                    swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                }
             });
         });
     });
 }
 /*Idioma de datatablet table-sector */
 var idioma_espanol = {
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
 }
 //VALIDACION
 $(function() {
     $("tbody").on("click", "#send", function(e) {
         $('#form-AddNaturalezaInversion').data('formValidation').validate();
         if ($('#form-AddNaturalezaInversion').data('formValidation').isValid() == true) {
             $('#form-AddNaturalezaInversion').submit();
             $('#form-AddNaturalezaInversion').each(function() {
                 this.reset();
             });
             $('#form-AddNaturalezaInversion').data('formValidation').resetForm();
         }
     });
          $("tbody").on("click", "#sendM", function(e) {
         $('#form-EditNaturalezaInversion').data('formValidation').validate();
         if ($('#form-EditNaturalezaInversion').data('formValidation').isValid() == true) {
             $('#form-EditNaturalezaInversion').submit();
             $('#form-EditNaturalezaInversion').each(function() {
                 this.reset();
             });
             $('#form-EditNaturalezaInversion').data('formValidation').resetForm();
         }
     });
     $('#form-AddNaturalezaInversion').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
             txt_NombreNaturaleza: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Nombre de Naturaleza" es requerido.</b>'
                     },
                     stringLength: {
                         max: 99,
                         message: '<b style="color: red;">El campo "Nombre de Naturaleza" debe tener como máximo 99 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Nombre de Naturaleza" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
     $('#form-EditNaturalezaInversion').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
             txt_NombreNaturalezaM: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Nombre de Naturaleza" es requerido.</b>'
                     },
                     stringLength: {
                         max: 99,
                         message: '<b style="color: red;">El campo "Nombre de Naturaleza" debe tener como máximo 99 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Nombre de Naturaleza" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
 });