<form  id="frmInsertarDocumento">
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">	
		<div class="row">
			<div class="col-md-12">
				<div id ="divFormDocumento">
					<input type="hidden" id="hdIdMonitoreo" name="hdIdMonitoreo" autocomplete="off" class="form-control" value="<?=$idMonitoreo?>">
					<div class="row">
						<div class="col-md-12 col-sm-6 col-xs-12">
							<label for="control-label">Documento:</label>
							<div>
								<input type="file" id="fileArchivo" name="fileArchivo" autocomplete="off" class="form-control">
							</div>
						</div>							
					</div>												
				</div>
				<div class="row">
					<br><br>
					<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
						<input type="button" name="" class="btn btn-success" value="Guardar" onclick="guardarDocumento();">
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
		$('#divFormDocumento').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				fileArchivo:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Documento" es requerido.</b>'
						}
					}
				}
			}
		});
	});

	function guardarDocumento()
	{
		event.preventDefault();
		$('#divFormDocumento').data('formValidation').validate();
		if(!($('#divFormDocumento').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmInsertarDocumento")[0]);
		var idMonitoreo=$('#hdIdMonitoreo').val()
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_MonitoreoResultado/adjuntarDocumento",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
	        	resp = JSON.parse(resp);
	        	swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto')?'success':'error');
	        	
                $('#agregarDocumentos').modal('hide');
                if(resp.proceso=='Correcto')
               	{
               		var htmlTemp='<tr><td><a href='+base_url+'uploads/DocumentoMonitoreo/'+resp.urlDocumento+' target="_blank"><i class="fa fa-file fa-lg"></i></a></td><td><a onclick="eliminarDocumento('+idMonitoreo+',this,\''+resp.urlDocumento+'\');"  role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Documento"><span class="fa fa-trash-o"></span></a></td></tr>';               		
               		$('#tBodyDocumentos'+idMonitoreo).append(htmlTemp);
               	}
               	$('#frmInsertarDocumento')[0].reset();
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }	        
    	}); 
	}
	
</script>
