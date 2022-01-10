<link rel="stylesheet" href="<?=base_url()?>assets/vendors/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/bootstrap-select.css">
<style>
	#tableObservacion td
	{
		border-bottom: 1px dotted #cccccc;
	}

	#listaArchivos
	{
		list-style: none;
		text-align: center;
		width: 100%;
	}

	#listaArchivos > li
	{
		border: 1px solid #999999;
		cursor: pointer;
		display: inline-block;
		margin: 3px;
		padding: 20px;
		padding-left: 7px;
		padding-right: 7px;
		text-align: center;
		vertical-align: middle;
		width: 200px;
	}

	#listaArchivos > li:hover
	{
		background-color: #f5f5f5;
	}
</style>
<div style="background-color: #ffffff;box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.7);left: 0px;padding-top: 4px;position: absolute;right: 0px;top: 0px;">
	<h3 style="font-size: 20px;margin-top: 0px;padding-left: 4px;padding-top: 0px;text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);">
		Actividad: <span style="color: #26a5d8;"><?=html_escape($etTarea->nombre_tarea)?></span>
		<br>
		<small>desde el <i style="text-decoration: underline;"><?=explode(' ', $etTarea->fecha_inicio_tarea)[0]?></i> hasta el <i style="text-decoration: underline;"><?=explode(' ', $etTarea->fecha_final_tarea)[0]?></i></small>
	</h3>
	<input type="button" value="Cerrar" class="button requireWrite newproject" style="background-color: #d43c3c;position: absolute;right: 0px;top: 10px;" onclick="$('#divDialogoGeneralGantt').hide();">
</div>
<div style="overflow-x: hidden;overflow-y: scroll;height: 90%;margin-top: 55px;">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-2" style="padding-top: 5px;">
				<label for="selectETResponsableTarea" class="control-label"><b>Responsable de la actividad</b></label>
			</div>
			<div class="col-md-10">
				<select name="selectETResponsableTarea" id="selectETResponsableTarea" style="width: 100%;" onchange="asignarResponsable(<?=$etTarea->id_tarea_et?>);" class="form-control">
					<option value=""></option>
					<?php foreach($listaPersona as $key => $value){
						if(count($listaETResponsableTarea)>0){
							$asignado=false;
							foreach($listaETResponsableTarea as $index => $item){
								if($value->id_persona==$item->id_persona)
								{
									$asignado=true;break;
								}
							}
							if($asignado){ ?>
								<option value="<?=$value->id_persona?>" selected><?=html_escape($value->nombres.' '.$value->apellido_p.' '.$value->apellido_m)?></option>
							<?php } else{ ?>
								<option value="<?=$value->id_persona?>"><?=html_escape($value->nombres.' '.$value->apellido_p.' '.$value->apellido_m)?></option>
							<?php }
						}
						else{ ?>
							<option value="<?=$value->id_persona?>"><?=html_escape($value->nombres.' '.$value->apellido_p.' '.$value->apellido_m)?></option>
						<?php }
						} ?>
				</select>
			</div>
			<div class="col-md-12">
				<label for="txtObservacion"><b>Observación</b></label>
				<div>
					<textarea name="txtObservacion" id="txtObservacion" rows="4" style="resize: none;" class="form-control"></textarea>
				</div>
			</div>
			<div class="col-md-12" style="margin-top: 4px;text-align: right;">
				<input type="button" value="Registrar observación" class="button requireWrite newproject" onclick="registrarObservacion();">
			</div>
			<div class="col-md-12">
				<div>
					<table id="tableObservacion" class="table table-striped">
						<thead>
							<tr>
								<th>Descripción</th>
								<th>Fecha</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="bodyTableObservacion">
							<?php foreach($listaETTareaObservacion as $key => $value){ ?>
								<tr>
									<td>
										<?=html_escape($value->desc_tobservacion)?>
										<div style="padding-left: 20px;font-size: 12px;">
											<b>Levantamiento: </b><span id="spanDescripcionLevantamientoTObservacion<?=$value->id_tarea_observacion?>"><?=html_escape($value->levantamiento_tobservacion)?></span>
											<br>
											<a id="enlaceEliminarLevantamientoObservacion<?=$value->id_tarea_observacion?>" href="#" style="color: red;<?=html_escape($value->levantamiento_tobservacion)=='' ? 'display: none;' : ''?>" onclick="eliminarLevantamientoObservacion(<?=$value->id_tarea_observacion?>, this);">Eliminar levantamiento de la obs.</a>
											<textarea id="txtDescripcionLevantamientoObservacion<?=$value->id_tarea_observacion?>" rows="4" style="display: none;resize: none;width: 100%;" placeholder="Descripción del levantamiento de observación"></textarea>
										</div>	
									</td>
									<td><?=$value->fecha_tobservacion?></td>
									<td style="text-align: center;font-size: 12px;">
										<a href="#" style="color: blue;display: block" onclick="levantarObservacion(<?=$value->id_tarea_observacion?>, this);">Levantar obs.</a>
										<a href="#" style="color: red;display: block;" onclick="eliminarObservacion(<?=$value->id_tarea_observacion?>, this);">Eliminar</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-12">
				<div style="padding-bottom: 5px;padding-top: 5px;border-bottom: 1px solid #999999;border-top: 1px solid #999999;">
					<label for="fileDocumentoEjecucion" class="col-md-2" style="margin-top: 5px;"><b>Archivos de esta actividad</b></label>
					<div class="col-md-8"><input type="file" id="fileDocumentoEjecucion" name="fileDocumentoEjecucion" class="form-control"></div>
					<div class="col-md-2"><input type="button" value="Subir archivo" class="btn btn-success" style="width: 100%;" onclick="registrarArchivo(<?=$etTarea->id_tarea_et?>);"></div>
					<div id="divArchivosEjecucion">
						<ul id="listaArchivos">
							<?php foreach($listaETDocumentoEjecucion as $key => $value){ ?>
								<li>
									Archivo <?=($key+1).' '.$value->extension_doc_ejecucion?>
									<br>
									<a href="#" style="color: red;" onclick="eliminarArchivo(<?=$value->id_doc_ejecucion?>, this);">Eliminar</a> | <a href="#" onclick="window.location.href='<?=base_url()?>index.php/ET_Documento_Ejecucion/descargar/<?=$value->id_doc_ejecucion?>';">Descargar</a>
								</li>
							<?php } ?>
						</ul>
					</div>
					<br>
				</div>
			</div>
			<div class="col-md-12">
				<table id="tableEspecialidad" class="table">
					<thead>
						<tr>
							<th>
								<b>Especialidad </b>
								<div style="display: inline-block;vertical-align">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="radioListaEspecialidad" value="Todo" checked="true" onchange="onChangeRadioListaEspecialidad();"> Todo</label>&nbsp;&nbsp;<label><input type="radio" name="radioListaEspecialidad" value="Asignados" onchange="onChangeRadioListaEspecialidad();"> Asignados</label></div>
							</th>
							<th><b>Especialista</b></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($listaEspecialidad as $key => $value)
						{
							$asignadoTemp=false;
							$idEspecialistaAsignado=null;

							foreach($listaEspecialidadTarea as $index => $item)
							{
								if($value->id_esp==$item->id_esp)
								{
									$asignadoTemp=true;
									$idEspecialistaAsignado=$item->id_persona;

									break;
								}
							}
						?>
							<tr style="user-select: none;">
								<td><label class="control-label" style="cursor: pointer;"><input id="checkBoxEspecialidad<?=$key?>" type="checkbox" value="<?=$value->id_esp?>" onchange="onChangeCheckBoxEspecialidad(this);" <?=$asignadoTemp ? 'checked="true"' : ''?>> <?=html_escape($value->nombre_esp)?></label></td>
								<td>
									<select name="selectPersonaEspecialista[]" id="selectPersonaEspecialista<?=$key?>" style="width: 100%;" class="form-control" <?=$asignadoTemp ? '' : 'disabled=true'?> onchange="asignarEspecialista(<?=$value->id_esp?>, this);">
										<option value=""></option>
										<?php foreach($listaPersona as $key => $value){ ?>
											<option value="<?=$value->id_persona?>" <?=($idEspecialistaAsignado!=null && $idEspecialistaAsignado!='NULL' && $idEspecialistaAsignado==$value->id_persona) ? 'selected' : ''?>><?=html_escape($value->nombres.' '.$value->apellido_p.' '.$value->apellido_m)?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url()?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/bootstrap-select.js"></script>
<script>
	$(function()
	{
		//$('#selectETResponsableTarea').selectpicker({ liveSearch: true });

		<?php for($i=0;$i<count($listaEspecialidad); $i++){ ?>
			//$('#selectPersonaEspecialista<?=$i?>').selectpicker({ liveSearch: true });
		<?php } ?>
	});

	function onChangeRadioListaEspecialidad()
	{
		if($('[name=radioListaEspecialidad]:checked').val()=='Todo')
		{
			$('#tableEspecialidad > tbody > tr').show();
		}
		else
		{
			$('#tableEspecialidad > tbody > tr').each(function(index, element)
			{
				if($($(element).find('input[type=checkbox]')[0]).is(':checked'))
				{
					$(element).show();
				}
				else
				{
					$(element).hide();
				}
			});
		}
	}

	function asignarEspecialista(idEspecialidad, element)
	{
		paginaAjaxJSON({ idEspecialidad : idEspecialidad, idPersona : $(element).val(), idTareaET : <?=$etTarea->id_tarea_et?> }, '<?=base_url()?>index.php/Especialidad_Tarea/asignarEspecialista', 'POST', null, function(objectJSON)
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

	function onChangeCheckBoxEspecialidad(element)
	{
		if($(element).is(':checked'))
		{
			paginaAjaxJSON({ idEspecialidad : $(element).val(), idTareaET : <?=$etTarea->id_tarea_et?> }, '<?=base_url()?>index.php/Especialidad_Tarea/insertar', 'POST', null, function(objectJSON)
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
					$(element).prop('checked', false);

					return false;
				}

				$($(element).parent().parent().parent().find('select')[0]).removeAttr('disabled');
				$($(element).parent().parent().parent().find('select')[0]).selectpicker('refresh');
			}, false, true);
		}
		else
		{
			paginaAjaxJSON({ idEspecialidad : $(element).val(), idTareaET : <?=$etTarea->id_tarea_et?> }, '<?=base_url()?>index.php/Especialidad_Tarea/eliminarPorIdEspecialidadYIdTarea', 'POST', null, function(objectJSON)
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
					$(element).prop('checked', false);

					return false;
				}

				$($(element).parent().parent().parent().find('select')[0]).val('');
				$($(element).parent().parent().parent().find('select')[0]).attr('disabled', true);
				$($(element).parent().parent().parent().find('select')[0]).selectpicker('refresh');
				onChangeRadioListaEspecialidad();
			}, false, true);
		}
	}

	function registrarObservacion()
	{
		if($('#txtObservacion').val().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El campo observación es obligatorio.',
				type: 'error'
			},
			function(){});

			return;
		}

		if(confirm('Confirmar operación'))
		{
			paginaAjaxJSON({ idTareaET : <?=$etTarea->id_tarea_et?>, descripcionObservacion : $('#txtObservacion').val().trim() }, '<?=base_url()?>index.php/ET_Tarea_Observacion/insertar', 'POST', null, function(objectJSON)
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

				var htmlTemp='<tr style="filaObservacion'+objectJSON.ultimoIdETTareaObservacion+'">'+
					'<td>'+
						replaceAll(replaceAll($('#txtObservacion').val().trim(), '<', '&lt;'), '>', '&gt;')+
						'<div style="padding-left: 20px;font-size: 12px;">'+
							'<b>Levantamiento: </b><span id="spanDescripcionLevantamientoTObservacion'+objectJSON.ultimoIdETTareaObservacion+'"></span>'+
							'<br>'+
							'<a id="enlaceEliminarLevantamientoObservacion'+objectJSON.ultimoIdETTareaObservacion+'" href="#" style="color: red;display: none;" onclick="eliminarLevantamientoObservacion('+objectJSON.ultimoIdETTareaObservacion+', this);">Eliminar levantamiento de la obs.</a>'+
							'<textarea id="txtDescripcionLevantamientoObservacion'+objectJSON.ultimoIdETTareaObservacion+'" rows="4" style="display: none;resize: none;width: 100%;" placeholder="Descripción del levantamiento de observación"></textarea>'+
						'</div>'+
					'</td>'+
					'<td>'+objectJSON.fechaActual+'</td>'+
					'<td style="text-align: center;font-size: 12px;">'+
						'<a href="#" style="color: blue;display: block" onclick="levantarObservacion('+objectJSON.ultimoIdETTareaObservacion+', this);">Levantar obs.</a>'+
						'<a href="#" style="color: red;display: block;" onclick="eliminarObservacion('+objectJSON.ultimoIdETTareaObservacion+', this);">Eliminar</a>'+
					'</td>'+
				'</tr>';

				$('#bodyTableObservacion').append(htmlTemp);

				$('#txtObservacion').val('');
			}, false, true);
		}
	}

	function eliminarObservacion(idTareaObservacion, element)
	{
		if(confirm('Confirmar operación'))
		{
			paginaAjaxJSON({ idTareaObservacion : idTareaObservacion }, '<?=base_url()?>index.php/ET_Tarea_Observacion/eliminar', 'POST', null, function(objectJSON)
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

	function levantarObservacion(idTareaObservacion, element)
	{
		var idTextAreaTemp='txtDescripcionLevantamientoObservacion'+idTareaObservacion;

		if($('#'+idTextAreaTemp).css('display')=='none')
		{
			$('#'+idTextAreaTemp).show();
			$('#'+idTextAreaTemp).val($('#spanDescripcionLevantamientoTObservacion'+idTareaObservacion).text());
			$(element).text('Guardar');
		}
		else
		{
			if($('#'+idTextAreaTemp).val().trim()=='')
			{
				swal(
				{
					title: '',
					text: 'La descripción del levantamiento de la observación es un campo obligatorio.',
					type: 'error'
				},
				function(){});

				return;
			}

			paginaAjaxJSON({ idTareaObservacion : idTareaObservacion, descripcionLevantamientoObservacion : $('#'+idTextAreaTemp).val().trim() }, '<?=base_url()?>index.php/ET_Tarea_Observacion/levantarObservacion', 'POST', null, function(objectJSON)
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

				$('#spanDescripcionLevantamientoTObservacion'+idTareaObservacion).text($('#'+idTextAreaTemp).val().trim());
				$('#enlaceEliminarLevantamientoObservacion'+idTareaObservacion).show();
				$('#'+idTextAreaTemp).hide();
				$(element).text('Levantar obs.');
			}, false, true);
		}
	}

	function eliminarLevantamientoObservacion(idTareaObservacion, element)
	{
		var idTextAreaTemp='txtDescripcionLevantamientoObservacion'+idTareaObservacion;

		paginaAjaxJSON({ idTareaObservacion : idTareaObservacion }, '<?=base_url()?>index.php/ET_Tarea_Observacion/levantarObservacion', 'POST', null, function(objectJSON)
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

			$('#spanDescripcionLevantamientoTObservacion'+idTareaObservacion).text('');
			$('#enlaceEliminarLevantamientoObservacion'+idTareaObservacion).hide();
		}, false, true);
	}

	function asignarResponsable(idTareaET)
	{
		paginaAjaxJSON({ idTareaET : idTareaET, idPersona : $('#selectETResponsableTarea').val() }, '<?=base_url()?>index.php/ET_Responsable_Tarea/asignar', 'POST', null, function(objectJSON)
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

	function registrarArchivo(idTareaET)
	{
		if($($('#fileDocumentoEjecucion')[0]).get(0).files.length==0)
		{
			swal(
			{
				title: '',
				text: 'Debe seleccionar un archivo para subir a esta actividad.',
				type: 'error'
			},
			function(){});

			return;
		}

		var dataAjax=new FormData();

		dataAjax.append('idTareaET', idTareaET);
		dataAjax.append('file0', $($('#fileDocumentoEjecucion')[0]).get(0).files[0]);

		$.ajax({
		    type: 'POST',
		    url: '<?=base_url()?>index.php/ET_Documento_Ejecucion/insertar',
		    contentType: false,
		    processData: false,
		    data: dataAjax,
		    beforeSend: function(xhr)
		    {
		    	renderLoading();
		    },
		    success: function(objectJSON)
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

		    	$('#divModalCargaAjax').hide();

		    	$('#fileDocumentoEjecucion').val(null);

		    	var htmlTemp='<li>'+
					'Archivo '+(($('#listaArchivos').find('li').length)+1)+' '+objectJSON.extensionDocumentoEjecucion+
					'<br>'+
					'<a href="#" style="color: red;" onclick="eliminarArchivo('+objectJSON.idDocumentoEjecucion+', this);">Eliminar</a> | <a href="#" onclick="window.location.href=\'<?=base_url()?>index.php/ET_Documento_Ejecucion/descargar/'+objectJSON.idDocumentoEjecucion+'\';">Descargar</a>'+
				'</li>';

				$('#listaArchivos').append(htmlTemp);
		    }
		});
	}

	function eliminarArchivo(idDocumentoEjecucion, element)
	{
		if(confirm('Confirmar operación'))
		{
			paginaAjaxJSON({ idDocumentoEjecucion : idDocumentoEjecucion }, '<?=base_url()?>index.php/ET_Documento_Ejecucion/eliminar', 'POST', null, function(objectJSON)
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

				$(element).parent().remove();
			}, false, true);
		}
	}
</script>