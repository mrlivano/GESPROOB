<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OficinaR extends CI_Controller
{/* Mantenimiento de sector entidad Y servicio publico asociado*/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_OficinaR');
    }

    public function index()
	{
        $this->_load_layout('Front/Administracion/frmGerencia.php');
	}

    public function cargarNivel()
    {
        $id_oficina=$this->input->post('id_oficina');
        $data=$this->Model_OficinaR->listaOficinaporNivel($id_oficina);

        foreach($data as $key => $value)
        {
            $value->hasChild=($value->n==0 ? false : true);
        }
        echo json_encode($data);exit;
    }
    
    function EliminarOficinaR(){
        if ($this->input->is_ajax_request()) {
            $flag=0;
            $msg="";
            $id_oficina = $this->input->post("id_oficina");

        if($this->Model_OficinaR->EliminarOficinaR($id_oficina)==true){
                echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Registro Eliminado correctamente.']);
            }
            else{
                echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se pudo Elimininar.']);
            }
              
        }  else {
            echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se pudo Elimininar.']);
        }

    }

  function UpdateOficinaR()
    {
        if ($this->input->is_ajax_request()) {
            $txt_id_oficinaR = $this->input->post("id_oficina");
            $txt_denominacion_oficinaR = $this->input->post("denom_oficina");
            if ($this->Model_OficinaR->UpdateOficinaR($txt_id_oficinaR,$txt_denominacion_oficinaR) == true)
                echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Registro Actualizado correctamente.']);
            else
                 echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se pudo Actualizar']);
        } else {
             echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se pudo Actualizar.']);
        }

    }

 function InsertarOficinaR()
    {
        if ($this->input->is_ajax_request()) {
            $txt_id_oficinaR = $this->input->post("id_oficina");
            $txt_denominacion_oficinaR = $this->input->post("denom_oficina");
            $txt_id_ue = $this->input->post("id_ue");
            if ($this->Model_OficinaR->InsertarOficinaR($txt_id_oficinaR,$txt_denominacion_oficinaR,$txt_id_ue) == true)
                echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Registro Ingresado correctamente.']);
            else
                 echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se pudo Registrar']);
        } else {
             echo json_encode(['proceso' => 'Error', 'mensaje' => 'No se pudo Registrar.']);
        }

    }
 function insertarMeta()
    {
        if($_POST)
        {
            $msg = array();
            $c_data['id_oficinaR']=$this->input->post("txt_id_oficina");
            $c_data['ano_eje']=$this->input->post("txtAniometa");
            $c_data['sec_func']=$this->input->post("listarMetaO");
            $c_data['finalidad']=$this->input->post("txt_finalidad");
            $c_data['act_proy']=$this->input->post("txt_act_proy");
            $q1 = $this->Model_OficinaR->insertarMeta($this->security->xss_clean($c_data));               
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

public function listar_metas_oficina()
    {
        if ($this->input->is_ajax_request())
        {
            $id_oficina = $this->input->post("id_oficina");
            $anio_meta = $this->input->post("anio_meta");
            $data  = $this->Model_OficinaR->listar_metas_oficina($id_oficina,$anio_meta);
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




     function eliminarMeta()
    {
        $msg = array();
        $data = $this->Model_OficinaR->eliminarMeta($this->input->post("id_oficinameta"));
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron eliminados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function listarMeta()
    {
        if ($this->input->is_ajax_request()) {
            $anio_meta=$this->input->post('anio_meta');
            $sec_ejec=$this->input->post('sec_ejec');
            $datosM = $this->Model_OficinaR->listarMeta($anio_meta,$sec_ejec);
            echo json_encode($datosM);
        } else {
            show_404();
        }
    }

   function cargarMeta()
    {
        $sec_func=$this->input->post('sec_func');
        $anio_meta=$this->input->post('anio_meta');
        $sec_ejec=$this->input->post('sec_ejec');
        $datos = $this->Model_OficinaR->cargarMeta($sec_func,$anio_meta,$sec_ejec);
        if(count($datos)>0)
        {
            echo json_encode($datos[0]);
        }    
        else
        {
            echo json_encode(['flag'=>0]);
        }    
    }


  function ListaNivel1(){
         $id_ue=$this->input->post('id_ue');
        $data=$this->Model_OficinaR->listaOficinaNivel1($id_ue);

        foreach($data as $key => $value)
        {
            $value->hasChild=($value->n==0 ? false : true);
        }
        echo json_encode($data);exit;
    }





   

    function _load_layout($template)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template);
        $this->load->view('layout/ADMINISTRACION/footer');
    }


    


}
