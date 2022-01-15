<!doctype html>
<html lang="en">
<style>
    img{
        -webkit-filter: grayscale(0%);
        filter: grayscale(0%);
    }
</style>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>GESPROOB</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logoUniq.ico">
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/templateLogin/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/templateLogin/material-dashboard.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/templateLogin/demo.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
   
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <a class="navbar-toggle" href=""><!--<img style="display: inline-block; height: 50px; width: 100px; " src="<?php echo base_url(); ?>assets/images/logoUniq.png" class="img-responsive">--> SISTEMA DE GESTIÓN DE PROYECTOS... <span style="font-size: 12px;"></span></a>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <div>
            <a class="navbar-brand" href=""><!--<img style="display: inline-block; height: 150px; width: 360px; " src="<?php echo base_url(); ?>assets/images/logoUniq.png" class="img-responsive">--> SISTEMA DE GESTIÓN DE PROYECTOS... <span style="font-size: 12px;"></span></a>
               </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="">
                           <i class="fa fa-th-large"> </i> Inicio
                        </a>
                    </li>
                    <li class=" active ">
                        <a href="">
                           <i class="fa fa-sign-in"> </i>  Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper wrapper-full-page"> 
        <div class="full-page login-page"  data-image="<?php echo base_url(); ?>assets/Img/fondoUniq.jpg">
        <!--<div class="full-page login-page">-->

            <div class="content">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form  action="<?php echo base_url("index.php/Login/ingresar");?>" method="post">
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="blue">
                                        <h4 class="card-title">GESPROOB</h4>
                                    </div>
                                    <p class="category text-center">
                                        Iniciar Sesión
                                    </p>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Ingrese Usuario</label>
                                                <input type="text" autocomplete="off" class="form-control" name="txtUsuario" id="txtUsuario">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Ingrese Contraseña</label>
                                                <input type="password" class="form-control"  name="txtPassword" id="txtPassword">
                                            </div>
                                        </div>
                                        <!-- CAPTCHA -->
                                        <!-- <div class="input-group">
                                            <span class="input-group-addon">
                                            </span>
                                            <div class="form-group label-floating">
                                              <div
                                              class="g-recaptcha"
                                              data-sitekey="6LcA-jkUAAAAANxuEr-2Wc-ZkUM3bNefbgpd7PBe"
                                              data-callback="YourOnSubmitFn">
                                              </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Ingresar</button>
                                    </div>
                                    <div class="notificacion" style="padding: 5px 20px;">
                                        <?php $sessionTempError=$this->session->flashdata('error');
                                        if($sessionTempError){ ?>
                                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right: 20px;"><span aria-hidden="true">×</span>
                                            </button>
                                            <strong>Error: </strong><?=$sessionTempError?>
                                        </div>
                                        <?php } ?>
                                    </div>


                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
                <nav class="pull-right">
                        <div><img style="display: inline-block; height: 150px; width: 150px; margin-right: 20px;" src="<?php echo base_url(); ?>assets/images/logoUniq.png" class="img-responsive"></div>
                        </nav>
            </div>
            <footer class="footer">
                <div class="container">
                    <!--<nav class="pull-left">
                        <div>Sistema Integrado de Gestión de Inversiones</div>
                    </nav>-->
                    
                </div>
            </footer>
        </div>
    </div>
</body>

<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=onload&hl=es" async defer></script>

<script src="<?php echo base_url(); ?>assets/templateLogin/js/core/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/templateLogin/js/core/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/templateLogin/js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/templateLogin/js/core/material.min.js"></script>
<script src="<?php echo base_url(); ?>assets/templateLogin/js/core/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/templateLogin/js/plugins/jquery.tagsinput.js"></script>
<script src="<?php echo base_url(); ?>assets/templateLogin/js/material-dashboard-angular.js"></script>
<script src="<?php echo base_url(); ?>assets/templateLogin/js/init/initMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/templateLogin/js/demo.js"></script>
<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>

</html>
