<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_AplicativoMovil extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();

    }
    public function listadoProyectoGrupoFuncional($id_grup_funcional)
    {
        $dato = $this->db->query("select ProInv.nombre_pi,ProInv.codigo_unico_pi,Gfun.id_grup_funcional,UBIGEO_PI.latitud,UBIGEO_PI.longitud,SECTOR.nombre_sector,SECTOR.id_sector,SECTOR.icono_sector,UBIGEO_PI_IMG.url_img
        from GRUPO_FUNCIONAL Gfun inner join SECTOR ON Gfun.id_sector=SECTOR.id_sector inner join PROYECTO_INVERSION  ProInv on Gfun.id_grup_funcional=ProInv.id_grupo_funcional 
        inner join UBIGEO_PI on ProInv.id_pi= UBIGEO_PI.id_pi left join UBIGEO_PI_IMG ON UBIGEO_PI.id_ubigeo_pi=UBIGEO_PI_IMG.id_ubigeo_pi  WHERE Gfun.id_grup_funcional='$id_grup_funcional' ");
        
        return $dato->result();
        
    }

    public function listadoProyectoDivisionFuncional($id_div_funcional)
    {
        $dato = $this->db->query("select DIVISION_FUNCIONAL.nombre_div_funcional,ProInv.nombre_pi,ProInv.codigo_unico_pi,Gfun.id_grup_funcional,UBIGEO_PI.latitud,UBIGEO_PI.longitud,SECTOR.nombre_sector,SECTOR.id_sector,SECTOR.icono_sector,UBIGEO_PI_IMG.url_img from GRUPO_FUNCIONAL Gfun inner join SECTOR ON Gfun.id_sector=SECTOR.id_sector inner join PROYECTO_INVERSION  ProInv on Gfun.id_grup_funcional=ProInv.id_grupo_funcional 
        inner join UBIGEO_PI on ProInv.id_pi= UBIGEO_PI.id_pi INNER JOIN DIVISION_FUNCIONAL on Gfun.id_div_funcional=DIVISION_FUNCIONAL.id_div_funcional left join UBIGEO_PI_IMG ON UBIGEO_PI.id_ubigeo_pi=UBIGEO_PI_IMG.id_ubigeo_pi   WHERE DIVISION_FUNCIONAL.id_div_funcional='$id_div_funcional'");
        
        return $dato->result();
    }

    public function listadoProyectoFuncion($id_funcion)
    {
        $dato = $this->db->query("            
select FUNCION.nombre_funcion, ProInv.nombre_pi,ProInv.codigo_unico_pi,Gfun.id_grup_funcional,UBIGEO_PI.latitud,UBIGEO_PI.longitud,SECTOR.nombre_sector,SECTOR.id_sector,SECTOR.icono_sector,UBIGEO_PI_IMG.url_img
        from GRUPO_FUNCIONAL Gfun inner join SECTOR ON Gfun.id_sector=SECTOR.id_sector inner join PROYECTO_INVERSION  ProInv on Gfun.id_grup_funcional=ProInv.id_grupo_funcional 
        inner join UBIGEO_PI on ProInv.id_pi= UBIGEO_PI.id_pi INNER JOIN DIVISION_FUNCIONAL on Gfun.id_div_funcional=DIVISION_FUNCIONAL.id_div_funcional inner join FUNCION on FUNCION.id_funcion=DIVISION_FUNCIONAL.id_funcion  left join UBIGEO_PI_IMG ON UBIGEO_PI.id_ubigeo_pi=UBIGEO_PI_IMG.id_ubigeo_pi  WHERE FUNCION.id_funcion='$id_funcion'");
        
        return $dato->result();
    }

    public function listaNoPipPorTipoNoPip($id_tipo_nopip)
    {
        $data=$this->db->query("select * from GRUPO_FUNCIONAL Gfun inner join SECTOR ON Gfun.id_sector=SECTOR.id_sector inner join PROYECTO_INVERSION  ProInv on Gfun.id_grup_funcional=ProInv.id_grupo_funcional 
        inner join UBIGEO_PI on ProInv.id_pi= UBIGEO_PI.id_pi inner join NOPIP np on ProInv.id_pi=np.id_pi inner join  TIPO_NOPIP on np.id_tipo_nopip=TIPO_NOPIP.id_tipo_nopip left join UBIGEO_PI_IMG ON UBIGEO_PI.id_ubigeo_pi=UBIGEO_PI_IMG.id_ubigeo_pi where TIPO_NOPIP.id_tipo_nopip='$id_tipo_nopip '");

        return $data->result();
    }

    public function listaTipoNoPip()
    {
        $data = $this->db->query("select * from TIPO_NOPIP");
        return $data->result();
    }

    public function listaTotalDeUbicacionesProyecto()
    {
        $dato = $this->db->query("select ProInv.nombre_pi,ProInv.codigo_unico_pi,Gfun.id_grup_funcional,UBIGEO_PI.latitud,UBIGEO_PI.longitud,SECTOR.nombre_sector,SECTOR.id_sector,SECTOR.icono_sector, UBIGEO_PI_IMG.url_img
        from GRUPO_FUNCIONAL Gfun inner join SECTOR ON Gfun.id_sector=SECTOR.id_sector inner join PROYECTO_INVERSION  ProInv on Gfun.id_grup_funcional=ProInv.id_grupo_funcional 
        inner join UBIGEO_PI on ProInv.id_pi= UBIGEO_PI.id_pi left join UBIGEO_PI_IMG ON UBIGEO_PI.id_ubigeo_pi=UBIGEO_PI_IMG.id_ubigeo_pi");
        
        return $dato->result();
        
    }
    public function busquedaPorCodigoDatosGeneralesPip($codigounico)
    {
       

$verifica_pip = $this->db->query("select * from PROYECTO_INVERSION where PROYECTO_INVERSION.codigo_unico_pi='".$codigounico."'");


 if($verifica_pip->num_rows()>0){
           

$data = $this->db->query("select * from PROYECTO_INVERSION iNNER JOIN GRUPO_FUNCIONAL ON PROYECTO_INVERSION.id_grupo_funcional=GRUPO_FUNCIONAL.id_grup_funcional inner join DIVISION_FUNCIONAL on GRUPO_FUNCIONAL.id_div_funcional=DIVISION_FUNCIONAL.id_div_funcional inner join FUNCION on DIVISION_FUNCIONAL.id_funcion=FUNCION.id_funcion INNER JOIN ESTADO_CICLO_PI ON PROYECTO_INVERSION.id_pi=ESTADO_CICLO_PI.id_pi INNER JOIN ESTADO_CICLO ON ESTADO_CICLO_PI.id_estado_ciclo=ESTADO_CICLO.id_estado_ciclo inner join SECTOR on GRUPO_FUNCIONAL.id_sector=SECTOR.id_sector INNER JOIN UBIGEO_PI ON PROYECTO_INVERSION.id_pi=UBIGEO_PI.id_pi  WHERE PROYECTO_INVERSION.codigo_unico_pi='".$codigounico."'");

       if($data->num_rows()>0){
            return $data->result()[0];
       }else{
            return 1;
       }
       }else{
            return 0;
       }



       

        
    }

     public function busquedaPorCodigoMostrarEnMapaPip($codigounico)
    {
       $data = $this->db->query("select * from PROYECTO_INVERSION iNNER JOIN GRUPO_FUNCIONAL ON PROYECTO_INVERSION.id_grupo_funcional=GRUPO_FUNCIONAL.id_grup_funcional inner join DIVISION_FUNCIONAL on GRUPO_FUNCIONAL.id_div_funcional=DIVISION_FUNCIONAL.id_div_funcional inner join FUNCION on DIVISION_FUNCIONAL.id_funcion=FUNCION.id_funcion INNER JOIN ESTADO_CICLO_PI ON PROYECTO_INVERSION.id_pi=ESTADO_CICLO_PI.id_pi INNER JOIN ESTADO_CICLO ON ESTADO_CICLO_PI.id_estado_ciclo=ESTADO_CICLO.id_estado_ciclo inner join SECTOR on GRUPO_FUNCIONAL.id_sector=SECTOR.id_sector INNER JOIN UBIGEO_PI ON PROYECTO_INVERSION.id_pi=UBIGEO_PI.id_pi left join UBIGEO_PI_IMG ON UBIGEO_PI.id_ubigeo_pi=UBIGEO_PI_IMG.id_ubigeo_pi WHERE PROYECTO_INVERSION.codigo_unico_pi='".$codigounico."'");

        return $data->result();
    }


    public function listapip()
    {
        $data = $this->db->query("select id_pi,FUNCION.nombre_funcion,DIVISION_FUNCIONAL.nombre_div_funcional, GRUPO_FUNCIONAL.nombre_grup_funcional, codigo_unico_pi,  nombre_pi , costo_pi, num_beneficiarios, fecha_registro_pi  from PROYECTO_INVERSION inner join GRUPO_FUNCIONAL ON PROYECTO_INVERSION.id_grupo_funcional=GRUPO_FUNCIONAL.id_grup_funcional INNER JOIN DIVISION_FUNCIONAL ON GRUPO_FUNCIONAL.id_div_funcional=DIVISION_FUNCIONAL.id_div_funcional INNER JOIN FUNCION ON DIVISION_FUNCIONAL.id_funcion=FUNCION.id_funcion");     
        return $data->result();
    }

}
