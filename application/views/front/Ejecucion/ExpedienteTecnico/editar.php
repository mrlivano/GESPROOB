
<style>
	.row
	{
		margin-top: 4px;
	}
	.borderBudget
	{
		border: 1px solid #E6E9ED;
		padding-bottom: 12px;
	}
</style>

<form class="form-horizontal" id="form-EditarExpedienteTecnico" action="<?php echo base_url();?>index.php/Expediente_Tecnico/editar" method="POST" enctype="multipart/form-data" >

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">

				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Nombre de la Unidad Ejecutora*</label>
							<div>
								<input id="hdIdExpediente" name="hdIdExpediente" value="<?= $ExpedienteTecnicoM->id_et?>" class="form-control col-md-4 col-xs-12" placeholder="" autocomplete="off"  type="hidden">	
								<input id="txtNombreUe" readonly name="txtNombreUe" value="<?= $ExpedienteTecnicoM->nombre_ue?>" class="form-control col-md-4 col-xs-12"  placeholder="Nombre de la unidad ejecutora" autocomplete="off" maxlength="200">	
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Dirección*</label>
							<div>
								<input id="txtDireccionUE" readonly name="txtDireccionUE" value="<?= $ExpedienteTecnicoM->direccion_ue?>" class="form-control col-md-4 col-xs-12"  placeholder="Dirección"  autocomplete="off" maxlength="200" >	
							</div>	
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Distrito/Provincia/Departamento*</label>
							<div>
								<input id="txtUbicacionUE" readonly name="txtUbicacionUE" value="<?= $ExpedienteTecnicoM->distrito_provincia_departamento_ue?>" class="form-control col-md-4 col-xs-12"  placeholder="Distrito/Provincia/Departamento" autocomplete="off" maxlength="200" >	
							</div>	
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Teléfono*</label>
							<div>
								<input id="txtTelefonoUE" readonly name="txtTelefonoUE" value="<?= $ExpedienteTecnicoM->telefono_ue?>" class="form-control col-md-4 col-xs-12"  placeholder="Teléfono"  autocomplete="off" maxlength="20" >	
							</div>	
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">RUC*</label>
							<div>
								<input id="txtRucUE" readonly name="txtRucUE" value="<?= $ExpedienteTecnicoM->ruc_ue?>" class="form-control col-md-4 col-xs-12"  placeholder="RUC"  autocomplete="off" maxlength="11" >	
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Proyecto*</label>
							<div>
								<textarea name="txtProyecto" readonly id="txtProyecto" rows="3" class="form-control" style="resize: none;resize: vertical;"><?=html_escape(trim($ExpedienteTecnicoM->proyecto_et))?></textarea>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Costo Total (Pre Inversión)*</label>
							<div>
								<input id="txtCostoTotalPreInversion" name="txtCostoTotalPreInversion" value="<?=a_number_format($ExpedienteTecnicoM->costo_total_preinv_et , 2, '.',",",3) ?>"  class="form-control col-md-4 col-xs-12 moneda"  placeholder="Total del Proyecto (Pre Inversión)" autocomplete="off" maxlength="40" onkeypress="return valideKey(event);">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Costo Directo*</label>
							<div>
								<input id="txtCostoDirectoPre" name="txtCostoDirectoPre" value="<?= a_number_format($ExpedienteTecnicoM->costo_directo_preinv_et , 2, '.',",",3) ?>" class="form-control col-md-4 col-xs-12 moneda"  placeholder="Costo Directo"  autocomplete="off" maxlength="40" onkeypress="return valideKey(event);">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Costo Indirecto*</label>
							<div>
								<input id="txtCostoIndirectoPre" name="txtCostoIndirectoPre" value=" <?= a_number_format($ExpedienteTecnicoM->costo_indirecto_preinv_et , 2, '.',",",3) ?>" class="form-control col-md-4 col-xs-12 moneda"  placeholder="Costo Indirecto"  autocomplete="off" maxlength="40" onkeypress="return valideKey(event);">
							</div>
						</div>
					</div>
					<div class="row">
					<div class=" col-md-8 col-sm-8 col-xs-12">
					  		<label class="control-label">Modalidad de Ejecución*</label>
					    	<div class="form-group" >
							<input id="txtModalidadEjecucion" name="txtModalidadEjecucion" value="<?=$ExpedienteTecnicoM->modalidad_ejecucion_et?>" class="form-control col-md-4 col-xs-12 moneda"  disabled>
					    	</div>
					  	</div>
					</div>
					<div>
					<?php foreach ($listaModalidadEjecucion as $key => $value) { 
						$cd=0;
						$ci=0;
						if(($ExpedienteTecnicoM->modalidad_ejecucion_et == $value->nombre_modalidad_ejec && $ExpedienteTecnicoM->modalidad_ejecucion_et!='MIXTO') || ($ExpedienteTecnicoM->modalidad_ejecucion_et=='MIXTO' && $ExpedienteTecnicoM->modalidad_ejecucion_et != $value->nombre_modalidad_ejec)){?>
						  <label class="control-label"><?=	$value->nombre_modalidad_ejec?></label>	
							<div class="row borderBudget">
						
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Costo Directo*</label>
							<div>
							<?php  foreach ($listaPresupuestoEj as $key => $valuess) { if (strpos($valuess->desc_presupuesto_ej,$value->nombre_modalidad_ejec) !== false) {?>
								<?php
									$cd=$cd+$valuess->costo_presupuesto_ej[0]->suma; ?>
								<input  id="txtCostoDirectoInversion<?=str_replace(' ', '', $valuess->desc_presupuesto_ej)?>" name="txtCostoDirectoInversion<?=str_replace(' ', '', $valuess->desc_presupuesto_ej)?>" value="<?= a_number_format($valuess->costo_presupuesto_ej[0]->suma, 2, '.',",",3) ?>" class="form-control col-md-4 col-xs-12 moneda"  placeholder="Costo Directo"  autocomplete="off" disabled>
								<?php } }?>
								
							</div>
						</div>
						<?php  foreach ($costoIndirectoComponente as $key => $componente) { 
						if($value->nombre_modalidad_ejec == $componente->tipo_ejecucion){ ?>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label"><?=$componente->descripcion?></label>
							<div>
								<?php $ci=$ci+$componente->monto; ?>
								<input value ="<?= a_number_format($componente->monto , 2, '.',",",3) ?>" class="form-control col-md-4 col-xs-12 moneda"  placeholder="Costo Indirecto" autocomplete="off" maxlength="40" disabled>
							</div>
						</div>
						
						<?php }} ?>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Costo Total (Inversión)*</label>
							<div>

								<input disabled id="txtCostoTotalInversion<?=str_replace(' ', '',$value->nombre_modalidad_ejec)?>" name="txtCostoTotalInversion" value="<?=a_number_format($cd+$ci , 2, '.',",",3)  ?>" class="form-control col-md-4 col-xs-12 moneda"  placeholder="Costo Total del Proyecto (Inversión)" maxlength="40" autocomplete="off" onkeypress="return valideKey(event);">
							</div>
						</div>
					</div>								      			
					<?php }} ?>
					</div>				
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Funcion</label>
							<div>
								<input id="txtFuncion" name="txtFuncion" class="form-control col-md-4 col-xs-12" value="<?= $ExpedienteTecnicoM->funcion_et?>"  placeholder="Funcion" required="required" autocomplete="off">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Programa</label>
							<div>
								<input id="txtPrograma" name="txtPrograma" class="form-control col-md-4 col-xs-12" value="<?= $ExpedienteTecnicoM->programa_et?>" placeholder="Programa" required="required" autocomplete="off">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Sub Programa</label>
							<div>
								<input id="txtSubPrograma" name="txtSubPrograma" class="form-control col-md-4 col-xs-12" value="<?= $ExpedienteTecnicoM->sub_programa_et?>" placeholder="Sub Programa"  autocomplete="off">
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Tiempo de Ejecución del Proyecto* (Meses)</label>
							<div>
								<input maxlength="3" id="txtTiempoEjecucionPip" name="txtTiempoEjecucionPip" value="<?= $ExpedienteTecnicoM->tiempo_ejecucion_pi_et?>" class="form-control col-md-4 col-xs-12"  placeholder="Tiempo de Ejecución" autocomplete="off" maxlength="100" >
							</div>
						</div>					
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Num Beneficiarios Indirectos*</label>
							<div>
								<input id="txtNumBeneficiarios" name="txtNumBeneficiarios" value="<?= $ExpedienteTecnicoM->num_beneficiarios_indirectos?>" class="form-control col-md-4 col-xs-12"  placeholder="Número de beneficiarios indirectos" autocomplete="off" maxlength="40" >
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Fuente de financiamiento*</label>
					    	<div class="form-group">
						      	<select class="selectpicker form-control" id="txtFuenteFinanciamiento" name="txtFuenteFinanciamiento" data-live-search="true">
						        	<option value="">Seleccione una opción</option>
									<?php foreach ($listaFuenteFinanciamiento as $key => $value) { ?>
										<option value="<?=$value->nombre_fuente_finan?>" <?php echo ($ExpedienteTecnicoM->fuente_financiamiento_et == $value->nombre_fuente_finan ? "selected" : "")?>>
										<?=$value->nombre_fuente_finan?></option>
									<?php } ?>
						      	</select>
					    	</div>
						</div>
						
					</div>

					<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">						
					<label class="control-label">Responsables de Elaboración de Expediente</label>
					<button type='button'  data-toggle="tooltip" title="Agregar Responsables de Elaboración" class='btn btn-primary btn-xs' onclick="insertarResponsableElaboracion('<?=$ExpedienteTecnicoM->id_et?>')"><i class='fa fa-plus'></i> Agregar</button>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table id="tablaResponsableElaboracion" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
									<thead>
										<tr>
											<th>Nombres y Apellidos</th>
											<th>Cargo</th>
											<th>Opción</th>
										</tr>
									</thead>
								</table>
							</div>	
						</div>
					</div>
					<div class="row">						
						<?php if($ExpedienteTecnicoM->id_etapa_et==3 || $ExpedienteTecnicoM->id_etapa_et==10){ ?>
							<div class="col-md-4 col-sm-4 col-xs-12" style="display:none;">
							<label class="control-label">Tipo de Responsable:</label>
					    	<div class="form-group">
						      	<select class="selectpicker form-control" id="comboTipoResponsableElaboracion" name="comboTipoResponsableElaboracion" data-live-search="true">
									<?php foreach ($listaTipoResponsableElaboracion as $key => $item) { ?>
										<option value="<?=$item->id_tipo_responsable_et?>"><?=$item->desc_tipo_responsable_et?></option>
									<?php } ?>
						      	</select>
					    	</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Responsable de Ejecución:</label>
					    	<div class="form-group">
						      	<select class="selectpicker form-control" id="ComboResponsableEjecucion" name="ComboResponsableEjecucion" data-live-search="true">
						        	<option value="">Seleccione una opción</option>
									<?php foreach ($listarPersona as $key => $item) { ?>
										<option value="<?=$item->id_persona?>" <?=($item->id_persona==@$listarUResponsableERespoEjecucion[0]->id_persona ? 'selected' : '')?> ><?=$item->nombreCompleto?></option>
									<?php } ?>
						      	</select>
					    	</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
					  		<label class="control-label">Cargo:</label>
					    	<div class="form-group">
								<input type="hidden" name="idTipoResponsableEjecucion" value="<?=@$listarUResponsableERespoEjecucion[0]->id_responsable_et ?>" >
						      	<select class="selectpicker form-control" id="comboCargoEjecucion" name="comboCargoEjecucion" data-live-search="true">
								  	<option value="">Seleccione una opción</option>
									<?php foreach ($listarCargo as $key => $item) { ?>
						      			<option value='<?=$item->id_cargo?>' <?=($item->id_cargo==@$listarUResponsableERespoEjecucion[0]->id_cargo ? 'selected' : '')?> ><?=$item->Desc_cargo?></option>		      								      			
						      		<?php } ?>
						      	</select>
					    	</div>
					  	</div>
						  <?php } ?>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Sustento para la presentacion del proyecto</label></br>
							<input type="hidden" id="hdtxtSituacioActual" value="<?= htmlspecialchars($ExpedienteTecnicoM->desc_situacion_actual_et)?>">
							<p><textarea name="txtSituacioActual" id="txtSituacioActual" rows="10" cols="80"></textarea></p>
						</div>	
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Relevancia Economica</label></br>
							<input type="hidden" id="hdtxtSituacionDeseada" value="<?= htmlspecialchars($ExpedienteTecnicoM->relevancia_economica_et)?>">
							<p><textarea name="txtSituacioDeseada" id="txtSituacioDeseada" rows="10" cols="80"></textarea></p>
						</div>	
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Resumen del proyecto (Descripción)</label></br>
							<input type="hidden" id="hdtxtContribucioInterv" value="<?=htmlspecialchars($ExpedienteTecnicoM->resumen_pi_et)?>" type="hidden">
							<p><textarea name="txtContribucioInterv" id="txtContribucioInterv" rows="10" cols="80"></textarea></p>
						</div>	
					</div>									
					<div class="row">
						<div class="col-md-3 col-sm-12 col-xs-12">
							<label class="control-label">Número de folios*</label>
							<div>
								<input id="txtNumFolio" name="txtNumFolio" value="<?= $ExpedienteTecnicoM->num_folios?>" class="form-control col-md-4 col-xs-12"  placeholder="Número de folios" autocomplete="off" >
							</div>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
                            <label class="control-label">Subir Resolución de Aprobacion: </label>                            
                            <div class="col-md-12 col-sm-9 col-xs-12">
                            	<input type="hidden" name="Editurl" id="Editurl" value="<?= $ExpedienteTecnicoM->url_doc_aprobacion_et?>" notValidate>
                                <input type="file" accept=".doc, .docx, .pdf" id="Documento_Resolucion" name="Documento_Resolucion" notValidate >
                                <b style="color: red; font-size: 10px;">Solo se aceptan archivos con extensión PDF y DOCX.En caso de subir otra resolución remplazara a la anterior</b>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <label class="control-label">Fecha de Aprobacion:</label>
                            <input class="form-control col-md-4 col-xs-12" type="date" max="2050-12-31" name="txtFechaAprobacion" value="<?=$ExpedienteTecnicoM->fecha_aprobacion?>" id="txtFechaAprobacion" Validate>
                        </div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Fotografías:</label>
							<div>
								<input type="file" accept="image/png, image/jpeg, image/jpg" name="imagen[]" id="imagen" multiple  >
								<b style="color: red; font-size: 10px;">Solo se aceptan archivos con extensión png y jpg.</b>
								<br>
							</div>
						</div>	
					</div>	
					<div class="row">
						<div id="divfotos">
							<?php $i=0; foreach($listaimg as $item){ ?>
								<div id="divShowImage<?=$item->id_img?>" style="display: inline-block;margin: 4px;vertical-align: top;width: 200px;">
								  	<div>
								  		<label>Fotografía N° <?= $i=$i+1?></label>
										<button onclick="EliminarImagen(<?=$item->id_img?>,<?=$item->id_et?>);"  title='Eliminar imagen del Expediente Técnico'  class='eliminarExpediente btn btn-danger btn-xs'><i class="fa fa-trash-o"></i></button>
								  	</div>
								  	<img class="img-thumbnail .img-responsive" src="<?= base_url();?>uploads/ImageExpediente/<?=$item->id_img?><?=$item->desc_img?>">
								</div>
							<?php } ?>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: right;">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>
	  
$(function()
{
	mostrar($("#txtModalidadEjecucion").val());
	CKEDITOR.replace('txtSituacioActual' ,{
		filebrowserImageBrowseUrl : '<?php echo base_url('assets/filemanager/index.html');?>'
	});
	CKEDITOR.replace('txtSituacioDeseada' ,{
		filebrowserImageBrowseUrl : '<?php echo base_url('assets/filemanager/index.html');?>'
	});
  	CKEDITOR.replace('txtContribucioInterv' ,{
		filebrowserImageBrowseUrl : '<?php echo base_url('assets/filemanager/index.html');?>'
	});
	var html=$("#hdtxtSituacioActual").val();
	CKEDITOR.instances.txtSituacioActual.setData(html);
	var html1=$("#hdtxtSituacionDeseada").val();
	CKEDITOR.instances.txtSituacioDeseada.setData(html1);
	var html2=$("#hdtxtContribucioInterv").val();
	CKEDITOR.instances.txtContribucioInterv.setData(html2);

	$('#form-EditarExpedienteTecnico').formValidation(
	{
		framework: 'bootstrap',
		excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
		live: 'enabled',
		message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
		trigger: null,
		fields:
		{
			txtNombreUe:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Nombre Unidad Ejecutora." es requerido.</b>'
					}
				}
			},
			txtDireccionUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Dirección de unidad ejecutora" es requerido.</b>'
					}
				}
			},
			txtUbicacionUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Ubicacion unidad ejecutora" es requerido.</b>'
					}
				}
			},
			txtTelefonoUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Telefono unidad ejecutora" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^[0-9]+$/,
						message: '<b style="color: red;">El campo "Teléfono" debe ser un numero.</b>'
					}
				}
			},
			txtRucUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Ruc" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^([0-9]){11}$/,
						message: '<b style="color: red;">El campo "Ruc" debe ser un número de 11 dígitos.</b>'
					}
				}
			},
			txtCodigoUnico:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Codigo" es requerido.</b>'
					}
				}
			},
			txtCostoTotalPreInversion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Total PreInversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo total pre Inversion " debe ser un valor en soles.</b>'
					} 
				}
			},
			txtCostoDirectoPre:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Directo PreInversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo Directo pre Inversion " debe ser un valor en soles.</b>'
					}  
				}
			},
			txtCostoIndirectoPre:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Indirecto PreInversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo Indirecto Pre Inversion " debe ser un valor en soles.</b>'
					}   
				}
			},	
			txtCostoTotalInversion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Total Inversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo Total de Inversion " debe ser un valor en soles.</b>'
					}  
				}
			},
			txtCostoDirectoInversion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Costo Directo de inversion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Costo Directo de inversion" debe ser un valor en soles.</b>'
					}  
				}
			},
			txtGastosGenerales:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Gastos Generales" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Gastos Generales" debe ser un valor en soles.</b>'
					}  
				}
			},
			txtGastosSupervision:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Gastos supervisión" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Gastos Supervision" debe ser un valor en soles.</b>'
					}  
				}
			},
			txtFuncion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Funcion" es requerido.</b>'
					} 
				}
			},	
			txtPrograma:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Programa" es requerido.</b>'
					} 
				}
			},
			txtSubPrograma:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Sub Programa" es requerido.</b>'
					} 
				}
			},
			txtProyecto:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Proyecto" es requerido.</b>'
					} 
				}
			},	
			txtComponente:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Componente" es requerido.</b>'
					} 
				}
			},	
			txtMeta:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Meta" es requerido.</b>'
					} 
				}
			},	
			txtFuenteFinanciamiento:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Fuente Financiamiento" es requerido.</b>'
					} 
				}
			},
			txtModalidadEjecucion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Modalidad Ejecucion" es requerido.</b>'
					} 
				}
			},	
			txtTiempoEjecucionPip:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Tiempo Ejecucion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^\d*$/,
						message: '<b style="color: red;">El campo "Tiempo de ejecución" debe ser un mes en número.</b>'
					} 
				}
			},
			txtNumBeneficiarios:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Tiempo Ejecucion" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^\d*$/,
						message: '<b style="color: red;">El campo "Numero de beneficiarios" debe ser un numero.</b>'
					}
				}
			},
			txtNumFolio:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Numero de Folio" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^\d*$/,
						message: '<b style="color: red;">El campo "Numero de folios" debe ser un número.</b>'
					} 
				}
			}			
		}
	});

	listaResponsableElaboracion($('#hdIdExpediente').val());
	// $('#txtCostoTotalInversionADMINISTRACIONDIRECTA').val("<?=$cd?>");
	// $('#txtCostoTotalInversionADMINISTRACIONINDIRECTA').val("<?=$ci?>");
});

	function EliminarImagen(id_img,id_et)
	{	
		event.preventDefault();
		swal({
			title: "Está seguro que desea eliminar la imagen del expediente técnico ?",
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
			$.ajax({
				url:base_url+"index.php/ET_Img/eliminar",
				type:"POST",
				data:{id_img:id_img,id_et:id_et},
				dataType:'JSON',
				success:function(respuesta)
				{                        	
					swal("ELIMINADO!", "Se elimino correctamente la imagen del expediente técnico.", "success");
					
					$('#divShowImage'+id_img).remove();
				}
			});
		});
	}

	$('#btnEnviarFormulario').on('click', function(event)
   	{
        var resolucion=$("#Documento_Resolucion").val(); 
        var url = resolucion.split('.').pop();
        $("#Editurl").val(url);
    });

	$(".moneda").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    }); 
   
    var format = function(num)
    {
	    var str = num.replace("", ""), parts = false, output = [], i = 1, formatted = null;
	    if(str.indexOf(".") > 0) 
	    {
	        parts = str.split(".");
	        str = parts[0];
	    }
	    str = str.split("").reverse();
	    for(var j = 0, len = str.length; j < len; j++) 
	    {
	        if(str[j] != ",") 
	        {
	            output.push(str[j]);
	            if(i%3 == 0 && j < (len - 1))
	            {
	                output.push(",");
	            }
	            i++;
	        }
	    }
	    formatted = output.reverse().join("");
	    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	};

	$('.selectpicker').selectpicker({
	});

	function mostrar(id) {
     
	if (id == "ADMINISTRACION DIRECTA") {
        $("#divUtilidad").hide();
		$("#divIGV").hide();
        $("#divAdministracion").hide();
		$("#divElaboracionET").hide();
		$("#divSupervisionET").hide();
		$("#divLiquidacion").show();
    }
	if (id == "POR CONTRATA") {
		$("#divLiquidacion").hide();
		$("#divUtilidad").show();
		$("#divIGV").show();
        $("#divAdministracion").show();
		$("#divElaboracionET").show();
		$("#divSupervisionET").show();
    }
	if (id == "MIXTO") {
        $("#divLiquidacion").show();
		$("#divUtilidad").show();
		$("#divIGV").show();
        $("#divAdministracion").show();
		$("#divElaboracionET").show();
		$("#divSupervisionET").show();
    }
	if (id == "") {
        $("#divLiquidacion").hide();
		$("#divUtilidad").hide();
		$("#divIGV").hide();
        $("#divAdministracion").hide();
		$("#divElaboracionET").hide();
		$("#divSupervisionET").hide();
    }
}
function valideKey(evt){
			
			// code is the decimal ASCII representation of the pressed key.
			var code = (evt.which) ? evt.which : evt.keyCode;
			
			if(code==46) { // backspace.
			  return true;
			} else if(code>=48 && code<=57) { // is a number.
			  return true;
			} else{ // other keys.
			  return false;
			}
		}

		function insertarResponsableElaboracion(id_et)
{
    paginaAjaxDialogo('otherModalResponsableElaboracion', 'Agregar Responsables de Elaboración', {id_et:id_et}, base_url+'index.php/Expediente_Tecnico/insertarResponsableElaboracion', 'GET', null, null, false, true);
}

function listaResponsableElaboracion(id_et) 
	{
		var table=$("#tablaResponsableElaboracion").DataTable({
			"processing": true,
			"serverSide":false,
			destroy:true,
			"ajax":{
				url:base_url+"index.php/Expediente_Tecnico/listarResponsableElaboracion",
				type:"POST",
				data :{id_et:id_et}
			},
			"columns":
			[
				{"data":"nombres",
					render: function(data, type, row)
					{
						var name = data+' '+row.apellido_p+' '+row.apellido_m;
						return name;
					}
				},
				{"data":"desc_cargo"},
				{"data":"id_responsable_et",
					render: function(data, type, row)
					{
						return "<button type='button' class='btn btn-danger btn-xs' onclick=eliminarResponsableElaboracion(" + data + ",this)><i class='fa fa-trash-o'></i></button>"; 
					}
				}
			],
			"language":idioma_espanol
		});
	}

	function eliminarResponsableElaboracion(id_responsable_et, element) 
	{
		swal({
			title: "Se eliminará responsable de elaboración. ¿Realmente desea proseguir con la operación?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Cerrar",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		}, function() {
			paginaAjaxJSON({
				"id_responsable_et": id_responsable_et
			}, base_url + 'index.php/Expediente_Tecnico/eliminarResponsableElaboracion', 'POST', null, function(objectJSON) {
				objectJSON = JSON.parse(objectJSON);
				swal({
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
				}, function() {});
				$('#tablaResponsableElaboracion').dataTable()._fnAjaxUpdate();
			}, false, true);
		});
	}
</script>







