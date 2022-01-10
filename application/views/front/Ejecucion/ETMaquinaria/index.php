<style>
	#tablaMaquinaria th
	{
		background-color:#2e6da4;
		color:white;		
	}
</style>
<div class="right_col" role="main">
	<div class="x_panel">
		<div class="x_title">
			<h2><b>Maquinaria Propia/Alquilada</b></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">   
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-2 col-sm-12 col-xs-12">
							<div> 
								<input type="button" class="btn btn-primary" value="Nuevo" onclick="paginaAjaxDialogo(null, 'Agregar Maquinaria',{ id_et: '<?=$idExpedienteTecnico?>' }, base_url+'index.php/ET_Maquinaria/insertar', 'GET', null, null, false, true);return false;">
							</div>		
						</div>	
						<div class="col-md-3 col-sm-12 col-xs-12">
						</div>		
						<div class="col-md-7 col-sm-12 col-xs-12" id="validarPdf">
							<form action="<?php echo base_url();?>index.php/ET_Maquinaria/reportePdf" id="frmReporteMaquinariaPdf" method="POST" target="_blank">
								<div class="col-md-3 col-sm-2 col-xs-12">
									<input type="hidden" name="hdIdExpediente" id="hdIdExpediente" value="<?=$idExpedienteTecnico?>" readonly>
									<select name="selectFormato" id="selectFormato" class="form-control">
										<option value="fe09">FORMATO FE-09</option>
										<option value="fe10">FORMATO FE-10</option>
									</select>							
								</div>
								<div class="col-md-2 col-sm-2 col-xs-12">
									<input type="text" name="txtAnio" id="txtAnio" class="form-control" maxlength="4" value="<?=date('Y')?>">
								</div>
								<div class="col-md-3 col-sm-2 col-xs-12">
									<select name="selectMes" id="selectMes" class="form-control"> 
										<?php foreach ($listaMes as $key => $value) { ?>
											<option value="<?=$value?>"><?=$key?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-3 col-sm-2 col-xs-12">
									<select name="selectTipo" id="selectTipo" class="form-control"> 
										<option value="Propia">Propia</option>
										<option value="Alquilada">Alquilada</option>
										<option value="Ambos">Ambos</option>
									</select>
								</div>								
								<div class="col-md-1 col-sm-2 col-xs-12">
									<input type="button" class="btn btn-warning" value="PDF" onclick="reportePDF();">
								</div>
							</form>
						</div>							
					</div>
				</div>
			</div>
			<br>
			<div class="table-responsive">
				<table id="tablaMaquinaria" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>MAQUINARIA</th>
							<th>POTENCIA</th>
							<th>CAPACIDAD</th>
							<th>N° PLACA DE MOTOR</th>
							<th>PROVEEDOR</th>
							<th>COSTO POR HORA</th>
							<th>TIPO</th>
							<th>OPCIONES</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($listaMaquinaria as $value) {?>
						<tr>
							<td><?=$value->maquinaria?></td>
							<td><?=$value->potencia?></td>
							<td><?=$value->capacidad?></td>
							<td><?=$value->nro_placa_motor?></td>
							<td><?=$value->proveedor?></td>
							<td><?=$value->costo_hora?></td>
							<td><?=$value->tipo?></td>
							<td>
								<a onclick="paginaAjaxDialogo(null, 'Edición de Maquinaria',{ id_et : '<?=$idExpedienteTecnico?>',id_maquinaria: '<?=$value->id_maquinaria?>' }, base_url+'index.php/ET_Maquinaria/editar', 'GET', null, null, false, true);return false;" role="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Maquinaria"><i class="fa fa-edit"></i></a>
								<a onclick="eliminarMaquinaria('<?=$value->id_maquinaria?>',this);" role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Maquinaria"><i class="fa fa-trash-o"></i></a>
								<a onclick="paginaAjaxDialogo(null, 'Horas Trabajadas',{ id_maquinaria: '<?=$value->id_maquinaria?>' }, base_url+'index.php/ET_Ejecucion_Maquinaria/index', 'GET', null, null, false, true);return false;" role="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Horas Trabajadas"><i class="fa fa-plus"></i></a>
								<a onclick="paginaAjaxDialogo(null, 'Registro de Combustible, Lubricantes, Repuestos y Otros',{ id_maquinaria: '<?=$value->id_maquinaria?>' }, base_url+'index.php/ET_Consumo_Maquinaria/index', 'GET', null, null, false, true);return false;" role="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Combustible y Repuestos"><i class="fa fa-truck"></i></a>
							</td>
						</tr>					
					<?php } ?>						
					</tbody>
				</table>
			</div>
		</div>
	</div>
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
	$(function()
	{
		$('#validarPdf').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtAnio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Año" es requerido.</b>'
						},
						regexp:
						{
							regexp: /^([0-9]){4}$/,
							message: '<b style="color: red;">El campo "Año" debe ser un número de 4 dígitos.</b>'
						}
					}
				}
			}
		});
	})

	function reportePDF()
	{
		event.preventDefault();
        $('#validarPdf').data('formValidation').validate();
		if(!($('#validarPdf').data('formValidation').isValid()))
		{
			return;
		}
		event.preventDefault();
		$('#frmReporteMaquinariaPdf')[0].submit();
	}

	function eliminarMaquinaria(codigo, element)
	{
		swal({
            title: "Al borrar la maquinaria tambien se eliminarán las horas trabajadas. ¿Realmente desea proseguir con la operación?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CERRAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
		{
            paginaAjaxJSON({ "idMaquinaria" : codigo}, base_url+'index.php/ET_Maquinaria/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
				},
				function(){});

				$(element).parent().parent().remove();
			}, false, true);
        });
	}
</script>