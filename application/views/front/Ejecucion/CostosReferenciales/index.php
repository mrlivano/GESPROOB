<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>COSTOS REFERENCIALES SEGUN SIGA</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<button onclick="BuscarProyectocodigo();" class="btn btn-primary" style="margin-top: 5px;margin-bottom: 15px;"><span class="fa fa-plus"></span>  NUEVO</button>
					<div class="table-responsive">
						<table id="tablaRepositorio" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<td class="col-md-1 col-xs-12">CODIGO</td>
									<td class="col-md-2 col-xs-12">DESCRIPCION ITEM</td>
									<td class="col-md-5 col-xs-12">PRECIO</td>
									<td class="col-md-5 col-xs-12">TIPO</td>
								</tr>
							</thead>
							<tbody>
							<?php foreach($listaCostosReferenciales as $item){ ?>
								<tr>									
									<td style="width:15%;">
										<?= $item->CODIGO?>
									</td>
									<td style="width:65%;">
										<?= $item->NOMBRE_ITEM?>
									</td>
									<td style="width:10%;">
										<?= $item->PRECIO_COMPRA?>
									</td>
									<td style="width:10%;">
										<?= $item->TIPO_BIEN?>
									</td>
																		
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<div class="modal fade" id="modalRepositorio">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Repositorio de Archivos</h4>
            </div>
            <div class="modal-body">
                <div id="contentRepositorio">
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php
$sessionTempCorrecto=$this->session->flashdata('correcto');
$sessionTempError=$this->session->flashdata('error');

if($sessionTempCorrecto){ ?>
	<script>
	$(document).ready(function()
	{
		swal('','<?=$sessionTempCorrecto?>', "success");
	});
	</script>
<?php }

if($sessionTempError){ ?>
	<script>
	$(document).ready(function()
	{
	swal('','<?=$sessionTempError?>', "error");
	});
	</script>
<?php } ?>
<script>

	$(document).ready(function()
	{
		$('#tablaRepositorio').DataTable(
		{
			"language":idioma_espanol
		});
	});

	function BuscarProyectocodigo()
	{

		swal({
			title: "Buscar",
			text: "Ingrese Código Único del proyecto",
			type: "input",
			showCancelButton: true,
			closeOnConfirm: false,
			cancelButtonText:"CERRAR" ,
			confirmButtonText: "BUSCAR",
			inputPlaceholder: "Ingrese Codigo Unico"
			}, function (inputValue) 
			{
				if (inputValue === false) return false;
				if (inputValue === "") 
				{
					swal.showInputError("Ingrese código Único");
					return false
				}
				buscar="true";
				paginaAjaxDialogo(null, 'Repositorio de Expediente',{CodigoUnico:inputValue,buscar:buscar}, base_url+'index.php/RepositorioExpediente/insertar', 'GET', null, null, false, true);
				swal("Correcto!", "Se Encontro el Proyecto: " + inputValue, "success");
		});
	}
</script>
