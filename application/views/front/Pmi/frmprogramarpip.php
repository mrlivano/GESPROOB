<style>
    #table-ProyectoInversionProgramado > tbody > tr > td
    {
        vertical-align: middle;
    }
    #table_formulacion_evaluacion>tbody>tr>td:nth-child(0n+5)
    {
        text-align: right;
    }
    #table_ejecucion>tbody>tr>td:nth-child(0n+5)
    {
        text-align: right;
    }
    #Table_Programar>tbody>tr>td:nth-child(0n+4)
    {
        text-align: right;
    }
    #Table_funcionamiento>tbody>tr>td:nth-child(0n+5)
    {
        text-align: right;
    }
    #Table_Programar_operacion_mantenimiento>tbody>tr>td:nth-child(0n+4)
    {
        text-align: right;
    }
</style>
<div class="right_col" role="main">
    <div class="">
    <div class="page-title"></div>
    <div class="clearfix"></div>
    <div class="">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Programación de Proyectos de Inversión</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation"><a  href="#tab_brecha" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Formulación y Evaluación</a>
                            </li>
                            <li role="presentation" class="active"><a  href="#tab_Ejecución" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Ejecución</a>
                            </li>
                            <li role="presentation" class=""><a  href="#tab_OperacionMantenimiento" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Operación y Mantenimiento</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="tab_brecha" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="row" class="container-fluid">
                                                <div class="col-md-4"></div>
                                            </div>
                                            <div class="x_content">
                                                <table id="table_formulacion_evaluacion" class="table table-striped table-bordered table-hover table-responsive display  compact " width="100%">
                                                    <thead style="background-color: #5A738E;color:#FFFFFF; ">
                                                        <tr>
                                                            <th style="width: 8%">Cod. </th>
                                                            <th> Nombre</th>
                                                            <th style="width: 8%"> Función</th>
                                                            <th style="width: 8%"> Costo</th>
                                                            <th style="width: 12%"> Estado Ciclo</th>
                                                            <th style="width: 12%"> Estado</th>
                                                            <th style="width: 12%"> </th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_Ejecución" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="row" class="container-fluid">
                                                <div class="col-md-4"></div>
                                            </div>
                                            <div class="x_content">
                                                <table id="table_ejecucion" class="table table-striped table-bordered table-hover table-responsive display  compact " ellspacing="0" width="100%">
                                                    <thead style="background-color: #5A738E;color:#FFFFFF; ">
                                                        <tr>
                                                            <th style="width: 1%">#</th>
                                                            <th style="width: 1%">#</th>
                                                            <th style="width: 8%">Cod. </th>
                                                            <th>Nombre</th>
                                                            <th style="width:  8%"> Función</th>
                                                            <th style="width: 12%"> Costo</th>
                                                            <th style="width: 12%"> Estado Ciclo</th>
                                                            <th style="width: 12%"> Estado</th>
                                                            <th style="width: 12%">&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_OperacionMantenimiento" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="row" class="container-fluid">
                                                <div class="col-md-4">
                                                </div>
                                            </div>
                                            <div class="x_content">
                                                    <table id="Table_funcionamiento" class="table table-striped table-bordered table-hover table-responsive display  compact " ellspacing="0" width="100%">
                                                        <thead style="background-color: #5A738E;color:#FFFFFF; ">
                                                            <tr>
                                                                <th style="width: 1%">#</th>
                                                                <th style="width: 8%">Cod. </th>
                                                                <th>Nombre</th>
                                                                <th style="width: 8%"> Función</th>
                                                                <th style="width: 12%"> Costo</th>
                                                                <th style="width: 12%"> Estado Ciclo</th>
                                                                <th style="width: 12%"> Estado</th>
                                                                <th style="width: 12%">&nbsp;</th>
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
        <div class="clearfix"></div>
    </div>
</div>
<div class="modal fade" id="Ventana_Programar" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Programación de Inversiones</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form class="form-horizontal" id="form_AddProgramacion" action="<?php echo base_url(); ?>bancoproyectos/Get_OperacionMantenimiento" method="POST"  onSubmit="return false;"  >
                            <input id="txt_id_pip_programacion" name="txt_id_pip_programacion" required="required" type="hidden">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label>Cartera:</label>
                                    <div>
                                        <select  id="Cbx_AnioCartera" selected name="Cbx_AnioCartera" class="selectpicker"></select>
                                    </div>                                    
                                </div>
                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <div>
                                        <span id="lb_addProgramacion" style='color:white;padding:4px;background:#D9534F;font-weight:bold;font-size:17px;'></span>
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <label>Código Único:</label>
                                    <div>
                                        <input  class="form-control " id="txt_codigo_unico_pi" name="txt_codigo_unico_pi" type="text" disabled="disabled" />
                                    </div>                                    
                                </div>
                                <div class="col-md-10 col-sm-12 col-xs-12">
                                    <label>Nombre:</label>
                                    <div>
                                        <input  class="form-control" id="txt_nombre_proyecto" name="txt_nombre_proyecto" type="text" disabled="disabled" />
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-12 col-xs-12">
                                    <label>Costo:</label>
                                    <div>
                                        <input  class="form-control" id="txt_costo_proyecto" name="txt_costo_proyecto"  disabled="disabled" />
                                    </div>                                    
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <label>Brecha:</label>
                                    <div>
                                        <select id="cbxBrecha" name="cbxBrecha" class="selectpicker form-control" title="Elija Brecha"></select>
                                    </div>                                    
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <label>Saldo:</label>
                                    <div>
                                        <input  class="form-control" id="txt_saldoprogramar" name="txt_saldoprogramar" value="0.00" type="text" >
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <label>PIA:</label>
                                    <div>
                                        <input  class="form-control" id="txt_pia_fye" name="txt_pia_fye" type="text" disabled="disabled" />
                                    </div>                                    
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <label>PIM:</label>
                                    <div>
                                        <input  class="form-control" id="txt_pim_pia_fye" name="txt_pim_pia_fye" type="text"   disabled="disabled" />
                                    </div>                                    
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <label>Devengado:</label>
                                    <div>
                                        <input class="form-control" id="txt_devengado_pia_fye" name="txt_devengado_pia_fye" type="text"  disabled="disabled" />
                                    </div>                                    
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12">
                                    <label>Prioridad:</label>
                                    <div>
                                        <input  class="form-control " id="txt_prioridad" name="txt_prioridad"  type="text">
                                    </div>                                    
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label style="color:#e88c2a;">Avance Financiero: <span id="spanAvanceFinanciero"></span> %</label>                              
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>Proyección de Gastos</label>                              
                                </div> 
                                <div class="col-md-4 col-sm-12 col-xs-12" >
                                    <label>Año 1:</label>
                                    <div>
                                        <input  class="form-control" id="txt_anio1" name="txt_anio1" type="text" />
                                    </div>                                    
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label>Año 2:</label>
                                    <div>
                                        <input class="form-control" id="txt_anio2" name="txt_anio2" type="text" />
                                    </div>                                    
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label>Año 3:</label>
                                    <div>
                                        <input  class="form-control" id="txt_anio3" name="txt_anio3" type="text" />
                                    </div>                                    
                                </div>                                
                            </div>
                            <br>
                            <div class="row" id='ct_anio'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>Operación y Mantenimiento</label>                              
                                </div> 
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label>Año 4:</label>
                                    <div>
                                        <input class="form-control" id="txt_anio4" name="txt_anio4" type="text" />
                                    </div>                                    
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label>Año 5:</label>
                                    <div>
                                        <input  class="form-control" id="txt_anio5" name="txt_anio5" type="text" />
                                    </div>                                    
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label>Año 6:</label>
                                    <div>
                                        <input  class="form-control" id="txt_anio6" name="txt_anio6" type="text" />
                                    </div>                                    
                                </div>                                
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <button  id="send_addProgramacion"  type='button' class="btn btn-success">
                                        <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
                                    </button>
                                </div>                            
                            </div>
                        </form>
                        <div class="ln_solid"></div>
                        <div class="x_panel" style="background-color: #EEEEEE;">
                            <div class="table-responsive">
                                <table  id="Table_Programar" class="table table-hover" style="width:100%;" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cartera</th>
                                            <th>Brecha</th>
                                            <th>Año Programado</th>
                                            <th>Monto Programado</th>
                                            <th>Prioridad</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
</div>
</div>

<div class="modal fade" id="Ventana_Programar_operacion_mantenimiento" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Programar PIP - Operación Mantenimiento.</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form_AddProgramacion_operacion_mantenieminto"   action="<?php echo base_url(); ?>bancoproyectos/Get_OperacionMantenimiento" method="POST" onSubmit="return false;"    >
                         <div class="item form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input id="txt_id_pip_programacion_" name="txt_id_pip_programacion_" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                              </div>
                            </div>

                             <div class="item form-group">
                               <div class="col-md-4">
                               <label>Cartera </label>
                                    <select  id="Cbx_AnioCartera_" selected name="Cbx_AnioCartera_" class="selectpicker"></select>
                                    <!--<input type="text" id="Aniocartera" value="<?=(isset($anio) ? $anio : date('Y'))?>">-->
                                </div>
                                <div class="col-md-8" style="padding-top: 3px;">
                                  <span id="lb_addProgramacion_operacion_mantenieminto" style='color:white;padding:4px;background:#D9534F;font-weight:bold;font-size:17px;'></span>
                                </div>
                              </div>
                               <div class="item ">
                               <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>Código Único</label>
                                      <input  class="form-control" id="txt_codigo_unico_pi_" name="txt_codigo_unico_pi_" type="text" disabled="disabled">
                                    </div>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <label>Nombre del Proyecto</label>
                                      <input  class="form-control" id="txt_nombre_proyecto_" name="txt_nombre_proyecto_" type="text" disabled="disabled">
                                    </div>
                                   <div class="col-md-2 col-sm-6 col-xs-12">
                                      <label>Costo del Proyecto</label>
                                      <input  class="form-control" id="txt_costo_proyecto_" name="txt_costo_proyecto_"  disabled="disabled" type="text">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12  form-group">
                                      <label>Brecha Proyecto </label>
                                      <select id="cbxBrecha_" name="cbxBrecha_" class="selectpicker"   title="Elija Brecha" required="required">
                                      </select>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <center><label>Saldo a Programar</label></center>
                                      <input  class="form-control" id="txt_saldoprogramar_oper" name="txt_saldoprogramar_oper" value='0.00' type="text" required="required">
                                    </div>
                                 </div>
                                    <div style="clear:both;height:0;">&nbsp;</div>
                              <h6><i class="fa fa-money"></i><b> Meta Presupuestal</b></h6>
                              <div class="item ">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <center><label>PIA</label></center>
                                      <input  class="form-control" id="txt_pia_oper" name="txt_pia_oper" type="text" required="required" value="0.00" disabled="disabled">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <center><label>PIM</label></center>
                                      <input  class="form-control" id="txt_pim_oper" name="txt_pim_oper" type="text" required="required" value="0.00"  disabled="disabled">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <center><label>Devengado</label></center>
                                      <input class="form-control" id="txt_devengado_oper" name="txt_devengado_oper" type="text" required="required" value="0.00"  disabled="disabled">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <center><label>Prioridad</label></center>
                                      <input  class="form-control" id="txt_prioridad_" name="txt_prioridad_" type="text">
                                    </div>
                                 </div>
                              <h6><i class="fa fa-list"></i><b> Proyección de Gastos</b></h6>
                               <div class="row item ">
                                   <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <CENTER><label id="lb_anio1_">Año 1</label></CENTER>
                                      <input  class="form-control" id="txt_anio1_" name="txt_anio1_" type="text" required="required">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <CENTER><label id="lb_anio2_">Año 2</label></CENTER>
                                      <input  class="form-control" id="txt_anio2_" name="txt_anio2_" type="text" required="required">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <CENTER><label id="lb_anio3_">Año 3</label></CENTER>
                                      <input  class="form-control" id="txt_anio3_" name="txt_anio3_" type="text" required="required">
                                    </div>


                                 </div>
                                 <div class="row item " id='ct_anio_'>
                                  <h6><i class="fa fa-list"></i><b> Monto Operación y Mantenimiento</b></h6>
                                   <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <CENTER><label id="lb_anio4_">Año 4</label></CENTER>
                                      <input  class="form-control" id="txt_anio4_" name="txt_anio4_" type="text" />
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <CENTER><label id="lb_anio5_">Año 5</label></CENTER>
                                      <input  class="form-control" id="txt_anio5_" name="txt_anio5_" type="text" />
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <CENTER><label id="lb_anio6_">Año 6</label></CENTER>
                                      <input  class="form-control" id="txt_anio6_" name="txt_anio6_" type="text" />
                                    </div>


                                </div>
                                  <div class="row item ">
                                 <div class="col-md-12">
                                      <label>.</label><br>
                                       <button  id="send_addProgramacion_operacion_mantenieminto" type="button" class="btn btn-success">
                                             <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
                                        </button>

                                    </div>
                                  </div>


                     <div class="ln_solid"></div>
                     <div class="x_panel" style="background-color: #EEEEEE;">
                    <center>
                    <table  id="Table_Programar_operacion_mantenimiento" class="table   table-hover" >
                    <thead >
                       <tr>
                         <th><i></i> #</th>
                         <th><i></i> Cartera</th>
                         <th><i></i> Brecha</th>
                         <th><i></i> Año Programado</th>
                         <th><i></i> Monto Programado</th>
                         <th><i></i> Prioridad</th>
                         <th><i></i> Opción</th>
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

<style>
    .linkItem:hover
    {
        text-decoration: underline;
        font-weight: bold;
        cursor: pointer;
    }
</style>
<script>
function calculoFecha(fecha1,fecha2) {
  var fechaInicio = new Date(fecha1).getTime();
  var fechaFin    = new Date(fecha2).getTime();
  var tiempo = fechaFin-fechaInicio;
  var dias = Math.floor(tiempo / (1000 * 60 * 60 * 24));
  return dias;
}
$(function(){

  $('#Ventana_Programar').on('hidden.bs.modal', function () {

      $('#form_AddProgramacion').each(function(){
        this.reset();
      });
      $('.selectpicker').selectpicker('refresh');
      $('#form_AddProgramacion').data('formValidation').resetForm();
  })
  $('#Ventana_Programar_operacion_mantenimiento').on('hidden.bs.modal', function () {

      $('#form_AddProgramacion_operacion_mantenieminto').each(function(){
        this.reset();
      });
      $('.selectpicker').selectpicker('refresh');
      $('#form_AddProgramacion_operacion_mantenieminto').data('formValidation').resetForm();
  })
  $("body").on("change","#Cbx_AnioCartera",function(e){
    if($("#Cbx_AnioCartera").val()!='' && $("#Cbx_AnioCartera").val()!=null){
        $.ajax({
            "url":base_url +"index.php/CarteraInversion/GetCarteraFechaCierre/"+$("#Cbx_AnioCartera").val(),
            type:"POST",
            success:function(data){
                if(calculoFecha(data,'<?php echo date("Y-m-d"); ?>')>0){
                  $("#send_addProgramacion").css("display","none");
                  $("#lb_addProgramacion").css("display","");
                  $("#lb_addProgramacion").html("LA FECHA DE CIERRE DE LA CARTERA FUE EL: "+data);
                }
                else{
                  $("#send_addProgramacion").css("display","");
                  $("#lb_addProgramacion").css("display","none");
                  $("#lb_addProgramacion").html("");
                }
                var anio=parseInt($('#Cbx_AnioCartera option:selected').text());
                $("#lb_anio1").html(anio+1);
                $("#lb_anio2").html(anio+2);
                $("#lb_anio3").html(anio+3);
                $("#lb_anio4").html(anio+1);
                $("#lb_anio5").html(anio+2);
                $("#lb_anio6").html(anio+3);
            }
        });
    }
  });
  $("body").on("change","#Cbx_AnioCartera_",function(e){
     if($("#Cbx_AnioCartera_").val()!='' && $("#Cbx_AnioCartera_").val()!=null){
        $.ajax({
            "url":base_url +"index.php/CarteraInversion/GetCarteraFechaCierre/"+$("#Cbx_AnioCartera_").val(),
            type:"POST",
            success:function(data){
                if(calculoFecha(data,'<?php echo date("Y-m-d"); ?>')>0){
                  $("#send_addProgramacion_operacion_mantenieminto").css("display","none");
                  $("#lb_addProgramacion_operacion_mantenieminto").css("display","");
                  $("#lb_addProgramacion_operacion_mantenieminto").html("LA FECHA DE CIERRE DE LA CARTERA FUE EL: "+data);
                }
                else{
                  $("#send_addProgramacion_operacion_mantenieminto").css("display","");
                  $("#lb_addProgramacion_operacion_mantenieminto").css("display","none");
                  $("#lb_addProgramacion_operacion_mantenieminto").html("");
                }
                var anio=parseInt($('#Cbx_AnioCartera_ option:selected').text());
                $("#lb_anio1_").html(anio+1);
                $("#lb_anio2_").html(anio+2);
                $("#lb_anio3_").html(anio+3);
                $("#lb_anio4_").html(anio+1);
                $("#lb_anio5_").html(anio+2);
                $("#lb_anio6_").html(anio+3);
            }
        });
    }

  });
});
</script>
