<!--home-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GESPRO</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logoUniq.ico">
  <!-- <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/sigei.png"> -->
  <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!--<link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->

  <link href="<?php echo base_url(); ?>assets/adminlte/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>assets/adminlte/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/adminlte/AdminLTE.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/adminlte/_all-skins.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/formValidation.min.css">
  <link href="<?php echo base_url(); ?>assets/css/jquery.growl.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/js/sweetalert.css">
  <style>
    /*.skin-blue .main-header li.user-header {
      background-color: #2a3f54;
    }*/
    .main-footer {
      background: #0c2528;
      padding: 15px;
      color: #fff;
      border-top: 1px solid #d2d6de;
    }

    .box {
      background-color: #ecf0f5;
    }

    .TituloListaFooter {
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
      font-size: 14px;
      color: white;
      padding-left: 20px;
    }

    .tituloHeader {
      display: inline-block;
      text-align: middle;
      padding-top: 25px;
      color: white;
      font-size: 15px;

    }

    .tituloLogo {
      padding-top: 25px;

    }

    .navbar-header {
      height: 70px;
    }

    .skin-blue .main-header .navbar {
      background-color: #0c2528;
    }

    .box.box-info {
      border-top-color: #fff;
    }

    .inner {
      height: 120px;
    }

    .thebox {
      color: white;
      cursor: pointer;
      height: 150px;
      padding: 20px;
      width: auto;
      text-align: center;
      -webkit-transition: transform 0.3s;
      -moz-transition: transform 0.3s;
      -ms-transition: transform 0.3s;
      -o-transition: transform 0.3s;
      transition: transform 0.4s;
      user-select: none;

    }

    .zoom-in {
      padding-top: 30px;
    }

    .thebox:hover {
      transform: scale(1.125);
      
    }

    .box-container {
      padding-top: 10px;
      padding-bottom: 50px;
    }

    .Menu>li>a:hover {
      background-color: #5c94a0;
      color: white;

    }


    .subMenu>li>a:hover {
      background-color: #35495d;
      color: white;
    }

    .subMenu {
      box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.2);
      margin: 0px 0 0;
    }

    .content-wrapper {
      background-color: #f7f7f7;
    }

    .skin-blue .main-header .navbar .nav>li>a {
      color: black;
    }

    .dropdown:hover {
      background-color: #5c94a0;

    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    .btnDesplegable {
      padding: 3px 4px;
    }

    @media (max-width: 770px) {
      .tituloHeader {
        display: none;
      }
    }





    .wrapper1 {
      width: 100%;
      margin: 2em auto;
      background: #3D464E;
      clear: both;
      overflow: hidden;
    }



    .ul1 li {
      border-right: 1px solid #3D464E;
      cursor: pointer;
      float: left;
      overflow: hidden;
      height: 177px;
      list-style: none;
      position: relative;
      width: 72px;
      transition: all 0.5s ease;
      -webkit-transition: all 0.5s ease;
      background: #fff;
    }


    .ul1 li:hover a {
      background-position: right top;
    }

    .ul1 li:hover {
      width: 350px;
    }

    .p1 {
      color: #5F5F5F;
      font-size: 15px;
      letter-spacing: 0;
      line-height: 18px;
      padding-top: 40px;
      width: 225px;
      margin: 0px 7em;
    }


    @import url("https://fonts.googleapis.com/css?family=Sunflower:300,500,700");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      line-height: 1.5;
    }

    body {
      background: #1c1c1c;
    }

    .custom-accordion {
      background: #376970;
      color: #ffffff;
      font-family: "Sunflower", sans-serif;
      padding-bottom: 2rem;
    }

    .custom-accordion>.item {
      padding: 1rem 2rem;
      margin: 0 auto;
      max-width: 30rem;
    }

    .custom-accordion>.item:last-of-type {
      background: #462521;
      text-align: center;
      border-radius: 0.5rem;
    }

    .custom-accordion>.item:last-of-type>.icon {
      color: #ffffff;
    }

    .custom-accordion>.item:nth-of-type(6) {
      padding-bottom: 2rem;
    }

    .custom-accordion>.item>.icon {
      color: #462521;
      font-size: 2rem;
    }

    .custom-accordion>.item>.title {
      font-size: 1.5rem;
    }

    @media screen and (min-width: 800px) and (min-height: 270px) {
      .custom-accordion {
        display: table;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        height: 65vh;
        max-height: 1000px;
        overflow: hidden;
        padding-bottom: 0;
      }

      .custom-accordion>.item {
        display: table-cell;
        position: relative;
        height: 100%;
        padding: 2rem 1rem;
        text-align: center;
        transform-origin: 0 50%;
        transition: all 0.3s cubic-bezier(0.8, 0.16, 0.42, 0.89);
      }

      .custom-accordion>.item:hover:not(:last-of-type) {
        transform: scaleX(1.5) translateX(-1px);
        box-shadow: 0 0 3rem #301916;
        background: #8a6552;
        border-color: transparent;
      }

      .custom-accordion>.item:hover+.item {
        opacity: 0.1;
      }

      .custom-accordion>.item:hover+.item:last-of-type {
        opacity: 0.1;
        background: #8a6552;
      }

      .custom-accordion>.item:not(:last-of-type) {
        border-right: 1px solid #462521;
      }

      .custom-accordion>.item:last-of-type {
        background: #462521;
        width: 25%;
        border-radius: 0;
      }

      .custom-accordion>.item:last-of-type .heart-icon {
        font-size: 6rem;
      }

      .custom-accordion>.item:hover:last-of-type .heart-icon {
        transform: scale(2);
      }

      .custom-accordion>.item:last-of-type>.title {
        transform: rotate(0) translateX(-50%) translateY(-2.5rem);
        padding: 0;
        text-align: center;
      }

      .custom-accordion>.item:last-of-type>a>.content {
        opacity: 1;
        transform: translateX(-50%) translateY(-50%);
      }

      .custom-accordion>.item:hover:not(:last-of-type)>.icon {
        transform: scaleX(0.5);
      }

      .custom-accordion>.item:hover:not(:last-of-type)>.title {
        transform: scaleX(0.5) translateX(-50%);
        background: #ca2e55;
        text-align: center;
        padding: 0;
      }

      .custom-accordion>.item:hover:not(:last-of-type)>.title>.text {
        transform: translateX(-50%);
        left: 50%;
      }

      .custom-accordion>.item:hover:not(:last-of-type)>a>.content {
        opacity: 1;
      }

      .custom-accordion>.item>.icon {
        font-weight: 700;
        font-size: 2rem;
        transition: all 0.3s cubic-bezier(0.8, 0.16, 0.42, 0.89);
        color: #ffffff;
      }

      .custom-accordion>.item>.title {
        position: absolute;
        bottom: 0;
        left: 50%;
        height: 1.5rem;
        width: 200%;
        text-align: left;
        transform-origin: 0 50%;
        transform: rotate(-90deg);
        transition: all 0.3s cubic-bezier(0.8, 0.16, 0.42, 0.89);
        font-size: 1.2rem;
      }

      .custom-accordion>.item>.title>.text {
        position: absolute;
        left: 2rem;
        bottom: 0;
        white-space: nowrap;
        transition: all 0.3s cubic-bezier(0.8, 0.16, 0.42, 0.89);
      }

      .custom-accordion>.item>a>.content {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200%;
        height: auto;
        transform: translateX(-10%) translateY(-10%) scaleX(0.01);
        transition: all 0.3s cubic-bezier(0.8, 0.16, 0.42, 0.89);
        opacity: 0;
        padding: 1rem;
        pointer-events: none;
      }
    }

    .heart-icon {
      color: #ca2e55;
      font-size: 3rem;
      transition: all 0.3s cubic-bezier(0.8, 0.16, 0.42, 0.89);
    }
  </style>
  <script src="<?php echo base_url(); ?>assets/Template/vendors/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/Helper/jsHelper.js"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122307432-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-122307432-1');
  </script>

  <script>
    var base_url = '<?php echo base_url(); ?>';
  </script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header" style="padding-top: 13px;">
            <a href="<?php echo site_url('Inicio'); ?>">
              SISTEMA DE GESTIÓN DE PROYECTOS...
              <!--<img style="display: inline-block; height: 50px; width: 185px; opacity: 1;" src="<?php echo base_url(); ?>assets/images/logoUniq.png" class="img-responsive">-->
            </a>
          </div>
          <div class="navbar-custom-menu">
            <span class="tituloHeader">Sistema de Gestión de Proyectos</span><br>
          </div>
        </div>

      </nav>
      <nav class="navbar navbar-static-top" style="background-color: #ededed;">
        <div class="container">
          <div class="navbar-header" style="height: 0px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/images/img.jpg" class="user-image" alt="User Image" />
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"> <?php echo $this->session->userdata('nombreUsuario') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <!--<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                    <img src="<?php echo base_url(); ?>assets/images/img.jpg" class="img-circle" alt="Profile Image" />

                    <p>
                      <?php echo $this->session->userdata('nombreUsuario') ?> <br> <?php echo $this->session->userdata('desc_usuario_tipo') ?>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" onclick="paginaAjaxDialogo('modalCambio', 'Cambiar Contraseña',null, base_url+'index.php/usuario/cambiarContrasenia', 'GET', null, null, false, true);return false;" class="btn btn-default btn-flat btnDesplegable">Cambiar Contraseña</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url("index.php/Login/logout"); ?>" class="btn btn-default btn-flat btnDesplegable">Cerrar Sesion</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

        </div>

      </nav>
    </header>

    <div class="custom-accordion">
      <?php foreach ($resp as $value) : ?>
        <?php if ($value->id_modulo == 'HOME') { ?>
          <div class="item">
            <div class="icon"></div>
            
            <a class="" href="<?php echo site_url($value->url); ?>">
            <div class="content">
            
                <div class="zoom-in">

                
                    <div class="col-md-12 thebox">
                      <div class="span 6">
                        <img style="display: inline; height: 70px; width: 70px; margin-bottom: 5px" src="<?php echo base_url(); ?>assets/images/icondig/<?php echo $value->class_icono; ?>" class="img-responsive">
                        <!--<span class="<?php echo $value->class_icono; ?>"></span>-->
                      </div>
                      
                      <div class="span 6">
                        <?php echo $value->nombre; ?>
                      </div>

                    </div>
                  

                </div>
                </a>
            </div>
            
          </div>

        <?php } ?>
      <?php endforeach; ?>
      <div class="item">
        <div class="icon"></div>
        <div class="title"></div>
        <div class="content">
            <div class="heart-icon"></div>
        </div>
    </div>
    </div>

    <footer class="main-footer">
      <div class="container">
        <div class="row">
          <span>Universidad Nacional Intercultural de Quillabamba</span>
        </div>
        <div class="pull-right hidden-xs">
        </div>
      </div>
    </footer>
  </div>

  <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/formValidation.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.validation.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/jquery.slimscroll.min.js"> </script>
  <script src="<?php echo base_url(); ?>assets/adminlte/fastclick.min.js"> </script>
  <script src="<?php echo base_url(); ?>assets/adminlte/app.min.js"> </script>
  <script src="<?php echo base_url(); ?>assets/adminlte/demo.js"> </script>
  <script src="<?php echo base_url(); ?>assets/dist/js/sweetalert-dev.js"></script>
</body>

</html>