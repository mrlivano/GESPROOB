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
    .main-footer
    {
      background: #0c2528;
      padding: 15px;
      color: #fff;
      border-top: 1px solid #d2d6de;
    }
    .box
    {
      background-color: #ecf0f5;
    }
    .TituloListaFooter
    {
      text-shadow: 1px 1px 2px rgba(0,0,0,0.7);
      font-size: 14px;
      color: white;
      padding-left: 20px;
    }
    .tituloHeader
    {
      display: inline-block;
      text-align: middle;
      padding-top: 25px;
      color: white;
      font-size: 15px;

    }
    .tituloLogo
    {
      padding-top: 25px;

    }
    .navbar-header
    {
      height: 70px;
    }
    .skin-blue .main-header .navbar {
        background-color: #0c2528;
    }
    .box.box-info
    {
        border-top-color: #fff;
    }
    .inner
    {
        height: 120px;
    }
    .thebox{
        color:white;
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
        user-select : none;
        box-shadow: 0px 5px 5px 0px rgba(0,0,0,0.2);

    }
    .zoom-in{
        padding-top: 30px;
    }
    .thebox:hover {
        transform: scale(1.125);
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }
    .box-container{
        padding-top: 10px;
        padding-bottom: 50px;
    }
    .Menu>li>a:hover
    {
      background-color: #5c94a0;
      color: white;

    }


    .subMenu >li>a:hover{
      background-color: #35495d;
      color:white;
    }
    .subMenu{
      box-shadow: 0px 5px 10px 0px rgba(0,0,0,0.2);
      margin: 0px 0 0;
    }
    .content-wrapper
    {
      background-color: #f7f7f7;
    }
    .skin-blue .main-header .navbar .nav>li>a {
        color: black;
    }
    .dropdown:hover
    {
      background-color: #5c94a0;

    }
    .dropdown:hover .dropdown-menu
    {
      display: block;
    }
    .btnDesplegable {
      padding: 3px 4px;
    }
    @media (max-width: 770px) {
      .tituloHeader{
        display: none;
      }
    }
  </style>
  <script src="<?php echo base_url(); ?>assets/Template/vendors/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/Helper/jsHelper.js"></script>
  
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
          <a href="<?php echo site_url('Inicio'); ?>" >
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
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav Menu">
              <li class="dropdown">
                <a href="" target="_blank" class="dropdown-toggle" >Guía de Usuario<span class="caret"></span></a>
                  <ul class="dropdown-menu subMenu " role="menu">
                      <li><a href="3" target="_blank">Mantenimiento de Parámetros</a></li>
                      <li><a href="" target="_blank">PMI</a></li>
                      <li><a href="" target="_blank">Formulación y Evaluación</a></li>
                      <li><a href="" target="_blank">Ejecución</a></li>
                      <li><a href="" target="_blank">Seguimiento</a></li>

                      <li><a href="" target="_blank">Monitoreo</a></li>
                      <li><a href="" target="_blank">Reportes</a></li>
                      <li><a href="" target="_blank">Control de Usuarios</a></li>
                  </ul>
              </li>
            </ul>
          </div>
          <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>assets/images/img.jpg" class="user-image" alt="User Image"/>
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"> <?php echo $this->session->userdata('nombreUsuario')?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <!--<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                  <img src="<?php echo base_url(); ?>assets/images/img.jpg" class="img-circle" alt="Profile Image" />

                  <p>
                    <?php echo $this->session->userdata('nombreUsuario')?> <br> <?php echo $this->session->userdata('desc_usuario_tipo')?>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" onclick="paginaAjaxDialogo('modalCambio', 'Cambiar Contraseña',null, base_url+'index.php/usuario/cambiarContrasenia', 'GET', null, null, false, true);return false;" class="btn btn-default btn-flat btnDesplegable">Cambiar Contraseña</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url("index.php/Login/logout");?>" class="btn btn-default btn-flat btnDesplegable">Cerrar Sesion</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>

      </div>

    </nav>
  </header>
  <div class="content-wrapper">
    <div class="container">
      <section class="content" style="margin-top: 50px;">
      <div class="row box-container">

         <?php foreach ($resp as $value): ?>
          <?php if($value->id_modulo=='HOME') { ?>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                         <div class="zoom-in">
                         
                             <a href="<?php echo site_url($value->url); ?>">
                             <div style="background-color: <?php echo $value->color; ?>;" class="col-md-12 thebox">
                                 <div class="span 6">
                                  <img style="display: inline; height: 70px; width: 70px; margin-bottom: 5px" src="<?php echo base_url(); ?>assets/images/icondig/<?php echo $value->class_icono; ?>" class="img-responsive">
                                     <!--<span class="<?php echo $value->class_icono; ?>"></span>-->
                                 </div>
                                 <div class="span 6">
                                     <?php echo $value->nombre; ?>
                                 </div>

                             </div>
                             </a>
      
                         </div>
                     </div>
          <?php } ?>
        <?php endforeach; ?>

      </div>
    </section>

    </div>
  </div>
  <footer class="main-footer">
    <div class="container">
      <div class="row">
      <h3>Universidad Nacional Intercultural de Quillabamba</h3>
      <hr>
        <div class="col-lg-4 col-sm-6" >
            
              
              <div class="row2"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAQAAABpN6lAAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfhCxYFCDD7pSOaAAAD8ElEQVR42u3cv0pcQRTH8bNLIIlNCtnVJuADpM0L+Jf0voHYBazyFGnzGPbpAla24l/SCXaBgCn8h8UvjTG73pm5c2bO7Ll39vwqBZH5fghZ9d67RDabzWaz2Ww2m81ms9lsc7YBEd7QNn3QPojCTml/cD/AR/pOi9pnUdpv+jSkvbnNJ1qkvQHu6bX2ORT3MAC0z6C7ofYBtPdq4uMr+vX88R19oz/ahxPcO/pMb58/G9P754/xfz8xuWOMtE8tNYxwPNU2UToJcI7HqS87qYMAI5xMdT3i3A1whO36CBz52zjyABDVRuDKJwoA1EXgzm8BqIfAl98KUAeBPz8CoP8EofwogH4ThPMjAfpL0JYfDdBPgvZ8BkD/CGLyWQAOgtPuEmCE0/Z8JoCTYKyd6jznOC6fDdAPgvj8BIDuE3DykwC6TcDLTwToLgE3PxmgmwT8/AyA7hGk5GcBdIsgLT8ToDsEqfnZAN0gSM8XAHAQnM2WAGOcpeaLAOgS5OULAegR5OaLAegQ5OcLAsyeQCJfFGC2BDL5wgBOgqUi+Usy+eIAsyGQyy8AUJ5AMr8IQFkC2fxCAOUIpPOLAZQhkM8vCOAgOM8jwNLk3Rwy+UUBZAnK5BcGIMKuDIEjf1fohEX/BazgEof5BI78Q1xipeMAWMElAOQSOPMByBCUexX4l59J4M0XIij1c8BkPgAcpBE48g+mPs8mKPOT4Mv8O2ylvCK4/ufHFu4kCUr8LuDIJ+K/KPpe+GQJ5H8b9OR7CJa932fZ/7ovSSD994BAPocglC9LIPsXoZZ8J8FFkwDLuAjlSxJI/k0wIj+GICZfjkDur8LN/E3v1wYIYvOJiLCZTyB1XYCRHyLg5MsQyFwZYub7CLj5EgQS1wYT8j0E7Px8gvyrw4n5ToKE/FyC3PsDMvKDBNxLnMkEeXeIZOZ7CVKu8SUS5Nwj1Mzf4B7bSZB6kWsjhSD9LjGh/AZBzlWeBILU+wQF858IrgEA15mXOdgEaXeKCucTEWEBO9jBQvb3YRKk3CtcIF9yPAL+3eIv82+7lf9EcBtLwH1eoAf5PALeEyPN/HXtVC/BehwB55mhHuXHE8Q/Ndaz/FiC2OcGe5gfRxD35GhP82MIYp4d7nF+O0H70+PN/DXtJDbBmp+g7f0DKsgPE4TfQaKS/BBB6D1EKsr3E3gBasv3EfgArurL9xBcuQFQY76TAO0At1jVPrYowaqPgOYhP0RA85HvJ2gC3NSZ/0Rw0wZQcb6b4OVban6lH9qHLLxV+jL5qb2nqPYBtDekB+0jqO5hSPvaZ1Dd/ty/tfbcv7m69iFsNpvNZrPZbDabzWaz2Wa+vwSspX6UOUofAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE3LTExLTIyVDA1OjA4OjQ4KzAxOjAw/1i7KgAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxNy0xMS0yMlQwNTowODo0OCswMTowMI4FA5YAAAAZdEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC" alt="contact" style="width: 25px; height: 25px;"><span>info@uniq.edu.pe</span></div>
              <div class="row2"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAQAAABpN6lAAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfhCxYFCDD7pSOaAAAD8ElEQVR42u3cv0pcQRTH8bNLIIlNCtnVJuADpM0L+Jf0voHYBazyFGnzGPbpAla24l/SCXaBgCn8h8UvjTG73pm5c2bO7Ll39vwqBZH5fghZ9d67RDabzWaz2Ww2m81ms9lsc7YBEd7QNn3QPojCTml/cD/AR/pOi9pnUdpv+jSkvbnNJ1qkvQHu6bX2ORT3MAC0z6C7ofYBtPdq4uMr+vX88R19oz/ahxPcO/pMb58/G9P754/xfz8xuWOMtE8tNYxwPNU2UToJcI7HqS87qYMAI5xMdT3i3A1whO36CBz52zjyABDVRuDKJwoA1EXgzm8BqIfAl98KUAeBPz8CoP8EofwogH4ThPMjAfpL0JYfDdBPgvZ8BkD/CGLyWQAOgtPuEmCE0/Z8JoCTYKyd6jznOC6fDdAPgvj8BIDuE3DykwC6TcDLTwToLgE3PxmgmwT8/AyA7hGk5GcBdIsgLT8ToDsEqfnZAN0gSM8XAHAQnM2WAGOcpeaLAOgS5OULAegR5OaLAegQ5OcLAsyeQCJfFGC2BDL5wgBOgqUi+Usy+eIAsyGQyy8AUJ5AMr8IQFkC2fxCAOUIpPOLAZQhkM8vCOAgOM8jwNLk3Rwy+UUBZAnK5BcGIMKuDIEjf1fohEX/BazgEof5BI78Q1xipeMAWMElAOQSOPMByBCUexX4l59J4M0XIij1c8BkPgAcpBE48g+mPs8mKPOT4Mv8O2ylvCK4/ufHFu4kCUr8LuDIJ+K/KPpe+GQJ5H8b9OR7CJa932fZ/7ovSSD994BAPocglC9LIPsXoZZ8J8FFkwDLuAjlSxJI/k0wIj+GICZfjkDur8LN/E3v1wYIYvOJiLCZTyB1XYCRHyLg5MsQyFwZYub7CLj5EgQS1wYT8j0E7Px8gvyrw4n5ToKE/FyC3PsDMvKDBNxLnMkEeXeIZOZ7CVKu8SUS5Nwj1Mzf4B7bSZB6kWsjhSD9LjGh/AZBzlWeBILU+wQF858IrgEA15mXOdgEaXeKCucTEWEBO9jBQvb3YRKk3CtcIF9yPAL+3eIv82+7lf9EcBtLwH1eoAf5PALeEyPN/HXtVC/BehwB55mhHuXHE8Q/Ndaz/FiC2OcGe5gfRxD35GhP82MIYp4d7nF+O0H70+PN/DXtJDbBmp+g7f0DKsgPE4TfQaKS/BBB6D1EKsr3E3gBasv3EfgArurL9xBcuQFQY76TAO0At1jVPrYowaqPgOYhP0RA85HvJ2gC3NSZ/0Rw0wZQcb6b4OVban6lH9qHLLxV+jL5qb2nqPYBtDekB+0jqO5hSPvaZ1Dd/ty/tfbcv7m69iFsNpvNZrPZbDabzWaz2Wa+vwSspX6UOUofAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE3LTExLTIyVDA1OjA4OjQ4KzAxOjAw/1i7KgAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxNy0xMS0yMlQwNTowODo0OCswMTowMI4FA5YAAAAZdEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAAAElFTkSuQmCC" alt="contact" style="width: 25px; height: 25px;"><span> tramitedocumentario@uniq.edu.pe</span></div>
              <div class="row2"><img src="<?php echo base_url(); ?>assets/images/telefono.64afadad.png" alt="telefono" style="width: 25px; height: 25px;"><span>084 - 282728</span></div>
              <div class="row2"><img src="<?php echo base_url(); ?>assets/images/ubicacion.72fbb70f.png" alt="ubicacion" style="width: 25px; height: 25px;"><span>El Arenal S/N - Quillabamba</span></div>
              <div class="row2"><img src="<?php echo base_url(); ?>assets/images/directorio.8148dfca.png" alt="directorio" style="width: 25px; height: 25px;"><a class="referencia" href="http://www.uniq.edu.pe/directorioelectronico" target="_bank"><span>Directorio Electrónico</span></a></div>
              <div class="row2"><img src="<?php echo base_url(); ?>assets/images/institucional.afd8f7ee.png" alt="institucional" style="width: 25px; height: 25px;"><a class="referencia" target="_bank" href="http://accounts.google.com/signin/v2/identifier?continue=http%3A%2F%2Fmail.google.com%2Fmail%2F&amp;service=mail&amp;hd=uniq.edu.pe&amp;sacu=1&amp;flowName=GlifWebSignIn&amp;flowEntry=AddSession"><span>Correo Institucional</span></a></div>
            
        </div>

        <div class="col-lg-4 col-sm-6">
            <h4>Redes sociales</h4>
            <div class="row">
            <img src="data:image/png;base64,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" alt="facebook" style="width: 25px; height: 25px;">
            <a class="referencia" target="_bank" href="http://www.facebook.com/uniqquillabamba"><label>Siguenos en Facebook</label></a></div>
            <div class="row">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAACXBIWXMAAAsSAAALEgHS3X78AAAEf0lEQVR4nO3d4XETSRCG4Z6t+38mAkQGEIFRBEAEoAgOIjCOAIjAEAHOQCICnIGVwckR9FXv9YhBWq9X8mLY6ff54ypwle3pT7OzszOzAgAAAAAAAAAAAAAAAACoRXrov0NVZyIyI0GdNimlq4f8gaMFoCjscxH5W0Se+n/Z15Oxfk4wGxHJgbCvNyKyEpF1Smk9RlMcHQBVtcK+FJFTivzbWBi+2deU0uqYX+KgAHjR//HCU/A/i/UWlyLy6ZDLyKAAqKp162fevePPZ73B+ZBeoTcAqmqf8gv/xGN6rEdYpJQ2BwfAu/slXf3kWfHnt10Wmq5/VNU3IvKd4lfBarj0D/SevR7Ar/fL6K1Woc6e4KcA+DX/mk9+tWzu4Fk5Jti9BFxQ/KrN/G5ua9sD0PWH8iTPJJY9wFn0VglkW+u2B/B5/OvorRKIPXR6JEUPwERPLCeq2tY8B+BF9BYJqK15vgRo9NYIyB4pP2l89I94Zjbv0xQLNxDP04aJn9CeN76iB0F1Pg1EGKdcAoJjEBhcYg4gNsYAwRGA4P6q7M9f+0rYG9+d9IZBbr+axgCfReRdudzJl7i99c0sBKFDLQHYW+tW8iCceRhQqGUMcNm7+SElWwDxzpZCeU8BV0sAboZ8k62DSyktCMIPIe8CCMIPoW8DiyDMfUNlOMwD/B8E218/jxgEAlCIGAQC0KEIwiu/xawWAeiRUrLbSxsoLmoNAgEYIKX0udYgEIAD7ATh1omnKSEAR7Ag+BzC+dSDQACO5NPL76ceBAJwT0UQnk1xfEAARuL77RdT+70JwIj8XL4HPev3vgjA+CY1FiAA45vUMnsCMCJVfTu1pWcEYCRe/A9T+70JwD3Zqaqqej3F4kuFy8IfTC0nqBOAA9V2dD4BGKjWdyYQgDv4GYpnvsuoOgTgFrUXPiMAO3wX0YfaC58RABd1H2H4AETfQBo6AKr6PvrO4ZAB8Hci2QAv/CtsawnA4yHfROH31XI+wMbPB+hckuWTOBcUfl8tD4PsGv5199VoVnhVXfqrcCh+hxqPibvyHuGEMxDvlvxRJp+OmNZN7Zsf0WvNgpDgmqktY8aorpqhByyhSjdN1LNx0LpiEBjbOr827l+OUo0npZTyXQCXgXjamucAfIveGgG1Nc8BuIzeGgG1PUDKf7eqfmfuPIy9t4ebL9FbJZBtj1/2AHYXcM3dQAi2dqKdAd72AH7e/qfoLRPAKhdfyh5A6AWimPtRNq2fngZ6L3AevYUqtiqLL7s9QKaqX0XkZfTWqkznusnb1gMseExcnUXXotnOAPilYE4IqmHF75zs67wEZD4oXDJBNGkLP9u4U++SMD8G1Y5A/Ri9FSfIevFXfcWXofsC/J17YV+sNEErH/Dd+Yyn9xLQxbdXva7tqJRKWOHPd2/1+hwcgMx34bz220X2Ffw+G5/b/3JI4bOjA1DyMFgQTn3AyEzir7Xy5/l7EzuHGiUAu/x8nVlxmTj1r2zXGqYsal6ss/LHuNyaAwAAAAAAAAAAAAAAAOgiIv8Byw1WHGYMtH4AAAAASUVORK5CYII=" alt="youtube" style="width: 25px; height: 25px;">
            <label>Siguenos en Youtube</label></div><div class="row"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAACXBIWXMAAAsSAAALEgHS3X78AAAF0klEQVR4nO2d71XjOhDFpZz3ffM6yFbAUgG8ChYqADqACna3guVVEKgAtgJCBdDB5lWQdDB7lDc2JsT5Y0sj2/f+zsknQixrrmckWZrxLgIicuqcC58T59xEPyQ+c/08O+dm3vtZ2ys0FoAa/cI5d+acG9PYWVg65x6dc/dNxXCwANTw3/SJJ90hCODHoULYWwAiEtz6T33iSXcJHuHGez+PJgARCUaf0tX3hhAarrz3j7saPNr1BREJT/0Djd8rgq0e1HZb2eoBRCQ89Zfovdlz7rz3V3W3UCsAGn9Q1IpgYwhQ10HjD4fLunDwwQPogO8BvccGyvn6wPCdAHSq98IB32AJs4Pj6hRxPQT8pPEHzVhtXFJ6AF3he0LvIRD+KVYMqx7gG3qvAFHaeiWAyts8gsGp2rz0ABc0PBwrm6/GACKy4OAPjqX3/u+RugIaH49xsP2IsR+alQBO0HsBmJMR9+9BM/EiIui9gMzODSFk2FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4FAA4PzV4dt/1aRGBeEE85e8TdqbIq17lU4ewu2SAOaV1OevdV/S4+xfNWl1V841Fmnbf23LzysiX1QIF50Rs+TnpUhX0qDtIQHi74x3sBCRaxE5OL9CuGcRecrd+7kF8L2J4Td05vcMbX9oYvgNbT9TIWUhlwAW6g6jYdyRUdPohgSd6gnNyXE8fKl56mrjfFNUVE+JU96EPPx3Cdo+1rabjg2sBZDM+AWJE14mMX6BiuDFcnBrvQ5wk9L4Ac2AeZPgp+9SGt/93/bwgJynvMYHDGOOaQbyyCPsRYwB3wFtNxvUWoaAz/sWMopB5FCQ1PWvo2L7bZG+zyoE3Fka372FgtaFFTWhopnx3Vso+NfiWlYC+GV0nXXuI/yGqfGtr2sRAlYpSRNfYyPqShctf+Y49cC1jrA2kHpaaOEBsnSee3Olra6fy/hKcs9pIYBng2tso40BY4wh2pBcfBYCWO7xnZT8l/n6bUjed4MOARHoc9v3wkIAfU5FP/g8yhYC6Msunk0Mvo6ChQA+GVxjG23S4ef2AMkfHgsB5N4L18aIE8t3ABs4Sn0BkxCQqxN1f0Dbp/gsUnOakPzhsVoKztWJMaqhfY3wGwejL7OShyCrt4Fz7/1ng+u8I2I1NNM3mc6wfL+VB5jE3ke3C91wGiv0mFZV1dBl0l+W+wHm+mIl+epWoiroZb3d1ITNLFaDZ8stYZP1ytUJmSaYw08tBrPquexmTlZbjypcJ76facK2J62urgddTMl1LiBJfEts/IIkniCH8SXzyaBpxM4b60kdK150nBGr/de5jJD7aFjjc4GVzjvNdD5w0Tac6YmgrOcDu3A4VLQTDhKCHgXLfrhSxXd5SFgI0zyjcLWTrlUOnesunOfijH1YgNF5cZEf4EhXFrv2pm5Zafur7oV81VBRfI46dqzd/GgY6RhMEQMOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQAOBQDOaEONW4LDnALAZiWA3Pn8ST6eRx0oikDyMfMubkJF0h9WtZyKWUBtzXsyWFY2LwQQo7wa6Rf3pQAiFlkk/WBWZD2tLgT9oPFgKG1dCkAVwbHA8Hms5jz21dtNlGSZdIelJuwuF//evQvQP1zRYIPlar3uwYeXQd77EAZu0XtqgNyqbd/h6+7TqmIFMSGU79/o2WsF4CiCoVBrfLdrP4D+I8NBf7ndZny3ywMUhMTMiapwkDQsdcC3c1q/144g/aFjrhP0gked6u1lq723hIXpg/f+PBRP4rJxJ5lpYavzQ0rc7RUCNqH5/S86mrodhaU+8fdNK5o1FkAVFcOpFmqeIJRdz8SqhoLu4ipf6DTGOfcHRJQ679DwbOoAAAAASUVORK5CYII=" alt="photos" style="width: 25px; height: 25px;">
            <a class="referencia" target="_bank" href="http://www.flickr.com/photos/155194300@N05/albums"><label>Siguenos en Flicker</label></a></div>
        </div>

        <div class="col-lg-4 col-sm-6">
        <img style="display: inline-block; height: 120px; width: 120px; margin-right: 20px;" src="<?php echo base_url(); ?>assets/images/logoUniq.png" class="img-responsive">
        </div>
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
