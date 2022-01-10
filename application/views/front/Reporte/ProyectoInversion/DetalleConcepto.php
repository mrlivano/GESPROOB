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

	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px;
}
</style>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<?php $anio = 0?>
				<?php foreach ($listaPorOrden as $item) {?>
					<tr>
						<td>
							<?php $anio = $item->ANO_EJE;?>
						</td>
					</tr>
				<?php }?>
				<div class="clearfix"></div>
				<label>AÑO :<?php echo $anio ?></label>
				<label>META :<?php echo $meta ?></label>
				<label>UE :<?php echo $sec_ejec ?></label>
				
				<br/>
				
						
									<label for="inputState">MES:</label>
									
							
					 <input type="hidden" id="nro_anno_r" name="nro_anno_r" value="<?php  echo $anio ?>">
					 <input type="hidden" id="nro_meta_r" name="nro_meta_r" value="<?php echo $meta?>">
					 <input type="hidden" id="nro_ue_r" name="nro_ue_r" value="<?php  echo $sec_ejec ?>">
					 
						 
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
						        		<button id="ReportePedidosMesSumadoOrden" class="btn btn-success" type="button"><span class="glyphicon glyphicon glyphicon-save-file" style="    color: white;"> Generar Reporte</span></button>
						     		</span>
						    	</div>
						 	</div>
                         
						</div>
						
						
				
				
			</div>
			<div class="x_content">
				<div class="table-responsive">
					<table style="width:100%" id="tableConcepto" class="table table-bordered table-striped nowrap">
						<thead>
							<tr>
								<th>Exp SIAF</th>
								<th>No Orden</th>
								<th>Detalle</th>
								<th>Concepto</th>
								<th>Sub total S/.</th>
								<th>Total IGV S/.</th>
								<th>Total Fact S/.</th>
								<th>Tipo Bien</th>
								<th>Fecha de Orden</th>
								<th>Doc Referencia</th>
								<th>Exp SIGA</th>
								<th>Proveedor</th>
								<th>Dirección</th>
								<th>Giro General</th>
								<th>Nro RUC</th>
								<th>Teléfonos</th>
								<th>CCI</th>
								<th>Teléfono Fax</th>
								<th>Año Eje</th>
								<th>Tipo Ppto</th>
                <th>Conformidad</th>
                <th>Orden</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($listaPorOrden as $item) {?>
							<tr>
								<td>
									<button type="button" class="DetalleOrdenExpeSiaf btn btn-primary btn-xs" onclick="detalleordenexpsiaf(<?=(int) $item->ANO_EJE?>,<?=(int) $item->EXP_SIAF?>, <?=(int) $item->SEC_EJEC?>);"><i class="glyphicon glyphicon-refresh"></i> <?=$item->EXP_SIAF?>
									</button>
								</td>
								<td style="text-align:right;">
									<button type="button" class="DetalleOrdenExpeSiaf btn btn-success btn-xs" onclick="detalleporcadanumorden(<?=(int) $item->ANO_EJE?>,'<?=$item->TIPO_BIEN?>',<?=(int) $item->NRO_ORDEN?>,<?=(int) $item->TIPO_PPTO?>,<?=(int) $item->SEC_EJEC?>);"><?=$item->NRO_ORDEN?><i class='ace-icon bigger-120'></i>
									</button>
								</td>
								<td>
									<button type="button" class="DetalleConceptoOrdem btn btn-warning btn-xs" onclick="conceptoDetalladoOrden(<?=(int) $item->NRO_ORDEN?>,'<?=$item->TIPO_BIEN?>', <?=(int) $item->ANO_EJE?>,<?=(int) $item->SEC_EJEC?>);"><?=$item->NRO_ORDEN?>
									</button>
								</td>
								<td style="width:20%;">
									<?=$item->CONCEPTO?>
								</td>
								<td style="text-align:right;">
									<?=number_format($item->SUBTOTAL_SOLES, 2)?>
								</td>
								<td style="text-align:right;">
									<?=number_format($item->SUBTOTAL_SOLES, 2)?>
								</td>
								<td style="text-align:right;">
									<?=number_format($item->TOTAL_FACT_SOLES, 2)?>
								</td>
								<td>
									<?=$item->TIPO_BIEN?>
								</td>
								<td>
									<?=($item->FECHA_ORDEN!='' ? date('d/m/Y',strtotime($item->FECHA_ORDEN)) : '')?>
								</td>
								<td>
									<?=$item->DOCUM_REFERENCIA?>
								</td>
								<td>
									<?=$item->EXP_SIGA?>
								</td>
								<td>
									<?=$item->NOMBRE_PROV?>
								</td>
								<td>
									<?=$item->DIRECCION?>
								</td>
								<td>
									<?=$item->GIRO_GENERAL?>
								</td>
								<td>
									<?=$item->NRO_RUC?>
								</td>
								<td>
									<?=$item->TELEFONOS?>
								</td>
								<td>
									<?=$item->CCI?>
								</td>
								<td>
									<?=$item->TELEFONO_FAX?>
								</td>
								<td>
									<?=$item->ANO_EJE?>
								</td>
								<td>
									<?=$item->TIPO_PPTO?>
								</td>
                <td>
                  <button type="button" class="btn btn-primary btn-xs" onclick="conformidadPedido(<?=$item->NRO_ORDEN?>);"><i class="glyphicon glyphicon-open-file"></i></button>
								</td>
                <td>
                  <button type="button" class="btn btn-primary btn-xs" onclick="ordenServicio(<?=$item->NRO_ORDEN?>);"><i class="glyphicon glyphicon-open-file"></i></button>
								</td>
							</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="conformidadModal" tabindex="-1" role="dialog" aria-labelledby="conformidadModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Conformidad de servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="conformidadForm" class="feedback" name="feedback">
      <div class="modal-body">
        <div class="form-group">
          <label for="conformidadFile">Subir archivo.</label>
          <input type="file" class="form-control-file" name="conformidadFile" id="conformidadFile">
          <input type="hidden" name="nro_orden" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default custom-close">Cerrar</button>
        <button class="btn btn-primary" id="send" type="submit">Guardar</button>
      </div>
      </form>
      <div class="form-group">
        <div class="col-sm-10">
          <button class="btn btn-default custom-close">Cerrar</button>
          <button class="btn btn-primary" id="send" type="submit">Guardar</button>
        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-info" id="myBtn" data-toggle="modal" data-target="#my_modal">Historial de Pedido</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

$('#conformidadModal').on('show.bs.modal', function(e) {
    var userid = $(e.relatedTarget).data('userid');
    $(e.currentTarget).find('input[name="user_id"]').val(userid);
});

$('#conformidadModal').on('shown.bs.modal', function () {
    $('#conformidadFile').focus();
});

$(function () {
    $(".custom-close").on('click', function() {
        $('#conformidadModal').modal('hide');
    });
});

var base_url = '<?php echo base_url(); ?>';

			$("#conformidadForm").submit(function(event)
			{
					event.preventDefault();

					var formData=new FormData($("#conformidadForm")[0]);

					$.ajax({
							url: base_url+"index.php/ProyectoInversion/addConformidad",
							type:'POST',
							enctype: 'multipart/form-data',
							data:formData,
							cache: false,
							contentType:false,
							processData:false,
							success:function(resp)
							{
								swal("Bien!", "Se registro correctamente!", "success");
							},
							error: function ()
							{
									swal("Error", "Usted no tiene permisos para realizar esta acción", "error");
							}
					});
			});

	$(document).ready(function()
	{
		var myTable=$('#tableConcepto').DataTable(
		{
			"language" : idioma_espanol,
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
					title:'Orden de Servicio',
					exportOptions: {
						columns: [ 0, 1, 3, 5, 7, 11, 14]
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
		
		
		
		
			$('#ReportePedidosMesSumadoOrden').click(function() {
		 
		 
		
		  var annos_j =$('#nro_anno_r').val();
		  var ue_j    =$('#nro_ue_r').val();
		  var meta_j   =$('#nro_meta_r').val();
		  var mes_j   =$('#nro_mes_r').val();
		  

		  var a = document.createElement('a');
		  a.target="_blank";
		  a.href="http://sigeiapp.regionapurimac.gob.pe/ProyectoInversion/ReportePipOrdenesGeneral?annos="+annos_j+"&ue="+ue_j+"&meta="+meta_j+"&mes="+mes_j;
		  a.click();
  
  
  
		  
		});
		
		
		
		
		
		
		
	});

	function detalleordenexpsiaf(anio,expsiaf, sec_ejec)
	{
		paginaAjaxDialogo('detalleExpSiaf', 'Consulta de Expediente Administrativo',{anio:anio,expsiaf:expsiaf,sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/detalleOrdenExpSiaf', 'GET', null, null, false, true);
	}

	function detalleporcadanumorden(anio,tipobien,numorden,tipoppto, sec_ejec)
	{
		paginaAjaxDialogo(2, 'Detalle por cada N° Orden',{anio:anio,tipobien:tipobien,numorden:numorden,tipoppto:tipoppto, sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/detallePorCadaNumOrden', 'GET', null, null, false, true);
	}

	function conceptoDetalladoOrden(numorden,tipobien,anio, sec_ejec)
	{
		paginaAjaxDialogo(3, 'Especificación de Orden',{anio:anio,tipobien:tipobien,numorden:numorden, sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/especificacionOrden', 'GET', null, null, false, true);
	}

  function conformidadPedido(nro_orden)
  {
    paginaAjaxDialogo(1, 'Conformidad de Orden',{nro_orden:nro_orden}, base_url+'index.php/PrincipalReportes/conformidadPedido', 'GET', null, null, false, true);
  }

  function ordenServicio(nro_orden)
  {
    paginaAjaxDialogo(1, 'Orden de Servicio',{nro_orden:nro_orden}, base_url+'index.php/PrincipalReportes/ordenServicio', 'GET', null, null, false, true);
  }
</script>
