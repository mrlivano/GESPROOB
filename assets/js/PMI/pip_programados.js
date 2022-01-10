$("body").on("change","#Cbx_AnioCartera_",function(e){
  $(".lb_anio1").html(parseInt($("#Cbx_AnioCartera_").val())+1);
  $(".lb_anio2").html(parseInt($("#Cbx_AnioCartera_").val())+2);
  $(".lb_anio3").html(parseInt($("#Cbx_AnioCartera_").val())+3);
});
$("body").on("change","#Cbx_AnioCartera_Ejecucion",function(e){
  $(".lb_anio1").html(parseInt($("#Cbx_AnioCartera_Ejecucion").val())+1);
  $(".lb_anio2").html(parseInt($("#Cbx_AnioCartera_Ejecucion").val())+2);
  $(".lb_anio3").html(parseInt($("#Cbx_AnioCartera_Ejecucion").val())+3);
});
$("body").on("change","#Cbx_AnioCartera_operacion_mant",function(e){
  $(".lb_anio1").html(parseInt($("#Cbx_AnioCartera_operacion_mant").val())+1);
  $(".lb_anio2").html(parseInt($("#Cbx_AnioCartera_operacion_mant").val())+2);
  $(".lb_anio3").html(parseInt($("#Cbx_AnioCartera_operacion_mant").val())+3);
});
$(document).on("ready" ,function(){
     listar_aniocartera_();
     listar_aniocartera_Ejecucion();
     listar_aniocartera_operacion_mant();
});
//listar las carteras de inversion que han sido programadas
var listar_aniocartera_=function(valor){ //listar ani cartera operacion y mantenimiento
                   var  html_fye="";
                    $("#Cbx_AnioCartera_").html(html_fye);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/programar_pip/GetAnioCarteraProgramado",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html_fye +="<option  value="+registros[i]["anio"]+"> "+registros[i]["anio"]+" </option>";
                            };
                            $("#Cbx_AnioCartera_").html(html_fye);
                            var anio_cartera = new Date();
                            var anio_actual = anio_cartera.getFullYear();
                            $('select[name=Cbx_AnioCartera_]').val(anio_actual);
                            //$('select[name=Cbx_AnioCartera_]').val(valor);
                            //PARA AGREGAR UN COMBO PSELECIONADO
                            //$('select[name=Cbx_AnioCartera_]').change();
                            $('.selectpicker').selectpicker('refresh');
                            var anio=$("#Cbx_AnioCartera_").val();
                            lista_programados_formulacion_evaluacion(anio);
                            //$("#Cbx_AnioCartera_").trigger("change");
                        }
                    });
                }
                //cargar al combobox los años de las carteras que han sido programadas

                      $("#Cbx_AnioCartera_").change(function() {
                          var anio=$("#Cbx_AnioCartera_").val();
                         // alert(anio);
                            lista_programados_formulacion_evaluacion(anio);
                            //lista_ejecucion(anio);
                           //listar carteran de proyectos
                           $("#Aniocartera").val(anio);
                        }); 

//listar proyectos de inversion en formulacion y evaluacion
var lista_programados_formulacion_evaluacion=function(anio)
{
	var str1 = "Inv_";
	var anio_1= parseInt(anio) +1; 
	var anio_2= parseInt(anio) +2; 
	var anio_3= parseInt(anio) +3; 
	var anioR1 = str1.concat(anio_1);
	var anioR2 = str1.concat(anio_2);
	var anioR3 = str1.concat(anio_3);
    var table=$("#table_formulacion_evaluacion").DataTable({
		"processing": true,
		"serverSide":false,
		destroy:true,
		"ajax":{
			url:base_url+"index.php/PipProgramados/GetPipProgramadosFormulacionEvaluacion",
			type:"POST",
			data :{anio:anio}                             
			},
		"columns":[ 
			{"defaultContent":"<td>#</td>", "visible" : false },
			{ "data" : "codigo_unico_pi" },
			{ "data" : "nombre_estado_ciclo" },
			{ "data" : "nombre_pi" },
			{ "data" : "prioridad_prog" },
			{ "data" : "nombre_brecha" },
			{ "data" : anioR1 ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
			{ "data" : anioR2 ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
			{ "data" : anioR3 ,render: $.fn.dataTable.render.number( ',', '.', 2 )}
		],
		"language": idioma_espanol
  });
}

// var lista_programados_ejecucion=function(anio)
// {
// 	var str1 = "Inv_";
// 	var str2= "OyM_";
// 	var anio_1= parseInt(anio) +1; 
// 	var anio_2= parseInt(anio) +2; 
// 	var anio_3= parseInt(anio) +3; 
// 	var anioR1 = str1.concat(anio_1);
// 	var anioR2 = str1.concat(anio_2);
// 	var anioR3 = str1.concat(anio_3);
// 	var anioOyM1 = str2.concat(anio_1);
// 	var anioOyM2 = str2.concat(anio_2);
// 	var anioOyM3 = str2.concat(anio_3);
// 	var table=$("#table_ejecucion").DataTable({
// 		"processing": true,
// 		"serverSide":false,
// 		destroy:true,
// 		"ajax":{
// 			url:base_url+"index.php/PipProgramados/GetPipProgramadosEjecucion",
// 			type:"POST",
// 			data :{anio:anio}                              
// 		},
// 		"columns":[ 
// 			{ "data" : "id_pi", "visible" : false },
// 			{ "data" : "codigo_unico_pi"},
// 			{ "data" : "nombre_estado_ciclo"},
// 			{ "data" : "nombre_pi","width": "20%" },
// 			{ "data" : "prioridad_prog" },
// 			{ "data" : "nombre_brecha","width": "20%" },
// 			{ "data" : anioR1,render: $.fn.dataTable.render.number( ',', '.', 2 )},
// 			{ "data" : anioR2 ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
// 			{ "data" : anioR3 ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
// 			{ "data" : anioOyM1 ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
// 			{ "data" : anioOyM2 ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
// 			{ "data" : anioOyM3 ,render: $.fn.dataTable.render.number( ',', '.', 2 )}
//         ],
//         "language": idioma_espanol,
//         "ordering":false,
//         dom: 'Bfrtip',
//         buttons:
//         [
//             {
//                 extend: 'pdf',
//                 text: "<span><i class='fa fa-file-pdf-o red''></i> PDF</span>",
//                 className : "btn btn-primary btn-sm",
//                 orientation:'landscape',
//                 title:'Programación de Inversiones - Ejecución',
//                 exportOptions: {
//                     columns: [1, 3, 4, 5, 6, 7, 8]
//                 },
//                 customize: function(doc)
//                 {
//                     doc.defaultStyle.fontSize = 5;
//                 }
//             },
//             {
//                 extend: 'excel',
//                 text: "<span><i class='fa fa-file-excel-o green'></i> EXCEL</span>",
//                 className : "btn btn-primary btn-sm",
//             }
//         ],
//         "autoWidth": false,
//         columnDefs: [
//             { "width": "5%", "targets": [0,1,2,4,6,7,8,9,10,11] },       
//             { "width": "20%", "targets": [3,5] }
//         ]
//         //,
//         // "columnDefs": [
//         //     { "width": "20%", "targets": 0 }
//         //   ]
// 	});
// }

var lista_programados_operacion_mant=function(anio)
{
	var str1 = "OpeMa_";
	var anio_1= parseInt(anio) +1; 
	var anio_2= parseInt(anio) +2; 
	var anio_3= parseInt(anio) +3; 
	var anioR1 = str1.concat(anio_1);
	var anioR2 = str1.concat(anio_2);
	var anioR3 = str1.concat(anio_3);
	var table=$("#table_operacion_mantenimiento").DataTable({
		"processing": true,
		"serverSide":false,
		destroy:true,
		"ajax":{
			url:base_url+"index.php/PipProgramados/GetPipOperacionMantenimiento",
			type:"POST",
			data :{anio:anio} 										
		},
		"columns":[ 
			{"defaultContent":"<td>#</td>"},
			{ "data" : "codigo_unico_pi" },
			{ "data" : "nombre_estado_ciclo" },
			{ "data" : "nombre_pi" },
			{ "data" : "prioridad_prog" },
			{ "data" : "nombre_brecha" },
			{ "data" : anioR1 ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
			{ "data" : anioR2 ,render: $.fn.dataTable.render.number( ',', '.', 2 )},
			{ "data" : anioR3 ,render: $.fn.dataTable.render.number( ',', '.', 2 )}
		],
		"language": idioma_espanol
  	});
}
//fin de proyectos de operacion y mantenimiento

        
var listar_aniocartera_Ejecucion=function(valor)
{
    var  html="";
    $("#Cbx_AnioCartera_Ejecucion").html(html);
    event.preventDefault();
    $.ajax({
        "url":base_url +"index.php/programar_pip/GetAnioCarteraProgramado",
        type:"POST",
        success:function(respuesta3)
        {
            var registros = eval(respuesta3);
            for (var i = 0; i <registros.length;i++) 
            {
                html +="<option  value="+registros[i]["anio"]+"> "+registros[i]["anio"]+" </option>";
            };
            $("#Cbx_AnioCartera_Ejecucion").html(html);
            var anio_cartera = new Date();
            var anio_actual = anio_cartera.getFullYear();
            $('select[name=Cbx_AnioCartera_Ejecucion]').val(anio_actual);
            $('.selectpicker').selectpicker('refresh');
            var anio=$("#Cbx_AnioCartera_Ejecucion").val();
            // lista_programados_ejecucion(anio);
        }
    });
}


                 $("#Cbx_AnioCartera_Ejecucion").change(function() {
                          var anio=$("#Cbx_AnioCartera_Ejecucion").val();
                            // lista_programados_ejecucion(anio);
                        }); 
var listar_aniocartera_operacion_mant=function(valor){ //listar ani cartera operacion y mantenimiento
                    var  html="";
                    $("#Cbx_AnioCartera_operacion_mant").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/programar_pip/GetAnioCarteraProgramado",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["anio"]+"> "+registros[i]["anio"]+" </option>";
                            };
                            $("#Cbx_AnioCartera_operacion_mant").html(html);
                            var anio_cartera = new Date();
                            var anio_actual = anio_cartera.getFullYear();
                            $('select[name=Cbx_AnioCartera_operacion_mant]').val(anio_actual);
                            //$('select[name=Cbx_AnioCartera_operacion_mant]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                           // $('select[name=Cbx_AnioCartera_operacion_mant]').change();
                            $('.selectpicker').selectpicker('refresh');
                            var anio=$("#Cbx_AnioCartera_operacion_mant").val();
                            lista_programados_operacion_mant(anio);
                           // $("#Cbx_AnioCartera_operacion_mant").trigger("change");
                        }
                    });
                }
                 $("#Cbx_AnioCartera_operacion_mant").change(function() {
                          var anio=$("#Cbx_AnioCartera_operacion_mant").val();
                            lista_programados_operacion_mant(anio);
                        });
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
