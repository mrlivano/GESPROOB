<div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="">
              <div class="col-md-12 col-xs-12">
                                <div class="x_panel">
                                  <div class="x_title">
                                    <h2><b>TIPOS DE ESTUDIO</b></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">

                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                      <ul id="myTab" class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_tipo_estudioFE" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Tipos de Estudios</b> </a>
                                        </li>
                                         <li role="presentation" class=""><a href="#tab_nivelInversio"  role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"> <b>Nivel de Estudios</b></a>
                                        </li>
                                      </ul>
                                      <div id="myTabContent" class="tab-content">
                                             <!-- /Contenido del funcion -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab_documento" aria-labelledby="home-tab">
                                             <!-- /tabla de funcion desde el row -->
                                            <div class="row">

                                                  <div class="col-md-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#VentanaRegistraFuncion" >
                                                                      <span class="fa fa-plus-circle"></span>

                                                                Nuevo
                                                            </button>
                                                          <div class="x_title">

                                                            <ul class="nav navbar-right panel_toolbox">

                                                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                              </li>

                                                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                              </li>

                                                            </ul>
                                                            <div class="clearfix"></div>
                                                          </div>

                                                          <div class="x_content">

                                                            <table id="table-Funcion" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                                              <thead>
                                                                <tr>
                                                                </tr>
                                                              </thead>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>

                                            </div>
                                         <!-- / fin tabla de funcion desde el row -->
                                        </div>
                                        <!-- /fin del funcion del sector -->
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_tipo_estudioFE" aria-labelledby="profile-tab">

                                            <!-- /tabla de division funcional desde el row -->
                                          <div class="row">

                                                  <div class="col-md-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#VentanaTipoEstudio" >
                                                                      <span class="fa fa-plus-circle"></span>

                                                                Nuevo
                                                            </button>
                                                          <div class="x_title">

  
                                                            <div class="clearfix"></div>
                                                          </div>

                                                          <div class="x_content">

                                                            <table id="table-TipEstudioFE" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                                              <thead>
                                                                <tr>
                                                                  <td>ID</td>
                                                                  <td>Tipo de Estudio</td>
                                                                  <td></td>
                                                                </tr>
                                                              </thead>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>

                                            </div>


                                         <!-- / fin tabla division funcional desde el row -->
                                        </div>
                                          <!-- / fin panel grupo  funcional desde el row -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab_nivelInversio" aria-labelledby="profile-tab">
                                             <!-- /tabla de grupo funcional desde el row -->
                                            <div class="row">

                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button type="button" id="btn_nuevoGrupoFuncional" class="btn btn-primary" data-toggle="modal" data-target="#VentanaNivelEstudio">
                                                            <span class="fa fa-plus-circle"></span>
                                                                Nuevo</button>
                                                          <div class="x_title">
                                                            <div class="clearfix"></div>
                                                          </div>
                                                          <div class="x_content">
                                                            <table id="table-NivelEstudio" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                                              <thead>
                                                                <tr>
                                                                  <td>ID</td>
                                                                  <td>Nivel de Estudio</td>
                                                                  <td></td>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                              </tbody>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>

                                            </div>
                                         <!-- / fin tabla grupo funcional asociados el row -->
                                        </div>
                                      </div>
                                    </div>

                                  </div>
                                </div>
              </div>


          </div>
          <div class="clearfix"></div>
        </div>
     </div>
<div class="modal fade" id="VentanaTipoEstudio" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar Nuevo Tipo de estudio</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
            <form class="form-horizontal " id="form-addTipoEstudioFE"  method="POST" >
            <div id="ValidarNuevoTipoEstudio">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txt_tipoEstudioFE">Tipo Estudio<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_tipoEstudioFE" name="txt_tipoEstudioFE" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button  type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> <span class="glyphicon glyphicon-remove"></span> Cerrar</button>
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

<div class="modal fade" id="VentanaNivelEstudio" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar Nuevo Nivel de Estudio</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-xs-12">
                <form class="form-horizontal " id="form-addNivelEstudio"  method="POST" >

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de nivel de estudio<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="denom_nivel_estudio" name="denom_nivel_estudio" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"   required="required" type="text">
                        </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">

                          <button  type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Guardar
                          </button>
                          <button type="submit" class="btn btn-danger" data-dismiss="modal">
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

  <div class="modal fade" id="VentanaNivelEstudioUpdate" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Actualizar Nivel de Estudio</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-xs-12">
                <form class="form-horizontal " id="form-UpdateFEnivelEstudio"  method="POST" >

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de nivel de estudio<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="Id_denom_nivel_estudioA" name="Id_denom_nivel_estudioA" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"   required="required" type="hidden">
                           <input id="txt_denom_nivel_estudioA" name="txt_denom_nivel_estudioA" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"   required="required" type="text">
                        </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">

                          <button  type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Guardar
                          </button>
                          <button type="submit" class="btn btn-danger" data-dismiss="modal">
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

  <div class="modal fade" id="ventanaActualizarTipoEstudio" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Actualizar Tipo de Estudio</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-xs-12">
                <form class="form-horizontal " id="form-UpdateTipoEstudioFE"  method="POST" >
                    <div class="item form-group" id="ActualizarTipoEstudio">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txt_tipoEstudioFEModi">Tipo Estudio<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="id_tipoEstudioFEModi" name="id_tipoEstudioFEModi" class="form-control col-md-7 col-xs-12" required="required" type="hidden">
                            <input id="txt_tipoEstudioFEModi" name="txt_tipoEstudioFEModi" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button  type="submit" class="btn btn-success">
                              <span class="glyphicon glyphicon-floppy-disk"></span>
                              Guardar
                            </button>
                            <button type="submit" class="btn btn-danger" data-dismiss="modal">
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
<script>
  $('.modal').on('hidden.bs.modal', function(){ 
    $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
    $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
  });
</script>
