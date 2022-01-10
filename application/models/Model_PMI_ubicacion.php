<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_PMI_ubicacion extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->db->free_db_resource();

    }

    public function insertarUbigeoPiImg($data)
    {
        $this->db->insert('UBIGEO_PI_IMG',$data);
        return $this->db->affected_rows();
    }
    public function insertar($id,$img)
    {
      $this->db->query("insert into UBIGEO_PI_IMG(id_ubigeo_pi,url_img) values ($id,'".$img."')");
      return true;
    
    }


    public function ultipoUbigeoPEI()
    {
         $data=$this->db->query("select max(id_ubigeo_pi) as id_ubigeo_pi from UBIGEO_PI ");
         return $data->result()[0];

    }
    public function ListarPipProvinciDistrito($id_ubigeo)
    {

      $data=$this->db->query("select * from UBIGEO where id_ubigeo='".$id_ubigeo."' ");
      return $data->result()[0];
    }

    public function id_ubigeo_pi_img($id_ubigeo_pi)
    {
      $data=$this->db->query("select * from UBIGEO_PI  INNER JOIN  UBIGEO_PI_IMG ON UBIGEO_PI.id_ubigeo_pi=UBIGEO_PI_IMG.id_ubigeo_pi 
      where  UBIGEO_PI.id_ubigeo_pi='$id_ubigeo_pi' ");
      return $data->result()[0];
      
    }

    public function actualizar($id_ubigeo_pi_img,$imagen)
    {
        $this->db->query("update UBIGEO_PI_IMG  SET url_img ='".$imagen."' WHERE id_ubigeo_pi_img = $id_ubigeo_pi_img");
        return true;
    }




}
