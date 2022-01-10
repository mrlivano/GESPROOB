<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_RubroE extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


   public function Insertar_rubro($data)
    {
          $this->db->insert('RUBRO_PI', $data);
          return $this->db->affected_rows();
    }

    public function ListaRubro()
    {
        $data = $this->db->query("select * from RUBRO order by nombre_rubro");
        
        return $data->result();        
    }

public function BuscarRubro($txt_NombreRubroE){
$resultado=$this->db->select('*')->from('RUBRO')
->where('nombre_rubro',$txt_NombreRubroE)
->get();
if($resultado->num_rows()>0){
    return true;
}
else{
    return false;
}
}


//----------------------METODOS PARA EL MANTENIMIENTO DE RUBRO DE EJECUCION--------------------------------------------
    //AGREGAR UN RUBRO DE EJECUCION
    public function AddRubroE($data)
    {
       $this->db->insert('RUBRO',$data);
        return $this->db->insert_id();
    }
    //FIN AGREGAR UN RUBRO DE EJECUCION
    //LISTAR RUBRO DE EJECUCION
    public function GetRubroE()
    {
        $rubroe = $this->db->query("execute sp_Rubro_r"); //PROCEDIMIENTO DE LISTAR LOS RUBROS DE EJECUCION
        if ($rubroe->num_rows() > 0) {
            return $rubroe->result();
        } else {
            return false;
        }

    }
    //FIN LISTAR UN RUBRO DE EJECUCION
    public function GetRubroId($id_fuente_finan)
    {
        $rubroF = $this->db->query("execute sp_FuenteFinanRubro_r'" . $id_fuente_finan . "'"); //listar de division funcional
        if ($rubroF->num_rows() > 0) {
            return $rubroF->result();
        } else {
            return null;
        }
    }
    //MODIFICAR DATOS DE LOS RUBROS
    public function UpdateRubroE($id_rubro,$data)
    {
        $this->db->where('id_rubro',$id_rubro);
        $this->db->update('RUBRO',$data);
        if ($this->db->affected_rows()>0) {
            return true;
        } else {
            return false;
        }
    }

    //FIN MODIFICAR DATOS DE LOS RUBROS
    //ELIMINAR
    public function EliminarRubro($id_rubro){
        $this->db->where('id_rubro',$id_rubro);
        $this->db->delete('RUBRO');
        if($this->db->affected_rows()>0){
            return true;
        }
        else{
            return false;
        }
    }
    //--------------FIN DE METODOS PARA EL MANTENIMIENTO DE RUBRO DE EJECUCION--------------------------------------------
}
