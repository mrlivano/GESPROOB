<style>
	#tablaMaquinaria th
	{
		background-color:#2e6da4;
		color:white;		
	}

	.list-group-item {
    	padding: 4px 12px;
	}
</style>
<div class="right_col" role="main">
	<div class="x_panel">
		<div class="x_title">
			<h2><b>Movimiento de Almacen</b></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">   
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-4 col-sm-12 col-xs-12">
							<div> 
								<input class="form-control" type="text" name="txtBusquedaInsumo" id="txtBusquedaInsumo">
								<div style="display:none;" id="contenedorLista">
									<div id="listaSugerencia" class="list-group" style="height: 150px;overflow-y: scroll;">								
									</div>
								</div>
							</div>		
						</div>							
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function()
{	
	$('#txtBusquedaInsumo').on('keyup', function()
    {
		var insumo = ($(this).val()).trim();	
		if(insumo.length>2)
		{		
			$('#contenedorLista').attr('style',  'display:block');	
			$.ajax({
				type:"POST",
				url:base_url+"index.php/ET_Insumo/verPorDescripcion",
				data: { valueSearch : insumo },
				cache: false,
				success:function(objectJson)
				{
					objectJson =JSON.parse(objectJson);
					var htmlTemp='';
					if(objectJson.length==0)
					{
						htmlTemp+='<button type="button" class="list-group-item list-group-item-action">Sin resultados...</button>';
					}
					else
					{
						for (var item in objectJson)
						{
							htmlTemp+='<button type="button" onclick="seleccionarInsumo(\''+replaceAll(objectJson[item].Descripcion,'"','abcde')+'\');" class="list-group-item list-group-item-action">'+objectJson[item].Descripcion+'</button>';
						}
					}
					$('#listaSugerencia').html(htmlTemp);
				},
				error:function()
				{
					$('#contenedorLista').attr('style',  'display:none');
				}
			}); 
		}
		else
		{
			$('#contenedorLista').attr('style',  'display:none');
		}		
	});
	
	
});

function seleccionarInsumo(descripcion)
{
	$('#contenedorLista').attr('style',  'display:none');
	$('#txtBusquedaInsumo').val(replaceAll(descripcion,'abcde','"'));
}
</script>