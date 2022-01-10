<style>
    .modal-dialog
    {
        width: 80%;
        margin: 0;
        margin-left: 10%;
        padding: 0;
    }

    .modal-content
    {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }
</style>
<div class="row">
	<div class="col-md-12 col-xs-12" style="height:500px;overflow:scroll;">
		<div class="table-responsive">
			<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Año Ejec.</th>
						<th>Sec Ejec.</th>
						<th>Opciones</th>
						<th>Expediente</th>
						<th>Sec Func.</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($listaExpediente as $item) { ?>
					<tr>
						<td><?=$item->ano_eje?></td>
						<td><?=$item->sec_ejec?></td>
						<td>
							<button type="button" class="clasificador btn btn-warning btn-xs" onclick="actualizarSiafExpediente('<?=$item->ano_eje?>', '<?=$item->expediente?>', '<?=$item->sec_ejec?>')" >Actualizar Expediente<i class='ace-icon bigger-120'></i>
						</button>
						</td>
						<td>
							<button onclick="paginaAjaxDialogo('expedienteSiaf', 'Detalle de Expediente Siaf por Orden de Compra',{anio:'<?=$item->ano_eje?>',expsiaf:'<?=$item->expediente?>', sec_ejec:'<?=$item->sec_ejec?>'}, base_url+'index.php/PrincipalReportes/detalleOrdenExpSiafUe', 'GET', null, null, false, true);" type="button" class="btn btn-primary btn-xs"><?=$item->expediente?><i class='ace-icon bigger-120'></i></button>
						</td>
						<td><?=$item->sec_func?></td>
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
		var myTable=$('#datatable-responsive').DataTable(
		{
			"language" : idioma_espanol
		});
	});

	function actualizarSiafExpediente(anio_expediente, expediente, unidad_ejecutora)
	{
		var start = +new Date();
		var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';
    	$.ajax({
			url: ups_url + "/Expediente/estado_expediente/" + anio_expediente + "/" + expediente +"/" +unidad_ejecutora,
			type: "POST",
			cache: false,
	        contentType:false,
	        processData:false,
			beforeSend: function(request) 
			{
			    renderLoading();
			},
			success:function(data){
				$('#divModalCargaAjax').hide();
				datos=JSON.parse(data);
				var rtt = +new Date() - start;

				if(datos.actualizo)
				{
					swal(
					  'Operacion Completada',
					  datos.mensaje + ' Tiempo: ' + (rtt/1000) +'s',
					  'success'
					);
				}
				else
				{
					swal(
					  'No se pudo completar la Operacion',
					  datos.mensaje + ' Tiempo: ' + (rtt/1000) +'s',
					  'warning'
					);
				}
			},
			error: function (xhr, textStatus, errorMessage)
			{
		        $('#divModalCargaAjax').hide();
		        swal(
					  'ERROR!',
					  'No se pudo conectar con el servidor de Importacion, error 0x5642418',
					  'error'
					);
		    }
		});
    }
</script>






