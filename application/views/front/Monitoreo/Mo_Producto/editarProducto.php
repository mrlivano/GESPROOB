<form  id="frmEditarProducto">
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content" >		
				<div class="row">
					<div class="col-md-12">
						<div id ="divFormProducto">
							<input type="hidden" id="hdIdProyecto" name="hdIdProyecto" autocomplete="off" class="form-control" value="<?=$idPi?>">
							<input type="hidden" id="hdIdProducto" name="hdIdProducto" autocomplete="off" class="form-control" value="<?=$producto->id_producto?>">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<label for="control-label">Producto:</label>
									<div>
										<input type="text" id="txtProducto" name="txtProducto" autocomplete="off" class="form-control" value="<?=$producto->desc_producto?>">
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-3 col-sm-6 col-xs-12 ">
									<label for="control-label">Valoración:</label>
									<div class="form-group has-feedback">
										<input type="text" id="txtValoracionProducto" name="txtValoracionProducto" autocomplete="off" class="form-control" maxlength="5" value="<?=$producto->valoracion_producto?>">
										<span class="form-control-feedback right" aria-hidden="true">%</span>
									</div>									
								</div>					
							</div>						
						</div>
						<div class="row">
							<br><br>
							<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
								<input type="button" name="" class="btn btn-success" value="Guardar" onclick="guardarEdicionProducto();">
								<button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>	
						</div>
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
		$('#divFormProducto').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtProducto:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Producto" es requerido.</b>'
						}
					}
				},
				txtValoracionProducto:
                {
                    validators: 
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Valoración" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
                            message: '<b style="color: red;">El campo "Valoración" debe ser un valor en decimales.</b>'
                        },
                        between: {
                            min: 0.1,
                            max: 100,
                            message: '<b style="color: red;">El campo "Valoración" debe estar entre 1 y 100.</b>'
                        }
                    }
                }
			}
		});
	});

	function guardarEdicionProducto()
	{
		event.preventDefault();
		$('#divFormProducto').data('formValidation').validate();
		if(!($('#divFormProducto').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmEditarProducto")[0]);
		var idPi=$('#hdIdProyecto').val()
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_MonitoreodeProyectos/editarDatosProducto",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
	        	resp = JSON.parse(resp);
	        	((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));
	        	$('#frmInsertarActividad')[0].reset();
                $('#modalEditarProducto').modal('hide');
	        	paginaAjaxDialogo('nuevoProducto', 'Editar Producto',{ id_pi: idPi }, base_url+'index.php/Mo_MonitoreodeProyectos/EditarProducto', 'GET', null, null, false, true);
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }
    	}); 
	}
	
</script>
