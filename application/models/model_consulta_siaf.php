<?php
class model_consulta_siaf extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_reporte()
	{
		$consulta = $this->db->query('select * from entidad');
		return $consulta->result();
	}
	public function Reporte_proyecto_siaf($AnioMeta,$CodigoUnico)
    {
            $data = $this->db->query("execute sp_ListarMontosProyectoAnio @anio_meta='".$AnioMeta."', @codigo_unico ='".$CodigoUnico."'");            
            return $data->result();       
    }

}

?>