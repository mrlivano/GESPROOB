<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Mantenimiento</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
<!--Inicio primer panel General-->
      <div class="clearfix"></div>
        <div class="">
          <div class="col-md-12 col-sm-6 col-xs-12">
             <div class="x_panel">
             <!--inicio de pestaña configurtacion-->
                <div class="x_title">
                     <h2><i class="fa fa-bars"></i> PIP <small>Tablas Generales.</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                      </li>
                                      <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                          <li><a href="#">Conguración 1</a>
                                          </li>
                                          <li><a href="#">Conguración 2</a>
                                          </li>
                                        </ul>
                                      </li>
                                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                                      </li>
                                    </ul>
                      <div class="clearfix"></div>
                </div>
              <!--final  de pestaña configurtacion-->
                       <div class="x_content">
                           <div class="" role="tabpanel" data-example-id="togglable-tabs">
                             <!-- Inicio Menus-->
                                <ul id="myTab" class="nav nav-tabs" role="tablist">
                                         <li role="presentation" class="active"><a href="#tab_NaturalezaInversion" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                                         Naturaleza de Inversión</a>
                                         </li>
                                         <li role="presentation" class=""><a href="#tab_TipologiaInversion" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                        <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                                         Tipología de Inversión</a>
                                         </li>
                                         <li role="presentation" class=""><a href="#tab_TipoInversion" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                        <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                                         Tipo de Inversión</a>
                                         </li>

                                </ul>
                              <!-- Fin Menus-->
                                      <div id="myTabContent" class="tab-content">
                                             <!-- /Inicio Contenido del Naturaleza de Inversion -->
                                           <div role="tabpanel" class="tab-pane fade active in" id="tab_NaturalezaInversion" aria-labelledby="home-tab">
                                        <!-- /Inicio tabla de Naturaleza desde el row -->
                                           <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                              <div class="x_panel">
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegistrarNaturalezaInversion" >
                                                          <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Nuevo
                                                    </button>
                                                    <div class="x_title">
                                                            <h2>Listado de  Naturaleza de Inversión<small>.</small></h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                              </li>
                                                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                              </li>
                                                            </ul>
                                                           <div class="clearfix"></div>
                                                      </div>
                                                      <!--inicio de la tabla Naturaleza de Inversion -->
                                                        <!--inicio  de icono de reporte -->
                                                        <div class="clearfix">
                                                           <div class="pull-right tableTools-container">
                                                           </div>
                                                        </div>
                                                      <!--fin  de icono de reporte -->
                                                      <div class="x_content">
                                                                <table id="dynamic-table-NaturalezaInversion" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                       <tr>
                                                                         <th class="center">
                                                                          <label class="pos-rel">
                                                                           <input type="checkbox" class="ace" />
                                                                           <span class="lbl"></span>
                                                                          </label>
                                                                         </th>
                                                                         <th class="hidden-10" >ID NATURALEZA</th>
                                                                         <th>NOMBRE NATURALEZA</th>
                                                                         <th class="hidden-480">DESCRIPCION NATURALEZA</th>
                                                                         <th></th>
                                                                      </tr>
                                                                   </thead>

                                                                </table>
                                                      </div>
                                                      <!--fin de la tabla naturaleza de Inversion -->
                                           </div>
                                              </div>
                                           </div>
                                        <!-- / fin tabla naturaleza desde el row -->
                                        </div>
                                        <!-- /fin del Contenido del Naturaleza de Inversion -->
                                        <!-- /Inicio del Contenido del Tipologia de Inversion -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab_TipologiaInversion" aria-labelledby="profile-tab">
                                        <!-- /Inicio tabla de Tipologia desde el row -->
                                           <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                              <div class="x_panel">
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegTipologiaInversion" >
                                                          <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Nuevo
                                                    </button>

                                                    <div class="x_title">
                                                            <h2>Listado de  Tipología de Inversión<small>.</small></h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                              </li>
                                                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                              </li>
                                                            </ul>
                                                           <div class="clearfix"></div>
                                                      </div>
                                                      <!--inicio de la tabla tipologia de Inversion -->
                                                        <!--inicio  de icono de reporte -->
                                                        <div class="clearfix">
                                                           <div class=" pull-right tableTools-container-TipologiaInversion">
                                                           </div>
                                                        </div>
                                                      <!--fin  de icono de reporte -->
                                                      <div class="x_content">

                                                                <table id="dynamic-table-TipologiaInversion" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                       <tr>
                                                                         <th class="center">
                                                                          <label class="pos-rel">
                                                                           <input type="checkbox" class="ace" />
                                                                           <span class="lbl"></span>
                                                                          </label>
                                                                         </th>
                                                                         <th>ID TIPOLOGIA</th>
                                                                         <th>NOMBRE TIPOLOGIA</th>
                                                                         <th class="hidden-480">DESCRIPCION TIPOLOGIA</th>
                                                                         <th></th>
                                                                      </tr>
                                                                   </thead>
                                                                    <tbody>
                                                                    </tbody>

                                                                </table>
                                                      </div>
                                                      <!--fin de la tabla tipologia de Inversion -->
                                           </div>
                                              </div>
                                           </div>
                                        <!-- / fin tabla Tipologia desde el row -->
                                        </div>
                                        <!-- /fin del Contenido del Tipologia de Inversion -->
                                        <!-- /Inicio del Contenido del tipo de Inversion -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab_TipoInversion" aria-labelledby="profile-tab">
                                        <!-- /Inicio tabla de TipoInversion desde el row -->
                                           <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                              <div class="x_panel">
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegTipoInversion" >
                                                          <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Nuevo
                                                    </button>
                                                    <div class="x_title">
                                                            <h2>Listado de  Tipo de Inversión<small>.</small></h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                              </li>
                                                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                              </li>
                                                            </ul>
                                                           <div class="clearfix"></div>
                                                      </div>
                                                      <!--inicio de la tabla tipo de Inversion -->
                                                        <!--inicio  de icono de reporte -->
                                                        <div class="clearfix">
                                                           <div class=" pull-right tableTools-container-TipoInversion">
                                                           </div>
                                                        </div>
                                                      <!--fin  de icono de reporte -->
                                                      <div class="x_content">
                                                                <table id="dynamic-table-TipoInversion" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                       <tr>
                                                                         <th class="center">
                                                                          <label class="pos-rel">
                                                                           <input type="checkbox" class="ace" />
                                                                           <span class="lbl"></span>
                                                                          </label>
                                                                         </th>
                                                                         <th>ID TIPO</th>
                                                                         <th>NOMBRE TIPO</th>
                                                                         <th class="hidden-480">DESCRIPCION TIPO</th>
                                                                         <th></th>
                                                                      </tr>
                                                                   </thead>

                                                                </table>
                                                      </div>
                                                      <!--fin de la tabla tipologia de Inversion -->
                                           </div>
                                              </div>
                                           </div>
                                        <!-- / fin tabla TipoInversion desde el row -->
                                        </div>
                                        <!-- /fin del Contenido del tipo de Inversion -->
                                     </div>
                               </div>
                      </div>
             </div>
           </div>
          </div>
      <div class="clearfix"></div>
  <!--fin primer panel General-->
<!--Inicio segundo panel General-->
      <div class="clearfix"></div>
        <div class="">
          <div class="col-md-12 col-sm-6 col-xs-12">
             <div class="x_panel">
             <!--inicio de pestaña configurtacion-->
                <div class="x_title">
                     <h2><i class="fa fa-bars"></i> PIP <small>Tablas Generales</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                      </li>
                                      <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                          <li><a href="#">Conguración 1</a>
                                          </li>
                                          <li><a href="#">Conguración 2</a>
                                          </li>
                                        </ul>
                                      </li>
                                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                                      </li>
                                    </ul>
                      <div class="clearfix"></div>
                </div>
              <!--final  de pestaña configurtacion-->
                       <div class="x_content">
                           <div class="" role="tabpanel" data-example-id="togglable-tabs">
                             <!-- Inicio Menus-->
                                <ul id="myTab" class="nav nav-tabs" role="tablist">
                                         <li role="presentation" class="active"><a href="#tab_EstadoCicloInversion" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                                         Estado de Ciclo Inversión</a>
                                         </li>
                                         <li role="presentation" class=""><a href="#tab_NivelGobierno" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                        <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                                         Nivel de Gobierno</a>
                                         </li>
                                         <li role="presentation" class=""><a href="#tab_FuenteFinanciamiento" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                        <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
                                         Fuente de Financiamiento</a>
                                         </li>

                                </ul>
                              <!-- Fin Menus-->
                                      <div id="myTabContent" class="tab-content">
                                             <!-- /Inicio Contenido del estado ciclo de inversionn -->
                                           <div role="tabpanel" class="tab-pane fade active in" id="tab_EstadoCicloInversion" aria-labelledby="home-tab">
                                        <!-- /Inicio tabla estado  ciclo de inversion desde el row -->
                                           <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                              <div class="x_panel">
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegEstadoCicloInversion" >
                                                          <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Nuevo
                                                    </button>
                                                    <div class="x_title">
                                                            <h2>Listado de  Ciclo Inversión<small>.</small></h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                              </li>
                                                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                              </li>
                                                            </ul>
                                                           <div class="clearfix"></div>
                                                      </div>
                                                      <!--inicio de la tabla estado ciclo de inversion -->
                                                        <!--inicio  de icono de reporte -->
                                                        <div class="clearfix">
                                                           <div class="pull-right tableTools-container-EstadoCicloInversion">
                                                           </div>
                                                        </div>
                                                      <!--fin  de icono de reporte -->
                                                      <div class="x_content">
                                                                <table id="dynamic-table-EstadoCicloInversion" class="table table-striped table-bordered table-hover" with="100%" >
                                                                    <thead>
                                                                       <tr>
                                                                         <th class="center">
                                                                          <label class="pos-rel">
                                                                           <input type="checkbox" class="ace" />
                                                                           <span class="lbl"></span>
                                                                          </label>
                                                                         </th>
                                                                         <th>ID CICLO</th>
                                                                         <th>NOMBRE CICLO</th>
                                                                         <th class="hidden-480">DESCRIPCION CICLO</th>
                                                                         <th></th>
                                                                      </tr>
                                                                   </thead>
                                                                </table>
                                                      </div>
                                                      <!--fin de la tabla estado ciclo de inversion -->
                                           </div>
                                              </div>
                                           </div>
                                        <!-- / fin tabla estado del ciclo dede inversion desde el row -->
                                        </div>
                                        <!-- /fin del Contenido del estado del ciclo de Inversion -->
                                        <!-- /Inicio del Contenido del Tipologia de Inversion -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab_NivelGobierno" aria-labelledby="profile-tab">
                                        <!-- /Inicio tabla de Tipologia desde el row -->
                                           <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                              <div class="x_panel">
                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegNivelGobierno" >
                                                          <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Nuevo
                                                    </button>
                                                    <div class="x_title">
                                                            <h2>Listado de Nivel de Gobierno<small>.</small></h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                              </li>
                                                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                              </li>
                                                            </ul>
                                                           <div class="clearfix"></div>
                                                      </div>
                                                      <!--inicio de la tabla nivel de gobierno -->
                                                        <!--inicio  de icono de reporte -->
                                                        <div class="clearfix">
                                                           <div class=" pull-right tableTools-container-NivelGobierno">
                                                           </div>
                                                        </div>
                                                      <!--fin  de icono de reporte -->
                                                      <div class="x_content">
                                                                <table id="dynamic-table-NivelGobierno" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                       <tr>
                                                                         <th class="center">
                                                                          <label class="pos-rel">
                                                                           <input type="checkbox" class="ace" />
                                                                           <span class="lbl"></span>
                                                                          </label>
                                                                         </th>
                                                                         <th>ID </th>
                                                                         <th>NOMBRE NIVEL</th>
                                                                         <th class="hidden-480">DESCRIPCION </th>
                                                                         <th></th>
                                                                      </tr>
                                                                   </thead>

                                                                </table>
                                                      </div>
                                                      <!--fin de la tabla nivel de gobierno-->
                                           </div>
                                              </div>
                                           </div>
                                        <!-- / fin tabla nivel de gobierno desde  el row -->
                                        </div>
                                        <!-- /fin del Contenido del NIvel de gobeirno -->
                                        <!-- /Inicio del Contenido de fuente de financiamiento -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab_FuenteFinanciamiento" aria-labelledby="profile-tab">
                                        <!-- /Inicio tabla de fuente financiamiento desde el row -->
                                           <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                              <div class="x_panel">
                                                   <button type="button" id="btn-FuenteFinanciamiento" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegFuenteFinanciamiento" >
                                                          <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Nuevo
                                                    </button>
                                                    <div class="x_title">
                                                            <h2>Listado de  Fuente de Financiamiento<small>.</small></h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                              </li>
                                                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                              </li>
                                                            </ul>
                                                           <div class="clearfix"></div>
                                                      </div>
                                                      <!--inicio de la tabla fuente de financiamiento -->
                                                        <!--inicio  de icono de reporte -->
                                                        <div class="clearfix">
                                                           <div class=" pull-right tableTools-container-FuenteFinanciamiento">
                                                           </div>
                                                        </div>
                                                      <!--fin  de icono de reporte -->
                                                      <div class="x_content">
                                                                <table id="dynamic-table-FuenteFinanciamiento" class="table table-striped table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                       <tr>
                                                                         <th class="center">
                                                                          <label class="pos-rel">
                                                                           <input type="checkbox" class="ace" />
                                                                           <span class="lbl"></span>
                                                                          </label>
                                                                         </th>
                                                                         <th>ID</th>
                                                                         <th>RUBRO</th>
                                                                         <th>NOMBRE FFTO</th>
                                                                         <th >ACRONIMO FFTO</th>
                                                                         <th class="hidden-480">DESCRIPCION</th>
                                                                         <th></th>
                                                                      </tr>
                                                                   </thead>

                                                                </table>
                                                      </div>
                                                      <!--fin de la tabla fuente de finaciamiento -->
                                           </div>
                                              </div>
                                           </div>
                                        <!-- / fin tabla fuente de financiamiento desde el row -->
                                        </div>
                                        <!-- /fin del Contenido fuente de financiamiento -->
                                     </div>
                               </div>
                      </div>
             </div>
           </div>
          </div>
      <div class="clearfix"></div>
  <!--fin segundo panel General-->
        </div>
     </div>

<!-- /.ventana para modificar  nueva Naturaleza de inversion-->
<div class="modal fade" id="VentanaRegNaturalezaInversion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Naturaleza de Inversión </h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
                  <form class="form-horizontal " id="form-EditNaturalezaInversion"   action="<?php echo base_url(); ?>pip/get_NaturalezaInversion" method="POST" >

                  <div class="item form-group">
                      <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID Naturaleza <span class="required">*</span>
                        </label>-->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_IdNaturalezaM" name="txt_IdNaturalezaM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"     type="hidden" >
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre Naturaleza <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  id="txt_NombreNaturalezaM" name="txt_NombreNaturalezaM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre del Naturaleza" required="required" type="text" >
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Descripcion Naturaleza<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="txt_DescripcionNaturalezaM" name="txt_DescripcionNaturalezaM"  placeholder="Descripcion Naturaleza" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para modificar nueva Naturaleza de inversion-->
<!-- /.ventana para Registar  nueva Naturaleza de inversion-->
<div class="modal fade" id="VentanaRegistrarNaturalezaInversion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Naturaleza de Inversión </h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
                  <form class="form-horizontal " id="form-AddNaturalezaInversion"   action="<?php echo base_url(); ?>pip/AddNaturalezaInversion" method="POST" >

                  <!--<div class="item form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID Naturaleza <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_IdNaturaleza" name="txt_IdNaturaleza" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required"   type="text" >
                        </div>
                      </div>-->

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre Naturaleza <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreNaturaleza" name="txt_NombreNaturaleza" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre del Naturaleza" required="required" type="text" >
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Descripcion Naturaleza<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="txt_DescripcionNaturaleza" name="txt_DescripcionNaturaleza"   placeholder="Descripcion Naturaleza" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para registra nueva Naturaleza de inversion-->

<!-- /.ventana para registra una nueva tipologia de inversion-->
<div class="modal fade" id="VentanaRegTipologiaInversion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Tipología de Inversión</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-AddTipologiaInversion"   action="<?php echo base_url(); ?>pip/AddTipologiaInversion" method="POST" >
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreTipologiaInversion" name="txt_NombreTipologiaInversion" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre" required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionTipologiaInversion" name="txt_DescripcionTipologiaInversion" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripción"  type="text">
                        </div>
                      </div>
                           <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para registra una tipologia de inversion-->

<!-- /.ventana para modificar una nueva tipologia de inversion-->
<div class="modal fade" id="VentanaEditTipologiaInversion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Tipología de Inversión</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-EditTipologiaInversion"   action="<?php echo base_url(); ?>pip/get_TipologiaInversion" method="POST" >

               <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_IdTipologiaInversionM" name="txt_IdTipologiaInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="text">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreTipologiaInversionM" name="txt_NombreTipologiaInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre " required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripccion
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionTipologiaInversionM" name="txt_DescripcionTipologiaInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripccion " type="text">
                        </div>
                      </div>
                           <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para modificar una tipologia de inversion-->

<!-- /.ventana para registra una nueva TIPO de inversion-->
<div class="modal fade" id="VentanaRegTipoInversion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Tipo de Inversión</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-AddTipoInversion"   action="<?php echo base_url(); ?>pip/AddTipoInversion" method="POST" >
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreTipoInversion" name="txt_NombreTipoInversion" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre" required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionTipoInversion" name="txt_DescripcionTipoInversion" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripción"  type="text">
                        </div>
                      </div>
                           <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para registra una TIPO de inversion-->

<!-- /.ventana para modificar una  TIPO de inversion-->
<div class="modal fade" id="VentanaEditTipoInversion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Tipo de Inversión</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-EditTipoInversion"   action="<?php echo base_url(); ?>pip/get_TipoInversion" method="POST" >

               <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_IdTipoInversionM" name="txt_IdTipoInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="text">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreTipoInversionM" name="txt_NombreTipoInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre " required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripcción
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionTipoInversionM" name="txt_DescripcionTipoInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripccion" type="text">
                        </div>
                      </div>
                           <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para modificar una TIPO de inversion-->

<!-- /.ventana para registra una nueva estado ciclo de inversion-->
<div class="modal fade" id="VentanaRegEstadoCicloInversion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Estado Ciclo de Inversión</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-AddEstadoCicloInversion"   action="<?php echo base_url(); ?>pip/AddEstadoCicloInversion" method="POST" >
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreEstadoCicloInversion" name="txt_NombreEstadoCicloInversion" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre" required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionEstadoCicloInversion" name="txt_DescripcionEstadoCicloInversion" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripción"  type="text">
                        </div>
                      </div>
                           <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para registra una estado ciclo de inversion-->

<!-- /.ventana para modificar una  estado ciclo de inversion-->
<div class="modal fade" id="VentanaEditEstadoCicloInversion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Estado Ciclo de Inversión</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-EditEstadoCicloInversion"   action="<?php echo base_url(); ?>pip/get_EstadoCicloInversion" method="POST" >

               <div class="item form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_IdEstadoCicloInversionM" name="txt_IdEstadoCicloInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreEstadoCicloInversionM" name="txt_NombreEstadoCicloInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre " required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripccion
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionEstadoCicloInversionM" name="txt_DescripcionEstadoCicloInversionM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripccion " type="text">
                        </div>
                      </div>
                               <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para modificar una estado ciclo de inversion-->


<!-- /.ventana para registra una nueva  nivel de gobierno-->
<div class="modal fade" id="VentanaRegNivelGobierno" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Nivel de Gobierno</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-AddNivelGobierno"   action="<?php echo base_url(); ?>pip/AddNivelGobierno" method="POST" >
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreNivelGobierno" name="txt_NombreNivelGobierno" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre" required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionNivelGobierno" name="txt_DescripcionNivelGobierno" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripción" type="text">
                        </div>
                      </div>
                           <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para registra una nivel de gobierno-->

<!-- /.ventana para modificar una  nivel de gobierno-->
<div class="modal fade" id="VentanaEditNivelGobierno" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          NIvel de Gobierno</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-EditNivelGobierno"   action="<?php echo base_url(); ?>pip/get_NivelGobierno" method="POST" >

               <div class="item form-group">

                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_IdNivelGobiernoM" name="txt_IdNivelGobiernoM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                        </div>
                      </div>


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreNivelGobiernoM" name="txt_NombreNivelGobiernoM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre " required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripccion
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionNivelGobiernoM" name="txt_DescripcionNivelGobiernoM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripccion "  type="text">
                        </div>
                      </div>
                           <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                       <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>
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
<!-- /.fin ventana para modificar una estado nivel de gobierno-->







<!-- /.ventana para registra una fuente finanaciamietno-->
<div class="modal fade" id="VentanaRegFuenteFinanciamiento" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Fuente Financiamiento</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-AddFuenteFinanciamiento"   action="<?php echo base_url(); ?>pip/AddFuenteFinanciamiento" method="POST" >
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreFuenteFinanciamiento" name="txt_NombreFuenteFinanciamiento" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre" required="required" type="text">
                        </div>
                      </div>
                          <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Acronimo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_AcronimoFuenteFinanciamiento" name="txt_AcronimoFuenteFinanciamiento" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Acronimo " type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionFuenteFinanciamiento" name="txt_DescripcionFuenteFinanciamiento" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripción"  type="text">
                        </div>
                      </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textbox">Rubro<span class="required">*</span>
                            </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="cbxRubroEjecucion" name="cbxRubroEjecucion" class="selectpicker" data-live-search="true" required="required" title="Buscar Funcion...">
                              </select>
                          </div>
                       </div>
                        <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>

                        </div>
                      </div>
                    </form>
                        </div><!-- /.span -->
                 </div><!-- /.row -->
        </div>
       <div class="modal-footer">
          <center>*  Son campos obligatorios.</center>
        </div>
      </div>
    </div>
</div>
<!-- /.fin ventana para registra fuente financiamiento-->

<!-- /.ventana para modificar fuente de financimeito-->
<div class="modal fade" id="VentanaEditFuenteFinanciamiento" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Fuente Financiamiento</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-EditFuenteFinanciamiento"   action="<?php echo base_url(); ?>pip/get_FuenteFinanciamiento" method="POST" >

               <div class="item form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_IdFuenteFinanciamientoM" name="txt_IdFuenteFinanciamientoM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre FFTO <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_NombreFuenteFinanciamientoM" name="txt_NombreFuenteFinanciamientoM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre " required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Acronimo FFTO <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_AcronimoFuenteFinanciamientoM" name="txt_AcronimoFuenteFinanciamientoM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Nombre " required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripccion FFTO <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_DescripcionFuenteFinanciamientoM" name="txt_DescripcionFuenteFinanciamientoM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="Descripccion " required="required" type="text">
                        </div>
                      </div>
                       <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textbox">Rubro<span class="required">*</span>
                            </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <select id="cbxRubroEjecucionM" name="cbxRubroEjecucionM" required="required" class="selectpicker" data-live-search="true"  title="Buscar Funcion...">
                              </select>
                          </div>
                       </div>

                           <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success" >
                          <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                           Guardar</button>
                          <button type="button" value="Borrar información"  class="btn btn-danger"  data-dismiss="modal"  >
                          <span class="glyphicon glyphicon-floppy-remove" aria-hidden="true"></span>
                           Cancelar</button>

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
<!-- /.fin ventana para modificar fuente de financiamietno-->

