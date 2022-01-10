
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegistraIndicador">Nuevo Indicador</button><!-- /.boton de la ventana registrar nuevo brecha -->

								<div class="row">
									<div class="col-xs-12">
										

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											 LISTA DE INDICADORES
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
                                               <table id="table-UnidadEjecutora" class="table table-striped table-bordered" cellspacing="0" width="100%">
											
												
												<thead>
													 <tr>
													 	<th>ID</th>
                                                        <th>NOMBRE DEL INDICADOR</th>
                                                          <th>DEFINICION DEL INDICADOR</th>
                                                        <th>UNIDAD DE MEDIDA</th>
                                                   <th>SECTOR</th>
													 	<th>MANTENIMIENTO</th>
													 </tr> 	
												</thead>
                                                   <tbody>
                                                   
                                                        <td>1</td>
                                                        <td>INDICADOR 1</td>
                                                        <td>EL INDICADOR CONSISTE EN...</td>
                                                        <td>UM</td>
                                                        <td>TRANSPORTES</td>
                                                        <td>
                                                       
                                                            <a class="blue" href="#">
                                                                <i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a>

																<a class="green" href="#">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red" href="#">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
                                                       </td>
                                                   </tbody>
												
											</table>
										</div>
									</div>
                                    
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
<!-- /.ventana para registra una nueva modalidad de ejecucion -->			
<div class="modal fade" id="VentanaRegistraIndicador" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar Nuevo Indicador</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
                                <form class="form-horizontal" role="form">
									
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Nombre del indicador</label>

										<div class="col-sm-6">
											<input type="text" id="form-field-1-1" placeholder="Nombre del indicador" class="form-control" />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Definicion del indicador </label>

										<div class="col-sm-6">
											<input type="text" id="form-field-1-1" placeholder="Definicion del indicador" class="form-control" />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Unidad de medida del indicador </label>

										<div class="col-sm-6">
											<input type="text" id="form-field-1-1" placeholder="Unidad de medida del indicador" class="form-control" />
										</div>
									</div>
                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Sector</label>

										<div class="col-sm-6">
											<select class="form-control input-sm">
											 <option> Educacion </option>	
											 <option> Transportes</option>	
											 <option> Salud</option>	

										   </select>										
										</div>
									</div>
	
                                    <div class="form-group">
                                        <center><input type="reset" class="btn btn-default" value="Limpiar Formulario">
                                        <button type="submit" class="btn btn-primary">Registrar Indicador</button></center>
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
			