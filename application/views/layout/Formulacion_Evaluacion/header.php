<!DOCTYPE html>
<html lang="en">
     <script>
    var base_url = '<?php echo base_url(); ?>';
    </script>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GESPRO</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>

    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
       <!-- jQuery -->

    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url(); ?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/bootstrap-select.css"><!--- para el selector con buscardor---->

      <!-- Datatables -->

    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/vendors/animate/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/fullcalendar/dist/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">

    <link href="<?php echo base_url(); ?>assets/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/cropper/dist/cropper.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/jquery.growl.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/Helper/jsHelper.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/js/sweetalert.css">
  <style>
   #ProgramacionHorizontal{
      width: 100% !important;
    }

  </style>
<!--   diagrama de gant          -->

    <script src="<?php echo base_url(); ?>assets/codebase/dhtmlxgantt.js" type="text/javascript" charset="utf-8"></script>
  <script src="http://export.dhtmlx.com/gantt/api.js" type="text/javascript" charset="utf-8"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/codebase/dhtmlxgantt.css" type="text/css" media="screen" title="no title" charset="utf-8">
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/common/testdata.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/codebase/locale/locale_es.js"></script>
  <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
  <style type="text/css">
      #gantt{
        height:600px;
        padding:0px;
         margin:0px;
         overflow: hidden;
       }
        #navtittlemin
        {
          display: none;
        }
        body
        {
            font-size: 11px;
        }

      @media (max-width: 750px) {
        #navtittle{
          display: none;
        }
        #navtittlemin
        {
          display: inline-block;
        }
    </style>
    <!-- Custom Theme Style -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122307432-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-122307432-1');
</script>


  </head>
  <style media="screen">
      #table-formulacion, #table-EvaluacionFE {
      table-layout: fixed;
      width: 100% !important;
      }
      #table-formulacion td, #table-EvaluacionFE td,
      #table-formulacion th, #table-EvaluacionFE th{
      width: auto !important;
      white-space: normal;
      text-overflow: ellipsis;
      overflow: hidden;
      }
  </style>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo site_url('Inicio') ?>" class="site_title"><img style="display: inline-block; height: 30px; width: 30PX; opacity: 1;" src="<?php echo base_url(); ?>assets/images/logoUniq.png" class="img-responsive"> <span>GESPRO</span></a>
            </div>

            <div class="clearfix"></div>

                    <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
              <ul class='nav side-menu'>
                <li><a > <i class="fa fa-home"></i>FORMULACIÓN Y EVALUACIÓN<span class=""></span></a></li>
                <?php
                  $openTag=false;
                  $arrayMenu=$this->session->userdata('menuUsuario');
                  for($i=0;$i<count($arrayMenu);$i++){
                  if($arrayMenu[$i]['id_modulo']=='FE'){
                    if($i>0 and ($arrayMenu[$i]['id_menu']!=$arrayMenu[$i-1]['id_menu'])){
                      if($openTag==true){
                        echo '</ul></li>';
                        $openTag=false;
                      }

                      ?>
                      <?php
                    }
                    if($arrayMenu[$i]['url']==''){

                      if($openTag==false){
                        ?>
                        <li>
                          <a> <i class="<?php echo $arrayMenu[$i]['class_icono']; ?>"></i> <?php echo $arrayMenu[$i]['nombre']; ?> <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                             <li><a href="<?php echo site_url($arrayMenu[$i]["urlSubmenu"]); ?>"><?php echo $arrayMenu[$i]["nombreSubmenu"] ?></a></li>
                        <?php
                        $openTag=true;
                      }
                      else{
                        ?>
                        <li><a href="<?php echo site_url($arrayMenu[$i]["urlSubmenu"]); ?>"><?php echo $arrayMenu[$i]["nombreSubmenu"] ?></a></li>
                        <?php
                      }
                    }
                    else{
                      ?>
                      <li>
                        <a href="<?php echo site_url($arrayMenu[$i]["url"]); ?>"> <i class="<?php echo $arrayMenu[$i]['class_icono']; ?>"></i> <?php echo $arrayMenu[$i]['nombre']; ?></a>
                      </li>
                      <?php
                    }
                  }
                  }
                ?>
              </ul>
              </div>
            </div>
            <!-- /sidebar menu -->


            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
             <!-- <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>

              </div>-->
              <div class="nav toggle" style="position: relative;">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                  <div id="navtittle"  >
                    <span style="position: absolute;top: 14px;left: 50px; width: 700px; font-size: 20px; text-shadow: 1px 1px 1px rgba(0,0,0,0.3);">Formulación, Evaluación de Proyectos</span>
                  </div>

                  <div id="navtittlemin">
                  <span style="position: absolute;top: 14px;left: 50px; width: 700px; font-size: 20px; text-shadow: 1px 1px 1px rgba(0,0,0,0.3);">FEP</span></div>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt=""><?= $this->session->userdata('nombreUsuario')?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"><?= $this->session->userdata('desc_usuario_tipo');?></a></li>
                    <li><a href="javascript:;"><?= $this->session->userdata('nombrePersona');?></a></li>
                    <li><a href="#" onclick="paginaAjaxDialogo('modalCambio', 'Cambiar Contraseña',null, base_url+'index.php/usuario/cambiarContrasenia', 'GET', null, null, false, true);return false;"><i class="fa fa-lock pull-right"></i> Cambiar Contraseña</a></li>
                    <li><a href="<?php echo base_url("index.php/Login/logout");?>"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a></li>
                  </ul>
                </li>
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"><?=$this->session->userdata('UnidadEjecutora')?>
                  </a>
                </li>

                <li role="presentation" class="dropdown">
                  <ul id="menu1_notificacion" class="dropdown-menu list-unstyled msg_list" role="menu">

                    <li>
                      <div class="text-center">
                        <a href="">
                          <strong>Proyectos en formulacion</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
