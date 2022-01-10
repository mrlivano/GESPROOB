<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ubicacion_Model extends CI_Model
{
        public function __construct()
        {
              parent::__construct();

        }
        function get_departamento()
        {      
            $departamento=$this->db->query("execute sp_ListaDepartamento");
            return $departamento->result();
        }
        function get_provincias($IdDepartamento) {
            $Provincia=$this->db->query("EXECUTE sp_ListaProvincia '".$IdDepartamento."'");
             return $Provincia->result();
        }
        function get_distritos($IdProvincia){
          $cadena=implode(",",$IdProvincia);
             $Distritos=$this->db->query("EXECUTE sp_ListaDistrito '".$cadena."'");
             return $Distritos->result();
        }
         function get_buscarUbigeo($distrito) {
            $UbigeoCadena=implode(",",$distrito);
            $Ubigeo=$this->db->query("EXECUTE sp_UbigeoBuscar'".$UbigeoCadena."'");
             return $Ubigeo->result();
        }
}