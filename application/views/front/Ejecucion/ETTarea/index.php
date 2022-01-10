<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>SIGEI</title>

	<link rel="stylesheet" href="<?=base_url()?>assets/vendors/JQueryGantt/platform.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendors/JQueryGantt/libs/jquery/dateField/jquery.dateField.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendors/JQueryGantt/gantt.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendors/JQueryGantt/ganttPrint.css" type="text/css" media="print">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/js/sweetalert.css">

	<style>
		.resEdit
		{
			padding: 15px;
		}

		.resLine
		{
			width: 95%;
			padding: 3px;
			margin: 5px;
			border: 1px solid #d0d0d0;
		}

		body
		{
			overflow: hidden;
		}

		.ganttButtonBar h1
		{
			color: #000000;
			font-weight: bold;
			font-size: 28px;
			margin-left: 10px;
		}
	</style>

	<script src="<?=base_url()?>assets/vendors/jquery/dist/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/vendors/jquery/dist/jquery-ui.min.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/jquery/jquery.livequery.1.1.1.min.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/jquery/jquery.timers.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/utilities.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/forms.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/date.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/dialogs.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/layout.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/i18nJs.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/jquery/dateField/jquery.dateField.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/jquery/JST/jquery.JST.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/jquery/svg/jquery.svg.min.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/libs/jquery/svg/jquery.svgdom.1.8.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/ganttUtilities.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/ganttTask.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/ganttDrawerSVG.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/ganttGridEditor.js"></script>
	<script src="<?=base_url()?>assets/vendors/JQueryGantt/ganttMaster.js"></script>
	<script src="<?=base_url()?>assets/dist/js/sweetalert-dev.js"></script>
	<script src="<?=base_url()?>assets/js/Helper/jsHelper.js"></script>
</head>
<body style="background-color: #ffffff;overflow-x: hidden;">
	<input type="hidden" id="hdIdTareaGantt" name="hdIdTareaGantt" value="<?=$idTareaGantt?>">

	<input type="hidden" id="hdIdET" name="hdIdET" value="<?=$idExpedienteTecnico?>">

	<div id="workSpace" style="padding: 0px;overflow-y: auto;overflow-x: hidden;position: relative;margin: 0 5px;width: 100%;height: 100%;"></div>

	<script>
		var ge;

		$(function()
		{
			var canWrite=true;//this is the default for test purposes

			// here starts gantt initialization
			ge=new GanttMaster();
			ge.set100OnClose=true;

			ge.init($("#workSpace"));
			loadI18n();//overwrite with localized ones

			//in order to force compute the best-fitting zoom level
			delete ge.gantt.zoom;

			var project=loadFromDataServer();

			if (!project.canWrite)
			{
				$(".ganttButtonBar button.requireWrite").attr("disabled","true");
			}

			ge.loadProject(project);

			ge.checkpoint();//empty the undo stack

		});



		function loadGanttFromServer(taskId, callback)
		{
			loadFromDataServer();
		}


		function saveGanttOnServer()
		{
			var prj=ge.saveProject();

			paginaAjaxJSON({ "idExpedienteTecnico":$('#hdIdET').val(), "idTareaGantt" : $('#hdIdTareaGantt').val(), "tareas" : JSON.stringify(prj.tasks) }, '<?=base_url()?>index.php/ET_Tarea/insertarBloque', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
				},
				function()
				{
					if(objectJSON.proceso=='Error')
					{
						return false;
					}

					renderLoading();

					window.location.href='<?=base_url()?>index.php/ET_Tarea/index?id_et=<?=$idExpedienteTecnico?>';
				});
			}, false, true);
		}

		function newProject()
		{
			clearGantt();
		}

		function clearGantt()
		{
			ge.reset();
		}

		function loadI18n()
		{
			/*
			GanttMaster.messages=
			{
				"CANNOT_WRITE" : "CANNOT_WRITE",
				"CHANGE_OUT_OF_SCOPE" : "NO_RIGHTS_FOR_UPDATE_PARENTS_OUT_OF_EDITOR_SCOPE",
				"START_IS_MILESTONE" : "START_IS_MILESTONE",
				"END_IS_MILESTONE" : "END_IS_MILESTONE",
				"TASK_HAS_CONSTRAINTS" : "TASK_HAS_CONSTRAINTS",
				"GANTT_ERROR_DEPENDS_ON_OPEN_TASK" : "GANTT_ERROR_DEPENDS_ON_OPEN_TASK",
				"GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK" : "GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK",
				"TASK_HAS_EXTERNAL_DEPS" : "TASK_HAS_EXTERNAL_DEPS",
				"GANTT_ERROR_LOADING_DATA_TASK_REMOVED" : "GANTT_ERROR_LOADING_DATA_TASK_REMOVED",
				"ERROR_SETTING_DATES" : "ERROR_SETTING_DATES",
				"CIRCULAR_REFERENCE" : "No se puede realizar una referencia circular",
				"CANNOT_DEPENDS_ON_ANCESTORS" : "CANNOT_DEPENDS_ON_ANCESTORS",
				"CANNOT_DEPENDS_ON_DESCENDANTS" : "CANNOT_DEPENDS_ON_DESCENDANTS",
				"INVALID_DATE_FORMAT" : "Formato de fecha incorrecto",
				"TASK_MOVE_INCONSISTENT_LEVEL" : "TASK_MOVE_INCONSISTENT_LEVEL",
				"GANTT_QUARTER_SHORT" : "trim.",
				"GANTT_SEMESTER_SHORT" : "sem."
			};
			*/
			GanttMaster.messages=
			{
				"CANNOT_WRITE" : "NO SE PUEDE GRABAR",
				"CHANGE_OUT_OF_SCOPE" : "NO HAY DERECHOS PARA ACTUALIZAR A LOS PADRES FUERA DEL EDITOR ÁMBITO",
				"START_IS_MILESTONE" : "EL COMIENZO ES UN HITO",
				"END_IS_MILESTONE" : "EL FIN ES UN HITO",
				"TASK_HAS_CONSTRAINTS" : "LA TAREA TIENE RESTRICCIONES",
				"GANTT_ERROR_DEPENDS_ON_OPEN_TASK" : "ERROR DE GANTT AL DEPENDER DE UNA TAREA ABIERTA",
				"GANTT_ERROR_DESCENDANT_OF_CLOSED_TASK" : "ERROR DE GANTT DESCENDIENTE DE UNA TAREA CERRADA",
				"TASK_HAS_EXTERNAL_DEPS" : "LA TAREA TIENE DEPENDIENTES EXTERNOS",
				"GANTT_ERROR_LOADING_DATA_TASK_REMOVED" : "ERROR DE GANTT AL CARGAR LA TAREA DE DATOS ELIMINADOS",
				"ERROR_SETTING_DATES" : "ERROR AL CONFIGURAR FECHAS",
				"CIRCULAR_REFERENCE" : "NO SE PUEDE REALIZAR UNA REFERENCIA CIRCULAR",
				"CANNOT_DEPENDS_ON_ANCESTORS" : "NO PUEDE DEPENDER DE ANTEPASADOS",
				"CANNOT_DEPENDS_ON_DESCENDANTS" : "NO PUEDE DEPENDER DE DESCENDIENTES",
				"INVALID_DATE_FORMAT" : "FORMATO DE FECHA INVALIDOS",
				"TASK_MOVE_INCONSISTENT_LEVEL" : "TAREA MOVIDA A UN NIVEL INCONSISTENTE",
				"GANTT_QUARTER_SHORT" : "trim.",
				"GANTT_SEMESTER_SHORT" : "sem."
			};
		}

		function loadFromDataServer()
		{
			var rows = JSON.parse('<?=$arrayTask ?>');

			var ret=
			{
				"tasks" : rows,
				"selectedRow" : 0,
				"deletedTaskIds" : [],
				"resources" : [],
				"roles" : [],
				"canWrite" : true,
				"canDelete" : true,
				"canWriteOnParent" : true,
				"zoom" : "w3"
			};

			return ret;
		}
	</script>

	<div id="gantEditorTemplates" style="display:none;">
		<div class="__template__" type="GANTBUTTONS"><!--
			<div class="ganttButtonBar noprint">
			<div class="buttons">
			Gantt ET
			<button onclick="$('#workSpace').trigger('undo.gantt');return false;" class="button textual icon requireCanWrite" title="undo"><span class="teamworkIcon">&#39;</span></button>
			<button onclick="$('#workSpace').trigger('redo.gantt');return false;" class="button textual icon requireCanWrite" title="redo"><span class="teamworkIcon">&middot;</span></button>
			<span class="ganttButtonSeparator requireCanWrite requireCanAdd"></span>
			<button onclick="$('#workSpace').trigger('addAboveCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="insert above"><span class="teamworkIcon">l</span></button>
			<button onclick="$('#workSpace').trigger('addBelowCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanAdd" title="insert below"><span class="teamworkIcon">X</span></button>
			<span class="ganttButtonSeparator requireCanWrite requireCanInOutdent"></span>
			<button onclick="$('#workSpace').trigger('outdentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="un-indent task"><span class="teamworkIcon">.</span></button>
			<button onclick="$('#workSpace').trigger('indentCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanInOutdent" title="indent task"><span class="teamworkIcon">:</span></button>
			<span class="ganttButtonSeparator requireCanWrite requireCanMoveUpDown"></span>
			<button onclick="$('#workSpace').trigger('moveUpCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="move up"><span class="teamworkIcon">k</span></button>
			<button onclick="$('#workSpace').trigger('moveDownCurrentTask.gantt');return false;" class="button textual icon requireCanWrite requireCanMoveUpDown" title="move down"><span class="teamworkIcon">j</span></button>
			<span class="ganttButtonSeparator requireCanDelete"></span>
			<button onclick="$('#workSpace').trigger('deleteFocused.gantt');return false;" class="button textual icon delete requireCanWrite" title="Delete"><span class="teamworkIcon">&cent;</span></button>
			<span class="ganttButtonSeparator"></span>
			<button onclick="$('#workSpace').trigger('expandAll.gantt');return false;" class="button textual icon " title="EXPAND_ALL"><span class="teamworkIcon">6</span></button>
			<button onclick="$('#workSpace').trigger('collapseAll.gantt'); return false;" class="button textual icon " title="COLLAPSE_ALL"><span class="teamworkIcon">5</span></button>

			<span class="ganttButtonSeparator"></span>
			<button onclick="$('#workSpace').trigger('zoomMinus.gantt'); return false;" class="button textual icon " title="zoom out"><span class="teamworkIcon">)</span></button>
			<button onclick="$('#workSpace').trigger('zoomPlus.gantt');return false;" class="button textual icon " title="zoom in"><span class="teamworkIcon">(</span></button>
			<span class="ganttButtonSeparator"></span>
			<button onclick="print();return false;" class="button textual icon " title="Print"><span class="teamworkIcon">p</span></button>
			<span class="ganttButtonSeparator"></span>
			<button onclick="ge.gantt.showCriticalPath=!ge.gantt.showCriticalPath; ge.redraw();return false;" class="button textual icon requireCanSeeCriticalPath" title="CRITICAL_PATH"><span class="teamworkIcon">&pound;</span></button>
			<span class="ganttButtonSeparator requireCanSeeCriticalPath"></span>
			<button onclick="ge.splitter.resize(.1);return false;" class="button textual icon" ><span class="teamworkIcon">F</span></button>
			<button onclick="ge.splitter.resize(50);return false;" class="button textual icon" ><span class="teamworkIcon">O</span></button>
			<button onclick="ge.splitter.resize(100);return false;" class="button textual icon"><span class="teamworkIcon">R</span></button>
			<span class="ganttButtonSeparator"></span>
			<button onclick="$('#workSpace').trigger('fullScreen.gantt');return false;" class="button textual icon" title="FULLSCREEN" id="fullscrbtn"><span class="teamworkIcon">@</span></button>
			<button onclick="ge.element.toggleClass('colorByStatus' );return false;" class="button textual icon"><span class="teamworkIcon">&sect;</span></button>

			<button onclick="editResources();" class="button textual requireWrite" title="edit resources"><span class="teamworkIcon">M</span></button>
			&nbsp; &nbsp; &nbsp; &nbsp;
			<button onclick="saveGanttOnServer();" class="button first big requireWrite" title="Save">Guardar</button>
			<button onclick='newProject();' class='button requireWrite newproject'><em>Limpiar datos</em></button>
			<button class="button login" title="login/enroll" onclick="loginEnroll($(this));" style="display:none;">login/enroll</button>
			<button class="button opt collab" title="Start with Twproject" onclick="collaborate($(this));" style="display:none;"><em>collaborate</em></button>
			</div></div>
		--></div>

		<div class="__template__" type="TASKSEDITHEAD">
			<!-- <table class="gdfTable" cellspacing="0" cellpadding="0">
				<thead>
					<tr style="height:40px">
						<th class="gdfColHeader" style="width:35px;border-right: none"></th>
						<th class="gdfColHeader" style="width:25px;"></th>
						<th class="gdfColHeader" style="width:75px;">Código</th>
						<th class="gdfColHeader" style="width:70px;">Coment.</th>
						<th class="gdfColHeader" style="width:600px;">Nombre largo</th>
						<th class="gdfColHeader" style="width:50px;">Dep.</th>
						<th class="gdfColHeader" style="width:80px;">Inicio</th>
						<th class="gdfColHeader" style="width:50px;">Dur.</th>
						<th class="gdfColHeader" style="width:80px;">Fin</th>
						<th class="gdfColHeader" style="width:70px;">%</th>
						<th class="gdfColHeader" style="width:2000px;text-align: left;padding-left: 10px;">Profesionales asignados</th>
					</tr>
				</thead>
			</table> -->
		</div>

		<div class="__template__" type="TASKROW">
			<!-- <tr taskId="(#=obj.id#)" class="taskEditRow (#=obj.isParent()?'isParent':''#) (#=obj.collapsed?'collapsed':''#)" level="(#=level#)">
				<th class="gdfCell" style="cursor:pointer;text-aling: center;"><span class="taskRowIndex">(#=obj.getRow()+1#)</span></th>
				<td class="gdfCell noClip"><div class="taskStatus cvcColorSquare" status="(#=obj.status#)"></div></td>
				<td class="gdfCell"><input type="text" name="code" value="(#=obj.code?obj.code:''#)" placeholder="Código" readonly="readonly" style="text-align: center;"></td>
				<td class="gdfCell" style="text-align: center;"><a href="#" style="cursor: pointer;user-select: none;" onclick="administrarComentarios('(#=obj.id#)', '(#=obj.name#)');">((#=obj.quantityComment#))</a></td>
				<td class="gdfCell indentCell" style="padding-left:(#=obj.level*10+18#)px;">
					<div class="exp-controller" style="margin-left: 0px;"></div>
					<small><a href="#" style="color: red;cursor: pointer;user-select: none;" title="Observaciones" onclick="administrarObservaciones('(#=obj.id#)', '(#=obj.name#)');">((#=obj.quantityObservation#))</a></small>
					<input type="text" name="name" value="(#=obj.name#)" placeholder="Nombre" autocomplete="off" style="(#=(obj.observationPending ? 'color: red;' : '')#)">
				</td>
				<td class="gdfCell"><input type="text" name="depends" autocomplete="off" value="(#=obj.depends#)" (#=obj.hasExternalDep?"readonly":""#) style="text-align: center;"></td>
				<td class="gdfCell"><input type="text" name="start" value="" class="date" style="text-align: center;"></td>
				<td class="gdfCell"><input type="text" name="duration" autocomplete="off" value="(#=obj.duration#)" style="text-align: center;"></td>
				<td class="gdfCell"><input type="text" name="end" value="" class="date" style="text-align: center;"></td>
				<td class="gdfCell"><input type="text" name="progress" class="validated" entrytype="PERCENTILE" autocomplete="off" value="(#=obj.progress?obj.progress:''#)" (#=obj.progressByWorklog?"readOnly":""#) style="text-align: center;"></td>
				<td class="gdfCell"><a href="#" style="cursor: pointer; user-select: none;" onclick="administrarPersonal('(#=obj.id#)', '(#=obj.name#)');">Admin.</a> <small>(#=obj.personaAsignada?obj.personaAsignada:''#)</small></td>
			</tr> -->
		</div>

		<div class="__template__" type="TASKEMPTYROW"><!--
			<tr class="taskEditRow emptyRow" >
				<th class="gdfCell"></th>
				<td class="gdfCell noClip"></td>
				<td class="gdfCell"></td>
				<td class="gdfCell"></td>
				<td class="gdfCell"></td>
				<td class="gdfCell"></td>
				<td class="gdfCell"></td>
				<td class="gdfCell"></td>
				<td class="gdfCell"></td>
				<td class="gdfCell"></td>
				<td class="gdfCell"></td>
			</tr>
		--></div>
	</div>
	<script>
		function administrarPersonal(taskId, nombreTarea)
		{
			if(taskId.substring(0, 3)=='tmp')
			{
				swal(
				{
					title: '',
					text: 'Debe guardar los datos actuales antes de asignar esta información.',
					type: 'error'
				},
				function(){});

				return;
			}

			paginaAjaxDialogo(null, replaceAll(replaceAll(nombreTarea, '<', '&lt;'), '>', '&gt;'), { idTareaET : taskId, idET : <?=$idExpedienteTecnico?> }, '<?=base_url()?>index.php/ET_Especialista_Tarea/insertar', 'GET', null, null, false, true);
		}

		function administrarComentarios(taskId, nombreTarea)
		{
			if(taskId.substring(0, 3)=='tmp')
			{
				swal(
				{
					title: '',
					text: 'Debe guardar los datos actuales antes de asignar esta información.',
					type: 'error'
				},
				function(){});

				return;
			}

			paginaAjaxDialogo(null, replaceAll(replaceAll(nombreTarea, '<', '&lt;'), '>', '&gt;')+' (Comentarios)', { idTareaET : taskId }, '<?=base_url()?>index.php/ET_Comentario/insertar', 'GET', null, null, false, true);
		}

		function administrarObservaciones(taskId, nombreTarea)
		{
			if(taskId.substring(0, 3)=='tmp')
			{
				swal(
				{
					title: '',
					text: 'Debe guardar los datos actuales antes de asignar esta información.',
					type: 'error'
				},
				function(){});

				return;
			}

			paginaAjaxDialogo(null, replaceAll(replaceAll(nombreTarea, '<', '&lt;'), '>', '&gt;')+' (Observaciones)', { idTareaET : taskId, idET : <?=$idExpedienteTecnico?> }, '<?=base_url()?>index.php/ET_Observacion_Tarea/insertar', 'GET', null, null, false, true);
		}
	</script>
</body>
</html>
