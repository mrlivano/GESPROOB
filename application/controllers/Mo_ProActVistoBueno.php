<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_ProActVistoBueno extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mo_Producto');
        $this->load->model('Model_Mo_Actividad');
        $this->load->model('Model_Mo_Programacion_Actividad');
        $this->load->model('Model_Mo_Act_Prog_Visto_Bueno');
        $this->load->model('Model_Mo_Bandeja_Monitoreo');
        $this->load->model('Model_Personal');
        $this->load->helper('FormatNumber_helper');
        $this->load->helper('file');
    }

    function index()
    {
        if($_POST)
        {

        }
        $idPi = $this->input->get('id_pi');
        $proyecto = $this->Model_Mo_Producto->ProyectoPorId($idPi);
        $producto = $this->Model_Mo_Producto->listaProducto($idPi);
        foreach ($producto as $key => $value)
        {
            $value->childActividad = $this->Model_Mo_Actividad->listaActividad($value->id_producto);
            foreach ($value->childActividad as $key => $actividad)
            {
                $actividad->childProgramacion = $this->Model_Mo_Programacion_Actividad->listaProgramacionActividad($actividad->id_actividad);
            }
        }

        $this->load->view('front/Monitoreo/Mo_ProductoActividadVistoBueno/index', ['proyecto' => $proyecto,'producto'=>$producto]);
    }

    function vistoBueno()
    {
        if($_POST)
        {
            $hdIdProducto = $this->input->post('idProducto');
            $hdIdActividad = $this->input->post('idActividad');

            $vistoBueno=($this->input->post('opcion')=='producto' ? $this->Model_Mo_Act_Prog_Visto_Bueno->ListaObservacionProducto($hdIdProducto) : $this->Model_Mo_Act_Prog_Visto_Bueno->ListaObservacionActividad($hdIdActividad));

            $descripcion = ($this->input->post('opcion')=='producto' ? $this->Model_Mo_Producto->ProductoId($hdIdProducto) : $this->Model_Mo_Actividad->actividadId($hdIdActividad));
            $vb=($descripcion->visto_bueno==1 ? 1 : 0);
            
            $descripcion=$this->input->post('descripcion');
            $hdIdProducto=($this->input->post('opcion')=='producto' ? $hdIdProducto : NULL);
            $hdIdActividad=(!$this->input->post('opcion')=='producto' ? NULL : $hdIdActividad);

            $this->load->view('front/Monitoreo/Mo_ProductoActividadVistoBueno/resultado',['vistoBueno' => $vistoBueno, 'hdIdProducto'=>$hdIdProducto, 'hdIdActividad'=>$hdIdActividad, 'descripcion'=>$descripcion, 'vbueno'=> $vb,'idProyecto'=> $this->input->post('idPi')]);
        }        
    }

    function insertar()
    {
        $msg = array();

        $nombreArchivo = $_FILES['fileArchivo']['name'];
        $c_data['desc_visto_bueno'] = $this->input->post('txtDescripcion');
        $url='';
        $c_data['url_documento'] = NULL;
        $c_data['id_producto'] = ($this->input->post('hdIdProducto')=='' ? NULL : $this->input->post('hdIdProducto'));
        $c_data['id_actividad'] = ($this->input->post('hdIdActividad')=='' ? NULL : $this->input->post('hdIdActividad'));

        $vistoBueno = ($this->input->post('vb')=='on'? true:false);    
        if($vistoBueno)
        {
            $personal = $this->Model_Personal->personaId($this->session->userdata('idPersona'));
            $u_data['id_usuario'] = $this->session->userdata('idPersona');
            $u_data['fecha_registro'] = date('Y-m-d h:i:s');
            $u_data['id_pi'] = $this->input->post('hdIdProyecto');
            $u_data['visto'] = 0;
            if($this->input->post('hdIdProducto')!='')
            {
                $u_data['mensaje'] = $personal->nombres.' '.$personal->apellido_p.' '.$personal->apellido_m.' dió visto bueno al Producto: '.$this->input->post('hdDescripcion');
            }
            else
            {
                $u_data['mensaje'] = $personal->nombres.' '.$personal->apellido_p.' '.$personal->apellido_m.' dió visto bueno a la Actividad: '.$this->input->post('hdDescripcion');
            } 
            $this->Model_Mo_Bandeja_Monitoreo->insertar($u_data);
        }    

        if($nombreArchivo != '' || $nombreArchivo != null)
        {
            $config['upload_path'] = './uploads/VistoBueno/';
            $config['allowed_types'] = '*';
            $config['file_name'] = 'ARC_';
            $config['max_size'] = '20048';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileArchivo'))
            {
                $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                echo json_encode($msg);exit;
            }
            $c_data['url_documento'] = $this->upload->data('file_name');  
            $url= $this->upload->data('file_name');      
        }

        $this->db->trans_start(); 

        $data = $this->Model_Mo_Act_Prog_Visto_Bueno->insertar($c_data);
        if($this->input->post('hdIdProducto')!='')
            $this->Model_Mo_Producto->editarVistoBueno($this->input->post('hdIdProducto'),$vistoBueno);
        if($this->input->post('hdIdActividad')!='')
            $this->Model_Mo_Actividad->editarVistoBueno($this->input->post('hdIdActividad'),$vistoBueno);

        $this->db->trans_complete();    


        $msg = ($data > 0 ? (['proceso'=>'Correcto', 'mensaje'=>'los datos fueron registrados correctamente', 'idVistoBueno'=>$data, 'urlDocumento'=>$url]) : (['proceso' =>'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;

    }

    function editar()
    {
        $msg = array();
        $c_data['desc_visto_bueno'] = $this->input->post('descripcionVistoBueno');
        $data = $this->Model_Mo_Act_Prog_Visto_Bueno->editar($c_data,$this->input->post('codigo'));
        $msg = ($data > 0 ? (['proceso'=>'Correcto', 'mensaje'=>'los cambios fueron guardados correctamente']) : (['proceso' =>'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function eliminar()
    {
        $msg = array();

        if($this->input->post('urlDocumento')!='')
        {
            if (file_exists("uploads/VistoBueno/".$this->input->post('urlDocumento')))
            {
                unlink("uploads/VistoBueno/".$this->input->post('urlDocumento'));
            }
        }        

        $data = $this->Model_Mo_Act_Prog_Visto_Bueno->eliminar($this->input->post('codigo'));
        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'el registro fue eliminado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }
}
