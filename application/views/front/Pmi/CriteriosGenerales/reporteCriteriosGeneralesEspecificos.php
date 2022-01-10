
<!DOCTYPE html>
<html>
<head>
	<title>Reporte de AU</title>
</head>
<body style="font-family: Helvetica;text-align: center;">
	<header style="font-size: 12px;margin-top: -44px;width: 100%;">
		<table style="margin-top: 17px;width: 100%;">
			<tr>
				<td style="width: 85px;">
					<img style="width: 80px;" src="./assets/images/peru.jpg">
				</td>
				<td id="header_texto">
					<div style="text-align: center;"><b>CRITERIOS GENERALES</b></div>
					<br>
					<div style="text-align: center;"> Año <?= $anio?></div>
				</td>
				<td style="width: 85px;">
					<img style="width: 80px;" src="./assets/images/logo.jpg">
				</td>
			</tr>
		</table>
	</header>
	<div>
			<table style="width: 90%; font-size:8px;margin-left: 20px;margin-top: 10px;" width="760" border=1 cellspacing=0 cellpadding=1  bordercolor="666633">
				<tr>
					<th style="height: 15px;text-align: left;width: 0px;">FUNCIÓN</th>
					<th style="height: 15px;text-align: center;width: 0px;">C. GENERAL</th>
					<th style="width: 1px;position: relative;">P</th>
					<th style="width: 1px;position: relative;">%(100)</th>
					<th style="text-align: center;width: 10px;">C. ESPECIFICOS</th>
					<th style="text-align: center;width: 10px;">P</th>
					<th style="text-align: center;width: 10px;">%(100)</th>
					<th style="text-align: center;width: 10px;">P FINAL</th>
				</tr>
				<tbody>
					<?php foreach($listarfuncionCriterioGeneral as $key => $value){  ?>
						<tr>
							<td style="width: 10px;"><b><?=$value->nombre_funcion?>.</b></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php $putaje=0; foreach($value->childCriteriGeneral  as $index => $item){  $putaje=(int)$putaje+(int)$item->peso_criterio_gen;?>
							<tr>
								<td></td>
								<td style=""><b><?=$item->nombre_criterio_gen?>.</b></td>
								<td style="text-align: right"><b><?=strtoupper(html_escape($item->peso_criterio_gen))?></b></td>
								<td style="text-align: right"><b><?=strtoupper(html_escape($item->porcentaje))?></b></td>
								<td></td>
								<td style="text-align: right;width: 10px;"></td>
								<td style="text-align: right;width: 10px;"></td>
								<td style="text-align: right;width: 10px;"></td>

							</tr>
								<?php foreach($item->childEspecificos  as $index => $itemp){  ?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><?=strtoupper(html_escape($itemp->nombre_criterio))?></td>
									<td style="text-align: right"><?=strtoupper(html_escape($itemp->peso))?></td>
									<td style="text-align: right"><?=strtoupper(html_escape($itemp->porcentaje))?></td>
									<td style="text-align: right"><?=number_format(($item->porcentaje*$itemp->porcentaje)/(100), 2, '.', ' ');  ?></td>
								</tr>
								<?php } ?>
						<?php } ?>
					<?php } ?>
					<tr>
							<td style="width: 10px;"></td>
							<td></td>
							<td style="text-align: center"><?=strtoupper(html_escape( $putaje))?></td>
							<td style="text-align: center">100%</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
				</tbody>
			</table>
	</div>
</body>
</html>