<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ET_Responsable extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function insertarET_Epediente($id_et,$ComboResponsableEjecucion,$ComboTipoResponsableEjecucion,$comboCargoEjecucion)
    {
        $estado_responsable_et=1;
        $mensaje1=$this->db->query("insert into ET_RESPONSABLE(id_et,id_persona,id_tipo_responsable_et,id_cargo,estado_responsable_et)values('".$id_et."','".$ComboResponsableEjecucion."','".$ComboTipoResponsableEjecucion."','".$comboCargoEjecucion."','".$estado_responsable_et."')");
        return true;
    }

    function ETResponsablePorIdET($idEt)
    {
        $data= $this->db->query("select * from et_responsable where id_et=$idEt");

        return $data->result();
    }

    function personalPorET($idEt)
    {
        $data= $this->db->query("select * from et_responsable etr inner join cargo c on etr.id_cargo=c.id_cargo left join PERSONA p on etr.id_persona=p.id_persona where etr.id_et=$idEt and etr.id_tipo_responsable_et=3 order by estado_responsable_et desc");
        return $data->result();
    }

    function personalActualPorET($idEt)
    {
        $data= $this->db->query("select * from et_responsable etr inner join cargo c on etr.id_cargo=c.id_cargo left join PERSONA p on etr.id_persona=p.id_persona where etr.id_et=$idEt and etr.id_tipo_responsable_et=3 and etr.estado_responsable_et=1 order by etr.fecha_asignacion_resp_et desc");
        return $data->result();
    }

    function countCargo($idEt,$id_cargo)
    {
        $data= $this->db->query(" select *  from et_Responsable where id_et=$idEt and id_cargo=$id_cargo");
        return $data->result();
    }

    function insertar($data)
    {
        $this->db->insert('ET_RESPONSABLE',$data);
        return $this->db->insert_id();
    }

    function editar($data, $idEtResponsable)
    {
        $this->db->set($data);
        $this->db->where('id_responsable_et', $idEtResponsable);
        $this->db->update('ET_RESPONSABLE');
        return $this->db->affected_rows();
    }

    function eliminar($idEtResponsable)
    {
        $this->db->where('id_responsable_et',$idEtResponsable);
        $this->db->delete('ET_RESPONSABLE');
        return $this->db->affected_rows();
    }

    function ResponsableCargo($idEt, $idCargo)
    {
        $data= $this->db->query("select p.nombres+' '+p.apellido_p+' '+p.apellido_m as nombres from et_responsable r inner join persona p on r.id_persona=p.id_persona where id_cargo='$idCargo' and id_et='$idEt'");
        return $data->result();
    }

}