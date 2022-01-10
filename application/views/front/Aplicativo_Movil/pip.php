<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Localización</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/localizacion/favicon.ico">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>assets/adminlte/jquery-2.2.3.min.js"> </script>
  <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>


  <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/ionicons.min.css">

  <link href="<?php echo base_url(); ?>assets/adminlte/AdminLTE.min.css" rel="stylesheet">

  <link href="<?php echo base_url(); ?>assets/adminlte/_all-skins.min.css" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/morris.js/morris.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/jvectormap/jquery-jvectormap.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link href="<?php echo base_url(); ?>assets/adminlte/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/adminlte/jquery.slimscroll.min.js"> </script>
	<script src="<?php echo base_url(); ?>assets/adminlte/fastclick.min.js"> </script>
	<script src="<?php echo base_url(); ?>assets/adminlte/app.min.js"> </script>
	<script src="<?php echo base_url(); ?>assets/adminlte/demo.js"> </script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1uRF6cxgwFc9DGwREFvIE6oorBaWny64&callback=initialize">
  </script>


 <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


  <style>
    .main-footer 
    {
      background: #2b3f4a;
      padding: 15px;
      color: #fff;
      border-top: 1px solid #d2d6de;
    }
    .content-wrapper
    {
      
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
        background-color: #2b3f4a;
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

    }
    .zoom-in{
        padding-top: 30px;
    }
    .thebox:hover {
        transform: scale(1.125);
    }
    .box-container{
        padding-top: 10px;
        padding-bottom: 50px;
    }
    @media (max-width: 770px) {
      .tituloHeader{
        display: none;
      }
    }

   @media (min-width: 1200px){
    .container {
        width: 1350px;
    }
    }
    
    table{
    	font-size:10px;
    	font-family: arial, sans-serif;
    }
    /*table {
	   width: 100%;
	   border: 1px solid #000;
	}
	table tr {background-color: yellow; }*/
  </style>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<script>
var base_url = '<?php echo base_url(); ?>';
</script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header" style="padding-top: 13px;">
          <a href="<?php echo site_url('AplicativoMovil'); ?>" >
            <img id="logoRegion" style="display: inline-block; height: 70px; width: 185px; opacity: 1;margin-top: -15px;" src="<?php echo base_url(); ?>assets/images/gore.png" class="img-responsive">
          </a>
        </div>
        <div class="navbar-custom-menu">
         <span class="tituloHeader">Software de Seguimiento y Monitoreo de PIP's</span><br>
        </div>    
      </div>

    </nav>

  </header>
  <div class="content-wrapper">
    <div class="container">
    <section class="content" style="margin-top: 30px;"> <!-- Main content -->
       <div class="row box-container">
      
		    <div class="col-md-12 col-xs-12">
		   


		    		<div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">PIP Y NO PIP</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">

                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                 

                 	<div class="nav-tabs-custom">
			            <ul class="nav nav-tabs">
			              <li class="active"><a href="#tab_1" data-toggle="tab">Proyecto de Inversión</a></li>


			              <li class="pull-right"><a href="<?php echo site_url('AplicativoMovil'); ?>" class="text-muted"><i class="fa fa-home fa-2x"></i></a></li>
			            </ul>
			            <div class="tab-content">
			              <div class="tab-pane active" id="tab_1">
			                <b></b>

     									<div class="row">
						                <div class="col-md-12 col-sm-12 col-xs-12" >
										<div class="table-responsive" >
                                         <table id="datatable-responsive" class="table table-striped 
                                         dt-responsive nowrap" cellspacing="0" width="100%">
                                          <thead>
                                            <tr>

                                                <th ></th>
                                        		<th>Proyecto de Inversión</th>
                                        		<th>Código</th>
                                                <th>Función</th>
                                                <th>Div Funcional</th>
                                                <th>Grup Funcional</th>
                                                <th>Costo</th>
                                                <th>Num Beneficiarios</th>
                                                <th>Fecha registro</th>
                                               
                                            </tr>
                                          </thead>
                                          <tbody>
                                           	 	<?php foreach($listarpip as $item ){ ?>	
                                                        <tr>
                                                            <td>
                                                            	
                                                            </td>
                                                            <td>
                                                             	 <?=$item->nombre_pi?>
                                                            </td>
                                                             <td>
                                                             	 <?=$item->codigo_unico_pi?>
                                                            </td>
                                                            <td>    
                                                         		<?=$item->nombre_funcion?>
                                                            </td>
                                                            <td>
                                                                <?=$item->nombre_div_funcional?>
                                                            </td>
                                                            <td>
                                                             	 <?=$item->nombre_grup_funcional?>
                                                            </td>
                                                            <td>
                                                             	 <?=$item->costo_pi?>
                                                            </td>

                                                             <td>
                                                             	 <?=$item->num_beneficiarios?>
                                                            </td>
                                                             <td>
                                                             	 <?=$item->fecha_registro_pi?>
                                                            </td>

                                                            </tr>
                                        			    <?php } ?>
                                          </tbody>
                                        </table>

                                        </div>
                                        </div>


						        	</div>





			              </div>
	
			            </div>
			            <!-- /.tab-content -->
			          </div>




                </div>
            
        
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
         
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>


		    </div>

  		</div>

   </div>

      </div>

   
         </div>
     	</div> 
    </section>
    </div>
  </div>
  <footer class="main-footer">
    <div class="container">   
	      <div class="pull-right hidden-xs">
	      </div>

	      <strong>Copyright &copy; 2017-2019 - </strong> Todos los derechos reservados.
    </div>
  </footer>
</div>

<script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Datatables -->

    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script> <!--PARA EL BOTON-->
    <script src="<?php echo base_url(); ?>assets/build/js/custom.min.js"></script>
</body>
</html>


 