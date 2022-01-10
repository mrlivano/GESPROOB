<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_DashboardPmi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_cantidad_costo_tipo_pi($Opcion, $anio)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $get_cantidad_costo_tipo_pi = $this->db->query("execute sp_DashboardPMI @Opcion='".$Opcion ."', @anio_cartera='".$anio."', @ue=NULL");
            return $get_cantidad_costo_tipo_pi->result();
        }
        else
        {
            $get_cantidad_costo_tipo_pi = $this->db->query("execute sp_DashboardPMI @Opcion='".$Opcion ."', @anio_cartera='".$anio."', @ue=$ue");
            return $get_cantidad_costo_tipo_pi->result();
        }        
    }
    
    public function MontoProgramado()
    {
        $consulta = $this->db->query("SELECT dbo.TIPO_INVERSION.nombre_tipo_inversion,
             COUNT(id_pi) AS NumProyectos,
             SUM(dbo.PROYECTO_INVERSION.costo_pi) SumaCosto
        FROM   dbo.PROYECTO_INVERSION
             INNER JOIN dbo.TIPO_INVERSION ON dbo.PROYECTO_INVERSION.id_tipo_inversion = dbo.TIPO_INVERSION.id_tipo_inversion
        GROUP BY nombre_tipo_inversion");
        return $consulta->result();
    }
    public function EstadisticaPipProvinc()
    {
        $consulta = $this->db->query("SELECT provincia, count(provincia) AS Cantidadpip FROM UBIGEO_PI INNER JOIN PROYECTO_INVERSION
        ON UBIGEO_PI.id_pi=PROYECTO_INVERSION.id_pi
        INNER JOIN UBIGEO ON UBIGEO.id_ubigeo=UBIGEO_PI.id_ubigeo
        WHERE UBIGEO.provincia IS NOT NULL and departamento='Apurímac' GROUP BY provincia");
        return $consulta->result();
    }
    public function EstadisticaMontoPipProvincias()
    {
        $consulta = $this->db->query("SELECT provincia,
      COUNT(UBIGEO.id_ubigeo) AS Cantidad,
      SUM(costo_pi) AS MontoProyecto
      FROM   dbo.PROYECTO_INVERSION
      INNER JOIN dbo.UBIGEO_PI ON dbo.PROYECTO_INVERSION.id_pi = dbo.UBIGEO_PI.id_pi
      INNER JOIN dbo.UBIGEO ON dbo.UBIGEO_PI.id_ubigeo = dbo.UBIGEO.id_ubigeo WHERE departamento='Apurímac'
      GROUP BY provincia ");
        return $consulta->result();
    }
    public function EstadisticaPipEstadoCiclo()
    {
        $sql = "declare @total int\n"
            . "set @total = (select count(id_pi) from PROYECTO_INVERSION)\n"
            . "declare @otros int\n"
            . "set @otros = ( select count(proyecto_inversion.id_pi) from ESTADO_CICLO_PI right join PROYECTO_INVERSION \n"
            . " on ESTADO_CICLO_PI.id_pi=PROYECTO_INVERSION.id_pi where ESTADO_CICLO_PI.id_pi is null)\n"
            . "SELECT dbo.ESTADO_CICLO.nombre_estado_ciclo, count(ESTADO_CICLO_PI.id_pi) AS Num_Proyectos, @total as Num_Total, @otros as TotalNoCiclo\n"
            . "FROM            dbo.PROYECTO_INVERSION INNER JOIN\n"
            . "                         dbo.ESTADO_CICLO_PI ON dbo.PROYECTO_INVERSION.id_pi = dbo.ESTADO_CICLO_PI.id_pi INNER JOIN\n"
            . "                         dbo.ESTADO_CICLO ON dbo.ESTADO_CICLO_PI.id_estado_ciclo = dbo.ESTADO_CICLO.id_estado_ciclo\n"
            . "GROUP BY dbo.ESTADO_CICLO.id_estado_ciclo, dbo.ESTADO_CICLO.nombre_estado_ciclo";

        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    public function EstadisticaMontoPipCicloInversion()
    {
         $data = $this->db->query("select nombre_estado_ciclo ,sum(costo_pi)as MontoProyecto from PROYECTO_INVERSION INNER JOIN ESTADO_CICLO_PI ON PROYECTO_INVERSION.id_pi=ESTADO_CICLO_PI.id_pi inner join ESTADO_CICLO ON ESTADO_CICLO_PI.id_estado_ciclo=ESTADO_CICLO.id_estado_ciclo GROUP BY nombre_estado_ciclo, ESTADO_CICLO.id_estado_ciclo order by  ESTADO_CICLO.id_estado_ciclo ASC");//listar EVAL
        if ($data->num_rows()> 0) {
            return $data->result();
        } else {
            return false;
        }

    }
    public function GetDatosUbicacion()
    {
        $sql = "SELECT dbo.UBIGEO.distrito,\n"
            . "       dbo.PROYECTO_INVERSION.nombre_pi,\n"
            . "       dbo.UBIGEO_PI.latitud,\n"
            . "       dbo.UBIGEO_PI.longitud\n"
            . "FROM dbo.UBIGEO\n"
            . "     INNER JOIN dbo.UBIGEO_PI ON dbo.UBIGEO.id_ubigeo = dbo.UBIGEO_PI.id_ubigeo\n"
            . "     INNER JOIN dbo.PROYECTO_INVERSION ON dbo.UBIGEO_PI.id_pi = dbo.PROYECTO_INVERSION.id_pi;";

        $funcion = $this->db->query($sql); //listar funcion
        if ($funcion->num_rows() > 0) {
            return $funcion->result();
        } else {
            return false;
        }
    }

    /*function news_get_by_id ( $news_id )
{

$this->db->select('*');
$this->db->select("DATE_FORMAT( date, '%d.%m.%Y' ) as date_human",  FALSE );
$this->db->select("DATE_FORMAT( date, '%H:%i') as time_human",      FALSE );

<<<<<<< HEAD
}
function EstadisticaMontoPipProvincias()
=======

$this->db->from('news');

$this->db->where('news_id', $news_id );

$query = $this->db->get();

if ( $query->num_rows() > 0 )
>>>>>>> origin/desarrollo
{
$row = $query->row_array();
return $row;
}

}*/
}
