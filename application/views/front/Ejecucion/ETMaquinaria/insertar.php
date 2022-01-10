<style>
	.row
	{
		margin-top: 4px;
	}
</style>
<form  id="frmGuardarMaquinaria" action="<?php echo base_url();?>index.php/ET_Maquinaria/<?=$accion?>" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content" id="validarMaquinaria">
					<input type="hidden" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico" value="<?=@$idExpedienteTecnico?>">
					<input type="hidden" name="hdIdMaquinaria" id="hdIdMaquinaria" value="<?=@$maquinaria[0]->id_maquinaria?>">				
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Maquinaria:</label>			
							<div>
								<input type="text" name="txtMaquinaria" id="txtMaquinaria" class="form-control" value="<?=@$maquinaria[0]->maquinaria?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<label class="control-label">Potencia:</label>
							<div>
								<input id="txtPotencia" name="txtPotencia" class="form-control" value="<?=@$maquinaria[0]->potencia?>"  placeholder="Potencia"  autocomplete="off">
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<label class="control-label">Capacidad:</label>
							<div>
								<input id="txtCapacidad" name="txtCapacidad" class="form-control" value="<?=@$maquinaria[0]->capacidad?>" placeholder="Capacidad"  autocomplete="off">
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<label class="control-label">Placa Nro Motor:</label>
							<div>
								<input id="txtPlaca" name="txtPlaca" class="form-control" value="<?=@$maquinaria[0]->nro_placa_motor?>" autocomplete="off">
							</div>
						</div>
					</div>			
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Proveedor:</label>
							<div>
								<input id="txtProveedor" name="txtProveedor" class="form-control" value="<?=@$maquinaria[0]->proveedor?>"  placeholder="Proveedor"  autocomplete="off">
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-4 col-sm-6 col-xs-12">
							<label class="control-label">Costo/Hora:</label>
							<div>
								<input id="txtCosto" name="txtCosto" class="form-control" value="<?=@$maquinaria[0]->costo_hora?>"  placeholder="Costo/Hora"  autocomplete="off">
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<label class="control-label">Tipo:</label>
							<div>
								<select name="selectTipo" id="selectTipo" class="form-control">
									<option value="">Seleccione..</option>
									<option value="Propia" <?=(@$maquinaria[0]->tipo=="Propia" ? "selected" : "")?>>Propia</option>
									<option value="Alquilada" <?=(@$maquinaria[0]->tipo=="Alquilada" ? "selected" : "")?>>Alquilada</option>
								</select>
							</div>
						</div>
					</div>
					<br>
					<div class="row" style="text-align: right;">
						<input type="button" value="Guardar" class="btn btn-success" onclick="guardarMaquinaria();">
						<button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>				
			</div>
		</div>
	</div>
</form>
<script>
	$(function()
	{
		$('#validarMaquinaria').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtMaquinaria:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Maquinaria" es requerido.</b>'
						}
					}
				},
				txtCosto:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Costo por Hora" es requerido.</b>'
						},
						regexp:
						{
							regexp: /^[0-9]+$/,
							message: '<b style="color: red;">El campo "Costo por Hora" debe ser un numero.</b>'
						}
					}
				},
				selectTipo:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Tipo" es requerido.</b>'
						}
					}
				},
				txtPlaca:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Placa" es requerido.</b>'
						}
					}
				}	
			}
		});
	})

	function guardarMaquinaria()
	{
		event.preventDefault();
        $('#validarMaquinaria').data('formValidation').validate();
		if(!($('#validarMaquinaria').data('formValidation').isValid()))
		{
			return;
		}
		$('#frmGuardarMaquinaria').submit();		
		renderLoading();
	}
</script>






