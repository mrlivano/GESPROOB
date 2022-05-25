 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><b>PROYECTOS APROBADOS</b></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                                <!--inicio  de icono de reporte -->

                                                        <div class="clearfix">
                                                           <div class="pull-right tableTools-container-evaluacion">
                                                           </div>
                                                        </div>
                                                      <!--fin  de icono de reporte -->

                  <div class="x_content">
                    <p></p>
                    <!-- start project list -->
                    <table id="table-EvaluacionFE" class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 5%">Id PIP</th>
                          <th>Codigo Unico</th>
                          <th style="width: 20%">Nombre Pip</th>
                          <th>Provincia</th>
                          <th>Distrito</th>
                          <th>Nivel de estudio</th>
                          <th>Responsable</th>
                          <th>Costo Inversion</th>
                          <th>Situacion</th>
                          <th>Avance Fisico</th>
                         <!-- <th>Entregable</th>-->
                          <th>Opción</th>

                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <!-- end project list -->

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->




<!-- /.ventana para registrar situacion actual-->
<div class="modal fade" id="VentanaSituacionActual" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Situación </h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-AddSituacion"   action="<?php echo base_url(); ?>frmFormulacion/GetFormulacion" method="POST" >

              <div class="item form-group">
                        <div class="item form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_IdEtapa_Estudio" name="txt_IdEtapa_Estudio" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="text">
                        </div>
                      </div>
                </div>


                <div class="item form-group">
                                     <div class="col-md-4">

                                           <label for="name">Situación Form y Eval.<span class="required"></span>
                                            </label>
                                                 <select   id="Cbx_Situacion" name="Cbx_Situacion" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Etapas FE...">
                                                </select>
                                    </div>
                                             <div class="col-md-4">

                                           <label for="name">Fecha <span class="required"></span>
                                            </label>
                                                  <input type="date" max="2050-12-31" id="dateFechaIniC" name="dateFechaIniC" class="form-control col-md-6 col-xs-5" data-validate-length-range="6" data-validate-words="2" required="required" type="text" value="<?php echo date("Y-m-d"); ?>" disabled="true">
                                          </div>
                      </div>

                <div class="item form-group">
                <div class="col-md-12">
                              <br>
                              <label for="name">Observación<span class="required"></span>
                              </label>
                              <textarea class="form-control" rows="3" name="txadescripcion" id="txadescripcion"></textarea>
                </div>
</div>

                     <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Guardar
                          </button>
                           <button  class="btn btn-danger" data-dismiss="modal">
                             <span class="glyphicon glyphicon-remove"></span>
                            Cerrar
                          </button>
                        </div>
                      </div>
                    </form>
                        </div><!-- /.span -->
                 </div><!-- /.row -->
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
</div>
<!-- /.fin de  ventana registrar situacion actual-->

<!-- /.ventana para registrar Persona-->
<div class="modal fade" id="VentanaAsignarPersona" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Asignar Persona </h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-AddAsiganarPersona"   action="<?php echo base_url(); ?>frmFormulacion/GetFormulacion" method="POST" >

              <div class="item form-group">
                        <div class="item form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_IdEtapa_Estudio_p" name="txt_IdEtapa_Estudio_p" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="text">
                        </div>
                      </div>
                </div>


                <div class="item form-group">
                                     <div class="col-md-4">

                                           <label for="name">Responsable.<span class="required"></span>
                                            </label>
                                                 <select   id="Cbx_Persona" name="Cbx_Persona" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Etapas FE...">
                                                </select>
                                    </div>
                                     <div class="col-md-4">

                                           <label for="name">Cargo.<span class="required"></span>
                                            </label>
                                                 <select   id="Cbx_Cargo" name="Cbx_Cargo" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Etapas FE...">
                                                </select>
                                    </div>
                                             <div class="col-md-4">

                                           <label for="name">Fecha <span class="required"></span>
                                            </label>
                                                  <input type="date" max="2050-12-31" id="dateFechaIniC" name="dateFechaIniC" class="form-control col-md-6 col-xs-5" data-validate-length-range="6" data-validate-words="2" required="required" type="text" value="<?php echo date("Y-m-d"); ?>" disabled="true">
                                          </div>
                      </div>

                <div class="item form-group">
                <div class="col-md-12">
                              <br>
                              <label for="name">Observación<span class="required"></span>
                              </label>
                              <textarea class="form-control" rows="3" name="txadescripcion" id="txadescripcion"></textarea>
                </div>
</div>

                     <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Guardar
                          </button>
                           <button  class="btn btn-danger" data-dismiss="modal">
                             <span class="glyphicon glyphicon-remove"></span>
                            Cerrar
                          </button>
                        </div>
                      </div>
                    </form>
                        </div><!-- /.span -->
                 </div><!-- /.row -->
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
</div>
<!-- /.fin de  ventana Registar Persona-->


  <div class="modal fade" id="VerDetalleFormulacion"  role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">
            <table id="table-DetSitActEvaluacionFE" class="table table-striped projects">
           </table>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
      </div>

    </div>
  </div>
  </div>
