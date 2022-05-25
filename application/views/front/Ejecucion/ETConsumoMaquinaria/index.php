
<form  id="frmAgregarConsumo">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_content">		
				<div class="row">
					<input type="hidden" name="hdIdMaquinaria" id="hdIdMaquinaria" autocomplete="off" value="<?=$idMaquinaria?>" readonly="readonly" >
				</div>	
				<div id="divAgregarConsumo">		
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-12">
							<label class="control-label">Fecha: </label>
							<div>
								<input class="form-control" name="txtFecha" id="txtFecha" type="date" max="2050-12-31" value="<?=date('Y-m-d')?>">	
							</div>	
						</div>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<label class="control-label">Tipo de Consumo: </label>
							<div>
								<select class="form-control" name="selectTipoConsumo" id="selectTipoConsumo">
									<option value="">Seleccione una opción</option>
									<option value="Combustible">Combustible</option>
									<option value="Lubricante">Lubricante</option>
									<option value="Repuesto">Repuesto</option>
									<option value="Otros">Otros</option>
								</select>	
							</div>	
						</div>
						<div class="col-md-6 col-sm-4 col-xs-12">
							<label class="control-label">Descripción: </label>
							<div>
								<input class="form-control" name="txtDescripcion" id="txtDescripcion" type="text">	
							</div>	
						</div>
									
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Unidad de Medida: </label>
							<div class="form-group">
								<select  name="selectUnidadMedida" id="selectUnidadMedida" class="selectpicker form-control" data-live-search="true">
									<option value="">Seleccione una opción</option>
									<?php foreach ($listaUnidadMedida as $key => $value) { ?>
										<option value="<?=$value->id_unidad?>"><?=$value->descripcion?> (<?=$value->abreviatura?>)</option>
									<?php }  ?>								
								</select>
							</div>	
						</div>	
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Cantidad: </label>
							<div>
								<input class="form-control" name="txtCantidad" id="txtCantidad" type="text">	
							</div>	
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Precio Unitario: </label>
							<div>
								<input class="form-control" name="txtPrecioUnitario" id="txtPrecioUnitario" type="text">	
							</div>	
						</div>						
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">.</label>
							<div>
								<input type="button" value="Guardar" style="width:100%;" class="btn btn-success" onclick="GuardarConsumo();">
							</div>
						</div>					
					</div>
					
				</div>
			</div>				
		</div>
	</div>
</form>
<br>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12" >
		<div class="table-responsive">
			<table id="tableListaConsumo" style="text-align: left;" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="width: 5%">Fecha</th>
						<th style="width: 5%">Tipo</th>
						<th style="width: 5%">Descripcion</th>
						<th style="width: 30%">Unidad de Medida</th>
						<th style="width: 30%">Cantidad</th>
						<th style="width: 30%">Precio Unitario</th>
						<th style="width: 30%">Parcial</th>
						<th style="width: 3%">Opciones</th>						
					</tr>
				</thead>
				<tbody>
				<?php foreach ($listaConsumoMaquinaria as $key => $value) {?>
					<tr>
						<td><?=date('d/m/Y',strtotime($value->fecha))?></td>
						<td><?=$value->tipo_consumo?></td>
						<td><?=$value->descripcion?></td>
						<td><?=$value->unidad_medida?> (<?=$value->abreviatura?>)</td>
						<td><?=$value->cantidad?></td>
						<td><?=number_format($value->precio_unitario, 2, '.', ',') ?></td>
						<td><?=number_format($value->precio_parcial, 2, '.', ',') ?></td>
						<td>
							<a onclick="eliminarConsumoMaquinaria('<?=$value->id_maquinaria?>',this);" role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Registro"><i class="fa fa-trash-o"></i></a>								
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
		<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
	</div>	
</div>
<script>
	$('.selectpicker').selectpicker({
	});

	$(document).ready(function()
	{
		$('#tableListaConsumo').DataTable(
		{
			"language":idioma_espanol
		});
	});

	$(function()
	{
		$('#divAgregarConsumo').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtFecha:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha" es requerido.</b>'
						}
					}
				},
				selectTipoConsumo:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Tipo de Consumo" es requerido.</b>'
						}
					}
				},
				txtDescripcion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripcion" es requerido.</b>'
						}
					}
				},
				selectUnidadMedida:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Unidad de Medida" es requerido.</b>'
						}
					}
				},
				txtCantidad:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Cantidad" es requerido.</b>'
						},
						regexp:
	                    {
	                        regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
	                        message: '<b style="color: red;">El campo "Cantidad" debe ser un número.</b>'
	                    }
					}
				},
				txtPrecioUnitario:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Precio unitario" es requerido.</b>'
						},
						regexp:
	                    {
	                        regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
	                        message: '<b style="color: red;">El campo "Precio unitario" debe ser en soles.</b>'
	                    }
					}
				}
			}
		});
	})

	function GuardarConsumo()
	{
		$('#divAgregarConsumo ').data('formValidation').validate();

		if(!($('#divAgregarConsumo').data('formValidation').isValid()))
		{
			return;
		}

		var formData=new FormData($('#frmAgregarConsumo')[0]);

		$.ajax({
			type:"POST",
			url: base_url+'index.php/ET_Consumo_Maquinaria/insertar',
			data: formData,
			cache: false,
			contentType:false,
			processData:false,
			beforeSend: function() 
			{
				renderLoading();
			},
			success:function(resp)
			{
				objectJson=JSON.parse(resp);

				$('#divModalCargaAjax').hide();
				
				swal(objectJson.proceso, objectJson.mensaje, (objectJson.proceso=='Correcto' ? "success" : "error"));

				$('#modalTemp').modal('hide');
			},
			error:function()
			{
				$('#divModalCargaAjax').hide();

				swal("Error","Ha ocurrido un error inesperado", "error");			
			}
		});  
	}

	function eliminarConsumoMaquinaria(idConsumo, element)
	{
		swal({
            title: "¿Realmente desea proseguir con la operación?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CERRAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
		{
            paginaAjaxJSON({ "idConsumo" : idConsumo }, base_url+'index.php/ET_Consumo_Maquinaria/eliminar', 'POST', null, function(objectJSON)
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
			}, false, true);
        });

	}

</script>

