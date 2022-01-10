<style>
	.table-consolidadoAvance{
		width: 100%;

	}
	
	.alineacionDerecha
	{
		text-align: right;
	}
	.tablaRelevante td
	{
		background-color:#f0f4f5;
	}
</style>
<style>
  .dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    left: 100%;

}
.dropdown:hover {
}
.trElement li
{
  list-style:none;
   border: 1px solid #D8D8D8;
   padding-top: 6px;
   padding-left: 5px;
  padding-bottom: 5px;
  background-color: #F2F2F2;
}
.nivel
{
  color: #73879C;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 12px;
    font-weight: 400;
    line-height: 1.471;
 
}
 .all 
    {
      margin-bottom: 0;
      margin-right: 0;
      width: 100%;
    }
    .tfoot{
    	background-color:#f2f2f2; 
    }
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h5><b>REPORTE GENERAL DE AVANCE FISICO Y FINANCIERO</b></h5>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

<?php if( $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9 ) { ?>
													
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12">
						<button style="width: 100%;" class="btn btn-success btn-xs" type="button" onclick="ImportarGasto();">Gasto </button>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12">
						<button style="width: 100%;" class="btn btn-info btn-xs" type="button" onclick="ImportarExpedienteMeta();">Meta Expediente </button>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12">
						<button style="width: 100%;" class="btn btn-warning btn-xs" type="button" onclick="ImportarExpedientes();">Expedientes</button>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<a href="javascript:siafActualizadorCertificado()">
							<button style="width: 100%;" id="BtnAcatualizar" class="btn btn-primary btn-xs" type="button"><i class="glyphicon glyphicon-refresh"></i> SIAF</button>
						</a>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<a href="javascript:siafActualizadorDatosGenerales()">
							<button style="width: 100%;" id="BtnAcatualizarDatosGenerales" class="btn btn-success btn-xs" type="button"><i class="glyphicon glyphicon-refresh"></i> Datos Año</button>
						</a>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12">
						<div class="form-group">
					    	<label>Año Meta</label>
							<input type="text" id="BuscarPipAnio" name="BuscarPipAnio" value="<?=$anio?>" placeholder="Año" class="form-control">
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Unidad Ejecutora</label>
							<select id="opcion_ue" class="form-control">
								<?php foreach ($lista_ue as $row) {
									if ($row->codigo_ue=='747' || $row->codigo_ue=='748' || $row->codigo_ue=='1546' || $row->codigo_ue=='1359' ) { ?>
										<option value="<?=trim($row->sec_ejec)?>" <?php echo (trim($unidadEjecutora)==trim($row->sec_ejec) ? 'selected' : ''); ?>><?=$row->unidad_ejec?></option>
								<?php } } ?>
							</select>
						</div>						
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Tipo Proyecto</label>
							<select id="opcion_tipo_proyecto" class="form-control" required="">
									<?php foreach ($lista_tipos as $row) {?>
										<option value="<?=trim($row->tipo_proyecto)?>" <?php if (trim($row->tipo_proyecto)==$tipoProyecto) {
											echo 'selected="selected"';
										} ?> > <?php echo (empty(trim($row->tipo_proyecto)) ? 'TODOS' : $row->tipo_proyecto);?></option>
									<?php } ?>
							</select>
						</div>						
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12">
						<label>.</label>
					    <span class="input-group-btn">
							<button id="AnioPip" class="btn btn-default " type="button"><span class="glyphicon glyphicon-search"> Buscar</span></button>									
						</span>
					</div>					
				</div>
				
				<?php } ?>	

					<div class="table-responsive">
					<br>
						
						<br>
					</div>

					<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#tab_datosproyectoporgerencia"  id="home-tab1" role="tab" data-toggle="tab" aria-expanded="true">Datos de Proyectos por Gerencia</a>
							</li>
							<li role="presentation">
								<a href="#tab_datosporoficina"  id="home-tab2" role="tab" data-toggle="tab" aria-expanded="true">Datos por Oficina</a>
							</li>                   
						</ul>

					<div id="myTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="tab_datosproyectoporgerencia" aria-labelledby="home-tab">
							<br>
							<div class="row" style="margin-left: 10px; margin:10px; ">
								<div class="panel panel-default">
												
									<div id="EjecucionAnual">
										<div class="pull-right tableTools-container-avanceOficina"></div>
										
										<table id="table-avanceOficina"class="table table-striped table-bordered tablaGenerica tablaRelevante" cellspacing="0" width="100%" >
							<thead>
								<tr>
									<th>Gerencia</th>
									<th>Proyectos</th>
									<th>Costo Total</th>
									<th>PIM Total</th>
									<th>Certificado Total</th>
									<th>Avance PIM Certificado Total</th>
									<th>Devengado Total</th>
									<th>Avance PIM Devengado Total</th>
									<th>Seguimiento Total</th>
									<th>Por Gastar Total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($dataArray as $key => $value) { ?>
								<tr>
							  		<td>
							  			<?=  $value['gerencia'] ?>
							  		</td>
							  		<td align="center">
							  			<?= $value['cantidadProyectos'] ?>
							  		</td>
							    	<td align="center">
							    		S/<?=a_number_format($value['costo_total'], 2, '.', ",", 3)?>
							    	</td>
									<td align="center">
										S/<?=a_number_format($value['PIM_Acumulado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($value['Certificado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($value['Avance_PIM_Certificado_Total'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($value['Devengado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($value['Avance_PIM_Devengado_Total'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($value['Seguimiento_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($value['Por_Gastar_Total'], 2, '.', ",", 3)?>
									</td>
							  	</tr>
							 <?php  } ?>
							</tbody>
							<tfoot>
								<tr style="font-weight: bold; color: #a5a7b6; ">
									
							  		<td >
							  			<?=  $sinOficina['sinOficina'] ?>
							  		</td>
							  		<td align="center">
							  			<?= $sinOficina['cantidadProyectosNO'] ?>
							  		</td>
							    	<td align="center">
							    		S/<?=a_number_format($sinOficina['costo_totalNO'], 2, '.', ",", 3)?>
							    	</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['PIM_Acumulado_TotalNO'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['Certificado_TotalNO'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($sinOficina['Avance_PIM_Certificado_TotalNO'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['Devengado_TotalNO'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($sinOficina['Avance_PIM_Devengado_TotalNO'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['Seguimiento_TotalNO'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['Por_Gastar_TotalNO'], 2, '.', ",", 3)?>
									</td>
							  	
								</tr>
								<tr style="font-weight: bold; color:#000000">
									
							  		<td >
							  			<?=  $datatotal['gerencia'] ?>
							  		</td>
							  		<td align="center">
							  			<?= $datatotal['cantidadProyectos'] ?>
							  		</td>
							    	<td align="center">
							    		S/<?=a_number_format($datatotal['costo_total'], 2, '.', ",", 3)?>
							    	</td>
									<td align="center">
										S/<?=a_number_format($datatotal['PIM_Acumulado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($datatotal['Certificado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($datatotal['Avance_PIM_Certificado_Total'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($datatotal['Devengado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($datatotal['Avance_PIM_Devengado_Total'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($datatotal['Seguimiento_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($datatotal['Por_Gastar_Total'], 2, '.', ",", 3)?>
									</td>
							  	
								</tr>
							</tfoot>
						</table>	
									</div>
								</div>
								</div>
							</div>
	<div role="tabpanel" class="tab-pane fade" id="tab_datosporoficina" aria-labelledby="home-tab">
	<div class="row" style="margin-left: 10px; margin:10px; ">
		<div class="panel panel-default">
							
			<div id="EjecucionAnual">
				<!---combos para listar proyectos-->
	            <div id="divListaAnalisisUnitario">
				<?php 
				foreach($listaNivel1 as $value){ ?>
				<div class="panel-group" style="margin: 2px;">
					<div class="panel panel-default">
						<div type='button'  class='btn btnf btn-xs fa fa-chevron-right' id="btnAccion" name="1" value="+" onclick="elegirAccion('<?=$value->id_oficina?>', this);">
						</div>
							<a data-toggle="collapse" href="#collapse<?=$value->id_oficina?>"><?=html_escape($value->denom_oficina)?></a>
						<div id="collapse<?=$value->id_oficina?>" class="panel-collapse collapse" >


						<!--- llenar los totales de los poryectos por gerencia-->
							<table id="table-avanceOficina"class="table table-striped table-bordered tablaGenerica tablaRelevante" cellspacing="0" width="100%" >
								<thead>
									<tr>
										<th>Proyectos</th>
										<th>Costo Total</th>
										<th>PIM Total</th>
										<th>Certificado Total</th>
										<th>Avance PIM Certificado Total</th>
										<th>Devengado Total</th>
										<th>Avance PIM Devengado Total</th>
										<th>Seguimiento Total</th>
										<th>Por Gastar Total</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($dataArray as $key => $value1) { if($value1['gerencia']==$value->denom_oficina){?>
								<tr>
							  		<td align="center">
							  			<button data-toggle="collapse" href="#collapses<?=$value->id_oficina?>" name='-' onclick="proyectosPorOficina('<?=$value->id_oficina?>',this);" ><?= $value1['cantidadProyectos'] ?></button>
							  		</td>
							    	<td align="center">
							    		S/<?=a_number_format($value1['costo_total'], 2, '.', ",", 3)?>
							    	</td>
									<td align="center">
										S/<?=a_number_format($value1['PIM_Acumulado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($value1['Certificado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($value1['Avance_PIM_Certificado_Total'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($value1['Devengado_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($value1['Avance_PIM_Devengado_Total'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($value1['Seguimiento_Total'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($value1['Por_Gastar_Total'], 2, '.', ",", 3)?>
									</td>
							  	</tr>
							 <?php } } ?>
							</tbody>
							</table>
							<div id="collapses<?=$value->id_oficina?>" class="panel-collapse collapse">
								<br>  
							</div>
						</div>

					</div>
				</div>
				                 <!---fin combos para listar proyectos-->
<?php } ?>
<div class="panel panel-default">
						<div type='button'  class='btn btnf btn-xs fa fa-chevron-right' id="btnAccion" name="1" >
						</div>
							<a data-toggle="collapse" href="#collapseSINOFI">PROYECTOS SIN OFICINA</a>
						<div id="collapseSINOFI" class="panel-collapse collapse" >
							<table id="table-avanceOficina"class="table table-striped table-bordered tablaGenerica tablaRelevante" cellspacing="0" width="100%" >
								<thead>
									<tr>
										<th>Proyectos</th>
										<th>Costo Total</th>
										<th>PIM Total</th>
										<th>Certificado Total</th>
										<th>Avance PIM Certificado Total</th>
										<th>Devengado Total</th>
										<th>Avance PIM Devengado Total</th>
										<th>Seguimiento Total</th>
										<th>Por Gastar Total</th>
									</tr>
								</thead>
								<tbody>
								
								<tr style="font-weight: bold;  ">
									
							  		<td align="center">
							  			<button data-toggle="collapse" href="#collapseSINOFI2" name='-'><?= $sinOficina['cantidadProyectosNO'] ?></button>
							  		</td>
							    	<td align="center">
							    		S/<?=a_number_format($sinOficina['costo_totalNO'], 2, '.', ",", 3)?>
							    	</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['PIM_Acumulado_TotalNO'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['Certificado_TotalNO'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($sinOficina['Avance_PIM_Certificado_TotalNO'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['Devengado_TotalNO'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										<?=a_number_format($sinOficina['Avance_PIM_Devengado_TotalNO'], 2, '.', ",", 3)?>%
									</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['Seguimiento_TotalNO'], 2, '.', ",", 3)?>
									</td>
									<td align="center">
										S/<?=a_number_format($sinOficina['Por_Gastar_TotalNO'], 2, '.', ",", 3)?>
									</td>
							
							</tbody>
							</table>
							<div id="collapses<?=$value->id_oficina?>" class="panel-collapse collapse">
								<br>  
							</div>
							<div id="collapseSINOFI2" class="panel-collapse collapse">
								<br>
								
								<table id="table-avanceOficina"class="table table-striped table-bordered tablaGenerica tablaRelevante" cellspacing="0" width="100%" >
								<thead>
									<tr>
										<th>N°</th>
										<th>Codigo Unico</th>
										<th>Meta</th>
										<th>Nombre Proyecto</th>
										<th>PIA</th>
										<th>PIM</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								   $i=0;
									foreach ($datasinofi as $key => $value) { ?>
									<tr>
										<td><?= $i+=1; ?></td>								
										<td><button onclick="modalDetallesProyecto('<?= $value->act_proy ?>','<?= $value->sec_func ?>')"><?= $value->act_proy ?></button></td>
										<td><button onclick="window.location.href='ReporteBuscadorPorPip?codigo=<?= $value->act_proy ?>'"><?= $value->sec_func ?></button></td>
										<td><?= $value->nombre ?></td>
										<td>S/<?= a_number_format(0+$value->pim_acumulado, 2, '.', ",", 3) ?></td>
										<td>S/<?= a_number_format(0+$value->pim, 2, '.', ",", 3) ?></td>
										</tr>
								<?php } ?>	
								</tbody>
								</table>
							</div>
						</div>
					</div>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<script>
$(document).on("ready" ,function(){

                Lista();/*llamar a mi datatablet listar funcion*/
         });

var Lista=function()
{
    var myTable1=$("#table-avanceOficina").DataTable({
    "processing":true,
    "serverSide":false,
    displayLength: 15,
    destroy:true,
    "language":idioma_espanol
    });
        new $.fn.DataTable.Buttons( myTable1, {
          buttons: [
            {
            extend: 'excel',
            title: 'Consolidado Total de Proyectos por Oficina',
            text: "<i class='fa fa-file-excel-o bigger-110 green'></i> <span style='color:white'>Excel</span>",
            className: 'btn btn-white btn-primary btn-bold',
            footer:'true',
            filename:"Proyectos por Gerencia",
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        	},
            {
            extend: "pdf",
            title: 'Consolidado Total de Proyectos por Oficina',
            text: "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span style='color:white'>PDF</span>",
            className: 'btn btn-white btn-primary btn-bold',
            footer:'true',
            filename:"Proyectos Gerencia",
            exportOptions: {
                modifier: {
                    page: 'current'
  
						},
            orientation: 'landscape'
       		 }
    		}
            
          ],
        } );        
        myTable1.buttons().container().appendTo( $('.tableTools-container-avanceOficina') );
       }

function avanceFisico()
{
	$("#avancefisicoFinan").show(2000);

	var anio=$("#BuscarPipAnio").val();
	var sec_ejec = $("#opcion_ue").val();
	var	tipo_proyecto = $("#opcion_tipo_proyecto").val();
	window.location.href=base_url+"index.php/ProyectoInversion/ReporteBuscadorPorAnio?anio="+anio+"&sec_ejec="+sec_ejec+"&tipo_proyecto="+tipo_proyecto;
}

function siafActualizadorCertificado()
{
    var anio = $("#BuscarPipAnio").val();
    var sec_ejec = $("#opcion_ue").val();
	var start = +new Date();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url: ups_url + "/Importacion/anio/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
		contentType:false,
		processData:false,
		beforeSend: function(request) {
			renderLoading();
		},
		success:function(data){
			$('#divModalCargaAjax').hide();
			datos=JSON.parse(data);
			var rtt = +new Date() - start;

			if(datos.actualizo)
			{
				swal(
					'Operacion Completada',
					datos.mensaje + ' Tiempo: ' + (rtt/1000) +'s',
					'success'
				);
			}
			else
			{
				swal(
					'No se pudo completar la Operacion',
					datos.mensaje + ' Tiempo: ' + (rtt/1000) +'s',
					'error'
				);
			}
		},
		error: function (xhr, textStatus, errorMessage) 
		{
			$('#divModalCargaAjax').hide();
			swal(
					'ERROR!',
					'Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419',
					'error'
				);
		}
	});
}

function siafActualizadorDatosGenerales()
{
    var anio = $("#BuscarPipAnio").val();
	var start = +new Date();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url: ups_url + "/DatosGenerales/importar/"+anio,
		type: "POST",
		cache: false,
		contentType:false,
		processData:false,
		beforeSend: function(request) 
		{
			renderLoading();
		},
		success:function(data)
		{
			$('#divModalCargaAjax').hide();
			datos=JSON.parse(data);
			var rtt = +new Date() - start;
			if(datos.actualizo)
			{
				swal(
					'Operacion Completada',
					datos.mensaje + ' Tiempo: ' + (rtt/1000) +'s',
					'success'
				);
			}
			else
			{
				swal(
					'No se pudo completar la Operacion',
					datos.mensaje + ' Tiempo: ' + (rtt/1000) +'s',
					'error'
				);
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
			$('#divModalCargaAjax').hide();
			swal(
				'ERROR!',
				'Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419',
				'error'
			);
		}
	});
}


function ImportarExpedienteMeta()
{
	var anio = $("#BuscarPipAnio").val();
	var sec_ejec = $("#opcion_ue").val();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url: ups_url + "/Expediente/expediente_meta/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
        contentType:false,
        processData:false,
		beforeSend: function(request)
		{
		    renderLoading();
		},
		success:function(data)
		{
			$('#divModalCargaAjax').hide();
			datos=JSON.parse(data);

			if(datos.actualizo)
			{
				swal('Operacion Completada',datos.mensaje,'success');
			}
			else
			{
				swal('No se pudo completar la Operacion',datos.mensaje,'error');
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
	        $('#divModalCargaAjax').hide();
	        swal('ERROR!','Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419','error'
				);
	    }
	});
}


function ImportarExpedientes()
{
	var anio = $("#BuscarPipAnio").val();
	var sec_ejec = $("#opcion_ue").val();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url:ups_url+"/Expediente/expedienteGeneral/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
        contentType:false,
        processData:false,
		beforeSend: function(request)
		{
		    renderLoading();
		},
		success:function(data)
		{
			$('#divModalCargaAjax').hide();
			datos=JSON.parse(data);

			if(datos.actualizo)
			{
				swal('Operacion Completada',datos.mensaje,'success');
			}
			else
			{
				swal('No se pudo completar la Operacion',datos.mensaje,'error');
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
	        $('#divModalCargaAjax').hide();
	        swal('ERROR!','Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419','error'
				);
	    }
	});
}

function ImportarGasto()
{
	var anio = $("#BuscarPipAnio").val();
	var sec_ejec = $("#opcion_ue").val();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	// alert("HOLA");

	$.ajax({
		url:ups_url+"/Expediente/gastoGeneral/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
        contentType:false,
        processData:false,
		beforeSend: function(request)
		{
		    renderLoading();
		},
		success:function(data)
		{
			$('#divModalCargaAjax').hide();
			datos=JSON.parse(data);

			if(datos.actualizo)
			{
				swal('Operacion Completada',datos.mensaje,'success');
			}
			else
			{
				swal('No se pudo completar la Operacion',datos.mensaje,'error');
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
	        $('#divModalCargaAjax').hide();
	        swal('ERROR!','Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419','error');
	    }
	});
}
function MostrarSubLista(id_oficina,element)
{
  $.ajax(
  {
    type: "POST",
    url: base_url+"index.php/OficinaR/cargarNivel",
    cache: false,
    data: { id_oficina: id_oficina},

    success: function(resp)
    {
      var obj=JSON.parse(resp);
	  
      if(obj.length==0)
      {
        return false;
      }
      var htmlTemp='<ul>';
      for(var i=0; i<obj.length; i++)
      {
        if(obj[i].hasChild == false)
        {
          htmlTemp+='<div class="panel panel-default">'+
          '<div></div>'+
          '<a data-toggle="collapse" href="#collapse'+obj[i].id_oficina+'" name="-" onclick="mostraroficinas('+obj[i].id_oficina+', this)">'+obj[i].denom_oficina+'</a>'+
         "<div class='btn-group pull-right'></div>"+
         '<div id="collapse'+obj[i].id_oficina+'" class="panel-collapse collapse on">'+
						'</div>'+
          '</div>';
        }
        else
        {
        htmlTemp+='<div class="panel panel-default">'+
        '<div type="button"  class="btn btnf btn-xs fa fa-chevron-right" id="btnAccion" name="1" value="+" onclick="elegirAccion('+obj[i].id_oficina+', this);"></div>'+

        '<a data-toggle="collapse" href="#collapse'+obj[i].id_oficina+'" name="-" onclick="mostraroficinas('+obj[i].id_oficina+', this)">'+obj[i].denom_oficina+'</a>'+
         "<div class='btn-group pull-right'></div>"+
         '<div id="collapse'+obj[i].id_oficina+'" class="panel-collapse collapse on" >'+
						'</div>'+
        '</div>';
        }       
      }

      htmlTemp+='</ul>';
      $(element).parent().append(htmlTemp);                                         
    }
});
}

function mostraroficinas(id_oficina,element){
var opcion =  $(element).attr('name');
if(opcion=='-'){
	mostrarTotalOficinas(id_oficina,element);
	$(element).attr('name','+')
}
}
	
function ContraerSubLista(element)
{
  $(element).parent().find('>ul').remove();
}
function elegirAccion(id_oficina, element)
{
  var valueButton =  $(element).attr('value');
  var clase=$(element).attr('class');
  if(valueButton == '+')
  {
    MostrarSubLista(id_oficina,element);
    $(element).attr('value','-');
    $(element).attr('class','btn btn-xs fa fa-chevron-down');
  }
  else
  {
    ContraerSubLista(element);
    $(element).attr('value','+');
    $(element).attr('class','btn btn-xs fa fa-chevron-right');
  } 
}
function mostrarDeRaizPIP(codigo)
{
    paginaAjaxDialogo(null, 'Proyectos de Inversion', {codigo: codigo}, base_url+'index.php/ProyectoInversion/editar', 'GET', null, null, false, true);
}

function mostrarTotalOficinas(id_oficina,element)
{
	var anio=$("#BuscarPipAnio").val();
    var sec_ejec = $("#opcion_ue").val();
    var tipo_proyecto = $("#opcion_tipo_proyecto").val();	
	$.ajax(
  {
    type: "POST",
    url: base_url+"index.php/ProyectoInversion/ReportePorOficina",
    cache: false,
    data: { id_oficina: id_oficina, anio:anio, sec_ejec:sec_ejec, tipo_proyecto:tipo_proyecto},

    success: function(resp)
    {
      var obj=JSON.parse(resp);
      if(obj[0].proys!=0){
    	html='<table id="table-avanceOficina"class="table table-striped table-bordered tablaGenerica tablaRelevante" cellspacing="0" width="100%" >'+
							'<thead>'+
								'<tr>'+
									'<th>Proyectos</th>'+
									'<th>Costo Total</th>'+
									'<th>PIM Total</th>'+
									'<th>Certificado Total</th>'+
									'<th>Avance PIM Certificado Total</th>'+
									'<th>Devengado Total</th>'+
									'<th>Avance PIM Devengado Total</th>'+
									'<th>Seguimiento Total</th>'+
									'<th>Por Gastar Total</th>'+
								'</tr>'+
							'</thead>'+
							'<tbody>'+
									'<tr>'+
											'<td><button data-toggle="collapse" href="#collapses'+id_oficina+'" name="-" onclick="proyectosPorOficina('+id_oficina+',this);" >'+obj[0].proys+'</button></td>'+
											'<td>'+obj[0].costo_total+'</td>'+
											'<td>'+obj[0].pim_acumulado+'</td>'+
											'<td>'+obj[0].monto_certificado+'</td>'+
											'<td>'+obj[0].avance_pim_cert+'</td>'+
											'<td>'+obj[0].devengado+'</td>'+
											'<td>'+obj[0].avance_pim_devengado+'</td>'+
											'<td>'+obj[0].para_seguimiento+'</td>'+
											'<td>'+obj[0].saldo_por_gastar+'</td>'+
										'</tr>'+
							'</tbody>'+
							'</table>'+
							'<div id="collapses'+id_oficina+'" class="panel-collapse collapse">'+
								'<br>'+  
							'</div>';
						}
		else{
			html='<table id="table-avanceOficina"class="table table-striped table-bordered tablaGenerica tablaRelevante" cellspacing="0" width="100%" >'+
							'<tbody>'+
									'<tr><td>La oficina no Cuenta con proyectos</td>' +
											
										'</tr>'+
							'</tbody>'+
							'</table>';
		}

    	$($(element).parent().find('div')[2]).append(html);              

    }
});
}
function proyectosPorOficina(id_oficina,element)
{
	var opcion=$(element).attr('name');
	if(opcion=='-')
	{	
		$(element).attr('name','+');
	
	var anio=$("#BuscarPipAnio").val();
    var sec_ejec = $("#opcion_ue").val();
    var tipo_proyecto = $("#opcion_tipo_proyecto").val();
    
	$.ajax(
  {
    type: "POST",
    url: base_url+"index.php/ProyectoInversion/proyectosPorOficina",
    cache: false,
    data: { id_oficina: id_oficina, anio:anio, sec_ejec:sec_ejec, tipo_proyecto:tipo_proyecto},

    success: function(resp)
    {
      var obj=JSON.parse(resp);

    	var html='<table id="table-avanceOficina"class="table table-striped table-bordered tablaGenerica tablaRelevante" cellspacing="0" width="100%" >'+
								'<thead>'+
									'<tr>'+
										'<th>N°</th>'+
										'<th>Codigo Unico</th>'+
										'<th>Meta</th>'+
										'<th>Nombre Proyecto</th>'+
										'<th>PIA</th>'+
										'<th>PIM</th>'+
									'</tr>'+
								'</thead>'+
								'<tbody>';
								for (var i = 0; i < obj.length; i++) {

									html+='<tr>'+
										'<td>'+(i+1)+'</td>'+									
										'<td><button onclick="modalDetallesProyecto(\''+obj[i].act_proy+'\',\''+obj[i].sec_func+'\')">'+obj[i].act_proy+'</button></td>'+
										'<td><button onclick="window.open(\'ReporteBuscadorPorPip?codigo='+obj[i].act_proy+'\',\'_blanck\');">'+obj[i].sec_func+'</button></td>'+
										'<td>'+obj[i].nombre+'</td>'+
										'<td> S/'+obj[i].pim_acumulado.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
										'<td> S/'+obj[i].pim.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</td>'+
										'</tr>'+
									
							'</tbody>';
						}
							html+='</table>';
							
    	$($(element).parent().parent().parent().parent().parent().find('div')[0]).append(html);             

    }
});
}
}

function modalDetallesProyecto(act_proy,sec_func)
{   
	var anio=$("#BuscarPipAnio").val();
	paginaAjaxDialogo(null, 'Datos Generales y Detalle De Proyectos de Inversion',{ sec_func:sec_func,act_proy:act_proy,anio:anio}, base_url+'index.php/ProyectoInversion/detalladoProyectoInversion', 'GET', null, null, false, true);
}
var filtrarPIPs = function(idUnidadEjecutora,OficinaR,anio) 
{
    var table = $("#table_PIPs_filtro").DataTable({
    "processing": true,
    "serverSide": false,
    destroy: true,
    "ajax": 
    {
        url: base_url + "index.php/bancoproyectos/filtrarProyectoInversion",
        type: "POST",
         data:{"idUnidadEjecutora":idUnidadEjecutora,
                "idOficina":idOficina,
                "anio":anio },
        "dataSrc":"",
    },
    "columns": [
       {"data": function (data, type) 
            {
                return "<a onclick='editarProyectoInversion("+data.id_pi+")'  class='btn btn-primary btn-xs'><i class='fa fa-edit' aria-hidden='true'></i></a>"
            }
        }, 
        { "data": "id_pi", "visible": false }, 
        { "data": "codigo_unico_pi" },
        { "data": "nombre_pi" }, 
        { "data": "costo_pi" }, 
        { "data": "nombre_estado_ciclo" }, 
        { "data": "fecha_viabilidad_pi" }, 
        { "data": function (data, type) 
            {
                return "<div class='btn-group'><button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button' aria-expanded='false'>Opciones <span class='caret'>"+
                "</span></button><ul class='dropdown-menu'>"+
                "<li><button type='button' class='ubicacion_geografica btn btn-primary btn-xs all' data-toggle='modal' data-target='#venta_ubicacion_geografica'><i class='fa fa-map-marker' aria-hidden='true'></i> Ubicación</button></li>"+
                "<li><button type='button' onclick='agregarRubro("+data.id_pi+")' class='btn btn-info btn-xs all' ><i class='fa fa-spinner' aria-hidden='true'></i> Rubro</button></li>"+
                "<li><button type='button' class='btn btn-warning btn-xs all' onclick='modalidadEjecucion("+data.id_pi+")'><i class='fa fa-flag' aria-hidden='true'> Modalidad de Ejecución</i></button></li>"+
                "<li><button type='button' class='btn btn-success btn-xs all' onclick='estadoCiclo("+data.id_pi+")'><i class='fa fa-paw' aria-hidden='true'> Ver Estado Ciclo</i></button></li>"+
                "<li><button type='button' class='btn btn-info btn-xs all' onclick='operacionMantenimieto("+data.id_pi+")'><i class='fa fa-building' aria-hidden='true'> Operación y Mantenimiento</i></button></li>"+
                "<li><button type='button' class='btn btn-primary btn-xs all' onclick='metaPresupuestal("+data.id_pi+")'><i class='fa fa-list' aria-hidden='true'> Meta</i></button></li>"+                
                "</ul></div>";
            }
        }],
       "language": idioma_espanol
    });
    AddListarUbigeo("#table_proyectos_inversion", table);
}



</script>
