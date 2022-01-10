
<form  id="frmAsignarOrden"   action="<?php echo base_url();?>index.php/Expediente_Tecnico/insertar" method="POST">
	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Partida</label>
							<div>
								<input class="form-control" name="hdIdPartida" id="hdIdPartida" readonly="readonly" type="hidden" value="<?= $partida->id_partida?>"> 	
								<input class="form-control" placeholder="descripcion de Partida" autocomplete="off" readonly="readonly" value="<?= $partida->desc_partida?>">	
							</div>	
						</div>
					</div>	
					<br>
					<div class="row">
						<div class="col-md-3">
							<label class="control-label">Ingrese Nro de Orden</label>
							<div>
								<button onclick="BuscarOrden('<?=$partida->codigo_unico_pi?>');" class="btn btn-primary">Buscar</button>
							</div>	
							
						</div>						
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-12 col-xs-12">
							<label class="control-label">Numero de Orden</label>
							<div>
								<input class="form-control" name="txtNumeroOrden" id="txtNumeroOrden" placeholder="Número de Orden "  autocomplete="off">	
							</div>	
						</div>
						<div class="col-md-9 col-sm-12 col-xs-12">
							<label class="control-label">Concepto</label>
							<div>
								<input class="form-control" name="txtConceptoOrden" id="txtConceptoOrden" placeholder="Concepto" autocomplete="off">	
							</div>	
						</div>
					</div>					
				</br>
				</div>
				
			</div>
		</div>
	</div>
	<div class="row" style="text-align: center;">
		<button  id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<table id="tableListaOrden" style="text-align: left;" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="width: 5%" class="col-md-1 col-xs-12">Número de Orden</th>
						<th style="width: 30%" class="col-md-2 col-xs-12">Concepto</th>						
					</tr>
				</thead>
				<tbody>
				<?php foreach($listaOrden as $item){ ?>
				  	<tr>				  		
						<td style="width: 5%" ><?= $item->nro_orden?></td>
						<td style="width: 30%"><?= $item->desc_det_seg_orden?></td>	
						<!--<td>
				  			<a href="<?= site_url('Expediente_Tecnico/verdetalle/'.$item->id_pi);?>" role="button" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> <?= $item->codigo_unico_pi?></a>				  				
				  		</td>-->									
				  	</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>

	$(document).ready(function()
	{
		$('#tableListaOrden').DataTable(
		{
			"language":idioma_espanol
		});

	});

	function BuscarOrden(codigoUnico)
	{
		swal({
		title: "Buscar",
		text: "Ingrese Número de Orden",
		type: "input",
		showCancelButton: true,
		cancelButtonText:"CERRAR",
		closeOnConfirm: false,
		inputPlaceholder: "Ingrese Número de Orden"
		}, 
		function (inputValue) 
		{	
			if (inputValue === "")
			{
				swal.showInputError("Ingresar Número de Orden!");
				return false
			}
			else 
			{
				event.preventDefault();
				$.ajax({
					"url":base_url+"index.php/Expediente_Tecnico/registroBuscarMeta",
					type:"GET", 
					data:{inputValue:inputValue, txtCodigoUnico:codigoUnico},
					cache:false,
					success:function(resp)
					{
						var orden=eval(resp);
						if(orden.length==1)
						{
							swal("Correcto!", "Se Encontro la orden: " + inputValue, "success");
							$('#txtNumeroOrden').val(orden[0].NRO_ORDEN);
							$('#txtConceptoOrden').val(orden[0].CONCEPTO);
						}
						else
						{
							swal.showInputError("No se encontro ninguna Orden con ese número");
							return false
						}					
					}
				});
			}
		});
	}

	$(function()
	{
		$('#frmAsignarOrden').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtNumeroOrden:
				{
					validators:
					{
					
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Número de Orden" es requerido.</b>'
						},
						regexp:
						{
							regexp: /^[0-9]+$/,
							message: '<b style="color: red;">El campo "Número de Orden" debe ser un numero.</b>'
						}
					}
				},
				txtConceptoOrden:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Concepto" es requerido.</b>'
						}
					}
				}
			}
		});
	});

    $('#btnEnviarFormulario').on('click', function(event)
   	{
		event.preventDefault();
		$('#frmAsignarOrden').data('formValidation').resetField($('#txtNumeroOrden'));
		$('#frmAsignarOrden').data('formValidation').resetField($('#txtConceptoOrden'));
		$('#frmAsignarOrden').data('formValidation').validate();
		if(!($('#frmAsignarOrden').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmAsignarOrden")[0]);
		var dataString = $('#frmAsignarOrden').serialize();
		$.ajax({
			type:"POST",
			url:base_url+"index.php/Expediente_Tecnico/AsignarOrden",
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
				if (resp=='1') 
				{
					swal("Correcto","Se registró correctamente", "success");
				}
				if (resp=='2') 
				{
					swal("Error","Ocurrio un error ", "error");
				}
				window.location.href=base_url+"index.php/Expediente_Tecnico/ListarPartida/"+<?= $partida->id_et?>;
			}
		});
        $('#frmAsignarOrden')[0].reset();
    });
</script>






