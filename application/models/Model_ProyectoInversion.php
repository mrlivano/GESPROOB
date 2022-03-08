<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_ProyectoInversion extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    function Insert_pi_pip($data)
    {
        $this->db->insert('PROYECTO_INVERSION', $data);
        return $this->db->insert_id();
    }

    function editar($data, $idPi)
    {
        $this->db->set($data);
        $this->db->where('id_pi', $idPi);
        $this->db->update('PROYECTO_INVERSION');
        return $this->db->affected_rows();
    }

    function GetProyectoInversionUltimo()
    {
        $ProyectoInversionUlti=$this->db->query("execute sp_ProyectoInversionUltimo_r");
        return $ProyectoInversionUlti->result();
    }

    function ProyectoInversion()
    {
        $ProyectoInversion=$this->db->query("execute sp_ProyectoInversion_r");
        return $ProyectoInversion->result();
    }

    function BuscarProyectoInversion($Id_ProyectoInver)
    {
        $ProyectoInversion=$this->db->query("execute sp_ProyectoInversion_Buscar'".$Id_ProyectoInver."'");
        return $ProyectoInversion->result();
    }

    function getProyectoInversionByET($idPI)
    {
        $proyectoInversionET = $this->db->query("select * from PROYECTO_INVERSION where id_pi=".$idPI);
        return $proyectoInversionET->result();
    }

    public function insertConformidad($data)
    {
        $this->db->insert('CONF_ORDEN', $data);
        return $this->db->insert_id();
    }

    public function updateConformidad($pathfile, $nro_orden)
    {
        $data = array(
            'pathfile' => $pathfile,
        );

        $this->db->where('nro_orden', $nro_orden);
        $this->db->update('CONF_ORDEN', $data);
    }

    public function getConformidadOrden($data)
    {
        $conformidadOrden = $this->db->query("select * from CONF_ORDEN where nro_orden=".$data);
        return $conformidadOrden->result();
    }

    public function insertOrdenServicio($data)
    {
        $this->db->insert('ORDEN_SERVICIO', $data);
        return $this->db->insert_id();
    }
	public function ReportePIPPedidosMes($annio,$ue,$meta,$mes)
    {
		
		if($mes=="todomes"){
			
			    $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
			
			$datass = $db_sedecentral->query("	
						select SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.NRO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, 
            CAST(SIG_PEDIDOS.MOTIVO_PEDIDO AS varchar(max)) as DESCRIPCION, SIG_PEDIDOS.sec_func, SIG_PEDIDOS.FECHA_APROB, 
            SIG_PEDIDOS.SEC_EJEC, SUM(SIG_DETALLE_PEDIDOS.CANT_APROBADA ) as TOTAL
            FROM SIGA_1549.dbo.SIG_PEDIDOS , SIGA_1549.dbo.SIG_DETALLE_PEDIDOS
            WHERE    SIG_DETALLE_PEDIDOS.NRO_PEDIDO = SIG_PEDIDOS.NRO_PEDIDO AND SIG_PEDIDOS.TIPO_BIEN=SIG_DETALLE_PEDIDOS.TIPO_BIEN AND SIG_PEDIDOS.TIPO_PEDIDO=SIG_DETALLE_PEDIDOS.TIPO_PEDIDO AND 
			SIG_PEDIDOS.ANO_EJE = SIG_DETALLE_PEDIDOS.ANO_EJE AND SIG_PEDIDOS.SEC_EJEC= SIG_DETALLE_PEDIDOS.SEC_EJEC
			AND (SIG_PEDIDOS.ANO_EJE = '".$annio."') AND SIG_PEDIDOS.SEC_EJEC = '".$ue."' AND
            ISNULL(TRY_CAST( SIG_PEDIDOS.sec_func as int ), 0)  = ISNULL(TRY_CAST( '".$meta."' as int ), 0)   
			GROUP BY SIG_PEDIDOS.NRO_PEDIDO,SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, CAST(SIG_PEDIDOS.MOTIVO_PEDIDO AS varchar(max)) ,SIG_PEDIDOS.sec_func,SIG_PEDIDOS.FECHA_APROB,SIG_PEDIDOS.SEC_EJEC
			ORDER BY SIG_PEDIDOS.FECHA_PEDIDO DESC

			
			"); 
			
            return $datass->result_array();
			
			
		}else{
		
		    $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
			
			$datass = $db_sedecentral->query("	
						select SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.NRO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, 
            CAST(SIG_PEDIDOS.MOTIVO_PEDIDO AS varchar(max)) as DESCRIPCION, SIG_PEDIDOS.sec_func, SIG_PEDIDOS.FECHA_APROB, 
            SIG_PEDIDOS.SEC_EJEC, SUM(SIG_DETALLE_PEDIDOS.CANT_APROBADA ) as TOTAL
            FROM SIGA_1549.dbo.SIG_PEDIDOS , SIGA_1549.dbo.SIG_DETALLE_PEDIDOS
            WHERE    SIG_DETALLE_PEDIDOS.NRO_PEDIDO = SIG_PEDIDOS.NRO_PEDIDO AND SIG_PEDIDOS.TIPO_BIEN=SIG_DETALLE_PEDIDOS.TIPO_BIEN AND SIG_PEDIDOS.TIPO_PEDIDO=SIG_DETALLE_PEDIDOS.TIPO_PEDIDO AND 
			SIG_PEDIDOS.ANO_EJE = SIG_DETALLE_PEDIDOS.ANO_EJE AND SIG_PEDIDOS.SEC_EJEC= SIG_DETALLE_PEDIDOS.SEC_EJEC
			AND (SIG_PEDIDOS.ANO_EJE = '".$annio."') AND SIG_PEDIDOS.SEC_EJEC = '".$ue."' AND
            ISNULL(TRY_CAST( SIG_PEDIDOS.sec_func as int ), 0)  = ISNULL(TRY_CAST( '".$meta."' as int ), 0) AND MONTH(FECHA_PEDIDO)='".$mes."'  
			GROUP BY SIG_PEDIDOS.NRO_PEDIDO,SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, CAST(SIG_PEDIDOS.MOTIVO_PEDIDO AS varchar(max)) ,SIG_PEDIDOS.sec_func,SIG_PEDIDOS.FECHA_APROB,SIG_PEDIDOS.SEC_EJEC
			ORDER BY SIG_PEDIDOS.FECHA_PEDIDO DESC

			
			"); 
			
            return $datass->result_array();
		}
	
		
		
		
    }
	
	
	
    public function updateOrdenServicio($pathfile, $nro_orden)
    {
        $data = array(
            'pathfile' => $pathfile,
        );

        $this->db->where('nro_orden', $nro_orden);
        $this->db->update('ORDEN_SERVICIO', $data);
    }

    public function getOrdenServicio($data)
    {
        $conformidadOrden = $this->db->query("select * from ORDEN_SERVICIO where nro_orden=".$data);
        return $conformidadOrden->result();
    }

    public function getProyectoInversionPorIdPi($idPi)
    {
        $data=$this->db->query("select p.*, g.id_grup_funcional, d.id_div_funcional, f.id_funcion  
        from PROYECTO_INVERSION p inner join  GRUPO_FUNCIONAL g on p.id_grupo_funcional=g.id_grup_funcional
        inner join DIVISION_FUNCIONAL d on g.id_div_funcional=d.id_div_funcional
        inner join FUNCION f on f.id_funcion=d.id_funcion
        where p.id_pi='$idPi'");
        return $data->result();
    }

    public function getProyectoInversionNoPipPorIdPi($idPi)
    {
        $data=$this->db->query("select p.*, g.id_grup_funcional,d.id_div_funcional,f.id_funcion,n.id_nopip,n.id_tipo_nopip
        from PROYECTO_INVERSION p inner join  GRUPO_FUNCIONAL g on p.id_grupo_funcional=g.id_grup_funcional
        inner join DIVISION_FUNCIONAL d on g.id_div_funcional=d.id_div_funcional
        inner join FUNCION f on f.id_funcion=d.id_funcion inner join NOPIP n on p.id_pi=n.id_pi 
        where p.id_pi='$idPi'");
        return $data->result();
    }

    public function ProyectoPorCodigoUnico($codigoUnico)
    {
        $data = $this->db->query("select * from PROYECTO_INVERSION where codigo_unico_pi='$codigoUnico'");
        return $data->result();
    }

    public function ProyectoPorCodigoUnicoDiferente($codigoUnico, $idPi)
    {
        $data = $this->db->query("select * from PROYECTO_INVERSION where codigo_unico_pi='$codigoUnico' and id_pi<>'$idPi'");
        return $data->result();
    }

    public function RestoreDB(){
        $data = $this->db->query("RESTORE DATABASE BDPRUEBA FROM DISK = 'C:\Program Files\Microsoft SQL Server\MSSQL13.MSSQLSERVER\MSSQL\Backup\BDPRUEBA.bak'");
        return $data->result();
    }
}
