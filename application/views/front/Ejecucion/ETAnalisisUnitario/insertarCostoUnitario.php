<style>
	.panel-heading .accordion-toggle:after
	{
		font-family: 'Glyphicons Halflings';
		content: "\e114";
		float: right;
		color: grey;
	}

	.panel-heading .accordion-toggle.collapsed:after
	{
		content: "\e080";
	}
</style>
<div class="form-horizontal">
	
	<hr style="margin: 4px;">
	<div id="divListaAnalisisUnitario">
		<h3>Mano de Obra</h3>
		<table id="tableDetalleAnalisisUnitario" class="table table-bordered" style="width:100%;" border="0">
				<thead>
					<tr>
						<th colspan="6">Codigo Consumo</td>
						<th colspan="6">Descripcion</td>
						<th colspan="6">Unidad</td>
						<th colspan="6">Cuadrilla</td>
						<th colspan="6">Cantidad</td>
						<th colspan="6">Precio</td>
						<th colspan="6">Parcial</td>															
					</tr>
				</thead>
				<tbody>
				<?php $total=0;
					foreach($resultado as $value){ 
						if ($value->tipo==1) {
							# code...
						?>
					
					<tr>
						<td colspan="6"><?=$value->cod_insumo?></td>
						<td colspan="6"><?=$value->descripcion?></td>
						<td colspan="6"><?=$value->unidad?></td>
						<td colspan="6"><?=$value->cuadrilla?></td>
						<td colspan="6"><?=$value->cantidad?></td>
						<td colspan="6"><?=$value->precio?></td>
						<td colspan="6"><?=$value->parcial?></td>
					</tr>
					<?php $total+=$value->parcial; } ?>
					<?php
					 
				} ?><tr>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td><?=$total?></td>
			</tr>
				</tbody>
			</table>
			<h3>Materiales</h3>
			<table id="tableDetalleAnalisisUnitario" class="table table-bordered" style="width:100%;" border="0">
				<thead>
					<tr>
						<th colspan="6">Codigo Consumo</td>
						<th colspan="6">Descripcion</td>
						<th colspan="6">Unidad</td>
						<th colspan="6">Cuadrilla</td>
						<th colspan="6">Cantidad</td>
						<th colspan="6">Precio</td>
						<th colspan="6">Parcial</td>															
					</tr>
				</thead>
				<tbody>
				<?php $total=0;
					foreach($resultado as $value){ 
						if ($value->tipo==2) {
							# code...
						?>
					
					<tr>
						<td colspan="6"><?=$value->cod_insumo?></td>
						<td colspan="6"><?=$value->descripcion?></td>
						<td colspan="6"><?=$value->unidad?></td>
						<td colspan="6"><?=$value->cuadrilla?></td>
						<td colspan="6"><?=$value->cantidad?></td>
						<td colspan="6"><?=$value->precio?></td>
						<td colspan="6"><?=$value->parcial?></td>
					</tr>
					<?php $total+=$value->parcial; } ?>
					<?php
					 
				} ?><tr>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td><?=$total?></td>
			</tr>
				</tbody>
			</table>
			<h3>Equipos</h3>
			<table id="tableDetalleAnalisisUnitario" class="table table-bordered" style="width:100%;" border="0">
				<thead>
					<tr>
						<th colspan="6">Codigo Consumo</td>
						<th colspan="6">Descripcion</td>
						<th colspan="6">Unidad</td>
						<th colspan="6">Cuadrilla</td>
						<th colspan="6">Cantidad</td>
						<th colspan="6">Precio</td>
						<th colspan="6">Parcial</td>															
					</tr>
				</thead>
				<tbody>
				<?php $total=0;
					foreach($resultado as $value){ 
						if ($value->tipo==3) {
							# code...
						?>
					
					<tr>
						<td colspan="6"><?=$value->cod_insumo?></td>
						<td colspan="6"><?=$value->descripcion?></td>
						<td colspan="6"><?=$value->unidad?></td>
						<td colspan="6"><?=$value->cuadrilla?></td>
						<td colspan="6"><?=$value->cantidad?></td>
						<td colspan="6"><?=$value->precio?></td>
						<td colspan="6"><?=$value->parcial?></td>
					</tr>
					<?php $total+=$value->parcial; } ?>
					<?php
					 
				} ?><tr>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td colspan="6"></td>
				<td><?=$total?></td>
			</tr>
				</tbody>
			</table>
			
		
		
	</div>
	<hr style="margin-top: 4px;">
	<div class="row" style="text-align: right;">
		
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>
</div>
<script>
	
</script>