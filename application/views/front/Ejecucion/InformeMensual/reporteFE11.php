<style>
	.informe
	{
		color:black;
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;		
		font-size:10px;
	}
	table
	{
		border-collapse: collapse;
		color:#35353e;
		width:100%;	
		font-size:10px;	
	}
	.tablastand td, .tablastand th
	{
		border:1px solid black;
		padding: 2px 5px;
		vertical-align: middle;		
	}
	.tablastand th
	{
		background-color:#f1f1f1;
		font-weight:bold;
		text-align:left;
	}
	.firstbox
	{
		margin: 0 0 10px;
	}
	.secondbox
	{
		margin: 5px 14px;
	}
	.thirdbox
	{
		margin: 0px 30px;
	}
	.firsttext
	{
		font-weight:bold;
	}
	.secondtext
	{
		text-decoration: underline;		
	}
	.tablacenter td, .tablacenter th
	{
		text-align:center;
	}
	.tablaMayuscula td, .tablacenter th
	{
		text-transform:uppercase;
	}
	.field:focus 
	{
    	border: 2px solid #2e6da4;		
	}
	.cuadroContenedor
	{
		border:1px solid black;
		padding: 2px 10px;
		font-size:12px;
		text-align: justify;
    	text-justify: inter-word;
	}
	.titulo
	{
		text-align:center;
		text-transform:uppercase;
		font-weight:bold;
		font-size:14px;

	}
</style>
<div class="informe">
	<div class="titulo">
		<!-- <p>FORMATO FE-02</p>
		<p>INFORME MENSUAL</p>
		<p>MES : <?=@$fechaReporte?></p> -->
		<p>FORMATO FE-11 <br>INFORME MENSUAL<br><?=@$fechaReporte?></p>CONCLUSIONES Y RECOMENDACIONES <br> 
	</div>
	<br>
	<form id="frmFichaInforme">
	<div class="cuerpo">
		<table class="tablastand tablaMayuscula">
			<tr>
				<th>NOMBRE DEL PROYECTO</th>
				<td style="width:80%;"><?=@$proyectoInversion->nombre_pi?></td>
			</tr>
			<tr>
				<th>CODIGO ÚNICO</th>
				<td><?=@$proyectoInversion->codigo_unico_pi?></td>
			</tr>
			<tr>
				<th>UNIDAD EJECUTORA</th>
				<td><?=@$proyectoInversion->nombre_ue?></td>
			</tr>
			<tr>
				<th>RESIDENTE DE PROYECTO</th>
				<td><?=(@$detalleFormato[0]->residente=='' ? @$responsableDetalle->residente : @$detalleFormato[0]->residente)?></td>
			</tr>
			<tr>
				<th>SUPERVISOR DE PROYECTO</th>
				<td><?=(@$detalleFormato[0]->supervisor=='' ? @$responsableDetalle->supervisor : @$detalleFormato[0]->supervisor)?></td>
			</tr>
			<tr>
				<th>ASISTENTE ADMINISTRATIVO</th>
				<td><?=(@$detalleFormato[0]->asistente_administrativo=='' ? @$responsableDetalle->asistente_administrativo : @$detalleFormato[0]->asistente_administrativo)?></td>
			</tr>
		</table>
		<table class="tablastand" style="margin-top: 6px;">
			<tr>
				<th>FECHA</th>
				<td style="width:80%;"><?=date('d/m/Y')?></td>
			</tr>
		</table>
		<br>
		<div class="firstbox">
			<div class="firstcontent">
				<p class="firsttext">CONCLUSIONES Y RECOMENDACIONES</p>	
				<div class="secondcontent">	
				<p class="thirdtext">CONCLUSIONES</p>			
				<div class="cuadroContenedor">
						<p> <?=@$detalleFormato[0]->conclusiones?></p>
					</div>	
				</div>
				</div>
				<div class="secondcontent">	
				<p class="thirdtext">RECOMENDACIONES</p>			
				<div class="cuadroContenedor">
						<p> <?=@$detalleFormato[0]->recomendaciones?></p>
					</div>	
				</div>
				</div>
			</div>				
		</div>
	</div>	
	</form>
</div> 
