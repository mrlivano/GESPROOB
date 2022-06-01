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
	table
	{
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
			<tr>
				<th>1. Nombre de la Unidad Ejecución</th>
				<td>Universidad Nacional Intercultural de Quillabamba</td>
			</tr>
			<tr>
				<th>1.1. Dirección</th>
				<td><?=@$listarExpedienteFicha001->direccion_ue;?></td>
			</tr>
			<tr>
				<th>1.2. Distrito/Provincia/Departamento</th>
				<td><?= @$listarExpedienteFicha001->distrito_provincia_departamento_ue ?></td>
			</tr>
			<tr>
				<th>1.3. Teléfono</th>
				<td><?= @$listarExpedienteFicha001->telefono_ue ?></td>
			</tr>
			<tr>
				<th>1.4. RUC</th>
				<td><?= @$listarExpedienteFicha001->ruc_ue ?></td>
			</tr>			
			<tr>
				<th>2. Nombre del Proyecto</th>
				<td><?= @$listarExpedienteFicha001->nombre_pi ?></td>
			</tr>
			<tr>
				<th>2.1. Ubicación distrital donde se plantea su ejecución</th>
				<td><?= @$listarExpedienteFicha001->provincia ?></td>
			</tr>
			<tr>
				<th>2.2. Codigo único</th>
				<td><?= @$listarExpedienteFicha001->codigo_unico_pi ?></td>
			</tr>
			<tr>
				<th>3. Costo Total Proyecto(Pre Invesión)</th>
				<td>S/. <?= @$listarExpedienteFicha001->costo_total_preinv_et ?> </td>
			</tr>
			<tr>
				<th> 3.1. Costo Directo</th>
				<td>S/. <?= @$listarExpedienteFicha001->costo_directo_preinv_et ?></td>
			</tr>
			<tr>
				<th>3.2. Costo Indirecto</th>
				<td>S/. <?= @$listarExpedienteFicha001->costo_indirecto_preinv_et ?></td>
			</tr>
			<tr>
				<th>4. Costo Total Proyecto(Invesión)</th>
				<td>S/. <?= @$listarExpedienteFicha001->costo_total_inv_et ?></td>
			</tr>
			<tr>
				<th>4.1. Costo Directo</th>
				<td>S/. <?= @$listarExpedienteFicha001->costo_directo_inv_et ?></td>
			</tr>
			<tr>
				<th>4.2. Costo General</th>
				<td>S/. <?= @$listarExpedienteFicha001->gastos_generales_et ?></td>
			</tr>
			<tr>
				<th>4.3. Gasto de Supervisión</th>
				<td>S/. <?= @$listarExpedienteFicha001->gastos_supervision_et ?></td>
			</tr>
			<tr>
				<th>5. Función Programática</th>
				<td></td>
			</tr>
			<tr>
				<th>5.1. FUNCIÓN</th>
				<td><?= @$listarExpedienteFicha001->funcion_et ?></td>
			</tr>
			<tr>
				<th>5.2. PROGRAMA</th>
				<td><?= @$listarExpedienteFicha001->programa_et ?></td>
			</tr>
			<tr>
				<th>5.3. SUB PROGRAMA</th>
				<td><?= @$listarExpedienteFicha001->sub_programa_et ?></td>
			</tr>
			<tr>
				<th>5.4. PROYECTO</th>
				<td><?= @$listarExpedienteFicha001->proyecto_et ?></td>
			</tr>
			<tr>
				<th>5.5. COMPONENTE</th>
				<td><?= @$listarExpedienteFicha001->componente_et ?></td>
			</tr>
			<tr>
				<th>5.6. META</th>
				<td><?= @$listarExpedienteFicha001->meta_et ?></td>
			</tr>
			<tr>
				<th>5.7. FUENTE DE FINANCIAMIENTO</th>
				<td><?= @$listarExpedienteFicha001->fuente_financiamiento_et ?></td>
			</tr>
			<tr>
				<th>5.8. MODALIDAD DE EJECUCIÓN</th>
				<td><?= @$listarExpedienteFicha001->modalidad_ejecucion_et ?></td>
			</tr>
			<tr>
				<th>6. Tiempo de Ejecución del Proyecto</th>
				<td><?= @$listarExpedienteFicha001->tiempo_ejecucion_pi_et ?></td>
			</tr>
			<tr>
				<th>7. Número de Beneficiario Indirecto del Proyecto</th>
				<td><?= @$listarExpedienteFicha001->num_beneficiarios_indirectos ?> </td>
			</tr>
			<tr>
				<th>8. Nombre del Responsable de la Elaboración del Proyecto</th>
				<td><?= @$responsableElaboracion->nombres?> <?= @$responsableElaboracion->apellido_p?>  <?= @$responsableElaboracion->apellido_m?></td>
			</tr>
			<tr>
				<th>8.1. Profesion</th>
				<td><?= @$responsableElaboracion->nombre_esp?></td>
			</tr>	        
			<tr>
				<th>8.2. DNI</th>
				<td><?= @$responsableElaboracion->dni?></td>
			</tr>
			<tr>
				<th>8.4. Dirección</th>
				<td><?= @$responsableElaboracion->direccion?></td>
			</tr>
			<tr>
				<th>8.5. Teléfono</th>
				<td><?= @$responsableElaboracion->telefonos?></td>
			</tr>
			<tr>
				<th>9. Nombre del Responsable de la Ejecución del proyecto</th>
				<td><?= @$responsableEjecucion->nombres?> <?= @$responsableEjecucion->apellido_p?>  <?= @$responsableEjecucion->apellido_m?></td>
			</tr>
			<tr>
				<th>9.1. Profesíon</th>
				<td><?= @$responsableEjecucion->nombre_esp?> </td>
			</tr>
			<tr>
				<th>9.2. DNI</th>
				<td><?= @$responsableEjecucion->dni?></td>
			</tr>
			<tr>
				<th>9.4. Dirección</th>
				<td><?= @$responsableEjecucion->direccion?></td>
			</tr>
			<tr>
				<th>9.5. Teléfono</th>
				<td><?= @$responsableEjecucion->telefonos?></td>
			</tr>
			<tr>
				<th colspan="2">10. Sustento para la presentación del proyecto</th>	             
			</tr>
			<tr>
				<td colspan="2">
					<div style="text-align: justify;text-justify: inter-word;">
						<?= @$listarExpedienteFicha001->desc_situacion_actual_et ?>   
					</div>
				</td>	             
			</tr>
			<tr>
				<th colspan="2">11. Revelación económica</th>	        		
			</tr>
			<tr>
				<td colspan="2">
					<div style="text-align: justify;text-justify: inter-word;" >
						<?= @$listarExpedienteFicha001->relevancia_economica_et ?>  
					</div>
				</td>	        		
			</tr>
			<tr>
				<th colspan="2">12. Resumen del proyecto(descripción general)</th>
			</tr>
			<tr>
				<td colspan="2">
					<div style="text-align: justify;text-justify: inter-word;" >
						<?= @$listarExpedienteFicha001->resumen_pi_et ?>  
					</div>	        		
				</td>
			</tr>
			<tr>
				<th>13. N° de Folios</th>
				<td><?= @$listarExpedienteFicha001->num_folios ?></td>
			</tr>
			<tr>
				<th colspan="2">14. Fotografias</th>
			</tr>
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
						<img style="width: 320px;height: 220px; margin:5px 5px;" src="/uploads/ImageExpediente/<?=@$ImagenesExpediente[$temp]->id_img?><?=@$ImagenesExpediente[$temp]->desc_img?>" > 
					<?php } ?>
				</td>
				<?php $temp+=1;?>
				<td>
					<?php if(@$ImagenesExpediente[$temp]->desc_img!='') {  ?>
						<img style="width: 320px;height: 220px; margin:5px 5px;" src="/uploads/ImageExpediente/<?=@$ImagenesExpediente[$temp]->id_img?><?=@$ImagenesExpediente[$temp]->desc_img?>" > 
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
  		</table>
  	</div>
</body>
</html>

