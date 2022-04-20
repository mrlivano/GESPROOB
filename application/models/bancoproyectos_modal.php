<?php
defined('BASEPATH') or exit('No direct script access allowed');
class bancoproyectos_modal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        $this->load->database();
    }

    public function BuscarProyectoSiaf($CodigoSiaf)
    {
        $Opcion='listar_datos_proyecto_importacion';
        $data=$this->db->query("execute sp_Gestionar_SIAF   @codigo_snip ='".$CodigoSiaf."',  @Opcion='listar_datos_proyecto_importacion'");
        return $data->result();
    }

    public function InsertarUbigeo_Pi($data) 
    {
        $this->db->insert('UBIGEO_PI', $data);
        return array(
            'filasAfectadas' => $this->db->affected_rows(),
            'ultimoId' => $this->db->insert_id(),
        );
    }

    public function verificarCicloPi($id_pi)
    {
        $this->db->select('estado_ciclo_pi.*');
        $this->db->from('estado_ciclo_pi');
        $this->db->where('estado_ciclo_pi.id_pi',$id_pi);
        $this->db->order_by("fecha_estado_ciclo_pi", "desc");
        $query=$this->db->get();
        return $query->result();
    }

    public function AddNoPip($data)
    {
        $this->db->insert('PROYECTO_INVERSION',$data);
        
        return $this->db->insert_id();        
    }

    public function InsertNoPip($data)
    {
        $this->db->insert('NOPIP',$data);
        
        return $this->db->insert_id();        
    }


    public function GetProyectoInversion()
    {
        $q=$this->db->query("exec sp_Gestionar_ProyectoInversion @Opcion='LISTARPIP',@ue=NULL");
        
        return $q->result();               
    }
    public function filtrarProyectoInversion($idUnidadEjecutora,$idOficina)
    { 
        $q=$this->db->query("exec sp_pruebafiltrar @ue =".$idUnidadEjecutora.", @cod_principal=".$idOficina);
        
        return $q->result();               
    }
    public function GetNOPIP()
    {
        $q=$this->db->query("select * FROM PROYECTO_INVERSION p inner join NOPIP n
        on p.id_pi=n.id_pi inner join TIPO_NOPIP t on n.id_tipo_nopip=t.id_tipo_nopip where id_tipo_inversion=2");
        return $q->result();
    }

    public function Get_ubigeo_pip($flat, $id_pi)
    {
        $Get_ubigeo_pip = $this->db->query("execute sp_Gestionar_UbigeoPI'" . $flat . "',@id_pi='"
            . $id_pi . "'");
        return $Get_ubigeo_pip->result();
    }
    
    public function eliminarUbigeo($id_ubigeo_pi)
    {
        $flat='D';
        $this->db->query("execute sp_Gestionar_UbigeoPI_d @opcion = '".$flat . "', @id_ubigeo_pi ='".$id_ubigeo_pi. "'");
        return true;
    }

    public function idUbigeoPI($id_ubigeo_pi)
    {
        $data=$this->db->query("select * from UBIGEO_PI where id_ubigeo_pi=$id_ubigeo_pi ");

        return $data->result()[0];
    }

    public function listar_estado()
    {
        $listar_estado = $this->db->query("select * FROM ESTADO_CICLO ORDER BY nombre_estado_ciclo");

        return $listar_estado->result();
    }

    //listar provincia
    public function listar_provincia($flat)
    {
        $listar_provincia = $this->db->query("execute sp_Gestionar_UbigeoPI @opcion='" . $flat . "'");
        if ($listar_provincia->num_rows() > 0) {
            return $listar_provincia->result();
        } else {
            return false;
        }
    }
    //listar provincia
    public function listar_distrito($flat, $nombre_distrito)
    {
        $listar_distrito = $this->db->query("execute sp_Gestionar_UbigeoPI @opcion='"
            . $flat . "',@provincia_filtro_lista='"
            . $nombre_distrito . "'");
        if ($listar_distrito->num_rows() > 0) {
            return $listar_distrito->result();
        } else {
            return false;
        }
    }
    //Add no pip tipo
    public function AddTipoNoPip($flat, $id_tipo_NoPip, $Cbx_TipoNoPip, $txt_id_pip_Tipologia)
    {
        $this->db->query("execute sp_Gestionar_NoPip_c'" . $flat . "','"
            . $id_tipo_NoPip . "','"
            . $Cbx_TipoNoPip . "','"
            . $txt_id_pip_Tipologia . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    //listar tipo no pip
    public function Get_TipoNoPip($flat, $id_pi)
    {
        $Get_TipoNoPip = $this->db->query("execute sp_Gestionar_NoPip
            @opcion='" . $flat . "',
            @id_pi='" . $id_pi . "'");
        if ($Get_TipoNoPip->num_rows() > 0) {
            return $Get_TipoNoPip->result();
        } else {
            return false;
        }
    }



    public function getBancoProyecto() 
    {
        return $this->db->get('PROYECTO_INVERSION')->result();
    }

    public function verificarProyecto($txtCodigoUnico)
    {
        $this->db->select('proyecto_inversion.*');
        $this->db->from('proyecto_inversion');
        $this->db->where('proyecto_inversion.codigo_unico_pi',$txtCodigoUnico);
        return $this->db->get()->result();
    }
    public function verificarProyectoCodigoUnico($txtCodigoUnico)
    {
        $this->db->select('proyecto_inversion.*');
        $this->db->from('proyecto_inversion');
        $this->db->where('proyecto_inversion.codigo_unico_pi',$txtCodigoUnico);
        $this->db->where('proyecto_inversion.id_tipo_inversion','1');
        return $this->db->get()->num_rows();
    }
    public function verificarProyectoCodigoUniconopip($txtCodigoUnico)
    {
        $this->db->select('proyecto_inversion.*');
        $this->db->from('proyecto_inversion');
        $this->db->where('proyecto_inversion.codigo_unico_pi',$txtCodigoUnico);
        $this->db->where('proyecto_inversion.id_tipo_inversion','2');
        return $this->db->get()->num_rows();        
    }

    function obtenerProyectosSiaf($unidadEjecutora,$anio)
    {
        // $query = $this->db->query("select * from DBSIAF.dbo.act_proy_nombre where act_proy in (select act_proy from dbsiaf.dbo.META where sec_ejec like '%$unidadEjecutora%' and ano_eje = '$anio') and ano_eje = '$anio' and tipo_proyecto = '1'");
        // return $query->result();
        $query = $this->db->query("select * from DBSIAF.DBO.act_proy_x_entidad ape inner join DBSIAF.DBO.act_proy_nombre apn
        on ape.act_proy=apn.act_proy
         where ape.ano_eje='$anio' and apn.ano_eje='$anio' and apn.tipo_act_proy=2");
        return $query->result();
    }

    function verificarCodigoUnico($codigo_unico_pi)
    {
        $this->db->select('PROYECTO_INVERSION.*');
        $this->db->from('PROYECTO_INVERSION');
        $this->db->where('PROYECTO_INVERSION.codigo_unico_pi',$codigo_unico_pi);
        return $this->db->get()->result();
    }

    function insertarProyectosdeSiaf($data)
    {
        $this->db->insert('PROYECTO_INVERSION',$data);
    }

    function editarProyectosdeSiaf($data,$codigo_unico_pi)
    {
        $this->db->set($data);
        $this->db->where('codigo_unico_pi',$codigo_unico_pi);
        $this->db->update('PROYECTO_INVERSION');
    }

    function insertarProyectosdePIDE($data)
    {
        $this->db->insert('PROYECTO_INVERSION',$data);
    }

    function editarProyectosdePIDE($data,$codigo_unico_pi)
    {
        $this->db->set($data);
        $this->db->where('codigo_unico_pi',$codigo_unico_pi);
        $this->db->update('PROYECTO_INVERSION');
    }

    function verificarCodigoUnicoPIDE($codigo_unico_pi)
    {
        $this->db->select('PIDE_PROYECTO_INVERSION.*');
        $this->db->from('PIDE_PROYECTO_INVERSION');
        $this->db->where('PIDE_PROYECTO_INVERSION.codigo',$codigo_unico_pi);
        return $this->db->get()->result();
    }

    function insertarProyectoCodigoPIDE($data)
    {
        $this->db->insert('PIDE_PROYECTO_INVERSION',$data);
    }

    function editarProyectoCodigoPIDE($data,$codigo_unico_pi)
    {
        $this->db->set($data);
        $this->db->where('codigo',$codigo_unico_pi);
        $this->db->update('PIDE_PROYECTO_INVERSION');
    }

    function obtenerProyectosPIDE()
    {
        $query = $this->db->query("select pi.codigo_unico_pi as codigo_unico_est_inv , ppi.montoAlternativa, ppi.costoActualizado, pi.nombre_pi as nombre_est_inv, pi.id_pi, pi.id_ue, ppi.situacion, ppi.ultimoEstudio,gf.id_grup_funcional from PROYECTO_INVERSION pi inner join PIDE_PROYECTO_INVERSION ppi on pi.codigo_unico_pi=ppi.codigo left join GRUPO_FUNCIONAL gf on gf.nombre_grup_funcional= ppi.subprograma COLLATE SQL_Latin1_General_CP1_CI_AI");
        return $query->result();
    }

    function verificarCodigoUnicoEstudio($codigo_unico_pi)
    {
        $this->db->select('ESTUDIO_INVERSION.*');
        $this->db->from('ESTUDIO_INVERSION');
        $this->db->where('ESTUDIO_INVERSION.id_pi',$codigo_unico_pi);
        return $this->db->get()->result();
    }

    function insertarEstudioCodigoPIDE($data)
    {
        $this->db->insert('ESTUDIO_INVERSION',$data);
    }

    function editarEstudioCodigoPIDE($data,$codigo_unico_pi)
    {
        $this->db->set($data);
        $this->db->where('id_pi',$codigo_unico_pi);
        $this->db->update('ESTUDIO_INVERSION');
    }

    function verificarCodigoUnicoProyectoAño($codigo_unico_pi,$anio)
    {
        $this->db->select('PROYECTO_AÑO.*');
        $this->db->from('PROYECTO_AÑO');
        $this->db->where('PROYECTO_AÑO.cod_proyecto',$codigo_unico_pi);
        $this->db->where('PROYECTO_AÑO.año',$anio);
        return $this->db->get()->result();
    }

    function insertarProyectoAñoPIDE($data)
    {
        $this->db->insert('PROYECTO_AÑO',$data);
    }

    function editarProyectoAñoPIDE($data,$codigo_unico_pi)
    {
        $this->db->set($data);
        $this->db->where('cod_proyecto',$codigo_unico_pi);
        $this->db->update('PROYECTO_AÑO');
    }
}
