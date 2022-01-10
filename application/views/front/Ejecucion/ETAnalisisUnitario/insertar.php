<style>
	.panel-heading .accordion-toggle:after
	{
		font-family: 'Glyphicons Halflings';
		content: "\e114";
		float: right;
		color: grey;
	}

	.panel-heading .accordion-toggle.collapsed:after
	{
		content: "\e080";
	}
</style>
<div class="form-horizontal">
	<div id="divInsertarAnalisisUnitario" class="row">
		<div class="col-md-3 col-sm-3 col-xs-12">
			<label for="control-label">Recurso</label>
			<div>
				<input type="hidden" name="" value="<?=$idExpediente?>">
				<select name="selectRecurso" id="selectRecurso" class="form-control">
					<?php foreach($listaETRecurso as $value){ ?>
						<option value="<?=$value->id_recurso.','.html_escape($value->desc_recurso)?>"><?=html_escape($value->desc_recurso)?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-9 col-sm-9 col-xs-12">
			<label for="control-label">Presupuesto analíticos (Clasificador)</label>
			<div>
				<select name="selectPresupuestoAnalitico" id="selectPresupuestoAnalitico" class="form-control">
					<option value="">Seleccione una Opción</option>
					<?php foreach($listaETPresupuestoAnalitico as $value){ ?>
						<option value="<?=$value->id_analitico?>,<?=html_escape($value->desc_presupuesto_ej)?>"><?=html_escape($value->desc_presupuesto_ej)?> <?=html_escape($value->num_clasificador)?> : <?=html_escape($value->desc_clasificador)?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div id="divPresupuestoParaEjecucion" class="row">
		<div class="col-md-8 col-sm-8 col-xs-12">
			<label for="control-label">Presupuesto para ejecución</label>
			<div>
				<input type="hidden" value="<?=$idPresupuesto?>" id="idPresupuestoEjecucion"name="idPresupuestoEjecucion"  readonly="readonly">
				<input type="text" id="txtPresupuestoEjecucion" class="form-control" readonly="readonly">
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<label for="control-label">.</label>
			<div>
				<input type="button" class="btn btn-info" value="Agregar recurso para A.U." style="width: 100%;" onclick="registrarAnalisisUnitario();">
			</div>
		</div>
	</div>
	<hr style="margin: 4px;">
	<div id="divListaAnalisisUnitario">
		<?php 
		$sumatoriaPrecioUnitario=0;
		foreach($listaETAnalisisUnitario as $value){ ?>
		<div class="panel-group" style="margin: 2px;">
			<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" href="#collapse<?=$value->id_analisis?>" style="cursor: pointer; background-color: #cacbe0; color: black; ">
					<h4 class="panel-title">
						<a class="accordion-toggle"><?=html_escape($value->desc_recurso)?></a>
					</h4>
				</div>
				<div id="collapse<?=$value->id_analisis?>" class="panel-collapse collapse in">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" style="padding:10px 30px;">
							<div id="divFormDetallaAnalisisUnitario<?=$value->id_analisis?>">
								<div class="row">
									<div class="col-md-12 col-sm-112 col-xs-12">
										<label for="control-label">Presupuesto analítico (Clasificador | Presupuesto ejecución)</label>
									</div>										
								</div>
								<div class="row">
									<div class="col-md-8 col-sm-8 col-xs-12">
										<div>
											<select name="selectPresupuestoAnalitico<?=$value->id_analisis?>" id="selectPresupuestoAnalitico<?=$value->id_analisis?>" class="form-control selectPresupuestoAnaliticoAux">
												<option></option>
												<?php foreach($listaETPresupuestoAnalitico as $item){ ?>
													<option value="<?=$item->id_analitico?>" <?=($item->id_analitico==$value->id_analitico ? 'selected' : '')?>><?=html_escape($item->desc_clasificador.' | '.$item->desc_presupuesto_ej)?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<button  id="btnEnviarFormulario" class="btn btn-primary btn-sm" onclick="guardarPresupuestoAnaliticoParaAnalisisUnitario(<?=$value->id_analisis?>);"> <span class="fa fa-save"></span> Guardar</button>
										<button  class="btn btn-danger btn-sm" onclick="eliminarAnalisisUnitario(<?=$value->id_analisis?>, this);"><span class="fa fa-trash-o"></span> Eliminar A.U.</button>																		
									</div>
								</div>
								<hr style="margin: 2px;">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<button  class="btn btn-success btn-sm" onclick=" paginaAjaxDialogo('otherModal2', 'Análisis Unitario',{ id_Et:<?=$idExpediente?>,id_AnalisisUnitario: <?=$value->id_analisis?>}, base_url+'index.php/ET_Detalle_Analisis_Unitario/insertar', 'GET', null, null, false, true);" > <span class="fa fa-plus"></span> Registrar A.U.</button>
									</div>										
								</div>
							</div>
							<div class="table-responsive">
								<table id="tableDetalleAnalisisUnitario<?=$value->id_analisis?>" class="table table-bordered">
									<thead>
										<tr>
											<th></th>
											<th>Descripción</th>
											<th>Cuadrilla</th>
											<th>Und.</th>
											<th>Cant.</th>
											<th>Precio U.</th>
											<th>Sub total</th>											
										</tr>
									</thead>
									<tbody>
										<?php foreach($value->childETDetalleAnalisisUnitario as $item)
										{ 
											$sumatoriaPrecioUnitario+=$item->precio_parcial;
											?>
											<tr>
												<td style="width:5%;">
													<a href="#" style="color: red;text-decoration: underline;" onclick="eliminarDetalleAnalisisUnitario(<?=$item->id_detalle_analisis_u?>, this);"><b>Eliminar</b></a>
												</td>
												<td style="width:40%;"><?=html_escape($item->desc_detalle_analisis)?></td>
												<td style="width:10%;"><?=html_escape($item->cuadrilla)?></td>
												<td style="width:15%;"><?=html_escape($item->descripcion)?></td>
												<td style="width:10%;"><?=number_format($item->cantidad, 4)?></td>
												<td style="width:10%;"><?=number_format($item->precio_unitario, 2)?></td>
												<td style="width:10%;" class="subTotalDetalleAnalisisUnitario"><?=number_format($item->precio_parcial, 2)?></td>												
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>		
				</div>
			</div>
			<br>
		</div>
		<?php } ?>
		<div style="height:50px; background-color:#edf2f5; padding:10px 30px; color:black;">
			<table id="tableDetalleAnalisisUnitario" class="table table-bordered" style="width:100%;" border="0">
				<thead>
					<tr>
						<td colspan="6">PRECIO UNITARIO (S/.)</td>
						<td style="width:10%;"><?=number_format($sumatoriaPrecioUnitario, 2)?></td>											
					</tr>
				</thead>
			</table>
		</div>
	</div>
	<hr style="margin-top: 4px;">
	<div class="row" style="text-align: right;">
		<input type="hidden" id="hdIdPartidaEnAnalisisPresupuestal" value="<?=$idPartida?>">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>
</div>
<script>
	var descripcionInsumoValidators=
	{
		validators : 
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Descripción del insumo" es requerido.</b>'
			}
		}
	};

	var cuadrillaValidators=
	{
		validators : 
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Cuadrilla" es requerido.</b>'
			},
			regexp:
            {
                regexp: /^\d*$/,
                message: '<b style="color: red;">El campo "Cuadrilla" debe ser un número entero.</b>'
            }
		}
	};

	var horaValidators=
	{
		validators : 
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Hora" es requerido.</b>'
			},
			regexp:
            {
                regexp: /^\d*$/,
                message: '<b style="color: red;">El campo "Hora" debe ser un número entero.</b>'
            }
		}
	};

	var unidadValidators=
	{
		validators : 
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Unidad" es requerido.</b>'
			}
		}
	};

	var rendimientoValidators=
	{
		validators : 
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Rendimiento" es requerido.</b>'
			},
			regexp:
			{
				regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
				message: '<b style="color: red;">El campo "Rendimiento" debe ser un valor en decimales.</b>'
			}
		}
	};

	var cantidadValidators=
	{
		validators : 
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Cantidad" es requerido.</b>'
			},
			regexp:
			{
				regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
				message: '<b style="color: red;">El campo "Cantidad" debe ser un valor en decimales.</b>'
			}
		}
	};

	var precioUnitarioValidators=
	{
		validators : 
		{
			notEmpty:
			{
				message: '<b style="color: red;">El campo "Precio unitario" es requerido.</b>'
			},
			regexp:
			{
				regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
				message: '<b style="color: red;">El campo "Precio unitario" debe ser un valor en soles.</b>'
			}
		}
	};

	$(function()
	{
		$('#selectRecurso').selectpicker({ liveSearch: true });
		$('#selectPresupuestoAnalitico').selectpicker({ liveSearch: true });

		$('#selectPresupuestoAnalitico').on('change', function()
	    {
			var selected=$(this).find("option:selected").val();

			if(selected.trim()!='')
			{
				$('#txtPresupuestoEjecucion').val(selected.substring(selected.indexOf(',')+1, selected.length));
			}
			else
			{
				$('#txtPresupuestoEjecucion').val(null);
			}
	    });

		$('[id*="selectDescripcionDetalleAnalisis"]').selectpicker({ liveSearch: true }).ajaxSelectPicker(
		{
	        ajax: {
	            url: base_url+'index.php/ET_Insumo/verPorDescripcion',
	            data: { valueSearch : '{{{q}}}' }
	        },
	        locale:
	        {
	            emptyTitle: 'Buscar insumo'
	        },
	        preprocessData: function(data)
	        {
	        	var dataForSelect=[];

	        	for(var i=0; i<data.length; i++)
	        	{
	        		dataForSelect.push(
	                {
	                    "value" : data[i].desc_insumo,
	                    "text" : data[i].desc_insum,
	                    "data" :
	                    {
	                    	"id-unidad" : data[i].id_unidad
	                    },
	                    "disabled" : false
	                });
	        	}

	            return dataForSelect;
	        },
	        preserveSelected: false
	    });

	    $('[id*="selectDescripcionDetalleAnalisis"]').on('change', function()
	    {
			var selected=$(this).find("option:selected").val();

			if(selected.trim()!='')
			{
				$('#selectUnidadMedida'+$(this).attr('id').substring(32)).val($(this).find("option:selected").data('id-unidad'));
			}
	    });

	    $('#divInsertarAnalisisUnitario').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectRecurso:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Recurso" es requerido.</b>'
						}
					}
				},
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

		<?php foreach($listaETAnalisisUnitario as $key => $value){ ?>
			$('#divFormDetallaAnalisisUnitario<?=$value->id_analisis?>').formValidation(
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

			$('#divFormDetallaAnalisisUnitario<?=$value->id_analisis?>')
				.formValidation('addField', 'selectDescripcionDetalleAnalisis<?=$value->id_analisis?>', descripcionInsumoValidators)
				.formValidation('addField', 'txtCuadrilla<?=$value->id_analisis?>', cuadrillaValidators)
				.formValidation('addField', 'txtHoras<?=$value->id_analisis?>', horaValidators)
				.formValidation('addField', 'selectUnidadMedida<?=$value->id_analisis?>', unidadValidators)
				.formValidation('addField', 'txtRendimiento<?=$value->id_analisis?>', rendimientoValidators)
				.formValidation('addField', 'txtCantidad<?=$value->id_analisis?>', cantidadValidators)
				.formValidation('addField', 'txtPrecioUnitario<?=$value->id_analisis?>', precioUnitarioValidators);
		<?php } ?>
	});

	function calcularCantidad(idAnalisisUnitario)
	{
		var cuadrilla=$('#txtCuadrilla'+idAnalisisUnitario).val();
		var horas=$('#txtHoras'+idAnalisisUnitario).val();
		var rendimiento=$('#txtRendimiento'+idAnalisisUnitario).val();
		var cantidad=null;

		if(!isNaN(cuadrilla) && cuadrilla.trim()!='' && !isNaN(horas) && horas.trim()!='' && !isNaN(rendimiento) && rendimiento.trim()!='')
		{
			cantidad=parseFloat(cuadrilla)/(parseFloat(horas)*parseFloat(rendimiento));

			$('#txtCantidad'+idAnalisisUnitario).val(cantidad);
		}
		else
		{
			$('#txtCantidad'+idAnalisisUnitario).val('');
		}
	}

	function calcularRendimiento(idAnalisisUnitario)
	{
		var cuadrilla=$('#txtCuadrilla'+idAnalisisUnitario).val();
		var cantidad=$('#txtCantidad'+idAnalisisUnitario).val();
		var horas=$('#txtHoras'+idAnalisisUnitario).val();
		var rendimiento=null;

		if(!isNaN(cuadrilla) && cuadrilla.trim()!='' && !isNaN(cantidad) && cantidad.trim()!='' && !isNaN(horas) && horas.trim()!='')
		{
			rendimiento=parseFloat(cuadrilla)/(parseFloat(cantidad))/(parseFloat(horas));

			$('#txtRendimiento'+idAnalisisUnitario).val(rendimiento);
		}
		else
		{
			$('#txtRendimiento'+idAnalisisUnitario).val('');
		}
	}

	function calcularSubTotal(idAnalisisUnitario)
	{
		var cantidad=$('#txtCantidad'+idAnalisisUnitario).val();
		var precioUnitario=$('#txtPrecioUnitario'+idAnalisisUnitario).val();
		var subTotal=null;

		if(!isNaN(cantidad) && cantidad.trim()!='' && !isNaN(precioUnitario) && precioUnitario.trim()!='')
		{
			subTotal=cantidad*precioUnitario;

			$('#txtSubTotal'+idAnalisisUnitario).val(subTotal.toFixed(2));
		}
		else
		{
			$('#txtSubTotal'+idAnalisisUnitario).val('');
		}
	}

	function registrarAnalisisUnitario()
	{
		$('#divInsertarAnalisisUnitario').data('formValidation').resetField($('#selectRecurso'));

		$('#divInsertarAnalisisUnitario').data('formValidation').validate();

		if(!($('#divInsertarAnalisisUnitario').data('formValidation').isValid()))
		{
			return;
		}
		
		var idPresupuestoEjecucion=$('#idPresupuestoEjecucion').val();
		var recurso=$('#selectRecurso').val();
		var idRecurso=recurso.substring(0, recurso.indexOf(','));
		var descripcionRecurso=recurso.substring(recurso.indexOf(',')+1, recurso.length);
		var idAnalitico=$('#selectPresupuestoAnalitico').val().substring(0, $('#selectPresupuestoAnalitico').val().indexOf(','));

		var existeComponente=false;

		$('#divListaAnalisisUnitario').find('> .panel-group > .panel-default > .panel-heading > h4 > a').each(function(index, element)
		{
			if(replaceAll(descripcionRecurso, ' ', '')==replaceAll($(element).text(), ' ', ''))
			{
				existeComponente=true;

				return false;
			}
		});

		if(existeComponente)
		{
			swal(
			{
				title: '',
				text: 'No se puede agregar dos veces el mismo detalle de análisis.',
				type: 'error'
			},
			function(){});

			return;
		}

		paginaAjaxJSON({ "idAnalitico" : idAnalitico,"idET" : <?=$idExpediente?> , "idRecurso" : idRecurso, "idDetallePartida" : <?=$etDetallePartida->id_detalle_partida?>, "idPresupuestoEjecucion" : idPresupuestoEjecucion  }, base_url+'index.php/ET_Analisis_Unitario/insertar', 'POST', null, function(objectJSON)
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

			if(objectJSON.partidaCompleta)
			{
				$('#rowPartida'+$('#hdIdPartidaEnAnalisisPresupuestal').val()).css({ "color" : "blue" });
			}
			else
			{
				$('#rowPartida'+$('#hdIdPartidaEnAnalisisPresupuestal').val()).css({ "color" : "red" });
			}

			var htmlTemp='<div class="panel-group" style="margin: 2px;">'+
				'<div class="panel panel-default">'+
					'<div class="panel-heading" data-toggle="collapse" href="#collapse'+objectJSON.idAnalisis+'" style="cursor: pointer; background-color: #cacbe0; color: black;">'+
						'<h4 class="panel-title">'+
							'<a class="accordion-toggle">'+replaceAll(replaceAll(descripcionRecurso, '<', '&lt;'), '>', '&gt;')+'</a>'+
						'</h4>'+
					'</div>'+
					'<div id="collapse'+objectJSON.idAnalisis+'" class="panel-collapse collapse in">'+
						'<div class="row">'+
							'<div class="col-md-12 col-sm-12 col-xs-12" style="padding:10px 30px;">'+
								'<div id="divFormDetallaAnalisisUnitario'+objectJSON.idAnalisis+'">'+
									'<div class="row">'+
										'<div class="col-md-12 col-sm-12 col-xs-12">'+
											'<label for="control-label">Presupuesto analítico (Clasificador | Presupuesto ejecución)</label>'+
										'</div>'+
									'</div>'+
									'<div class="row">'+
										'<div class="col-md-8 col-sm-8 col-xs-12">'+
											'<div>'+
												'<select name="selectPresupuestoAnalitico'+objectJSON.idAnalisis+'" id="selectPresupuestoAnalitico'+objectJSON.idAnalisis+'" class="form-control">'+
													'<option></option>';

													<?php foreach($listaETPresupuestoAnalitico as $item){ ?>
														htmlTemp+='<option value="<?=$item->id_analitico?>"><?=html_escape($item->desc_clasificador.' | '.$item->desc_presupuesto_ej)?></option>';
													<?php } ?>

												htmlTemp+='</select>'+
											'</div>'+
										'</div>'+
										'<div class="col-md-4 col-sm-4 col-xs-12">'+
											'<button class="btn btn-primary btn-sm" onclick="guardarPresupuestoAnaliticoParaAnalisisUnitario('+objectJSON.idAnalisis+');"> <span class="fa fa-save"></span> Guardar</button>'+
											'<button  class="btn btn-danger btn-sm" onclick="eliminarAnalisisUnitario('+objectJSON.idAnalisis+', this);"><span class="fa fa-trash-o"></span> Eliminar A.U. </button>'+											
										'</div>'+
									'</div>'+
									'<hr style="margin: 2px;">'+
									'<div class="row">'+
										'<div class="col-md-12 col-sm-12 col-xs-12">'+
											'<button  class="btn btn-success btn-sm" onclick=" paginaAjaxDialogo(\'otherModal2\', \'Análisis Unitario\',{id_Et : '+objectJSON.id_Et+', id_AnalisisUnitario: '+objectJSON.idAnalisis+' }, base_url+\'index.php/ET_Detalle_Analisis_Unitario/insertar\', \'GET\', null, null, false, true);" > <span class="fa fa-plus"></span> Registrar A.U.</button>'
										'</div>'+
									'</div>'+
								'</div>'+
								'<div class="table-responsive">'+
									'<table id="tableDetalleAnalisisUnitario'+objectJSON.idAnalisis+'" class="table table-bordered">'+
										'<thead>'+
											'<tr>'+
												'<th>Descripción</th>'+
												'<th>Cuadrilla</th>'+
												'<th>Und.</th>'+
												'<th>Rendimiento</th>'+
												'<th>Cant.</th>'+
												'<th>Precio U.</th>'+
												'<th>Sub total</th>'+
												'<th></th>'+
											'</tr>'+
										'</thead>'+
										'<tbody>'+
										'</tbody>'+
									'</table>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>';

			$('#divListaAnalisisUnitario').append(htmlTemp);

			$('#selectPresupuestoAnalitico'+objectJSON.idAnalisis).val(objectJSON.idAnalitico);

			$('#selectDescripcionDetalleAnalisis'+objectJSON.idAnalisis).selectpicker({ liveSearch: true }).ajaxSelectPicker(
			{
		        ajax: {
		            url: base_url+'index.php/ET_Insumo/verPorDescripcion',
		            data: { valueSearch : '{{{q}}}' }
		        },
		        locale:
		        {
		            emptyTitle: 'Buscar insumo'
		        },
		        preprocessData: function(data)
		        {
		        	var dataForSelect=[];

		        	for(var i=0; i<data.length; i++)
		        	{
		        		dataForSelect.push(
		                {
		                    "value" : data[i].desc_insumo,
		                    "text" : data[i].desc_insum,
		                    "data" :
		                    {
		                    	"id-unidad" : data[i].id_unidad
		                    },
		                    "disabled" : false
		                });
		        	}

		            return dataForSelect;
		        },
		        preserveSelected: false
		    });

		    $('#selectDescripcionDetalleAnalisis'+objectJSON.idAnalisis).on('change', function()
		    {
				var selected=$(this).find("option:selected").val();

				if(selected.trim()!='')
				{
					$('#selectUnidadMedida'+$(this).attr('id').substring(32)).val($(this).find("option:selected").data('id-unidad'));
				}
		    });

			$('#divFormDetallaAnalisisUnitario'+objectJSON.idAnalisis).formValidation(
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

			$('#divFormDetallaAnalisisUnitario'+objectJSON.idAnalisis)
				.formValidation('addField', 'selectDescripcionDetalleAnalisis'+objectJSON.idAnalisis, descripcionInsumoValidators)
				.formValidation('addField', 'txtCuadrilla'+objectJSON.idAnalisis, cuadrillaValidators)
				.formValidation('addField', 'txtHoras'+objectJSON.idAnalisis, horaValidators)
				.formValidation('addField', 'selectUnidadMedida'+objectJSON.idAnalisis, unidadValidators)
				.formValidation('addField', 'txtRendimiento'+objectJSON.idAnalisis, rendimientoValidators)
				.formValidation('addField', 'txtCantidad'+objectJSON.idAnalisis, cantidadValidators)
				.formValidation('addField', 'txtPrecioUnitario'+objectJSON.idAnalisis, precioUnitarioValidators);
		}, false, true);
	}

	function renderizarNuevoMontoPartida()
	{
		var subTotalDetalleAnalisisUnitario=0;

		$('.subTotalDetalleAnalisisUnitario').each(function(index, element)
		{
			subTotalDetalleAnalisisUnitario+=parseFloat($(element).text());
		});

		$($('#rowPartida'+$('#hdIdPartidaEnAnalisisPresupuestal').val()).find('td')[4]).text('1.00');
		$($('#rowPartida'+$('#hdIdPartidaEnAnalisisPresupuestal').val()).find('td')[5]).text(parseFloat(subTotalDetalleAnalisisUnitario).toFixed(2));
	}

	function eliminarAnalisisUnitario(idAnalisis, element)
	{
		if(confirm('¿Realmente desea borrar todo este análisis unitario?'))
		{
			paginaAjaxJSON({ "idAnalisis" : idAnalisis, "idDetallePartida" : <?=$etDetallePartida->id_detalle_partida?> }, base_url+'index.php/ET_Analisis_Unitario/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				if(objectJSON.proceso=='Correcto')
				{
					if(objectJSON.partidaCompleta)
					{
						$('#rowPartida'+$('#hdIdPartidaEnAnalisisPresupuestal').val()).css({ "color" : "blue" });
					}
					else
					{
						$('#rowPartida'+$('#hdIdPartidaEnAnalisisPresupuestal').val()).css({ "color" : "red" });
					}
				}

				$(element).parent().parent().parent().parent().parent().parent().parent().parent().remove();

				//renderizarNuevoMontoPartida();
			}, false, true);
		}
	}

	function eliminarDetalleAnalisisUnitario(idDetalleAnalisisUnitario, element)
	{
		if(confirm('¿Realmente desea borrar el detalle del análisis unitario?'))
		{
			paginaAjaxJSON({ "idDetalleAnalisisUnitario" : idDetalleAnalisisUnitario, "idEt" : <?=$idExpediente?>  }, base_url+'index.php/ET_Detalle_Analisis_Unitario/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				$(element).parent().parent().remove();

				//renderizarNuevoMontoPartida();
			}, false, true);
		}
	}

	function guardarPresupuestoAnaliticoParaAnalisisUnitario(idAnalisis)
	{
		paginaAjaxJSON({ idAnalisis : idAnalisis, idAnalitico : $('#selectPresupuestoAnalitico'+idAnalisis).val(), 'idDetallePartida' : <?=$etDetallePartida->id_detalle_partida?> }, base_url+'index.php/ET_Analisis_Unitario/actualizarAnalitico', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
			},
			function(){});

			if(objectJSON.proceso=='Correcto')
			{
				if(objectJSON.partidaCompleta)
				{
					$('#rowPartida'+$('#hdIdPartidaEnAnalisisPresupuestal').val()).css({ "color" : "blue" });
				}
				else
				{
					$('#rowPartida'+$('#hdIdPartidaEnAnalisisPresupuestal').val()).css({ "color" : "red" });
				}
			}
		}, false, true);
	}
</script>