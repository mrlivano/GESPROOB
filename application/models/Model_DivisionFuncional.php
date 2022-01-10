<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_DivisionFuncional extends CI_Model
{
           public function __construct()
          {
              parent::__construct();
            // $this->db->free_db_resource();

          }

	//division funcional
	function GetDivisionFuncional()
	{
		$divisionf=$this->db->query("execute sp_DivisionFuncional_r");//listar de division funcional

		return $divisionf->result();
	}

        function getDivisioFuncuonaId($id_funcion){
          $divisionf=$this->db->query("execute sp_funcionDivision_r '".$id_funcion."'");//listar de division funcional
            if($divisionf->num_rows()>0)
             {
              return $divisionf->result();
             }else
             {
              return null;
             }
        }
        function AddDivisionFucion($txt_CodigoDfuncional,$txt_Nombre_DFuncional,$listaFuncionC)
        {
           $this->db->query("execute sp_DivisionFuncional_c '".$listaFuncionC."','".$txt_CodigoDfuncional."','".$txt_Nombre_DFuncional."'");
            if ($this->db->affected_rows() > 0)
              {
                return true;
              }
              else
              {
                return false;
              }

        }
        function UpdateDivisionFucion($id_DfuncionalM,$IdlistaFuncionCM,$txt_CodigoDfuncionalM,$txt_Nombre_DFuncionalM)
        {
          $this->db->query("execute sp_DivisionFuncional_u'".$id_DfuncionalM."','".$IdlistaFuncionCM."','".$txt_CodigoDfuncionalM."','".$txt_Nombre_DFuncionalM."'");
            if ($this->db->affected_rows() > 0)
              {
                return true;
              }
              else
              {
                return false;
              }
        }
         function DivisionFuncionalPipListar($id_ue)
        {
            $ListarDivisionFuncionalPipListar=$this->db->query("select DIVISION_FUNCIONAL.nombre_div_funcional ,count (nombre_pi)as CantidadPip, sum(costo_pi)as CostoPip from PROYECTO_INVERSION INNER JOIN GRUPO_FUNCIONAL ON PROYECTO_INVERSION.id_grupo_funcional=GRUPO_FUNCIONAL.id_grup_funcional INNER JOIN  DIVISION_FUNCIONAL on GRUPO_FUNCIONAL.id_div_funcional=DIVISION_FUNCIONAL.id_div_funcional WHERE PROYECTO_INVERSION.id_ue =".$id_ue." group by DIVISION_FUNCIONAL.nombre_div_funcional");

            return $ListarDivisionFuncionalPipListar->result();
        }

        function DivFuncionalPipMontoTotalListar($id_ue)
        {
          $data=$this->db->query("select count (nombre_pi)as CantidadPip, sum(costo_pi)as CostoPip from PROYECTO_INVERSION INNER JOIN GRUPO_FUNCIONAL ON PROYECTO_INVERSION.id_grupo_funcional=GRUPO_FUNCIONAL.id_grup_funcional INNER JOIN  DIVISION_FUNCIONAL on GRUPO_FUNCIONAL.id_div_funcional=DIVISION_FUNCIONAL.id_div_funcional WHERE PROYECTO_INVERSION.id_ue =".$id_ue);

          return $data->result()[0];
        }
        function EliminarDivFuncional($id_div_funcional)
        {
          $this->db->where('id_div_funcional',$id_div_funcional);
          $this->db->delete('DIVISION_FUNCIONAL');
          return $this->db->affected_rows();
        }
    function verificarDivisionFuncional($id_div_funcional)
    {
        $this->db->select('grupo_funcional.*');
        $this->db->from('grupo_funcional');
        $this->db->where('grupo_funcional.id_div_funcional',$id_div_funcional);
        return $this->db->get()->result();
    }

    function divFuncionalDuplicado($codigo_div_funcional)
    {
      $flag = false;
      $query = $this->db->query('SELECT * FROM DIVISION_FUNCIONAL WHERE codigo_div_funcional = '.$codigo_div_funcional);

      if($query->num_rows() > 0) {
        $flag = true;
      } else {
        $flag = false;
      }
      return $flag;
    }
    function ListaDivisionFuncional()
    {
      $data=$this->db->query("select * from DIVISION_FUNCIONAL");

      return $data->result();
    }
    public function DivisionFuncionalPorFuncion($idFuncion)
    {
      $data=$this->db->query("select * from DIVISION_FUNCIONAL where id_funcion='$idFuncion' order by nombre_div_funcional");

      return $data->result();
    }

}
