<?php
function mostrarAnidado($meta, $expedienteTecnico)
{
	$htmlTemp = '';

	$htmlTemp .= '<tr class="elementoBuscar">' .
		'<td><b><i>' . $meta->numeracion . '</i></b></td>' .
		'<td style="text-align: left;text-transform:uppercase;"><b><i>' . html_escape($meta->desc_meta) . '</i></b></td>' .
		'<td></td>' .
		'<td></td>' .
		'<td></td>' .
		'<td></td>' .
		'<td></td>';
	$htmlTemp .= '</tr>';
	if (count($meta->childMeta) == 0) {
		foreach ($meta->childPartida as $key => $value) {
			$htmlTemp .= '<tr class="elementoBuscar">' .
				'<td>' . $value->numeracion . '</td>' .
				'<td style="text-align: left;text-transform:uppercase;">' . html_escape($value->desc_partida) . '</td>' .
				'<td>' . html_escape($value->descripcion) . '</td>' .
				'<td style="text-align: right;">' . $value->cantidad . '</td>' .
				'<td style="text-align: right;">S/.' . $value->precio_unitario . '</td>' .
				'<td style="text-align: right;">S/.' . number_format($value->cantidad * $value->precio_unitario, 2) . '</td>';
			if ($value->especificacion_tecnica == "") {
				$htmlTemp .= '<td style="text-align: center;"><a id=btnDetallePartida' . $value->id_detalle_partida . ' class="btn btn-info btn-xs"  onclick="agregarEspecificacion(' . $expedienteTecnico->id_et . ',' . $value->id_detalle_partida . ');"><i class="fa fa-plus"></i> Registrar</a></td>';
			} else {
				$htmlTemp .= '<td style="text-align: center;"><a id=btnDetallePartida' . $value->id_detalle_partida . ' class="btn btn-success btn-xs"  onclick="agregarEspecificacion(' . $expedienteTecnico->id_et . ',' . $value->id_detalle_partida . ');"><i class="fa fa-plus"></i> Registrar</a></td>';
			}
			$htmlTemp .= '</tr>';
		}
	}
	foreach ($meta->childMeta as $key => $value) {
		$htmlTemp .= mostrarAnidado($value, $expedienteTecnico);
	}
	return $htmlTemp;
}
?>
<style>
	#tablaRegistro thead {
		background-color: #f2f5f7;
	}

	.table>tbody>tr>td,
	.table>tbody>tr>th,
	.table>tfoot>tr>td,
	.table>tfoot>tr>th,
	.table>thead>tr>td,
	.table>thead>tr>th {
		padding: 4px;
	}

	.dataTables_filter {
		width: 100%;
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div>
								<textarea rows="2" class="form-control" readonly="readonly"><?= trim($expedienteTecnico->nombre_pi) ?></textarea>
								<br>
							</div>
						</div>

					</div>
					<!--  -->

					<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTabPie" class="nav nav-tabs" role="tablist">
							<?php if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') { ?>
								<li style="width:15%;" role="presentation" class="active">
									<a href="#tabAdmDirecta" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Administracion Directa</b></a>
								</li>
							<?php }
							if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') { ?>
								<li style="width:15%;" role="presentation" class="">
									<a href="#tabAdmIndirecta" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Administracio Indirecta</b></a>
								</li>
							<?php } ?>
						</ul>
						<br>
						<div id="myTabPieContent" class="tab-content">
							<?php if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') { ?>
								<div role="tabpanel" class="tab-pane fade active in" id="tabAdmDirecta" aria-labelledby="home-tab">
									<div class="form-horizontal">
										<?php if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') {
											if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') {
										?>

												<div>
													<form id="frmEspecificacionesTecnicasDir">
														<div class="row">
															
															<div class="col-md-12 col-sm-12 col-xs-12">
																<label class="control-label"><?= ($expedienteTecnico->url_especificacion_tecnica != '' ? 'Reemplazar' : 'Adjuntar') ?> Especificación Tecnica:</label>
																<div class="col-md-12 col-sm-12 col-xs-12">
																	<input type="hidden" id="hdIdExpedienteTecnico" name="hdIdExpedienteTecnico" notValidate value="<?= $expedienteTecnico->id_et ?>">
																	<input accept=".pdf,.doc,.docx" type="file" id="fileEspecificacionesTecnicas" name="fileEspecificacionesTecnicas" class="form-control">
																	<label style="color:#f0ad4e;">Solo se aceptan archivos en formato pdf,docx</label>
															<input type="hidden" id="tipo" name="tipo" value="1">

																</div>
															</div>
														</div>
														<div class="row" style="text-align: right;">
															<button id="btnGuardarEspecificacionesTecnicasDir" class="btn btn-success">Guardar</button>
															<button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
														</div>
													</form>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<input type="button" onclick="agregarGeneralidad();" value="Agregar Generalidades" class="btn btn-warning btn-xs">
													<input type="hidden" value="<?= $expedienteTecnico->id_et ?>" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico">

												</div>
												<br><span><b>ADMINISTRACIÓN DIRECTA</b></span><br><br>
											<?php } ?>
											<div class="table-responsive">
												<table id="tablaRegistro" style="font-size: 11px;width:100%" class="table table-sm">
													<thead>
														<tr>
															<th>ÍTEM</th>
															<th>DESCRIPCIÓN</th>
															<th>UND.</th>
															<th style="text-align: right;">CANT.</th>
															<th style="text-align: right;">P.U.</th>
															<th style="text-align: right;">TOTAL</th>
															<th style="text-align: center;"> OPCIONES</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($expedienteTecnico->childComponente as $key => $value) { ?>
															<tr class="elementoBuscar">
																<td><b><i><?= $value->numeracion ?></i></b></td>
																<td style="text-align: left;text-transform:uppercase;"><b><i><?= html_escape($value->descripcion) ?></i></b></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
															<?php foreach ($value->childMeta as $index => $item) { ?>
																<?= mostrarAnidado($item, $expedienteTecnico) ?>
															<?php } ?>
														<?php } ?>
													</tbody>
												</table>
											</div>
										<?php } ?>
										<?php if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') {
											if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') {
										?>

									</div>

								</div>
							<?php }
											if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') { ?>
								<div role="tabpanel" class="tab-pane fade <?= $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION INDIRECTA' ? 'active in' : '' ?>" id="tabAdmIndirecta" aria-labelledby="profile-tab">
									<div class="form-horizontal">

										<div>
											<form id="frmEspecificacionesTecnicasInd">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-xs-12">
														<label class="control-label"><?= ($expedienteTecnico->url_especificacion_tecnica != '' ? 'Reemplazar' : 'Adjuntar') ?> Especificación Tecnica:</label>
														<div class="col-md-12 col-sm-12 col-xs-12">
															<input type="hidden" id="hdIdExpedienteTecnico" name="hdIdExpedienteTecnico" notValidate value="<?= $expedienteTecnico->id_et ?>">
															<input accept=".pdf,.doc,.docx" type="file" id="fileEspecificacionesTecnicas" name="fileEspecificacionesTecnicas" class="form-control">
															<label style="color:#f0ad4e;">Solo se aceptan archivos en formato pdf,docx</label>
															<input type="hidden" id="tipo" name="tipo" value="2">
														</div>
													</div>
												</div>
												<div class="row" style="text-align: right;">
													<button id="btnGuardarEspecificacionesTecnicasInd" class="btn btn-success">Guardar</button>
													<button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
												</div>
											</form>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="button" onclick="agregarGeneralidad();" value="Agregar Generalidades" class="btn btn-warning btn-xs">
											<input type="hidden" value="<?= $expedienteTecnico->id_et ?>" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico">

										</div>
										<br><span><b>ADMINISTRACIÓN INDIRECTA</b></span><br><br>
									<?php } ?>
									<div class="table-responsive">
										<table id="tablaRegistro" style="font-size: 11px;width:100%" class="table table-sm">
											<thead>
												<tr>
													<th>ÍTEM</th>
													<th>DESCRIPCIÓN</th>
													<th>UND.</th>
													<th style="text-align: right;">CANT.</th>
													<th style="text-align: right;">P.U.</th>
													<th style="text-align: right;">TOTAL</th>
													<th style="text-align: center;"> OPCIONES</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($expedienteTecnico->childComponenteInd as $key => $value) { ?>
													<tr class="elementoBuscar">
														<td><b><i><?= $value->numeracion ?></i></b></td>
														<td style="text-align: left;text-transform:uppercase;"><b><i><?= html_escape($value->descripcion) ?></i></b></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>
													<?php foreach ($value->childMeta as $index => $item) { ?>
														<?= mostrarAnidado($item, $expedienteTecnico) ?>
													<?php } ?>
												<?php } ?>
											</tbody>
										</table>
									</div>
								<?php } ?>


									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<!--  -->

				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<script>
	$(document).ready(function() {
		$('#tablaRegistro').DataTable({
			"language": idioma_espanol,
			//"pageLength": 25,
			"ordering": false,
		});

	});
	$(function() {
		$('#frmEspecificacionesTecnicasDir').formValidation({
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields: {
				fileEspecificacionesTecnicas: {
					validators: {
						notEmpty: {
							message: '<b style="color: red;">El campo "Memoria Descriptiva" es requerido.</b>'
						}
					}
				}
			}
		});
		$('#frmEspecificacionesTecnicasInd').formValidation({
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields: {
				fileEspecificacionesTecnicas: {
					validators: {
						notEmpty: {
							message: '<b style="color: red;">El campo "Memoria Descriptiva" es requerido.</b>'
						}
					}
				}
			}
		});
	});

	function agregarEspecificacion(idEt, codigo) {
		paginaAjaxDialogo('otherModalEspecificacionTecnica', 'Especificación Técnica', {
			idExpediente: idEt,
			id_DetallePartida: codigo
		}, base_url + 'index.php/ET_EspecificacionTecnica/Guardar', 'GET', null, null, false, true);
	}

	function agregarGeneralidad() {
		var idEt = $('#hdIdExpedienteTecnico').val();

		paginaAjaxDialogo('modalGeneralidad', 'Agregar Generalidades', {
			idExpediente: idEt
		}, base_url + 'index.php/ET_EspecificacionTecnica/AgregarGeneralidad', 'GET', null, null, false, true);
	}
	$('#btnGuardarEspecificacionesTecnicasDir').on('click', function(event) {
		event.preventDefault();
		$('#frmEspecificacionesTecnicasDir').data('formValidation').validate();
		if (!($('#frmEspecificacionesTecnicasDir').data('formValidation').isValid())) {
			return;
		}
		var formData = new FormData($("#frmEspecificacionesTecnicasDir")[0]);
		$.ajax({
			type: "POST",
			url: base_url + "index.php/ET_EspecificacionTecnica/Insertar",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				renderLoading();
			},
			success: function(resp) {
				$('#modalTemp').modal('hide');
				$('#divModalCargaAjax').hide();
				window.location.href = base_url + "index.php/Expediente_Tecnico/verdetalle?id_et=" + $('#hdIdExpedienteTecnico').val();
				objectJSON = JSON.parse(resp);
				console.log(objectJSON);
				swal('', objectJSON.mensaje, (objectJSON.proceso == 'Correcto' ? 'success' : 'error'));
				console.log("entrandogood");
				$('#modalTemp').modal('hide');
				$('#divModalCargaAjax').hide();
				window.location.href = base_url + "index.php/Expediente_Tecnico/verdetalle?id_et=" + $('#hdIdExpedienteTecnico').val();
			},
			error: function() {
				console.log("entrando");
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		});
		$('#frmEspecificacionesTecnicasDir')[0].reset();
	});
	$('#btnGuardarEspecificacionesTecnicasInd').on('click', function(event) {
		event.preventDefault();
		$('#frmEspecificacionesTecnicasInd').data('formValidation').validate();
		if (!($('#frmEspecificacionesTecnicasInd').data('formValidation').isValid())) {
			return;
		}
		var formData = new FormData($("#frmEspecificacionesTecnicasInd")[0]);
		$.ajax({
			type: "POST",
			url: base_url + "index.php/ET_EspecificacionTecnica/Insertar",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				renderLoading();
			},
			success: function(resp) {
				$('#modalTemp').modal('hide');
				$('#divModalCargaAjax').hide();
				window.location.href = base_url + "index.php/Expediente_Tecnico/verdetalle?id_et=" + $('#hdIdExpedienteTecnico').val();
				objectJSON = JSON.parse(resp);
				console.log(objectJSON);
				swal('', objectJSON.mensaje, (objectJSON.proceso == 'Correcto' ? 'success' : 'error'));
				console.log("entrandogood");
				$('#modalTemp').modal('hide');
				$('#divModalCargaAjax').hide();
				window.location.href = base_url + "index.php/Expediente_Tecnico/verdetalle?id_et=" + $('#hdIdExpedienteTecnico').val();
			},
			error: function() {
				console.log("entrando");
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		});
		$('#frmEspecificacionesTecnicasInd')[0].reset();
	});
</script>