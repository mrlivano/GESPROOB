<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_MonitoreoResultado extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mo_Producto');
        $this->load->model('Model_Mo_Actividad');
        $this->load->model('Model_Mo_Monitoreo');
        $this->load->model('Model_Mo_Observacion');
        $this->load->model('Model_Mo_Compromiso');
        $this->load->model('Model_Mo_Bandeja_Monitoreo');
        $this->load->model('Model_Personal');
        $this->load->helper('FormatNumber_helper');
    }

    function index()
    {
        $proyecto = $this->Model_Mo_Producto->ProyectoPorId($this->input->get('id_pi'));
        $producto = $this->Model_Mo_Producto->listaProducto($this->input->get('id_pi'));       

        foreach ($producto as $key => $value) 
        {
            $value->childActividad=$this->Model_Mo_Actividad->listaActividad($value->id_producto);
        }        
        
        $this->load->view('front/Monitoreo/Mo_ResultadoMonitoreo/index', ['proyecto' => $proyecto,'producto'=>$producto]);
    }

    function verresultado()
    {
        $monitoreo=($this->input->get('opcion')=='producto' ? $this->Model_Mo_Monitoreo->listaMonitoreoProducto($this->input->get('idProducto')) : $this->Model_Mo_Monitoreo->listaMonitoreoActividad($this->input->get('idActividad')));        

        foreach ($monitoreo as $key => $value) 
        {
            $value->childObservacion=$this->Model_Mo_Observacion->listaObservacion($value->id_monitoreo);
            $value->childCompromiso=$this->Model_Mo_Compromiso->listaCompromiso($value->id_monitoreo);
            $value->archivos='';
            if($value->url_documento!='')
            {
                $value->archivos = explode(",", $value->url_documento);
            }
                        
        }

        $descripcion=$this->input->get('descripcion');

        $hdIdProducto=($this->input->get('opcion')=='producto' ? $this->input->get('idProducto') : NULL);
        $hdIdActividad=(!$this->input->get('opcion')=='producto' ? NULL : $this->input->get('idActividad'));
        $this->load->view('front/Monitoreo/Mo_ResultadoMonitoreo/resultado',['monitoreo' => $monitoreo, 'hdIdProducto'=>$hdIdProducto, 'hdIdActividad'=>$hdIdActividad, 'descripcion'=>$descripcion,'hdIdProyecto'=>$this->input->get('idProyectoMonitoreo')]);
    }
    
    function insertar()
    {
        if($_POST)
        {
            $msg = array();

            $c_data['desc_monitoreo'] = $this->input->post('txtResultado');
            $c_data['fecha_registro'] = $this->input->post('txtFechaRegistro');
            $c_data['id_producto'] = ($this->input->post('hdIdProducto')=='' ? NULL : $this->input->post('hdIdProducto'));
            $c_data['id_actividad'] = ($this->input->post('hdIdActividad')=='' ? NULL : $this->input->post('hdIdActividad'));
            $fecha=date('d/m/Y');

            $this->db->trans_start();

            $data = $this->Model_Mo_Monitoreo->insertar($c_data); 

            $personal = $this->Model_Personal->personaId($this->session->userdata('idPersona'));
            $u_data['id_usuario'] = $this->session->userdata('idPersona');
            $u_data['fecha_registro'] = date('Y-m-d h:i:s');
            $u_data['id_pi'] = $this->input->post('hdIdProyectoMonitoreo');
            $u_data['visto'] = 0;
            if($this->input->post('hdIdProducto')!='')
            {
                $u_data['mensaje'] = $personal->nombres.' '.$personal->apellido_p.' '.$personal->apellido_m.' agregó resultado de monitoreo al Producto: '.$this->input->post('hdDescripcionMonitoreo');
            }
            else
            {
                $u_data['mensaje'] = $personal->nombres.' '.$personal->apellido_p.' '.$personal->apellido_m.' agregó resultado de monitoreo a la Actividad: '.$this->input->post('hdDescripcionMonitoreo');
            } 
            $this->Model_Mo_Bandeja_Monitoreo->insertar($u_data);       

            $this->db->trans_complete();      

            $msg = ($data > 0 ? (['proceso'=>'Correcto', 'mensaje'=>'los datos fueron registrados correctamente', 'idMonitoreo'=>$data,'fecha'=>$fecha]) : (['proceso' =>'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }
    }

    function editar()
    {
        if($_POST)
        {
            $msg = array();

            $c_data['desc_monitoreo'] = $this->input->post('descripcionMonitoreo');
            $c_data['fecha_modificacion'] = date('Y-m-d');

            $data = $this->Model_Mo_Monitoreo->editar($c_data, $this->input->post('idMonitoreo'));            
            $msg = ($data > 0 ? (['proceso'=>'Correcto', 'mensaje'=>'los datos fueron registrados correctamente']) : (['proceso' =>'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }
    }

    function eliminar()
    {
        $msg = array();
        $data = $this->Model_Mo_Monitoreo->eliminar($this->input->post('idMonitoreo'));
        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'el registro fue eliminado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function adjuntarDocumento()
    {
        if($_POST)
        {
            $config['upload_path'] = './uploads/DocumentoMonitoreo/';
            $config['allowed_types'] = '*';
            $config['file_name'] = 'DMO_';
            $config['max_size'] = '20048';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileArchivo'))
            {
                $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                echo json_encode($msg);exit;
            }

            $url= $this->upload->data('file_name'); 
            $idMonitoreo=$this->input->post('hdIdMonitoreo');

            $resultado=$this->Model_Mo_Monitoreo->monitoreoPorId($idMonitoreo);
            $c_data['url_documento'] = $url;
            if($resultado[0]->url_documento!='')
            {
                $c_data['url_documento'] = $resultado[0]->url_documento.','.$url;
            }
            
            $data = $this->Model_Mo_Monitoreo->editar($c_data,$idMonitoreo);

            $msg = ($data > 0 ? (['proceso'=>'Correcto', 'mensaje'=>'el archivo ha sido guardado orrectamente', 'urlDocumento'=>$url]) : (['proceso' =>'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;

        }

        $idMonitoreo = $this->input->get('idMonitoreo');
        $this->load->view('front/Monitoreo/Mo_ResultadoMonitoreo/insertarDocumento',['idMonitoreo' => $idMonitoreo]); 
    }

    function eliminarArchivo()
    {
        $msg = array();

        $nombreArchivo=$this->input->post('nombreArchivo');
        $idMonitoreo=$this->input->post('idMonitoreo');

        if (file_exists("uploads/DocumentoMonitoreo/".$nombreArchivo))
        {
            unlink("uploads/DocumentoMonitoreo/".$nombreArchivo);
        }
        
        $resultado=$this->Model_Mo_Monitoreo->monitoreoPorId($idMonitoreo);
        $resultado[0]->url_documento=str_replace($nombreArchivo,'',$resultado[0]->url_documento);
        $resultado[0]->url_documento=str_replace(',,','',$resultado[0]->url_documento);

        $c_data['url_documento'] = $resultado[0]->url_documento;
        $data = $this->Model_Mo_Monitoreo->editar($c_data,$idMonitoreo);

        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'el registro fue eliminado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }
}
