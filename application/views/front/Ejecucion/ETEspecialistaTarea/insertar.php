<link rel="stylesheet" href="<?=base_url()?>assets/vendors/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/bootstrap-select.css">
<style>
	.cajonEspecialidad
	{
		background-color: #ffffff;
		box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.4);
		cursor: move;
		display: inline-table;
		height: 70px;
		margin: 2px;
		padding: 4px;
		text-align: center;
		user-select: none;
		vertical-align: middle;
		width: 170px;
	}

	.cajonEspecialidad:hover
	{
		background: #2f9bfb;
		color: #ffffff;
	}

	.cajonEspecialidad > small
	{
		display: table-cell;
		vertical-align: middle;
	}
</style>
<div style="padding: 5px;user-select: none;">
	<table style="width: 100%;">
		<thead>
			<tr>
				<th style="text-align: center;height: 25px"><b></b></th>
				<th style="text-align: center;height: 25px"><b>Especialistas requeridos para esta actividad</b></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php if($aprobado!=1) { ?>
				<td style="background-color: #f5f5f5;text-align: center;vertical-align: top;width: 200px;">
					<div style="font-size: 12px;height: 450px;overflow-y: scroll;">
						<?php foreach($listaEspecialidad as $key => $value){ ?>
							<div id="divEspecialidad<?=$value->id_esp?>" class="cajonEspecialidad" draggable="true" ondragstart="drag(event);">
								<small><?=html_escape($value->nombre_esp)?></small>
							</div>
						<?php } ?>
					</div>
				</td>
				<td id="tdSectionDrop" style="background-color: #f5fbfb;vertical-align: top;" ondragover="allowDrop(event, this);" ondrop="drop(event, this);">
					<div style="height: 450px;overflow-y: scroll;">
						<?php if(count($listaEspecialistaTarea)==0){ ?>
							<h3 style="color: #999999;text-align: center;">Arrastre especialidades de la izquierda</h3>
						<?php
						}
						else{ 
							foreach($listaEspecialistaTarea as $key => $value){ ?>
								<table style="width: 100%;">
									<tbody>
										<tr>
											<td style="width: 50%;"><div style="background-color: #54c4b9;border-radius: 5px;color: #ffffff;font-size: 12px;margin: 4px;padding: 4px;"><?=html_escape($value->nombre_esp)?></div></td>
											<td>
												<select class="form-control" style="margin: 1px;" onchange="asignarPersonalETEspecialistaTarea(<?=$value->id_especialista_tarea?>, this);">
													<option value=""></option>
													<?php foreach($listaETPerReq as $index => $item){
														if($value->id_esp==$item->id_esp){ ?>
															<option value="<?=$item->id_per_req?>" <?=($value->id_per_req==$item->id_per_req ? 'selected' : '')?>><?=html_escape($item->nombres.' '.$item->apellido_p.' '.$item->apellido_m)?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</td>
											<td style="width: 1%;"><a href="#" style="color: red;padding: 2px;font-size: 12px;" onclick="eliminarEspecialidadAsignada(<?=$value->id_especialista_tarea?>, this);">Eliminar</a></td>
										</tr>
									</tbody>
								</table>
						<?php 
							}
						} ?>
					</div>
				</td>
				<?php } else { ?>
				<td></td>
				<td id="tdSectionDrop" style="background-color: #f5fbfb;vertical-align: top;" ondragover="allowDrop(event, this);" ondrop="drop(event, this);">
					<div style="height: 450px;overflow-y: scroll;">
						<?php if(count($listaEspecialistaTarea)==0){ ?>
							<h3 style="color: #999999;text-align: center;">Arrastre especialidades de la izquierda</h3>
						<?php
						}
						else{ 
							foreach($listaEspecialistaTarea as $key => $value){ ?>
								<table style="width: 100%;">
									<tbody>
										<tr>
											<td style="width: 50%;"><div style="background-color: #54c4b9;border-radius: 5px;color: #ffffff;font-size: 12px;margin: 4px;padding: 4px;"><?=html_escape($value->nombre_esp)?></div></td>
											<td>
												<select disabled class="form-control" style="margin: 1px;" onchange="asignarPersonalETEspecialistaTarea(<?=$value->id_especialista_tarea?>, this);">
													<option value=""></option>
													<?php foreach($listaETPerReq as $index => $item){
														if($value->id_esp==$item->id_esp){ ?>
															<option value="<?=$item->id_per_req?>" <?=($value->id_per_req==$item->id_per_req ? 'selected' : '')?>><?=html_escape($item->nombres.' '.$item->apellido_p.' '.$item->apellido_m)?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
						<?php 
							}
						} ?>
					</div>
				</td>

				<?php } ?>

			</tr>
		</tbody>
	</table>
</div>
<script src="<?=base_url()?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/bootstrap-select.js"></script>
<script>
	var listaETPerReqFinal=[];

	<?php foreach($listaETPerReq as $index => $item){ ?>
		listaETPerReqFinal.push({idPerReq : <?=$item->id_per_req?>, nombre : '<?=html_escape($item->nombres.' '.$item->apellido_p.' '.$item->apellido_m)?>', idEsp : <?=$item->id_esp?>});
	<?php } ?>

	function eliminarEspecialidadAsignada(idEspecialistaTarea, element)
	{
		if(confirm('Relamente desea eliminar este especialista asignado?'))
		{
			paginaAjaxJSON({ idEspecialistaTarea : idEspecialistaTarea }, '<?=base_url()?>index.php/ET_Especialista_Tarea/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
				},
				function(){});

				if(objectJSON.proceso=='Error')
				{
					return false;
				}

				$(element).parent().parent().remove();
			}, false, true);
		}
	}

	function asignarPersonalETEspecialistaTarea(idEspecialistaTarea, element)
	{
		paginaAjaxJSON({ idEspecialistaTarea : idEspecialistaTarea, idPerReq : $(element).val(), idTareaET : <?=$idTareaET?> }, '<?=base_url()?>index.php/ET_Especialista_Tarea/asignarPersonal', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			if(objectJSON.proceso=='Error')
			{
				$(element).val("");

				$(element).selectpicker("refresh");

				return false;
			}
		}, false, true);
	}

	function allowDrop(ev, element)
	{
		ev.preventDefault();
	}

	function drag(ev)
	{
		ev.dataTransfer.setData("idDivEspecialidad", ev.target.id);
	}

	function drop(ev, element)
	{
		ev.preventDefault();

		var data=ev.dataTransfer.getData("idDivEspecialidad");

		paginaAjaxJSON({ idEspecialidad : data.substring(15), idTareaET : <?=$idTareaET?> }, '<?=base_url()?>index.php/ET_Especialista_Tarea/insertar', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			if(objectJSON.proceso=='Error')
			{
				return false;
			}

			var htmlTempListaETPerReq='<option value=""></option>';

			for(var i=0; i<listaETPerReqFinal.length; i++)
			{
				if(data.substring(15)==listaETPerReqFinal[i].idEsp)
				{
					htmlTempListaETPerReq+='<option value="'+listaETPerReqFinal[i].idPerReq+'">'+replaceAll(replaceAll(listaETPerReqFinal[i].nombre, '<', '&gt;'), '>', '&lt;')+'</option>';
				}
			}

			var htmlTemp='<table style="width: 100%;">'+
				'<tbody>'+
					'<tr>'+
						'<td style="width: 50%;"><div style="background-color: #54c4b9;border-radius: 5px;color: #ffffff;font-size: 12px;margin: 4px;padding: 4px;">'+replaceAll(replaceAll($('#'+data).text(), '<', '&gt;'), '>', '&lt;')+'</div></td>'+
						'<td>'+'<select class="form-control" style="margin: 1px;" onchange="asignarPersonalETEspecialistaTarea('+objectJSON.idEspecialistaTarea+', this);">'+htmlTempListaETPerReq+'</select>'+'</td>'+
						'<td style="width: 1%;">'+'<a href="#" style="color: red;font-size: 12px;padding: 2px;" onclick="eliminarEspecialidadAsignada('+objectJSON.idEspecialistaTarea+', this);">Eliminar</a>'+'</td>'+
					'</tr>'+
				'</tbody>'+
			'</table>';

			if($(element).find('table').length==0)
			{
				$($(element).find('div')[0]).html('');
			}

			$($(element).find('div')[0]).prepend(htmlTemp);
		}, false, true);
	}
</script>