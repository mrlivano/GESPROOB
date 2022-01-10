<?php
defined('BASEPATH') or exit('No direct script access allowed');
class programar_nopip_modal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Get_no_pip($flat)
    {
        $ue=$this->session->userdata('idUnidadEjecutora');
        $tipoUsuario=$this->session->userdata('tipoUsuario');
        if($tipoUsuario==9)
        {
            $GNP=$this->db->query("execute sp_Gestionar_ProyectoInversion '".$flat."',@ue=NULL");
            return $GNP->result();
        }
        else
        {
           $GetNP=$this->db->query("execute sp_Gestionar_ProyectoInversion '".$flat."',@ue=$ue");
            return $GetNP->result();
        }        
    }
    public function GetAnioCartera()
    {
        $GetAnioCartera = $this->db->query("select id_cartera,year(año_apertura_cartera) AS anio from CARTERA_INVERSION where estado_cartera='1'");
        if ($GetAnioCartera->num_rows() > 0) 
        {
            return $GetAnioCartera->result();
        } 
        else 
        {
            return false;
        }
    }
    //Add ubigeo a un proyecto
    public function AddProgramacion($flat, $id_programacion, $Cbx_AnioCartera, $cbxBrecha, $txt_id_pip_programacion, $txt_anio1, $txt_anio2, $txt_anio3, $txt_prioridad)
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
            @prioridad='" . $txt_prioridad . "'");

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    //Add meta pi
    public function AddMeta_PI($flat, $id_meta_pi, $txt_anio_meta, $cbx_meta_presupuestal, $txt_id_pip_programacion_mp, $cbx_Meta, $txt_pia, $txt_pim, $txt_certificado, $txt_compromiso, $txt_devengado, $txt_girado)
    {
        $this->db->query("execute sp_Gestionar_Meta_Presupuestal_Pi_c
            @FLAT='" . $flat . "',
            @id_meta_pi='" . $id_meta_pi . "',
            @id_meta_pres='" . $cbx_meta_presupuestal . "',
            @id_pi='" . $txt_id_pip_programacion_mp . "',
            @id_correlativo_meta='" . $cbx_Meta . "',
            @anio_meta_pres='" . $txt_anio_meta . "',
            @pia_meta_pres='" . $txt_pia . "',
            @pim_acumulado='" . $txt_pim . "',
            @certificacion_acumulado='" . $txt_certificado . "',
            @compromiso_acumulado='" . $txt_compromiso . "',
            @devengado_acumulado='" . $txt_devengado . "',
            @girado_acumulado='" . $txt_girado . "'");

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //listar formulacion y evaluacion del primer modulo PMI
    public function listar_programacion($flat, $id_pi)
    {
        $listar_programacion = $this->db->query("execute sp_Gestionar_Programacion_pip @opcion='"
            . $flat . "',
            @id_pi='" . $id_pi . "'");
        if ($listar_programacion->num_rows() > 0) {
            return $listar_programacion->result();
        } else {
            return false;
        }
    }
    //listar metas de los proyectos
    public function listar_metas_pi($flat, $id_pi)
    {
        $listar_metas_pi = $this->db->query("execute sp_Gestionar_Meta_Presupuestal_Pi @FLAT='"
            . $flat . "',
            @id_pi='" . $id_pi . "'");
        if ($listar_metas_pi->num_rows() > 0) {
            return $listar_metas_pi->result();
        } else {
            return false;
        }
    }
    // inicio lectura de procedimiento sp_ListarMontosProyectoAnio
    public function listar_montos($flat, $codigounico,$aniometa)
    {
        $listar_montos=$this->db->query("sp_ListarMontosProyectoAnio 
                                        @flat='".$flat."',
                                        @codigounico='".$codigounico."',
                                        @aniometa='".$aniometa."'
                                        ");
                    if ($listar_montos->num_rows() > 0) {
                        return $listar_montos->result();
                    } else {
                        return false;
                    }


    }

    //fin de lectura 

    public function EliminarMetaPI($flat, $id_meta_pi)
    {
        $this->db->query("execute sp_Gestionar_Meta_Presupuestal_Pi_d
            @FLAT='" . $flat . "',
            @id_meta_pi='" . $id_meta_pi . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function EliminarProgramacion($flat, $id_pi, $id_cartera)
    {
        $this->db->query("execute sp_Gestionar_Programacion_d
            @Opcion='" . $flat . "',
            @id_pi='" . $id_pi . "',
            @id_cartera='" . $id_cartera . "'");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
