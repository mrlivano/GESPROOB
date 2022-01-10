 $(document).on("ready" ,function(){

              var fecha = new Date();
              var FechaSistema= fecha.getDate();
              $('#FechaActividadCalendar').daterangepicker();
              $('#FechaActividad').daterangepicker();
              $('#FechaActividad').daterangepicker({
              "locale": {
                  "format": "YYYY/MM/DD",
                  "separator": " - ",
                  "applyLabel": "Guardar",
                  "cancelLabel": "Cerrar",
                  "fromLabel": "Desde",
                  "toLabel": "Hasta",
                  "customRangeLabel": "Personalizar",
                  "daysOfWeek": [
                      "Do",
                      "Lu",
                      "Ma",
                      "Mi",
                      "Ju",
                      "Vi",
                      "Sa"
                  ],
                  "monthNames": [
                      "Enero",
                      "Febrero",
                      "Marzo",
                      "Abril",
                      "Mayo",
                      "Junio",
                      "Julio",
                      "Agosto",
                      "Setiembre",
                      "Octubre",
                      "Noviembre",
                      "Diciembre"
                  ],
                  "firstDay": 1
              },
              "startDate": FechaSistema,
              "endDate": FechaSistema,
              "opens": "center"
          });


              listarEntregablesFE();//
              listadoFormuladores();
              listarDenominacionFE();
              listadoPersona();//para las actividades
              valorizacionRestante();
              
              $("#txt_denominacion_entre").change(function(){
                var txt_denominacion_entre        =$("#txt_denominacion_entre").val();
                $("#txt_denoMultiple").val(txt_denominacion_entre);
              });
               $("#Editxt_denominacion_entre").change(function(){
                var txt_denominacion_entre        =$("#Editxt_denominacion_entre").val();
                $("#Editxt_denoMultiple").val(txt_denominacion_entre);
              });

              $("#btn_entregableC").click(function(){//verificar si el entregable supera el o no el cien porciento para inavilitar el boton

                event.preventDefault();
                $('#form-AddEntregable').data('formValidation').validate();
      					if(!($('#form-AddEntregable').data('formValidation').isValid()))
      					{
      						return;
      					}
                   var sumaValoracion=$("#txt_valoracion_entre").val();
                   $.ajax({
                          url: base_url+"index.php/FEentregableEstudio/MostrarAvance",//MOSTRAR AVANCE EN UN CAJA DE TEXTO PARA HABILTAR O INHABILTAR
                          type:"POST",
                          data:{},
                          success: function(data)
                          {

                                var registros = eval(data);
                                var sumaTotalValori=0;
                              	 for (var i = 0; i <registros.length;i++)
                                 {
                                    sumaValoracion=parseInt(sumaValoracion)+parseInt(registros[i]["valoracion"]);
                                    sumaTotalValori=parseInt(registros[i]["valoracion"])+parseInt(sumaTotalValori);
                                 };
                                 if(sumaValoracion>100)
                                 {
                                   	$("#PorcentajeSuperado ").html('');
                                    var restante=(parseInt(sumaValoracion)-100);
                                    document.getElementById('btn_entregableC').disabled=false;
                                    $("#PorcentajeSuperado ").html('<p>Sobrepaso la valorizacion en :'+restante+'%</p>');

                                 }else
                                 {
                                      var txt_nombre_entre        =$("#txt_nombre_entre").val();
            				                  var txt_denominacion_entre  =$("#txt_denoMultiple").val();
            				                  var txt_valoracion_entre    =$("#txt_valoracion_entre").val();
            				                  var txt_observacio_entre    =$("#txt_observacio_entre").val();
            				                 $("#PorcentajeSuperado ").html('');
            				                  var txt_levantamintoO_entre =$("#txt_levantamintoO_entre").val();
            				                  addEntreEstudio(txt_nombre_entre,txt_denominacion_entre,txt_valoracion_entre,txt_observacio_entre,txt_levantamintoO_entre);
                                  	  document.getElementById('btn_entregableC').disabled=false;
                                  	  $('#VentanaEntregable').modal('hide');
                                  	  formLimpiar();
                                 }
                            },
                            error: function ()
                            {
                                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                            }
                        });
              });
              $("#editarbtn_entregableC").click(function(){//verificar si el entregable supera el o no el cien porciento para inavilitar el boton
                   event.preventDefault();
                   $('#form-modificarEntregable').data('formValidation').validate();
          					if(!($('#form-modificarEntregable').data('formValidation').isValid()))
          					{
          						return;
          					}

                          var IdEntregable            =$("#EdiEntregable").val();
				                  var Editxt_nombre_entre  =$("#Editxt_nombre_entre").val();
				                  var Editxt_denoMultiple  =$("#Editxt_denoMultiple").val();
				                  var Editxt_valoracion_entre    =$("#Editxt_valoracion_entre").val();
				                  $("#PorcentajeSuperado ").html('');
				                  editarEntreEstudio(IdEntregable,Editxt_nombre_entre,Editxt_denoMultiple,Editxt_valoracion_entre);
                          document.getElementById('btn_entregableC').disabled=false;
                          $('#VentanaEntregable').modal('hide');
                          formLimpiar();

              });

    $("#form-ObservacionesActividades").submit(function(event)
    {
        var NombreUrlObservacion =document.getElementById('urlDocumentoObservacion').files[0].name;
        $("#NombreUrlObservacion").val(NombreUrlObservacion);
        event.preventDefault();
        var formData=new FormData($("#form-ObservacionesActividades")[0]);
        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            url:base_url+"index.php/FEActividadEntregable/ObservacionActividad",
            data: formData,
            cache: false,
            contentType:false,
            processData:false,
            success:function(resp)
            {
                resp=JSON.parse(resp);
                swal("",resp.mensaje, "success");
                var id_entregable=$("#txtidEntregablePestana").val();
                generarActividadesVertical(id_entregable)
            },
            error:function()
            {
                swal("Error","Usted no tiene permisos para realizar esta Acción", "error");
            }
        });
    });

    $("#form-ObservacionesActividadesLevantamiento").submit(function(event)
    {
        var NombreUrlObservacion =document.getElementById('urlDocumentoObservacionlevantamiento').files[0].name;//$("#urlDocumentoObservacion").val();
        $("#NombreUrlObservacionLevantamiento").val(NombreUrlObservacion);
        event.preventDefault();
        var formData=new FormData($("#form-ObservacionesActividadesLevantamiento")[0]);
        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            url:base_url+"index.php/FEActividadEntregable/LevantaminetoObservacionActividad",
            data: formData,
            cache: false,
            contentType:false,
            processData:false,
            success:function(resp)
            {
                resp=JSON.parse(resp);
                swal("",resp.mensaje, "success");
                var id_entregable=$("#txtidEntregablePestana").val();
                generarActividadesVertical(id_entregable)
            },
            error:function()
            {
                swal("Error","Usted no tiene permisos para realizar esta Acción", "error");
            }
        });
    });
                function getFileExtension(filename)
                {
                  return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
                }

              var txt_id_etapa_estudio=$("#txt_id_etapa_estudio").val();
//Gant
               $("#btn_gant").click(function() {
               $('#ventanagant').modal('toggle');
               $('#ventanagant').modal('show');
            // $('#ventanagant').modal('hide');

              });
              //para agregar entregable
             $("#btn_entregable").click(function() {
                $("#id_etapa_estudioEE").val($("#txt_id_etapa_estudio").val())
              });


               $("body").on("click","#table_entregable tbody th a",function(event){
                  event.preventDefault();
                  identregable = $(this).attr("href");
                  $("#txt_id_entregable").val(identregable);
                  $("#calendarActividadesFE" ).remove();
                  generarCalendario(identregable);//para el calendario
                  generarActividadesVertical(identregable);//para generar calendario en vertical
                  $("#txt_identregable").val(identregable);//para la parte de buscar persona si asignar responsable
                  //entregable_estudio = $(this).parent().parent().children("th:eq(0)").text();
                  //entregable_estudio = $(this).parent().parent().children("th:eq(0)").text();
                });


          $("#form-AsignacionPersonalEntregable").submit(function(event)//para poder añadir personal al entregable
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEentregableEstudio/AsignacionPersonalEntregable",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                          $('#table_entregable').dataTable()._fnAjaxUpdate();
                          //refresca gantt
                          refrescarGantt();
                            var registros = eval(resp);
                          for (var i = 0; i < registros.length; i++) {
                               if(registros[i]["VALOR"]==1){
                                   $('#table_entregable').dataTable()._fnAjaxUpdate();
                                   swal("",registros[i]["MENSAJE"], "success");
                                   $('#form-AddEntregable')[0].reset();
                                   $("#VentanaAsignacionPersonalEntregable").modal("hide");

                               }else{
                                      $('#table_entregable').dataTable()._fnAjaxUpdate();
                                      swal('',registros[i]["MENSAJE"],'error' );
                               }
                           };
                             $('#table_entregable').dataTable()._fnAjaxUpdate();
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  });

          //evento para expandir un panel
          $("div.x_panel ul.panel_toolbox li a.panel-expand").click(function () {
              var panel = $(this).parent().parent().parent().parent().parent();
              //var cerrar = panel.find('.close-link');
              panel.find('.close-link').hide();
              panel.find('.panel-expand').parent().parent().append( '<li class="custom-cerrar"><a ><i class="fa fa-close"></i></a></li>' );
              //attr('class','cerrar');
              panel.css({'background' : '#0f0',
                        'position' : 'absolute',
                        'top': '0px',
                        'left': '0px',
                        'z-index': '99999',
                        'display': 'block',
                        'width': '100%',
                        'height': '100%',
                      });
              /*$('#ventanagant').find('.x_content').html('');
              $('#ventanagant').find('.x_content').html(panel.html());
              $('#ventanagant').modal('show'); */
          })
          $("ul.panel_toolbox li.custom-cerrar").click(function () {
            alert();
            //location.reload();
          });

          $("#profile-tab").click(function() {
             generarCalendarioPestniaCalendar();//actividades
            });

});
 var valorizacionRestante=function()
 {
		var html="";
		$("#PorcentajeRestanteValorizacion").html(html);
		$.ajax({
		url: base_url+"index.php/FEentregableEstudio/MostrarAvance",//Valorizacion restante del entregable
		type:"POST",
		data:{},
			success: function(data)
			{
        var registros = eval(data);
				var sumaTotalValoriEntregable=0;
				for (var i = 0; i <registros.length;i++)
				{
          sumaTotalValoriEntregable=sumaTotalValoriEntregable+Math.trunc(registros[i]["valoracion"]);
				};
			$("#PorcentajeRestanteValorizacion").html("Valorización Restante "+(100-sumaTotalValoriEntregable)+"%");

      if(sumaTotalValoriEntregable>100)
        {
           $("#PorcentajeRestanteValorizacionModificar").html("Valorización Restante "+(100-100)+"%");
        }else{
        }
			}
		});

 }
//limpiar campos
function formLimpiar()
{
	$('#form-AddEntregable')[0].reset();
}
//refrescar gant   ;//listar actividades
function generarCalendarioPestniaCalendar()//actividades
{
  var id_entregable=$("#txtidEntregablePestana").val();
  generarCalendario(id_entregable);
}
function generarCalendarioPestniaListar()//actividades
{
     var id_entregable=$("#txtidEntregablePestana").val();
     generarActividadesVertical(id_entregable)
}
var refrescarGantt=function()
{
  gantt.refreshData();
  gantt.init('gantt_here');
  gantt.load(window.location.href);
}

var addEntreEstudio=function(txt_nombre_entre,txt_denominacion_entre,txt_valoracion_entre,txt_observacio_entre,txt_levantamintoO_entre)//para entregable
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEentregableEstudio/Add_Entregable",
                          type:"POST",
                          data:{txt_nombre_entre:txt_nombre_entre,txt_denominacion_entre:txt_denominacion_entre,txt_valoracion_entre:txt_valoracion_entre,txt_observacio_entre:txt_observacio_entre,txt_levantamintoO_entre:txt_levantamintoO_entre},
                          success:function(resp)
                          {
                           swal("",resp, "success");
                           $('#form-AddEntregable')[0].reset();
                           $("#VentanaEntregable").modal("hide");
                           listarEntregablesFE();
                           $('#table_entregable').DataTable().ajax.reload();
                           valorizacionRestante();
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  };
//lisatra denominacion
var editarEntreEstudio=function(IdEntregable,Editxt_nombre_entre,Editxt_denoMultiple,Editxt_valoracion_entre)
{
		event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEentregableEstudio/editar_Entregable",
                          type:"POST",
                          data:{IdEntregable:IdEntregable,Editxt_nombre_entre:Editxt_nombre_entre,Editxt_denoMultiple:Editxt_denoMultiple,Editxt_valoracion_entre:Editxt_valoracion_entre},
                          success:function(resp)
                          {
                           swal("",resp, "success");
                           $('#form-AddEntregable')[0].reset();
                           $("#ModificarVentanaEntregable").modal("hide");
                           listarEntregablesFE();
                           valorizacionRestante();
                           $('#table_entregable').DataTable().ajax.reload();
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
}

 var listarDenominacionFE=function(){
                  var htmlD="";
                        $("#txt_denominacion_entre").html(htmlD);
                        event.preventDefault();
                        $.ajax({
                            "url":base_url +"index.php/DenominacionFE/GetDenominacionFE",
                            type:"POST",
                            success:function(respuesta){
                             var registros = eval(respuesta);
                                for (var i = 0; i <registros.length;i++) {
                                   htmlD +="<option value="+registros[i]["id_denom_fe"]+"> "+registros[i]["denom_fe"]+" </option>";
                                };
                                $("#txt_denominacion_entre").html(htmlD);
                                $("#Editxt_denominacion_entre").html(htmlD);
                                $('.selectpicker').selectpicker('refresh');
                            }
                        });

              }
//fin listar denominacion
//listar personas para persona en la actividadd

//fin listar persona para actividad
//listar formuladores para agregar un responsable
var listadoFormuladores=function()
{
                    var text_buscarPersona ='Formulador';
                    var table=$("#table_responsableFormulador").DataTable({
                     "processing":true,
                     "serverSide":true,
                      select: true,
                      destroy:true,
                      "fnDrawCallback": function () {
                    // first radio button list selection is not rendered, so needs to be re-drawn
                    $('.radioButtonToCheck input').attr("checked", "checked");
                     },

                         "ajax":{
                                    "url":base_url +"index.php/Personal/BuscarPersonaActividad",
                                    "method":"POST",
                                    data:{text_buscarPersona:text_buscarPersona},
                                    "dataSrc":"data",
                                    },

                                "columns":[
                                   {"defaultContent": "",
                                    "mRender": function (type, full )
                                    {
                                        return '<a type="button" class="btn btn-success btn-xs">Asignar</a>';
                                    }},
                                    {"data":"id_persona","visible": false},
                                    {"data":"nombres"},
                                    {"data":"especialidad"},
                                    {"data":"grado_academico"},
                                ],
                                columnDefs: [ {
						            orderable: false,
						            className: 'select-checkbox',
						            targets:   0
						        } ],
						        select: {
						            style:    'os',
						            selector: 'td:first-child'
						        },
						                                "language":idioma_espanol
                    });

                      $('#table_responsableFormulador_filter input').unbind();

                      $('#table_responsableFormulador_filter input').bind('keyup', function(e)
                      {
                      if(e.keyCode==13)
                      {
                      table.search(this.value).draw();
                    }
              });
               //DataAsignarResponsable("#table_responsableFormulador",table);//para listar y asignar responsables


              $('#table_responsableFormulador tbody').on('click', 'tr', function () {
                  var data =table.row(this).data();
                   $("#txt_idPersona").val(data.id_persona);

              } );
}

//listar persona  para las actividades

var listadoPersona=function()
{
    var table=$("#table_responsableActividad").DataTable({
        "processing":true,
        "serverSide":true,
        select: true,
        destroy:true,
        "ajax":{
            "url":base_url +"index.php/Personal/BuscarPersonaActividad",
            "method":"POST",
            "dataSrc":"data",
        },
        "columns":[
            {"defaultContent": "",
                "mRender": function (type, full )
                {
                    return '<a type="button" class="btn btn-success btn-xs">Asignar</a>';
                }
            },
            {"data":"id_persona","visible": false},
            {"data":"nombres"},
            {"data":"especialidad"},
            {"data":"grado_academico"},
        ],
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        "language":idioma_espanol
    });

    $('#table_responsableActividad_filter input').unbind();
    $('#table_responsableActividad_filter input').bind('keyup', function(e)
    {
        if(e.keyCode==13)
        {
            table.search(this.value).draw();
        }
    });
    $('#table_responsableActividad tbody').on('click', 'tr', function () 
    {
        var data =table.row(this).data();
        $("#txt_idPersonaActividad").val(data.id_persona);
    });
}
//fin listar personal

var generarActividadesVertical=function(id_en)
          {
                    $("#datatable-actividadesV" ).remove();
                    $("#datatable-actividadesV_wrapper" ).remove();
                    tempActividad='<table id="datatable-actividadesV" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">'+
                                  '<thead>'+
                                      '<tr>'+
                                        '<th>Id</th>'+
                                        '<th>Nombres</th>'+
                                        '<th>Responsable</th>'+
                                        '<th>Fecha Inicio</th>'+
                                        '<th>Fecha Final</th>'+
                                        '<th>Valoración</th>'+
                                        '<th>Avance</th>'+
                                        '<th>Estado</th>'+
                                        '<th>Id Observacion</th>'+
                                        '<th>Opciones</th>'+
                                     '</tr>'+
                                  '</thead>'+
                                 '</thead>'+
                                    '<tbody>'+
                                    '</tbody>'+
                              '</table>';
                    $("#TemActividad").append(tempActividad);

                   var table=$("#datatable-actividadesV").DataTable({
                    "deferRender": true,
                    "processing": true,
                    "searching": false,
                    destroy:true,
                    "paging":   false,
                    "info":     false,

                         "ajax":{
                                    "url":base_url+"index.php/FEActividadEntregable/get_Actividades",
                                    "method":"POST",
                                     data:{"id_en":id_en},
                                    "dataSrc":"",
                                    },
                                "columns":[
                                    {"data":"id","visible": false},
                                    {"data":"title"},
                                    {"data":"nombres",
                                        "mRender": function ( data, type, full ) {
                                      var i=data;
                                          if(i==null)
                                          {
                                            nombre="";
                                           return '<a type="button" class="editar btn btn-link" data-toggle="modal" data-target="#VentanaAsignacionPersonalActividad" title="Añadir Responsable" ><i class="glyphicon glyphicon-user" aria-hidden="true"></a></i><font size="1"></br>' +nombre+ '</font>'
                                          }else{
                                             return '<a type="button" class="editar btn btn-link" data-toggle="modal" data-target="#VentanaAsignacionPersonalActividad" title="Añadir Responsable" ><i class="glyphicon glyphicon-user" aria-hidden="true"></a></i><font size="1"></br>' +data+ '</font>'
                                          }
                                      }

                                    },
                                    {"data":"start"},
                                    {"data":"end"},
                                    {"data":"valoracion",
                                      "mRender":function (data,type, full) {
                                         return "<td class='project_progress'><div class='progress progress_sm'><div class='progress-bar bg-orange' role='progressbar' data-transitiongoal='57' style='width: "+data+"%;'></div></div><small>"+data+" % Complete</small> </td>";
                                    }},
                                    {"data":"avance",
                                      "mRender":function (data,type, full) {
                                         return "<td class='project_progress'><div class='progress progress_sm'><div class='progress-bar bg-green' role='progressbar' data-transitiongoal='57' style='width: "+data+"%;'></div></div><small>"+data+" % Complete</small></td>";
                                    }},
                                    {"data":"estado_obs",
                                      "mRender":function (data,type, full)
                                       {
                                         var i=data;
                                         if(i==0)
                                         {
                                             return "<ul class='list-inline prod_color'><div class='color bg-red'><br/></div></ul>Observado</br><a type='button' class='ListarObservaciones btn btn-link' data-toggle=modal data-target='#ListaObservaciones' title='Ver Observacione' ><i class='glyphicon glyphicon-triangle-top' aria-hidden='true'></a>";
                                         }
                                         if(i==1)
                                         {
                                             return "<ul class='list-inline prod_color'><div class='color bg-green'><br/></div></ul>Levanto <a type='button' class='ListarObservaciones btn btn-link' data-toggle=modal data-target='#ListaObservaciones' title='Ver Observacione'><i class='glyphicon glyphicon-triangle-top' aria-hidden='true'></a>";

                                         }
                                         if(i==null)
                                         {
                                           return "Sin Observaciones ";
                                         }

                                       }

                                    },
                                    {"data":"id_act_observacion","visible":false},

//{"defaultContent":" <div class='btn-group'> <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button' aria-expanded='false'>Opciones <span class='caret'></span> </button> <ul class='dropdown-menu'> <li><button type='button' title='Editar Actividad' class='edit btn btn-info btn-xs' data-toggle='modal' data-target='#modalModificarActividades'><i class='fa fa-edit' aria-hidden='true'></i> Editar Actividad</button> </li>  <li> <button type='button' title='Agregar Observación' class='actividadObservaciones btn btn-warning btn-xs' data-toggle='modal' data-target='#modalObservacionesActividades'><i class='fa fa-plus' aria-hidden='true'></i> Observaciones</button></li><li><button type='button' title='Levantar Observaciones' class='LevantarActividadObservaciones btn btn-info btn-xs' data-toggle='modal' data-target='#LevatarmodalObservacionesLevantar'><i class='fa fa-paw' aria-hidden='true'></i> Levantar Observación</button></li></ul> </div>"}  
//{"defaultContent":"<div class='dropdown'>  <a class='btn btn-link dropdown-toggle' type='button' data-toggle='dropdown'> <span class='glyphicon glyphicon-option-vertical' aria-hidden='true'></span></a> <ul class='dropdown-menu pull-right' style=''> <li><button type='button' class='edit btn btn-primary btn-xs' data-toggle='modal' data-target='#modalModificarActividades'>Editar Actividad</button><button type='button' class='actividadObservaciones btn btn-primary btn-xs' data-toggle='modal' data-target='#modalObservacionesActividades'> Observaciones </button> <button type='button' class='LevantarActividadObservaciones btn btn-primary btn-xs' data-toggle='modal' data-target='#LevatarmodalObservacionesLevantar'> Levantar Observación </button></ul>  </div>"}
  

{"defaultContent":"<div class='dropdown'>  <a class='btn btn-link dropdown-toggle' type='button' data-toggle='dropdown'> <span class='glyphicon glyphicon-option-vertical' aria-hidden='true'></span></a> <ul class='dropdown-menu pull-right' style=''> <li><button type='button' class='actividadObservaciones btn btn-primary btn-xs' data-toggle='modal' data-target='#modalObservacionesActividades'> Observaciones </button> <button type='button' class='LevantarActividadObservaciones btn btn-primary btn-xs' data-toggle='modal' data-target='#LevatarmodalObservacionesLevantar'> Levantar Observación </button></ul>  </div>"}
                                ],

                                "language":idioma_espanol
                    });

              ActualizarActividadEntregableData("#datatable-actividadesV",table); //TRAER DATOS PARA ACTUALIZAR

                 $('#datatable-actividadesV tbody').on('click', 'tr', function ()
                 {
                               var data = table.row($(this)).data();
                               var id_ctividad=data.id;
                               var txt_idActividadCronograma=$("#txt_idActividadCronograma").val(id_ctividad);
                               $("#txt_NombreActividadTitleResponsable").html(data.title);
                               $("#txt_idActividadCronograma").val(id_ctividad);
                   });

                 ObservacionesActividad("#datatable-actividadesV",table);
                 LevantamientoObservacionesActividad("#datatable-actividadesV",table);
                 ListarObservacionesActividad("#datatable-actividadesV",table);

  }


      //ACTUALIZAR ACTIVIDAD ENTREGABLES
      $("#form-ActualizarActividadEntregable").submit(function(event)
      {
        event.preventDefault();

        $.ajax(
        {
          url : base_url+"index.php/FEActividadEntregable/Update_Actividades",
          type : $(this).attr('method'),
          data : $(this).serialize(),
          success : function(resp)
          {
            swal("MODIFICADO!", resp, "success");

            $('#datatable-actividadesV').dataTable()._fnAjaxUpdate();

            $('#modalModificarActividades').modal('hide');
          },
          error: function ()
          {
              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
          }
        });
      });


          // CAMPOS QUE SE ACTUALIZARAN DE ACTIVIDAD ENTEGABLES
        ActualizarActividadEntregableData=function(tbody,table){
                    $(tbody).on("click","button.edit",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_actividad=$('#tx_IdActividad').val(data.id_actividad);
                        var id_entregable=$('#txt_idEntregable').val(data.txt_idEntregable);
                    });
                }
          // FIN DE CAMPOS QUE SE ACTUALIZARAN DE LA MODALIDAD EJECUCION





   var  ObservacionesActividad=function(tbody,table)
                  {
                            $(tbody).on("click","button.actividadObservaciones",function(){
                              var data=table.row( $(this).parents("tr")).data();
                                    $('#tx_IdActividadObser').val(data.id);
                             });
                  }
     var  LevantamientoObservacionesActividad=function(tbody,table)
                  {
                            $(tbody).on("click","button.LevantarActividadObservaciones",function(){
                              var data=table.row( $(this).parents("tr")).data();
                                    $('#tx_IdActividadLevantamiento').val(data.id_act_observacion);
                             });
                  }
       var  ListarObservacionesActividad=function(tbody,table)
                  {
                            $(tbody).on("click","a.ListarObservaciones",function(){
                              var data=table.row( $(this).parents("tr")).data();
                                    var idActividad=data.id;//$('#tx_IdActividadLevantamiento').val(data.id);
                                    listadoObservacion(idActividad);
                             });
                  }
      function listadoObservacion(idActividad)
        {
                  $.ajax({
                          url:base_url+"index.php/FEActividadEntregable/listadoObservacion",
                          type:'POST',
                          data:{idActividad:idActividad},
                          success:function(resp)
                          {
                               $("#ListadoObservaciones" ).remove();
                               var tempActividad='<table id="ListadoObservaciones" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">'+
                                  '<thead>'+
                                      '<tr>'+
                                        '<th>Observación</th>'+
                                        '<th>Documento</th>'+
                                        '<th>Levantamiento</th>'+
                                        '<th>Documento</th>'+
                                        '<th>Fecha Inicio</th>'+
                                        '<th>Fecha Fin</th>'+
                                        '<th>Estado</th>'+

                                     '</tr>'+
                                  '</thead>'+
                                 '</thead>'+
                                  '<tbody>';
                              var registros = eval(resp);
                              for (var i = 0; i < registros.length; i++)
                               {
                              	if(registros[i]['estado_obs']==1)
                              	{
	                              	tempActividad +='<tr>';
	                              		tempActividad +='<td>'+registros[i]['desc_obsrevacion']+'</td><td>'+registros[i]['doc_observacion']+'</td><td>'+registros[i]['desc_levantamiento']+'</td><td>'+registros[i]['doc_levantamiento']+'</td><td>'+registros[i]['fecha_observacion']+'</td><td>'+registros[i]['fecha_levantamiento']+'</td><td><ul class="list-inline prod_color"><div class="color bg-green"><br/></div></ul>Levanto</td>';
	                              	tempActividad +='</tr>';
                              	}
                              	if(registros[i]['estado_obs']==0)
                              	{
	                              	tempActividad +='<tr>';
	                              		tempActividad +='<td>'+registros[i]['desc_obsrevacion']+'</td><td>'+registros[i]['doc_observacion']+'</td><td>'+registros[i]['desc_levantamiento']+'</td><td>'+registros[i]['doc_levantamiento']+'</td><td>'+registros[i]['fecha_observacion']+'</td><td>'+registros[i]['fecha_levantamiento']+'</td><td> <ul class="list-inline prod_color"><div class="color bg-red"><br/></div></ul>Observado</td>';
	                              	tempActividad +='</tr>';
                              	}
                              	if(registros[i]['estado_obs']==null)
                              	{
	                              	tempActividad +='<tr>';
	                              		tempActividad +='<td>'+registros[i]['desc_obsrevacion']+'</td><td>'+registros[i]['desc_levantamiento']+'</td><td>'+registros[i]['fecha_observacion']+'</td><td>'+registros[i]['fecha_levantamiento']+'</td><td> Sin Observaciones </td>';
	                              	tempActividad +='</tr>';
                              	}

                               }
                               tempActividad +='</tbody>';
                               tempActividad +='</table>';
                               $("#TemActividadObservaciones").append(tempActividad);

                          }
                      });
        }

  function listarEntregablesFE()
          {
              $("#table_entregable" ).remove();
                    $("#table_entregable_wrapper" ).remove();
                    tempEntregable='<table id="table_entregable" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">'+
                                  '<thead>'+
                                      '<tr>'+
                                        '<td></td>'+
                                        '<td></td>'+
                                        '<td>Entregable</td>'+
                                        '<td>Responsable</td>'+
                                        '<td>Valorización</td>'+
                                        '<td>Avance</td>'+
                                        '<td>Acción</td>'+
                                     '</tr>'+
                                  '</thead>'+
                                 '</thead>'+
                                    '<tbody>'+
                                    '</tbody>'+
                              '</table>';
                       $("#TemEntregable").append(tempEntregable);
                var table=$("#table_entregable").DataTable({
                     "deferRender": true,
                    "processing": true,
                     "searching": false,
                    destroy:true,
                    "info":     false,
                    "paging":   false,

                         "ajax":{
                                    "url":base_url+"index.php/FEentregableEstudio/get_Entregables",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_denom_fe","visible":false},
                                    {"data":"id_entregable","visible":false},
                                    {"data":"nombre_entregable","mRender":function (data,type, full) {
                                         return "<b>"+full.denom_fe+": </b>"+data+"</br><button type='button'  class='ListarActividad btn-success  btn-xs' title='Mostrar  Actividades' ><i class='glyphicon glyphicon-calendar' aria-hidden='true'></i></button></br></br>";
                                    }},
                                    {"data":"responsable",
                                    "mRender": function ( data, type, full ) {
                                      var i=data;
                                          if(i==null)
                                          {
                                            nombre="";
                                           return '<a  type="button" class="AsignacionPersonaEntregables btn btn-link" data-toggle="modal" data-target="#VentanaAsignacionPersonalEntregable" title="Añadir Responsable" ><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i></a><i class="glyphicon glyphicon-user" aria-hidden="true"></i><font size="1"></br>' +nombre+ '</font>'
                                          }else{
                                             return '<a type="button" class="AsignacionPersonaEntregables btn btn-link" data-toggle="modal" data-target="#VentanaAsignacionPersonalEntregable" title="Añadir Responsable" ><i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i></a><button type="button"  class="ListarResponsablesEntregable btn btn-primary btn-xs" data-toggle="modal" data-target="#VentenaResponsablesEntregable" title="Mostrar los responsables del entregable"><i class="glyphicon  glyphicon-user"></i></button><font size="1"></br>'+data+ '</font>'
                                          }
                                      }
                                    },
                                    {"data":"valoracion",
                                      "mRender":function (data,type, full) {
                                         return "<td class='project_progress'><div class='progress progress_sm'><div class='progress-bar bg-orange' role='progressbar' data-transitiongoal='57' style='width: "+data+"%;'></div></div><small>"+data+" % Completado</small></td>";
                                    }},
                                    {"data":"avance",
                                      "mRender":function (data,type, full) {
                                         return "<td class='project_progress'><div class='progress progress_sm'><div class='progress-bar bg-green' role='progressbar' data-transitiongoal='57' style='width: "+data+"%;'></div></div><small>"+data+" % Completado</small></td>" ;
                                    }},
{"defaultContent":" <div class='btn-group'> <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button' aria-expanded='false'>Opciones <span class='caret'></span> </button> <ul class='dropdown-menu'> <li><button type='button' title='Agregar Actividad' class='actividad btn btn-info btn-xs' data-toggle='modal' data-target='#VentanaActividades'><i class='fa fa-tasks' aria-hidden='true'></i> Agregar Actividad</button> </li>  <li> <button type='button' title='Editar Entregable' class='EditarEntregable btn btn-warning btn-xs' data-toggle='modal' data-target='#ModificarVentanaEntregable'><i class='fa fa-edit' aria-hidden='true'></i> Editar Entregable</button></li></ul> </div>"}                               
                                ],

                                "language":idioma_espanol,
                                "order": [[ 0, "desc" ]]
                    });

                     addActividades("#table_entregable",table);
                     getActividad("#table_entregable",table);
                     AsignacionPersonaEntregables("#table_entregable",table);
                     ListaResponsableEntregable("#table_entregable",table);
                     ModificarEntregable("#table_entregable",table);
              }
              	  var  ModificarEntregable=function(tbody,table)
              	  {
              	  	$(tbody).on("click","button.EditarEntregable",function(){
                              var data=table.row( $(this).parents("tr")).data();
                              		  $('#EdiEntregable').val(data.id_entregable);
                              		  $('#Editxt_nombre_entre').val(data.nombre_entregable);
                              		  $('#Editxt_denoMultiple').val(data.id_denom_fe);
                             		    $('#Editxt_valoracion_entre').val(data.valoracion);
                             });
              	  }
                  var AsignacionPersonaEntregables=function(tbody,table){
                           $(tbody).on("click","a.AsignacionPersonaEntregables",function(){
                              var data=table.row($(this).parents("tr")).data();
                              $('#txt_identregable').val(data.id_entregable);
                               var id_entregable=data.id_entregable;
                               $("#calendarActividadesFE" ).remove();
                                generarCalendario(data.id_entregable);//Generar calendario
                             });
                  }
                  //listar responsables de cada entregable
                   var ListaResponsableEntregable=function(tbody,table){
                           $(tbody).on("click","button.ListarResponsablesEntregable",function(){
                                  var data=table.row( $(this).parents("tr")).data();
                                  id_entregable=data.id_entregable;
                                  $("#LabelEntregable").html(data.nombre_entregable);
                                  ListaResponsableEntregableT(id_entregable);//listar responsable de los entregables
                             });
                  }
                  //fin listar responsables de cada entregable

                   var  addActividades=function(tbody,table){
                             $(tbody).on("click","button.actividad",function(){
                              var data=table.row( $(this).parents("tr")).data();
                              $('#txt_id_entregable').val(data.id_entregable);
                              id_entregable=data.id_entregable;
                              valorizacionRestanteActividad(id_entregable);
                              $("#LabelEntregable").html(data.nombre_entregable);
                              ListaResponsableEntregableT(id_entregable);//listar responsable de los entregables
                              $("#datatable-actividadesV" ).remove();
                              $("#txtidEntregablePestana").val(data.id_entregable);
                              generarCalendario(data.id_entregable);//Generar calendario
                              generarActividadesVertical(data.id_entregable);
                             });
                         }
                  var  getActividad=function(tbody,table){
                             $(tbody).on("click","button.ListarActividad",function(){
                              var data=table.row( $(this).parents("tr")).data();
                              generarActividadesVertical(data.id_entregable);//listar actividades
                              var nombre_entregable=data.nombre_entregable;
                              $("#nombreEntregable").html('Actividad del Entregable "'+nombre_entregable+'"');
                              $("#calendarActividadesFE" ).remove();
                               $("#txtidEntregablePestana").val(data.id_entregable);
                              generarCalendario(data.id_entregable);//Generar calendario

                             });
                         }
          function ListaResponsableEntregableT(id_entregable){
            var table=$("#table_responsableEntregable").DataTable({
                 "processing":true,
                  "serverSide":false,
                  "searching": false,
                    destroy:true,
                    "paging":   false,
                    "info":     false,

                     "ajax":{
                                "url":base_url+"index.php/FEentregableEstudio/get_ResponsableEntregableE",//lista de entregables
                                "method":"POST",
                                 data:{"id_entregable":id_entregable},
                                "dataSrc":"",
                                },
                            "columns":[
                                {"data":"nombre"},
                                {"data":"dni"},
                                {"data":"fecha_asignacion_entregable"}
                            ],

                            "language":idioma_espanol
                          });

                  }

            var valorizacionRestanteActividad=function(id_entregable)
            {
            	$.ajax({
      							url: base_url+"index.php/FEActividadEntregable/VerValoracionRestanteActividad",//MOSTRAR AVANCE EN UN CAJA DE TEXTO PARA HABILTAR O INHABILTAR
      							type:"POST",
      							data:{id_entregable:id_entregable},
      								success: function(data)
      								{
      								var registros = eval(data);
      									var sumaTotalValoriEntregable=0;
      									for (var i = 0; i <registros.length;i++)
      									{
      										var sumaTotalValoriActidadese=parseInt(registros[i]["valoracion"]);
      									};
      									if(registros.length<=0)
      									{
      									var valoracion=100;
      								    $("#valoracionAvazadadActivi").html(" Valoración Restante "+(valoracion)+"%");
      								    }else
      								    {
      								     $("#valoracionAvazadadActivi").html(" Valoración Restante "+(100-parseInt(sumaTotalValoriActidadese))+" %");
      								    }
      								}
               		});
             }
//generar actividades en el calendar
          function generarCalendario(id_en)
          {


                  var $myNewElement = $('<div id="calendarActividadesFE"></div>');
                  $myNewElement.appendTo('#contenidoActividadesFE');

                    var initialLocaleCode = 'es';
                     $('#calendarActividadesFE').fullCalendar({
                      header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listMonth'
                      },

                     locale: initialLocaleCode,
                      //buttonIcons: false, // show the prev/next text
                      //weekNumbers: true,
                      //navLinks: true, // can click day/week names to navigate views
                      editable: true,
                      //eventLimit: true, // allow "more" link when too many events
                      events:{
                        url: base_url+"index.php/FEActividadEntregable/get_Actividades",
                        type:"POST",
                        data:{id_en:id_en},
                        error: function() {
                          $('#script-warning').show();
                        }
                      },
                      loading: function(bool) {
                        $('#loading').toggle(bool);
                      },
                      eventClick: function(event, jsEvent, view) {
                        $('#tx_IdActividad').val(event.id);
                        $('#txt_idEntregable').val(event.id_entregable);
                        $('#txt_NombreActividadTitle').html(event.title);
                        $('#txt_NombreActividadAc').val(event.title);
                        $('#txt_ActividadColorAc').val(event.color);
                        $('#txt_avanceEAct').val(event.avance);
                        $('#txt_valorizacionEAct').val(event.valoracion);
                        $('#txt_observacio_EntreAct').val(event.Observacion);
                        $('#fechaInicioEdit').val(event.startEdit);
                        $('#fechaFinEdit').val(event.endEdit);

                        $('#modalEventoActividades').modal();
                        if (event.url) {
                          window.open(event.url);
                          return false;
                        }

                      }

                    });
                //fin generacion de actividades
          }
