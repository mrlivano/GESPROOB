<style type="text/css">
	.pre {
		color: red;
		background: red;
	}

	#table_clasificador th {
		background-color: #3f5367;
		color: white;
	}
</style>

<?php $contD = 0; $contI = 0 ?>
<div class="form-horizontal">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			
		</div>
	</div>
	

<div id="content">
		<div style="text-align: center; font-size: 15px;"><b>FORMATO FF-04</b></div>
		<div style="text-align: center; font-size: 15px;"><b>ESPECIFICACIONES TECNICAS</b></div>

		<div id="body">

			<?php if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') { ?>

				<div class="col-md-12 col-sm-12 col-xs-12">
					<label>Administracion Directa</label>
					<div class="bs-glyphicons">
						<ul class="bs-glyphicons-list">
							<a target="_blank" href="<?= base_url(); ?>uploads/EspecificacionesTecnicas/<?= $expedienteTecnico->id_et ?>a<?= $expedienteTecnico->url_especificacion_tecnica ?>">
								<li style="height:77px;">
									<span class="glyphicon glyphicon-book" aria-hidden="true"></span><br>
									<span>Ver</span>

								</li>
							</a>
						</ul>
					</div>
				</div>
			<?php }
			if ($expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et == 'ADMINISTRACION MIXTA') { ?>


				<div class="col-md-12 col-sm-12 col-xs-12"><label>Administracion Indirecta</label>
					<div class="bs-glyphicons">
						<ul class="bs-glyphicons-list">
							<a target="_blank" href="<?= base_url(); ?>uploads/EspecificacionesTecnicas/<?= $expedienteTecnico->id_et ?>b<?= $expedienteTecnico->url_especificacion_tecnica ?>">
								<li style="height:77px;">
									<span class="glyphicon glyphicon-book" aria-hidden="true"></span><br>
									<span>Ver</span>
								</li>
							</a>
						</ul>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<br>
	

	<div class="row" style="text-align: right;">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>

</div>

