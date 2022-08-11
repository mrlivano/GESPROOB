<style>
    .mayuscula
    {
        text-transform: uppercase;
    }
</style>
<div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="">
              <div class="col-md-12 col-xs-12">
                                <div class="x_panel">
                                  <div class="x_title">
                                    <h2><b>PERSONAL</b></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                    </ul>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">


                                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                      <ul id="myTab" class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_Sector" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"> <b>Personal</b></a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_Persona_Juridica" id="profile-tab0" data-toggle="tab" aria-expanded="false"> <b>Persona Jurídica</b></a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_Entidad" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"> <b>Cargo</b> </a>
                                        </li>
                                        <li role="presentation" class=""><a href="#user_type" role="tab"  id="profile-tab2" data-toggle="tab" aria-expanded="false"> <b>Tipo de Usuario</b> </a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab-especialidad" role="tab"  id="profile-tab3" data-toggle="tab" aria-expanded="false"> <b>Especialidad</b> </a>
                                        </li>
                                      </ul>
                                      <div id="myTabContent" class="tab-content">
                                             <!-- /Contenido del Personal -->
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
                                             <!-- /tabla de Personal desde el row -->
                                            <div class="row">

                                                  <div class="col-md-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button  type="button" id="btn_nuevoPersonal" class="btn btn-primary " data-toggle="modal" data-target="#VentanaRegistraPersonal" >
                                                                      <span class="fa fa-plus-circle"></span>

                                                                Nuevo
                                                            </button>
                                                          <div class="x_title">

                                                            <div class="clearfix"></div>
                                                          </div>

                                                          <div class="x_content">
                                                            <table id="table-Personal" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                              																<thead>
                              																	<tr>
                                                                  <th>ID</th>
                              																		<th>DNI</th>
                              																		<th>A. Paterno</th>
                              																		<th>A. Materno</th>
                              																		<th>Nombres</th>
                              																		<th>Direción</th>
                              																		<th>Grado académico</th>
                              																		<th>Especialidad</th>
                              																		<th>ACCIONES</th>
                              																	</tr>
                              																</thead>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>

                                            </div>
                                         <!-- / fin tabla de Personal desde el row -->
                                        </div>
                                        <!-- /fin del Personal del sector -->
                                           <!-- /Contenido del Persona Juridica -->
                                           <div role="tabpanel" class="tab-pane fade" id="tab_Persona_Juridica" aria-labelledby="profile-tab0">
                                             <!-- /tabla de Personal desde el row -->
                                            <div class="row">

                                                  <div class="col-md-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button  type="button" id="btn_nuevoPersona_Juridica" class="btn btn-primary " data-toggle="modal" data-target="#VentanaRegistraPersonaJuridica" >
                                                                      <span class="fa fa-plus-circle"></span>

                                                                Nuevo
                                                            </button>
                                                          <div class="x_title">

                                                            <div class="clearfix"></div>
                                                          </div>

                                                          <div class="x_content">
                                                            <table id="table-PersonaJuridica" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                              																<thead>
                              																	<tr>
                                                                  <th>ID</th>
                              																		<th>RUC</th>
                              																		<th>Razón Social</th>
                              																		<th>Representante Legal</th>
                              																		<th>Direción</th>
                              																		<th>Telefono</th>
                              																		<th>Correo</th>
                              																		<th>ACCIONES</th>
                              																	</tr>
                              																</thead>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>

                                            </div>
                                         <!-- / fin tabla de Personal desde el row -->
                                        </div>
                                        <!-- /fin del Personal del sector -->
                                        <div role="tabpanel" class="tab-pane fade" id="tab_Entidad" aria-labelledby="profile-tab">

                                            <!-- /tabla de division Personal desde el row -->
                                            <div class="row">

                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button type="button" id="btn_Nuevadivision" class="btn btn-primary" data-toggle="modal" data-target="#VentanaRegistracargo">
                                                                <span class="fa fa-plus-circle"></span>
                                                                Nuevo</button>
                                                          <div class="x_title">

                                                           <div class="clearfix"></div>

                                                          </div>
                                                          <div class="x_content">
                                                            <table id="table-cargo" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                                              <thead>
                                                                <tr>
                                                                  <th>Id.Cargo</th>
                                                                  <th>Nombre Cargo</th>
                                                                  <th>ACCIONES</th>
                                                                </tr>
                                                              </thead>

                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>

                                            </div>
                                         <!-- / fin tabla division Personal desde el row -->
                                        </div>
                                          <!-- / fin panel grupo  Personal desde el row -->
                                        <div role="tabpanel" class="tab-pane fade" id="user_type" aria-labelledby="profile-tab2">
                                             <!-- /tabla de grupo Personal desde el row -->
                                            <div class="row">

                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button type="button" id="btn_newUserType" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarTipoUsuario">
                                                            <span class="fa fa-plus-circle"></span>
                                                                Nuevo</button>
                                                          <div class="x_title">


                                                            <div class="clearfix"></div>
                                                          </div>
                                                          <div class="x_content">
                                                            <table id="table-tipoUsuario" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                                              <thead>
                                                                <tr>
                                                                  <th>ID</th>
                                                                  <th>Codigo de Usuario Tipo</th>
                                                                  <th>Descripción</th>
                                                                  <th>Opción</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                              </tbody>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>

                                            </div>
                                         <!-- / fin tabla grupo Personal asociados el row -->
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab-especialidad" aria-labelledby="profile-tab3">
                                             <!-- /tabla de grupo Personal desde el row -->
                                            <div class="row">

                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <button type="button" id="btn_newEspecialidad" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarEspecialidad">
                                                            <span class="fa fa-plus-circle"></span>
                                                                Nuevo</button>
                                                          <div class="x_title">


                                                            <div class="clearfix"></div>
                                                          </div>
                                                          <div class="x_content">
                                                            <table id="table-especialidad" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                                              <thead>
                                                                <tr>
                                                                  <th>ID</th>
                                                                  <th>Nombre</th>
                                                                  <th>Opción</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                              </tbody>
                                                            </table>
                                                          </div>
                                                        </div>
                                                      </div>

                                            </div>
                                         <!-- / fin tabla grupo Personal asociados el row -->
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

<!-- /.ventana para registra nuevo personal -->
<div class="modal fade" id="VentanaRegistraPersonal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar Personal</h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-xs-12">
                  <!-- FORULARIO PARA REGISTRAR NUEVO PERSONAL  -->
                <form class="form-horizontal " id="form-addPersonal" action="<?php echo base_url(); ?>Personal/GetPersonal" method="POST">
                    <div id="validarPersonal">

                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">DNI<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input id="txt_dni" name="txt_dni" class="mayuscula form-control col-md-7 col-xs-12" placeholder="DNI" maxlength="8" type="text">
                          <label id="mensajeError" style="display: none;">  </label>
                        </div> 
                        <button type="button" name="buscar" class="col-md-2 col-sm-2 col-xs-12 btn btn-secondary" onclick="cargarDatos()">Buscar</button>
                      </div>

                    <div class="form-group">
                           <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-6">Oficina</label>
                            <div class="col-md-6 col-sm-9 col-xs-6">
                                <select   id="Cbx_Oficina" name="Cbx_Oficina" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true">
                                      </select>
                            </div>
                    </div>
                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_nombrepersonal" name="txt_nombrepersonal" class="mayuscula form-control col-md-7 col-xs-12"  placeholder="Nombre Personal" type="text" maxlength="75">
                        </div>
                      </div>

                        <div class="item form-group">
                        <label class=" mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Apellido Paterno<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_apellidopaterno" name="txt_apellidopaterno" class="mayuscula form-control col-md-7 col-xs-12"  placeholder="Apellido Paterno" type="text" maxlength="70">
                        </div>
                      </div>

                       <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Apellido Materno<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_apellidomaterno" name="txt_apellidomaterno" class="mayuscula form-control col-md-7 col-xs-12"  placeholder="Apellido Materno" type="text" maxlength="70">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Dirección<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_direccion" name="txt_direccion" class="mayuscula form-control col-md-7 col-xs-12" placeholder="Dirección" type="text" maxlength="100">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Celular<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input id="txt_telefono" name="txt_telefono" class="form-control col-md-7 col-xs-12"  placeholder="Telefono" type="text" maxlength="9">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Correo<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_correo" name="txt_correo" class="form-control col-md-7 col-xs-12" placeholder="Correo" type="email" maxlength="100">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Grado Académico<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-9 col-xs-6">
                            <select   id="txt_gradoacademico" name="txt_gradoacademico" class="form-control col-md-12 col-xs-12" data-live-search="true">
                                <option value="">Seleccionar Grado Acádemico</option>
                                <option value="Tecnico">Tecnico</option>
                                <option value="Bachillerato">Bachillerato</option>
                                <option value="Titulo Profesional">Título Profesional</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option>

                            </select>
                        </div>
                      </div>
                    <div class="form-group">
                           <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-6">Especialidad:</label>
                            <div class="col-md-6 col-sm-9 col-xs-6">
                                     <select   id="Cbx_especialidad" name="Cbx_especialidad" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true">
                                      </select>
                            </div>
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

                </form> <!-- FORULARIO PARA REGISTRAR NUEVO Personal  -->
            </div><!-- /.span -->
          </div><!-- /.row -->
        </div>
        <div class="modal-footer">
               <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <div> *Son campos obligatorios </div>
                        </div>
                </div>
        </div>
      </div>
    </div>
  </div>
<!-- /.fin ventana para registra una nuevO personal-->

<!-- modificar la nuevo personal-->
<div class="modal fade" id="VentanaModificarPersonal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Personal</h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-xs-12">
                <form class="mayuscula form-horizontal " id="form-UpdatePersonal" action="<?php echo base_url(); ?>Personal/UpdatePersonal" method="POST">
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_idpersonam" name="txt_idpersonam" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                        </div>
                    </div>
                    <div id="validarEdicionPersonal">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-6">Oficina</label>
                        <div class="mayuscula col-md-6 col-sm-9 col-xs-6">
                            <select id="Cbx_OficinaModificar" name="Cbx_OficinaModificar"  data-live-search="true" >
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_nombrepersonalm" name="txt_nombrepersonalm" class="mayuscula form-control col-md-7 col-xs-12"   placeholder="Nombre Personal" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Apellido Paterno*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_apellidopaternom" name="txt_apellidopaternom" class="mayuscula form-control" placeholder="Apellido Paterno"  type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Apellido Materno*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_apellidomaternom" name="txt_apellidomaternom" class="mayuscula form-control col-md-7 col-xs-12"   placeholder="Apellido Materno" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">DNI*</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="txt_dnim" name="txt_dnim" class="form-control col-md-7 col-xs-12" placeholder="DNI" type="text" maxlength="8">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Dirección</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_direccionm" name="txt_direccionm" class="mayuscula form-control col-md-7 col-xs-12" placeholder="Dirección" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Telefono</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="txt_telefonom" name="txt_telefonom" class="form-control col-md-7 col-xs-12" placeholder="Telefono" type="text" maxlength="9">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Correo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_correom" name="txt_correom" class="form-control col-md-7 col-xs-12" placeholder="Correo" type="text">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Grado Académico</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="txt_gradoacademicom" name="txt_gradoacademicom" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true">
                                <option value="">Seleccionar Grado Acádemico</option>
                                <option value="Tecnico">Tecnico</option>
                                <option value="Bachillerato">Bachillerato</option>
                                <option value="Título Profesional">Título Profesional</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                           <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-6">Especialidad:</label>
                            <div class="col-md-6 col-sm-9 col-xs-6">
                                     <select   id="txtEspecialidadm" name="txtEspecialidadm" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true">
                                      </select>
                            </div>
                    </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                            <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>
                            Cerrar
                            </button>
                        </div>
                    </div>
                </form> <!-- FORULARIO para modificar personal -->
            </div><!-- /.span -->
                 </div><!-- /.row -->
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<!-- fin de modificar perosnal-->

<!-- /.ventana para registra nuevo persona juridica -->
<div class="modal fade" id="VentanaRegistraPersonaJuridica" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registrar Persona Jurídica</h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-xs-12">
                  <!-- FORULARIO PARA REGISTRAR NUEVO PERSONA JURIDICA  -->
                <form class="form-horizontal " id="form-addPersonaJuridica" action="<?php echo base_url(); ?>Persona_Juridica/GetPersonal" method="POST">
                    <div id="validarPersonaJuridica">

                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">RUC<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input id="txt_ruc" name="txt_ruc" class="mayuscula form-control col-md-7 col-xs-12" placeholder="RUC" maxlength="11" type="text">
                          <label id="mensajeErrorR" style="display: none;">  </label>
                        </div> 
                        <button type="button" name="buscar" class="col-md-2 col-sm-2 col-xs-12 btn btn-secondary" onclick="cargarDatosRuc()">Buscar</button>
                      </div>


                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Razón Social  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_razon_social" name="txt_razon_social" class="mayuscula form-control col-md-7 col-xs-12"  placeholder="Razón Social" type="text" maxlength="300">
                        </div>
                      </div>

                        <div class="item form-group">
                        <label class=" mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Representante Legal<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_representante_legal" name="txt_representante_legal" class="mayuscula form-control col-md-7 col-xs-12"  placeholder="Representante Legal" type="text" maxlength="500">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Dirección<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_direccionR" name="txt_direccionR" class="mayuscula form-control col-md-7 col-xs-12" placeholder="Dirección" type="text" maxlength="100">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Celular<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input id="txt_telefonoR" name="txt_telefonoR" class="form-control col-md-7 col-xs-12"  placeholder="Telefono" type="text" maxlength="9">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Correo<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_correoR" name="txt_correoR" class="form-control col-md-7 col-xs-12" placeholder="Correo" type="email" maxlength="100">
                        </div>
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

                </form> <!-- FORULARIO PARA REGISTRAR NUEVO Personal  -->
            </div><!-- /.span -->
          </div><!-- /.row -->
        </div>
        <div class="modal-footer">
               <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <div> *Son campos obligatorios </div>
                        </div>
                </div>
        </div>
      </div>
    </div>
  </div>
<!-- /.fin ventana para registra una nuevO persona juridica-->

<!-- modificar la nuevo persona juridica-->
<div class="modal fade" id="VentanaModificarPersonaJuridica" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Persona Juridica</h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-xs-12">
                <form class="mayuscula form-horizontal " id="form-UpdatePersonaJuridica" action="<?php echo base_url(); ?>Persona_Juridica/UpdatePersonal" method="POST">
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_idpersonamR" name="txt_idpersonamR" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                        </div>
                    </div>
                    <div id="validarEdicionPersonaJuridica">
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Razón Social*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_razon_socialm" name="txt_razon_socialm" class="mayuscula form-control col-md-7 col-xs-12"   placeholder="Razón Social" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Representante Legal*</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_representante_legalm" name="txt_representante_legalm" class="mayuscula form-control" placeholder="Representante Legal"  type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">RUC*</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="txt_rucm" name="txt_rucm" class="form-control col-md-7 col-xs-12" placeholder="RUC" type="text" maxlength="11">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Dirección</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_direccionRm" name="txt_direccionRm" class="mayuscula form-control col-md-7 col-xs-12" placeholder="Dirección" type="text">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Telefono</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="txt_telefonoRm" name="txt_telefonoRm" class="form-control col-md-7 col-xs-12" placeholder="Telefono" type="text" maxlength="9">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="mayuscula control-label col-md-3 col-sm-3 col-xs-12" for="name">Correo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_correoRm" name="txt_correoRm" class="form-control col-md-7 col-xs-12" placeholder="Correo" type="text">
                        </div>
                    </div>

                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                            <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>
                            Cerrar
                            </button>
                        </div>
                    </div>
                </form> <!-- FORULARIO para modificar personal -->
            </div><!-- /.span -->
                 </div><!-- /.row -->
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<!-- fin de modificar perosnal-->

<!-- Registar cargo -->
<div class="modal fade" id="VentanaRegistracargo" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registar Cargo</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-xs-12">
                 <!-- FORMULARIO PARA REGISTRAR NUEVO CARGO -->
                <form class="form-horizontal form-label-left"  id="form-addcargo" action="<?php echo base_url(); ?>Personal/Addcargo" method="POST">
                      <div id="validarAddCargo">
                        <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre Cargo<span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="txt_nombrecargo" name="txt_nombrecargo" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="text">
                              </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                              <button id="send" type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-disk"></span>
                                Guardar
                              </button>
                              <button data-dismiss="modal" class="btn btn-danger">
                               <span class="glyphicon glyphicon-remove"></span>
                              Cerrar
                            </button>
                        </div>
                      </div>
                </form><!-- FORMULARIO FIN PARA REGISTRA nuevo cargo -->
            </div><!-- /.span -->
        </div><!-- /.row -->
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

<!-- modificar cargo -->
<div class="modal fade" id="Ventanaupdatecargo" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registar Cargo</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-xs-12">
                 <!-- FORMULARIO PARA REGISTRAR NUEVO CARGO -->
                <form class="form-horizontal form-label-left"  id="form-updatecargo" action="<?php echo base_url(); ?>Personal/Addcargo" method="POST">
                      <div id="validarUpdateCargo">
                        <div class="item form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_idcargo_m" name="txt_idcargo_m" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                          </div>
                        </div>
                        <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre Cargo<span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="txt_nombrecargo_m" name="txt_nombrecargo_m" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="text">
                              </div>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                              <button id="send" type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-floppy-disk"></span>
                                Guardar
                              </button>
                              <button data-dismiss="modal" class="btn btn-danger">
                               <span class="glyphicon glyphicon-remove"></span>
                              Cerrar
                            </button>
                        </div>
                      </div>
                </form><!-- FORMULARIO FIN PARA REGISTRA nuevo cargo -->
            </div><!-- /.span -->
        </div><!-- /.row -->
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <!-- Registar tipo usuario -->
  <div class="modal fade" id="modalRegistrarTipoUsuario" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registrar Tipo de Usuario</h4>
          </div>
          <div class="modal-body">
           <div class="row">
                  <div class="col-xs-12">
                   <!-- FORMULARIO PARA REGISTRAR NUEVO CARGO -->
                  <form class="form-horizontal form-label-left"  id="form-addUserType" action="<?php echo base_url(); ?>Usuario/addTipoUsuario" method="POST">
                        <div id="validateAddTypeUser">
                          <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Codigo de Tipo de Usuario<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="txt_codUsuarioTipo" name="txt_codUsuarioTipo" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="text" maxlength="10">
                                </div>
                          </div>
                          <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input id="txt_descUsuarioTipo" name="txt_descUsuarioTipo" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="text" maxlength="50">
                                </div>
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-success">
                                  <span class="glyphicon glyphicon-floppy-disk"></span>
                                  Guardar
                                </button>
                                <button data-dismiss="modal" class="btn btn-danger">
                                 <span class="glyphicon glyphicon-remove"></span>
                                Cerrar
                              </button>
                          </div>
                        </div>
                  </form><!-- FORMULARIO FIN PARA REGISTRA nuevo cargo -->
              </div><!-- /.span -->
          </div><!-- /.row -->
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEditarTipoUsuario" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Editar Tipo de Usuario</h4>
            </div>
            <div class="modal-body">
             <div class="row">
                    <div class="col-xs-12">
                     <!-- FORMULARIO PARA REGISTRAR NUEVO CARGO -->
                    <form class="form-horizontal form-label-left"  id="form-updateUserType" action="<?php echo base_url(); ?>Usuario/updateTipoUsuario" method="POST">
                          <div id="validateUpdateTypeUser">
                            <div class="item form-group">
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="txt_idUsuarioTipo" name="txt_idUsuarioTipo" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" type="hidden" maxlength="10">
                                  </div>
                            </div>
                            <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Codigo de Tipo de Usuario<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="txt_codUsuarioTipoM" name="txt_codUsuarioTipoM" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="text" maxlength="10">
                                  </div>
                            </div>
                            <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="txt_descUsuarioTipoM" name="txt_descUsuarioTipoM" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="text" maxlength="50">
                                  </div>
                            </div>
                          </div>
                          <div class="ln_solid"></div>
                          <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                  <button id="send" type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-floppy-disk"></span>
                                    Guardar
                                  </button>
                                  <button data-dismiss="modal" class="btn btn-danger">
                                   <span class="glyphicon glyphicon-remove"></span>
                                  Cerrar
                                </button>
                            </div>
                          </div>
                    </form><!-- FORMULARIO FIN PARA REGISTRA nuevo cargo -->
                </div><!-- /.span -->
            </div><!-- /.row -->
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>

      <!-- Registar Especialidad -->
      <div class="modal fade" id="modalRegistrarEspecialidad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar Especialidad</h4>
              </div>
              <div class="modal-body">
               <div class="row">
                      <div class="col-xs-12">
                       <!-- FORMULARIO PARA REGISTRAR NUEVO CARGO -->
                      <form class="form-horizontal form-label-left"  id="form-addEspecialidad" action="<?php echo base_url(); ?>Especialidad/addEspecialidad" method="POST">
                            <div id="validateAddEspecialidad">
                              <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="txt_nombre_esp" name="txt_nombre_esp" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="text" maxlength="50">
                                    </div>
                              </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">
                                      <span class="glyphicon glyphicon-floppy-disk"></span>
                                      Guardar
                                    </button>
                                    <button data-dismiss="modal" class="btn btn-danger">
                                     <span class="glyphicon glyphicon-remove"></span>
                                    Cerrar
                                  </button>
                              </div>
                            </div>
                      </form><!-- FORMULARIO FIN PARA REGISTRA nuevo cargo -->
                  </div><!-- /.span -->
              </div><!-- /.row -->
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modalEditarEspecialidad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Editar Especialidad</h4>
                </div>
                <div class="modal-body">
                 <div class="row">
                        <div class="col-xs-12">
                         <!-- FORMULARIO PARA REGISTRAR NUEVO CARGO -->
                        <form class="form-horizontal form-label-left"  id="form-updateEspecialidad" action="<?php echo base_url(); ?>Especialidad/updateEspecialidad" method="POST">
                              <div id="validateUpdateEspecialidad">
                                <div class="item form-group">
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="txt_id_esp" name="txt_id_esp" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="hidden" maxlength="50">
                                      </div>
                                </div>
                                <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descripción<span class="required">*</span>
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="txt_nombre_esp_M" name="txt_nombre_esp_M" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  required="required" type="text" maxlength="50">
                                      </div>
                                </div>
                              </div>
                              <div class="ln_solid"></div>
                              <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                      <button id="send" type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-floppy-disk"></span>
                                        Guardar
                                      </button>
                                      <button data-dismiss="modal" class="btn btn-danger">
                                       <span class="glyphicon glyphicon-remove"></span>
                                      Cerrar
                                    </button>
                                </div>
                              </div>
                        </form><!-- FORMULARIO FIN PARA editar  -->
                    </div><!-- /.span -->
                </div><!-- /.row -->
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
<script>
    var base_url = '<?php echo base_url(); ?>';
    $('.modal').on('hidden.bs.modal', function()
    {
        $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
        $("label.error").remove();
    });

    $('#txt_dni').blur(function()
    {
        var dni = $(this).val();
        if(dni.length==8)
        {
            $.ajax(
            {
                url: base_url+'index.php/Personal/verifyPersonalByDNI',
                type: 'POST',
                cache: false,
                data:{dni:dni},
                async: false
            }).done(function(objectJSON)
            {
                objectJSON = JSON.parse(objectJSON);
                if(objectJSON.cantidad>0)
                {
                $('#mensajeError').css('display','block');
                $('#mensajeError').css('color','red');
                $('#mensajeError').text('Este nombre de usuario ya esta registrado en el sistema, pruebe con otro');
                }
                else
                {
                $('#mensajeError').css('display','block');
                $('#mensajeError').css('color','green');
                $('#mensajeError').text('Disponible');
                }
            }).fail(function()
            {
                swal('Error', 'Error no controlado.', 'error');
            });
        }        
    });

    $('#txt_ruc').blur(function()
    {
        var ruc = $(this).val();
        if(ruc.length==11)
        {
            $.ajax(
            {
                url: base_url+'index.php/Persona_Juridica/verifyPersonalByRUC',
                type: 'POST',
                cache: false,
                data:{ruc:ruc},
                async: false
            }).done(function(objectJSON)
            {
                objectJSON = JSON.parse(objectJSON);
                if(objectJSON.cantidad>0)
                {
                $('#mensajeErrorR').css('display','block');
                $('#mensajeErrorR').css('color','red');
                $('#mensajeErrorR').text('Esta persona juridica ya esta registrado en el sistema, pruebe con otro');
                }
                else
                {
                $('#mensajeErrorR').css('display','block');
                $('#mensajeErrorR').css('color','green');
                $('#mensajeErrorR').text('Disponible');
                }
            }).fail(function()
            {
                swal('Error', 'Error no controlado.', 'error');
            });
        }        
    });
    function cargarDatos() {
      let dni=$('#txt_dni').val();
      $.ajax(
            {
                url:"https://sysapis.uniq.edu.pe/pide/reniec?dni="+dni,
                type: 'GET',
                cache: false,
                processData:false,
                contentType:false,
                beforeSend: function(request)
                {
                    renderLoading();
                }               
                              
            }).done(
              function(data)
                {
                  $('#divModalCargaAjax').hide();
			            
                  

                  if(data)
                  {
                    $('#txt_nombrepersonal').val(data.nombres);
                  $('#txt_apellidopaterno').val(data.apellidoPaterno);
                  $('#txt_apellidomaterno').val(data.apellidoMaterno);
                  $('#txt_direccion').val(data.direccion);
                    swal('Operacion Completada','OK','success');
                  }
                  else
                  {
                    swal('No se pudo completar la Operacion','error');
                  }
                }).fail(
                   function ( )
                {
                      $('#divModalCargaAjax').hide();
                      $('#txt_nombrepersonal').val('');
                  $('#txt_apellidopaterno').val('');
                  $('#txt_apellidomaterno').val('');
                  $('#txt_direccion').val('');
                      swal('ERROR!','No se encontró su DNI verifique por favor','error');

                  });
    }

    function cargarDatosRuc() {
      let ruc=$('#txt_ruc').val();
      console.log(ruc);
      $.ajax(
            {
                url:"https://sysapis.uniq.edu.pe/pide/sunat/ruc?ruc="+ruc,
                type: 'GET',
                cache: false,
                processData:false,
                contentType:false,
                beforeSend: function(request)
                {
                    renderLoading();
                }               
                              
            }).done(
              function(data)
                {
                  $('#divModalCargaAjax').hide();
			            
                  console.log(data);

                  if(data)
                  {
                    $('#txt_razon_social').val(data.nombreRazonSocial);
                  $('#txt_direccionR').val(data.direccion);
                    swal('Operacion Completada','OK','success');
                  }
                  else
                  {
                    swal('No se pudo completar la Operacion','error');
                  }
                }).fail(
                   function ( )
                {
                      $('#divModalCargaAjax').hide();
                      $('#txt_razon_social').val('');
                  $('#txt_direccionR').val('');
                      swal('ERROR!','No se encontró el RUC verifique por favor','error');

                  });
    }

    $(function()
    {
        $('#validarPersonal').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                Cbx_Oficina:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Oficina" es requerido.</b>'
                        }
                    }
                },
                txt_nombrepersonal:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Nombre" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Nombre" no puede exceder los 75 cáracteres.</b>'
                        }
                    }
                },
                txt_apellidopaterno:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Apellido Paterno" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Apellido Paterno" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Apellido Paterno" no puede exceder los 70 cáracteres.</b>'
                        }
                    }
                },
                txt_apellidomaterno:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Apellido Materno" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Apellido Materno" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Apellido Materno" no puede exceder los 70 cáracteres.</b>'
                        }
                    }
                },
                txt_dni:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "DNI" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^([0-9]){8}$/,
                            message: '<b style="color: red;">El campo "Dni" es un numero de 8 dígitos.</b>'
                        },
                        between:
                        {
                            min: 00000001,
                            max: 99999999,
                            message: '<b style="color: red;">El campo "Dni" ingresado es incorrecto.</b>'
                        }
                    }
                },
                txt_correo:
                {
                    validators:
                    {
                        regexp:
                        {
                            regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                            message: '<b style="color: red;">El campo "Correo electronico" no es un correo electronico.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Correo electronico" no puede exceder los 100 cáracteres.</b>'
                        }
                    }

                },
                txt_telefono:
                {
                    validators:
                    {
                        regexp:
                        {
                            regexp: /^[0-9]{9}$/,
                            message: '<b style="color: red;">El campo "Telefono" requiere carácteres numéricos.</b>'
                        },
                    stringLength:
                        {
                            min: 5,
                            max: 9,
                            message: '<b style="color: red;">El campo "Teléfono" debe contener entre 5 y 9 carácteres numéricos.</b>'
                        }
                    }
                },
                date_fechanac:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Fecha de Nacimiento" es requerido.</b>'
                        }
                    }
                }
            }
        });

        $('#validarPersonaJuridica').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txt_razon_social:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Razon Social" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Razon Social" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 300,
                            message: '<b style="color: red;">El campo "Razon Social" no puede exceder los 300 cáracteres.</b>'
                        }
                    }
                },
                txt_representante_legal:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Representante Legal" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Representante Legal" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 500,
                            message: '<b style="color: red;">El campo "Representante Legal" no puede exceder los 500 cáracteres.</b>'
                        }
                    }
                },
                txt_ruc:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "RUC" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^([0-9]){11}$/,
                            message: '<b style="color: red;">El campo "RUC" es un numero de 11 dígitos.</b>'
                        },
                        between:
                        {
                            min: 00000000001,
                            max: 99999999999,
                            message: '<b style="color: red;">El campo "RUC" ingresado es incorrecto.</b>'
                        }
                    }
                },
                txt_correoR:
                {
                    validators:
                    {
                        regexp:
                        {
                            regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                            message: '<b style="color: red;">El campo "Correo electronico" no es un correo electronico.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Correo electronico" no puede exceder los 100 cáracteres.</b>'
                        }
                    }

                },
                txt_telefonoR:
                {
                    validators:
                    {
                        regexp:
                        {
                            regexp: /^[0-9]{9}$/,
                            message: '<b style="color: red;">El campo "Telefono" requiere carácteres numéricos.</b>'
                        },
                    stringLength:
                        {
                            min: 5,
                            max: 9,
                            message: '<b style="color: red;">El campo "Teléfono" debe contener entre 5 y 9 carácteres numéricos.</b>'
                        }
                    }
                }
            }
        });

        $('#validarEdicionPersonal').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                Cbx_OficinaModificar:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Oficina" es requerido.</b>'
                        }
                    }
                },
                txt_nombrepersonalm:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Nombre" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Nombre" no puede exceder los 75 cáracteres.</b>'
                        }
                    }
                },
                txt_apellidopaternom:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Apellido Paterno" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Apellido Paterno" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Apellido Paterno" no puede exceder los 70 cáracteres.</b>'
                        }
                    }
                },
                txt_apellidomaternom:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Apellido Materno" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Apellido Materno" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Apellido Materno" no puede exceder los 70 cáracteres.</b>'
                        }
                    }
                },
                txt_dnim:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "DNI" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^([0-9]){8}$/,
                            message: '<b style="color: red;">El campo "Dni" es un numero de 8 dígitos.</b>'
                        },
                        between:
                        {
                            min: 00000001,
                            max: 99999999,
                            message: '<b style="color: red;">El campo "Dni" ingresado es incorrecto.</b>'
                        }
                    }
                },
                txt_correom:
                {
                    validators:
                    {
                        regexp:
                        {
                            regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                            message: '<b style="color: red;">El campo "Correo electronico" no es un correo electronico.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Correo electronico" no puede exceder los 100 cáracteres.</b>'
                        }
                    }

                },
                txt_telefonom:
                {
                    validators:
                    {
                        regexp:
                        {
                            regexp: /^[0-9]{9}$/,
                            message: '<b style="color: red;">El campo "Telefono" requiere 9 dígitos.</b>'
                        }
                    }
                }
            }
        });

        $('#validarEdicionPersonaJuridica').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txt_razon_socialm:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Razon Social" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Razon Social" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 300,
                            message: '<b style="color: red;">El campo "Razon Social" no puede exceder los 300 cáracteres.</b>'
                        }
                    }
                },
                txt_representante_legalm:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Representante Legal" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^[a-zñáéíóúüA-ZÑÁÉÍÓÚÜ\s]+$/,
                            message: '<b style="color: red;">El campo "Representante Legal" es solo texto.</b>'
                        },
                        stringLength:
                        {
                            max: 500,
                            message: '<b style="color: red;">El campo "Representante Legal" no puede exceder los 500 cáracteres.</b>'
                        }
                    }
                },
                txt_rucm:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "RUC" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^([0-9]){11}$/,
                            message: '<b style="color: red;">El campo "RUC" es un numero de 11 dígitos.</b>'
                        },
                        between:
                        {
                            min: 00000000001,
                            max: 99999999999,
                            message: '<b style="color: red;">El campo "RUC" ingresado es incorrecto.</b>'
                        }
                    }
                },
                txt_correoRm:
                {
                    validators:
                    {
                        regexp:
                        {
                            regexp: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                            message: '<b style="color: red;">El campo "Correo electronico" no es un correo electronico.</b>'
                        },
                        stringLength:
                        {
                            max: 75,
                            message: '<b style="color: red;">El campo "Correo electronico" no puede exceder los 100 cáracteres.</b>'
                        }
                    }

                },
                txt_telefonoRm:
                {
                    validators:
                    {
                        regexp:
                        {
                            regexp: /^[0-9]{9}$/,
                            message: '<b style="color: red;">El campo "Telefono" requiere carácteres numéricos.</b>'
                        },
                    stringLength:
                        {
                            min: 5,
                            max: 9,
                            message: '<b style="color: red;">El campo "Teléfono" debe contener entre 5 y 9 carácteres numéricos.</b>'
                        }
                    }
                }
            }
        });

        $('#validarAddCargo').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txt_nombrecargo:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'El nombre completo solo puede contener caracteres alfabéticos'
                        }
                    }
                }
            }
        });

        $('#validarUpdateCargo').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txt_nombrecargo_m:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'El nombre completo solo puede contener caracteres alfabéticos'
                        }
                    }
                }
            }
        });

        $('#validateAddTypeUser').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txt_codUsuarioTipo:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                        },
                        regexp: {
                            regexp: /^[0-9\s]+$/,
                            message: 'El nombre completo solo puede contener caracteres numéricos'
                        }
                    }
                },
                txt_descUsuarioTipo:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo es requerido.</b>'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'El nombre completo solo puede contener caracteres alfabéticos'
                        }
                    }
                }
            }
        });

        $('#validateUpdateTypeUser').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txt_codUsuarioTipoM:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                        },
                        regexp: {
                            regexp: /^[0-9\s]+$/,
                            message: 'El nombre completo solo puede contener caracteres numéricos'
                        }
                    }
                },
                txt_descUsuarioTipoM:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo es requerido.</b>'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'El nombre completo solo puede contener caracteres alfabéticos'
                        }
                    }
                }
            }
        });

        $('#validateAddEspecialidad').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txt_nombre_esp:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo es requerido.</b>'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'El nombre completo solo puede contener caracteres alfabéticos'
                        }
                    }
                }
            }
        });

        $('#validateUpdateEspecialidad').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txt_nombre_esp_M:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo es requerido.</b>'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'El nombre completo solo puede contener caracteres alfabéticos'
                        }
                    }
                }
            }
        });

    });
</script>
