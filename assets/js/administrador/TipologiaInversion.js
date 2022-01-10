$(document).on("ready" ,function(){

                listaTipologiaInversion();/*llamar a mi datatablet listar funcion*/
              //abrir el modal para registrar


	//REGISTARAR NUEVA tipologia inversion
	$("#form-AddTipologiaInversion").submit(function(event)
	{
		event.preventDefault();

		$.ajax(
		{
			url : base_url+"index.php/TipologiaInversion/AddTipologiaInversion",
			type : $(this).attr('method'),
			data  :$(this).serialize(),
			success : function(resp)
			{			
				if(resp=='1')
				{
					swal("Se registró...","", "success");
					
					formReset();
				}

				if(resp=='2')
				{
					swal("NO se registró...","", "error");
				}

				$('#dynamic-table-TipologiaInversion').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion   
				
				formReset();

				$('#VentanaRegTipologiaInversion').modal('hide');
			},
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#VentanaRegTipologiaInversion').modal('hide');
            }
		});
	});

	//limpiar campos
	function formReset()
	{
		document.getElementById("form-AddTipologiaInversion").reset();
		document.getElementById("form-EditTipologiaInversion").reset();
	}

	//formulario para ediotar
	$("#form-EditTipologiaInversion").submit(function(event)
	{
		event.preventDefault();

		$.ajax(
		{
			url : base_url+"index.php/TipologiaInversion/UpdateTipologiaInversion",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal(resp,"", "success");
				
				$('#dynamic-table-TipologiaInversion').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion   
				
				formReset();

				$('#VentanaEditTipologiaInversion').modal('hide');
			},
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                $('#VentanaEditTipologiaInversion').modal('hide');
            }
		});
	});

      });
         /*listra */
                var listaTipologiaInversion=function()
                {
                    var myTable=$("#dynamic-table-TipologiaInversion").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/TipologiaInversion/get_TipologiaInversion",
                  "method":"POST",
                  "dataSrc":""
                                    },
                                "columns":[
                                  {"data":"id_tipologia_inv","visible" : false},
                                  {"data":"nombre_tipologia_inv"},
                                  {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaEditTipologiaInversion'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                               ],

                                "language":idioma_espanol
                    }); 
        TipologiaData("#dynamic-table-TipologiaInversion",myTable);  //CARGAR LA DATA PARA MOSTRAR EN EL MODAL  
        EliminarTipologiaData("#dynamic-table-TipologiaInversion",myTable);
                }

                var  TipologiaData=function(tbody,myTable){
                    $(tbody).on("click","button.editar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        var txt_IdTipologiaInversionM=$('#txt_IdTipologiaInversionM').val(data.id_tipologia_inv);
                        var txt_NombreTipologiaInversionM=$('#txt_NombreTipologiaInversionM').val(data.nombre_tipologia_inv);
                 
                    });
                }
var EliminarTipologiaData=function(tbody,myTable){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        var id_tipologia_inv=data.id_tipologia_inv;
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
                                          url:base_url+"index.php/TipologiaInversion/EliminarTipologiaInversion",
                                          type:"POST",
                                          data:{id_tipologia_inv:id_tipologia_inv},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Se eliminó corectamente", ".", "success");
                                            $('#dynamic-table-TipologiaInversion').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

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
$(function() {
     $("tbody").on("click", "#send", function(e) {
         $('#form-AddTipologiaInversion').data('formValidation').validate();
         if ($('#form-AddTipologiaInversion').data('formValidation').isValid() == true) {
             $('#form-AddTipologiaInversion').submit();
             $('#form-AddTipologiaInversion').each(function() {
                 this.reset();
             });
             $('#form-AddTipologiaInversion').data('formValidation').resetForm();
         }
     });
          $("tbody").on("click", "#sendM", function(e) {
         $('#form-EditTipologiaInversion').data('formValidation').validate();
         if ($('#form-EditTipologiaInversion').data('formValidation').isValid() == true) {
             $('#form-EditTipologiaInversion').submit();
             $('#form-EditTipologiaInversion').each(function() {
                 this.reset();
             });
             $('#form-EditTipologiaInversion').data('formValidation').resetForm();
         }
     });
     $('#form-AddTipologiaInversion').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
             txt_NombreTipologiaInversion: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Nombre de Tipologia" es requerido.</b>'
                     },
                     stringLength: {
                         max: 99,
                         message: '<b style="color: red;">El campo "Nombre de Tipologia" debe tener como máximo 99 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Nombre de Tipologia" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
     $('#form-EditTipologiaInversion').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
             txt_NombreTipologiaInversionM: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Nombre de Tipologia" es requerido.</b>'
                     },
                     stringLength: {
                         max: 99,
                         message: '<b style="color: red;">El campo "Nombre de Tipologia" debe tener como máximo 99 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Nombre de Tipologia" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
 });