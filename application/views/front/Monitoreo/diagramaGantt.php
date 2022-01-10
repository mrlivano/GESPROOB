<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Diagrama Gantt</title>
</head>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/dhtmlxgantt/dhtmlxgantt.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dhtmlxgantt/dhtmlxgantt_tooltip.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/dhtmlxgantt/dhtmlxgantt.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<style type="text/css">
		html, body{ height:100%; padding:0px; margin:0px; overflow: hidden;}
	</style>
<body>
	<div id="gantt_here" style='width:100%; height:100%;'></div>
	<script type="text/javascript">
  // $(document).ready(
  //   function() {
  //     $('div.gantt_grid_head_cell.gantt_grid_head_text').text('Nombre de Tarea');
  //     $('div.gantt_grid_head_cell.gantt_grid_head_start_date').text('Fecha de Inicio');
  //     $('div.gantt_grid_head_cell.gantt_grid_head_duration').text('Duración');
  //   }
  // );
  var productJSON = <?= json_encode($producto); ?>;
  var product = [], link = [];

  function format(inputDate) {
      var date = new Date(inputDate);
      if (!isNaN(date.getTime())) {
          var day = date.getDate().toString();
          var month = (date.getMonth() + 1).toString();
          // Months use 0 index.

          return (day[0] ? day : '0' + day[0]) + '-' +
              (month[0] ? month : '0' + month[0]) + '-' +
             date.getFullYear();
      }
  }
  console.log(productJSON);

  productJSON.forEach(function callback(currentValue, i, array){
      startDateP = productJSON[i].fecha_inicio_producto != null ? new Date((productJSON[i].fecha_inicio_producto).replace("-",",")) : new Date();
      endDateP = productJSON[i].fecha_fin_producto != null ? new Date((productJSON[i].fecha_fin_producto).replace("-",",")) : new Date();
      product.push({"id":array[i].id_producto, "text":array[i].desc_producto, "start_date":startDateP, "end_date":endDateP, "progress": (array[i].avance_fisico_producto)/100, "open": true});

        productJSON[i].childActividad.forEach(function callback(currentValue, index, array){
          startDateA = array[index].fecha_inicio != null ? new Date(array[index].fecha_inicio.replace("-",",")) : new Date();
          endDateA = array[index].fecha_fin != null ? new Date(array[index].fecha_fin.replace("-",",")) : new Date();
          product.push({"id":array[index].id_actividad, "text":array[index].desc_actividad, "start_date":startDateA, "end_date":endDateA, "parent":productJSON[i].id_producto, "progress": (array[index].avance_fisico_actividad)/100, "open": true});

          link.push({"id":array[index].id_actividad,"source":productJSON[i].id_producto,"target":array[index].id_actividad,"type":"1"});

        });

    });

    gantt.config.scale_unit = "month";
    gantt.config.step = 1;
    gantt.config.date_scale = "%M";
    gantt.config.min_column_width = 30;
    gantt.config.scale_height = 50;

		gantt.locale = {
		    date: {
		        month_full: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		        month_short: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		        day_full: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
		        day_short: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"]
		    },
		    labels: {
		        dhx_cal_today_button: "Hoy",
		        day_tab: "Día",
		        week_tab: "Semana",
		        month_tab: "Mes",
		        new_event: "Nuevo evento",
		        icon_save: "Guardar",
		        icon_cancel: "Cancelar",
		        icon_details: "Detalles",
		        icon_edit: "Editar",
		        icon_delete: "Eliminar",
		        confirm_closing: "",
		        confirm_deleting: "El evento se borrará definitivamente, ¿continuar?",
		        section_description: "Descripción",
		        section_time: "Período",
		        full_day: "Todo el día",
		        confirm_recurring: "¿Desea modificar el conjunto de eventos repetidos?",
		        section_recurring: "Repita el evento",
		        button_recurring: "Impedido",
		        button_recurring_open: "Permitido",
		        button_edit_series: "Editar la serie",
		        button_edit_occurrence: "Editar una copia",
		        agenda_tab: "Día",
		        date: "Fecha",
		        description: "Descripción",
		        year_tab: "Año",
		        week_agenda_tab: "Día",
		        grid_tab: "Reja",
		        drag_to_create: "Drag to create",
		        drag_to_move: "Drag to move",
		        message_ok: "OK",
		        message_cancel: "Cancel",
		        next: "Next",
		        prev: "Previous",
		        year: "Year",
		        month: "Month",
		        day: "Day",
		        hour: "Hour",
		        minute: "Minute",

		        /* grid columns */

		        column_text :  "Nueva tarea",
		        column_start_date : "Fecha inicial",
		        column_duration : "Duración",
		        column_add : "",


		        /* link confirmation */

		        confirm_link_deleting:"será eliminado",
		        link_start: "(inicio)",
		        link_end: "(fin)",

		        type_task: "Tarea",
		        type_project: "Proyecto",
		        type_milestone: "Hito",


		        minutes: "Minutos",
		        hours: "Horas",
		        days: "Días",
		        weeks: "Semanas",
		        months: "Meses",
		        years: "Años"
		    }
		};

    gantt.templates.tooltip_text = function(start,end,task){
        return "<b>Nombre:</b> "+task.text+"<br/><b>Fecha de Inicio:</b> " + format(task.start_date)+"<br/><b>Fecha de Fin:</b> " + format(task.end_date)+"<br/><b>Avance:</b> " + (task.progress*100).toFixed(2) + "%";
    };
    var demo_tasks = {
        "data":product,
        "links":link
    };
		gantt.init("gantt_here");
		gantt.parse(demo_tasks);
	</script>
</body>
