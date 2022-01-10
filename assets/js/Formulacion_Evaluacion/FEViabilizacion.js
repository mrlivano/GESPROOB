$(document).on("ready" ,function()
{
    ListarEvaluacionFE();

    $("#form-AddSituacion").submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/FEsituacion/AddSituacion",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                resp=JSON.parse(resp);
                $('#VentanaSituacionActual').modal('hide');
                swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto') ? 'success':'error');
                $('#table-EvaluacionFE').dataTable()._fnAjaxUpdate();
                formReset();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
        });
    });

    $("#form-AddAsiganarPersona").submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/Estudio_Inversion/AddAsiganarPersona",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                resp=JSON.parse(resp);
                $('#VentanaAsignarPersona').modal('hide');
                swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto') ? 'success':'error');
                $('#table-EvaluacionFE').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion
                formReset();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
        });
    });
//limpiar campos
          function formReset()
          {
          document.getElementById("form-AddSituacion").reset();
           document.getElementById("form-AddAsiganarPersona").reset();
          }

      });
 //LISTAR DENOMINACION DE EvaluacionFE Y EVALUACION EN TABLA
var ListarEvaluacionFE=function()
{
    var table=$("#table-EvaluacionFE").DataTable({
        "processing": true,
        "serverSide":false,
        destroy:true,
        "ajax":
        {
            "url":base_url+"index.php/FEformulacion/GetFEViabilizado",
            "method":"POST",
            "dataSrc":""
        },
       "columns":[
            {"data":"id_pi","visible": false},
            {"data":"codigo_unico_est_inv",
                "mRender": function ( data, type, full )
                {
                    return '<a style="font-weight:normal;font-size:15" type="button" class="VerDetalleFormulacion btn btn-link" data-toggle="modal" data-target="#VerDetalleFormulacion" href="/codigo_unico_est_inv/' + data + '">' + data+ '</a>';
                }
            },
            {"data":"nombre_est_inv"},
            {"data":"provincia"},
            {"data":"distrito"},
            {"data":"denom_nivel_estudio"},

            {"data":"nombres"},
            {"data":"costo_estudio"},
            {"data":"denom_situacion_fe"},
            {"data":"avance_fisico",
                "mRender":function (data,type, full)
                {
                    return "<td class='project_progress'><div class='progress progress_sm'><div class='progress-bar bg-green' role='progressbar' data-transitiongoal='57' style='width: "+data+"%;'></div></div><small>"+data+" % Complado</small></td>";
                }
            },
            {"defaultContent":"<button type='button' class='Situacion btn btn-warning btn-xs' data-toggle='modal' data-target='#VentanaSituacionActual'><i data-toggle='tooltip' title='Asignar Situación' class='fa fa-flag' aria-hidden='true'></i></button><button type='button'  class='AsignarPersona btn btn-info btn-xs' data-toggle='modal' data-target='#VentanaAsignarPersona'><i data-toggle='tooltip' title='Asignar Responsable' class='glyphicon glyphicon-user' aria-hidden='true'></i></button>"}
        ],
        "language":idioma_espanol
    });

    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
    new $.fn.DataTable.Buttons(table, {
        buttons: [
            {
            "extend": "excel",
            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span> Excel</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "pdf",
            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span>PDF</span>",
            "className": "btn btn-white btn-primary btn-bold"
            }
        ]
    });
    table.buttons().container().appendTo( $('.tableTools-container-evaluacion'));
        ListarEvaluacion("#table-EvaluacionFE",table);
        SituacionActual("#table-EvaluacionFE",table);
        RegistarPersona("#table-EvaluacionFE",table);
}
//FIN LISTAR PROYECTOS QUE SE ENCUENTRARN EN EVALUACION
//LISTAR DETALLE DE SITUACION ACTUAL DE UNA PIP EN EVALUACION
var DetalleSitActPipEvaluacion=function(codigo_unico_est_inv,nombre_est_inv)
  {
    html1="";
     $("#table-DetSitActEvaluacionFE").html(html1);
    $.ajax({
    "url":base_url+"index.php/EvaluacionFE/GetDetallesituacionActual",
    type:"post",
    data:{codigo_unico_est_inv:codigo_unico_est_inv},
     success:function(respuesta)
                      {
                         var registros = eval(respuesta);
                        console.log(registros);
                         html1+="<thead> <tr><th  class='active'><h5>CODIGO UNICO </h5></th> <th class='active'><h5>NOMBRE DEL ESTUDIO </h5></th><th class='active'><h5>EVALUADOR</h5></th>  <th class='active'><h5>CARGO</h5></th><th class='active'><h5>OBSERVACIONES</h5></th><th class='active'><h5>FECHA</h5></th></tr></thead>"
                         for (var i = 0; i <registros.length;i++) {
                              html1 +="<tbody> <tr><th>"+registros[i]["codigo_unico_est_inv"]+"</th><th>"+nombre_est_inv+"</th><th>"+registros[i]["Evaluador"]+"</th><th>"+registros[i]["desc_cargo"]+"</th><th>"+registros[i]["observacion"]+"</th><th>"+registros[i]["fecha"]+"</th></tr>";
                          //alert(suma);
                           };
                             html1 +="</tbody>";
                         $("#table-DetSitActEvaluacionFE").html(html1);

                      }
                    });
    }

  //FIN LISTAR DETALLE DE SITUACION ACTUAL DE UNA PIP EN EVALUACION
          var  ListarEvaluacion=function(tbody,table){
                             $(tbody).on("click","a.VerDetalleFormulacion",function(){
                              var data=table.row( $(this).parents("tr")).data();
                               var codigo_unico_est_inv=data.codigo_unico_est_inv;
                               var nombre_est_inv = data.nombre_est_inv;
                               DetalleSitActPipEvaluacion(codigo_unico_est_inv,nombre_est_inv);
                          });
                      }
 var  SituacionActual=function(tbody,table){
                    $(tbody).on("click","button.Situacion",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var txt_IdEtapa_Estudio=$('#txt_IdEtapa_Estudio').val(data.id_etapa_estudio);
                         listarsituacionFE();
                  });
                }

                var listarsituacionFE=function(valor){
                     html="";
                    $("#Cbx_Situacion").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/FEsituacion/get_FEsituacion",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_situacion_fe"]+"> "+registros[i]["denom_situacion_fe"]+" </option>";
                            };
                            $("#Cbx_Situacion").html(html);
                            $('select[name=Cbx_Situacion]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_Situacion]').change();
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
/*Asiganar Persona*/
 var  RegistarPersona=function(tbody,table){
                    $(tbody).on("click","button.AsignarPersona",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var txt_IdEtapa_Estudio_p=$('#txt_IdEtapa_Estudio_p').val(data.id_etapa_estudio);
                         listarPersonaFE();

                  });
                }
  var listarPersonaFE=function(valor){
                     html="";
                    $("#Cbx_Persona").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/Estudio_Inversion/get_persona",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_persona"]+"> "+registros[i]["nombres_apell"]+" </option>";
                            };
                            $("#Cbx_Persona").html(html);
                            $('select[name=Cbx_Persona]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_Persona]').change();
                            $('.selectpicker').selectpicker('refresh');
                             listarCargoFE();
                        }
                    });
                }

                  var listarCargoFE=function(valor){
                     html="";
                    $("#Cbx_Cargo").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/Estudio_Inversion/get_cargo",
                        type:"POST",
                        success:function(respuesta3)
                        {
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["id_cargo"]+"> "+registros[i]["desc_cargo"]+" </option>";
                            };
                            $("#Cbx_Cargo").html(html);
                            $('select[name=Cbx_Cargo]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Cbx_Cargo]').change();
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
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
