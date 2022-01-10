<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Estado_Pedido extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function getOrderStatus($data)
    {
        $data = $this->db->query("select TOP 1 * FROM ESTADO_PEDIDO WHERE nro_pedido = ".$data." ORDER BY id_estado_pedido DESC");

        if (isset($data->result()[0]) == null) {
          return false;
        } else {
          return $data->result()[0];  
        }
    }

		public function insertOrderStatus($data)
    {
        $this->db->insert('ESTADO_PEDIDO', $data);
        return $this->db->insert_id();
    }

    public function updateOrderStatus($data)
    {
      $nro_pedido = $data['nro_pedido'];
      $data = array(
        'oficina' => $data['oficina'],
        'id_responsable' => $data['id_responsable'],
        'estado' => $data['estado'],
        'descripcion' => $data['descripcion'],
        'documento' => $data['documento'],
        'timestamp' => $data['timestamp']
      );

      $this->db->where('nro_pedido', $nro_pedido);
      $this->db->update('ESTADO_PEDIDO', $data);
    }

    public function searchOrderStatus($data)
    {
      $nro_pedido = $data['nro_pedido'];

      $this->db->select('nro_pedido')->from('ESTADO_PEDIDO')->where('nro_pedido', $nro_pedido);

	    $query = $this->db->get();

	    if ($query->num_rows() > 0) {
        return true;
	    }
	    return false;
    }

    public function historialPedidoEstado($nropedido)
    {
      $this->db->select('*')->from('ESTADO_PEDIDO')->where('nro_pedido', $nropedido);

      $query = $this->db->get();

      if ($query->num_rows() > 0) {
          return $query->result_array();
      }
      return false;
    }

}
