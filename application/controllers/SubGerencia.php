<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubGerencia extends CI_Controller
{/* Mantenimiento de sector entidad Y servicio publico asociado*/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_SubGerencia');
    }

    public function index()
	{
		$this->_load_layout('Front/Administracion/frmGerencia.php');
	}

    function GetSubGerencia()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_SubGerencia->GetSubGerencia();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    function AddSubGerencia()
    {
        if ($this->input->is_ajax_request()) {
            //$txt_id_gerencia = $this->input->post("txt_id_gerencia");
            $txt_denominacion_subgerencia = $this->input->post("txt_denom_subgerencia");
            $opcion_gerencia = $this->input->post("listaGerenciaC");

            if ($this->Model_SubGerencia->AddSubGerencia($opcion_gerencia, $txt_denominacion_subgerencia) == true)
                echo "Se añadio una Sub Gerencia";
            else
                echo "Se añadio  una Sub Gerencia";
        } else {
            show_404();
        }
    }

    function UpdateSubGerencia()
    {
        if ($this->input->is_ajax_request()) {
            $txt_id_subgerencia = $this->input->post("txt_id_subgerencia_m");
            $txt_id_gerencia = $this->input->post("listaGerenciaCM");
            $txt_denominacion_gerencia = $this->input->post("txt_denom_subgerencia_m");

            if ($this->Model_SubGerencia->UpdateSubGerencia($txt_id_subgerencia, $txt_id_gerencia, $txt_denominacion_gerencia) == true)
                echo "Se actualizao  Sub Gerencia";
            else
                echo "Se actualizo Sub Gerencia";
        } else {
            show_404();
        }

    }
    function EliminarSubGerencia(){
        if ($this->input->is_ajax_request()) {
            $flag=0;
            $msg="";
            $id_subgerencia = $this->input->post("id_subgerencia");

        if($this->Model_SubGerencia->EliminarSubGerencia($id_subgerencia)==true){
                $flag=0;
                $msg="registro Eliminado Satisfactoriamente";
            }
            else{
                $flag=1;
                $msg="No se pudo eliminar";
            }
                    $datos['flag']=$flag;
                    $datos['msg']=$msg;
                    echo json_encode($datos);
        }  else {
            show_404();
        }

    }
    function _load_layout($template)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template);
        $this->load->view('layout/ADMINISTRACION/footer');
    }

     function GetSubGerenciaId()
    {
        if ($this->input->is_ajax_request())
        {
            $id_gerencia=$this->input->post('id_gerencia');
            $datos=$this->Model_SubGerencia->SubgerenciaPorGerencia($id_gerencia);
            echo json_encode($datos);exit;
        }
        else
        {
          show_404();
        }

    }

    function listarMeta()
    {
        if ($this->input->is_ajax_request()) {
            $anio_meta=$this->input->post('anio_meta');
            $sec_ejec=$this->input->post('sec_ejec');
            $datosM = $this->Model_SubGerencia->listarMeta($anio_meta,$sec_ejec);
            echo json_encode($datosM);
        } else {
            show_404();
        }
    }

     public function listar_metas_subgerencia()
    {
        if ($this->input->is_ajax_request())
        {
            $id_subgerencia = $this->input->post("id_subgerencia");
            $anio_meta = $this->input->post("anio_meta");
            $data  = $this->Model_SubGerencia->listar_metas_subgerencia($id_subgerencia,$anio_meta);
            if($data == false)
            {
                echo json_encode(array('data' => $data));
            }
            else
            {
                echo json_encode(array('data' => $data));
            }
        }
        else
        {
            show_404();
        }
    }
    function cargarMeta()
    {
        $sec_func=$this->input->post('sec_func');
        $anio_meta=$this->input->post('anio_meta');
        $sec_ejec=$this->input->post('sec_ejec');
        $datos = $this->Model_SubGerencia->cargarMeta($sec_func,$anio_meta,$sec_ejec);
        if(count($datos)>0)
        {
            echo json_encode($datos[0]);
        }    
        else
        {
            echo json_encode(['flag'=>0]);
        }    
    }
    function insertarMeta()
    {
        if($_POST)
        {
            $msg = array();
            $c_data['id_subgerencia']=$this->input->post("txt_id_subgerencia");
            $c_data['ano_eje']=$this->input->post("txtAniometaSG");
            $c_data['sec_func']=$this->input->post("listarMetaSG");
            $c_data['finalidad']=$this->input->post("txt_finalidadSG");
            $c_data['act_proy']=$this->input->post("txt_act_proySG");
            $q1 = $this->Model_SubGerencia->insertarMeta($this->security->xss_clean($c_data));               
            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
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
        $data = $this->Model_SubGerencia->eliminarMeta($this->input->post("id_subgerenciameta"));
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron eliminados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

}
