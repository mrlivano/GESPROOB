<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerencia extends CI_Controller
{/* Mantenimiento de sector entidad Y servicio publico asociado*/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Gerencia');
        $this->load->model('Model_OficinaR');
    }

    public function index()
	{
		 $listaInsumoNivel1 = $this->Model_OficinaR->listaOficinaNivel1(1);
            foreach ($listaInsumoNivel1 as $key => $value) 
            {
                $value->hasChild = ($value->n==0 ? false : true);
            }
        $unidadejecutora='001549';
        $lista_ue = $this->db->query("select * from unidad_ejecutora");
        if($lista_ue->num_rows()>0){
            $result_ue = $lista_ue->result();
        }
        $this->_load_layout('Front/Administracion/frmGerencia.php',['listaNivel1' => $listaInsumoNivel1,'unidadejecutora' => $unidadejecutora,'lista_ue' => $result_ue]);
	}
    function GetGerencia()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Gerencia->GetGerencia();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    function GetListaGerencia()
    {
        if ($this->input->is_ajax_request())
        {
            $datos=$this->Model_Gerencia->GetListaGerencia();
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }

    function AddGerencia()
    {
         if ($this->input->is_ajax_request()) {
            $txt_denominacion_gerencia = $this->input->post("txt_denominacion_gerencia");
             $opcion_unidad_ejecutora= $this->input->post("listaUnidadEjecutora");
            if ($this->Model_Gerencia->AddGerencia($txt_denominacion_gerencia, $opcion_unidad_ejecutora) == true)
                echo "Se añadio una Gerencia";
            else
                echo "Se añadio  una Gerencia";
        } else {
            show_404();
        }
    }

    //modifcar funcion

    function UpdateGerencia()
    {
        if ($this->input->is_ajax_request()) {
            $txt_id_gerencia = $this->input->post("txt_id_gerencia_m");
            $txt_denominacion_gerencia = $this->input->post("txt_denom_gerencia_m");
            $id_unidad_ejecutora = $this->input->post("listaUnidadEjecutoraM");
            if ($this->Model_Gerencia->UpdateGerencia($txt_id_gerencia, $txt_denominacion_gerencia,$id_unidad_ejecutora) == true)
                echo "Se actualizo  Gerencia";
            else
                echo "Se actualizo Gerencia";
        } else {
            show_404();
        }

    }

    function EliminarGerencia(){
        if ($this->input->is_ajax_request()) {
            $flag=0;
            $msg="";
            $id_gerencia = $this->input->post("id_gerencia");

        if($this->Model_Gerencia->EliminarGerencia($id_gerencia)==true){
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

    function _load_layout($template,$variable)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template,$variable);
        $this->load->view('layout/ADMINISTRACION/footer');
    }


    function GetGerenciaId()
    {
        if ($this->input->is_ajax_request())
        {
            $id_ue=$this->input->post('id_ue');
            $datos=$this->Model_Gerencia->GerenciaPorUnidadE($id_ue);
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
            $datosM = $this->Model_Gerencia->listarMeta($anio_meta,$sec_ejec);
            echo json_encode($datosM);
        } else {
            show_404();
        }
    }

     public function listar_metas_gerencia()
    {
        if ($this->input->is_ajax_request())
        {
            $id_gerencia = $this->input->post("id_gerencia");
            $anio_meta = $this->input->post("anio_meta");
            $data  = $this->Model_Gerencia->listar_metas_gerencia($id_gerencia,$anio_meta);
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
        $datos = $this->Model_Gerencia->cargarMeta($sec_func,$anio_meta,$sec_ejec);
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
            $c_data['id_gerencia']=$this->input->post("txt_id_gerencia");
            $c_data['ano_eje']=$this->input->post("txtAniometaG");
            $c_data['sec_func']=$this->input->post("listarMetaG");
            $c_data['finalidad']=$this->input->post("txt_finalidadG");
            $c_data['act_proy']=$this->input->post("txt_act_proyG");
            $q1 = $this->Model_Gerencia->insertarMeta($this->security->xss_clean($c_data));               
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
        $data = $this->Model_Gerencia->eliminarMeta($this->input->post("id_gerenciameta"));
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron eliminados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    //OFICINA R

}
