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
		<?php 
		$sumatoriaPrecioUnitario=0;
		foreach($resultado as $value){ ?>
		<div class="panel-group" style="margin: 2px;">
			
			<br>
		</div>
		<?php } ?>
		<div style="height:50px; background-color:#edf2f5; padding:10px 30px; color:black;">
			<table id="tableDetalleAnalisisUnitario" class="table table-bordered" style="width:100%;" border="0">
				<thead>
					<tr>
						<td colspan="6">PRECIO UNITARIO (S/.)</td>
															
					</tr>
				</thead>
			</table>
		</div>
	</div>
	<hr style="margin-top: 4px;">
	<div class="row" style="text-align: right;">
		<input type="hidden" id="hdIdPartidaEnAnalisisPresupuestal" value="<?=$idPartida?>">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>
</div>
<script>
	
</script>