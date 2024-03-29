<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Persona_Juridica extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //division funcional
    public function GetPersonal($flat, $skip, $numberRow, $valueSearch)
    {
        $personal=$this->db->query("execute sp_GestionarPersonaJuridica '" . $flat . "', null, null, null, null, null, null, null, ".$skip.",".$numberRow.", '".$valueSearch."'");

        return $personal->result();
    }

    public function CountPersonalParaPaginacion($flat, $valueSearch)
    {
        $personal=$this->db->query("execute sp_GestionarPersonaJuridica '" . $flat . "', null, null, null, null, null, null, null, 0, 0, '".$valueSearch."'");//listar de division funcional

        return $personal->result();
    }

    public function addPersona($data)
    {
        $this->db->insert('PERSONA_JURIDICA',$data);
        return $this->db->affected_rows();
    }
    public function UpdatePersonal($data,$id_persona_juridica)
    {
        $this->db->set($data);
        $this->db->where('id_persona_juridica', $id_persona_juridica);
        $this->db->update('PERSONA_JURIDICA');
        return $this->db->affected_rows();
    }
    public function EliminarPersonal($id_persona_juridica)
    {
          $this->db->where('id_persona_juridica',$id_persona_juridica);
          $this->db->delete('PERSONA_JURIDICA');
          if($this->db->affected_rows()>0){
          return true;
          }
          else{
            return false;
          }
    }
    public function BuscarPersonaCargo($text_buscarPersona, $skip, $numberRow, $valueSearch)
    {
       $personalFormulador = $this->db->query("execute sp_PesonaCargo_r '".$text_buscarPersona."', ".$skip.", ".$numberRow.", '".$valueSearch."'"); //listar de division funcional

       return $personalFormulador->result();
    }
    public function CountPaginacionPersonaCargo($text_buscarPersona,$skip,$numberRow,$valueSearch)
    {
       $personalFormulador = $this->db->query("select count(*) as cantidad from PERSONA inner join ASIGNACION_PERSONA ON ASIGNACION_PERSONA.id_persona=PERSONA.id_persona INNER JOIN CARGO ON CARGO.id_cargo=ASIGNACION_PERSONA.id_cargo WHERE desc_cargo='".$text_buscarPersona."' and (nombres like '%'+'".$valueSearch."'+'%') "); //listar de division funcional
      return $personalFormulador->result();
    }
    public function CountPaginacionPersonaActividad($skip,$numberRow,$valueSearch)
    {
       $personalFormulador = $this->db->query("select count(*) as cantidad from PERSONA WHERE  (nombres like '%'+'".$valueSearch."'+'%') "); //listar de division funcional
      return $personalFormulador->result();
    }

    public function BuscarPersonaActividad($skip,$numberRow,$valueSearch){
       $persona = $this->db->query("execute sp_PersonaActividad_r '".$skip."','".$numberRow."','".$valueSearch."' ");
            return $persona->result();
    }

    public function BuscarPersona($text_buscarPersona)
    {
       $personal = $this->db->query("execute sp_BuscarPersona '".$text_buscarPersona."' "); //listar de division funcional
       if ($personal->num_rows() > 0) {
            return $personal->result();
        } else {
            return null;
        }
    }
    public function listarPersona()
    {
       $personal = $this->db->query("select id_persona_juridica,razon_social from PERSONA_JURIDICA");

        return $personal->result();

    }

    public function verTodo()
    {
        $personal = $this->db->query("select * from PERSONA");

        return $personal->result();
    }

    public function ResponsableExpediente($idExpedienteTecnico,$codigoTipoResponsable)
    {
        $responsable = $this->db->query("select ET_RESPONSABLE.*, PERSONA.*, E.nombre_esp from ET_RESPONSABLE INNER JOIN PERSONA ON ET_RESPONSABLE.id_persona=PERSONA.id_persona INNER JOIN ET_TIPO_RESPONSABLE on ET_RESPONSABLE.id_tipo_responsable_et=ET_TIPO_RESPONSABLE.id_tipo_responsable_et inner join ESPECIALIDAD E ON E.id_esp=PERSONA.id_esp where id_et='".$idExpedienteTecnico."' and codigo_tipo_responsable_et='".$codigoTipoResponsable."'");

        return $responsable->result();
    }

    public function ListarPersonalUsuario()
    {
        $personal = $this->db->query("select p.* from PERSONA p LEFT JOIN USUARIO u on u.id_persona=p.id_persona where U.id_persona IS NULL");
        //$personal = $this->db->query("select p.* from PERSONA");
        return $personal->result();
    }

    public function GetEspecilidad()
    {
         $especialidad = $this->db->query("select * from ESPECIALIDAD");
        return $especialidad->result();
    }

    function personaId($idPersona)
    {
        $this->db->select('persona.*');
        $this->db->from('persona');
        $this->db->where('persona.id_persona',$idPersona);
        return $this->db->get()->result()[0];
    }

    function verifyPersonalByRUC($ruc)
    {
        $this->db->select('persona_juridica.*');
        $this->db->from('persona_juridica');
        $this->db->where('persona_juridica.ruc',$ruc);
        return $this->db->get()->result();
    }
}
