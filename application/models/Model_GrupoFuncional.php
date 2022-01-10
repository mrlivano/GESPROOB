<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_GrupoFuncional extends CI_Model
{
           public function __construct()
          {
              parent::__construct();
            // $this->db->free_db_resource();

          }

	function GetGrupoFuncional()
	{
		$GrupoFuncional=$this->db->query("execute sp_GrupoFuncional_r");//listar de division funcional

		return $GrupoFuncional->result();
	}

          function GetGrupoFuncionalId($id_div_funcional){
            $GrupoFuncional=$this->db->query("execute sp_DivisionGrupo_r'".$id_div_funcional."' ");
            //listar de division funcional
            return $GrupoFuncional->result();

          }
      function AddGrupoFuncional($txt_codigoGfuncion,$txt_nombreGfuncion,$SelecDivisionFF,$SelecSector)
      {
        $this->db->query("execute sp_GrupoFuncional_c'".$SelecDivisionFF."','".$SelecSector."','".$txt_codigoGfuncion."','".$txt_nombreGfuncion."'");
            if ($this->db->affected_rows() > 0)
              {
                return true;
              }
              else
              {
                return false;
              }
      }
      function UpdateGrupoFuncional($txt_idGfuncionF,$IdSelecDivisionFFF,$IdSelecSectorF,$txt_codigoGfuncionF,$txt_nombreGfuncionF)
      {
        $this->db->query("execute sp_GrupoFuncional_u'".$txt_idGfuncionF."','".$IdSelecDivisionFFF."','".$IdSelecSectorF."','".$txt_codigoGfuncionF."','".$txt_nombreGfuncionF."'");
            if ($this->db->affected_rows() > 0)
              {
                return true;
              }
              else
              {
                return false;
              }
      }

        //fin grupo funcional

      function GrupoPipListar($id_ue)
        {
          $ListarPipGrupo=$this->db->query("select GRUPO_FUNCIONAL.nombre_grup_funcional, COUNT(nombre_pi) as CantidadPip, sum(costo_pi)AS CostoPip from PROYECTO_INVERSION inner join GRUPO_FUNCIONAL ON PROYECTO_INVERSION.id_grupo_funcional=GRUPO_FUNCIONAL.id_grup_funcional WHERE PROYECTO_INVERSION.id_ue =".$id_ue." group by GRUPO_FUNCIONAL.nombre_grup_funcional");

          return $ListarPipGrupo->result();
        }

      function GrupoFuncionalPipMontoTotalListar($id_ue)
      {
        $data=$this->db->query("select  COUNT(nombre_pi) as CantidadPip, sum(costo_pi)AS CostoPip from PROYECTO_INVERSION inner join GRUPO_FUNCIONAL ON PROYECTO_INVERSION.id_grupo_funcional=GRUPO_FUNCIONAL.id_grup_funcional WHERE PROYECTO_INVERSION.id_ue =".$id_ue);

        return $data->result()[0];
      }
      function EliminarGFuncional($id_grup_funcional)
      {
          $this->db->where('id_grup_funcional',$id_grup_funcional);
          $this->db->delete('GRUPO_FUNCIONAL');
          return $this->db->affected_rows();

      }
      function verificarGrupoFuncional($idgrupofuncional)
      {
        $this->db->select('proyecto_inversion.*');
        $this->db->from('proyecto_inversion');
        $this->db->where('proyecto_inversion.id_grupo_funcional',$idgrupofuncional);
        return $this->db->get()->result();
      }

      function divGFuncionalDuplicado($codigo_grup_funcional)
      {
        $flag = false;
        $query = $this->db->query("select * FROM GRUPO_FUNCIONAL WHERE codigo_grup_funcional = '".$codigo_grup_funcional."'");

        if($query->num_rows() > 0) {
          $flag = true;
        } else {
          $flag = false;
        }
        return $flag;
      }

      function ListaGrupoFuncional()
      {
        $data = $this->db->query("select * FROM GRUPO_FUNCIONAL");

        return $data->result();
      }

      function GrupoFuncionalPorDivisionFuncional($idDivFuncional)
      {
        $data = $this->db->query("select * from GRUPO_FUNCIONAL where id_div_funcional='$idDivFuncional'");

        return $data->result();
      }
      
}
