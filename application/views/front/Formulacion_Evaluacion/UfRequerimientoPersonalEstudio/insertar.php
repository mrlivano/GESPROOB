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
				<th style="text-align: center;height: 25px; font-size: 12px;"><b><u>Especialistas requeridos para formulación <input type="hidden" id="id_est_inv" value="<?= $id_est_inv?>"> </u></b></th>

			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="background-color: #f5f5f5;text-align: center;vertical-align: top;width: 200px;">
					<div style="height: 450px;overflow-y: scroll;">
						<?php foreach($listaEspecialidad as $key => $value){ ?>
							<div id="divEspecialidad<?=$value->id_esp?>" class="cajonEspecialidad" draggable="true" ondragstart="drag(event);">
								<small><?=html_escape($value->nombre_esp)?></small>
							</div>
						<?php } ?>
					</div>
				</td>
				<td id="tdSectionDrop" style="background-color: #f5fbfb;vertical-align: top;" ondragover="allowDrop(event, this);" ondrop="drop(event, this);">
					<div style="height: 450px;overflow-y: scroll;">
						<?php if(count($listaETPerReqEstudio)==0){ ?>
							<h3 style="color: #999999;text-align: center;">Arrastre especialidades de la izquierda</h3>
						<?php
						}
						else{ 
							foreach($listaETPerReqEstudio as $key => $value){ ?>
								<table style="width: 100%;">
									<tbody>
										<tr>
											<td style="width: 50%;"><div style="background-color: #1F838D ;border-radius: 5px;color: #ffffff;margin: 4px;padding: 4px;"><label style="cursor: pointer;"><b>Formulador___</b><input type="checkbox" value="formulador" style="margin-left: -15px;" onchange="asignarQuitarFormuladorResponsable(<?=$value->id_req_per?>, this);" <?=($value->formulador ? 'checked=true' : '')?>></label><?=html_escape($value->nombre_esp)?></div></td>
											<td>
												<select class="selectPersonaETPerReq" data-live-search="true" data-width="100%" onchange="asignarPersonalETPerReq(<?=$value->id_req_per?>, this);">
													<option value=""></option>
													<?php foreach($listaPersona as $index => $item){ ?>
														<option value="<?=$item->id_persona?>" <?=($value->id_persona==$item->id_persona ? 'selected' : '')?>><?=html_escape($item->nombres.' '.$item->apellido_p.' '.$item->apellido_m)?></option>
													<?php } ?>
												</select>
											</td>
											<td style="width: 1%;"><a href="#" style="color: red;padding: 2px;" onclick="eliminarEspecialidadAsignada(<?=$value->id_req_per?>, this);">Eliminar</a></td>
										</tr>
									</tbody>
								</table>
						<?php 
							}
						} ?>
					</div>
				</td>
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
		var id_est_inv=$("#id_est_inv").val();
		paginaAjaxJSON({ idPerReq : idPerReq, idPersona : $(element).val(), id_est_inv : id_est_inv }, '<?=base_url()?>index.php/UF_Req_Personal_Estudio/asignarPersonal', 'POST', null, function(objectJSON)
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

		paginaAjaxJSON({ idEspecialidad : data.substring(15), id_est_inv : <?=$id_est_inv?> }, '<?=base_url()?>index.php/UF_Req_Personal_Estudio/insertar', 'POST', null, function(objectJSON)
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
						'<td style="width: 50%;"><div style="background-color: #54c4b9;border-radius: 5px;color: #ffffff;margin: 4px;padding: 4px;"><label style="cursor: pointer;"><b>Craet___</b><input type="checkbox" value="craet" style="margin-left: -15px;" onchange="asignarQuitarCraetETPerReq('+objectJSON.idPerReq+', this);"></label>'+replaceAll(replaceAll($('#'+data).text(), '<', '&gt;'), '>', '&lt;')+'</div></td>'+
						'<td>'+'<select class="selectPersonaETPerReq" data-live-search="true" data-width="100%" onchange="asignarPersonalETPerReq('+objectJSON.idPerReq+', this);"><option value=""></option>'+listaPersona+'</select>'+'</td>'+
						'<td style="width: 1%;">'+'<a href="#" style="color: red;padding: 2px;" onclick="eliminarEspecialidadAsignada('+objectJSON.idPerReq+', this);">Eliminar</a>'+'</td>'+
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

		function asignarQuitarFormuladorResponsable(idPerReq, element)
		{
			//alert(idPerReq +''+$(element).is(':checked'));
			paginaAjaxJSON({ idPerReq : idPerReq, formulador : ($(element).is(':checked') ? true : false) }, '<?=base_url()?>index.php/UF_Req_Personal_Estudio/asignarQuitarFormulador', 'POST', null, function(objectJSON)
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
			}, false, true);
		}

		

</script>