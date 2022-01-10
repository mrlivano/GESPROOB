$(document).on("ready" ,function()
{
	listaMetaP(); //LLAMAR AL METODO META PRESUPUESTAL

	//AGREGAR UNA META PRESUPUESTAL
	$("#form-addMetaP").submit(function(event)
	{
		event.preventDefault();

		$.ajax(
		{
			url : base_url+"index.php/MetaPresupuestal/AddMetaP",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal("REGISTRADO!", resp, "success");
				
				$('#table-MetaPresupuestal').dataTable()._fnAjaxUpdate();    //SIRVE PARA REFRESCAR LA TABLA

				$('#VentanaRegistraMetaPresupuestal').modal('hide');
			},
      error: function ()
      {
          swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
          $('#VentanaRegistraMetaPresupuestal').modal('hide');
      }
		});
	});     
	//FIN DE AGREGAR META PRESUPUESTAL
});

//-------------- MANTENIMIENTO DE META PRESUPUESTAL----------------------
/*LISTAR LOS META PRESUPUESTAL EN UN DATATABLE*/
               var listaMetaP=function() 
                {
                    var table=$("#table-MetaPresupuestal").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url +"index.php/MetaPresupuestal/GetMetaP",
                                    "method":"POST",
                                     "dataSrc":""
                                    },
       //para llenado y busqueda por todo los campos
                                "columns":[
                                    {"data":"id_meta_pres","visible": false},
                                    {"data":"nombre_meta_pres"},
                                    {"data":"año_meta_pres"},
                                    {"data":"pim_meta_pres"},
                                    {"data":"numero_meta_pres"},
                                    {"data":"devengado_meta_pres"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarMetaP'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });  
                   MetaPData("#table-MetaPresupuestal",table); //TRAER LA DATA RUBRO DE EJECUCION PARA ACTUALIZARLA
                }
/*FIN DE LISTAR META PRESUPUESTAL EN UN DATATABLE*/


//ACTUALIZAR UN META PRESUPUESTAL
$("#form-ActualizarMetaP").submit(function(event)
{
	event.preventDefault();

	$.ajax(
	{
		url : base_url+"index.php/MetaPresupuestal/UpdateMetaP",
		type : $(this).attr('method'),
		data : $(this).serialize(),
		success : function(resp)
		{
			swal("MODIFICADO!", resp, "success");
			
			$('#table-MetaPresupuestal').dataTable()._fnAjaxUpdate();

			$('#VentanaModificarMetaP').modal('hide');
		},
    error: function ()
    {
        swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
        $('#VentanaModificarMetaP').modal('hide');
    }
	});
});
//FIN ACTUALIZAR META PRESUPUESTAL

    // CAMPOS QUE SE ACTUALIZARAN DE LA META PRESUPUESTAL
        MetaPData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_meta_pres=$('#txt_IdMetaPModif').val(data.id_meta_pres);
                        var nombre_meta_pres=$('#txt_NombreMetaPU').val(data.nombre_meta_pres);
                        var ano_meta_pres=$('#date_AnioMetaPU').val(data.año_meta_pres);
                        var pim_meta_pres=$('#text_PimU').val(data.pim_meta_pres);
                        var numero_meta_pres=$('#text_NumeroMetaU').val(data.numero_meta_pres);
                        var devengado_meta_pres=$('#text_DevengadoU').val(data.devengado_meta_pres);
                    });

                }
    // FIN DE CAMPOS META PRESUPUESTAL
//-------------- FIN MANTENIMIENTO DE RUBRO DE  EJECUCION----------------------

//Manda datos en consola de la tabla META PRESUPUESTAL
       /* function lista()
          {
           event.preventDefault();
            $.ajax({
              "url":base_url +"index.php/MetaPresupuestal/GetMetaP",
              type:"POST",
              success:function(respuesta)
              {
                
               console.log(respuesta);
              }
            });
          }*/
//fin datos en consola de la tabla meta presupuestal
       


