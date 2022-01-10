<script src="<?php echo base_url(); ?>assets/vendors/echarts/dist/echarts.min.js"></script>
<div class="right_col" role="main">
	<div class="">

		<div class="clearfix"></div>

		<div class="row top_tiles">
			<?php foreach($listarEtapas as $item ){ ?>
			<div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="tile-stats">
					<div class="count" style="color: #26b99a;"><?=$item->Cantidadpip?> <span style="color: #73879c; font-size: 18px;"> <?php echo ($item->Cantidadpip>1) ? 'Estudios' : 'Estudio'?></span></div>
					<div id="CantidadEstudioFormulacion"></div>
					<h3><?=$item->denom_etapas_fe?></h3>

				</div>
			</div>
			<?php } ?>


		</div>
		<div class="row">
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Avance fisico por costo de inversión</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div id="Avance" style="height:350px;"></div>
						<!-- <div id="ReporteBarras" style="height:350px;"></div> -->
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>ESTUDIO POR ETAPA</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div id="EstudioEtapa" style="height:350px;"></div>
					</div>
				</div>
			</div>


			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>ESTUDIOS POR PROVINCIA</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div id="EstudioProvinvia" style="height:350px;"></div>

					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>TIPO DE ESTUDIO</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div id="CenterFEvaluacion" style="height:350px;"></div>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>MONTOS DE TIPO DE GASTO</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div id="MontosTiposGasto" style="height:350px;"></div>
						<!--<canvas class="MontosTiposGasto" height="160" width="160" style="width: 160px; height: 160px;"></canvas>-->

					</div>
				</div>
			</div>


			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2></h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">


					</div>
				</div>
			</div>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2> </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">

						<!-- <div id="echart_line" style="height:350px;"></div>-->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->
     <script src="<?php echo base_url(); ?>assets/js/Estadisticas/EstadisticasFE.js"></script>
