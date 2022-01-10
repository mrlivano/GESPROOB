
<form  id="frmEjecucion">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_content">		
				<div class="row">
					<input type="hidden" name="hdIdMaquinaria" id="hdIdMaquinaria" autocomplete="off" value="<?=$idMaquinaria?>" readonly="readonly" >
				</div>	
				<div id="validarEjecucion">		
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Trabajos Realizados: </label>
							<textarea class="form-control" name="txtTrabajosRealizados" id="txtTrabajosRealizados" rows="3" ></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Fecha: </label>
							<div>
								<input class="form-control" name="txtFecha" id="txtFecha" type="date" value="<?=date('Y-m-d')?>">	
							</div>	
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Horas Trabajadas: </label>
							<div>
								<input class="form-control" placeholder="Cantidad" autocomplete="off" name="txtCantidad" id="txtCantidad">	
							</div>	
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">.</label>
							<div>
								<button style="width:100%;" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
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
			<table id="tableListaValorizacion" style="text-align: left;" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="width: 5%">Fecha</th>
						<th style="width: 5%">Horas Trabajadas</th>
						<th style="width: 30%">Trabajos Realizados</th>
						<th style="width: 3%">Opciones</th>						
					</tr>
				</thead>
				<tbody>
				<?php foreach ($listaEjecucionMaquinaria as $key => $value) {?>
					<tr>
						<td><?=date('d/m/Y',strtotime($value->fecha))?></td>
						<td><?=$value->num_horas_trabajadas?></td>
						<td><?=$value->trabajos_realizados?></td>
						<td>
							<button type="button" class="btn btn-danger btn-xs" onclick="eliminar('<?=$value->id_ejecucion?>',this);"><i class="fa fa-trash-o"></i> Eliminar</button>
						</td>
					</tr>
				<?php }?>
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

$(document).ready(function()
{
	$('#tableListaValorizacion').DataTable(
	{
		"language":idioma_espanol
	});
});

$(function()
{
	$('#validarEjecucion').formValidation(
	{
		framework: 'bootstrap',
		excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
		live: 'enabled',
		message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
		trigger: null,
		fields:
		{
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
			txtTrabajosRealizados:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Etapa" es requerido.</b>'
					}
				}
			}
		}
	});
});

$('#btnEnviarFormulario').on('click', function(event)
{
    event.preventDefault();
    $('#validarEjecucion').data('formValidation').validate();
	if(!($('#validarEjecucion').data('formValidation').isValid()))
	{
		return;
	}
	var formData=new FormData($("#frmEjecucion")[0]);
    $.ajax({
        type:"POST",
        url:base_url+"index.php/ET_Ejecucion_Maquinaria/insertar",
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
});

function eliminar(codigo,element)
{
	swal(
	{
		title: "Confirmación",
		text: "Realmente desea realizar esta operación",
		type: "info",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Consentir proceso",
		cancelButtonText: "Cerrar",
		closeOnConfirm: false
	},
	function(isConfirm)
	{
		if(isConfirm)
		{
			$.ajax({
				type:"POST",
				url:base_url+"index.php/ET_Ejecucion_Maquinaria/eliminar",
				data: {idEjecucion : codigo},
				cache: false,
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					swal(objectJSON.proceso, objectJSON.mensaje, (objectJSON.proceso=='Correcto' ? 'success' : 'error'));
					$(element).parent().parent().remove();
				},
				error:function()
				{
					swal("Error","Ha ocurrido un error inesperado", "error");
				}
			}); 
		}
	});
}
</script>

