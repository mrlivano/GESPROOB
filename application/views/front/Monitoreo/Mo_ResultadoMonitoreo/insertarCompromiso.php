<form  id="frmInsertarCompromiso">
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">	
		<div class="row">
			<div class="col-md-12">
				<div id ="divFormCompromiso">
					<input type="hidden" id="hdIdMonitoreo" name="hdIdMonitoreo" autocomplete="off" class="form-control" value="<?=$idMonitoreo?>">
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label for="control-label">Fecha:</label>
							<div>
								<input type="date" id="txtFechaCompromiso" name="txtFechaCompromiso" autocomplete="off" class="form-control" value="<?=date('Y-m-d')?>">
							</div>
						</div>	
						<div class="col-md-9 col-sm-6 col-xs-12">
							<label for="control-label">Responsable:</label>
							<div>
								<input type="input" id="txtResponsable" name="txtResponsable" autocomplete="off" class="form-control">
							</div>
						</div>								
					</div>	
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label for="control-label">Compromiso:</label>
							<div>
								<textarea id="txtCompromiso" name="txtCompromiso" autocomplete="off" class="form-control" rows="3"></textarea> 
							</div>
						</div>								
					</div>											
				</div>
				<div class="row">
					<br><br>
					<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
						<input type="button" name="" class="btn btn-success" value="Guardar" onclick="guardarCompromiso();">
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
		$('#divFormCompromiso').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtFechaCompromiso:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha" es requerido.</b>'
						}
					}
				},
				txtCompromiso:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Compromiso" es requerido.</b>'
						}
					}
				}
			}
		});
	});

	function guardarCompromiso()
	{
		event.preventDefault();
		$('#divFormCompromiso').data('formValidation').validate();
		if(!($('#divFormCompromiso').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmInsertarCompromiso")[0]);
		var idMonitoreo=$('#hdIdMonitoreo').val()
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_Compromiso/insertar",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
	        	resp = JSON.parse(resp);
	        	swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto')?'success':'error');	        	
                $('#agregarCompromiso').modal('hide');
                if(resp.proceso=='Correcto')
               	{
               		var htmlTemp='<tr><td>'+resp.fecha+'</td><td>'+$('#txtCompromiso').val()+'</td><td>'+$('#txtResponsable').val()+'</td><td><a onclick="eliminarCompromiso('+resp.idCompromiso+',this);"  role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Compromiso"><span class="fa fa-trash-o"></span></a></td></tr>';               		
               		$('#tBodyCompromiso'+idMonitoreo).append(htmlTemp);
               	}
               	$('#frmInsertarCompromiso')[0].reset();
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }
	        
    	}); 
	}
	
</script>
