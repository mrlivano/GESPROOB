<html>
<head>
	<title>FORMATO FF-01</title>
  <style>
	@page { margin: 100px 50px;  }
    #header { position: fixed; left: 0px; top: -100px; right: 0px; height: 100px;text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -100px; right: 0px; height: 100px; }
    #footer .page:after { content: counter(page, upper-roman); }

	body
	{
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	}

    #tablaPresentacion td, #tablaPresentacion th
	{
		border: 1px solid black;
		font-size: 12px;
		padding: 4px;
		text-align: left;
		vertical-align: middle;
		border-collapse: collapse;
		font-weight: bold;		
	}
	#tablaPresentacion th
	{
		background-color:#f8f8f8;
		border: 1px solid black;
	}
	table{
		border-collapse: collapse;
	}
  </style>
</head>
<body>
  	<div id="header">
	  	<div style="padding-top:20px;">
			<table style="width: 100%;">
				<tr>
					<td style="width: 75px;">
						<img style="width: 60px;" src="./assets/images/peru.jpg">
					</td>
					<td id="header_texto">
						<div style="text-align: center;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
						<div style="text-align: center; font-size: 12px;">"Año del Fortalecimiento de la Soberanía Nacional"</div>
						
					</td>
					<td style="width: 75px;">
						<img style="width: 60px;" src="./assets/images/logoUniq.png">
					</td>
				</tr>
			</table>
		</div>
  	</div>
	<div id="footer"></div>
  	<div id="content">
	  	<div style="text-align: center; font-size: 15px;"><b>FORMATO FF-01</b></div>
		<div style="text-align: center; font-size: 15px;"><b>FICHA TÉCNICA DEL PROYECTO</b></div>
		<br>
  		<table id="tablaPresentacion" style="width: 100%" border="1">
			<!--<tr>
				<th>1. Nombre de la Unidad Ejecución</th>
				<td>Universidad Nacional Intercultural de Quillabamba</td>
			</tr>-->
			<tr>
				<td style="width: 20%">1. Nombre del Proyecto</td>
				<td style="text-align: justify;"  ><?= @$listarExpedienteFicha001->nombre_pi ?></td>
			</tr>
			<tr>
				<th>2. Ubicación</th>
				<td>Distrito/Provincia/Departamento: <?= @$listarExpedienteFicha001->distrito_provincia_departamento_ue ?> <br>
					Zona: <?=@$listarExpedienteFicha001->direccion_ue;?> 
				</td>
			</tr>
			<tr>
				<td colspan="2">3. Autores del estudio</td>
			</tr>
			
			<tr>
			<td colspan="2">
			<table id="tresp" style="width: 100%" border="1">
			<tr >
			
				<td style="width: 40%">Cargo</td>
				<td>Responsable</td>
			</tr>
			
			<?php foreach($listarResponsables as $item){ ?>
				<tr>
				<th ><?=$item->desc_cargo;?> </th>
				<td><?=$item->nombres;?> </td>
				</tr>
				
			<?php } ?>
		
			</table>
			</td>
			</tr>

			<tr>
				<th>4. Código único</th>
				<td><?= @$listarExpedienteFicha001->codigo_unico_pi ?></td>
			</tr>
			<tr>
				<th>5. Costo Total Proyecto(Pre Inversión)</th>
				<td>S/. <?=a_number_format($listarExpedienteFicha001->costo_total_preinv_et, 2, '.',",",3)?></td>
			</tr>

			<tr>
				<th>6. Costo Total Proyecto(Inversión)</th>
				<td>S/. <?=a_number_format($listarExpedienteFicha001->costo_total_inv_et, 2, '.',",",3)?></td>
				
			</tr>
			<tr >
				<td colspan="2">7. Componentes del Proyecto</td>
			</tr>
			<tr >
			
				
							
			
				<td colspan="2">
				<?php $i=1; foreach($listarComponentes as $item){ ?>
				<p>Componente <?php echo $i.' ';?>: <?=$item->desc_meta;?> </p>
				<?php  $i=$i+1;} ?>
				</td>
			</tr>	
			<tr>
				<th>8. Plazo de Ejecución</th>
				<td><?= @$listarExpedienteFicha001->tiempo_ejecucion_pi_et ?> meses</td>
			</tr>
			<tr>
				<th>9. Entidad Ejecutora</th>
				<td>Universidad Nacional Intercultural de Quillabamba</td>
			</tr>
			<tr >
				<td colspan="2">10. Función Programática</td>
			</tr>
			
			<tr>
				<th>10.1. Función</th>
				<td><?= @$listarExpedienteFicha001->funcion_et ?></td>
			</tr>
			<tr>
				<th>10.2. Programa</th>
				<td><?= @$listarExpedienteFicha001->programa_et ?></td>
			</tr>
			<tr>
				<th>10.3. Sub Programa</th>
				<td><?= @$listarExpedienteFicha001->sub_programa_et ?></td>
			</tr>
			<tr>
				<th>11. Fuente de financiamiento</th>
				<td><?= @$listarExpedienteFicha001->fuente_financiamiento_et ?></td>
			</tr>
			<tr>
				<th>12. Modalidad de ejecución</th>
				<td><?= @$listarExpedienteFicha001->modalidad_ejecucion_et ?></td>
			</tr>
			<tr>
			<td colspan="2">
			<table id="tmod" style="width: 100%" border="0">
			<tr >
			
				<th style="width: 70%">Componentes</th>
				<td>Modalidad de Ejecución</td>
			</tr>
			<?php if(@$listarExpedienteFicha001->modalidad_ejecucion_et=="ADMINISTRACION DIRECTA"){ ?>
			<tr>
			<td>
			
			<?php $i=1; foreach($listarComponentesAD as $item){ ?>
			<p>Componente <?php echo $i.' ';?>: <?=$item->desc_meta;?> </p>
			<?php  $i=$i+1;} 
			?>
			</td>
			<td>ADMINISTRACION DIRECTA</td>
			</tr>
			<?php }
			
			 else if(@$listarExpedienteFicha001->modalidad_ejecucion_et=="ADMINISTRACION MIXTA"){ ?>
			<tr>
			<td>
			
			<?php $i=1; foreach($listarComponentesAD as $item){ ?>
			<p>Componente <?php echo $i.' ';?>: <?=$item->desc_meta;?> </p>
			<?php  $i=$i+1;} 
			?>
			</td>
			<td>ADMINISTRACION DIRECTA</td>
			</tr>
			<tr>
			<td>
			
			<?php  foreach($listarComponentesAI as $item){ ?>
			<p>Componente <?php echo $i.' ';?>: <?=$item->desc_meta;?> </p>
			<?php  $i=$i+1;} 
			?>
			</td>
			<td>ADMINISTRACION INDIRECTA</td>
			</tr>
			<?php }
			else { ?>
			<tr>
			<td>
			
			<?php $i=1; foreach($listarComponentesAI as $item){ ?>
			<p>Componente <?php echo $i.' ';?>: <?=$item->desc_meta;?> </p>
			<?php  $i=$i+1;} 
			?>
			</td>
			<td>ADMINISTRACION INDIRECTA</td>
			</tr>
			<?php } ?>
			</table>
			</td>
			</tr>
			<tr>
				<th>13. Número de Beneficiarios Indirectos del Proyecto</th>
				<td><?= @$listarExpedienteFicha001->num_beneficiarios_indirectos ?> </td>
			</tr>


			<tr>
				<th colspan="2">14. Sustento para la presentación del proyecto</th>	             
			</tr>
			<tr>
				<td colspan="2">
					<div style="text-align: justify;text-justify: inter-word;">
						<?= @$listarExpedienteFicha001->desc_situacion_actual_et ?>   
					</div>
				</td>	             
			</tr>
			<tr>
				<th colspan="2">15. Revelación económica</th>	        		
			</tr>
			<tr>
				<td colspan="2">
					<div style="text-align: justify;text-justify: inter-word;" >
						<?= @$listarExpedienteFicha001->relevancia_economica_et ?>  
					</div>
				</td>	        		
			</tr>
			<tr>
				<th colspan="2">16. Resumen del proyecto(descripción general)</th>
			</tr>
			<tr>
				<td colspan="2">
					<div style="text-align: justify;text-justify: inter-word;" >
						<?= @$listarExpedienteFicha001->resumen_pi_et ?>  
					</div>	        		
				</td>
			</tr>
			<tr>
				<th>17. N° de Folios</th>
				<td><?= @$listarExpedienteFicha001->num_folios ?></td>
			</tr>
			<tr>
				<th colspan="2">18. Fotografias</th>
			</tr>
			<tr>
				<th colspan="2">
			<table id="tbfoto" style="width: 100%" border="0">
			<?php 

			$numRegistros=count($ImagenesExpediente);

			$numFilas=ceil($numRegistros/2);

			$temp=-1;

			for($i=0;$i<$numFilas;$i++)
			{ ?>
			
			<tr>
				<?php $temp+=1;?>
				<td>
					<?php if(@$ImagenesExpediente[$temp]->desc_img!='') {  ?>
						<img style="width: 325px;height: 220px; margin:5px 5px;" src="./uploads/ImageExpediente/<?=@$ImagenesExpediente[$temp]->id_img?><?=@$ImagenesExpediente[$temp]->desc_img?>" > 
					<?php } ?>
				</td>
				<?php $temp+=1;?>
				<td>
					<?php if(@$ImagenesExpediente[$temp]->desc_img!='') {  ?>
						<img style="width: 325px;height: 220px; margin:5px 5px;" src="./uploads/ImageExpediente/<?=@$ImagenesExpediente[$temp]->id_img?><?=@$ImagenesExpediente[$temp]->desc_img?>" > 
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
				</table></th>
			</tr>
  		</table>
  	</div>
</body>
</html>
