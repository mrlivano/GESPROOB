<script src="<?php echo base_url(); ?>assets/vendors/echarts/dist/echarts-all-3.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Estadisticas/pmi.js"></script>

<div class="right_col" role="main">
    <div class="row tile_count" style="text-align: center;">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">TOTAL PY</span>
            <div class="count">
                <center>
                    <h2 style="font-size: 14px;"><div id="NumPip"></div></h2>
                </center>
            </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">MONTO TOTAL</span>
            <div class="count">
                <center>
                    <h2 style="font-size: 14px;"><div id="TotalMonto"></div></h2>
                </center>
            </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">TOTAL  PIP</span>
            <div class="count">
                <center>
                    <h2 style="font-size: 14px;"><div id="totalpip"></div></h2>
                </center>
            </div>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">MONTO PIP</span>
            <div class="count">
                <center>
                    <h2 style="font-size: 14px;"><div id="monto_programado"></div></h2>
                </center>
            </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">TOTAL NO PIP</span>
            <div class="count">
                <center>
                    <h2 style="font-size: 14px;"><div id="totalnopip"></div></h2>
                </center>
            </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">MONTO NO PIP</span>
            <div class="count">
            <center>
                    <h2 style="font-size: 14px;"><div id="monto_programado_nopip"></div></h2>
                </center>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5>Cantidad de PIP Por Provincias</h5>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="PipProvincias" style="height:350px;"></div>
                    </div>
                </div>
            </div>
               <div class="col-md-8 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5>Monto de PIP Por Provincias</h5>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <div id="MontoPipProvincia" style="height:350px;"></div>
                        </div>                        
                    </div>
                </div>
            </div>

             <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5>Cantidad de PIP Por Ciclo de Inversion</h5>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="NumPipCicloInversion" style="height:350px;"></div>
                    </div>
                </div>
            </div>
               <div class="col-md-8 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5>Monto de PIP Por Ciclo de inversión</h5>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <div id="MontoPipCicloInversion" style="height:350px;"></div>
                        </div>                        
                    </div>
                </div>
            </div>

    
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>PIP
                            <small>PROYECTOS POR PROVINCIAS</small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a></li>
                                    <li><a href="#">Settings 2</a></li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="dashboard-widget-content">
                            <ul class="list-unstyled timeline widget">
                                <li>
                                    <div class="block">
                                        <h2 class="title">ABANCAY</h2>
                                        <br>
                                        <table class="table table-condensed table-hover" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td>CANTIDAD DE PIPS:</td>
                                                    <td class="col-sm-5"><div style="text-align: center;" id="CantidadPAbancay"></div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <h2 class="title">ANDAHUAYLAS</h2>
                                        <br>
                                        <table class="table table-condensed table-hover" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td>CANTIDAD DE PIPS:</td>
                                                    <td class="col-sm-5"><div style="text-align: center;" id="CantidadPAndahuaylas"></div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <h2 class="title">ANTABAMBA</h2>
                                        <br>
                                        <table class="table table-condensed table-hover" width="100%">
                                            <tr>
                                                <td>CANTIDAD DE PIPS:</td>
                                                <td class="col-sm-5"><div style="text-align: center;" id="CantidadPAntabamba"></div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <h2 class="title">AYMARAES</h2>
                                        <br>
                                        <table class="table table-condensed table-hover" width="100%">
                                            <tr>
                                                <td>CANTIDAD DE PIPS:</td>
                                                <td class="col-sm-5"><div style="text-align: center;" id="CantidadPAymaraes"></div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <h2 class="title">CHINCHEROS</h2>
                                        <br>
                                        <table class="table table-condensed table-hover" width="100%">
                                            <tr>
                                                <td>CANTIDAD DE PIPS:</td>
                                                <td class="col-sm-5">
                                                    <div style="text-align: center;" id="CantidadPChincheros"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <h2 class="title">COTABAMBAS</h2>
                                        <br>
                                        <table class="table table-condensed table-hover" width="100%">
                                            <tr>
                                                <td>CANTIDAD DE PIPS:</td>
                                                <td class="col-sm-5">
                                                    <div style="text-align: center;" id="CantidadPCotabambas"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <h2 class="title">GRAU</h2>
                                        <br>
                                        <table class="table table-condensed table-hover" width="100%">
                                            <tr>
                                                <td>CANTIDAD DE PIPS:</td>
                                                <td><div style="text-align: center;" id="CantidadPGrau"></div></td>
                                            </tr>
                                        </table>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>GEOLOCALIZACION
                                    <small>DE LOS PIPS</small>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <h2 class="line_30">Provincias de Apurimac</h2>
                                        <table class="countries_list">
                                            <tbody>
                                            <tr>
                                                <td>ABANCAY</td>
                                                <td class="fs15 fw700 text-right">33%</td>
                                            </tr>
                                            <tr>
                                                <td>ANDAHUAYLAS</td>
                                                <td class="fs15 fw700 text-right">27%</td>
                                            </tr>
                                            <tr>
                                                <td>ANTABAMBA</td>
                                                <td class="fs15 fw700 text-right">16%</td>
                                            </tr>
                                            <tr>
                                                <td>AYMARAES</td>
                                                <td class="fs15 fw700 text-right">11%</td>
                                            </tr>
                                            <tr>
                                                <td>CHINCHEROS</td>
                                                <td class="fs15 fw700 text-right">10%</td>
                                            </tr>
                                            <tr>
                                                <td>COTABAMBAS</td>
                                                <td class="fs15 fw700 text-right">10%</td>
                                            </tr>
                                            <tr>
                                                <td>GRAU</td>
                                                <td class="fs15 fw700 text-right">10%</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <div id="map" style="height: 350px;"></div>
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
