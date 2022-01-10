<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Liquidacion extends CI_Controller {

  public function __construct()
  {
      parent::__construct();
      $this->load->model('Liquidacion_Model');
  }

  public function index()
  {
      $this->_load_layout('Front/Administracion/frmLiquidacion');
  }

  public function AddLiquidacion()
  {
      if ($this->input->is_ajax_request())
      {
          $msg=array();

          $c_data['descripcion']=$this->input->post("txt_descripcion");

          $query = $this->Liquidacion_Model->AddLiquidacion($c_data);

          if ($query>0)
          {
              $msg = (['proceso' => 'Correcto', 'mensaje' => 'El registro fue guardado correctamente ']);
          }
          else
          {
              $msg = (['proceso' => 'Error', 'mensaje' => 'ha ocurrido un error inesperado.']);

          }
          $this->load->view('front/json/json_view', ['datos' => $msg]);
      }
      else
      {
          show_404();
      }
  }

  public function editarLiquidacion()
  {
      if ($this->input->is_ajax_request())
      {
          $msg = array();

          $u_data['descripcion']= $this->input->post("txt_descripcion_m");
          $data = $this->Liquidacion_Model->editarLiquidacion($this->input->post("txt_id_descripcion"),$u_data);

          $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron editados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
          $this->load->view('front/json/json_view', ['datos' => $msg]);
      }
      else
      {
          show_404();
      }

  }

  public function listar_liquidacion()
  {
      if ($this->input->is_ajax_request()) {
          $datos = $this->Liquidacion_Model->listar_liquidacion();
          echo json_encode($datos);
      } else {
          show_404();
      }
  }

  public function Eliminar_liquidacion()
  {
      if ($this->input->is_ajax_request()) {
          $id_descripcion = $this->input->post("id_descripcion");
          if ($this->Liquidacion_Model->Eliminar_liquidacion($id_descripcion) == true) {
              echo "Se Eliminó  ";
          } else {
              echo "No se Eliminó ";
          }
      } else {
          show_404();
      }

  }

  public function Products()
  {
    $id_pl = $_GET['id_pl'];
    $mod = isset($_GET['mod']) ? $_GET['mod'] : null;

    if ($mod == "update") {

      $data = json_decode($_GET['models'], true);
      $id_d_pl = $data[0]["id_liq_det_preliquidacion"];
      $estado = $data[0]["estado"];

      $this->Liquidacion_Model->updatePreliquidacionDoc($id_d_pl, $estado);

    } else {

      $datos = $this->Liquidacion_Model->listar_pre_liquidacion($id_pl);
      echo json_encode($datos);

    }

  }

  public function _load_layout($template)
  {
      $this->load->view('layout/Administracion/header');
      $this->load->view($template);
      $this->load->view('layout/Administracion/footer');
      $this->load->view('Front/Administracion/js/jsLiquidacion.php');
  }

}
