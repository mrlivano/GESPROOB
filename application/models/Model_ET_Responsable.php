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
        $this->db->query("insert into ET_RESPONSABLE(id_et,id_persona,id_tipo_responsable_et,id_cargo,estado_responsable_et)values('".$id_et."','".$ComboResponsableEjecucion."','".$ComboTipoResponsableEjecucion."','".$comboCargoEjecucion."','".$estado_responsable_et."')");
        return $this->db->insert_id();
    }

    function insertarET_EpedienteEjecucion($id_et,$ComboResponsableEjecucion,$ComboTipoResponsableEjecucion,$comboCargoEjecucion,$fechaInicio,$fechaFin)
    {
        $estado_responsable_et=1;
        $this->db->query("insert into ET_RESPONSABLE(id_et,id_persona,id_tipo_responsable_et,id_cargo,estado_responsable_et,fecha_inicio,fecha_fin)values('".$id_et."','".$ComboResponsableEjecucion."','".$ComboTipoResponsableEjecucion."','".$comboCargoEjecucion."','".$estado_responsable_et."','".$fechaInicio."','".$fechaFin."')");
        return $this->db->insert_id();
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

    function ResponsableEtapa($id_et, $id_etapa){
        $data= $this->db->query("select r.*, p.nombres,p.apellido_p,p.apellido_m,c.desc_cargo from ET_RESPONSABLE r inner join PERSONA p on r.id_persona=p.id_persona inner join CARGO c on r.id_cargo = c.id_cargo where id_et='$id_et' and id_tipo_responsable_et='$id_etapa'");
        return $data->result(); 
    }

    function ResponsableIdETPersonaElaboracion($id_et, $id_persona){
        $data= $this->db->query("select * from ET_RESPONSABLE where id_et ='$id_et' and id_persona='$id_persona' and id_tipo_responsable_et=2");
        return $data->result(); 
    }

    function ResponsableIdETPersonaEjecucion($id_et, $id_persona){
        $data= $this->db->query("select * from ET_RESPONSABLE where id_et ='$id_et' and id_persona='$id_persona' and id_tipo_responsable_et=3");
        return $data->result(); 
    }

}