<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIGEI</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/bootstrap-select.css">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/js/sweetalert.css">
    <script src="<?php echo base_url(); ?>assets/js/Helper/jsHelper.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sweetalert-dev.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>


    <script>
    var base_url = '<?php echo base_url(); ?>';
    </script>
    <!-- Custom Theme Style -->

    <style>
        #navtittlemin
        {
          display: none;
        }

        @media (max-width: 750px) {
        #navtittle{
          display: none;
        }
        #navtittlemin
        {
          display: inline-block;
        }
      }
      body
        {
            font-size: 11px;
        }
    </style>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122307432-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-122307432-1');
</script>


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo site_url('Inicio') ?>" class="site_title"><i class="fa fa-users"></i> <span>SIGEI</span></a>
            </div>

            <div class="clearfix"></div>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class='nav side-menu'>
  								<li><a href="<?php echo site_url('PrincipalParametros/parametros'); ?>"> <i class="fa fa-home"></i> INICIO<span class=""></span></a></li>
  								<?php
  									$openTag=false;
  									$arrayMenu=$this->session->userdata('menuUsuario');
  									for($i=0;$i<count($arrayMenu);$i++){
  									if($arrayMenu[$i]['id_modulo']=='P'){
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
            <div class="sidebar-footer hidden-small">
            </div>
          </div>
        </div>
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle" style="position: relative;">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                  <div id="navtittle"  >
                  <span style="position: absolute;top: 14px;left: 50px; width: 700px; font-size: 20px; text-shadow: 1px 1px 1px rgba(0,0,0,0.3);">Mantenimiento de Parámetros Generales</span>
                  </div>

                  <div id="navtittlemin">
                  <span style="position: absolute;top: 14px;left: 50px; width: 700px; font-size: 20px; text-shadow: 1px 1px 1px rgba(0,0,0,0.3);">Mantenimiento</span></div>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>assets/images/img.jpg" alt=""><?php echo $this->session->userdata('nombreUsuario')?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="#"> <?php echo $this->session->userdata('desc_usuario_tipo')?></a></li>
                    <li><a href="javascript:;"><?= $this->session->userdata('nombrePersona');?></a></li>
                    <li><a href="#" onclick="paginaAjaxDialogo('modalCambio', 'Cambiar Contraseña',null, base_url+'index.php/usuario/cambiarContrasenia', 'GET', null, null, false, true);return false;"><i class="fa fa-lock pull-right"></i> Cambiar Contraseña</a></li>
                    <li><a href="<?php echo base_url("index.php/Login/logout");?>"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a></li>
                  </ul>
                </li>
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false"><?=$this->session->userdata('UnidadEjecutora')?>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
