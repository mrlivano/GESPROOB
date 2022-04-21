<style>
    .modal-dialog
    {
        width: 90%;
        margin: 0;
        margin-left: 5%;
        padding: 0;
    }

    .modal-content
    {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }
</style>
<div class="row">
	<div class="col-md-12 col-xs-12" style="height:600px;overflow:scroll;overflow-x: hidden;">
		<div class="x_panel">
			<div class="x_title">
				<!-- <h2><b>DETALLE DE PEDIDOS DE COMPRAS POR META</b> </h2> -->
				<?php $anio=0 ?>
				<?php foreach($listaDetallePorPedidoCompraMeta as $item ){ ?>
					<tr>
						<td>
							<?php  $anio = $item->ANO_EJE ;?>
						</td>
					</tr>
				<?php } ?>
				<div class="clearfix"></div>
				<label>AÑO :<?php  echo $anio ?></label>
				
						<br/>
						
									<label for="inputState">MES:</label>
									
							
					 <input type="hidden" id="nro_anno_r" name="nro_anno_r" value="<?php  echo $annio ?>">
					 <input type="hidden" id="nro_ue_r" name="nro_ue_r" value="<?php echo $uecod?>">
					 <input type="hidden" id="nro_meta_r" name="nro_meta_r" value="<?php  echo $meta ?>">
						 
						 
					<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
						      		
									<select name="nro_mes_r" id="nro_mes_r" class="form-control">
									 
									 
									 
									 <option value="01">Enero</option> 
									 <option value="02">Febrero</option> 
									 <option value="03">Marzo</option> 
									 <option value="04">Abril</option> 
									 <option value="05">Mayo</option> 
									 <option value="06">Junio</option> 
									 <option value="07">Julio</option> 
									 <option value="08">Agosto</option> 
									 <option value="09">Septiembre</option> 
									 <option value="10">Octubre</option> 
									 <option value="11">Noviembre</option> 
									 <option value="12">Diciembre</option> 
									 <option value="todomes">Todos los meses</option> 
				 
									</select>
									
						      		<span class="input-group-btn">
						        		<button id="ReportePedidosMesSumado" class="btn btn-success" type="button"><span class="glyphicon glyphicon glyphicon-save-file" style="    color: white;"> Generar Reporte </span></button>
						     		</span>
						    	</div>
						 	</div>
                         
						</div>
						
						
									
									


			</div>
			<div class="x_content">
				<div class="table-responsive">
					<table id="datatablePedidos" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<td>Nro Pedido</td>
								<td>Motivo pedido</td>
								<td>Fecha Pedido</td>
								<td>Tipo bien</td>
								<td>Tipo Pedido</td>
								<td>Estado</td>
								<td>Fecha Aprobado</td>
								<td>Fecha Atendido</td>
								<td>Fecha Reg.</td>
								<td>Equipo Reg.</td>
								<td>Fecha Reg. V.B.</td>
								<td>Equipo Reg. V.B.</td>
								<td>Personal</td>
								<td>Ver Estado</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach($listaDetallePorPedidoCompraMeta as $item ){ ?>
							<tr>
								<td>
									<button type="button" class="clasificador btn btn-primary btn-xs" onclick="detallepedidoPip(<?= (int)$item->NRO_PEDIDO?>,<?= (int)$item->ANO_EJE?>,<?= (int)$item->TIPO_PEDIDO?>,'<?=$item->TIPO_BIEN?>',<?= (int)$item->SEC_EJEC?>);"><?=$item->NRO_PEDIDO?><i class='ace-icon bigger-120'></i></button>
								</td>
								<td>
									<?=$item->MOTIVO_PEDIDO?>
								</td>
								<td>
									<?=($item->FECHA_PEDIDO!='' ? date('d/m/Y',strtotime($item->FECHA_PEDIDO)) : '')?>
								</td>
								<td>
									<?=$item->TIPO_BIEN?>
								</td>
								<td>
									<?=$item->TIPO_PEDIDO?>
								</td>
								<td>
									<?php switch ($item->ESTADO) {
										case 0:
											echo "PENDIENTE";
											break;
										case 1:
											echo "VB";
											break;
										case 2:
											echo "APROBADO";
											break;
										case 3:
											echo "DENEGADO";
											break;
										case 4:
											echo "PECOSA PARCIAL POR FIRMAR";
											break;
										case 5:
											echo "PECOSA PARCIAL";
											break;
										case 6:
											echo "PECOSA POR FIRMAR";
											break;
										case 7:
											echo "table-UnidadE";
											break;
									}?>
								</td>
								<td>
									<?=($item->FECHA_APROB!='' ? date('d/m/Y',strtotime($item->FECHA_APROB)) : '')?>
								</td>
								<td>
									<?=($item->FECHA_ATENC!='' ? date('d/m/Y',strtotime($item->FECHA_ATENC)) : '')?>
								</td>
								<td>
									<?=($item->FECHA_REG!='' ? date('d/m/Y H:i',strtotime($item->FECHA_REG)) : '')?>
								</td>
								<td>
									<?=$item->EQUIPO_REG?>
								</td>
								<td>
									<?=($item->fecha_reg_vb!='' ? date('d/m/Y H:i',strtotime($item->fecha_reg_vb)) : '')?>
								</td>
								<td>
									<?=$item->equipo_reg_vb?>
								</td>
								<td>
									<?=$item->personal?>
								</td>
								<td>
								<button type="button" class="clasificador btn btn-primary btn-xs" onclick="detallepedidoPip1(<?= (int)$item->NRO_PEDIDO?>,<?= (int)$item->ANO_EJE?>,<?= (int)$item->TIPO_PEDIDO?>,'<?=$item->TIPO_BIEN?>',<?= (int)$item->SEC_EJEC?>);">+<i class='ace-icon bigger-120'></i></button>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function()
	{
		$('#datatablePedidos').DataTable(
		{
			"language":idioma_espanol,
			"ordering":  false,
			"pageLength": 20,
			dom: 'Bfrtip',
			buttons:
			[
				{
					extend: 'pdf',
					text: "<span><i class='fa fa-file-pdf-o red''></i> PDF</span>",
					className : "btn btn-primary btn-sm",
					orientation:'landscape',
					title:'Pedidos',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 6, 7, 12]
					},
					customize: function(doc)
					{
						doc.defaultStyle.fontSize = 7;
					}
				},
				{
					extend: 'excel',
					text: "<span><i class='fa fa-file-excel-o green'></i> EXCEL</span>",
					className : "btn btn-primary btn-sm",
				}
			]
		});
		
		
		
		
		
		
		$('#ReportePedidosMesSumado').click(function() {
		 
		  var annos_j =$('#nro_anno_r').val();
		  var ue_j    =$('#nro_ue_r').val();
		  var meta_j   =$('#nro_meta_r').val();
		  var mes_j   =$('#nro_mes_r').val();
		  
		
		  
		  var a = document.createElement('a');
  a.target="_blank";
  a.href=base_url+"/ProyectoInversion/ReportePipPedidos?annos="+annos_j+"&ue="+ue_j+"&meta="+meta_j+"&mes="+mes_j;
  a.click();
  
  
		  
		});
	
									
									
		
		
		
	});

	function detalleordenexpsiaf(anio,expsiaf)
	{
		paginaAjaxDialogo(1, 'Detalle de Expediente Siaf por Orden de Compra',{anio:anio,expsiaf:expsiaf}, base_url+'index.php/PrincipalReportes/detalleOrdenExpSiaf', 'GET', null, null, false, true);
	}

	function detalleporcadanumorden(anio,tipobien,numorden,tipoppto)
	{
		paginaAjaxDialogo(2, 'Detalle por cada N° Orden',{anio:anio,tipobien:tipobien,numorden:numorden,tipoppto:tipoppto}, base_url+'index.php/PrincipalReportes/detallePorCadaNumOrden', 'GET', null, null, false, true);
	}


	function detallepedidoPip(nropedido,anio,tipopedido,tipobien, sec_ejec)
	{
		paginaAjaxDialogo(1, 'Detalle por pedido',{nropedido:nropedido,anio:anio,tipopedido:tipopedido,tipobien:tipobien, sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/detallePorCadaPedido', 'GET', null, null, false, true);
	}

	function detallepedidoPip1(nropedido,anio,tipopedido,tipobien, sec_ejec)
	{
		paginaAjaxDialogo(1, 'Detalle por pedido',{nropedido:nropedido,anio:anio,tipopedido:tipopedido,tipobien:tipobien, sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/detallePorCadaPedido1', 'GET', null, null, false, true);
	}

  	function estadoPedido(nropedido,anio,tipopedido,tipobien, sec_ejec)
	{
		paginaAjaxDialogo(1, 'Estado del pedido',{nropedido:nropedido,anio:anio,tipopedido:tipopedido,tipobien:tipobien, sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/estadoPedido', 'GET', null, null, false, true);
	}

  	function estadoPedidoShow(nropedido,anio,tipopedido,tipobien, sec_ejec)
	{
		paginaAjaxDialogo(1, 'Estado del pedido',{nropedido:nropedido,anio:anio,tipopedido:tipopedido,tipobien:tipobien, sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/estadoPedidoShow', 'GET', null, null, false, true);
	}
</script>
