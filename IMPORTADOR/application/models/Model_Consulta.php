<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Model_Consulta extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validacionAct_proy($CodigoUnico) //act_proy
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select ano_eje, act_proy, tipo_act_proy, nombre, estado, ambito, es_presupuestal, sector_snip, naturaleza_snip, intervencion_snip, tipo_proyecto, proyecto_snip,
                  ambito_en, es_foniprel, ambito_programa, es_generico, costo_actual, costo_expediente, costo_viabilidad, ejecucion_ano_anterior, ind_viabilidad
                  FROM   act_proy_nombre
                  WHERE  (val(act_proy) = val('" . $CodigoUnico . "'))");
                return $data->result();
    }

    public function ActividadProyectNombrei($CodigoUnico) //act_proy
    {

        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select ano_eje,act_proy,tipo_act_proy,nombre,estado,ambito,es_presupuestal,sector_snip,naturaleza_snip,intervencion_snip,tipo_proyecto,proyecto_snip,ambito_en,es_foniprel,ambito_programa,es_generico,costo_actual,costo_expediente,costo_viabilidad,ejecucion_ano_anterior,ind_viabilidad FROM act_proy_nombre
                 where val(act_proy) = val('" . $CodigoUnico . "') ");
        return $data->result();
    }

    public function proyecto_snip_nombre($CodigoUnico) //proyecto_snip_nombre
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("SELECT DISTINCT proyecto_snip_nombre.proyecto_snip, proyecto_snip_nombre.nombre, proyecto_snip_nombre.codigo_literal, proyecto_snip_nombre.tipo_proyecto
          FROM            proyecto_snip_nombre, act_proy_nombre
          WHERE        val(proyecto_snip_nombre.proyecto_snip) = val(act_proy_nombre.proyecto_snip) AND (act_proy_nombre.act_proy = '".$CodigoUnico."')");
        return $data->result();
    }

    public function meta($CodigoUnico) //meta
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select ano_eje, sec_ejec, sec_func, funcion, programa, sub_programa, act_proy, componente, meta, finalidad, nombre, monto, cantidad, unidad_med, departamento,
                         provincia, fecha_ing, usuario_ing, fecha_mod, usuario_mod, estado, distrito, unidad_medida, cantidad_inicial, unidad_medida_inicial, es_pia, cantidad_semestral,
                         cantidad_semestral_inicial, estrategia_nacional, programa_ppto, cantidad_trimestral_01, cantidad_trimestral_01_inicial, cantidad_trimestral_03,
                         cantidad_trimestral_03_inicial
             FROM  meta WHERE  val(act_proy) = val('" . $CodigoUnico . "')");

        return $data->result();
    }

    public function gastos($CodigoUnico) //proyecto_snip_nombre
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select gasto.ano_eje, gasto.sec_ejec, gasto.origen, gasto.fuente_financ, gasto.tipo_recurso, gasto.sec_func, gasto.categ_gasto, gasto.grupo_gasto,
                         gasto.modalidad_gasto, gasto.elemento_gasto, gasto.presupuesto, gasto.m01, gasto.m02, gasto.m03, gasto.m04, gasto.m05, gasto.m06, gasto.m07, gasto.m08,
                         gasto.m09, gasto.m10, gasto.m11, gasto.m12, gasto.modificacion, gasto.ejecucion, gasto.monto_a_solicitado, gasto.monto_de_solicitado, gasto.ampliacion,
                         gasto.credito, gasto.id_clasificador, gasto.monto_financ1, gasto.monto_financ2, gasto.compromiso, gasto.devengado, gasto.girado, gasto.pagado,
                         gasto.monto_certificado, gasto.monto_comprometido_anual, gasto.monto_precertificado
             FROM    gasto, meta
             WHERE   gasto.ano_eje = meta.ano_eje AND gasto.sec_ejec = meta.sec_ejec AND gasto.sec_func = meta.sec_func AND val(meta.act_proy) = val('" . $CodigoUnico . "') AND (val(gasto.sec_ejec) = 300251)");

        return $data->result();
    }

    public function gastosAcumulados($CodigoUnico)
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select DISTINCT gasto_acumulado.*
                FROM    gasto, meta, gasto_acumulado
                WHERE  gasto.ano_eje = meta.ano_eje AND gasto.sec_ejec = meta.sec_ejec AND gasto.sec_func = meta.sec_func AND gasto.ano_eje = gasto_acumulado.ano_eje AND
                           gasto.sec_ejec = gasto_acumulado.sec_ejec AND gasto.origen = gasto_acumulado.origen AND gasto.fuente_financ = gasto_acumulado.fuente_financ AND
                           gasto.tipo_recurso = gasto_acumulado.tipo_recurso AND gasto.sec_func = gasto_acumulado.sec_func AND val(meta.act_proy) = val('" . $CodigoUnico . "')  AND val(gasto.sec_ejec) = 300251");

        return $data->result();
    }

    public function ejecucion_mpp($CodigoUnico)
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select DISTINCT ejecucion_mpp.*
                  FROM            ejecucion_mpp, meta
                  WHERE        ejecucion_mpp.ano_eje = meta.ano_eje AND ejecucion_mpp.sec_ejec = meta.sec_ejec AND ejecucion_mpp.sec_func = meta.sec_func AND
                  (meta.act_proy = '" . $CodigoUnico . "') AND val(meta.sec_ejec) = 300251");
        return $data->result();
    }

    public function expediente($ano_eje, $expediente, $sec_ejec)
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select * 
                  from expediente where expediente like '%".$expediente."' and ano_eje = '".$ano_eje."' and sec_ejec LIKE '".$sec_ejec."'");
        return $data->result();
    }

    public function expediente_nota($ano_eje, $expediente, $sec_ejec)
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select * 
                  from expediente_nota where expediente like '%".$expediente."' and ano_eje = '".$ano_eje."' and sec_ejec LIKE '".$sec_ejec."'");
        return $data->result();
    }

    public function expediente_fase($ano_eje, $expediente, $sec_ejec)
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select * 
                  from expediente_fase where expediente like '%".$expediente."' and ano_eje = '".$ano_eje."' and sec_ejec LIKE '".$sec_ejec."'");
        return $data->result();
    }

    public function expediente_secuencia($ano_eje, $expediente, $sec_ejec)
    {
        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select * 
                  from expediente_secuencia where expediente like '%".$expediente."' and ano_eje = '".$ano_eje."' and sec_ejec LIKE '".$sec_ejec."'");
        return $data->result();
    }

    public function importar($CodigoUnico)
    {

        $db_prueba = $this->load->database('SIAF', true);
        $data      = $db_prueba->query("select * FROM act_proy_nombre WHERE (val(act_proy) = val('" . $CodigoUnico . "')) ");
        return $data->result();
    }

    //--------------------------------------------------------------------------------------------------------//

    public function EliminarDataSIAFLocal($CodigoUnico)
    {
        $db_prueba = $this->load->database('DBSIAF', true); //@codigo_snip es codigo_siaf
        $data      = $db_prueba->query("exec sp_Gestionar_SIAF @opcion='eliminar_datos_proyecto',@codigo_snip='" . $CodigoUnico . "'");
        return true;
    }

    //impostar data nueva
    public function insert_snip_nombre($proyecto_snip, $nombre, $codigo_literal, $tipo_proyecto) //proyecto_snip_nombre

    {

        $db_prueba = $this->load->database('DBSIAF', true);
        $data      = $db_prueba->query("insert into proyecto_snip_nombre (proyecto_snip,nombre,codigo_literal,tipo_proyecto) values($proyecto_snip,'$nombre','$codigo_literal','$tipo_proyecto')");
        return true;
    }

    public function insert_act_proy($ano_eje, $act_proy, $tipo_act_proy, $nombre, $estado, $ambito, $es_presupuestal, $sector_snip, $naturaleza_snip, $intervencion_snip, $tipo_proyecto, $proyecto_snip, $ambito_en, $es_foniprel, $ambito_programa, $es_generico, $costo_actual, $costo_expediente, $costo_viabilidad, $ejecucion_ano_anterior, $ind_viabilidad) //ac_proy

    {

        $db_prueba = $this->load->database('DBSIAF', true);
        $data      = $db_prueba->query("insert into act_proy_nombre (ano_eje,act_proy,tipo_act_proy,nombre,estado,ambito,es_presupuestal,sector_snip,naturaleza_snip,intervencion_snip,tipo_proyecto,proyecto_snip,ambito_en,es_foniprel,ambito_programa,es_generico,costo_actual,costo_expediente,costo_viabilidad,ejecucion_ano_anterior,ind_viabilidad)
                                 values('$ano_eje','$act_proy','$tipo_act_proy','$nombre','$estado','$ambito','$es_presupuestal','$sector_snip','$naturaleza_snip','$intervencion_snip','$tipo_proyecto','$proyecto_snip','$ambito_en','$es_foniprel','$ambito_programa','$es_generico',$costo_actual,$costo_expediente,$costo_viabilidad,$ejecucion_ano_anterior,'$ind_viabilidad')");
        return true;
    }

    public function insert_Meta($ano_eje, $sec_ejec, $sec_func, $funcion, $programa, $sub_programa, $act_proy, $componente, $meta, $finalidad, $nombre, $monto, $cantidad, $unidad_med, $departamento,
        $provincia, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $estado, $distrito, $unidad_medida, $cantidad_inicial, $unidad_medida_inicial, $es_pia, $cantidad_semestral,
        $cantidad_semestral_inicial, $estrategia_nacional, $programa_ppto, $cantidad_trimestral_01, $cantidad_trimestral_01_inicial, $cantidad_trimestral_03,
        $cantidad_trimestral_03_inicial) //meta
    {

        $db_prueba = $this->load->database('DBSIAF', true);
        $data      = $db_prueba->query("insert into meta (ano_eje, sec_ejec, sec_func, funcion, programa, sub_programa, act_proy, componente, meta, finalidad, nombre, monto, cantidad, unidad_med, departamento,
                                       provincia, fecha_ing, usuario_ing, fecha_mod, usuario_mod, estado, distrito, unidad_medida, cantidad_inicial, unidad_medida_inicial, es_pia, cantidad_semestral,
                                       cantidad_semestral_inicial, estrategia_nacional, programa_ppto, cantidad_trimestral_01, cantidad_trimestral_01_inicial, cantidad_trimestral_03,
                                       cantidad_trimestral_03_inicial) values ('$ano_eje', '$sec_ejec', '$sec_func', '$funcion', '$programa', '$sub_programa', '$act_proy', '$componente', '$meta', '$finalidad', '$nombre', $monto, $cantidad, '$unidad_med', '$departamento',
                                                          '$provincia', '$fecha_ing', '$usuario_ing', '$fecha_mod', '$usuario_mod', '$estado', '$distrito', '$unidad_medida', $cantidad_inicial, '$unidad_medida_inicial', '$es_pia', $cantidad_semestral,
                                                          $cantidad_semestral_inicial, '$estrategia_nacional', '$programa_ppto', $cantidad_trimestral_01, $cantidad_trimestral_01_inicial, $cantidad_trimestral_03,
                                                          $cantidad_trimestral_03_inicial)");
        return true;
    }
    public function insert_Gasto($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso, $sec_func, $categ_gasto, $grupo_gasto,
        $modalidad_gasto, $elemento_gasto, $presupuesto, $m01, $m02, $m03, $m04, $m05, $m06, $m07, $m08,
        $m09, $m10, $m11, $m12, $modificacion, $ejecucion, $monto_a_solicitado, $monto_de_solicitado, $ampliacion,
        $credito, $id_clasificador, $monto_financ1, $monto_financ2, $compromiso, $devengado, $girado, $pagado,
        $monto_certificado, $monto_comprometido_anual, $monto_precertificado) {

        $db_prueba = $this->load->database('DBSIAF', true);
        $data      = $db_prueba->query("insert into gasto (ano_eje, sec_ejec, origen, fuente_financ, tipo_recurso, sec_func, categ_gasto, grupo_gasto, modalidad_gasto, elemento_gasto,
                           presupuesto, m01, m02, m03, m04, m05, m06, m07, m08, m09, m10, m11, m12, modificacion, ejecucion, monto_a_solicitado, monto_de_solicitado,
                           ampliacion, credito, id_clasificador, monto_financ1, monto_financ2, compromiso, devengado, girado, pagado, monto_certificado, monto_comprometido_anual,
                           monto_precertificado)  values ('$ano_eje', '$sec_ejec', '$origen', '$fuente_financ', '$tipo_recurso', '$sec_func', '$categ_gasto','$grupo_gasto',
                                   '$modalidad_gasto', '$elemento_gasto', $presupuesto, $m01, $m02, $m03, $m04, $m05, $m06, $m07, $m08,$m09, $m10, $m11, $m12, $modificacion, $ejecucion,
                                   $monto_a_solicitado, $monto_de_solicitado, $ampliacion,$credito,'$id_clasificador', $monto_financ1, $monto_financ2, $compromiso, $devengado,
                                   $girado, $pagado,$monto_certificado, $monto_comprometido_anual, $monto_precertificado)");
        return true;
    }

    public function insert_Gasto_acumulado($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso, $sec_func, $categ_gasto, $grupo_gasto,
        $modalidad_gasto, $elemento_gasto, $mes, $trimestre, $programacion, $calendario, $ejecucion,
        $monto_a_aprobado, $monto_a_solicitado, $monto_a_interno, $monto_de_aprobado,
        $monto_de_solicitado, $monto_de_interno, $archivo, $calendario_ampliacion,
        $calendario_actualizacion, $calendario_ampliacion_dst, $calendario_flexible, $id_clasificador,
        $pptm, $compromiso, $devengado, $girado, $pagado) {

        $db_prueba = $this->load->database('DBSIAF', true);
        $data      = $db_prueba->query("INSERT into gasto_acumulado (ano_eje, sec_ejec, origen, fuente_financ, tipo_recurso,sec_func, categ_gasto, grupo_gasto,
                          modalidad_gasto, elemento_gasto, mes, trimestre, programacion, calendario, ejecucion,
                                      monto_a_aprobado, monto_a_solicitado, monto_a_interno, monto_de_aprobado,
                                      monto_de_solicitado, monto_de_interno, archivo, calendario_ampliacion,
                                      calendario_actualizacion, calendario_ampliacion_dst, calendario_flexible, id_clasificador,
                                      pptm, compromiso, devengado, girado, pagado)  values ('$ano_eje', '$sec_ejec', '$origen', '$fuente_financ', '$tipo_recurso','$sec_func', '$categ_gasto', '$grupo_gasto',
                          '$modalidad_gasto', '$elemento_gasto', '$mes', '$trimestre', $programacion, $calendario, $ejecucion,
                                      $monto_a_aprobado, $monto_a_solicitado, $monto_a_interno, $monto_de_aprobado,
                                      $monto_de_solicitado, $monto_de_interno, '$archivo', $calendario_ampliacion,
                                      $calendario_actualizacion, $calendario_ampliacion_dst, $calendario_flexible, '$id_clasificador',$pptm, $compromiso, $devengado, $girado, $pagado) ");
        return true;
    }

    public function insert_ejecucion_mpp($ano_eje
        , $sec_ejec
        , $mes_eje
        , $ciclo
        , $origen
        , $fuente_financ
        , $tipo_recurso
        , $clasificador
        , $sec_func
        , $ejecucion
        , $anulacion
        , $estado
        , $estado_envio
        , $cod_error
        , $cod_mensa
        , $id_clasificador
        , $compromiso
        , $devengado
        , $girado
        , $pagado
        , $comprometido_anual
        , $certificado) {

        $db_prueba = $this->load->database('DBSIAF', true);
        $data      = $db_prueba->query("INSERT INTO ejecucion_mpp
           ([ano_eje]
           ,[sec_ejec]
           ,[mes_eje]
           ,[ciclo]
           ,[origen]
           ,[fuente_financ]
           ,[tipo_recurso]
           ,[clasificador]
           ,[sec_func]
           ,[ejecucion]
           ,[anulacion]
           ,[estado]
           ,[estado_envio]
           ,[cod_error]
           ,[cod_mensa]
           ,[id_clasificador]
           ,[compromiso]
           ,[devengado]
           ,[girado]
           ,[pagado]
           ,[comprometido_anual]
           ,[certificado])
     VALUES
           ('$ano_eje'
           ,'$sec_ejec'
           ,'$mes_eje'
           ,'$ciclo'
           ,'$origen'
           ,'$fuente_financ'
           ,'$tipo_recurso'
           ,'$clasificador'
           ,'$sec_func'
           ,'$ejecucion'
           ,'$anulacion'
           ,'$estado'
           ,'$estado_envio'
           ,'$cod_error'
           ,'$cod_mensa'
           ,'$id_clasificador'
           ,'$compromiso'
           ,'$devengado'
           ,'$girado'
           ,'$pagado'
           ,'$comprometido_anual'
           ,'$certificado' )");
        return true;
    }

}
