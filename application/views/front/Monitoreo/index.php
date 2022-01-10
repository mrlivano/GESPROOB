<style>
	ul
	{
		list-style-type: none;
    	margin: 0;
    	padding: 0;
	}
	.titulo
	{
		cursor: pointer;
	}
	.prod_color li
	{
    	margin: 0 0px;
	}
	.list-inline>li
	{
	    display: inline-block;
	    padding-right: 2px;
	    padding-left: 2px;
	}
	.prod_color .color
	{
	    border: 1px black !important;
	}
	.bg-off
	{
		background:#6f6f6f !important;border:1px solid #6f6f6f !important;color:#fff
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>MONITOREO DE PROYECTOS</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
					<button onclick="BuscarProyectocodigo();" class="btn btn-primary" style="margin-top: 5px;margin-bottom: 15px;"><span class="fa fa-plus"></span>  NUEVO</button>
					<?php } ?>
					<div class="table-responsive">
						<table id="tablaMonitoreodeProyectos" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<td class="col-md-1 col-xs-12">Código Único</td>
									<td class="col-md-7 col-xs-12">Nombre del proyecto</td>
									<td style="text-align: right;" class="col-md-1 col-xs-12">Costo</td>
									<td class="col-md-3 col-xs-12">Opciones</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($listaProyecto as $key => $value) { ?>
									<tr>
										<td><?=$value->codigo_unico_pi?></td>
										<td><?=$value->nombre_pi?></td>
										<td style="text-align: right;"><?=a_number_format($value->costo_pi , 2, '.',",",3)?></td>
										<td>
											<a onclick="paginaAjaxDialogo('nuevoProducto', 'Edición y cronograma de Actividades',{ id_pi: '<?=$value->id_pi?>' }, base_url+'index.php/Mo_MonitoreodeProyectos/EditarProducto', 'GET', null, null, false, true);return false;" role="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Edición y cronograma de Actividades"><i class="fa fa-edit"></i></a>
											<a onclick="paginaAjaxDialogo('monitoreo', 'Ejecución de Actividades',{ id_pi: '<?=$value->id_pi?>' }, base_url+'index.php/Mo_Monitoreo/index', 'GET', null, null, false, true);return false;" role="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Ejecución de Actividades"><i class="fa fa-search-plus"></i></a>
											<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) {?>
											<a onclick="eliminarMonitoreo('<?=$value->id_pi?>', this);" role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Monitoreo" ><i class="fa fa-trash-o"></i></a>
											<?php } ?>

											<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal<?=$value->id_pi?>"><i class="fa fa-area-chart" data-toggle="tooltip" data-placement="top" title="Gráficos y Reportes"></i></button>

											<div class="modal fade bs-example-modal-sm" id="modal<?=$value->id_pi?>" tabindex="-1" role="dialog" aria-hidden="true">
											    <div class="modal-dialog modal-sm">
											        <div class="modal-content">
											            <div class="modal-header">
											                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i aria-hidden="true">×</i>
											                </button>
											                <h4 class="modal-title" id="myModalLabel2">Gráficos y Reportes</h4>
											            </div>
											            <div class="modal-body">
											                <a href="<?= site_url('Mo_MonitoreodeProyectos/FichadeMonitoreo?id_pi='.$value->id_pi);?>" target='_blank' role="button" class="btn btn-warning btn-xs" style="width: 100%;"><i class="fa fa-file-pdf-o"></i> Ficha de Monitoreo de Inversiones</a>
															<a href="<?= site_url('Mo_MonitoreodeProyectos/avanceFisicoFinanciero?id_pi='.$value->id_pi);?>" target='_blank' role="button" class="btn btn-primary btn-xs" style="width: 100%;"><i class="fa fa-area-chart"></i> Gráfico de Avance Físico y Financiero</a>
															<a href="<?= site_url('Mo_MonitoreodeProyectos/diagramGantt?id_pi='.$value->id_pi);?>" target='_blank' role="button" class="btn btn-info btn-xs" style="width: 100%;"><i class="fa fa-tasks"></i> Diagrama Gantt</a>
											            </div>
											            <div class="modal-footer">
											                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
											            </div>
											        </div>
											    </div>
											</div>

											<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==9) {?>
											<a onclick="paginaAjaxDialogo('monitoreoProyectos', 'Monitoreo del Proyecto',{ id_pi: '<?=$value->id_pi?>' }, base_url+'index.php/Mo_MonitoreoResultado/index', 'GET', null, null, false, true);return false;" role="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Monitoreo de Proyectos"><i class="fa fa-eye"></i></a>
											<?php }?>

											<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==8 || $this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==9)  {?>
											<a onclick="paginaAjaxDialogo('vistoBueno', 'Visto Bueno de Productos y Actividades',{ id_pi: '<?=$value->id_pi?>' }, base_url+'index.php/Mo_ProActVistoBueno/index', 'GET', null, null, false, true);return false;" role="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Visto Bueno de Productos y Actividades"><i class="fa fa-check-square"></i></a>
											<?php } ?>
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
	<div class="clearfix"></div>
</div>
<?php
$sessionTempCorrecto=$this->session->flashdata('correcto');
$sessionTempError=$this->session->flashdata('error');

if($sessionTempCorrecto){ ?>
	<script>
	$(document).ready(function()
	{
		swal('','<?=$sessionTempCorrecto?>', "success");
	});
	</script>
<?php }

if($sessionTempError){ ?>
	<script>
	$(document).ready(function()
	{
	swal('','<?=$sessionTempError?>', "error");
	});
	</script>
<?php } ?>

<script>
	$(document).ready(function()
	{
		$('#tablaMonitoreodeProyectos').DataTable(
		{
			"language":idioma_espanol
		});
	});

	function BuscarProyectocodigo()
	{
		swal({
			title: "Buscar",
			text: "Proyecto: Ingrese Código Único del proyecto",
			type: "input",
			showCancelButton: true,
			closeOnConfirm: false,
			cancelButtonText:"CERRAR" ,
			confirmButtonText: "BUSCAR",
			inputPlaceholder: "Ingrese Codigo Unico",

		}, function (inputValue)
		{
			if (inputValue === "")
		  	{
		  		swal.showInputError("Ingrese código Único");
	    		return false
		  	}
			else
			{
				event.preventDefault();
				$.ajax({
					url:base_url+"index.php/Mo_MonitoreodeProyectos/BuscarProyecto",
					type:"GET",
					data:{inputValue:inputValue},
					cache:false,
					success:function(resp)
					{
						resp = JSON.parse(resp);
						if(resp.proceso=='Info')
						{
							swal("Error!", resp.mensaje, "error");
						}
						else
						{
							if(resp.length==1)
							{
								paginaAjaxDialogo('nuevoProducto', 'Registrar Producto',{codigoUnico:inputValue}, base_url+'index.php/Mo_MonitoreodeProyectos/InsertarProducto', 'GET', null, null, false, true);
			  					swal("Correcto!", "Se Encontro el Proyecto: " + inputValue, "success");
							}
							else
							{
								swal.showInputError("No se encontro el  Codigo Unico. Intente Nuevamente!");
			    				return false
							}
						}
					},
			        error:function()
			        {
			        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
			        }
				});
			}

		});
	}

	function eliminarMonitoreo(idPi,element)
    {
        swal({
            title: "Esta seguro que desea eliminar el Monitoreo de este proyecto?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
        {
            paginaAjaxJSON({ "idPi" : idPi }, base_url+'index.php/Mo_MonitoreodeProyectos/eliminarMonitoreo', 'POST', null, function(resp)
			{
				resp=JSON.parse(resp);
				((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));

				if(resp.proceso=='Correcto')
				{
					$(element).parent().parent().remove();
				}
			}, false, true);
        });
    }

	$(document).on('hidden.bs.modal', '.modal', function ()
	{
	    if ($('body').find('.modal.in').length > 0)
	    {
	        $('body').addClass('modal-open');
	    }
	});
</script>
