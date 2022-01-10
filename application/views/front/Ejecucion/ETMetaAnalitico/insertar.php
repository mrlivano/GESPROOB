<div class="form-horizontal">
	<div id="divInsertarAnalisisUnitario" class="row">
		<div class="col-md-8 col-sm-8 col-xs-12">
			<label for="control-label">Asociar a Clasificador:</label>
			<div>
				<select name="selectPresupuestoAnalitico" id="selectPresupuestoAnalitico" class="form-control">
					<option value="">Seleccione una Opción</option>
					<?php foreach($listaETPresupuestoAnalitico as $value){ ?>
						<option value="<?=$value->id_analitico?>"><?=html_escape($value->desc_presupuesto_ej)?> <?=html_escape($value->num_clasificador)?> : <?=html_escape($value->desc_clasificador)?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<label for="control-label">.</label>
			<div>
				<input type="hidden" id="hdIdMeta" value="<?=$idMeta?>">
				<input type="button" class="btn btn-info" value="Asociar a Clasificador" style="width: 100%;" onclick="registrarAnalisisClasificador();">
			</div>
		</div>
	</div>
	<hr style="margin: 4px;">
	<div id="divListaAnalisisUnitario" style="height: 350px;overflow-y: scroll;">
		<?php foreach($listaAnaliticoMeta as $value) { ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div id="divFormDetallaAnalisisUnitario<?=$value->id_meta_analitico?>" style="padding: 4px;">
						<div class="row">
							<div class="col-md-9 col-sm-10 col-xs-12">
								<label for="control-label">(Clasificador | Presupuesto ejecución)</label>
								<div>
									<select disabled name="selectPresupuestoAnalitico<?=$value->id_meta_analitico?>" id="selectPresupuestoAnalitico<?=$value->id_meta_analitico?>" class="form-control selectPresupuestoAnaliticoAux">
										<?php foreach($listaETPresupuestoAnalitico as $item) { ?>
											<option value="<?=$item->id_analitico?>" <?=($item->id_analitico==$value->id_analitico ? 'selected' : '')?>><?=html_escape($item->desc_clasificador.' | '.$item->desc_presupuesto_ej)?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-2 col-sm-12 col-xs-12">
								<label for="control-label">.</label>
								<div>
									<button  class="btn btn-danger btn-sm" onclick="eliminarAnalisisUnitario(<?=$value->id_meta_analitico?>, this);"><span class="fa fa-trash-o"></span> Eliminar</button>								
								</div>											
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<hr style="margin-top: 4px;">
	<div class="row" style="text-align: right;">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>
</div>
<script>
	$(function()
	{
		$('#selectPresupuestoAnalitico').selectpicker({ liveSearch: true });

	    $('#divInsertarAnalisisUnitario').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectPresupuestoAnalitico:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Presupuesto analítico" es requerido.</b>'
						}
					}
				}
			}
		});
	});

	function registrarAnalisisClasificador()
	{
		$('#divInsertarAnalisisUnitario').data('formValidation').validate();

		if(!($('#divInsertarAnalisisUnitario').data('formValidation').isValid()))
		{
			return;
		}

		var idAnalitico=$('#selectPresupuestoAnalitico').find("option:selected").val();

		paginaAjaxJSON({ "idAnalitico" : idAnalitico,"idMeta" : $('#hdIdMeta').val() }, base_url+'index.php/ET_Meta_Analitico/insertar', 'POST', null, function(objectJSON)
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

			var htmlTemp=''+
			'<div class="row">'+
				'<div class="col-md-12 col-sm-12 col-xs-12">'+
					'<div id="divFormDetallaAnalisisUnitario'+objectJSON.idAnalisis+'" style="padding: 4px;">'+
						'<div class="row">'+
							'<div class="col-md-9 col-sm-10 col-xs-12">'+
								'<label for="control-label">(Clasificador | Presupuesto ejecución)</label>'+
								'<div>'+
									'<select name="selectPresupuestoAnalitico'+objectJSON.idAnalisis+'" id="selectPresupuestoAnalitico'+objectJSON.idAnalisis+'" class="form-control" disabled>'+
										'<option></option>';
											<?php foreach($listaETPresupuestoAnalitico as $item){ ?>
												htmlTemp+='<option value="<?=$item->id_analitico?>"><?=html_escape($item->desc_clasificador.' | '.$item->desc_presupuesto_ej)?></option>';
											<?php } ?>
									htmlTemp+='</select>'+
								'</div>'+
							'</div>'+
							'<div class="col-md-2 col-sm-2 col-xs-12">'+
								'<label for="control-label">.</label>'+
								'<div>'+
									'<button  class="btn btn-danger btn-sm" onclick="eliminarAnalisisUnitario('+objectJSON.idAnalisis+', this);"><span class="fa fa-trash-o"></span> Eliminar</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>';

			$('#divListaAnalisisUnitario').append(htmlTemp);

			$('#selectPresupuestoAnalitico'+objectJSON.idAnalisis).val(objectJSON.idAnalitico);

		}, false, true);
	}

	function eliminarAnalisisUnitario(idAnalisis, element)
	{
		if(confirm('¿Realmente desea borrar este Clasificador asociado?'))
		{
			paginaAjaxJSON({ "idAnalisis" : idAnalisis, "idMeta" : <?=$idMeta?> }, base_url+'index.php/ET_Meta_Analitico/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				$(element).parent().parent().parent().parent().parent().parent().remove();

			}, false, true);
		}
	}
	

</script>