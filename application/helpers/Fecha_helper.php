<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('fecha_mssql'))
{
	function fecha_mssql() {   
		$t = explode(" ",microtime());
		return date("d-m-Y H:i:s",$t[1]).substr((string)$t[0],1,4);

    }
}






