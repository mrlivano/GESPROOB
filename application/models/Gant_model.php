<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Gant_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetEntregable($id_etapa_estudio)
    {
        //listar los entregables filtrado por la etapa de estudio.
        $cargo  = $this->db->query("execute sp_Listar_Entregable'" . $id_etapa_estudio . "'");
        $array1 = $cargo->result();
        //listar las actividadas por cada entregable
        $array2 = array();
        foreach ($array1 as $cr) {
            $id   = $cr->id;
            $hijo = $this->db->query("
                select ACTIVIDAD_CRONOGRAMA.id_act as id ,max(nombre_act) as 'text' ,
                MAX(CONVERT(VARCHAR(11),fecha_inicio, 105)) as 'start_date',
                MAX(DATEDIFF(DAY,CONVERT(date, fecha_inicio, 105),
                CONVERT(date, fecha_final, 105))) AS 'duration',
                max(id_entregable) as 'parent',max(avance/100) as 'progress' ,
                'True' AS 'open'
                from ACTIVIDAD_CRONOGRAMA LEFT OUTER JOIN RESPONSABLE_ACTIVIDAD
                ON RESPONSABLE_ACTIVIDAD.id_act=ACTIVIDAD_CRONOGRAMA.id_act
                LEFT OUTER JOIN PERSONA ON PERSONA.id_persona=RESPONSABLE_ACTIVIDAD.id_persona where id_entregable = '" . $id . "' GROUP BY ACTIVIDAD_CRONOGRAMA.id_act");
            $array_tmp = $hijo->result();
            $array2    = array_merge($array2, $array_tmp);
            // var_dump($array_tmp);
        }
        $array_r = array_merge($array1, $array2);
        return ($array_r);
    }
    public function GetLink($id_etapa_estudio)
    {
        //listar las relaciones los entregables con las actividades
        $Links = $this->db->query("select ACTIVIDAD_CRONOGRAMA.id_act as 'id',ENTREGABLE_ESTUDIO.id_entregable as 'source' ,
                ACTIVIDAD_CRONOGRAMA.id_act as 'target','1' AS 'type'
                from ENTREGABLE_ESTUDIO inner join ACTIVIDAD_CRONOGRAMA
                on ENTREGABLE_ESTUDIO.id_entregable=ACTIVIDAD_CRONOGRAMA.id_entregable
                where  ENTREGABLE_ESTUDIO.id_etapa_estudio='" . $id_etapa_estudio . "'");
        $arraylinks = $Links->result();
        return ($arraylinks);
    }

}
