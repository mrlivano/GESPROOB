<form class="form-horizontal" id="form-addDetallePresupuesto" action="<?php echo base_url();?>index.php/FE_Detalle_Presupuesto/insertar" method="POST">
	<h4 style="margin-bottom: 0px;">Datos generales</h4>
	<hr style="margin: 2px;margin-bottom: 5px;">
	<div class="row">
		<div class="col-md-9 col-sm-9 col-xs-9">
			<label>Nombre de estudio de inversión</label>
			<input type="text" class="form-control" value="<?=html_escape($fePresupuestoInv->nombre_est_inv)?>" autocomplete="off" readonly="readonly">
			<input type="hidden" name="hdIdPresupuestoFE" value="<?=$fePresupuestoInv->id_presupuesto_fe?>">
			<input type="hidden" name="hdIdEstudioInversion" value="<?=$fePresupuestoInv->id_est_inv?>">
		</div>
		<div class="col-md-3 col-sm-3 col-xs-3">
			<label>% general de imprevistos</label>
			<input type="text" id="txtPorcentajeImprevistos" name="txtPorcentajeImprevistos" class="form-control" value="<?=number_format($fePresupuestoInv->porcentaje_imprevistos, 0)?>" autocomplete="off">
		</div>
	</div>
	<h4 style="margin-bottom: 0px;">Detalle de Gasto</h4>
	<hr style="margin: 2px;margin-bottom: 5px;">
	<div class="row">
		<div id="divTipoGasto" class="col-md-9 col-sm-6 col-xs-12">
			<label>Tipo de Gasto</label>
			<select id="cbxTipoGasto" name="cbxTipoGasto" class="form-control" required="">
				<?php foreach($listaTipoGasto as $value){ ?>
					<option value="<?=$value->id_tipo_gasto.','.html_escape($value->desc_tipo_gasto)?>"><?=html_escape($value->desc_tipo_gasto)?></option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<label>.</label>
			<input type="button" id="btnAgregarTipoGasto" class="btn btn-success form-control" value="Agregar">
		</div>
	</div>
	<hr style="margin: 2px;">
	<div class="row">
		<div>
			<div id="DetallePresupestoFormulacion">
				<div id="AreaDetallePF" class="col-xs-3">
					<ul id="pestanaDetallePF" class="nav nav-tabs tabs-left">
						<?php foreach($listaFEDetallePresupuesto as $value){ ?>
							<li id="pestaniaTabPaneDetalleGasto<?=$value->id_tipo_gasto?>">
								<a href="#tabPaneDetalleGasto<?=$value->id_tipo_gasto?>" data-toggle="tab"><?=html_escape($value->desc_tipo_gasto)?></a>
								<input type="hidden" name="hdIdDetallePresupuesto[]" value="<?=$value->id_tipo_gasto?>">
							</li>
						<?php } ?>
					<ul>
				</div>
				<div id="AreaContenidoDetallePF" class="col-xs-9" style="border-left: 1px solid #999999;">
					<div id="contePestanaDetallePF" class="tab-content">
						<?php foreach($listaFEDetallePresupuesto as $value){ ?>
							<div class="tab-pane" id="tabPaneDetalleGasto<?=$value->id_tipo_gasto?>">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: left;">
										<input type="button" class="btn btn-danger btn-xs" value="Eliminar todo este detalle" onclick="removerPanel(<?=$value->id_tipo_gasto?>);" style="margin: 2px;margin-left: 0px;">
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">
										<h5><?=html_escape($value->desc_tipo_gasto)?></h5>
									</div>
								</div>
								<hr style="margin-bottom: 4px;margin-top: 0px;">
								<div class="row">
									<div class="col-md-8 col-sm-8 col-xs-8">
										<labe>Descripción</label>
							   			<input type="text" id="txtDescripcionDetalleGasto<?=$value->id_tipo_gasto?>" name="txtDescripcionDetalleGasto<?=$value->id_tipo_gasto?>" class="form-control" autocomplete="off">
									</div>
									<div class="col-md-4 col-sm-4 col-xs-4">
										<labe>Undidad</label>
								   		<select id="selectIdUnidad<?=$value->id_tipo_gasto?>" name="selectIdUnidad<?=$value->id_tipo_gasto?>" class="form-control">
											<?php foreach($listaUnidadMedida as $item){ ?>
												<option value="<?=$item->id_unidad.','.$item->descripcion?>"><?=$item->descripcion?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-4">
										<labe>Cantidad</label>
							   			<input type="text" id="txtCantidadDetalleGasto<?=$value->id_tipo_gasto?>" name="txtCantidadDetalleGasto<?=$value->id_tipo_gasto?>" class="form-control" autocomplete="off" onkeyup="calcularSubTotalDetalleGasto(<?=$value->id_tipo_gasto?>);">
									</div>
									<div class="col-md-4 col-sm-4 col-xs-4">
										<labe>Costo U.</label>
							   			<input type="text" id="txtCostoUnitarioDetalleGasto<?=$value->id_tipo_gasto?>" name="txtCostoUnitarioDetalleGasto<?=$value->id_tipo_gasto?>" class="form-control" autocomplete="off" onkeyup="calcularSubTotalDetalleGasto(<?=$value->id_tipo_gasto?>);">
									</div>
									<div class="col-md-4 col-sm-4 col-xs-4">
										<labe>Total</label>
							   			<input type="text" id="txtSubTotalDetalleGasto<?=$value->id_tipo_gasto?>" name="txtSubTotalDetalleGasto<?=$value->id_tipo_gasto?>" class="form-control" autocomplete="off" readonly="readonly">
									</div>
								</div>
								<div class="row" style="margin-top: 7px">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<input type="button" class="btn btn-success form-control" value="Agregar" onclick="agregarDetalleGasto(<?=$value->id_tipo_gasto?>);">
									</div>
								</div>
								<hr>
								<table id="tableDetalleGasto<?=$value->id_tipo_gasto?>" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Descripción</th>
											<th>Unidad</th>
											<th>C.</th>
											<th>C. U.</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($value->childFEDetalleGasto as $item){ ?>
											<tr>
												<td><input type="hidden" name="descripcionDetalleGasto<?=$value->id_tipo_gasto?>[]" value="<?=html_escape($item->desc_detalle_gasto)?>"><?=html_escape($item->desc_detalle_gasto)?></td>
												<td><input type="hidden" name="idUnidadMedida<?=$value->id_tipo_gasto?>[]" value="<?=$item->id_unidad?>"><?=html_escape($item->descripcionUnidadMedida)?></td>
												<td><input type="hidden" name="cantidadDetalleGasto<?=$value->id_tipo_gasto?>[]" value="<?=$item->cantidad_detalle_gasto?>"><?=$item->cantidad_detalle_gasto?></td>
												<td><input type="hidden" name="costoUnitarioDetalleGasto<?=$value->id_tipo_gasto?>[]" value="<?=$item->costo_uni_detalle_gasto?>"><?=$item->costo_uni_detalle_gasto?></td>
												<td><input type="hidden" name="subTotalDetalleGasto<?=$value->id_tipo_gasto?>[]" value="<?=$item->sub_total_detalle_gasto?>"><?=$item->sub_total_detalle_gasto?></td>
												<td><a href="#" onclick="$(this).parent().parent().remove();" style="color: red;font-weight: bold;text-decoration: underline;">Eliminar</a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row" style="text-align: right;">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar detalle del presupuesto</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>
<script>
	$("#btnAgregarTipoGasto").on('click', function(event)
	{
		$('#divTipoGasto').data('formValidation').validate();

		if(!($('#divTipoGasto').data('formValidation').isValid()))
		{
			return;
		}

		var posicionTemporal=$("#cbxTipoGasto").val().indexOf(',');
		var idTab=$("#cbxTipoGasto").val().substring(0, posicionTemporal);
		var nombreTab=$("#cbxTipoGasto").val().substring(posicionTemporal+1, $("#cbxTipoGasto").val().length);

		if($('#pestaniaTabPaneDetalleGasto'+idTab).length)
		{
			swal(
			{
				title: '',
				text: 'No pueden agregarse dos tipos de gasto al mismo tiempo.',
				type: 'error'
			},
			function()
			{

			});

			return false;
		}

		var tempUnidadMedida='';

		<?php foreach($listaUnidadMedida as $value){ ?>
			tempUnidadMedida+='<option value="<?=$value->id_unidad.','.html_escape($value->descripcion)?>"><?=html_escape($value->descripcion)?></option>';
		<?php } ?>

		var htmlTempPestania='<li id="pestaniaTabPaneDetalleGasto'+idTab+'">'+
			'<a href="#tabPaneDetalleGasto'+idTab+'" data-toggle="tab">'+replaceAll(replaceAll(nombreTab, '<', '&lt;'), '>', '&gt;')+'</a>'+
			'<input type="hidden" name="hdIdDetallePresupuesto[]" value="'+idTab+'">'
		'</li>';

		$('#DetallePresupestoFormulacion > #AreaDetallePF > #pestanaDetallePF ').append(htmlTempPestania);

		var htmlTempContenido='<div class="tab-pane" id="tabPaneDetalleGasto'+idTab+'">'+
			'<div class="row">'+
				'<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: left;">'+
					'<input type="button" class="btn btn-danger btn-xs" value="Eliminar todo este detalle" onclick="removerPanel('+idTab+');" style="margin: 2px;margin-left: 0px;">'+
				'</div>'+
				'<div class="col-md-12 col-sm-12 col-xs-12">'+
					'<h5>'+replaceAll(replaceAll(nombreTab, '<', '&lt;'), '>', '&gt;')+'</h5>'+
				'</div>'+
			'</div>'+
			'<hr style="margin-bottom: 4px;margin-top: 0px;">'+
			'<div class="row">'+
				'<div class="col-md-8 col-sm-8 col-xs-8">'+
					'<labe>Descripción</label>'+
		   			'<input type="text" id="txtDescripcionDetalleGasto'+idTab+'" name="txtDescripcionDetalleGasto'+idTab+'" class="form-control" autocomplete="off">'+
				'</div>'+
				'<div class="col-md-4 col-sm-4 col-xs-4">'+
					'<labe>Undidad</label>'+
			   		'<select id="selectIdUnidad'+idTab+'" name="selectIdUnidad'+idTab+'" class="form-control">'+
						tempUnidadMedida+
					'</select>'+
				'</div>'+
			'</div>'+
			'<div class="row">'+
				'<div class="col-md-4 col-sm-4 col-xs-4">'+
					'<labe>Cantidad</label>'+
		   			'<input type="text" id="txtCantidadDetalleGasto'+idTab+'" name="txtCantidadDetalleGasto'+idTab+'" class="form-control" autocomplete="off" onkeyup="calcularSubTotalDetalleGasto('+idTab+');">'+
				'</div>'+
				'<div class="col-md-4 col-sm-4 col-xs-4">'+
					'<labe>Costo U.</label>'+
		   			'<input type="text" id="txtCostoUnitarioDetalleGasto'+idTab+'" name="txtCostoUnitarioDetalleGasto'+idTab+'" class="form-control" autocomplete="off" onkeyup="calcularSubTotalDetalleGasto('+idTab+');">'+
				'</div>'+
				'<div class="col-md-4 col-sm-4 col-xs-4">'+
					'<labe>Total</label>'+
		   			'<input type="text" id="txtSubTotalDetalleGasto'+idTab+'" name="txtSubTotalDetalleGasto'+idTab+'" class="form-control" autocomplete="off" readonly="readonly">'+
				'</div>'+
			'</div>'+
			'<div class="row" style="margin-top: 7px">'+
				'<div class="col-md-12 col-sm-12 col-xs-12">'+
					'<input type="button" class="btn btn-success form-control" value="Agregar" onclick="agregarDetalleGasto('+idTab+');">'+
				'</div>'+
			'</div>'+
			'<hr>'+
			'<table id="tableDetalleGasto'+idTab+'" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">'+
				'<thead>'+
					'<tr>'+
						'<th>Descripción</th>'+
						'<th>Unidad</th>'+
						'<th>C.</th>'+
						'<th>C. U.</th>'+
						'<th>Total</th>'+
						'<th></th>'+
					'</tr>'+
				'</thead>'+
				'<tbody></tbody>'+
			'</table>'+
		'</div>';

		$('#DetallePresupestoFormulacion > #AreaContenidoDetallePF > #contePestanaDetallePF ').append(htmlTempContenido);

		$('[id*="tabPaneDetalleGasto"]').removeClass('active');
		$('[id*="pestaniaTabPaneDetalleGasto"]').removeClass('active');
		$('[id*="pestaniaTabPaneDetalleGasto"] > a').attr({ 'aria-expanded' : 'false' });

		$('#tabPaneDetalleGasto'+idTab).addClass('active');
		$('#pestaniaTabPaneDetalleGasto'+idTab).addClass('active');
		$('#pestaniaTabPaneDetalleGasto'+idTab+' > a').attr({ 'aria-expanded' : 'true' });

		$('#tabPaneDetalleGasto'+idTab).formValidation(
		{
			framework : 'bootstrap',
			excluded : [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live : 'enabled',
			message : '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger : null,
			fields :
			{

			}
		});

		$('#tabPaneDetalleGasto'+idTab)
			.formValidation('addField', 'txtDescripcionDetalleGasto'+idTab, txtDescripcionDetalleGastoValidators)
			.formValidation('addField', 'selectIdUnidad'+idTab, selectIdUnidadValidators)
			.formValidation('addField', 'txtCantidadDetalleGasto'+idTab, txtCantidadDetalleGastoValidators)
			.formValidation('addField', 'txtCostoUnitarioDetalleGasto'+idTab, txtCostoUnitarioDetalleGastoValidators);
	});

	function removerPanel(idTab)
	{
		if(confirm('¿Realmente desea eliminar todo el detalle?'))
		{
			$('#pestaniaTabPaneDetalleGasto'+idTab).remove();
			$('#tabPaneDetalleGasto'+idTab).remove();

			$($('[id*="tabPaneDetalleGasto"]')[0]).addClass('active');
			$($('[id*="pestaniaTabPaneDetalleGasto"]')[0]).addClass('active');
			$($('[id*="pestaniaTabPaneDetalleGasto"] > a')[0]).attr({ 'aria-expanded' : 'true' });
		}
	}

	function calcularSubTotalDetalleGasto(idTab)
	{
		var cantidadTemp=$('#txtCantidadDetalleGasto'+idTab).val();
		var costoUnitarioTemp=$('#txtCostoUnitarioDetalleGasto'+idTab).val();

		var temp=(cantidadTemp*costoUnitarioTemp).toFixed(2);

		$('#txtSubTotalDetalleGasto'+idTab).val(isNaN(temp) ? '' : temp);
	}

	function agregarDetalleGasto(idTab)
	{
		$('#tabPaneDetalleGasto'+idTab).data('formValidation').resetField($('#txtDescripcionDetalleGasto'+idTab));
		$('#tabPaneDetalleGasto'+idTab).data('formValidation').resetField($('#selectIdUnidad'+idTab));
		$('#tabPaneDetalleGasto'+idTab).data('formValidation').resetField($('#txtCantidadDetalleGasto'+idTab));
		$('#tabPaneDetalleGasto'+idTab).data('formValidation').resetField($('#txtCostoUnitarioDetalleGasto'+idTab));

		$('#tabPaneDetalleGasto'+idTab).data('formValidation').validate();

		if(!($('#tabPaneDetalleGasto'+idTab).data('formValidation').isValid()))
		{
			return;
		}

		var continuar=true;

		$('#tableDetalleGasto'+idTab+' > tbody').find('tr').each(function(index, element)
		{
			if(replaceAll($($(element).find('td')[0]).text(), ' ', '')==replaceAll($('#txtDescripcionDetalleGasto'+idTab).val(), ' ', ''))
			{
				swal(
				{
					title: '',
					text: 'No pueden agregarse dos detalles de gasto en el mismo tipo.',
					type: 'error'
				},
				function()
				{

				});

				continuar=false;

				return false;
			}
		});

		if(!continuar)
		{
			return false;
		}

		var posicionTemporal=$('#selectIdUnidad'+idTab).val().indexOf(',');
		var idUnidadMedidaTemporal=$('#selectIdUnidad'+idTab).val().substring(0, posicionTemporal);
		var nombreUnidadMedidaTemporal=replaceAll(replaceAll($('#selectIdUnidad'+idTab).val().substring(posicionTemporal+1, $('#selectIdUnidad'+idTab).val().length), '<', '&lt;'), '>', '&gt;');

		var htmlTempDetalle='<tr>'+
			'<td><input type="hidden" name="descripcionDetalleGasto'+idTab+'[]" value="'+replaceAll(replaceAll($('#txtDescripcionDetalleGasto'+idTab).val(), '<', '&lt;'), '>', '&gt;')+'">'+replaceAll(replaceAll($('#txtDescripcionDetalleGasto'+idTab).val(), '<', '&lt;'), '>', '&gt;')+'</td>'+
			'<td><input type="hidden" name="idUnidadMedida'+idTab+'[]" value="'+idUnidadMedidaTemporal+'">'+replaceAll(replaceAll(nombreUnidadMedidaTemporal, '<', '&lt;'), '>', '&gt;')+'</td>'+
			'<td><input type="hidden" name="cantidadDetalleGasto'+idTab+'[]" value="'+$('#txtCantidadDetalleGasto'+idTab).val()+'">'+$('#txtCantidadDetalleGasto'+idTab).val()+'</td>'+
			'<td><input type="hidden" name="costoUnitarioDetalleGasto'+idTab+'[]" value="'+$('#txtCostoUnitarioDetalleGasto'+idTab).val()+'">'+$('#txtCostoUnitarioDetalleGasto'+idTab).val()+'</td>'+
			'<td><input type="hidden" name="subTotalDetalleGasto'+idTab+'[]" value="'+$('#txtSubTotalDetalleGasto'+idTab).val()+'">'+$('#txtSubTotalDetalleGasto'+idTab).val()+'</td>'+
			'<td><a href="#" onclick="$(this).parent().parent().remove();" style="color: red;font-weight: bold;text-decoration: underline;">Eliminar</a></td>'+
		'</tr>';

		$('#tableDetalleGasto'+idTab+' > tbody').append(htmlTempDetalle);

		limpiarText('tabPaneDetalleGasto'+idTab, []);
	}

	var txtDescripcionDetalleGastoValidators=
	{
		validators :
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Descripción" es requerido.</b>'
			}
		}
	};

	var selectIdUnidadValidators=
	{
		validators:
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Unidad" es requerido.</b>'
			}
		}
	};

	var txtCantidadDetalleGastoValidators=
	{
		validators:
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Cantidad" es requerido.</b>'
			},
			regexp:
			{
				regexp: /^\d*$/,
				message: '<b style="color: red;">El campo "Cantidad" debe ser un número entero.</b>'
			}
		}
	};

	var txtCostoUnitarioDetalleGastoValidators=
	{
		validators:
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Consto U." es requerido.</b>'
			},
			regexp:
			{
				regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
				message: '<b style="color: red;">El campo "Costo U." debe ser un valor en soles.</b>'
			}
		}
	};

	$(function()
	{
		$('#form-addDetallePresupuesto').formValidation(
		{
			framework : 'bootstrap',
			excluded : [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live : 'enabled',
			message : '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger : null,
			fields :
			{
				txtPorcentajeImprevistos :
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "% general de imprevistos" es requerido.</b>'
						},
						regexp:
	                    {
	                        regexp: /^\d*$/,
	                        message: '<b style="color: red;">El campo "% general de imprevistos" debe ser un número entero.</b>'
	                    }
					}
				},
			}
		});

		$('#divTipoGasto').formValidation(
		{
			framework : 'bootstrap',
			excluded : [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live : 'enabled',
			message : '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger : null,
			fields :
			{
				cbxTipoGasto :
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Tipo de Gasto" es requerido.</b>'
						}
					}
				}
			}
		});

		<?php foreach($listaFEDetallePresupuesto as $key => $value){ ?>
			<?php if($key==0){ ?>
				$('[id*="tabPaneDetalleGasto"]').removeClass('active');
				$('[id*="pestaniaTabPaneDetalleGasto"]').removeClass('active');
				$('[id*="pestaniaTabPaneDetalleGasto"] > a').attr({ 'aria-expanded' : 'false' });

				$('#tabPaneDetalleGasto<?=$value->id_tipo_gasto?>').addClass('active');
				$('#pestaniaTabPaneDetalleGasto<?=$value->id_tipo_gasto?>').addClass('active');
				$('#pestaniaTabPaneDetalleGasto<?=$value->id_tipo_gasto?>'+' > a').attr({ 'aria-expanded' : 'true' });
			<?php } ?>

			$('#tabPaneDetalleGasto<?=$value->id_tipo_gasto?>').formValidation(
			{
				framework : 'bootstrap',
				excluded : [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
				live : 'enabled',
				message : '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
				trigger : null,
				fields :
				{

				}
			});

			$('#tabPaneDetalleGasto<?=$value->id_tipo_gasto?>')
				.formValidation('addField', 'txtDescripcionDetalleGasto<?=$value->id_tipo_gasto?>', txtDescripcionDetalleGastoValidators)
				.formValidation('addField', 'selectIdUnidad<?=$value->id_tipo_gasto?>', selectIdUnidadValidators)
				.formValidation('addField', 'txtCantidadDetalleGasto<?=$value->id_tipo_gasto?>', txtCantidadDetalleGastoValidators)
				.formValidation('addField', 'txtCostoUnitarioDetalleGasto<?=$value->id_tipo_gasto?>', txtCostoUnitarioDetalleGastoValidators);
		<?php } ?>
	});

	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		$('#form-addDetallePresupuesto').data('formValidation').validate();

		if(!($('#form-addDetallePresupuesto').data('formValidation').isValid()))
		{
			return;
		}

		paginaAjaxJSON($('#form-addDetallePresupuesto').serialize(), '<?=base_url();?>index.php/FE_Detalle_Presupuesto/insertar', 'POST', null, function(objectJSON)
		{
			$('#modalTemp').modal('hide');

			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function()
			{
				window.location.href='<?=base_url();?>index.php/FE_Presupuesto_Inv/index?id_est_inv='+objectJSON.idEstudioInversion;

				renderLoading();
			});
		}, false, true);
	});
</script>
