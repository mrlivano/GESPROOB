<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>EXPEDIENTE TÉCNICO</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#tab_elaboracion" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Expedientes en Elaboración</a>
							</li>
							<li role="presentation">
								<a href="#tab_aprobacion" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Expedientes Aprobados</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_elaboracion" aria-labelledby="home-tab">
								<br>
								<button data-toggle="modal" data-target="#BuscarProyecto" class="btn btn-primary" style="margin-top: 5px;margin-bottom: 15px;"><span class="fa fa-plus"></span> NUEVO</button>
								<div class="table-responsive">
									<table id="table-ExpedienteTecnico" style="text-align: center;" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td class="col-md-1 col-xs-12">Detalle</td>
												<td class="col-md-2 col-xs-12">Unidad Ejecutora</td>
												<td class="col-md-5 col-xs-12">Nombre del proyecto</td>
												<td class="col-md-2 col-xs-12">Costo Total del proyecto Preinversion</td>
												<td class="col-md-2 col-xs-12">Costo Total del proyecto Inversion</td>
												<td class="col-md-0 col-xs-12">Tiempo Ejecucion</td>
												<td class="col-md-0 col-xs-12">Numero Beneficiarios</td>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($listaExpedienteTecnicoElaboracion as $item) { ?>
												<tr>
													<td>
														<a style="width: 100%;" href="<?= site_url('Expediente_Tecnico/verdetalle?id_et=' . $item->id_et); ?>" role="button" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> <?= $item->codigo_unico_pi ?></a>

													</td>
													<td>
														<?= $item->nombre_ue ?>
													</td>
													<td style="text-align: justify;">
														<?= $item->nombre_pi ?>
													</td>
													<td>
														S/. <?= a_number_format($item->costo_total_preinv_et, 2, '.', ",", 3) ?>
													</td>
													<td>
														S/. <?= a_number_format($item->costo_total_inv_et, 2, '.', ",", 3) ?>
													</td>
													<td>
														<?= $item->tiempo_ejecucion_pi_et ?>
													</td>
													<td>
														<?= a_number_format($item->num_beneficiarios_indirectos, 0, '.', ",", 3) ?>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<!--Modal Buscar Proyecto-->
							<div class="modal fade" id="BuscarProyecto" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h2 class="modal-title">SELECCIONAR PROYECTO</h2>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12" id="divProyectoBuscar">
														<input type="hidden" id="idProyecto" name="idProyecto" notValidate>
														<label class="control-label">Proyecto</label>
														<div>
															<select name="selectProyecto" id="selectProyecto"  class="form-control selectpicker">
																<option value="">Buscar Proyecto</option>
															</select>
														</div><br>
													</div>
													
													<div class="col-xs-12">
													
													<div class="row" style="text-align: right;">
														<button  onclick="BuscarProyectocodigo()" class="btn btn-success" data-dismiss="modal">BUSCAR</button>
														<button class="btn btn-danger" data-dismiss="modal">CERRAR</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--end Modal Buscar Proyecto-->
							<div role="tabpanel" class="tab-pane fade" id="tab_aprobacion" aria-labelledby="home-tab">
								<br><br>
								<div class="table-responsive">
									<table id="table-ExpedientesAprobados" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Detalle</th>
												<th>Unidad Ejecutora</th>
												<th>Proyecto</th>
												<th>Costo de Inversion</th>
												<th>Fecha de Aprobación</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($listaExpedientesAprobados as $item) { ?>
												<tr>
													<td style="width: 10%;">
														<a style="width: 100%;" href="<?= site_url('Expediente_Tecnico/verdetalle?id_et=' . $item->id_et); ?>" role="button" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> <?= $item->codigo_unico_pi ?></a>

													</td>
													<td style="width: 15%;">
														<?= $item->nombre_ue ?>
													</td>
													<td style="width: 47%;">
														<?= $item->nombre_pi ?>
													</td>
													<td style="width: 13%;">
														S/. <?= a_number_format($item->costo_total_inv_et, 2, '.', ",", 3) ?>
													</td>
													<td style="width: 10%;">
														<?= date('d/m/Y', strtotime($item->fecha_aprobacion)) ?>
													</td>
													<td style="width: 5%;">
														<a href='<?php echo base_url() . "uploads/ResolucioExpediente/" . $item->id_et . "." . $item->url_doc_aprobacion_et; ?>' target='_blank'><i class='fa fa-file fa-lg'></i></a>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<?php
$sessionTempCorrecto = $this->session->flashdata('correcto');
$sessionTempError = $this->session->flashdata('error');

if ($sessionTempCorrecto) { ?>
	<script>
		$(document).ready(function() {
			swal('', '<?= $sessionTempCorrecto ?>', "success");
		});
	</script>
<?php }

if ($sessionTempError) { ?>
	<script>
		$(document).ready(function() {
			swal('', '<?= $sessionTempError ?>', "error");
		});
	</script>
<?php } ?>
<script>
	$(document).ready(function() {
		$('#table-ExpedienteTecnico').DataTable({
			"language": idioma_espanol
		});

		$('#table-ExpedientesAprobados').DataTable({
			"language": idioma_espanol
		});
	});

	function BuscarProyectocodigo() {
		var inputValue=$("#idProyecto").val();
		$('#selectProyecto').find('option[1]').remove();
		if (inputValue === "") {
				swal.showInputError("Ingresar codigo!");
				return false
			} else {
				event.preventDefault();
				$.ajax({
					"url": base_url + "index.php/Expediente_Tecnico/registroBuscarProyecto",
					type: "GET",
					data: {
						inputValue: inputValue
					},
					cache: false,
					success: function(resp) {
						var ProyetoEncontrado = JSON.parse(resp);
						if (ProyetoEncontrado != 'no existe') {
							if (ProyetoEncontrado == true) {
								console.log("ya esta el proy");
								swal("","Este proyecto de inversión ya esta registrado.","error");
								return false
							}

							var buscar = "true";
							paginaAjaxDialogo(null, 'Registrar Expediente Técnico', {
								CodigoUnico: inputValue,
								buscar: buscar
							}, base_url + 'index.php/Expediente_Tecnico/insertar', 'GET', null, null, false, true);
							swal("Correcto!", "Se Encontro el Proyecto: " + inputValue, "success");
						} else {
							swal("","No se encontro un proyecto de inversión con ese código único. Intente Nuevamente!","error");
							return false
						}
					}
				});
			}
	}
	$(function()
	{
		$('#selectProyecto').selectpicker({ liveSearch: true }).ajaxSelectPicker(
		{
	        ajax: {
	            url: base_url+'index.php/ProyectoInversion/BuscarProyectoLike',
	            data: { valueSearch : '{{{q}}}' }
	        },
	        locale:
	        {
	            statusInitialized : 'Escriba el codigo o nombre del proyecto que desea buscar',
	            statusNoResults : 'No se encontro',
	            statusSearching : 'Buscando...',
	            searchPlaceholder : 'Buscar',
	            emptyTitle:'Seleccionar y comienze a escribir',
	            errorText:'No se han podido recuperar los resultados'

	        },
	        preprocessData: function(data)
	        {
	        	var dataForSelect=[];
	        	for(var i=0; i<data.length; i++)
	        	{
	        		
	        		dataForSelect.push(
	                {
	                    "value" : data[i].proyecto,
	                    "text" : data[i].proyecto,
	                    "data" :
	                    {
	                    	"codigo_unico_pi" : data[i].codigo_unico_pi
	                    },
	                    "disabled" : false
	                });
	        	}

	            return dataForSelect;
	        },
	        preserveSelected: false
	    });

		$('#selectProyecto').on('change', function()
		{
			var selected=$(this).find("option:selected").val();

			if(selected.trim()!='')
			{
				$('#idProyecto').val($(this).find("option:selected").data('codigo_unico_pi'));
			}
		});

		$('#divProyectoBuscar').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectProyecto:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Clasificador" es requerido.</b>'
						}
					}
				}
			}
		});		
	});
</script>