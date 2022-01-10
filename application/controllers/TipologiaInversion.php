<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TipologiaInversion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('NaturalezaInversion_Model');
        $this->load->model('TipologiaInversion_Model');
        $this->load->model('TipoInversion_Model');
        $this->load->model('TipoNoPip_Model');
        $this->load->helper('FormatNumber_helper');

    }
    public function index()
    {
        $this->_load_layout('front/Administracion/frmTipologiaInversion');
    }
//------------------------------------------------------------------------------------------------------------------

    /* funcion de mi tabla*/
    public function get_NaturalezaInversion() //mostra Naturaleza de inversion

    {
        if ($this->input->is_ajax_request()) {
            $flat = "R";
            // $ID   = "0";
            $ID                   = "0";
            $txt_NombreNaturaleza = "NULL";
            $user                 = "1";

            $datos = $this->NaturalezaInversion_Model->get_NaturalezaInversion($flat, $ID, $txt_NombreNaturaleza);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    //ELIMINAR TABLA naturaleza inversion

    public function EliminarNaturalezaInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "D";
            // $ID   = "0";
            $txt_IdNaturaleza          = $this->input->post("id_naturaleza_inv");
            $txt_NombreNaturaleza      = "NULL";
            $txt_DescripcionNaturaleza = "NULL";
            $user                      = "1";

            if ($this->NaturalezaInversion_Model->EliminarNaturalezaInversion($flat, $txt_IdNaturaleza, $txt_NombreNaturaleza) == true) {
                echo "Se actualizó  ";
            } else {
                echo "No Se actualizó ";
            }

        } else {
            show_404();
        }

    }

//UPDATE TABLA naturaleza inversion

    public function UpdateNaturalezaInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "U";
            // $ID   = "0";
            $txt_IdNaturalezaM          = $this->input->post("txt_IdNaturalezaM");
            $txt_NombreNaturalezaM      = $this->input->post("txt_NombreNaturalezaM");
            $txt_DescripcionNaturalezaM = $this->input->post("txt_DescripcionNaturalezaM");
            $user                       = "1";

            if ($this->NaturalezaInversion_Model->UpdateNaturalezaInversion($flat, $txt_IdNaturalezaM, $txt_NombreNaturalezaM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }

    //REGISTRAR NUEVA NATURALEZA INVERSION
    public function AddNaturalezaInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                      = "C";
            $ID                        = "0";
            $txt_NombreNaturaleza      = $this->input->post("txt_NombreNaturaleza");
            $txt_DescripcionNaturaleza = $this->input->post("txt_DescripcionNaturaleza");
            $user                      = "1";
            if ($this->NaturalezaInversion_Model->AddNaturalezaInversion($flat, $ID, $txt_NombreNaturaleza) == false) {
                echo "1";
            } else {
                echo "2";
            }

        } else {
            show_404();
        }

    }

//------------------------------------------------------------------------------------------------------------------
    public function get_TipologiaInversion() //mostra TIPOLOGIA INVERSION

    {

        if ($this->input->is_ajax_request()) {
            $flat = "R";
            // $ID   = "0";
            $txt_IdTipologiaInversion          = $this->input->post("txt_IdTipologiaInversion");
            $txt_NombreTipologiaInversion      = $this->input->post("txt_NombreTipologiaInversion");
            $txt_DescripcionTipologiaInversion = $this->input->post("txt_DescripcionTipologiaInversion");
            $user                              = "1";

            $datos = $this->TipologiaInversion_Model->get_TipologiaInversion($flat, $txt_IdTipologiaInversion, $txt_NombreTipologiaInversion);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    //REGISTRAR NUEVA TIPOLOGIA DE INVERSION
    public function AddTipologiaInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                              = "C";
            $txt_IdTipologiaInversion          = "0";
            $txt_NombreTipologiaInversion      = $this->input->post("txt_NombreTipologiaInversion");
            $txt_DescripcionTipologiaInversion = $this->input->post("txt_DescripcionTipologiaInversion");
            $user                              = "1";
            if ($this->TipologiaInversion_Model->AddTipologiaInversion($flat, $txt_IdTipologiaInversion, $txt_NombreTipologiaInversion) == false) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            show_404();
        }

    }
    //ELIMINAR TABLA TIPOLOGIA inversion
    public function EliminarTipologiaInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "D";
            // $ID   = "0";
            $txt_IdTipologiaInversion     = $this->input->post("id_tipologia_inv");
            $txt_NombreTipologiaInversion = "NULL";
            if ($this->TipologiaInversion_Model->EliminarTipologiaInversion($flat, $txt_IdTipologiaInversion, $txt_NombreTipologiaInversion) == false) {
                echo "Se Eliminó  ";
            } else {
                echo "No se Eliminó ";
            }

        } else {
            show_404();
        }

    }
    //ACTUALIZAR NUEVA TIPO INVERSION
    public function UpdateTipologiaInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                               = "U";
            $txt_IdTipologiaInversionM          = $this->input->post("txt_IdTipologiaInversionM");
            $txt_NombreTipologiaInversionM      = $this->input->post("txt_NombreTipologiaInversionM");
            $txt_DescripcionTipologiaInversionM = $this->input->post("txt_DescripcionTipologiaInversionM");
            $user                               = "1";
            if ($this->TipologiaInversion_Model->UpdateTipologiaInversion($flat, $txt_IdTipologiaInversionM, $txt_NombreTipologiaInversionM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }

//------------------------------------------------------------------------------------------------------------------

    public function get_TipoInversion() //mostra TIPO INVERSION

    {

        if ($this->input->is_ajax_request()) {
            $flat = "R";
            // $ID   = "0";
            $txt_IdTipoInversion          = $this->input->post("txt_IdTipoInversion");
            $txt_NombreTipoInversion      = $this->input->post("txt_NombreTipoInversion");
            $txt_DescripcionTipoInversion = $this->input->post("txt_DescripcionTipoInversion");
            $user                         = "1";

            $datos = $this->TipoInversion_Model->get_TipoInversion($flat, $txt_IdTipoInversion, $txt_NombreTipoInversion, $txt_DescripcionTipoInversion);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    //REGISTRAR NUEVA
    public function AddTipoInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                         = "C";
            $txt_IdTipoInversion          = "0";
            $txt_NombreTipoInversion      = $this->input->post("txt_NombreTipoInversion");
            $txt_DescripcionTipoInversion = $this->input->post("txt_DescripcionTipoInversion");
            $user                         = "1";
            if ($this->TipoInversion_Model->AddTipoInversion($flat, $txt_IdTipoInversion, $txt_NombreTipoInversion, $txt_DescripcionTipoInversion) == false) {
                echo "1";
            } else {
                echo "2";
            }

        } else {
            show_404();
        }

    }
    //ELIMINAR  tipo inversion
    public function EliminarTipoInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "D";
            // $ID   = "0";
            $txt_IdTipoInversion          = $this->input->post("id_tipo_inversion");
            $txt_NombreTipoInversion      = "NULL";
            $txt_DescripcionTipoInversion = "NULL";

            if ($this->TipoInversion_Model->EliminarTipoInversion($flat, $txt_IdTipoInversion, $txt_NombreTipoInversion, $txt_DescripcionTipoInversion) == false) {
                echo "Se Eliminó  ";
            } else {
                echo "No se Eliminó ";
            }

        } else {
            show_404();
        }

    }
    //ACTUALIZAR NUEVA
    public function UpdateTipoInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                          = "U";
            $txt_IdTipoInversionM          = $this->input->post("txt_IdTipoInversionM");
            $txt_NombreTipoInversionM      = $this->input->post("txt_NombreTipoInversionM");
            $txt_DescripcionTipoInversionM = $this->input->post("txt_DescripcionTipoInversionM");
            $user                          = "1";
            if ($this->TipoInversion_Model->UpdateTipoInversion($flat, $txt_IdTipoInversionM, $txt_NombreTipoInversionM, $txt_DescripcionTipoInversionM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }

//------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------

    public function get_EstadoCicloInversion() //mostra ESTADO INVERSION

    {

        if ($this->input->is_ajax_request()) {
            $flat = "R";
            // $ID   = "0";
            $txt_IdEstadoCicloInversion          = $this->input->post("txt_IdEstadoCicloInversion");
            $txt_NombreEstadoCicloInversion      = $this->input->post("txt_NombreEstadoCicloInversion");
            $txt_DescripcionEstadoCicloInversion = $this->input->post("txt_DescripcionEstadoCicloInversion");
            $user                                = "1";

            $datos = $this->EstadoCicloInversion_Model->get_EstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    //REGISTRAR NUEVA
    public function AddEstadoCicloInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                                = "C";
            $txt_IdEstadoCicloInversion          = "0";
            $txt_NombreEstadoCicloInversion      = $this->input->post("txt_NombreEstadoCicloInversion");
            $txt_DescripcionEstadoCicloInversion = $this->input->post("txt_DescripcionEstadoCicloInversion");
            $user                                = "1";
            if ($this->EstadoCicloInversion_Model->AddEstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion) == false) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            show_404();
        }

    }
    //ELIMINAR  ciclo inversion
    public function EliminarEstadoCicloInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "D";
            // $ID   = "0";
            $txt_IdEstadoCicloInversion          = $this->input->post("IDCICLOINVERSION");
            $txt_NombreEstadoCicloInversion      = "NULL";
            $txt_DescripcionEstadoCicloInversion = "NULL";
            $user                                = "1";

            if ($this->EstadoCicloInversion_Model->EliminarEstadoCicloInversion($flat, $txt_IdEstadoCicloInversion, $txt_NombreEstadoCicloInversion, $txt_DescripcionEstadoCicloInversion) == false) {
                echo "Se Eliminó  ";
            } else {
                echo "No se Eliminó ";
            }
        } else {
            show_404();
        }

    }
    //ACTUALIZAR NUEVA
    public function UpdateEstadoCicloInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat                                 = "U";
            $txt_IdEstadoCicloInversionM          = $this->input->post("txt_IdEstadoCicloInversionM");
            $txt_NombreEstadoCicloInversionM      = $this->input->post("txt_NombreEstadoCicloInversionM");
            $txt_DescripcionEstadoCicloInversionM = $this->input->post("txt_DescripcionEstadoCicloInversionM");
            $user                                 = "1";
            if ($this->EstadoCicloInversion_Model->UpdateEstadoCicloInversion($flat, $txt_IdEstadoCicloInversionM, $txt_NombreEstadoCicloInversionM, $txt_DescripcionEstadoCicloInversionM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }

//------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------

    public function get_NivelGobierno() //mostra nivel de gobierno

    {

        if ($this->input->is_ajax_request()) {
            $flat = "R";
            // $ID   = "0";
            $txt_IdNivelGobierno          = $this->input->post("txt_IdNivelGobierno");
            $txt_NombreNivelGobierno      = $this->input->post("txt_NombreNivelGobierno");
            $txt_DescripcionNivelGobierno = $this->input->post("txt_DescripcionNivelGobierno");
            $user                         = "1";

            $datos = $this->NivelGobierno_Model->get_NivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno, $txt_DescripcionNivelGobierno);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    //REGISTRAR NUEVA
    public function AddNivelGobierno()
    {
        if ($this->input->is_ajax_request()) {
            $flat                         = "C";
            $txt_IdNivelGobierno          = "0";
            $txt_NombreNivelGobierno      = $this->input->post("txt_NombreNivelGobierno");
            $txt_DescripcionNivelGobierno = $this->input->post("txt_DescripcionNivelGobierno");
            $user                         = "1";
            if ($this->NivelGobierno_Model->AddNivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno, $txt_DescripcionNivelGobierno) == false) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            show_404();
        }

    }
    //ELIMINAR  nivel Gobierno
    public function EliminarNivelGobierno()
    {
        if ($this->input->is_ajax_request()) {
            $flat = "D";
            // $ID   = "0";
            $txt_IdNivelGobierno          = $this->input->post("IDNIVELGOB");
            $txt_NombreNivelGobierno      = "NULL";
            $txt_DescripcionNivelGobierno = "NULL";
            $user                         = "1";

            if ($this->NivelGobierno_Model->EliminarNivelGobierno($flat, $txt_IdNivelGobierno, $txt_NombreNivelGobierno, $txt_DescripcionNivelGobierno) == false) {
                echo "Se Eliminó  ";
            } else {
                echo "No se Eliminó ";
            }
        } else {
            show_404();
        }

    }
    //ACTUALIZAR NUEVA
    public function UpdateNivelGobierno()
    {
        if ($this->input->is_ajax_request()) {
            $flat                          = "U";
            $txt_IdNivelGobiernoM          = $this->input->post("txt_IdNivelGobiernoM");
            $txt_NombreNivelGobiernoM      = $this->input->post("txt_NombreNivelGobiernoM");
            $txt_DescripcionNivelGobiernoM = $this->input->post("txt_DescripcionNivelGobiernoM");
            $user                          = "1";
            if ($this->NivelGobierno_Model->UpdateNivelGobierno($flat, $txt_IdNivelGobiernoM, $txt_NombreNivelGobiernoM, $txt_DescripcionNivelGobiernoM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }

//------------------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    public function get_FuenteFinanciamiento() //mostra fuente financiamietno

    {

        if ($this->input->is_ajax_request()) {
            $flat = "R";
            // $ID   = "0";
            $txt_IdFuenteFinanciamiento          = $this->input->post("txt_IdFuenteFinanciamiento");
            $txt_IdRubroEjecucion                = $this->input->post("txt_IdRubroEjecucion");
            $txt_NombreFuenteFinanciamiento      = $this->input->post("txt_NombreFuenteFinanciamiento");
            $txt_AcronimoFuenteFinanciamiento    = $this->input->post("txt_AcronimoFuenteFinanciamiento");
            $txt_DescripcionFuenteFinanciamiento = $this->input->post("txt_DescripcionFuenteFinanciamiento");
            $user                                = "1";

            $datos = $this->FuenteFinanciamiento_Model->get_FuenteFinanciamiento($flat, $txt_IdFuenteFinanciamiento, $txt_IdRubroEjecucion, $txt_NombreFuenteFinanciamiento, $txt_AcronimoFuenteFinanciamiento, $txt_DescripcionFuenteFinanciamiento);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    //REGISTRAR NUEVA
    public function AddFuenteFinanciamiento()
    {
        if ($this->input->is_ajax_request()) {
            $flat                                = "C";
            $txt_IdFuenteFinanciamiento          = "0";
            $txt_IdRubroEjecucion                = $this->input->post("cbxRubroEjecucion");
            $txt_NombreFuenteFinanciamiento      = $this->input->post("txt_NombreFuenteFinanciamiento");
            $txt_AcronimoFuenteFinanciamiento    = $this->input->post("txt_AcronimoFuenteFinanciamiento");
            $txt_DescripcionFuenteFinanciamiento = $this->input->post("txt_DescripcionFuenteFinanciamiento");
            $user                                = "1";
            if ($this->FuenteFinanciamiento_Model->AddFuenteFinanciamiento($flat, $txt_IdFuenteFinanciamiento, $txt_IdRubroEjecucion, $txt_NombreFuenteFinanciamiento, $txt_AcronimoFuenteFinanciamiento, $txt_DescripcionFuenteFinanciamiento) == false) {
                echo "1";
            } else {
                echo "2";
            }

        } else {
            show_404();
        }

    }
    //ELIMINAR  fuente Financiamiento
    public function EliminarFuenteFinanciamiento()
    {
        if ($this->input->is_ajax_request()) {
            $flat                                = "D";
            $txt_IdFuenteFinanciamiento          = $this->input->post("idffto");
            $txt_IdRubroEjecucion                = $this->input->post("id_rubro_ejec");
            $txt_NombreFuenteFinanciamiento      = "NULL";
            $txt_AcronimoFuenteFinanciamiento    = "NULL";
            $txt_DescripcionFuenteFinanciamiento = "NULL";
            $user                                = "1";

            if ($this->FuenteFinanciamiento_Model->EliminarFuenteFinanciamiento($flat, $txt_IdFuenteFinanciamiento, $txt_IdRubroEjecucion, $txt_NombreFuenteFinanciamiento, $txt_AcronimoFuenteFinanciamiento, $txt_DescripcionFuenteFinanciamiento) == false) {
                echo "Se Eliminó  ";
            } else {
                echo "No se Eliminó ";
            }

        } else {
            show_404();
        }

    }

    //ACTUALIZAR NUEVA
    public function UpdateFuenteFinanciamiento()
    {
        if ($this->input->is_ajax_request()) {
            $flat                                 = "U";
            $txt_IdFuenteFinanciamientoM          = $this->input->post("txt_IdFuenteFinanciamientoM");
            $txt_IdRubroEjecucionM                = $this->input->post("cbxRubroEjecucionM");
            $txt_NombreFuenteFinanciamientoM      = $this->input->post("txt_NombreFuenteFinanciamientoM");
            $txt_AcronimoFuenteFinanciamientoM    = $this->input->post("txt_AcronimoFuenteFinanciamientoM");
            $txt_DescripcionFuenteFinanciamientoM = $this->input->post("txt_DescripcionFuenteFinanciamientoM");
            $user                                 = "1";
            if ($this->FuenteFinanciamiento_Model->UpdateFuenteFinanciamiento($flat, $txt_IdFuenteFinanciamientoM, $txt_IdRubroEjecucionM, $txt_NombreFuenteFinanciamientoM, $txt_AcronimoFuenteFinanciamientoM, $txt_DescripcionFuenteFinanciamientoM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }

//---------------------------------------------------------------------------------------------------------
    //tipo no pip
    //---------------------------------------------------------------------------------------------------------

    /* funcion de mi tabla*/
    public function get_tipo_no_pip()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->TipoNoPip_Model->get_tipo_no_pip();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    //REGISTRAR NUEVO TIPO DE NO PIP
    public function AddTipoNoPip()
    {
        if ($this->input->is_ajax_request()) {
            $flat                     = "C";
            $ID                       = "0";
            $txt_DescripcionTipoNoPip = $this->input->post("txt_DescripcionTipoNoPip");
            if ($this->TipoNoPip_Model->AddTipoNoPip($flat, $ID, $txt_DescripcionTipoNoPip) == false) {
                echo "1";
            } else {
                echo "2";
            }

        } else {
            show_404();
        }

    }
    //ACTUALIZAR TIPO NO PIP
    public function UpdateTipoNoPip()
    {
        if ($this->input->is_ajax_request()) {
            $flat                      = "U";
            $txt_IdTipoNoPipM          = $this->input->post("txt_IdTipoNoPipM");
            $txt_DescripcionTipoNoPipM = $this->input->post("txt_DescripcionTipoNoPipM");
            if ($this->TipoNoPip_Model->UpdateTipoNoPip($flat, $txt_IdTipoNoPipM, $txt_DescripcionTipoNoPipM) == false) {
                echo "Se actualizó  ";
            } else {
                echo "No se actualizó ";
            }

        } else {
            show_404();
        }

    }
    //ELIMINAR  TIPO NO PIP
    public function EliminarTipoNoPip()
    {
        if ($this->input->is_ajax_request()) {
            $flat          = "D";
            $id_tipo_nopip = $this->input->post("id_tipo_nopip");
            if ($this->TipoNoPip_Model->EliminarTipoNoPip($flat, $id_tipo_nopip) == false) {
                echo "Se Eliminó  ";
            } else {
                echo "No se Eliminó ";
            }
        } else {
            show_404();
        }

    }

//------------------------------------------------------------------------------------------------------------------

    public function ReporteListadoPipTipologia()
    {
        $listaNumPipTipologia=$this->TipologiaInversion_Model->TipologiaPipListar();
        $listaResumenPipTipologia=$this->TipologiaInversion_Model->TipologiaPipListarResumen();
        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/TipologiaInversion/index',['listaNumPipTipologia'=>$listaNumPipTipologia,'listaResumenPipTipologia'=>$listaResumenPipTipologia]);
        $this->load->view('layout/Reportes/footer');
    }

    public function _load_layout($template)
    {
        $this->load->view('layout/Administracion/header');
        $this->load->view($template);
        $this->load->view('layout/Administracion/footer');
    }

}
