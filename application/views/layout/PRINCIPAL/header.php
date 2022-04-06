<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GESPRO</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"
          rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url(); ?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/bootstrap-select.css">

    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
          rel="stylesheet">


		  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122307432-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-122307432-1');
</script>

    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/build/css/inicio_custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adminlte/_all-skins.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adminlte/AdminLTE.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adminlte/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adminlte/_all-skins.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adminlte/ionicons.min.css" rel="stylesheet">
    <style>
         body
        {
            font-size: 11px;
        }
    </style>

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                  <div class="navbar nav_title" style="border: 0;">
                    <a href="#" class="site_title"><i class="fa fa-ioxhost"></i> <span>GESPRO</span></a>
                  </div>
                <div class="clearfix"></div>
                <br>
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section active">
                        <h3>MENU</h3>
                        <ul class="nav side-menu" style="">
                            <li class="active"><a><i class="fa fa-bank"></i> Normatividad <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: block;">
                                    <li><a href="https://www.mef.gob.pe/es/documentacion-sp-30574/temas/sistema-nacional-de-programacion-multianual-y-gestion-de-inversiones-invierte-pe/15837-decreto-supremo-n-027-2017-ef-2/file">DECRETO SUPREMO Nº 027-2017-EF</a></li>
                                    <li><a href="https://www.mef.gob.pe/es/documentacion-sp-30574/temas/sistema-nacional-de-programacion-multianual-y-gestion-de-inversiones-invierte-pe/15836-decreto-legislativo-n-1252-1/file">DECRETO LEGISLATIVO N° 1252</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-book"></i> Guia de Usuario <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="#">Mantenimiento de Parametros</a></li>
                                    <li><a href="#">PMI</a></li>
                                    <li><a href="#">Formulacion y Evaluacion</a></li>
                                    <li><a href="#">Ejecucion</a></li>
                                    <li><a href="#">Liquidacion</a></li>
                                    <li><a href="#">Reportes</a></li>
                                    <li><a href="#">Control de Usuarios</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-download"></i> Descargas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="https://www.mef.gob.pe/es/anexos-y-formatos#anexos">Anexos InviertePe</a></li>
                                    <li><a href="https://www.mef.gob.pe/es/anexos-y-formatos#formatos">Formatos</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-link"></i> Enlaces <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="http://ofi5.mef.gob.pe/sosem2/">App Sosem</a></li>
                                    <li><a href="http://ofi4.mef.gob.pe/odi/login.asp?mensaje=si">Banco de inversiones</a></li>
                                    <li><a href="https://www.mef.gob.pe/es/aplicativos-invierte-pe?id=4279">Consulta de inversiones</a></li>
                                    <li><a href="https://apps4.mineco.gob.pe/sispipapp/">Programacion Multianual InviertePE</a></li>
                                    <li><a href="http://apps2.mef.gob.pe/consulta-vfp-webapp/consultaExpediente.jspx">Consulta SIAF</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="count">
                    <CENTER><a href=""></a>
                        <img src="<?php echo base_url(); ?>assets/images/APURIMAC.png" class="img-rounded"
                             alt="Cinque Terre" width="100" height="90" style="opacity: 0.5;">
                        <br>

                        <p>UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA</p>


                        <p id="copyrights_footer">Seguimiento y Monitoreo de Proyectos de Inversión</p>
                        <p>GESPRO</p>

                </div>

                <!-- /menu footer buttons -->
<!--                <div class="sidebar-footer hidden-small">-->
<!--                    <a data-toggle="tooltip" data-placement="top" title="Settings">-->
<!--                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>-->
<!--                    </a>-->
<!--                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">-->
<!--                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>-->
<!--                    </a>-->
<!--                    <a data-toggle="tooltip" data-placement="top" title="Lock">-->
<!--                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>-->
<!--                    </a>-->
<!--                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">-->
<!--                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>-->
<!--                    </a>-->
<!--                </div>-->
                <!-- /menu footer buttons -->
            </div>
        </div>
        <!-- top navigation -->
        <!-- /top navigation -->
