<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function login($usuario, $password)
	{
        $this->db->select('*');
        $this->db->from('USUARIO');
        $this->db->join('USUARIO_TIPO', 'USUARIO_TIPO.id_usuario_tipo=USUARIO.id_usuario_tipo', 'INNER');
        $this->db->join('PERSONA', 'PERSONA.id_persona=USUARIO.id_persona', 'INNER');
        $this->db->where('usuario', $usuario);
        $this->db->where('contrasenia', $password);
        $this->db->where('activo', 1);
        return $this->db->get();
    }

    function recuperarMenu($usuario)
	{
        $query=$this->db->query("EXEC sp_recuperarMenuUsuario ".$usuario);
        $result=$query->result_array();
        return $result;
    }

    function RegistrarAcceso($data)
    {
        $this->db->insert('USUARIO_ACCESO',$data);
		return $this->db->affected_rows();
    }

    function estadisticaUso()
    {
        $query=$this->db->query("select top 10 FORMAT(fecha_acceso,'yyyy-MM') as anio, count(id_usuario_acceso) as num_visitas
        from USUARIO_ACCESO group by FORMAT(fecha_acceso,'yyyy-MM') order by FORMAT(fecha_acceso,'yyyy-MM') desc");
        return $query->result();
    }
}
