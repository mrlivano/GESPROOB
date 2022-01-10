<link href="<?php echo base_url(); ?>assets/li/css/layout.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/li/css/menu.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/li/js/script.js"></script>

<!-- <base href="https://demos.telerik.com/kendo-ui/grid/editing-inline"> -->
<style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.1.221/styles/kendo.common-material.min.css" />
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.1.221/styles/kendo.material.min.css" />
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.1.221/styles/kendo.material.mobile.min.css" />

<script src="https://kendo.cdn.telerik.com/2018.1.221/js/jquery.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2018.1.221/js/kendo.all.min.js"></script>
<script src="http://kendo.cdn.telerik.com/2018.1.221/js/messages/kendo.messages.es-ES.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js"></script>

<style>
	.btn.btn-app{
		background-color: #f2f5f7;
		color:white;
		box-shadow: 0px 5px 5px 0px rgba(0,0,0,0.2);
		border: none;
		-webkit-transition: transform 0.3s;
        -moz-transition: transform 0.3s;
        -ms-transition: transform 0.3s;
        -o-transition: transform 0.3s;
        transition: transform 0.4s;
        user-select : none;
	}
	.btn.btn-app:hover{
		background-color: #f2f5f7;
		color:white;
		transform: scale(1.125);
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	}
	.menuPrincipal
	{
		background-color: #35495d;
		color: #73879c;
		font-size: 13px;

	}
	.menuGeneral>a
	{
		color: white;
	}
	.nav .open>a, .nav .open>a:focus, .nav .open>a:hover
	{
    	background-color: #26576f;
    	color: white;
	}
	.menuPrincipal>li>a:hover
	{
    	padding: 13px 15px 12px;
    	background-color: #5c94a0;
    	color: white;

	}
	.dropdown:hover{
		background-color: #35495d;
	}
	.subMenu >li>a:hover{
		background-color: #35495d;
		color:white;
	}
	.subMenu >li>a
	{
		padding: 5px 5px;
		color:#35495d;
		font-size: 13px;
	}
	.modal
	{
	   overflow:auto !important;
	}
	.dropdown:hover .dropdown-menu{
		display: block;

	}
	.dropdown-menu
	{
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		margin: 0px 0 0;

	}
	address{
		font-size: 13px;

	}

	.table-bordered>tbody>tr>td:first-child {
		width: 15%;
		text-align: left;
	}

</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>Pre-Liquidación</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
                  <ul class="nav nav-pills menuPrincipal" role="tablist">
                    	<li role="presentation" class="dropdown menuGeneral">
                      		<a id="drop4" href="#" class="dropdown-toggle" role="button" aria-expanded="false">	Proyecto<span class="caret"></span>
                            </a><ul id="menu6" class="dropdown-menu subMenu" role="menu">
	                        	<li role="presentation">
		                        	<a role="menuitem" tabindex="-1" href="#"  onclick="paginaAjaxDialogo(null, 'Modificar Pre-Liquidación',{ id_liq_proyecto: '<?=$listPreliquidacion[0]->id_liq_proyecto?>', codigo_unico: '<?=$listPreliquidacion[0]->codigo_unico?>'}, base_url+'index.php/Preliquidacion/editar', 'GET', null, null, false, true);return false;"><i class="fa fa-edit"></i> Editar pre-liquidación</a>
	                        	</li>
	                        	<li  role="presentation">
	                        		<a role="menuitem" tabindex="-1" class='eliminarExpediente' href="#" onclick="Eliminar(<?=$listPreliquidacion[0]->id_liq_proyecto?>);return false;"><i class="fa fa-trash-o"></i> Eliminar pre-liquidación
		                        	</a>
		                        </li>
		                    </ul>

                    	</li>
                    	<li role="presentation" class="dropdown menuGeneral">
												<a id="drop7" href="#" class="dropdown-toggle" role="button" aria-expanded="false"> Reporte<span class="caret"></span></a>
												<ul id="menu3" class="dropdown-menu subMenu" role="menu" aria-labelledby="drop6">
													<li role="presentation">
														<a role="menuitem" tabindex="-1" href="<?= site_url('PreLiquidacion/ReporteEstadistico?id_liq_proyecto='.$listPreliquidacion[0]->id_liq_proyecto.'&codigo_unico='.$listPreliquidacion[0]->codigo_unico);?>" target="_blank"><i class="fa fa-line-chart"></i> Ficha de pre-liquidación</a>
													</li>
												</ul>
											</li>
											<li role="presentation" class="dropdown menuGeneral">
												<a role="menuitem" tabindex="-1" href="<?= site_url('Repositorio_Preliquidacion/elfinder_files?id_pl='.$listPreliquidacion[0]->id_liq_proyecto.'&doc=all');?>" target="_blank"><i class="fa fa-hdd-o"></i> Repositorio</a>
											</li>
                 	</ul>
                  	<br/>
                  	<div class="table-responsive">
											<?php foreach ($listPreliquidacion as $key => $value): ?>
                  		<h5 style="padding-bottom: 4px;"><b>Datos Generales del Proyecto:</b></h5>
                  		<table class="table table-bordered">
	                      	<tbody>
	                      		<tr>
	                      			<td><b>A. Nombre del Proyecto:</b></td>
	                      			<td colspan="3" style="width: 85%;"><?= $infoProject[0]->nombre_pi ?></td>
	                      		</tr>
														<tr>
	                      			<td><b>B. Código SNIP:</b></td>
	                      			<td colspan="3" style="width: 85%;"><?= $infoProject[0]->codigo_unico_pi ?></td>
	                      		</tr>
	                      		<tr>
	                      			<td><b>C. Ubicación:</b></td>
	                      			<td colspan="3" style="font-size: 13px;"><?= @$preliquidacion[0]->ubicacion ?></td>
	                      		</tr>
	                      		<tr>
	                      			<td><b>D. Meta Presupuestal:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>E. Responsables:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>F. Unidad Ejecutora:</b></td>
	                      			<td colspan="3"><?= $preliquidacion[0]->unidad_ejec ?></td>
	                      		</tr>
														<tr>
	                      			<td><b>G. Años Presupuestales:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>H. Modalidad de Ejecución:</b></td>
	                      			<td colspan="3"><?=$preliquidacion[0]->mod_ejec?></td>
	                      		</tr>
														<tr>
	                      			<td><b>I. Fuente de Financiamiento:</b></td>
	                      			<td colspan="3"><?=$preliquidacion[0]->fuente_fto?></td>
	                      		</tr>
														<tr>
	                      			<td><b>J. Presupuesto Ejecutado:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>K. Valorización Física:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>L. De los Plazos:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>M. Descripción de la obra o proyecto:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>N. Metas concluidas:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>O. Antecedentes de la Obra o Proyecto:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
														<tr>
	                      			<td><b>P. Concluciones y recomendaciones:</b></td>
	                      			<td colspan="3"></td>
	                      		</tr>
	                      	</tbody>
	                    </table>
											<?php endforeach; ?>
                  	</div>
										<div class="table-responsive">
											<div id="example">
													 <div id="grid"></div>

													 <style>
												        /*
												            Use the DejaVu Sans font for display and embedding in the PDF file.
												            The standard PDF fonts have no support for Unicode characters.
												        */
												        .k-grid {
												            font-family: "DejaVu Sans", "Arial", sans-serif;
												        }
												    </style>

												    <script>
												        /*
												            This demo renders the grid in "DejaVu Sans" font family, which is
												            declared in kendo.common.css. It also declares the paths to the
												            fonts below using <tt>kendo.pdf.defineFont</tt>, because the
												            stylesheet is hosted on a different domain.
												        */
												        kendo.pdf.defineFont({
												            "DejaVu Sans"             : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans.ttf",
												            "DejaVu Sans|Bold"        : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Bold.ttf",
												            "DejaVu Sans|Bold|Italic" : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf",
												            "DejaVu Sans|Italic"      : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf",
												            "WebComponentsIcons"      : "https://kendo.cdn.telerik.com/2017.1.223/styles/fonts/glyphs/WebComponentsIcons.ttf"
												        });
												    </script>

												    <!-- Load Pako ZLIB library to enable PDF compression -->
												    <script src="https://kendo.cdn.telerik.com/2018.1.221/js/pako_deflate.min.js"></script>

												    <script type="x/kendo-template" id="page-template">
												      <div class="page-template">
												        <div class="header">
												          <div style="float: right">Página #: pageNum # de #: totalPages #</div>
												          Gobierno Regional de Apurímac
												        </div>
												        <div class="watermark">GRA</div>
												        <div class="footer">
												          Página #: pageNum # de #: totalPages #
												        </div>
												      </div>
												    </script>

													 <script>
															 $(document).ready(function () {
																	 //var crudServiceBaseUrl = "https://demos.telerik.com/kendo-ui/service",
																	 var crudServiceBaseUrl = base_url+"index.php/Liquidacion",
																			 dataSource = new kendo.data.DataSource({
																					 transport: {
																							 read:  {
																									 url: crudServiceBaseUrl + "/Products?id_pl="+<?= $listPreliquidacion[0]->id_liq_proyecto ?>,
																									 dataType: "json"
																							 },
																							 update: {
																									 url: crudServiceBaseUrl + "/Products?mod=update&id_pl="+<?= $listPreliquidacion[0]->id_liq_proyecto ?>,
																									 dataType: "jsonp"
																							 },
																							 destroy: {
																									 url: crudServiceBaseUrl + "/Products/Destroy",
																									 dataType: "jsonp"
																							 },
																							 create: {
																									 url: crudServiceBaseUrl + "/Products/Create",
																									 dataType: "jsonp"
																							 },
																							 parameterMap: function(options, operation) {
																									 if (operation !== "read" && options.models) {
																											 return {models: kendo.stringify(options.models)};
																									 }
																							 }
																					 },
																					 batch: true,
																					 pageSize: 8,
																					 schema: {
																							 model: {
																									 id: "id_liq_det_preliquidacion",
																									 fields: {
																											 id_liq_det_preliquidacion: { editable: false, nullable: true },
																											 id_descripcion: { editable: false, nullable: true },
																											 descripcion: { editable: false, validation: { required: true } },
																											 // UnitPrice: { type: "number", validation: { required: true, min: 1} },
																											 estado: { type: "boolean" },
																											 Repository: { editable: false, nullable: true }
																									 }
																							 }
																					 }
																			 });

																	 var grid = $("#grid").kendoGrid({
																		 toolbar: ["pdf"],
																			pdf: {
																					allPages: true,
																					avoidLinks: true,
																					paperSize: "A4",
																					margin: { top: "2cm", left: "1cm", right: "1cm", bottom: "1cm" },
																					landscape: true,
																					repeatHeaders: true,
																					template: $("#page-template").html(),
																					scale: 0.8
																			},
																			pdfExport: function(e) {
																				var grid = $("#grid").data("kendoGrid");
																		    grid.hideColumn(4);
																		    e.promise
																		          .done(function() {
																		               grid.showColumn(4);
																		    });
																	    },
																			 dataSource: dataSource,
																			 height: 550,
											                 sortable: true,
											                 pageable: {
											                     refresh: true,
											                     pageSizes: true,
											                     buttonCount: 5
											                 },
																			 // toolbar: ["create"],
																			 columns: [
																				   { field: "id_liq_det_preliquidacion", title: "ID", hidden: true },
																					 { field: "id_descripcion", title: "ID descripcion", hidden: true },
																					 { field: "descripcion", title: "DOCUMENTOS GENERALES" },
																					 // { field: "UnitPrice", title: "Unit Price", format: "{0:c}", width: "120px" },
																					 // { field: "UnitsInStock", title:"Units In Stock", width: "120px" },
																					 { field: "estado", title:"Visto Bueno", template: kendo.template($("#invoicePriceTemplate").html()), width: "120px", editor: customBoolEditor },
																					 { command: ["edit", { text: "Repositorio", click: showDetails } ], title: "Opciones&nbsp;", width: "250px" }],
																			 editable: "inline"
																	 }).data("kendoGrid");
															 });

															 function showDetails(e) {
								                    e.preventDefault();
								                    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
								                    console.log(dataItem);
																		var win = window.open(base_url+'Repositorio_Preliquidacion/elfinder_files?id_pl=<?= $listPreliquidacion[0]->id_liq_proyecto ?>&doc='+dataItem.id_descripcion, '_blank');
																		if (win) {
																		    //Browser has allowed it to be opened
																		    win.focus();
																		} else {
																		    //Browser has blocked it
																		    alert('Please allow popups for this website');
																		}
								                }
															 function customBoolEditor(container, options) {
																 // console.log(options["model"]["estado"]);
																 // var estado = options["model"]["estado"];
																 var guid = kendo.guid();
						                     $('<input class="k-checkbox" id="' + guid + '" type="checkbox" name="estado" data-type="boolean" data-bind="checked:estado">').appendTo(container);
						                     $('<label class="k-checkbox-label" for="' + guid + '">&#8203;</label>').appendTo(container);
															 }
													 </script>
													 <script id="invoicePriceTemplate" type="text/x-kendo-tmpl">
														 #if(estado){#
																 <span><i class="fa fa-check" id="elementID"></i></span>
														 #}else{#
																 <span></span>
														 #}#
														</script>
													 <style>
															 #elementID {
																    color: #16C60C;
																    text-shadow: 1px 1px 1px #ccc;
																    font-size: 1.5em;
																}

												        /* Page Template for the exported PDF */
												        .page-template {
												          font-family: "DejaVu Sans", "Arial", sans-serif;
												          position: absolute;
												          width: 100%;
												          height: 100%;
												          top: 0;
												          left: 0;
												        }
												        .page-template .header {
												          position: absolute;
												          top: 30px;
												          left: 30px;
												          right: 30px;
												          border-bottom: 1px solid #888;
												          color: #888;
												        }
												        .page-template .footer {
												          position: absolute;
												          bottom: 30px;
												          left: 30px;
												          right: 30px;
												          border-top: 1px solid #888;
												          text-align: center;
												          color: #888;
												        }
												        .page-template .watermark {
												          font-weight: bold;
												          font-size: 400%;
												          text-align: center;
												          margin-top: 30%;
												          color: #aaaaaa;
												          opacity: 0.1;
												          transform: rotate(-35deg) scale(1.7, 1.5);
												        }

												        /* Content styling */
												        .customer-photo {
												          display: inline-block;
												          width: 32px;
												          height: 32px;
												          border-radius: 50%;
												          background-size: 32px 35px;
												          background-position: center center;
												          vertical-align: middle;
												          line-height: 32px;
												          box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0,0,0,.2);
												          margin-left: 5px;
												        }
												        kendo-pdf-document .customer-photo {
												          border: 1px solid #dedede;
												        }
												        .customer-name {
												          display: inline-block;
												          vertical-align: middle;
												          line-height: 32px;
												          padding-left: 3px;
												        }
												    </style>
											 </div>
                  	</div> <!-- responsive tag -->
                </div>
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

function Eliminar(id_liq_proyecto)
{
	swal({
		title: "Esta seguro que desea eliminar Ficha Pre-Liquidación, ya que se eliminara también los responsables?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "SI,ELIMINAR",
		cancelButtonText:"CERRAR",
		closeOnConfirm: false
	},
				function(){$.ajax({url:base_url+"index.php/Preliquidacion/eliminar",type:"POST",data:{id_liq_proyecto:id_liq_proyecto},success:function(respuesta)
				{
							var object = JSON.parse(respuesta);
							(object.proceso == 'Error' ? swal(object.proceso,object.mensaje, "error") : swal(object.proceso,object.mensaje, "success"));
							window.location.href='<?=base_url();?>index.php/Preliquidacion/index/';
							renderLoading();
				}
		});
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
