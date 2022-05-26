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
	.modal-dialog
	{
		width: 80%;
		margin: 0;
		margin-left: 10%;
		padding: 0;
	}

	.modal-content
	{
		height: auto;
		min-height: 100%;
		border-radius: 0;
	}
</style>
<div style="padding: 5px;user-select: none;">
	<table style="width: 100%;">
		<thead>
			<tr>
				<th style="text-align: center;height: 25px"><b></b></th>
				<th style="text-align: center;height: 25px"><b>Responsables asignados</b></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php if($aprobado!=1) { ?>
				<td style="background-color: #f5f5f5;text-align: center;vertical-align: top;width: 200px;">
					<div style="height: 450px;overflow-y: scroll;">
						<?php foreach($listaCargo as $key => $value){ ?>
							<div id="divEspecialidad<?=$value->id_cargo?>" class="cajonEspecialidad" draggable="true" ondragstart="drag(event);">
								<small><?=html_escape($value->Desc_cargo)?></small>
							</div>
						<?php } ?>
					</div>
				</td>
				
				<td id="tdSectionDrop" style="background-color: #f5fbfb;vertical-align: top;" ondragover="allowDrop(event, this);" ondrop="drop(event, this);">
					<div style="height: 450px;overflow-y: scroll;">
						<?php if(count($listaRespEt)==0){ ?>
							<h3 style="color: #999999;text-align: center;">Arrastre cargo de la izquierda</h3>
						<?php
						}
						else{ 
							foreach($listaRespEt as $key => $value){ ?>
								<table style="width: 100%;">
									<tbody>
										<tr>
											<td style="width: 35%;padding: 2px;"><div style="background-color: <?php echo ($value->estado_responsable_et==1 ? '#54c4b9' : '#f0ad4e');?>;border-radius: 5px;color: #ffffff;margin: 3px;padding: 4px;height: 40px;width: 100%;"><?=html_escape($value->desc_cargo)?></div>
											</td>
											<td style="padding: 2px;">
												<select class="selectPersonaETPerReq selectpicker form-control" data-live-search="true" data-width="100%" onchange="asignarPersonalETPerReq(<?=$value->id_responsable_et?>, this);">
													<option value="">Seleccionar Personal</option>
													<?php foreach($listaPersona as $index => $item){ ?>
														<option value="<?=$item->id_persona?>" <?=($value->id_persona==$item->id_persona ? 'selected' : '')?>><?=html_escape($item->nombres.' '.$item->apellido_p.' '.$item->apellido_m)?></option>
													<?php } ?>
												</select>
											</td>
											<td style="width: 20%;padding: 2px;">
												<input class="form-control" onchange="asignarPersonalAsignacion(<?=$value->id_responsable_et?>, this);" type="date" max="2050-12-31" name="dateFechaAsignacion" id="dateFechaAsignacion" value="<?=(new DateTime($value->fecha_asignacion_resp_et))->format('Y-m-d')?>">
											</td>
											<td style="width: 5%;padding: 2px;"><a href="#" style="color: red;padding: 2px;" onclick="eliminarEspecialidadAsignada(<?=$value->id_responsable_et?>, this);">Eliminar</a>
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
<script>
	$(function()
	{
		$('.selectPersonaETPerReq').selectpicker();
	});

	function asignarPersonalETPerReq(idPerReq, element)
	{
		paginaAjaxJSON({ idEtResponsable : idPerReq, idPersona : $(element).val(), idET : <?=$idET?> }, '<?=base_url()?>index.php/ET_Responsable/asignarPersonal', 'POST', null, function(objectJSON)
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

	function asignarPersonalAsignacion(idPerReq, element)
	{
		paginaAjaxJSON({ idEtResponsable : idPerReq, fecha : $(element).val(), idET : <?=$idET?> }, '<?=base_url()?>index.php/ET_Responsable/asignarFecha', 'POST', null, function(objectJSON)
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


	function eliminarEspecialidadAsignada(idPerReq, element)
    {
        swal({
            title: "Realmente desea eliminar este cargo asignado?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CERRAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ idEtResponsable : idPerReq }, '<?=base_url()?>index.php/ET_Responsable/eliminar', 'POST', null, function(objectJSON)
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
        });
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

		paginaAjaxJSON({ idCargo : data.substring(15), idET : <?=$idET?> }, '<?=base_url()?>index.php/ET_Responsable/insertar', 'POST', null, function(objectJSON)
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

			var listaPersona='';

			<?php foreach($listaPersona as $index => $item){ ?>
				listaPersona+='<option value="<?=$item->id_persona?>"><?=html_escape($item->nombres.' '.$item->apellido_p.' '.$item->apellido_m)?></option>';
			<?php } ?>

			var htmlTemp='<table style="width: 100%;">'+
				'<tbody>'+
					'<tr>'+
						'<td style="width: 35%;padding: 2px;"><div style="background-color: #54c4b9;border-radius: 5px;color: #ffffff;margin: 3px;padding: 4px;height: 40px;width: 100%;">'+replaceAll(replaceAll($('#'+data).text(), '<', '&gt;'), '>', '&lt;')+'</div></td>'+
						'<td style="padding: 2px;">'+'<select class="selectPersonaETPerReq selectpicker form-control" data-live-search="true" data-width="100%" onchange="asignarPersonalETPerReq('+objectJSON.idRespEt+', this);"><option value="">Seleccionar Personal</option>'+listaPersona+'</select>'+'</td>'+
						'<td style="width: 20%;padding:2px;">'+'<input onchange="asignarPersonalAsignacion('+objectJSON.idRespEt+', this);" class="form-control" type="date" max="2050-12-31" name="dateFechaAsignacion" id="dateFechaAsignacion"'+'</td>'+
						'<td style="width: 5%;padding: 2px;">'+'<a href="#" style="color: red;padding: 2px;" onclick="eliminarEspecialidadAsignada('+objectJSON.idRespEt+', this);">Eliminar</a>'+'</td>'+
					'</tr>'+
				'</tbody>'+
			'</table>';

			if($(element).find('table').length==0)
			{
				$($(element).find('div')[0]).html('');
			}

			$($(element).find('div')[0]).prepend(htmlTemp);

			$('.selectPersonaETPerReq').selectpicker();
		}, false, true);
	}
</script>