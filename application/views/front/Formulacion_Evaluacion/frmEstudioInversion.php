<style>

  #dynamic-table-EstudioInversion>tbody>tr>td:nth-child(0n+4)
  {
    text-align: right;
  }


  .btnCor {
    border-radius: 0px !important;
    margin-bottom: 0;
    margin-right: 0;
    width: 160px !important;
  }

  .dropdown-menu {

    position: inherit;
}

</style>
<div class="right_col" role="main">
<div class="">
      <div class="clearfix"></div>
        <div class="">
          <div class="col-md-12 col-sm-6 col-xs-12">
             <div class="x_panel">
                <div class="x_title">
                     <h2><b>ESTUDIO DE PREINVERSIÓN </b></h2>

                      <div class="clearfix"></div>
                </div>
                       <div class="x_content">


                               <div id="myTabContent" class="tab-content">
                                           <div role="tabpanel" class="tab-pane fade active in" id="tab_EstadoCicloInversion" aria-labelledby="home-tab">
                                           <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                              <div class="x_panel">
                                              
                                                   
                                                    <div class="clearfix">
                                                        <?php if($this->session->userdata('tipoUsuario')==9 || $this->session->userdata('tipoUsuario')==1 ) {?>
                                                    <div id="validarActualizarSiaf">
                                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                                            <select  onchange="ListaEstudioInversion()" style="margin-top: 5px;margin-bottom: 15px;" type="text" name="txtAnioActualizar" id="txtAnioActualizar" class="form-control"data-live-search="true"  title="Elija año">
                                                                <?php for ($i = 0; $i <= 10; $i++) { ?>
                                                                    <option value="<?=date('Y')-$i?>"><?=date('Y')-$i?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                                        <button  onclick="ImportarProyectosPIDE()" style="float: right;margin-top: 5px;margin-bottom: 15px;" type="button" class="btn btn-warning"><span class="fa fa-refresh"></span> IMPORTAR PIDE</button>
                                                    </div>
                                                    </div>
                                                    <?php } ?>
                                                        <div class="pull-right tableTools-container-EstudioInversion"></div>
                                                   
                                                     </div>
                                                     <div class="x_title"> </div>
                                                      <div class="x_content" >
                                                        <div class="table-responsive">
                                                                <table id="dynamic-table-EstudioInversion" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                                                                    <thead style=" ">
                                                                       <tr>
                                                                       <th style="width: 1%">Código</th>
                                                                       
                                                                         <th style="width: 70%"><i class="fa fa-thumb-tack"></i>Nombre</th>
                                                                         <th style="width: 1%"> Tipo</th>
                                                                         <th style="width: 10%"> Monto Inversión</th>
                                                                         <th style="width: 10%"> Costo Actualizado</th>
                                                                         <th style="width: 6%">Situación</th>
                                                                         <th style="width: 4%">Ultimo Estudio</th>
                                                                         <th style="width: 4%">Opción</th>
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
      <div class="clearfix"></div>
       <hr>
          </div>
          <div class="clearfix"></div>
        </div>
     </div>
<div class="modal fade" id="ventanaEstudioInversion" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><strong>Registrar Estudio de Preinversión</strong> </h4>
        </div>
        <div class="modal-body">
          <div class="count red">Ojo: Proyectos previamente programadas en PMI </div>
         <div class="row">
                <div class="col-xs-12">
            <form class="form-horizontal " id="form-AddEstudioInversion" action="<?php echo base_url(); ?>Estudio_Inversion/AddEstudioInversion" method="POST">

                    <br>

                          <div class="row ">
                            <div class="col-md-2">
                                       <div class=".col-xs-12 .col-md-2">
                                        </div>
                            </div>
                            <br>
                           <div class="col-md-12">
                                <div class=".col-xs-12 .col-md-12">
                               <div class="panel panel-default">

                                      <div class="panel-body">
                                      <form class="form-horizontal " id="form-AddEstudioInversion" action="<?php echo base_url(); ?>Estudio_Inversion/AddEstudioInversion" method="POST">

                                        <div class="col-md-12">
                                            <div class="col-xs-12 col-md-6">
                                                <label for="name">Estado<span class="required"></span></label>
                                                <select id="comboEstadoFe" name="comboEstadoFe" class="selectpicker form-control" data-live-search="true"  title="Elija estado">
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-md-3">
                                                <label for="name">Año<span class="required"></span></label>
                                                <select id="comboAnio" name="comboAnio" class="form-control" data-live-search="true"  title="Elija año">
                                                    <?php for ($i = 0; $i <= 10; $i++) { ?>
                                                        <option value="<?=date('Y')-$i?>"><?=date('Y')-$i?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-12 col-md-12">
                                                <label for="name">Proyecto PMI<span class="required"></span></label>
                                                <select   id="listaFuncionC" name="listaFuncionC" class="selectpicker form-control" data-live-search="true"  title="Buscar Proyecto...">
                                                </select>
                                            </div>

                                            <div class="col-xs-12 col-md-12">
                                                <label for="name">Código Único<span class="required"></span></label>
                                                <input id="txtCodigoUnico" name="txtCodigoUnico" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Ingrese único " required="required" autocomplete="off" type="text">
                                            </div>

                                        </div>
                                      </div>
                                </div>
                              </div>
                            </div>
                          </div>
                                                    <div class="row ">
                            <div class="col-md-2">
                                       <div class=".col-xs-12 .col-md-2">
                                        </div>
                            </div>
                           <div class="col-md-12">
                                <div class=".col-xs-12 .col-md-12">
                               <div class="panel panel-default">
                              <!-- <div class="panel-heading">Título del panel</div>-->
                                      <div class="panel-body">
                                          <div class="col-md-12">
                                          <div class=".col-xs-12 .col-md-10">
                                           <label for="name">Nombre de Estudio de Inversión<span class="required"></span>
                                            </label>
                                                  <input id="txtnombres" name="txtnombres"  class="form-control col-md-1 col-xs-1" data-validate-length-range="6" data-validate-words="2" placeholder="Nombre de Estudio de Inversión" required="required" type="text">
                                          </div>
                                          </div>
                                         <div class="col-md-6">
                                          <br>
                                           <label for="name">Tipo de Estudio<span class="required"></span>
                                            </label>
                                                 <select   id="listaTipoInversion" name="listaTipoInversion" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Tipo de Estudio...">
                                                </select>

                                          </div>
                                          <div class="col-md-6">
                                          <br>
                                           <label for="name">Tipo Documento Técnico<span class="required"></span>
                                            </label>
                                                 <select   id="listaNivelEstudio" name="listaNivelEstudio" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Nivel Estudio...">
                                                </select>
                                            </div>

                                          <div class="col-md-3">
                                          <div class=".col-xs-6 .col-md-12">
                                          <br>
                                           <label for="name">Monto de Inversión<span class="required"></span>
                                            </label>
                                                  <input id="txtMontoInversion" name="txtMontoInversion"  class="form-control col-md-1 col-xs-1" data-validate-length-range="6" autocomplete="off" data-validate-words="2"  required="required" type="text" placeholder="0.00">
                                          </div>
                                          </div>

                                          <div class="col-md-3">
                                          <br>
                                           <label for="name">Costo del Estudio<span class="required"></span>
                                            </label>
                                                  <input id="txtcostoestudio" name="txtcostoestudio"  class="form-control col-md-1 col-xs-1" data-validate-length-range="6" data-validate-words="2" autocomplete="off" required="required" placeholder="0.00" type="text" >
                                          </div>
                                          <div class="col-md-3">
                                          <br>
                                           <label for="name">Unidad Formuladora<span class="required"></span>
                                            </label>
                                                  <select   id="lista_unid_form" name="lista_unid_form" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar UF...">
                                                </select>
                                          </div>
                                          <div class="col-md-3">
                                          <br>
                                           <label for="name">Unidad Ejecutora<span class="required"></span>
                                            </label>
                                                   <select   id="lista_unid_ejec" name="lista_unid_ejec" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar UE...">
                                                </select>
                                          </div>

                                           <div class="col-md-12">
                                          <div class=".col-xs-12 .col-md-10">
                                          <br>
                                           <label for="name">Descripción del Estudio de Inversión<span class="required"></span>
                                            </label>
                                              <textarea class="form-control" rows="3" name="txadescripcion" id="txadescripcion"></textarea>
                                          </div>
                                          </div>
                                            <div class="col-md-3">
                                          <br>
                                           <label for="name">.<span class="required"></span>
                                            </label> <br>
                                            <center>
                                                 <button id="btn-GuardarMontoProgramado"  class="btn btn-success">
                               <span  aria-hidden="true"></span><strong>Guardar</strong> </button>
                               <button type="button" class="btn btn-danger" data-dismiss="modal"><strong>Cerrar</strong> </button>

                               </center>
                                          </div>
                                       </div>
                                </div>
                              </div>
                            </div>
                          </div>
                </form><!-- FORMULARIO FIN PARA REGISTRA NUEVO SERVICIO ASOCIADO -->
            </div>
        </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<!-- fin popul para crear un nuevo estudio de inversión -->

<!-- /.ventana para asignar responsable a estudio de inversión-->


<!-- /.ventana para asignar COORDINADO-->
<div class="modal fade" id="ventanaasiganarpersona" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Asignar Responsable </h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form-AddResponsableEstudio"   action="<?php echo base_url(); ?>Estudio_Inversion/AddResponsableEstudio" method="POST" >

                    <input id="id_est_inv" name="id_est_inv" required="required" type="hidden">
                    <div class="row">
                    <div class="col-md-4">
                        <label for="name">Responsable<span class="required"></span></label>
                        <select   id="listaResponsables" name="listaResponsables" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Responsable..."></select>
                    </div>
                    <div class="col-md-4">
                        <label for="name">Fecha de Asignación</label>
                        <input type="date" max="2050-12-31" id="dateFechaAsig" name="dateFechaAsig" class="form-control" data-validate-length-range="6" data-validate-words="2" required="required" type="text" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="name">.</label>
                        <div>
                            <button id="send" type="submit" class="btn btn-success">Guardar</button>                            
                        </div>                        
                    </div>
                    </div>
                    <div class="row">
                   
                    <div class="col-md-12" >
                        <br><br><div class="table-responsive">
                            <table  style="width:100%;" id="tablaResponsables" class="table   table-hover" >
                                <thead >
                                    <tr>
                                        <th></th>
                                        <th style="width: 95%">Nombres</th>
                                        <th style="width: 5%"> Fecha</th>
                                        <th style="width: 5%"> Opciones</th>
                                    </tr>
                                </thead>
                            </table>                            
                        </div>
                    </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="row">
                    <div class="col-md-12 col-xs-12" style="text-align: right;">
                        <button  class="btn btn-danger" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>
                        Cerrar
                        </button>
                    </div>
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


<div class="modal fade" id="ventanaEtapaEstudio" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Etapa de Estudio </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal " id="form-AddEtapaEstudio"   action="<?php echo base_url(); ?>Estudio_Inversion/AddEtapaEstudio" method="POST" >
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="txt_id_est_inv" name="txt_id_est_inv" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                                </div>
                            </div>
                            <div id="validateEtapaEstudio">
                            <div class="item form-group">
                                <div class="col-md-4">
                                    <label for="name">Etapas FE*</label>
                                    <select id="listaretapasFE_M" name="listaretapasFE_M" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"></select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <div class="col-md-4">
                                    <label for="name">Fecha Inicio*</label>
                                    <input type="date" max="2050-12-31" id="dateFechaIniC" name="dateFechaIniC" class="form-control" type="text" value="<?=date('Y-m-d')?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Fecha Final*</label>
                                    <input type="date" max="2050-12-31" id="dateFechaIniF" name="dateFechaIniF" class="form-control" type="text" value="<?=date('Y-m-d')?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Avance Físico*</label>
                                    <input id="txtAvanceFisico" name="txtAvanceFisico"  class="form-control col-md-12 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Avance Físico" required="required" type="text" value="0.0" disabled>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <label for="name">Recomendaciones</label>
                                    <textarea class="form-control notValidate" rows="3" name="txadescripcion" id="txadescripcion"></textarea>
                                </div>
                            </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                                    </button>
                                    <button class="btn btn-danger" data-dismiss="modal">
                                        <span class="glyphicon glyphicon-remove"></span> Cerrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>



<!-- /.ventana para la asiganacion de documentos en los entregables -->
<div class="modal fade" id="VentanaDocumentosEstudio" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Documentos de Estudio</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal " id="form-AddDocumentosEstudio"   action="<?php echo base_url(); ?>Estudio_Inversion/AddDocumentosEstudio" method="POST" >
                            <div class="item form-group">
                                <input id="txt_id_est_invAdd" name="txt_id_est_invAdd" class="form-control col-md-7 col-xs-12"  type="hidden">
                            </div>
                            <div id="validarFrmDocumento">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12">Nombre*</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input  id="txt_documentosEstudio" name="txt_documentosEstudio" placeholder="Nombre del Documento" autocomplete="off" class="form-control col-md-6 col-xs-5"  type="text" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12">Descripción</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input id="txt_descripcionEstudio" autocomplete="off" name="txt_descripcionEstudio" placeholder="Descripción de documento" class="form-control col-md-12 col-xs-12 notValidate" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12">Documento*</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="file" class="form-control" name="Documento_invserion" id="Documento_invserion">
                                    <label style="color: red;">Solo se aceptan archivos con extensión pdf, doc, docx </label>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
                                    </button>
                                    <button  class="btn btn-danger" data-dismiss="modal">
                                        <span class="glyphicon glyphicon-remove"></span> Cerrar
                                    </button>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>Entregables</h4>
                                </div>
                                <table id="table-Documento" class="table"></table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>


<!-- /. INICIO VENTANA VER ETAPAS DE UN ESTUDIO-->
<div class="modal fade" id="ventana_ver_etapas_estudio" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Ver Etapas Estudio</h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-horizontal "   action="<?php echo base_url(); ?>Estudio_Inversion/get_etapas_estudio" method="POST" >
                        <div class="ln_solid"></div>
                        <div class="x_panel" style="background-color: #EEEEEE;">
                            <center>
                            <table  style="width:100%;" id="table_etapas_estudio" class="table   table-hover" >
                                <thead >
                                    <tr>
                                        <th style="width: 1%"> ESTADO </th>
                                        <th style="width: 2%"></th>
                                        <th style="width: 10%" > Etapa</th>
                                        <th style="width: 50%"> Observación</th>
                                        <th style="width: 10%"> Fecha Inicio</th>
                                        <th style="width: 10%"> Fecha Final</th>
                                        <th style="width: 10%"> Opciones</th>
                                    </tr>
                                </thead>
                            </table>
                            </center>
                        </div>
                        <center>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button  class="btn btn-danger" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-log-out"></span> Cerrar
                                    </button>
                                </div>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<!--modal informativo-->
<div class="modal fade" id="modal_informativo" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Caracteristicas del Proyecto </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_AddUbigeo">
                    <input id="txt_id_pip" name="txt_id_pip" required="required" type="hidden">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <label for="name">Proyecto:</label>
                            <textarea class="form-control" rows="2" readonly="readonly" id="nombreProyectoInv" name="nombreProyectoInv"></textarea>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="name">Codigo:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="codigoProyecto" name="codigoProyecto">
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="name">Estado:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="estado" name="estado">
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="name">Fecha de Registro:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="fechaRegistro" name="fechaRegistro">
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="name">Funcion:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="funcion" name="funcion">
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="name">Programa:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="programa" name="programa">
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label for="name">Sub Programa:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="subprograma" name="subprograma">
                        </div> 
                        <div class="col-xs-3 col-md-3">
                            <label for="name">Codigo UF:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="unidadFormuladoraCodigo" name="unidadFormuladoraCodigo">
                        </div>
                        <div class="col-xs-9 col-md-9">
                            <label for="name">Unidad Formuladora:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="unidadFormuladora" name="unidadFormuladora">
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <label for="name">Nivel de Gobierno:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="nivelGobierno" name="nivelGobierno">
                        </div> 
                        <div class="col-xs-12 col-md-4">
                            <label for="name">Sector:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="sector" name="sector">
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <label for="name">Pliego:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="pliego" name="pliego">
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <label for="name">Codigo UEv:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="evaluadoraCodigo" name="evaluadoraCodigo">
                        </div>
                        <div class="col-xs-12 col-md-9">
                            <label for="name">Unidad Evaluadora:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="evaluadora" name="evaluadora">
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <label for="name">Codigo UEj:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="ejecutoraCodigo" name="ejecutoraCodigo">
                        </div>
                        <div class="col-xs-12 col-md-9">
                            <label for="name">Unidad Ejecutora:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="ejecutora" name="ejecutora">
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <label for="name">Situacion:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="situacion" name="situacion">
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <label for="name">Nivel de Estudio:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="nivelEstudio" name="nivelEstudio">
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <label for="name">Ultimo Estudio:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="ultimoEstudio" name="ultimoEstudio">
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <label for="name">Estado Ultimo Estudio:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="estadoUltimoEstudio" name="estadoUltimoEstudio">
                        </div>
                        <div class="col-xs-12 col-md-2">
                            <label for="name">Beneficiario:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="beneficiario" name="beneficiario">
                        </div>
                        <br>
                        <div class="col-xs-12 col-md-12">
                            <label for="name">Fuente de Financiamiento:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="fuenteFinanciamiento" name="fuenteFinanciamiento">
                        </div>
                        <div class="col-xs-12 col-md-12">
                        <table id="TableMoneda" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                        <thead >
                                        <tr>
                                            <th colspan="6" style="width: 12%; text-align: center" >MONTO (S/)</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 8%; text-align: center"> Alternativa </th>
                                            <th style="width: 8%; text-align: center"> Reformulado </th>
                                            <th style="width: 8%; text-align: center"> F15 </th>
                                            <th style="width: 8%; text-align: center"> F16 </th>
                                            <th style="width: 8%; text-align: center"> Laudo </th>
                                            <th style="width: 8%; text-align: center"> Carta Fianza </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 8%; text-align: center"> s/ <span id="montoAlternativa" name="montoAlternativa"></spam></td>
                                            <td style="width: 8%; text-align: center"> s/ <span id="montoReformulado" name="montoReformulado"></span></td>
                                            <td style="width: 8%; text-align: center"> s/ <span id="montoF15" name="montoF15"></span></td>
                                            <td style="width: 8%; text-align: center"> s/ <span id="montoF16" name="montoF16"></span></td>
                                            <td style="width: 8%; text-align: center"> s/ <span id="montoLaudo" name="montoLaudo"></span></td>
                                            <td style="width: 8%; text-align: center"> s/ <span id="montoCartaFianza" name="montoCartaFianza"></span></td>
                                        </tr>
                                    </tbody>
                        </table>
                        </div>
                        <div class="col-xs-12 col-md-12">
                        <table id="TableCostos" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                        <thead >
                                        <tr>
                                            <th style="width: 8%; text-align: center"> Costo Actualizado </th>
                                            <th style="width: 8%; text-align: center"> PIM </th>
                                            <th style="width: 8%; text-align: center"> PIA </th>
                                            <th style="width: 8%; text-align: center"> Devengado Acumulado </th>
                                            <th style="width: 8%; text-align: center"> Devengado Año Actual </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 8%; text-align: center"> s/ <label id="costoActualizado" name="costoActualizado"></label></td>
                                            <td style="width: 8%; text-align: center"> s/ <label id="PIM" name="PIM"></label></td>
                                            <td style="width: 8%; text-align: center"> s/ <label id="PIA" name="PIA"></label></td>
                                            <td style="width: 8%; text-align: center"> s/ <label id="devengadoAcumulado" name="devengadoAcumulado"></label></td>
                                            <td style="width: 8%; text-align: center"> s/ <label id="devengadoAnioActual" name="devengadoAnioActual"></label></td>
                                        </tr>
                                    </tbody>
                        </table>
                        </div>

                    </div>                         
                    <br>
                    <div class="col-xs-6 col-md-2">
                            <label for="name">Año de Viabilidad:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="anioViabilidad" name="anioViabilidad">
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <label for="name">Fecha de Viabilidad:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="fechaViabilidad" name="fechaViabilidad">
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <label for="name">Actualizacion:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="actualizacion" name="actualizacion">
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <label for="name">Marco:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="marco" name="marco">
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <label for="name">Con Informe de Cierre?:</label>
                            <input class="form-control" rows="2" readonly="readonly" id="conInformeCierre" name="conInformeCierre">
                        </div>
                    <br>                    
                    <div class="col-xs-12 col-md-12" style="border: 1px solid #EEEEEE;">
                        <label for="name">Localizaciones:</label>
                        <table id="TableUbigeoProyectoInv" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                            <thead >
                                <tr>
                                    <th style="width: 20%" >Codigo</th>
                                    <th style="width: 20%" >Departamento</th>
                                    <th style="width: 20%" >Provincia</th>
                                    <th style="width: 20%" >Distrito</th>
                                    <th style="width: 20%" >Centro Poblado</th>
                                    <th style="width: 20%" >Ubigeo</th>
                                    <th style="width: 20%" >Latitud</th>
                                    <th style="width: 20%" >Longitud</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <center>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button  class="btn btn-danger" data-dismiss="modal">
                                <span class="glyphicon glyphicon-log-out"></span>
                                Cerrar
                                </button>
                            </div>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<!--fin modal inforamtivo-->

<?php
  $sessionTempo=$this->session->flashdata('correcto');

  if($sessionTempo){ ?>
    <script>
      swal('','<?=$sessionTempo?>', "success");
    </script>
<?php } ?>
<script>
    $("#txtCostoPip").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });
    $("#txtcostoestudio").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    });

    $('.modal').on('hidden.bs.modal', function()
    {
        $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
        $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
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

    
function ActualizarProyectos(){
    var anio = $('#txtAnioActualizar').val();
    $.ajax({
       type:"POST",
       url:base_url+'index.php/bancoproyectos/insertarEstudioCodigoPIDE',
       cache: false,
       success:function(resp)
       {
          $('#divModalCargaAjax').hide(); 
          swal(
          'Operacion Completada',
          ' Se actualizaron estudios de inversión',
          'success'
          );
          $('#dynamic-table-EstudioInversion').dataTable()._fnAjaxUpdate();
       },
       error:function ()
       {
           $('#divModalCargaAjax').hide(); 
           swal(
           'Error',
           ' No se actualizaron los estudios de inversión',
           'error'
           );
       }
   });            
}

function ImportarProyectosPIDE(){
    var anio = $('#txtAnioActualizar').val();
    $.ajax({
    "url":"https://sysapis.uniq.edu.pe/api/dev/proyectos-inversion/proyectos-inversion?anio="+anio,
    type:"GET",
    beforeSend: function()
            {
                renderLoading();
            },
    success:function(data)
    {
        count=0;
        proyect=0;
        if(!data || data.length === 0)
        {
            return;
        }
        var anio = $('#txtAnioActualizar').val();
        data.forEach(element => {
            if(element.estado==='A'){$.ajax({
                "url":"https://sysapis.uniq.edu.pe/pide/mef/pips?codigo="+element.idProyecto,
                type:"GET",
                success:function(proy)
                {
                    if(proy.codigo){
                        $.ajax({
                        type:"POST",
                        url:base_url+'index.php/bancoproyectos/insertarProyectoCodigoPIDE',
                        data:{id:element.idProyecto,proy:proy,anio:anio},
                        cache: false,
                        success:function(resp)
                        {
                            count++;
                            proyect++;
                            if (count===data.length) {
                                $.ajax({
                                    type:"POST",
                                    url:base_url+'index.php/bancoproyectos/insertarEstudioCodigoPIDE',
                                    cache: false,
                                    success:function(resp)
                                    {
                                        $('#divModalCargaAjax').hide(); 
                                        swal(
                                        'Operacion Completada',
                                        ' Total de proyectos ingresados: '+proyect,
                                        'success'
                                        );
                                        $('#dynamic-table-EstudioInversion').dataTable()._fnAjaxUpdate();
                                    }
                                });
                            }
                        },
                        error:function ()
                        {
                            count++;
                            if (count===data.length) {
                                $.ajax({
                                    type:"POST",
                                    url:base_url+'index.php/bancoproyectos/insertarEstudioCodigoPIDE',
                                    cache: false,
                                    success:function(resp)
                                    {
                                        $('#divModalCargaAjax').hide(); 
                                        swal(
                                        'Operacion Completada',
                                        ' Total de proyectos ingresados: '+proyect,
                                        'success'
                                        );
                                        $('#dynamic-table-EstudioInversion').dataTable()._fnAjaxUpdate();
                                    }
                                });
                            }
                        }
                      });
                    }
                    else{
                        count++;
                            if (count===data.length) {
                                $.ajax({
                                    type:"POST",
                                    url:base_url+'index.php/bancoproyectos/insertarEstudioCodigoPIDE',
                                    cache: false,
                                    success:function(resp)
                                    {
                                        $('#divModalCargaAjax').hide(); 
                                        swal(
                                        'Operacion Completada',
                                        ' Total de proyectos ingresados: '+proyect,
                                        'success'
                                        );
                                        $('#dynamic-table-EstudioInversion').dataTable()._fnAjaxUpdate();
                                    }
                                });
                            }
                    }
                   
                },
                error:function ()
                {
                    count++;
                    if (count===data.length) {
                        $.ajax({
                             type:"POST",
                             url:base_url+'index.php/bancoproyectos/insertarEstudioCodigoPIDE',
                             cache: false,
                             success:function(resp)
                             {
                                 $('#divModalCargaAjax').hide(); 
                                 swal(
                                 'Operacion Completada',
                                 ' Total de proyectos ingresados: '+proyect,
                                 'success'
                                 );
                                 $('#dynamic-table-EstudioInversion').dataTable()._fnAjaxUpdate();
                             }
                         });
                   }
                }
            });}
            else{
                count++;
            }
        });
        if (count===data.length) {
            $('#divModalCargaAjax').hide(); 
        }
     }
 });
}

function actualizarProyectoInversion() {
    $('#dynamic-table-EstudioInversion').dataTable()._fnAjaxUpdate();
}

</script>
