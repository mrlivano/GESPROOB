
          <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">Tables</a>
							</li>
							<li class="active">Simple &amp; Dynamic</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						
						<div class="page-header">
							<h1>
								Registrar
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Indicador
								</small>
							</h1>
						</div><!-- /.page-header -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegistraBrechaIndicador">Brecha Indicador</button><!-- /.boton de la ventana registrar nuevo brecha -->

								<div class="row">
									<div class="col-xs-12">
										

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											 LISTA DE BRECHAS CON SUS INDICADORES
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
                                               <table id="table-UnidadEjecutora" class="table table-striped table-bordered" cellspacing="0" width="100%">
											
												
												<thead>
													 <tr>
													 	<th>ID</th>
                                                        <th>NOMBRE BRECHA</th>
                                                          <th>NOMBRE INDICADOR</th>
                                                        <th>NOMBRE SERVICIO PUBLICO</th>
                                                   <th>FECHA</th>
													 	<th>MANTENIMIENTO</th>
													 </tr> 	
												</thead>
                                               
												
											</table>
										</div>
									</div>
                                    
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
<!-- /.ventana para registra una nueva modalidad de ejecucion -->			
<div class="modal fade" id="VentanaRegistraBrechaIndicador" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Brecha y su Indicador</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
                                <form class="form-horizontal" role="form">
									
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Brecha</label>

										<div class="col-sm-6">
											<select class="form-control input-sm">
											 <option> Brecha Educacion </option>	
											 <option> Brecha Transportes</option>	
											 <option> Brecha Salud</option>	

										   </select>										
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Indicador</label>

										<div class="col-sm-6">
											<select class="form-control input-sm">
											 <option> Indicar 1</option>	
											 <option> Indicador 2</option>	
											 <option> Indicador 3</option>	

										   </select>										
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Servicio Publico</label>

										<div class="col-sm-6">
											<select class="form-control input-sm">
											 <option> Serp1 </option>	
											 <option>Serp2</option>	
											 <option> Serp3</option>	

										   </select>										
										</div>
									</div>
                       
                
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Valor de indicador </label>

										<div class="col-sm-6">
											<input type="text" id="form-field-1-1" placeholder="Valor de indicador" class="form-control" />
										</div>
									</div>
                              
                                      <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Fecha Indicador</label>

										<div class="col-sm-6">
											<input type="date" id="form-field-1-1" placeholder="Valor de indicador" class="form-control" />
										</div>
									</div>
                                    
                                      <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Linea Base </label>

										<div class="col-sm-6">
											<input type="text" id="form-field-1-1" placeholder="Linea Base" class="form-control" />
										</div>
									</div>
	
                                    <div class="form-group">
                                        <center><input type="reset" class="btn btn-default" value="Limpiar Formulario">
                                        <button type="submit" class="btn btn-primary">Registrar Brecha Indicador</button></center>
                                    </div>
									<div class="space-4"></div>
										
				           </form>
                        </div><!-- /.span -->
                 </div><!-- /.row -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- /.fin ventana para registrar una modalidad de ejecucion -->
			