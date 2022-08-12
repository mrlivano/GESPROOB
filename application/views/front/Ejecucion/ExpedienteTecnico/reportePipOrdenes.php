<html>
<head>
	<title>ORDENES PIP</title>
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
  
  <script>
  //window.print();
  </script>
</head>
<body>


<!--
  	<div id="header">
	  	<div style="padding-top:20px;">
			<table style="width: 100%;">
				<tr>
					<td style="width: 75px;">
						<img style="width: 60px;" src="./assets/images/peru.jpg">
					</td>
					<td id="header_texto">
						<div style="text-align: center;"><b>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</b></div>
						<div style="text-align: center; font-size: 12px;">"Año de la lucha contra la corrupción y la impunidad"</div>
						
					</td>
					<td style="width: 75px;">
						<img style="width: 60px;" src="./assets/images/logoUniq.png">
					</td>
				</tr>
			</table>
		</div>
  	</div>
	-->
	
	<div id="footer">
		<div style="text-align: left; font-size: 12px;">Usuario: <?php echo $this->session->userdata('nombreUsuario')?> | fecha:<?php echo date("d/m/Y");?></div>
		</div>
  	<div id="content">
	<script>
	function imprimir()
{
	
  //var Obj = document.getElementById("desaparece");
 // Obj.style.visibility = 'hidden';
  window.print();
}

	</script>
	
	
	  	<div style="text-align: center; font-size: 15px;"><b>REPORTE ORDENES</b></div>
		<div style="text-align: center; font-size: 15px;"><b></b></div>
		<br>
  		<table id="tablaPresentacion" style="width: 100%" border="1">
			<tr>
				<th>Nombre de la Unidad Ejecución</th>
				<td>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</td>
			</tr>
			<tr>
				<th>Meta</th>
				<td><?=@$meta;?></td>
			</tr>
			<tr>
				<th>Mes</th>
				<td><?php 
				
				if($mes=="01"){
					echo "Enero";
				}
				if($mes=="02"){
					echo "Febrero";
				}
				if($mes=="03"){
					echo "Marzo";
				}
				if($mes=="04"){
					echo "Abril";
				}
				if($mes=="05"){
					echo "Mayo";
				}
				if($mes=="06"){
					echo "Junio";
				}
				if($mes=="07"){
					echo "Julio";
				}
				if($mes=="08"){
					echo "Agosto";
				}
				if($mes=="09"){
					echo "Setiembre";
				}
				if($mes=="10"){
					echo "Octubre";
				}
				if($mes=="11"){
					echo "Noviembre";
				}
				if($mes=="12"){
					echo "Diciembre";
				}
				
					if($mes=="todomes"){
					echo "Enero - Diciembre";
				}

				
				?></td>
			</tr>
	
					
			<tr>
				<th>Año</th>
				<td><?= @$anno ?></td>
			</tr>
			<tr>
				<th colspan="2">Ordenes</th>
			</tr>
			
			<tr>
				<th colspan="2">
				
				
				
				<table id="tablaPresentacion" style="width: 100%" border="1">
			<tr>
				<th>Nro.</th>
				<td>Nro. Orden</td>
				<td>SIAF</td>
				
				<td>Tipo Bien</td>
				<td>Fecha</td>
				<td>Concepto</td>
				<td>Total</td>
				
			</tr>
			
			
				
				<?php 
			
			$contador=0;
			$SUMAT=0;
			
			for($i=0;$i<count($listareporte);$i++){
			$contador++;
		
			
			//echo json_encode($listareporte);
			
		    ?>

			<tr>
			
				<td><?php echo $contador; ?></td>				
				<td><?php echo $listareporte[$i]['NRO_ORDEN']; ?></td>	
				<td><?php echo $listareporte[$i]['EXP_SIAF']; ?></td>	
				<td><?php echo $listareporte[$i]['TIPO_BIEN']; ?></td>	
				<td><?php echo $listareporte[$i]['FECHA_ORDEN']; ?></td>
				<td><?php echo $listareporte[$i]['CONCEPTO']; ?></td>
				<td><?php $SUMAT=$SUMAT+$listareporte[$i]['TOTAL_FACT_SOLES']; echo $listareporte[$i]['TOTAL_FACT_SOLES']; ?></td>	
				
			</tr>
			<?php } ?>
			
				<tr>
					<th colspan="5">
					<td>TOTAL</td>	
					<td><?php echo $SUMAT;?></td>	
				</tr>
			</table>
			
				
				
				
				
				
				</th>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
  		</table>
		<br/>
		
		<center><input type="image" src="http://www.adiadocentes.com.ar/userfiles/image/boton-imprimir.png" id="desaparece"  width="70px" height="35px" name="Imprimir" onclick="imprimir()"> </center>
		
		
  	</div>
</body>
</html>