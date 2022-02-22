<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GESPRO</title>
    <link href="<?php echo base_url();?>assets/Template/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/Template/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/Template/vendors/nprogress/nprogress.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/Template/build/css/custom.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/Template/vendors/jquery/dist/jquery.min.js"></script>
	<style>
		body{
			color:#ccc;
		}
    @keyframes gjPulse {
    0% {
      width: 90px;
      height: 90px;
    }
    25% {
      width: 105px;
      height: 105px;
    }
    50% {
      width: 130px;
      height: 130px;
    }
    75% {
      width: 110px;
      height: 110px;
    }
    100% {
      width: 90px;
      height: 90px;
    }
  }

  #gj-counter-box {
    margin: auto;
    position: relative;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    opacity: 0.2;
    width: 90px;
    height: 90px;
    background-color: rgb(183, 0, 0);
    border-radius: 50%;
    border: 6px solid white;
    visibility: none;
    display: none;
    animation: gjPulse 1s linear infinite;
  }

  #gj-counter-box:hover {
    opacity: 1;
    cursor: pointer;
  }

  #gj-counter-num {
    position: relative;
    text-align: center;
    margin: 0px;
    padding: 0px;
    top: 50%;
    transform: translate(0%, -50%);
    color: white;
  }
	</style>
</head>
<body class="nav-md">
    <div class="container body">
      	<div class="main_container">
        	<div class="col-md-12">
          		<div class="col-middle">
            		<div class="text-center text-center">
	              		<h1 class="error-number">403</h1>
	              		<h2>Acceso Denegado</h2>
	              		<p>No tiene acceso a esta opción, Comuniquese con el administrador</p>
                    <h1>En carga!</h1>
                    <div id="gj-counter-box">
                      <h1 id="gj-counter-num"></h1>
                    </div>
            		</div>
          		</div>
        	</div>
      	</div>
    </div>
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>
</body>
</html>
<script type="text/javascript">

// FUNCTION CODE
function gjCountAndRedirect(secounds) {

  $('#gj-counter-num').text(secounds);

  $('#gj-counter-box').show();

  var interval = setInterval(function() {

    secounds = secounds - 1;

    $('#gj-counter-num').text(secounds);

    if (secounds == 0) {

      clearInterval(interval);
      history.go(-1);
      $('#gj-counter-box').hide();

    }

  }, 1000);

  $('#gj-counter-box').click(function() {
    clearInterval(interval);
    history.go(-1);

  });
}

// Definir
$(document).ready(function() {
  //call
  gjCountAndRedirect(10);
});
</script>
