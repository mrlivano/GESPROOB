 $(document).on("ready" ,function(){
                listaTipoNoPip();/*llamar a mi datatablet listar no tipos no pip*/

//REGISTARAR NUEVA NATURALEZA INVERSION
	$("#form_AddTipoNoPip2").submit(function(event)
	{
		event.preventDefault();
		
		$.ajax(
		{
			url : base_url+"index.php/TipologiaInversion/AddTipoNoPip",
			type : $(this).attr('method'),
			data : $(this).serialize(),
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

			     $('#table_no_pip').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion
			     $('#VentanaRegTipoNoPIP').modal('hide');
            },
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                $('#VentanaRegTipoNoPIP').modal('hide');
            }
		});
		
		
	});
      //limpiar campos
	function formReset()
	{
		document.getElementById("form_AddTipoNoPip2").reset();
	  document.getElementById("form_EditTipoNoPip").reset();
  }

	$("#form_EditTipoNoPip").submit(function(event)
	{
		event.preventDefault();
		$.ajax(
		{
			url : base_url+"index.php/TipologiaInversion/UpdateTipoNoPip",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal(resp,"", "success");
				$('#table_no_pip').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion
                $('#VentanaEditTipoNoPip').modal('hide');
			},
            error: function ()
            {
                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                $('#VentanaEditTipoNoPip').modal('hide');
            }
		});
	});

      });
         /*listra funcion*/
                var listaTipoNoPip=function()
                {
                    var myTable=$("#table_no_pip").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/TipologiaInversion/get_tipo_no_pip",
                                     "method":"POST",
                                      "dataSrc":""
                                    },
                                "columns":[
                                   {"data":"id_tipo_nopip","visible" : false},
                                   {"data":"desc_tipo_nopip"},
                                  {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaEditTipoNoPip'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                               ],


                                "language":idioma_espanol
                    });

        TipoNoPipData("#table_no_pip",myTable);  //CARGAR LA DATA PARA MOSTRAR EN EL MODAL
        EliminarTipoNoPip("#table_no_pip",myTable);
                }

                var  TipoNoPipData=function(tbody,myTable){
                    $(tbody).on("click","button.editar",function(){
                        var data=myTable.row( $(this).parents("tr")).data();
                        $('#txt_IdTipoNoPipM').val(data.id_tipo_nopip);
                        $('#txt_DescripcionTipoNoPipM').val(data.desc_tipo_nopip);
                    });
                }
var EliminarTipoNoPip=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_tipo_nopip=data.id_tipo_nopip;
                        //console.log(data);
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
                                          url:base_url+"index.php/TipologiaInversion/EliminarTipoNoPip",
                                          type:"POST",
                                          data:{id_tipo_nopip:id_tipo_nopip},
                                          success:function(respuesta){
                                            //alert(respuesta);
                                            swal("Se eliminó corectamente", ".", "success");
                                            $('#table_no_pip').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet

                                          },
                                            error: function ()
                                            {
                                                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
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
	
     $("tbody").on("click", "#sendtiponp", function(e) {
         $('#form_AddTipoNoPip').data('formValidation').validate();
         if ($('#form_AddTipoNoPip').data('formValidation').isValid() == true) {
             $('#form_AddTipoNoPip').submit();
             $('#form_AddTipoNoPip').each(function() {
                 this.reset();
             });
             $('#form_AddTipoNoPip').data('formValidation').resetForm();
         }
     });
          $("tbody").on("click", "#sendM", function(e) {
         $('#form_EditTipoNoPip').data('formValidation').validate();
         if ($('#form_EditTipoNoPip').data('formValidation').isValid() == true) {
             $('#form_EditTipoNoPip').submit();
             $('#form_EditTipoNoPip').each(function() {
                 this.reset();
             });
             $('#form_EditTipoNoPip').data('formValidation').resetForm();
         }
     });
     $('#form_AddTipoNoPip').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
            txt_DescripcionTipoNoPip: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Descripción" es requerido.</b>'
                     },
                     stringLength: {
                         max: 199,
                         message: '<b style="color: red;">El campo "Descripción" debe tener como máximo 199 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Descripción" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
     $('#form_EditTipoNoPip').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
            txt_DescripcionTipoNoPipM: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Descripción" es requerido.</b>'
                     },
                     stringLength: {
                         max: 199,
                         message: '<b style="color: red;">El campo "Descripción" debe tener como máximo 199 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Descripción" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
 });
