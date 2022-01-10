$(document).on("ready" ,function(){
listaRubroE(); //LLAMAR AL METODO LISTAR RUBROS DE EJECUCION

listaFuenteCombo();//LISTAR EN EL COMBOBOX -- LISTA DE FUENTE FINANCIAMIENTO

//AGREGAR UN RUBRO DE EJECUCION
$("#form-addRubroE").submit(function(event)
{
	event.preventDefault();
	if($('#validacionAddRubroE').data('formValidation').isValid()) {
		$.ajax(
		{
			url : base_url+"index.php/MRubroEjecucion/AddRubroE",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal("REGISTRADO!", '', "success");

				$('#table-Rubro').dataTable()._fnAjaxUpdate();

				$('#VentanaRegistraRubroEjecucion').modal('hide');
			},
      error: function ()
      {
          swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
          $('#VentanaRegistraRubroEjecucion').modal('hide');
      }
		});
	}
});
//FIN DE AGREGAR UN RUBRO DE EJECUCION


//-------------- MANTENIMIENTO DE RUBRO DE  EJECUCION----------------------


//ACTUALIZAR UN RUBRO DE EJECUCION
$("#form-ActualizarRubroE").submit(function(event)
{
	event.preventDefault();
	if($('#validarActualizarRubroE').data('formValidation').isValid()) {
		$.ajax(
		{
			url : base_url+"index.php/MRubroEjecucion/UpdateRubroE",
			type : $(this).attr('method'),
			data : $(this).serialize(),
			success : function(resp)
			{
				swal("MODIFICADO!", "", "success");

				$('#table-Rubro').dataTable()._fnAjaxUpdate();

				$('#VentanaModificarRubroE').modal('hide');
			},
      error: function ()
      {
          swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
          $('#VentanaModificarRubroE').modal('hide');
      }
		});
	}
});


});
//FIN ACTUALIZAR UN RUBRO DE EJECUCION
/*LISTAR LOS RUBROS DE EJECUION EN UN DATATABLE*/
var listaRubroE=function()
                {
                    var table=$("#table-Rubro").DataTable({
                     "processing":true,
                     "serverSide":false,
                     destroy:true,
                         "ajax":{
                                    "url":base_url +"index.php/MRubroEjecucion/GetRubroE",
                                    "method":"POST",
                                     "dataSrc":""
                                    },
       //para llenado y busqueda por todo los campos
                                "columns":[
                                    {"data":"id_rubro" ,"visible": false},
                                    {"data":"id_fuente_finan" ,"visible": false},
                                    {"data":"nombre_fuente_finan"},
                                    {"data":"nombre_rubro"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarRubroE'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],
                                "language":idioma_espanol
                    });
                    RubroEData("#table-Rubro",table); //TRAER LA DATA RUBRO DE EJECUCION PARA ACTUALIZARLA
                    EliminarRubro("#table-Rubro",table);
                }
/*FIN DE LISTAR LOS RUBROS DE EJECUION EN UN DATATABLE*/

    // CAMPOS QUE SE ACTUALIZARAN EN EL RUBRO DE EJECUCION
       var RubroEData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_fuente_finan=data.id_fuente_finan;
                        var id_rubro=$('#txt_IdRubroEModif').val(data.id_rubro);
                        var nombre_rubro=$('#txt_NombreRubroEU').val(data.nombre_rubro);
                        listaFuenteCombo(id_fuente_finan);
                    });
                }
    // FIN DE CAMPOS QUE SE ACTUALIZARAN EN EL RUBRO DE EJECUCION
    // ELIMINAR
    var EliminarRubro=function(tbody,table){
      $(tbody).on("click","button.eliminar",function(){
        var data=table.row($(this).parents("tr")).data();
        var id_rubro=data.id_rubro;
        swal({
                     title: "Desea eliminar el Registro?",
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
              url:base_url+"index.php/MRubroEjecucion/EliminarRubroEjecucion",
              type:"POST",
              data:{id_rubro:id_rubro},
              success:function(resp){
                var registros=jQuery.parseJSON(resp);
                if(registros.flag==0)
                {
                  swal("",registros.msg,"success");
                  $('#table-Rubro').dataTable()._fnAjaxUpdate();
                }
                else{
                  swal("",registros.msg,"error");
                  $('#table-Rubro').dataTable()._fnAjaxUpdate();
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
    //
    //Listar fuentes de financiamiento en el combobox
        listaFuenteCombo=function(valor)
                 {

                    var htmlfuen="";
                    $("#listaFuenteFinanc").html(htmlfuen);
                   $("#listaFuenteF").html(htmlfuen);
                   event.preventDefault();
                    $.ajax(
                    {
                        "url":base_url +"index.php/FuenteFinanciamiento/get_FuenteFinanciamiento",
                        type:"POST",
                        success:function(respuesta){
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              htmlfuen +="<option value="+registros[i]["id_fuente_finan"]+"> "+registros[i]["nombre_fuente_finan"]+" </option>";
                            };
                            $("#listaFuenteFinanc").html(htmlfuen);
                            $("#listaFuenteF").html(htmlfuen);
                            $('select[name=listaFuenteF]').val(valor);
                            $('select[name=listaFuenteF]').change();
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                 }
 //Listar fuentes de financiamiento en el combobox





//-------------- FIN MANTENIMIENTO DE RUBRO DE  EJECUCION----------------------
