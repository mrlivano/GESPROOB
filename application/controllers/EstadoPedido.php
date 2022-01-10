<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadoPedido extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();
      $this->load->model('Model_Control');
      $this->load->model('Model_UsuarioControl');
      $this->load->model('Model_Estado_Pedido');
    }

    public function register()
    {
      if ($this->input->is_ajax_request())
  		{
          $msg = array();
          $nombreArchivo = trim(addslashes($_FILES['exampleFormControlFile1']['name']));

          $path_parts = pathinfo($nombreArchivo);

          $nombreArchivo = str_replace(' ', '_', $path_parts['filename']. '_' .date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $path_parts['extension'] );

    				$c_data['nro_pedido']= $this->input->post("inputOrder");
    				$c_data['oficina']= $this->input->post("inputOffice");
            $c_data['id_responsable'] = $this->input->post("inputResponsable");
            $c_data['estado'] = $this->input->post("inputStatus");
            $c_data['descripcion'] = $this->input->post("exampleFormControlTextarea1");
            $c_data['documento'] = $nombreArchivo;

    				$ultimoId = $this->Model_Estado_Pedido->insertOrderStatus($c_data);

            if($nombreArchivo != '' || $nombreArchivo != null)
            {
                    $config['upload_path'] = './uploads/EstadoPedido/';
                    $config['allowed_types'] = '*';
                    //$config['max_width']     = 1024;
        				    //$config['max_height']    = 768;
        				    $config['file_name'] = $nombreArchivo;
        				    $config['max_size'] = '20048';
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('exampleFormControlFile1'))
                    {
                        $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                        $this->load->view('front/json/json_view',['datos' => $msg]);
                        return;
                    }
            }

    				$msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
    				$this->load->view('front/json/json_view', ['datos' => $msg]);
  		}
  		else
  		{
  				show_404();
  		}
    }

    function historialPedidoEstado()
    {
      if ($this->input->is_ajax_request())
      {
        $c_data['nro_pedido'] = $this->input->post("inputOrder");

        $historialPedidoEstado=$this->Model_Estado_Pedido->historialPedidoEstado($c_data['nro_pedido']);

        $this->load->view('front/Reporte/ProyectoInversion/estadoPedido',['historialPedidoEstado'=>$historialPedidoEstado]);
      }

    }
}
