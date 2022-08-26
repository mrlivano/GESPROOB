<html>
<head>
	<title>Formato FF-06</title>
	<style>
		@page { margin: 100px 50px;  }
		#header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px;text-align: center; }
		#footer { position: fixed; left: 0px; bottom: -150px; right: 0px; height: 100px; }
		#footer .page:after { content: counter(page, upper-roman); }

		body
		{
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		}
		table
		{
			border-collapse: collapse;
		}
		#tablaContenido td, #tablaContenido th
		{
			border: 1px solid black;
			font-size: 9px;
			padding: 3px 6px;
			vertical-align: middle;
		}
		#tablaContenido th
		{
			background-color:#337ab7;
			color:white;
		}	
		#tablaCabecera td, #tablaCabecera th
		{
			font-size: 8px;
			text-align:left;
		}
		#tablaCabecera th
		{
			font-weight:bold;
		}		
	</style>
</head>
<body>
	<div id="header">
    	<table style="width: 100%;margin-top: 15px">
			<tr>
				<td style="width: 75px;">
					<img style="width: 60px;" src="./assets/images/peru.jpg">
				</td>
				<td id="header_texto">
					<div style="text-align: center; font-size: 13px;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
					<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>					
				</td>
				<td style="width:75px;">
					<img style="width:60px;" src="./assets/images/logoUniq.png">
				</td>
			</tr>
		</table>
  	</div>
  	<div id="footer">
		<div style="text-align: left; font-size: 10px;">Usuario: <?php echo $this->session->userdata('nombreUsuario')?> | fecha: <?php echo date("d/m/Y");?></div>
		</div>
  	<div id="content">	
	  	<div style="text-align: center; font-size: 13px;"><b>FORMATO FF-06</b></div>
		<div style="text-align: center; font-size: 13px;"><b>CUADRO DE PRESUPUESTO ANALÍTICO GENERAL</b></div>
		<div style="padding-top:12px;">
			<table id="tablaCabecera" width="100%" border=0>
				<tr>
					<th style="width:12%;">PROYECTO</th>
					<td style="width:66%;">: <?=$expedienteTecnico->nombre_pi?></td>
				</tr>
				<tr>
					<th style="width:12%;">FTE. FTO.</th>
					<td style="width:66%;">: <?=$expedienteTecnico->fuente_financiamiento_et?></td>
					<th style="width:10%;"></th>
					<td style="width:12%;"></td>
				</tr>
				<tr>
					<th style="width:12%;">MODALIDAD</th>
					<td style="width:66%;">: <?=$expedienteTecnico->modalidad_ejecucion_et?></td>
					<th style="width:10%;"></th>
					<td style="width:12%;"></td>
				</tr>
				<tr>
					<th style="width:12%;">FUNCIÓN PROGRAMATICA</th>
					<td style="width:66%;">: <?=$expedienteTecnico->funcion_programatica?></td>
					<th style="width:10%;"></th>
					<td style="width:12%;"></td>
				</tr>				
			</table>
		</div>
		<div style="padding-top:10px;">
			<table id="tablaContenido" width="100%">
				<thead>
					<tr>
						<th rowspan="2">DESCRIPCIÓN</th>
						<th rowspan="2">CLASIF.</th>
						<th colspan="5">EJECUCIÓN</th>
					</tr>
					<tr>
						<th>DESCRIPCIÓN</th>
						<th>COSTO DIRECTO</th>
						<th>COSTO INDIRECTO</th>
						<th>COSTO TOTAL</th>
						<th>OBSERVACIÓN</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($PresupuestoEjecucionListar as $key => $value) {?>
					<tr id="trPresupuestoEjecucion<?=$value->id_presupuesto_ej?>">
						<td style="background-color: #f1f1f1;" colspan="7">
							<?=$value->desc_presupuesto_ej?>								
						</td>
						<?php if(count($value->childPresupuesto)==0) 
						{							
							foreach ($value->ChilpresupuestoAnalitico as $key => $temp) { ?>
								<tr>
									<td></td>
									<td><?= $temp->num_clasificador?></td>
									<td><?= $temp->desc_clasificador?></td>
									<td style="text-align:right;">
										<?php foreach ($temp->ChilCostoDetallePartida as $key => $pres) {?>
												
										S/. <?= a_number_format($pres->costoDirecto , 2, '.',",",3);?> 
											
										<?php } ?>
									</td>
									<td></td>
									<td style="text-align:right;">
										<?php foreach ($temp->ChilCostoDetallePartida as $key => $pres) {?>
												
										S/. <?= a_number_format($pres->costoDirecto , 2, '.',",",3);?>
											
										<?php } ?>
									</td>
									<td></td>
								</tr>							 	
							<?php } 							 	
						}?>
						<?php if(count($value->childPresupuesto)>0) { 
							foreach ($value->childPresupuesto as $key => $item) { ?>
								<tr id="trPresupuestoEjecucion<?=$item->id_presupuesto_ej?>">
									<td colspan="7"><?=$item->desc_presupuesto_ej?></td>
									<?php foreach ($item->ChilpresupuestoAnalitico as $key => $temp2) { ?>
										<tr>
											<td></td>
											<td><?= $temp2->num_clasificador?></td>
											<td><?= $temp2->desc_clasificador?></td>
											<td></td>
											<td style="text-align:right;">
												<?php foreach ($temp2->ChilCostoDetallePartida as $key => $pres) {?>

												S/. <?= a_number_format($pres->costoDirecto , 2, '.',",",3);?> 
													
												<?php } ?>
											</td>
											<td style="text-align:right;">
												<?php foreach ($temp2->ChilCostoDetallePartida as $key => $pres) {?>

												S/. <?= a_number_format($pres->costoDirecto , 2, '.',",",3);?> 
													
												<?php } ?>
											</td>
											<td></td>
										</tr>							 	
									<?php } ?>
								</tr>
							<?php }
						} ?>
					</tr>						
					<?php } ?>
					<tr>
						<td colspan="3" style="text-align:center;"><b>TOTAL</b></td>
						<td style="text-align:right;"><b>S/. <?= a_number_format($costoDirecto , 2, '.',",",3);?></b> </td>
						<td style="text-align:right;"><b>S/. <?= a_number_format($costoIndirecto , 2, '.',",",3);?></b> </td>
						<td style="text-align:right;"><b>S/. <?= a_number_format($costoDirecto+$costoIndirecto , 2, '.',",",3);?> </b></td>
						<td style="text-align:right;"></td>
					</tr>
				</tbody>
			</table>    
		</div>
	</div>
</body>
</html>
