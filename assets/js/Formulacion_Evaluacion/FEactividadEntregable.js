$(document).on("ready" ,function()
{
    $("#btn_Addactividad" ).on( "click", function() 
    {
        event.preventDefault();
        $('#validarActividadEntregable').data('formValidation').validate();
        if(!($('#validarActividadEntregable').data('formValidation').isValid()))
        {
            return;
        }
        $.ajax({
            url:base_url+"index.php/FEActividadEntregable/Add_Actividades",
            type:'POST',
            data: $('#form-AddActividades_Entregable').serialize(),
            success:function(resp)
            {
                resp=JSON.parse(resp);
                var txt_id_entregable=parseInt($("#txt_id_entregable").val());
                swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto') ? 'success':'error');
                $('#form-AddActividades_Entregable')[0].reset();
                generarActividadesVertical(txt_id_entregable);
                $('#VentanaActividades').modal('hide');
                refrescarGantt();
                $("#calendarActividadesFE" ).remove();
                generarCalendario(txt_id_entregable);     
                var oTable = $('#datatable-actividadesV').dataTable( );
                oTable.api().ajax.reload();
            },
            error: function ()
            {
                swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
            }
        });
    });
                $("#txt_valoracionEAc").keyup(function(){//verificar si el actividades supera el o no el cien porciento para inavilitar el boton
                   var sumaValoracion=$("#txt_valoracionEAc").val();
                   var  txt_id_entregable =$("#txt_id_entregable").val();
                   var  valoracionCompletada=0;

                  $.ajax({
                              url: base_url+"index.php/FEActividadEntregable/MostrarAvance",//MOSTRAR AVANCE EN UN CAJA DE TEXTO PARA HABILTAR O INHABILTAR
                              type:"POST",
                              data:{txt_id_entregable,txt_id_entregable},
                              success: function(data)
                              {
                             
                                var registros = eval(data); 
                               for (var i = 0; i <registros.length;i++) {
     
                                    valoracionCompletada=parseInt(valoracionCompletada)+parseInt(registros[i]["valoracion"]); //suma actividad

                                 };
                                 //alert(sumaValoracion);
                                 var valoracionRestanteAsignar=100-parseInt(valoracionCompletada);//77
                                 var valoracionCompletadaTemp=parseInt(sumaValoracion);//12//77+12=89

                                 if(valoracionCompletadaTemp<=valoracionRestanteAsignar  !=0 )
                                 {
          
                                      document.getElementById('btn_actividadC').disabled=false;
                                      $("#IdAsignadaActividad").html("Correcto");
                                    
                                 }else
                                 {
                                   document.getElementById('btn_actividadC').disabled=true;
                                     $("#IdAsignadaActividad").html("No es posible asignar esa valoracion");
                                 }
                               }
                        });
              });
                //fin añadir actividades al entregable
                //refrescar gant
                var refrescarGantt=function()
                {
                  gantt.refreshData();
                  gantt.init('gantt_here');
                  gantt.load(window.location.href);
                }


            $("#form-UpdateActividades_Entregable").submit(function(event)
            {
                refrescarGantt();
                event.preventDefault();
                $.ajax({
                    url:base_url+"index.php/FEActividadEntregable/Update_Actividades",
                    type:$(this).attr('method'),
                    data:$(this).serialize(),
                    success:function(resp)
                    { 
                        $("#modalEventoActividades").modal("hide");
                        $('#table_entregable').dataTable()._fnAjaxUpdate();  
                        var tx_IdActividad=$("#tx_IdActividad").val();//catura el id de la actividadd
                        var txt_idEntregable=$("#txt_idEntregable").val();//catura eñ id del entregable
                        $("#calendarActividadesFE" ).remove();
                        CalcularAvanceAc(tx_IdActividad,txt_idEntregable);//calcular elavance de los entregables
                         
                    },
                    error: function ()
                    {
                        swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                    }
                });
            });
                 //fin Sive para calcular el avance del entregable  asocido a una actividad
                  $("#form-AsignacionPersonalActividad").submit(function(event)
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/FEActividadEntregable/AsignacionPersonalActividad",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");              
                            $('#datatable-actividadesV').dataTable()._fnAjaxUpdate();
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  });

  });
function CalcularAvanceAc(txt_NombreActividadAc,txt_idEntregable){//calcula el avance de la actividada
                    event.preventDefault(); 
                  var suma=0;
                   $.ajax({
                           "url":base_url +"index.php/FEActividadEntregable/CalcularAvanceActividad",
                            type:"POST",
                            data:{txt_NombreActividadAc:txt_NombreActividadAc,txt_idEntregable:txt_idEntregable},//sirve para seleccionar el entregable y poder sumar su avance d
                            success:function(respuesta){
                               var registros = eval(respuesta);
                              for (var i = 0; i <registros.length;i++) 
                                {
                                    suma=((registros[i]['Avance']*registros[i]['Valoracion'])/100)+suma;
                                    var id_entregable=registros[i]['id_entregable'];
                               };
                               UpdateEntregableAvance(suma,id_entregable);//para enviar el avance al entregable cuando se actualiza la actividad
                               listarEntregablesFE();

                               generarCalendario(id_entregable);
                               generarActividadesVertical(id_entregable);
                            }
                          });
}
function UpdateEntregableAvance(sumaTotalAvance,id_entregable){//avance total del entregable 
          event.preventDefault(); 
                   $.ajax({
                           "url":base_url +"index.php/FEentregableEstudio/UpdateEntregableAvance",
                            type:"POST",
                            data:{sumaTotalAvance:sumaTotalAvance,id_entregable:id_entregable},
                            success:function(respuesta){
                             get_entregableId(id_entregable);//para traer el id de etapa de estudio
                      },
                      error: function ()
                      {
                          swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                      }
              });
}
  function get_entregableId(id_entregable){//para traer la etaapa de estudio el cual pertenece mi entregable y calcular 
            event.preventDefault();
            $.ajax({
              "url":base_url+"index.php/FEentregableEstudio/get_entregableId",
              type:"POST",
              data:{id_entregable:id_entregable},
              success:function(respuesta){
                var registros = eval(respuesta);  
                         for (var i = 0; i <registros.length;i++) {
                              id_etapa_estudio=registros[i]["id_etapa_estudio"];
                           };    
                    calcular_AvaceFisico(id_etapa_estudio);                   
              }
            });
  }
   function calcular_AvaceFisico(id_etapa_estudio){
       event.preventDefault();
            $.ajax({
              "url":base_url+"index.php/FEentregableEstudio/calcular_AvaceFisico",
              type:"POST",
              data:{id_etapa_estudio:id_etapa_estudio},
              success:function(respuesta){
                var res  ="SE ACTUALIZO EL AVANCE DEL ENTREGABLE Y SU AVANCE FÍSICO"
                swal("",res, "success"); 
              }
            });
  }
  
$(function()
{
    $('#validarActividadEntregable').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            txt_nombre_act:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Nombre Actividad" es requerido.</b>'
                    }
                }
            },
            fechaInicio:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Fecha de Inicio" es requerido.</b>'
                    }
                }
            },
            fechaFin:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Fecha de Fin" es requerido.</b>'
                    }
                }
            },
            txt_valoracionEAc:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Valoración" es requerido.</b>'
                    },
                    regexp:
                    {
                       regexp: /(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{0,2})?)$/,
                       message: '<b style="color: red;">El campo "Valoración" debe se numero mayor a 0 y menor o igual a 100.</b>'
                    }
                }
            }
        }
    });
});
  









               


               