<form  id="frmInsertarObservacion">
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">	
		<div class="row">
			<div class="col-md-12">
				<div id ="divFormObservacion">
					<input type="hidden" id="hdIdMonitoreo" name="hdIdMonitoreo" autocomplete="off" class="form-control" value="<?=$idMonitoreo?>">
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label for="control-label">Fecha:</label>
							<div>
								<input type="date" id="txtFechaObservacion" name="txtFechaObservacion" autocomplete="off" class="form-control" value="<?=date('Y-m-d')?>">
							</div>
						</div>							
					</div>	
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label for="control-label">Observación:</label>
							<div>
								<textarea id="txtObservacion" name="txtObservacion" autocomplete="off" class="form-control" rows="3"></textarea> 
							</div>
						</div>								
					</div>											
				</div>
				<div class="row">
					<br><br>
					<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
						<input type="button" name="" class="btn btn-success" value="Guardar" onclick="guardarObservacion();">
						<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar ventana</button>
					</div>	
				</div>
			</div>					
		</div>
	</div>	
</div>
</form>
<script>

	$(function()
	{
		$('#divFormObservacion').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtFechaObservacion:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha" es requerido.</b>'
						}
					}
				},
				txtObservacion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Observación" es requerido.</b>'
						}
					}
				}
			}
		});
	});

	function guardarObservacion()
	{
		event.preventDefault();
		$('#divFormObservacion').data('formValidation').validate();
		if(!($('#divFormObservacion').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmInsertarObservacion")[0]);
		var idMonitoreo=$('#hdIdMonitoreo').val()
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_Observacion/insertar",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
	        	resp = JSON.parse(resp);
	        	swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto')?'success':'error');
	        	
                $('#agregarObservacion').modal('hide');
                if(resp.proceso=='Correcto')
               	{
               		var htmlTemp='<tr><td>'+resp.fecha+'</td><td>'+$('#txtObservacion').val()+'</td><td><a onclick="eliminarObservacion('+resp.idObservacion+',this);"  role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Observación"><span class="fa fa-trash-o"></span></a></td></tr>';               		
               		$('#tBodyObservacion'+idMonitoreo).append(htmlTemp);
               	}
               	$('#frmInsertarObservacion')[0].reset();
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }
    	}); 
	}
	
</script>
