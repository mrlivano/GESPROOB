<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Brechas e Indicadores<small></small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">                                       
                            <ul id="myTab" class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_ServicioPubAsoc"  role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"> <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>  Servicio Público Asociado</a>
                                </li>
                                <li role="presentation" class=""><a  href="#tab_brecha" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Brecha</a>
                                </li>
                                <li role="presentation" class=""><a  href="#tab_Indicador" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Indicador</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_ServicioPubAsoc" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegistraServicioAsociado" >
                                                    <span class="fa fa-plus-circle"></span> Nuevo
                                                </button>
                                                <div class="x_content">
                                                    <table id="tableServicioPublicoAsociado" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>SERVICIO PUBLICO ASOCIADO</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_brecha" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <button type="button" id="btn-NuevaBrecha"  class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegistraBrecha"> <span class="glyphicon glyphicon-plus-sign"></span> Nuevo</button>                                
                                                <div class="x_content">
                                                    <table id="table-brecha" class="table table-condensed table-striped table-bordered table-hover" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-sm-1">ID</th>
                                                                <th class="col-sm-1">ID SERV</th>
                                                                <th >NOMBRE SERVICIO</th>
                                                                <th >BRECHA</th>
                                                                <th >DESCRIPCION</th>
                                                                <th class="col-sm-1"></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_Indicador" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 col-xs-12">
                                            <div class="x_panel">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegistraIndicador"><span class="fa fa-plus-circle"></span> Nuevo </button>
                                                <div class="x_content">
                                                    <table id="table-Indicador" class="table table-striped table-bordered table-hover" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>NOMBRE DE INDICADOR</th>
                                                                <th>DEFINICION INDICADOR</th>
                                                                <th>UNIDAD DE MEDIDA</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
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
        		
<div class="modal fade" id="VentanaRegistraBrecha" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registrar Nueva Brecha</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">                             
            <form class="form-horizontal " id="frmAddBrecha" action="" method="POST">
                <div id="validarBrecha">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textbox"><span class="required">Servicio publico asociado  </span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="cbxServPubAsoc" name="cbxServPubAsoc" class="selectpicker" data-live-search="true"  title="Seleccion servicio publico">                             
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txt_NombreBrecha">Nombre de la brecha<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_NombreBrecha" name="txt_NombreBrecha" class="form-control col-md-7 col-xs-12" placeholder="Nombre de la brecha" type="text" >
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtArea_DescBrecha">Descripcion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="txtArea_DescBrecha" name="txtArea_DescBrecha" placeholder="Descripcion" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>                        
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button  type="submit" class="btn btn-success"><span class="fa fa-save"></span> Guardar</button>
                        <button  class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> Cerrar</button>                    
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



<div class="modal fade" id="VentanaModificarBrecha" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Brecha</h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-xs-12">                
            <form class="form-horizontal " id="form-ActualizarBrecha" action="<?php echo  base_url();?>MantenimientoBrecha/UpdateBrecha" method="POST" >
                <div id="ActualizarBrecha">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-6">Servicio Publico Asociado</label>
                        <div class="col-md-6 col-sm-9 col-xs-6">
                            <select id="cbxSerPubAsocModificar" name="cbxSerPubAsocModificar" class="selectpicker" data-live-search="true">                            
                            </select>
                        </div>
                    </div> 
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de la brecha<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_IdBrechaModif" type="hidden" name="txt_IdBrechaModif" type="text">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_NombreBrechaU" name="txt_NombreBrechaU" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name"  required="required" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Descripcion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="txtArea_DescBrechaU" name="txtArea_DescBrechaU" required="required" name="textarea" placeholder="Descripcion de la brecha" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
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
            <form class="form-horizontal form-label-left" id="form-addIndicador" action="<?php echo  base_url();?>Indicador/AddIndicador" method="POST">
                <div id="validarIndicador">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre Indicador<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_NombreIndicador" class="form-control col-md-7 col-xs-12" name="txt_NombreIndicador" placeholder="Nombre indicador" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Definicion indicador<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="txtArea_DefIndicador" name="txtArea_DefIndicador" placeholder="Definicion Indicador" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Unidad medida <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_UnidadMedida" class="form-control col-md-7 col-xs-12"  name="txt_UnidadMedida" placeholder="Unidad de medida" type="text">
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success"><span class="fa fa-save"> </span> Guardar</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> Cerrar</button>
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

<div class="modal fade" id="VentanaModificarIndicador" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar un Indicador</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-xs-12">
            <form class="form-horizontal " id="form-ActualizarIndicador" action="<?php echo  base_url();?>Indicador/UpdateIndicador" method="POST" >
                <div id="actualizarIndicador">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre del Indicador<span>*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_IdIndicadorModif" type="hidden" name="txt_IdIndicadorModif" type="text">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_NombreIndicadorU" name="txt_NombreIndicadorU" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Definicion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="txtArea_DefIndicadorU" name="txtArea_DefIndicadorU" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Unidad de medida<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_UnidadMedidaU" name="txt_UnidadMedidaU" class="form-control col-md-7 col-xs-12" type="text">
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button  type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Guardar
                        </button>
                        <button type="submit" data-dismiss="modal" class="btn btn-danger">
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

  

<div class="modal fade" id="VentanaRegistraServicioAsociado" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar Nuevo Servicio Público Asociado</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal form-label-left"  id="frmRegistroServicioPublico">
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de Servicio Público Asociado <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="textarea_servicio_publicoA"  name="textarea_servicio_publicoA" class="form-control" placeholder="Nombre de Servicio Público Asociado"></textarea>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <input type="button" value="Guardar" class="btn btn-success" onclick="guardarServicio();">
                                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<div class="modal fade" id="UpdateServicioAsociado" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Actualizar Servicio Público Asociado</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-xs-12">
                 <!-- FORMULARIO PARA REGISTRA NUEVO SERVICIO ASOCIADO-->
                <form class="form-horizontal form-label-left"  id="form-UpdateServicioAsociado" action="<?php echo  base_url();?>MSectorEntidadSpu/UpdateServicioAsociado" method="POST">
                      <div class="item form-group" id="ValidarServicio">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de Servicio Público Asociado <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="id_servicio_publicoA" name="id_servicio_publicoA" type="hidden">
                        <textarea id="textarea_servicio_publicoAA"  name="textarea_servicio_publicoAA" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Nombre de Servicio Público Asociado" type="text"></textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="btnActualizarServicio" type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Guardar
                          </button>
                           <button type="button" class="btn btn-danger" data-dismiss="modal">
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
