<?php
defined('BASEPATH') or exit('No direct script access allowed');
class programar_pip_modal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetProyectosFormulacionEvaluacion($flat)
    {
        $GetProyectosFormulacionEvaluacion = $this->db->query("execute sp_Gestionar_ProyectoInversion'"
            . $flat . "', @ue=NULL");
        return $GetProyectosFormulacionEvaluacion->result();     
    }
    public function GetProyectosEjecucion($flat)
    {
        $GetProyectosEjecucion = $this->db->query("execute sp_Gestionar_ProyectoInversion'"
            . $flat . "', @ue=NULL");
        return $GetProyectosEjecucion->result();        
    }
    public function GetProyectosFuncionamiento($flat)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $GetProyectosFuncionamiento=$this->db->query("execute sp_Gestionar_ProyectoInversion'"
            . $flat . "', @ue=NULL");
            return $GetProyectosFuncionamiento->result();
        }
        else
        {
           $GetProyectosFuncionamiento=$this->db->query("execute sp_Gestionar_ProyectoInversion'"
            . $flat . "', @ue=$ue");
            return $GetProyectosFuncionamiento->result();
        }         
    }

    public function GetAnioCartera()
    {
        $GetAnioCartera = $this->db->query("select id_cartera,year(año_apertura_cartera) AS anio from CARTERA_INVERSION where estado_cartera='1'");
        if ($GetAnioCartera->num_rows() > 0) {
            return $GetAnioCartera->result();
        } else {
            return false;
        }
    }

    public function GetAnioCarteraProgramado()
    {
        $GetAnioCartera = $this->db->query("select  id_cartera,YEAR(año_apertura_cartera) AS anio from CARTERA_INVERSION ORDER BY anio");
        if ($GetAnioCartera->num_rows() > 0) {
            return $GetAnioCartera->result();
        } else {
            return false;
        }
    }

    public function AddProgramacion($flat, $id_programacion, $Cbx_AnioCartera, $cbxBrecha, $txt_id_pip_programacion, $txt_anio1, $txt_anio2, $txt_anio3, $txt_anio1_oper, $txt_anio2_oper, $txt_anio3_oper, $txt_prioridad)
    {
        $this->db->query("execute sp_Gestionar_Programacion_pip_c
            @Opcion='" . $flat . "',
            @id_prog='" . $id_programacion . "',
            @id_cartera='" . $Cbx_AnioCartera . "',
            @id_brecha='" . $cbxBrecha . "',
            @id_pi='" . $txt_id_pip_programacion . "',
            @monto_anio1='" . $txt_anio1 . "',
            @monto_anio2='" . $txt_anio2 . "',
            @monto_anio3='" . $txt_anio3 . "',
            @monto_oym1='" . $txt_anio1_oper . "',
            @monto_oym2='" . $txt_anio2_oper . "',
            @monto_oym3='" . $txt_anio3_oper . "',
            @prioridad='" . $txt_prioridad . "'");

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function AddProgramacion_operacion_mantenimiento($flat, $id_programacion_, $Cbx_AnioCartera_, $cbxBrecha_, $txt_id_pip_programacion_, $txt_anio1_, $txt_anio2_, $txt_anio3_, $txt_prioridad_)
    {
        $this->db->query("execute sp_Gestionar_Programacion_pip_c
            @Opcion='" . $flat . "',
            @id_prog='" . $id_programacion_ . "',
            @id_cartera='" . $Cbx_AnioCartera_ . "',
            @id_brecha='" . $cbxBrecha_ . "',
            @id_pi='" . $txt_id_pip_programacion_ . "',
            @monto_oym1='" . $txt_anio1_ . "',
            @monto_oym2='" . $txt_anio2_ . "',
            @monto_oym3='" . $txt_anio3_ . "',
            @prioridad='" . $txt_prioridad_ . "'");

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listar_prioridad($flat, $anio)
    {
        $listar_prioridad = $this->db->query("execute sp_Gestionar_Programacion_pip @opcion='"
            . $flat . "',
            @id_cartera='" . $anio . "'");
        if ($listar_prioridad->num_rows() > 0) {
            return $listar_prioridad->result();
        } else {
            return false;
        }
    }

    public function listar_programacion($flat, $id_pi)
    {
        $listar_programacion = $this->db->query("execute sp_Gestionar_Programacion_pip @opcion='"
            . $flat . "',
            @id_pi='" . $id_pi . "'");
        return $listar_programacion->result();
    }

    public function listar_programacion_operacion_mantenimiento($flat, $id_pi)
    {
        $listar_programacion_operacion_mantenimiento = $this->db->query("execute sp_Gestionar_Programacion_pip @opcion='"
            . $flat . "',
            @id_pi='" . $id_pi . "'");
        return $listar_programacion_operacion_mantenimiento->result();
    }
}
