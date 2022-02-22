<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Repositorio</title>
	<meta name="description" content="">
	<link rel="stylesheet" href="<?php echo base_url();?>assetsfiles/jquery/ui-themes/smoothness/jquery-ui-1.8.18.custom.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assetsfiles/grocery_crud/elfinder/css/elfinder.min.css">
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('application/vendor/studio-42/elfinder/themes/windows-10/css/theme.css'); ?>"> -->
	<link rel="stylesheet" href="<?php echo base_url();?>assetsfiles/grocery_crud/elfinder/css/theme.css">
	<style media="screen">
		#elfinder {
				width: 100% !important;
				height: 100% !important;
				background:rgba(0,0,0,0.1) !important;
				position: fixed !important;
				top: 0 !important;
				left: 0 !important;
				z-index: 100 !important; /* Just to keep it at the very top */
		}
	</style>
	<script src="<?php echo base_url();?>assetsfiles/jquery/jquery-1.7.2.min.js"></script>
	<script src="<?php echo base_url();?>assetsfiles/jquery/jquery-ui-1.8.18.custom.min.js"></script>
	<script src="<?php echo base_url();?>assetsfiles/grocery_crud/elfinder/js/elfinder.smp.min.js"></script>
	<script src="<?php echo base_url();?>assetsfiles/grocery_crud/elfinder/js/i18n/elfinder.es.js"></script>
	<script src="<?php echo base_url();?>assetsfiles/grocery_crud/elfinder/js/i18n/elfinder.it.js"></script>
	<script>
	$().ready(function(){
		var elf = $('#elfinder').elfinder({
			url:'<?php echo base_url("elfiles/elfinder_init?id_et=".$_GET['id_et']); ?>',
			height:460,
			lang: 'es',
		}).elfinder('instance');
	});
	</script>
</head>
<body>
	<div id="elfinder">REPOSITORIO GESPRO</div>
</body>
</html>
