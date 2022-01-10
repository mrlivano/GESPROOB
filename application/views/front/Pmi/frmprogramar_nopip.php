<style>


  #table-ProyectoInversionProgramado > tbody > tr > td
  {
    vertical-align: middle;
  }
  #table_NoPip>tbody>tr>td:nth-child(0n+5)
  {
    text-align: right;
  }
  #Table_Programar>tbody>tr>td:nth-child(0n+4)
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
                    <h2>Programación de No PIP<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table id="table_NoPip" class="table table-striped table-bordered table-hover table-responsive display  compact " ellspacing="0" width="100%">
                            <thead style="background-color: #5A738E;color:#FFFFFF; ">
                                <tr>
                                    <th style="width: 1%">#</th>
                                    <th style="width: 8%"><i class="fa fa-thumb-tack"></i> Cod. </th>
                                    <th><i class="fa fa-bookmark-o"></i> Nombre</th>
                                    <th style="width: 8%"> Función</th>
                                    <th style="width: 8%; text-align: right;"><i class="fa fa-money"></i> Costo</th>
                                    <th style="width: 12%"> Tipo NO PIP</th>
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
        <div class="clearfix"></div>
    </div>
</div>

<div class="modal fade" id="Ventana_Programar" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Programar No PIP</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form_AddProgramacion"   action="<?php echo base_url(); ?>bancoproyectos/Get_OperacionMantenimiento" method="POST"  onSubmit="return false;">
                    <div id="validarRegistroProgramarNoPip">

                        <input id="txt_id_pip_programacion" name="txt_id_pip_programacion" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                             <div class="item form-group">
                               <div class="col-md-4">
                               <label>Cartera</label>
                                    <select  id="Cbx_AnioCartera" selected name="Cbx_AnioCartera" class="selectpicker"></select>
                                    <!--<input type="text" id="Aniocartera" value="<?=(isset($anio) ? $anio : date('Y'))?>">-->
                                </div>
                                   <div class="col-md-8" style="padding-top: 3px;">
                                        <span id="lb_addProgramacion" style='color:white;padding:4px;background:#D9534F;font-weight:bold;font-size:17px;'></span>
                                </div>
                              </div>
                               <div class="item form-group">
                               <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>Código Único</label>
                                      <input  class="form-control" id="txt_codigo_unico_pi" name="txt_codigo_unico_pi" type="text" disabled="disabled">
                                    </div>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <label>Nombre del Proyecto</label>
                                      <input  class="form-control" id="txt_nombre_proyecto" name="txt_nombre_proyecto" type="text" disabled="disabled">
                                    </div>
                                   <div class="col-md-2 col-sm-6 col-xs-12">
                                      <label>Costo del Proyecto</label>
                                      <input class="form-control" id="txt_costo_proyecto" name="txt_costo_proyecto" type="text" disabled="disabled">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                      <label>Brecha  Proyecto.</label>
                                      <select id="cbxBrecha" name="cbxBrecha" class="selectpicker"   title="Elija Brecha" required="required">
                                      </select>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12 form-group">
                                      <center><label style="color: red">Saldo a Programar</label></center>
                                      <input class="form-control" id="txt_saldoprogramar" name="txt_saldoprogramar" type="text" required="required">
                                    </div>

                                 </div>
                              <h6><i class="fa fa-money"></i><b> Meta Presupuestal</b></h6>
                              <div class="item form-group">
                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                      <center><label>PIA</label></center>
                                      <input  class="form-control" id="txt_pia_nopip" name="txt_pia_nopip" type="number" required="required" value="0.00" disabled="disabled">
                                    </div>
                                   <div class="col-md-2 col-sm-6 col-xs-12">
                                      <center><label>PIM</label></center>
                                      <input  class="form-control" id="txt_pim_nopip" name="txt_pim_nopip" type="number" required="required" value="0.00"  disabled="disabled">
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-12">
                                      <center><label>Devengado</label></center>
                                      <input  class="form-control" id="txt_devengado_nopip" name="txt_devengado_nopip" type="number" required="required" value="0.00"  disabled="disabled">
                                    </div>
                                    <div class="col-md-2 col-sm-6 col-xs-12 form-group">
                                      <center><label>Prioridad</label></center>
                                      <input  class="form-control" id="txt_prioridad" name="txt_prioridad" type="text" readonly="" style="background:#EEEEEE;">
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12 form-group">
                                      <CENTER><label><b> Monto Programación:</b>Año 1</label></CENTER>
                                      <input  class="form-control" id="txt_anio1" name="txt_anio1" type="text" required="required">
                                    </div>
                                 </div>
                            </div>


                                 <div class="item form-group">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>.</label><br>
                                       <button  id="send_addProgramacion"  type='button' class="btn btn-success">
                                             <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
                                        </button>
                                    </div>
                                 </div>


                     <div class="ln_solid"></div>
                     <div class="x_panel" style="background-color: #EEEEEE;">
                    <center>
                    <table  id="Table_Programar" class="table   table-hover" >
                    <thead >
                       <tr>
                         <th  ><i></i> #</th>
                         <th  ><i></i> Cartera</th>
                         <th  ><i></i> Brecha</th>
                         <th  ><i></i> Año Programado</th>
                         <th  ><i></i> Monto Programado</th>
                         <th  ><i></i> Prioridad</th>
                         <th  ><i></i> Opción</th>
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
<!-- /.Fin Ventana programar-->
<!-- /.Ventana presupuestal-->
<div class="modal fade" id="Ventana_Meta_Presupuestal_PI" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Meta Presupuestal PI</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form_AddMeta_Pi"   action="<?php echo base_url(); ?>bancoproyectos/Get_OperacionMantenimiento" method="POST" >

                        <input id="txt_id_pip_programacion_mp" name="txt_id_pip_programacion_mp" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                              <div class="item form-group">
                               <div class="col-md-2 col-sm-6 col-xs-12">
                                      <label>Año</label>
                                      <input id="txt_anio_meta" name="txt_anio_meta" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name"  placeholder="Año" required="required" type="number"  value="2017">
                                    </div>
                              </div>
                               <div class="item form-group">
                               <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>Código Único</label>
                                      <input  class="form-control" id="txt_codigo_unico_pi_mp" name="txt_codigo_unico_pi_mp" type="text" disabled="disabled">
                                    </div>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                      <label>Nombre del Proyecto</label>
                                      <input  class="form-control" id="txt_nombre_proyecto_mp" name="txt_nombre_proyecto_mp" type="text" disabled="disabled">
                                    </div>
                                   <div class="col-md-3 col-sm-8 col-xs-12">
                                      <label>Costo del Proyecto</label>
                                      <input  class="form-control" id="txt_costo_proyecto_mp" name="txt_costo_proyecto_mp" type="number" disabled="disabled">
                                    </div>

                                    <div class="col-md-4 col-sm-8 col-xs-12">
                                      <label>Meta Presupuestal</label>
                                      <select id="cbx_meta_presupuestal" name="cbx_meta_presupuestal" class="selectpicker" data-live-search="true" title="Elija Meta">
                                      </select>
                                    </div>
                                    <div class="col-md-4 col-sm-8 col-xs-12">
                                      <label>Correlativo Meta </label>
                                      <select id="cbx_Meta" name="cbx_Meta" class="selectpicker" data-live-search="true" title="Elija Meta">
                                      </select>
                                    </div>
                                 </div>
                              <div class="item form-group">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>PIA</label>
                                      <input  class="form-control" id="txt_pia" name="txt_pia" type="number" required="required">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>PIM</label>
                                      <input  class="form-control" id="txt_pim" name="txt_pim" type="number" required="required">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>Certificado</label>
                                      <input  class="form-control" id="txt_certificado" name="txt_certificado" type="number" required="required">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>compromiso</label>
                                      <input  class="form-control" id="txt_compromiso" name="txt_compromiso" type="number" required="required">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>Devengado</label>
                                      <input  class="form-control" id="txt_devengado" name="txt_devengado" type="number" required="required">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>Girado</label>
                                      <input  class="form-control" id="txt_girado" name="txt_girado" type="number" required="required">
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                      <label>.</label><br>
                                       <button  id="send" type="submit" class="btn btn-success">
                                             <span class="glyphicon glyphicon-floppy-saved"></span> Guardar
                                        </button>
                                    </div>
                                 </div>


                     <div class="ln_solid"></div>
                     <div class="x_panel" style="background-color: #EEEEEE;">
                    <center>
                    <table  id="Table_meta_pi" class="table   table-hover" >
                    <thead >
                       <tr>
                         <th  ><i class="fa fa-thumb-tack"></i> #</th>
                         <th  ><i class="fa fa-thumb-tack"></i> Año </th>
                         <th  ><i class="fa fa-thumb-tack"></i> PIA</th>
                         <th  ><i class="fa fa-thumb-tack"></i> PIM</th>
                         <th  ><i class="fa fa-thumb-tack"></i> Certificación</th>
                         <th  ><i class="fa fa-thumb-tack"></i> Compromiso</th>
                         <th  ><i class="fa fa-thumb-tack"></i> Devengado</th>
                         <th  ><i class="fa fa-thumb-tack"></i> Girado</th>
                         <th  ><i class="fa fa-thumb-tack"></i> Opción</th>
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
<!-- /.Fin Ventana meta presupuestal-->
<style>
  .linkItem:hover{
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
            }
        });
    }
  });
});
</script>
