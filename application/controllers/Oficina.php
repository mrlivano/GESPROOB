<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oficina extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Oficina');
    }

    public function index()
    {
        $this->_load_layout('Front/Administracion/frmGerencia.php');
    }

    function GetOficina()
    {
        if ($this->input->is_ajax_request()) {
            $ListarOficina = $this->Model_Oficina->ListaOficina();
            echo json_encode($ListarOficina);
        } else {
            show_404();
        }
    }
    function AddOficina()
    {
        if ($this->input->is_ajax_request()) {
            //$txt_id_oficina = $this->input->post("txt_id_oficina");
            $txt_id_subgerencia = $this->input->post("listaSubGerencia");
            $txt_denom_oficina = $this->input->post("txt_denom_oficina");
            if ($this->Model_Oficina->AddOficina($txt_id_subgerencia, $txt_denom_oficina) == true)
                echo "Se añadio una Oficina";
            else
                echo "Se añadio  una Oficina";
        } else {
            show_404();
        }
    }
    //modifcar funcion

    function UpdateOficina()
    {
        if ($this->input->is_ajax_request()) {
            $txt_id_oficina = $this->input->post("txt_id_oficina_m");
            $txt_id_subgerencia = $this->input->post("listaSubGerenciaM");
            $txt_denominacion_oficina = $this->input->post("txt_denom_oficina_m");
            if ($this->Model_Oficina->UpdateOficina($txt_id_oficina, $txt_id_subgerencia, $txt_denominacion_oficina) == true)
                echo "Se actualizao  oficina";
            else
                echo "Se actualizo oficina";
        } else {
            show_404();
        }
    }
    function EliminarOficina()
    {
        if ($this->input->is_ajax_request()) {
            $flag = 0;
            $msg = "";
            $id_oficina = $this->input->post("id_oficina");

            if ($this->Model_Oficina->EliminarOficina($id_oficina) == true) {
                $flag = 0;
                $msg = "registro Eliminado Satisfactoriamente";
            } else {
                $flag = 1;
                $msg = "No se pudo eliminar";
            }
            $datos['flag'] = $flag;
            $datos['msg'] = $msg;
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    function _load_layout($template)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template);
        $this->load->view('layout/ADMINISTRACION/footer');
    }
    function GetOficinaId()
    {
        if ($this->input->is_ajax_request()) {
            $id_subgerencia = $this->input->post('id_subgerencia');
            $datos = $this->Model_Oficina->GetOficinaId($id_subgerencia);
            echo json_encode($datos);
            exit;
        } else {
            show_404();
        }
    }

    function listarMeta()
    {
        if ($this->input->is_ajax_request()) {
            $anio_meta = $this->input->post('anio_meta');
            $sec_ejec = $this->input->post('sec_ejec');
            $datosM = $this->Model_Oficina->listarMeta($anio_meta, $sec_ejec);
            echo json_encode($datosM);
        } else {
            show_404();
        }
    }

    public function listar_metas_oficina()
    {
        if ($this->input->is_ajax_request()) {
            $id_oficina = $this->input->post("id_oficina");
            $anio_meta = $this->input->post("anio_meta");
            $data  = $this->Model_Oficina->listar_metas_oficina($id_oficina, $anio_meta);
            if ($data == false) {
                echo json_encode(array('data' => $data));
            } else {
                echo json_encode(array('data' => $data));
            }
        } else {
            show_404();
        }
    }
    function cargarMeta()
    {
        $sec_func = $this->input->post('sec_func');
        $anio_meta = $this->input->post('anio_meta');
        $sec_ejec = $this->input->post('sec_ejec');
        $datos = $this->Model_Oficina->cargarMeta($sec_func, $anio_meta, $sec_ejec);
        if (count($datos) > 0) {
            echo json_encode($datos[0]);
        } else {
            echo json_encode(['flag' => 0]);
        }
    }
    function insertarMeta()
    {
        if ($_POST) {
            $msg = array();
            $c_data['id_oficina'] = $this->input->post("txt_id_oficina");
            $c_data['ano_eje'] = $this->input->post("txtAniometa");
            $c_data['sec_func'] = $this->input->post("listarMetaO");
            $c_data['finalidad'] = $this->input->post("txt_finalidad");
            $c_data['act_proy'] = $this->input->post("txt_act_proy");
            $q1 = $this->Model_Oficina->insertarMeta($this->security->xss_clean($c_data));
            $msg = ($q1 > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);
            exit;
        }
        /* if($_GET)
        {
            $idProyecto=$this->input->get('codigo');
            $proyectoInversion=$this->Model_ProyectoInversion->getProyectoInversionPorIdPi($idProyecto);    
            $metaPresupuestal=$this->Model_MetaPresupuestal->ListaMetaPresupuestal();
            $this->load->view('front/Pmi/ProyectoInversion/metapresupuestal', ['proyectoInversion'=>$proyectoInversion,'metaPresupuestal'=>$metaPresupuestal]);
        } */
    }
    function eliminarMeta()
    {
        $msg = array();
        $data = $this->Model_Oficina->eliminarMeta($this->input->post("id_oficinameta"));
        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron eliminados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);
        exit;
    }
}
