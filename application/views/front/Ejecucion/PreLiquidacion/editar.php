<style>
	.row
	{
		margin-top: 4px;
	}
</style>

<form class="form-horizontal" id="form-EditarPreLiquidacion" action="<?php echo base_url();?>index.php/PreLiquidacion/editar" method="POST" enctype="multipart/form-data" >

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">

				<div class="x_content">
          <div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Proyecto</label>
							<div>
								<input id="txtProyecto" name="txtProyecto" value="<?= $Listarproyectobuscado->nombre_pi?>" class="form-control col-md-4 col-xs-12" readonly="readonly"  placeholder="Nombre del proyecto"  autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Unidad Ejecutora</label>
							<div>
								<input id="id_liq_proyecto" name="id_liq_proyecto" value="<?= $preliquidacion[0]->id_liq_proyecto?>" class="form-control col-md-4 col-xs-12"  placeholder="Nombre del proyecto" autocomplete="off"  type="hidden">
								<input id="txtUnidadEjecutora" name="txtUnidadEjecutora" value="<?= $preliquidacion[0]->unidad_ejec?>" class="form-control col-md-4 col-xs-12"  placeholder="Nombre de la Unidad Ejecutora"  autocomplete="off" readonly="readonly">
							</div>
						</div>
					</div>
          <div class="row">
            <div class="col-md-6 col-sm-3 col-xs-12">
							<label class="control-label">Fuente de financiamiento</label>
					    	<div class="form-group">
						      	<select class="selectpicker form-control" id="txtFuenteFinanciamiento" name="txtFuenteFinanciamiento" data-live-search="true">
						        	<?php foreach ($listaFuenteFinanciamiento as $key => $value) { ?>
												<option value="<?=$value->nombre_fuente_finan?>" <?php if ($preliquidacion[0]->fuente_fto == $value->nombre_fuente_finan) echo 'selected="selected"';  ?>><?=$value->nombre_fuente_finan?></option>
											<?php } ?>
						      	</select>
					    	</div>
						</div>
						<div class="col-md-6 col-sm-3 col-xs-12">
					  		<label class="control-label">Modalidad de Ejecución</label>
					    	<div class="form-group">
						      	<select class="selectpicker form-control" id="txtModalidadEjecucion" name="txtModalidadEjecucion" data-live-search="true">
						      		<?php foreach ($listaModalidadEjecucion as $key => $value) { ?>
						      			<option value='<?=$value->nombre_modalidad_ejec?>' <?php if ($preliquidacion[0]->mod_ejec == $value->nombre_modalidad_ejec) echo 'selected="selected"';  ?>><?=$value->nombre_modalidad_ejec?></option>
						      		<?php } ?>
						      	</select>
					    	</div>
					  	</div>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Correlativo</label>
							<div>
								<input id="txtCorrelativo" name="txtCorrelativo" class="form-control col-md-4 col-xs-12" value="<?= $Listarproyectobuscado->nombre_funcion?>"  placeholder="Funcion"  autocomplete="off" readonly="readonly">
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Funcion</label>
							<div>
								<input id="txtFuncion" name="txtFuncion" class="form-control col-md-4 col-xs-12" value="<?= $Listarproyectobuscado->nombre_funcion?>"  placeholder="Funcion"  autocomplete="off" readonly="readonly">
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Programa</label>
							<div>
								<input id="txtPrograma" name="txtPrograma" class="form-control col-md-4 col-xs-12" value="<?= $Listarproyectobuscado->nombre_div_funcional?>" placeholder="Programa"  autocomplete="off" readonly="readonly">
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Sub Programa</label>
							<div>
								<input id="txtSubPrograma" name="txtSubPrograma" class="form-control col-md-4 col-xs-12" value="<?= $Listarproyectobuscado->nombre_grup_funcional?>" placeholder="Sub Programa"  autocomplete="off" readonly="readonly">
							</div>
						</div>
					</div>
          <div class="row">
            <div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">ACT/Proyecto</label>
							<div>
								<input id="txtActProyecto" name="txtActProyecto" class="form-control col-md-4 col-xs-12" value="<?= $preliquidacion[0]->act_proyecto ?>" placeholder="Componente"  autocomplete="off" >
							</div>
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Componente</label>
							<div>
								<input id="txtComponente" name="txtComponente" class="form-control col-md-4 col-xs-12"  value="<?= $preliquidacion[0]->componente ?>" placeholder="Componente"  autocomplete="off" >
							</div>
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Meta</label>
							<div>
								<input id="txtMeta" name="txtMeta" class="form-control col-md-4 col-xs-12" value="<?= $preliquidacion[0]->meta ?>" placeholder="Meta"  autocomplete="off" >
							</div>
						</div>
          </div>
					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Ubicacion</label>
							<div>
								<input id="txtUbicacion" name="txtUbicacion" class="form-control" value="<?= $preliquidacion[0]->ubicacion ?>" placeholder="Departamento"  autocomplete="off" >
							</div>
						</div>
					</div>
					<div class="row">
						<!-- <form id="form-EditarPreLiquidacion" method="post" class="form-horizontal"> -->
						<?php foreach($responsables as $responsable) : ?>
						    <div class="form-group">
									<div class="col-md-2">
										<input type="hidden" name="idResponsable[]" value="<?= $responsable->id_pre_persona ?>">
										<label class="control-label">Tipo</label>
										<select  id="cbxTipoResponsable" name="tipo[]" class="form-control col-md-2 col-xs-2">
											<option value="residente" <?php if ($responsable->tipo == "residente") echo 'selected="selected"' ?>>Residente</option>
											<option value="supervisor" <?php if ($responsable->tipo == "supervisor") echo 'selected="selected"' ?>>Supervisor</option>
										</select>
										<div>
										</div>
									</div>
									<div class="col-md-3">
										<label class="control-label">Responsable</label>
											<select  id="cbxResponsable" name="responsable[]" class="form-control col-md-2 col-xs-2">
												<?php foreach($listarPersona as $item){ ?>
														<option value="<?=$item->id_persona; ?>" <?php if ($responsable->id_persona == $item->id_persona) echo 'selected="selected"' ?>><?= $item->nombreCompleto;?></option>
												<?php } ?>
											</select>
										<div>
										</div>
									</div>
									<div class="col-md-3">
			                <label class="control-label">Fecha Inicio</label>
			                <input class="form-control col-md-4 col-xs-12" type="date" max="2050-12-31" name="dateStart[]" value="<?= $responsable->fecha_inicio ?>" id="dateStart" notValidate>
			            </div>
									<div class="col-md-3">
			                <label class="control-label">Fecha Fin</label>
			                <input class="form-control col-md-4 col-xs-12" type="date" max="2050-12-31" name="dateEnd[]" value="<?= $responsable->fecha_fin ?>" id="dateEnd" notValidate>
			            </div>
						      <div class="col-md-1">
									<label class="control-label">Opción</label>
						        <button type="button" class="btn btn-default btn-block addButton"><i class="fa fa-plus"></i></button>
						      </div>
						    </div>
							<?php endforeach; ?>
						    <!-- The template for adding new field -->
						    <div class="form-group hide" id="bookTemplate">
									<div class="col-md-2">
										<label class="control-label">Tipo</label>
										<select id="tipo" class="form-control col-md-2 col-xs-2">
											<option value="residente">Residente</option>
											<option value="supervisor">Supervisor</option>
										</select>
										<div>
										</div>
									</div>
									<div class="col-md-3">
										<label class="control-label">Responsable</label>
										<select id="responsable" class="form-control col-md-2 col-xs-2">
												<?php foreach($listarPersona as $item){ ?>
													<option value="<?=$item->id_persona; ?>"><?= $item->nombreCompleto;?></option>
												<?php } ?>
											</select>
										<div>
										</div>
									</div>
									<div class="col-md-3">
			                <label class="control-label">Fecha Inicio</label>
			                <input class="form-control col-md-4 col-xs-12" type="date" max="2050-12-31" id="dateStart" notValidate>
			            </div>
									<div class="col-md-3">
			                <label class="control-label">Fecha Fin</label>
			                <input class="form-control col-md-4 col-xs-12" type="date" max="2050-12-31" id="dateEnd" notValidate>
			            </div>
						        <div class="col-md-1">
											<label class="control-label"></label>
						            <button type="button" class="btn btn-default btn-block removeButton"><i class="fa fa-minus"></i></button>
						        </div>
						    </div>
						<!-- </form> -->
					</div>
				</div>

			</div>
		</div>
	</div>


<div class="ln_solid"></div>
		<div class="row" style="text-align: right;">
			<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
			<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>
</form>
 <script>

 $(document).ready(function() {
		 var titleValidators = {
						 row: '.col-xs-2',   // The tipo is placed inside a <div class="col-xs-4"> element
						 validators: {
								 notEmpty: {
										 message: 'The tipo is required'
								 }
						 }
				 },
				 isbnValidators = {
						 row: '.col-xs-2',
						 validators: {
								 notEmpty: {
										 message: 'The responsable is required'
								 }
						 }
				 },
				 priceValidators = {
						 row: '.col-xs-2',
						 validators: {
								 notEmpty: {
										 message: 'The dateStart is required'
								 }
						 }
				 },
				 bookIndex = 0;

		 $('#form-EditarPreLiquidacion')
				 .formValidation({
						 framework: 'bootstrap',
						 icon: {
								 valid: 'glyphicon glyphicon-ok',
								 invalid: 'glyphicon glyphicon-remove',
								 validating: 'glyphicon glyphicon-refresh'
						 },
						 fields: {
							 	 'idResponsable': titleValidators,
								 'tipo[0]': titleValidators,
								 'responsable[0]': isbnValidators,
								 'dateStart[0]': priceValidators,
								'dateEnd[0]': priceValidators
						 }
				 })

				 // Add button click handler
				 .on('click', '.addButton', function() {
						 bookIndex++;
						 var $template = $('#bookTemplate'),
								 $clone    = $template
																 .clone()
																 .removeClass('hide')
																 .removeAttr('id')
																 .attr('data-book-index', bookIndex)
																 .insertBefore($template);

						 // Update the name attributes
						 $clone
								 .find('[id="tipo"]').attr('name', 'tipo[' + bookIndex + ']').end()
								 .find('[id="responsable"]').attr('name', 'responsable[' + bookIndex + ']').end()
								 .find('[id="dateStart"]').attr('name', 'dateStart[' + bookIndex + ']').end()
								.find('[id="dateEnd"]').attr('name', 'dateEnd[' + bookIndex + ']').end();

						 // Add new fields
						 // Note that we also pass the validator rules for new field as the third parameter
						 $('#form-EditarPreLiquidacion')
								 .formValidation('addField', 'tipo[' + bookIndex + ']', titleValidators)
								 .formValidation('addField', 'responsable[' + bookIndex + ']', isbnValidators)
								 .formValidation('addField', 'dateStart[' + bookIndex + ']', priceValidators)
								.formValidation('addField', 'dateEnd[' + bookIndex + ']', priceValidators);
				 })

				 // Remove button click handler
				 .on('click', '.removeButton', function() {
						 var $row  = $(this).parents('.form-group'),
								 index = $row.attr('data-book-index');

						 // Remove fields
						 $('#form-EditarPreLiquidacion')
								 .formValidation('removeField', $row.find('[name="tipo[' + index + ']"]'))
								 .formValidation('removeField', $row.find('[name="responsable[' + index + ']"]'))
								 .formValidation('removeField', $row.find('[name="dateStart[' + index + ']"]'))
								.formValidation('removeField', $row.find('[name="dateEnd[' + index + ']"]'));

						 // Remove element containing the fields
						 $row.remove();
				 });
 });

$(function()
{
	$('#form-EditarExpedienteTecnico').formValidation(
	{
		framework: 'bootstrap',
		excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
		live: 'enabled',
		message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
		trigger: null,
		fields:
		{
			txtNombreUe:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Nombre Unidad Ejecutora." es requerido.</b>'
					}
				}
			},
			txtDireccionUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Dirección de unidad ejecutora" es requerido.</b>'
					}
				}
			},
			txtUbicacionUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Ubicacion unidad ejecutora" es requerido.</b>'
					}
				}
			},
			txtTelefonoUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Telefono unidad ejecutora" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^[0-9]+$/,
						message: '<b style="color: red;">El campo "Teléfono" debe ser un numero.</b>'
					}
				}
			},
			txtRucUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Ruc" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^([0-9]){11}$/,
						message: '<b style="color: red;">El campo "Ruc" debe ser un número de 11 dígitos.</b>'
					}
				}
			},
			txtCodigoUnico:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Codigo" es requerido.</b>'
					}
				}
			},
			txtCostoTotalPreInversion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Total PreInversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo total pre Inversion " debe ser un valor en soles.</b>'
					}
				}
			},
			txtCostoDirectoPre:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Directo PreInversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo Directo pre Inversion " debe ser un valor en soles.</b>'
					}
				}
			},
			txtCostoIndirectoPre:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Indirecto PreInversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo Indirecto Pre Inversion " debe ser un valor en soles.</b>'
					}
				}
			},
			txtCostoTotalInversion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Total Inversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo Total de Inversion " debe ser un valor en soles.</b>'
					}
				}
			},
			txtCostoDirectoInversion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Directo de inversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo Directo de inversion" debe ser un valor en soles.</b>'
					}
				}
			},
			txtGastosGenerales:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Gastos Generales" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Gastos Generales" debe ser un valor en soles.</b>'
					}
				}
			},
			txtGastosSupervision:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Gastos supervisión" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Gastos Supervision" debe ser un valor en soles.</b>'
					}
				}
			},
			txtFuncion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Funcion" es requerido.</b>'
					}
				}
			},
			txtPrograma:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Programa" es requerido.</b>'
					}
				}
			},
			txtSubPrograma:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Sub Programa" es requerido.</b>'
					}
				}
			},
			txtProyecto:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Proyecto" es requerido.</b>'
					}
				}
			},
			txtComponente:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Componente" es requerido.</b>'
					}
				}
			},
			txtMeta:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Meta" es requerido.</b>'
					}
				}
			},
			txtFuenteFinanciamiento:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Fuente Financiamiento" es requerido.</b>'
					}
				}
			},
			txtModalidadEjecucion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Modalidad Ejecucion" es requerido.</b>'
					}
				}
			},
			txtTiempoEjecucionPip:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Tiempo Ejecucion" es requerido.</b>'
					}
				}
			},
			txtNumBeneficiarios:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Tiempo Ejecucion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^\d*$/,
						message: '<b style="color: red;">El campo "Numero de beneficiarios" debe ser un numero.</b>'
					}
				}
			},
			txtNumFolio:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Numero de Folio" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^\d*$/,
						message: '<b style="color: red;">El campo "Numero de folios" debe ser un número.</b>'
					}
				}
			}
		}
	});
});

$('#btnEnviarFormulario').on('click', function(event)
{
	event.preventDefault();
	$('#form-EditarPreLiquidacion').data('formValidation').validate();
	if(!($('#form-EditarPreLiquidacion').data('formValidation').isValid()))
	{
		return;
	}
				var formData=new FormData($("#form-EditarPreLiquidacion")[0]);
				var dataString = $('#form-EditarPreLiquidacion').serialize();
				$.ajax({
						type:"POST",
						enctype: 'multipart/form-data',
						url:base_url+"index.php/Preliquidacion/editar",
						data: formData,
						cache: false,
						contentType:false,
						processData:false,
						beforeSend: function() {
							renderLoading();
						},
						success:function(resp)
						{
							swal("Correcto!", "Se modificó los datos.", "success");
							$('#divModalCargaAjax').hide();
						},
						error:function()
						{
							swal('Error','Ha ocurrido un error inesperado','error')
							$('#divModalCargaAjax').hide();
						}
				});
			$('#form-EditarPreLiquidacion')[0].reset();
});


	$(".moneda").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });


    var format = function(num)
    {
	    var str = num.replace("", ""), parts = false, output = [], i = 1, formatted = null;
	    if(str.indexOf(".") > 0)
	    {
	        parts = str.split(".");
	        str = parts[0];
	    }
	    str = str.split("").reverse();
	    for(var j = 0, len = str.length; j < len; j++)
	    {
	        if(str[j] != ",")
	        {
	            output.push(str[j]);
	            if(i%3 == 0 && j < (len - 1))
	            {
	                output.push(",");
	            }
	            i++;
	        }
	    }
	    formatted = output.reverse().join("");
	    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	};

	$('.selectpicker').selectpicker({
	});

</script>
