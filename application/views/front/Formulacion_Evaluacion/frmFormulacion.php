<style>

  #tabla-formulacion>tbody>tr>td:nth-child(0n+4)
  {
    text-align: right;
  }

  .btn-group .btn, .btn-group-vertical .btn {
    margin-bottom: 0;
    margin-right: 0;
    width: 160px !important;
  }
  .btn {
    border-radius: 0px !important;
  }
    .dropdown-menu {

    position: inherit;
}

</style>
<div class="right_col" role="main">
    <div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-xs-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><b>PROYECTOS EN FORMULACIÓN</b></h2>
                    <div class="clearfix"></div>
                </div>

                                                <!--inicio  de icono de reporte -->

                                                        <div class="clearfix">
                                                           <div class="pull-right tableTools-container-evaluacion">
                                                           </div>
                                                        </div>
                                                      <!--fin  de icono de reporte -->
                <div class="x_content">
                    <div class="table-responsive">
                        <table id="tabla-formulacion" class="table table-striped jambo_table bulk_action  table-hover"  width="100%" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>Id PIP</th>
                                    <th>Codigo Unico</th>
                                    <th>Nombre Pip</th>
                                    <th>Provincia, Dist</th>
                                    <th>Nivel Estudio</th>
                                    <th>Responsable de Etapa</th>
                                    <th>Costo Inversion</th>
                                    <th>Situacion</th>
                                    <th>Avance Fisico</th>
                                    <th>Entr.</th>
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
    </div>
    <div class="clearfix"></div>
</div>


<div class="modal fade" id="VerDetalleFormulacion"  role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table-DetSitActEvaluacionFE" class="table table-striped projects">
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="VentanaSituacionActual" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Situación </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                    <form class="form-horizontal " id="form-AddSituacion"   action="<?php echo base_url(); ?>frmFormulacion/GetFormulacion" method="POST" >
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txt_IdEtapa_Estudio" name="txt_IdEtapa_Estudio" type="hidden">
                            </div>
                        </div>
                    <div class="item form-group">
                        <div class="col-md-4" id="validateSituacion">
                            <label for="name">Situación Form y Eval*</label>
                            <select   id="Cbx_Situacion" name="Cbx_Situacion" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="name">Fecha</label>
                            <input type="date" max="2050-12-31" id="dateFechaIniC" name="dateFechaIniC" class="form-control col-md-6 col-xs-5" data-validate-length-range="6" data-validate-words="2" required="required" type="text" value="<?php echo date("Y-m-d"); ?>" disabled="true">
                        </div>
                    </div>
                    <div class="item form-group">
                    <div class="col-md-12">
                        <br>
                        <label for="name">Observación</label>
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
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- /.fin de  ventana registrar situacion actual-->

<!-- /.ventana para registrar Persona-->
<div class="modal fade" id="VentanaAsignarPersona" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Asignar Persona </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal " id="form-AddAsiganarPersona" action="<?php echo base_url(); ?>frmFormulacion/GetFormulacion" method="POST">
                            <div id="AsignarPersonaValidate">
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="txt_IdEtapa_Estudio_p" name="txt_IdEtapa_Estudio_p" class="form-control" required="required" type="hidden">
                                </div>
                            </div>
                            <div class="item form-group">
                                <div class="col-md-4">
                                    <label for="name">Responsable*<span class="required"></span></label>
                                    <select   id="Cbx_Persona" name="Cbx_Persona" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true">
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Cargo*<span class="required"></span></label>
                                    <select   id="Cbx_Cargo" name="Cbx_Cargo" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true">
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Fecha <span class="required"></span></label>
                                    <input type="date" id="dateFechaIniC" name="dateFechaIniC" class="form-control" required="required" type="text" value="<?php echo date("Y-m-d"); ?>" disabled="true">
                                </div>
                            </div>
                            <div class="item form-group">
                                <div class="col-md-12">
                                    <br>
                                    <label for="name">Observación<span class="required"></span></label>
                                    <textarea class="form-control notValidate" rows="3" name="txadescripcion" id="txadescripcion"></textarea>
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
                                    <button class="btn btn-danger" data-dismiss="modal">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        Cerrar
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
<!-- /.fin de  ventana Registar Persona-->

<!-- /.ventana para registrar ESTADO FE-->
<div class="modal fade" id="VentanaEstadoFE" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Asignar Estado Etapa </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form  id="form-AddEtapaEstudio" action="<?php echo base_url(); ?>EstadoEtapa_FE/GetEstadoEtapa_FE" method="POST" class="form-horizontal">
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="txt_IdEtapa_Estudio_FE" name="txt_IdEtapa_Estudio_FE" type="hidden">
                                </div>
                            </div>
                            <div class="item form-group">
                                <div class="col-md-4">
                                    <label for="name">Estado*</label>
                                    <select   id="Cbx_EstadoFE" name="Cbx_EstadoFE" class="selectpicker form-control" data-live-search="true" ></select>
                                </div>
                                <div class="col-md-4">
                                    <label for="name">Fecha*</label>
                                    <input type="date" max="2050-12-31" id="dateFechaIniC" name="dateFechaIniC"  type="text" value="<?=date("Y-m-d")?>" disabled="true" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="name">.</label><BR>
                                    <button id="send" type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-floppy-saved"></span>Agregar
                                    </button>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                     <div class="x_panel" style="background-color: #EEEEEE;">
                    <center>
                    <table  style="width:50%;" id="table-EstadoEtapa" class="table   table-hover" >
                    <thead >
                       <tr>
                         <th style="width: 1%"><i class="fa fa-thumb-tack"></i> ID</th>
                         <th style="width: 1%"><i class="fa fa-thumb-tack"></i> ID</th>
                         <th style="width: 30%" ><i class="fa fa-thumb-tack"></i> Estado</th>
                         <th style="width: 10%"><i class="fa fa-calendar"></i> Fecha Actualización</th>
                        <th style="width: 20%" ><i class="fa fa-thumb-tack"></i> Opcion</th>
                      </tr>
                    </thead>
                    </table>
                    </center>
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
                        </div><!-- /.span -->
                 </div><!-- /.row -->
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="ventana_ver_etapas_estudio" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Ver Etapas Estudio</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal "   action="<?php echo base_url(); ?>Estudio_Inversion/get_etapas_estudio" method="POST" >
                     <div class="ln_solid"></div>

                  <input id="id_est_inv" name="id_est_inv" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">


                     <div class="x_panel" style="background-color: #EEEEEE;">
                    <center>
                    <table  style="width:100%;" id="table_etapas_estudio" class="table   table-hover" >
                    <thead >
                       <tr>
                         <th style="width: 1%"><i class="fa fa-thumb-tack"></i> ESTADO </th>
                         <th style="width: 2%"><i class="fa fa-calendar"></i>
                        </th>
                         <th style="width: 10%" ><i class="fa fa-thumb-tack"></i> Etapa</th>
                         <th style="width: 50%"><i class="fa fa-thumb-tack"></i> Observación
                        </th>
                         <th style="width: 10%"><i class="fa fa-calendar"></i> Fecha Inicio
                        </th>
                        <th style="width: 10%"><i class="fa fa-calendar"></i> Fecha Final
                        </th>

                      </tr>
                    </thead>
                    </table>
                    </center>
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
        <div class="modal-footer">

        </div>
      </div>
    </div>
</div>


<div id="ventanagant" class="modal fade" role="dialog">
  <div class="modal-dialog-lag">
    <div class="modal-content" id="ProgramacionHorizontal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detalle de programación</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="table-responsive">
                  <div class="x_content" style='height:100%;width:100%; padding:0px; margin:0px; overflow: hidden;'>
  <input value="Export to PDF" type="button" onclick='gantt.exportToPDF({ callback:show_result })' style='margin:20px;'>
  <input value="Export to PNG" type="button" onclick='gantt.exportToPNG({ callback:show_result })' style='margin:20px;'>
  <input value="Export to Excel" type="button" onclick='gantt.exportToExcel({ callback:show_result })' style='margin:20px;'>
  <input value="Export to iCal" type="button" onclick='gantt.exportToICal({ callback:show_result })' style='margin:20px;'>
  <div id="gantt_here" style='height:400px;width:100%; padding:10px; margin:0px;'></div>
      <script type="text/javascript">
        function show_result(info){
          if (!info)
            gantt.message({
              text:"Server error",
              type:"error",
              expire:-1
            });
          else
            gantt.message({
              text:"Stored at <a href='"+info.url+"'>export.dhtlmx.com</a>",
              expire:-1
            });
        }
        gantt.templates.task_text = function(s,e,task){
          return "Export " + task.text;
        }
        gantt.config.columns[0].template = function(obj){
          return obj.text + " -";
        }
        gantt.init("gantt_here");
      </script>
        </div>
      </div>
    </div>
<div class="modal-footer">
        <button type="button" id="actualizargant" class="btn btn-default"  data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
</div>
