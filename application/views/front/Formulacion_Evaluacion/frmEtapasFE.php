<div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="">
              <div class="col-md-12 col-xs-12">
                                <div class="x_panel">
                                  <div class="x_title">
                                    <h2><b>ETAPAS DE FORMULACION Y EVALUACION</b></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">

                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                      <ul id="myTab" class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_etapasFE" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Etapas</b></a>
                                        </li>
                                      </ul>
                                      <div id="myTabContent" class="tab-content">
                                             <!-- /Contenido del funcion -->
                                        <div role="tabpanel" class="tab-pane fade active in" id="#tab_etapasFE" aria-labelledby="home-tab">
                                             <!-- /tabla de funcion desde el row -->
                                            <div class="row">

                                                  <div class="col-md-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#VentanaEtapasFE" >
                                                                      <span class="fa fa-plus-circle"></span>
                                                                Nuevo
                                                            </button>
                                                          <div class="x_title">
                                                            <div class="clearfix"></div>
                                                          </div>

                                                          <div class="x_content">

                                                            <table id="table-EtapasFE" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                                              <thead>
                                                                <tr>
                                                                  <td>Id</td>
                                                                  <td>Etapas</td>
                                                                  <td></td>
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
                                      </div>
                                    </div>

                                  </div>
                                </div>
              </div>

          </div>
          <div class="clearfix"></div>
        </div>
     </div>

    <!--- popul para modificar la ventana de insertar Entidad -->
<div class="modal fade" id="VentanaEtapasFE" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar Nueva Etapa
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-xs-12">
                <form class="form-horizontal " id="form-addEtapasFE"  method="POST" >

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Denominacion de etapas<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_EtapasFE" name="txt_EtapasFE" pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]*$|" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Denominacion de etapa" required="required" type="text">
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
                </form><!-- FORMULARIO FIN PARA REGISTRA NUEVO SERVICIO ASOCIADO -->
            </div><!-- /.span -->
        </div><!-- /.row -->
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>



<!-- fin popul para modificar la ventana de modificarentidaa -->
<!--- popul para modificar la ventana de insertar  etapa-->
<div class="modal fade" id="VentanaEtapasDenominacion" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Etapas</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-xs-12">
                <form class="form-horizontal" id="form-EtapasDenominacion"  method="POST" >

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de Etapa<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="id_etapa_fe" name="id_etapa_fe" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"   required="required" type="hidden">
                          <input id="denom_etapas_fe"  pattern="|^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]*$|" name="denom_etapas_fe" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"   required="required" type="text">
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
                </form><!-- FORMULARIO FIN PARA REGISTRA NUEVO SERVICIO ASOCIADO -->
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
