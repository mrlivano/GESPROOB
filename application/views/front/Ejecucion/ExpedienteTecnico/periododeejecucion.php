<style>
	.row
	{
		margin-top: 4px;
	}
	#table_plazoEjecucion th {
		background-color: #3f5367;
		color: white;
	}
</style>

<form class="form-horizontal" id="frmAgregarPeriodo" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<div>
					<select id="selectTipoPlazo" name="selectTipoPlazo" class="form-control">
						<option value="">Seleccionar..</option>
						<option value="Programado">Programado</option>
						<option value="Ampliacion">Ampliación</option>
					</select>
					</div>	
				</div>
			</div>
			<div class="row">
				<input type="hidden" name="hdIdEt" id="hdIdEt" value="<?=$id_et?>">	
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label class="control-label">Numero de Resolución (R.G. Nº):</label>
					<div>
						<input autocomplete="off" type="text" name="txtNumeroResolucion" id="txtNumeroResolucion" class="form-control">
					</div>	
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label class="control-label">Fecha de Resolución:</label>
					<div>
						<input type="date" name="txtFechaResolución" class="form-control" id="txtFechaResolución">
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label class="control-label">Adjuntar Resolución:</label>
                    <div>                                                  	
                    	<input type="file" id="fileResolucion" name="fileResolucion" notValidate class="form-control">
                    </div>					
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label class="control-label">Fecha de Inicio:</label>
					<div>
						<input type="date" class="form-control" name="txtFechaInicio" id="txtFechaInicio">
					</div>	
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label class="control-label">Fecha Fin:</label>
					<div>
						<input type="date" name="txtFechaFin" class="form-control" id="txtFechaFin">
					</div>	
					<p style="color: red; display: none;" id="Advertencia">La Fecha de Inicio no puede ser mayor a la Fecha de Fin</p>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label class="control-label">Numero de Meses:</label>
					<div>
						<input type="text" readonly="readonly" name="txtTotalMeses" id= "txtTotalMeses" class="form-control" value="0 meses"  >
					</div>	
				</div>				
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label class="control-label">.</label>
                    <div>                                                  	
                    	<button style="width:100%;" type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
                    </div>					
				</div>				
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12" style="height:250px;overflow:scroll;overflow-x: hidden;text-align: left; ">
			<div class="table-responsive">
			<table class="table table-bordered" id="table_plazoEjecucion">
				<thead>
					<tr>
						<th>FECHA DE RESOLUCIÓN DE APROBACIÓN</th>
						<th>R.G. Nº</th>						
						<th>RESOLUCIÓN</th>	
						<th>FECHA-INICIO</th>
						<th>FECHA-FIN</th>
						<th>NUM. MESES</th>											
					</tr>
				</thead>
				<tbody id="bodyPlazo">
					<?php foreach ($listaPlazoEjecucion as $key => $value) {?>
					<tr>
						<td><?=date('d/m/Y',strtotime($value->fecha_resolucion))?> (<?=$value->tipo?>)</td>						
						<td><?=$value->numero_resolucion?>  </td>
						<td>
							<?php if($value->resolucion!='') { ?>
							<a href='<?php echo base_url()."uploads/ResolucionAmpliacion/".$value->resolucion?>' target='_blank'><i class='fa fa-file fa-lg'></i></a>
							<?php } ?>
						</td>
						<td><?=date('d/m/Y',strtotime($value->fecha_inicio))?></td>
						<td><?=date('d/m/Y',strtotime($value->fecha_fin))?></td>
						<td><?=$value->num_meses?> Meses.</td>
					</tr>				
					<?php } ?>
				</tbody>
			</table>
			</div>		
		</div>
	</div>	
	<div class="row" style="text-align: right;">		
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>
<script>
	$(document).ready(function()
	{
	    $('input[type="date"]').change(function()
	    {
	    	var fecha1 = $('#txtFechaInicio').val();
	    	var fecha2 = $('#txtFechaFin').val();
	    	if((Date.parse(fecha1)) > (Date.parse(fecha2)))
	    	{
	    		$('#Advertencia').css('display','block');
	    		$('#txtTotalMeses').val("");
	    	}	
	    	else
	    	{
	    		$('#Advertencia').css('display','none');
	    		$.ajax(
				{
					url: base_url+"index.php/Expediente_Tecnico/CalcularNumeroMeses",
					type: 'POST',
					data:
					{
						txtFecha1: fecha1,
						txtFecha2: fecha2
					},
					cache: false,
					async: true
				}).done(function(objectJSON) 
				{
					objectJSON = JSON.parse(objectJSON);
					$('#txtTotalMeses').val(objectJSON.numerodemeses+" Meses");

				}).fail(function()
				{
					swal('Error', 'Error no controlado.', 'error');
				});
	    	}	    	  	
	    });
	});

	$(function()
	{
		$('#frmAgregarPeriodo').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtFechaInicio:
				{
					validators:
					{					
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha de Inicio" es requerido.</b>'
						}
					}
				},
				txtFechaFin:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha de Finalizacion" es requerido.</b>'
						}
					}
				},
				txtNumeroResolucion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Número de Resolución" es requerido.</b>'
						}
					}
				},
				txtFechaResolución:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha de Resolución" es requerido.</b>'
						}
					}
				},
				fileResolucion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El archivo de "Resolución de aprobación" es requerido.</b>'
						}
					}
				},
				selectTipoPlazo:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Tipo de Plazo" es requerido.</b>'
						}
					}
				}
			}
		});
	});
    $('#btnEnviarFormulario').on('click', function(event)
   	{
        event.preventDefault();
        $('#frmAgregarPeriodo').data('formValidation').resetField($('#txtFechaInicio'));
        $('#frmAgregarPeriodo').data('formValidation').resetField($('#txtFechaFin'));
		$('#frmAgregarPeriodo').data('formValidation').resetField($('#txtNumeroResolucion'));
        $('#frmAgregarPeriodo').data('formValidation').resetField($('#txtFechaResolución'));
        $('#frmAgregarPeriodo').data('formValidation').validate();
		if(!($('#frmAgregarPeriodo').data('formValidation').isValid()))
		{
			return;
		}
        var formData=new FormData($("#frmAgregarPeriodo")[0]);
        var dataString = $('#frmAgregarPeriodo').serialize();
        $.ajax({
            type:"POST",
            url:base_url+"index.php/ET_Periodo_Ejecucion/insertar",
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
            	$('#divModalCargaAjax').hide();
            	resp=JSON.parse(resp);
            	swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto') ? 'success':'error');
            	$('#modalTemp').modal('hide');
            },
            error:function()
            {
            	$('#divModalCargaAjax').hide();
            	swal('','Ha ocurrido un error inesperado','error');                    
            }
        });
    });
	
</script>






