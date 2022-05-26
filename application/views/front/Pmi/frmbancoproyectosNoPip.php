<style>
    #table-ProyectoInversionProgramado > tbody > tr > td
    {
        vertical-align: middle;
    }
    #table_no_pip>tbody>tr>td:nth-child(0n+4)
    {
        text-align: right;
    }
    .all 
    {
        margin-bottom: 0;
        margin-right: 0;
        width: 100%;
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Inversiones OARR</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <button onclick="agregarProyecto();" style="margin-top: 5px;margin-bottom: 15px;" type="button" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Nuevo </button>
                    <div class="table-responsive">
                        <table id="table_no_pip" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 2%">#</th>
                                    <th style="width: 8%">Codigo unico </th>
                                    <th style="width: 32%">Nombre</th>
                                    <th style="width: 12%; text-align: right;">Costo</th>
                                    <th style="width: 12%">Tipo IOARR</th>
                                    <th style="width: 10%">Opción</th>
                                </tr>
                                   <!-- <tr>
                                        <th rowspan="2" style="width: 1%"> </th>
                                        <th rowspan="2" style="width: 8%"> Cod.</th>
                                        <th rowspan="2" style="width: 36%"> Nombre</th>
                                        <th rowspan="2" style="width: 8%"> Tipo</th>
                                        <th rowspan="2" style="width: 8%"> Prioridad</th>
                                        <th rowspan="2" style="width: 8%"> Orden</th>
                                        <th rowspan="2" style="width: 8%"> Sector</th>
                                        <th rowspan="2" style="width: 8%"> OPMI</th>
                                        <th rowspan="2" style="width: 8%"> Nivel</th>
                                        <th rowspan="2" style="width: 12%; text-align: right;"> Costo (S/)</th>
                                        <th rowspan="2" style="width: 12%">Devengado acumulado (S/)</th>
                                        <th rowspan="2" style="width: 12%">PIM 2022 (S/)</th>
                                        <th colspan="4" style="width: 12%"> Programación del monto de inversión (S/)</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 8%"> Monto 2022 (S/)</th>
                                        <th style="width: 8%"> Monto 2023 (S/)</th>
                                        <th style="width: 8%"> Monto 2024 (S/)</th>
                                        <th style="width: 8%"> Monto 2025 (S/)</th>
                                    </tr>-->
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="modal fade" id="venta_ubicacion_geografica" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Ubicación Geográfica </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form_AddUbigeo">
                    <input id="txt_id_pip" name="txt_id_pip" required="required" type="hidden">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <label for="name">Proyecto:</label>
                            <textarea class="form-control" rows="2" readonly="readonly" id="nombreProyecto" name="nombreProyecto"></textarea>
                        </div>   
                    </div>                         
                    <br>
                    <div class="row" id="validarUbigeoPi">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <select class="selectpicker form-control" disabled="disabled">
                                <option value="Apurímac">Apurímac</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <select  id="cbx_provincia" name="cbx_provincia" class="selectpicker form-control" title="Elija provincia(s)">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <select name="cbx_distrito" id="cbx_distrito" data-live-search="true"  class="selectpicker form-control" title="Elija distrito"></select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="txt_latitud" name="txt_latitud"  class="form-control" placeholder="Latitud" type="text">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="txt_longitud" name="txt_longitud"  class="form-control" placeholder="Longitud"  type="text">
                        </div>
                        <div class="col-md-5 col-sm-6 col-xs-12">
                            <input type="file" class="form-control" name="ImgUbicacion" id="ImgUbicacion" accept=".png, .jpg, .jpeg">
                            <p style="color: red; display: block;" id="Advertencia">Solo se aceptan archivos en formato JPG y PNG</p>
                        </div>
                        <div class="col-md-3 col-sm-2 col-xs-12">
                            <input class="btn btn-success" onclick="agregarUbigeo();" type="button" value="Agregar">                         
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <label for="name">Mapa:</label>
                            <div>
                                <div id="mapa"></div>
                            </div>
                            <br>                            
                        </div>
                    </div>                    
                    <div class="x_panel" style="border: 1px solid #EEEEEE;">
                        <table id="TableUbigeoProyecto_x" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >
                            <thead >
                                <tr>
                                    <th style="width: 20%" >Provincia</th>
                                    <th style="width: 20%" >Distrito</th>
                                    <th style="width: 20%" >Latitud</th>
                                    <th style="width: 20%" >Longitud</th>
                                    <th style="width: 10%" >Imagen</th>
                                    <th style="width: 50%" ></th>
                                </tr>
                            </thead>
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
<div class="modal fade" id="ventana_ver_tipologia" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>
          Tipología de No Pip</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                    <div class="col-xs-12">
                                        <!-- PAGE CONTENT BEGINS -->
              <form class="form-horizontal " id="form_AddTipoNoPip"   action="<?php echo base_url(); ?>bancoproyectos/Get_TipoNoPip" method="POST" >
              <input id="txt_id_pip_Tipologia" name="txt_id_pip_Tipologia" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2"  placeholder="ID" required="required" type="hidden">
                               <div class="item form-group">
                                    <div class="col-md-12">
                                        <label for="name">Proyecto:<span class="required"></span></label>
                                        <div class="col-md-12">
                                            <textarea readonly="readonly" name="nombreProyectoTipologia" id="nombreProyectoTipologia" rows="2" class="form-control"></textarea>
                                            <br>
                                        </div>
                                    </div>
                                     <div class="col-md-4">

                                           <label for="name">Tipo No Pip.<span class="required"></span>
                                            </label>
                                                 <select   id="Cbx_TipoNoPip" name="Cbx_TipoNoPip" class="selectpicker form-control col-md-12 col-xs-12"   title="Buscar TipoNoPip...">
                                                </select>
                                    </div>
                                          <div class="col-md-4">
                                           <label for="name">Fecha <span class="required"></span>
                                            </label>
                                                  <input type="date" max="2050-12-31" id="dateFechaIniC" name="dateFechaIniC" class="form-control col-md-6 col-xs-5" data-validate-length-range="6" data-validate-words="2" required="required" type="text" value="<?php echo date("Y-m-d"); ?>" disabled="true">
                                          </div>
                                          <div class="col-md-4">
                                             <label for="name">. <span class="required"></span>
                                             </label><BR>
                                             <button  id="send" type="submit" class="btn btn-success">
                                             <span class="glyphicon glyphicon-floppy-saved"></span>Agregar
                                             </button>
                                          </div>
                      </div>

                     <div class="ln_solid"></div>
                     <div class="x_panel" style="background-color: #EEEEEE;">
                    <center>
                    <table  id="Table_TipoNoPip" class="table   table-hover" >
                    <thead >
                       <tr>
                         <th  ><i class="fa fa-thumb-tack"></i> #</th>
                         <th  ><i class="fa fa-thumb-tack"></i> Tipología No Pip</th>
                         <th  ><i class="fa fa-thumb-tack"></i> Fecha</th>
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

<script>
    function chargemap() 
    {
        var myLatlng = new google.maps.LatLng(-13.637,-72.878);
        var myOptions = 
        {
            zoom:7,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("mapa"), myOptions);
        marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });

        google.maps.event.addListener(map, "click", function(event) 
        {
            var clickLat = event.latLng.lat();
            var clickLon = event.latLng.lng();
            document.getElementById("txt_latitud").value = clickLat.toFixed(5);
            document.getElementById("txt_longitud").value = clickLon.toFixed(5);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(clickLat,clickLon),
                map: map
            });
        });
    }

    window.onload = function () 
    {
    };
</script>
<style>
   div#mapa 
    {
        width: 100%;
        height: 300px;
    }
</style>

<script>
    function agregarProyecto()
    {
        paginaAjaxDialogo(null, 'Registrar IOARR', null, base_url+'index.php/ProyectoInversion/inversionOARR', 'GET', null, null, false, true);
    }

    $(function()
    {
        $('#validarUbigeoPi').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields: 
            {
                cbx_provincia: 
                {
                    validators: 
                    {
                        notEmpty: 
                        {
                            message: '<b style="color: red;">Selecciones una Opción.</b>'
                        }
                    }
                },
                cbx_distrito: 
                {
                    validators: 
                    {
                        notEmpty: 
                        {
                            message: '<b style="color: red;">Selecciones una Opción.</b>'
                        }
                    }
                }
            }
        });
    });
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1uRF6cxgwFc9DGwREFvIE6oorBaWny64"></script>