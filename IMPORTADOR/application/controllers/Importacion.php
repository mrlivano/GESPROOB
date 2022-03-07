<?php
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, *");

defined('BASEPATH') or exit('No direct script access allowed');

class Importacion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Consulta");
        $this->load->model("Model_SeguimientoCertificado");
    }

    public function codigo($CodigoUnico=null)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['mensaje']   = '';
        $data['actualizo'] = false;
        $nombre_proyecto   = '';

        //$CodigoUnico = $this->input->POST('CodigoUnico');
        if (is_numeric($CodigoUnico)) 
        {

            //si existe CODIGO UNICO -> CONTINUAR//
            if (count($this->Model_Consulta->validacionAct_proy($CodigoUnico)) > 0) {
                //LIMPIAR BASE DE DATOS LOCAL
                $this->Model_Consulta->EliminarDataSIAFLocal($CodigoUnico); //Eliminando datos por proyecto

                $proyecto_snip_nombre_DATA = $this->Model_Consulta->proyecto_snip_nombre($CodigoUnico);
                $act_proy_nombre_DATA      = $this->Model_Consulta->ActividadProyectNombrei($CodigoUnico);
                $meta_DATA                 = $this->Model_Consulta->meta($CodigoUnico); //meta
                $gasto_DATA                = $this->Model_Consulta->gastos($CodigoUnico); //gasto
                $gasto_acumulado_DATA      = $this->Model_Consulta->gastosAcumulados($CodigoUnico);
                $ejecucion_mpp_DATA        = $this->Model_Consulta->ejecucion_mpp($CodigoUnico);

                try {
                    $this->db->trans_start();

                    foreach ($proyecto_snip_nombre_DATA as $itemp) {
                        $proyecto_snip   = $itemp->proyecto_snip;
                        $nombre          = $itemp->nombre;
                        $nombre_proyecto = $nombre; //asignando nombre para mostrar
                        $codigo_literal  = $itemp->codigo_literal;
                        $tipo_proyecto   = $itemp->tipo_proyecto;
                        $this->Model_Consulta->insert_snip_nombre($proyecto_snip, $nombre, $codigo_literal, $tipo_proyecto);
                    }
                    foreach ($act_proy_nombre_DATA as $itemp) {
                        $ano_eje                = $itemp->ano_eje;
                        $act_proy               = $itemp->act_proy;
                        $tipo_act_proy          = $itemp->tipo_act_proy;
                        $nombre                 = $itemp->nombre;
                        $estado                 = $itemp->estado;
                        $ambito                 = $itemp->ambito;
                        $es_presupuestal        = $itemp->es_presupuestal;
                        $sector_snip            = $itemp->sector_snip;
                        $naturaleza_snip        = $itemp->naturaleza_snip;
                        $intervencion_snip      = $itemp->intervencion_snip;
                        $tipo_proyecto          = $itemp->tipo_proyecto;
                        $proyecto_snip          = $itemp->proyecto_snip;
                        $ambito_en              = $itemp->ambito_en;
                        $es_foniprel            = $itemp->es_foniprel;
                        $ambito_programa        = $itemp->ambito_programa;
                        $es_generico            = $itemp->es_generico;
                        $costo_actual           = $itemp->costo_actual;
                        $costo_expediente       = $itemp->costo_expediente;
                        $costo_viabilidad       = $itemp->costo_viabilidad;
                        $ejecucion_ano_anterior = $itemp->ejecucion_ano_anterior;
                        $ind_viabilidad         = $itemp->ind_viabilidad;
                        $this->Model_Consulta->insert_act_proy($ano_eje, $act_proy, $tipo_act_proy, $nombre, $estado, $ambito, $es_presupuestal, $sector_snip, $naturaleza_snip, $intervencion_snip, $tipo_proyecto, $proyecto_snip, $ambito_en, $es_foniprel, $ambito_programa, $es_generico, $costo_actual, $costo_expediente, $costo_viabilidad, $ejecucion_ano_anterior, $ind_viabilidad);
                    }
                    //meta
                    foreach ($meta_DATA as $itemp) {
                        $ano_eje                        = $itemp->ano_eje;
                        $sec_ejec                       = $itemp->sec_ejec;
                        $sec_func                       = $itemp->sec_func;
                        $funcion                        = $itemp->funcion;
                        $programa                       = $itemp->programa;
                        $sub_programa                   = $itemp->sub_programa;
                        $act_proy                       = $itemp->act_proy;
                        $componente                     = $itemp->componente;
                        $meta                           = $itemp->meta;
                        $finalidad                      = $itemp->finalidad;
                        $nombre                         = $itemp->nombre;
                        $monto                          = $itemp->monto;
                        $cantidad                       = $itemp->cantidad;
                        $unidad_med                     = $itemp->unidad_med;
                        $departamento                   = $itemp->departamento;
                        $provincia                      = $itemp->provincia;
                        $fecha_ing                      = $itemp->fecha_ing;
                        $usuario_ing                    = $itemp->usuario_ing;
                        $fecha_mod                      = $itemp->fecha_mod;
                        $usuario_mod                    = $itemp->usuario_mod;
                        $estado                         = $itemp->estado;
                        $distrito                       = $itemp->distrito;
                        $unidad_medida                  = $itemp->unidad_medida;
                        $cantidad_inicial               = $itemp->cantidad_inicial;
                        $unidad_medida_inicial          = $itemp->unidad_medida_inicial;
                        $es_pia                         = $itemp->es_pia;
                        $cantidad_semestral             = $itemp->cantidad_semestral;
                        $cantidad_semestral_inicial     = $itemp->cantidad_semestral_inicial;
                        $estrategia_nacional            = $itemp->estrategia_nacional;
                        $programa_ppto                  = $itemp->programa_ppto;
                        $cantidad_trimestral_01         = $itemp->cantidad_trimestral_01;
                        $cantidad_trimestral_01_inicial = $itemp->cantidad_trimestral_01_inicial;
                        $cantidad_trimestral_03         = $itemp->cantidad_trimestral_03;
                        $cantidad_trimestral_03_inicial = $itemp->cantidad_trimestral_03_inicial;
                        $this->Model_Consulta->insert_Meta($ano_eje, $sec_ejec, $sec_func, $funcion, $programa, $sub_programa, $act_proy, $componente, $meta, $finalidad, $nombre, $monto, $cantidad, $unidad_med, $departamento,
                            $provincia, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $estado, $distrito, $unidad_medida, $cantidad_inicial, $unidad_medida_inicial, $es_pia, $cantidad_semestral,
                            $cantidad_semestral_inicial, $estrategia_nacional, $programa_ppto, $cantidad_trimestral_01, $cantidad_trimestral_01_inicial, $cantidad_trimestral_03,
                            $cantidad_trimestral_03_inicial);
                    }

                    foreach ($gasto_DATA as $itemp) {
                        $ano_eje                  = $itemp->ano_eje;
                        $sec_ejec                 = $itemp->sec_ejec;
                        $origen                   = $itemp->origen;
                        $fuente_financ            = $itemp->fuente_financ;
                        $tipo_recurso             = $itemp->tipo_recurso;
                        $sec_func                 = $itemp->sec_func;
                        $categ_gasto              = $itemp->categ_gasto;
                        $grupo_gasto              = $itemp->grupo_gasto;
                        $modalidad_gasto          = $itemp->modalidad_gasto;
                        $elemento_gasto           = $itemp->elemento_gasto;
                        $presupuesto              = $itemp->presupuesto;
                        $m01                      = $itemp->m01;
                        $m02                      = $itemp->m02;
                        $m03                      = $itemp->m03;
                        $m04                      = $itemp->m04;
                        $m05                      = $itemp->m05;
                        $m06                      = $itemp->m06;
                        $m07                      = $itemp->m07;
                        $m08                      = $itemp->m08;
                        $m09                      = $itemp->m09;
                        $m10                      = $itemp->m10;
                        $m11                      = $itemp->m11;
                        $m12                      = $itemp->m12;
                        $modificacion             = $itemp->modificacion;
                        $ejecucion                = $itemp->ejecucion;
                        $monto_a_solicitado       = $itemp->monto_a_solicitado;
                        $monto_de_solicitado      = $itemp->monto_de_solicitado;
                        $ampliacion               = $itemp->ampliacion;
                        $credito                  = $itemp->credito;
                        $id_clasificador          = $itemp->id_clasificador;
                        $monto_financ1            = $itemp->monto_financ1;
                        $monto_financ2            = $itemp->monto_financ2;
                        $compromiso               = $itemp->compromiso;
                        $devengado                = $itemp->devengado;
                        $girado                   = $itemp->girado;
                        $pagado                   = $itemp->pagado;
                        $monto_certificado        = $itemp->monto_certificado;
                        $monto_comprometido_anual = $itemp->monto_comprometido_anual;
                        $monto_precertificado     = $itemp->monto_precertificado;

                        $this->Model_Consulta->insert_Gasto($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso, $sec_func, $categ_gasto, $grupo_gasto,
                            $modalidad_gasto, $elemento_gasto, $presupuesto, $m01, $m02, $m03, $m04, $m05, $m06, $m07, $m08,
                            $m09, $m10, $m11, $m12, $modificacion, $ejecucion, $monto_a_solicitado, $monto_de_solicitado, $ampliacion,
                            $credito, $id_clasificador, $monto_financ1, $monto_financ2, $compromiso, $devengado, $girado, $pagado,
                            $monto_certificado, $monto_comprometido_anual, $monto_precertificado);

                    }

                    foreach ($gasto_acumulado_DATA as $itemp) {
                        $ano_eje                   = $itemp->ano_eje;
                        $sec_ejec                  = $itemp->sec_ejec;
                        $origen                    = $itemp->origen;
                        $fuente_financ             = $itemp->fuente_financ;
                        $tipo_recurso              = $itemp->tipo_recurso;
                        $sec_func                  = $itemp->sec_func;
                        $categ_gasto               = $itemp->categ_gasto;
                        $grupo_gasto               = $itemp->grupo_gasto;
                        $modalidad_gasto           = $itemp->modalidad_gasto;
                        $elemento_gasto            = $itemp->elemento_gasto;
                        $mes                       = $itemp->mes;
                        $trimestre                 = $itemp->trimestre;
                        $programacion              = $itemp->programacion;
                        $calendario                = $itemp->calendario;
                        $ejecucion                 = $itemp->ejecucion;
                        $monto_a_aprobado          = $itemp->monto_a_aprobado;
                        $monto_a_solicitado        = $itemp->monto_a_solicitado;
                        $monto_a_interno           = $itemp->monto_a_interno;
                        $monto_de_aprobado         = $itemp->monto_de_aprobado;
                        $monto_de_solicitado       = $itemp->monto_de_solicitado;
                        $monto_de_interno          = $itemp->monto_de_interno;
                        $archivo                   = $itemp->archivo;
                        $calendario_ampliacion     = $itemp->calendario_ampliacion;
                        $calendario_actualizacion  = $itemp->calendario_actualizacion;
                        $calendario_ampliacion_dst = $itemp->calendario_ampliacion_dst;
                        $calendario_flexible       = $itemp->calendario_flexible;
                        $id_clasificador           = $itemp->id_clasificador;
                        $pptm                      = $itemp->pptm;
                        $compromiso                = $itemp->compromiso;
                        $devengado                 = $itemp->devengado;
                        $girado                    = $itemp->girado;
                        $pagado                    = $itemp->pagado;

                        $this->Model_Consulta->insert_Gasto_acumulado($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso,
                            $sec_func, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto,
                            $mes, $trimestre, $programacion, $calendario, $ejecucion,
                            $monto_a_aprobado, $monto_a_solicitado, $monto_a_interno, $monto_de_aprobado,
                            $monto_de_solicitado, $monto_de_interno, $archivo, $calendario_ampliacion,
                            $calendario_actualizacion, $calendario_ampliacion_dst, $calendario_flexible, $id_clasificador,
                            $pptm, $compromiso, $devengado, $girado, $pagado);

                    }

                    foreach ($ejecucion_mpp_DATA as $itemp) {

                        $ano_eje            = $itemp->ano_eje;
                        $sec_ejec           = $itemp->sec_ejec;
                        $mes_eje            = $itemp->mes_eje;
                        $ciclo              = $itemp->ciclo;
                        $origen             = $itemp->origen;
                        $fuente_financ      = $itemp->fuente_financ;
                        $tipo_recurso       = $itemp->tipo_recurso;
                        $clasificador       = $itemp->clasificador;
                        $sec_func           = $itemp->sec_func;
                        $ejecucion          = $itemp->ejecucion;
                        $anulacion          = $itemp->anulacion;
                        $estado             = $itemp->estado;
                        $estado_envio       = $itemp->estado_envio;
                        $cod_error          = $itemp->cod_error;
                        $cod_mensa          = $itemp->cod_mensa;
                        $id_clasificador    = $itemp->id_clasificador;
                        $compromiso         = $itemp->compromiso;
                        $devengado          = $itemp->devengado;
                        $girado             = $itemp->girado;
                        $pagado             = $itemp->pagado;
                        $comprometido_anual = $itemp->comprometido_anual;
                        $certificado        = $itemp->certificado;

                        $this->Model_Consulta->insert_ejecucion_mpp(
                            $ano_eje
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
                            , $certificado);

                    }

                    $this->db->trans_complete();

                    $data['mensaje']   = 'Proyecto "' . substr($this->eliminar_tildes($nombre_proyecto), 0, 84) . '..." fue actualizado correctamente';
                    $data['actualizo'] = true;

                } catch (Exception $e) {
                    $this->db->trans_rollback();
                    $data['mensaje'] = 'ERROR, Proyecto ' . $CodigoUnico . ' no pudo ser Actualizado, ocurrio un error durante la actualizacion';
                }

            } else {
                $data['mensaje'] = 'ERROR, Codigo Unico no existe';
            }
        } else {
            $data['mensaje'] = 'Ingrese Numero Valido';
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
    }

    public function anio($anio = null, $unidad_ejec = null)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        if (is_null($unidad_ejec)) {
            $unidad_ejec = '001549';
        }

        $data['mensaje']    = 'Hubo un problema en la base de datos confirme las tablas '+$anio;
        $data['actualizo']  = false;

        // if (is_numeric($anio)) {

            // if (count($this->Model_SeguimientoCertificado->listarSeguimientoCertificado($anio, $unidad_ejec)) > 0) {

                try {

                    $this->db->trans_start();
                    $this->Model_SeguimientoCertificado->EliminarDataSIAFLocalSeguimientoAnio($anio, $unidad_ejec); 

           //          $data['act_proy'] = 0;
           //          $act_proy_nombre_DATA = $this->Model_SeguimientoCertificado->listarSeguimientoCertificado($anio, $unidad_ejec);
           //          foreach ($act_proy_nombre_DATA as $itemp) {
           //              $ano_eje                = $itemp->ano_eje;

           //              //$val = str_replace("'", "", $val);
           // //$val = preg_replace('/[^ ÂÊÎÔÛâêîôûÁÉÍÓÚáéíóúA-Za-z0-9\'\"”`˜~_.,()\/¿?¡!%#\\-$]/', ' ', $val);

           //              $act_proy               =  $itemp->act_proy ;
           //              $tipo_act_proy          = $itemp->tipo_act_proy;
           //  s            $nombre                 = str_replace("'","", $itemp->nombre) ; 
           //              $estado                 = $itemp->estado;
           //              $ambito                 = $itemp->ambito;
           //              $es_presupuestal        = $itemp->es_presupuestal;
           //              $sector_snip            = $itemp->sector_snip;
           //              $naturaleza_snip        = $itemp->naturaleza_snip;
           //              $intervencion_snip      = $itemp->intervencion_snip;
           //              $tipo_proyecto          = $itemp->tipo_proyecto;
           //              $proyecto_snip          = $itemp->proyecto_snip;
           //              $ambito_en              = $itemp->ambito_en;
           //              $es_foniprel            = $itemp->es_foniprel;
           //              $ambito_programa        = $itemp->ambito_programa;
           //              $es_generico            = $itemp->es_generico;
           //              $costo_actual           = $itemp->costo_actual;
           //              $costo_expediente       = $itemp->costo_expediente;
           //              $costo_viabilidad       = $itemp->costo_viabilidad;
           //              $ejecucion_ano_anterior = $itemp->ejecucion_ano_anterior;
           //              $ind_viabilidad         = $itemp->ind_viabilidad;
           //              $this->Model_Consulta->insert_act_proy($ano_eje, $act_proy, $tipo_act_proy, $nombre, $estado, $ambito, $es_presupuestal, $sector_snip, $naturaleza_snip, $intervencion_snip, $tipo_proyecto, $proyecto_snip, $ambito_en, $es_foniprel, $ambito_programa, $es_generico, $costo_actual, $costo_expediente, $costo_viabilidad, $ejecucion_ano_anterior, $ind_viabilidad);
           //              $data['act_proy'] ++;
           //          }

                    $data['meta'] = 0;
                    $meta_DATA  = $this->Model_SeguimientoCertificado->meta($anio, $unidad_ejec);
                    foreach ($meta_DATA as $itemp) {
                        $ano_eje                        = $itemp->ano_eje;
                        $sec_ejec                       = $itemp->sec_ejec;
                        $sec_func                       = $itemp->sec_func;
                        $funcion                        = $itemp->funcion;
                        $programa                       = $itemp->programa;
                        $sub_programa                   = $itemp->sub_programa;
                        $act_proy                       = $itemp->act_proy;
                        $componente                     = $itemp->componente;
                        $meta                           = $itemp->meta;
                        $finalidad                      = $itemp->finalidad;
                        $nombre                         = $itemp->nombre;
                        $monto                          = $itemp->monto;
                        $cantidad                       = $itemp->cantidad;
                        $unidad_med                     = $itemp->unidad_med;
                        $departamento                   = $itemp->departamento;
                        $provincia                      = $itemp->provincia;
                        $fecha_ing                      = $itemp->fecha_ing;
                        $usuario_ing                    = $itemp->usuario_ing;
                        $fecha_mod                      = $itemp->fecha_mod;
                        $usuario_mod                    = $itemp->usuario_mod;
                        $estado                         = $itemp->estado;
                        $distrito                       = $itemp->distrito;
                        $unidad_medida                  = $itemp->unidad_medida;
                        $cantidad_inicial               = $itemp->cantidad_inicial;
                        $unidad_medida_inicial          = $itemp->unidad_medida_inicial;
                        $es_pia                         = $itemp->es_pia;
                        $cantidad_semestral             = $itemp->cantidad_semestral;
                        $cantidad_semestral_inicial     = $itemp->cantidad_semestral_inicial;
                        $estrategia_nacional            = $itemp->estrategia_nacional;
                        $programa_ppto                  = $itemp->programa_ppto;
                        $cantidad_trimestral_01         = $itemp->cantidad_trimestral_01;
                        $cantidad_trimestral_01_inicial = $itemp->cantidad_trimestral_01_inicial;
                        $cantidad_trimestral_03         = $itemp->cantidad_trimestral_03;
                        $cantidad_trimestral_03_inicial = $itemp->cantidad_trimestral_03_inicial;
                        $this->Model_Consulta->insert_Meta($ano_eje, $sec_ejec, $sec_func, $funcion, $programa, $sub_programa, $act_proy, $componente, $meta, $finalidad, $nombre, $monto, $cantidad, $unidad_med, $departamento,
                            $provincia, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $estado, $distrito, $unidad_medida, $cantidad_inicial, $unidad_medida_inicial, $es_pia, $cantidad_semestral,
                            $cantidad_semestral_inicial, $estrategia_nacional, $programa_ppto, $cantidad_trimestral_01, $cantidad_trimestral_01_inicial, $cantidad_trimestral_03,
                            $cantidad_trimestral_03_inicial);
                        $data['meta'] ++;
                    }

                    $data['gasto_acumulado'] = 0;
                    $gasto_acumulado_DATA      = $this->Model_SeguimientoCertificado->gasto_acumulado($anio);
                    foreach ($gasto_acumulado_DATA as $itemp) {
                        $ano_eje                   = $itemp->ano_eje;
                        $sec_ejec                  = $itemp->sec_ejec;
                        $origen                    = $itemp->origen;
                        $fuente_financ             = $itemp->fuente_financ;
                        $tipo_recurso              = $itemp->tipo_recurso;
                        $sec_func                  = $itemp->sec_func;
                        $categ_gasto               = $itemp->categ_gasto;
                        $grupo_gasto               = $itemp->grupo_gasto;
                        $modalidad_gasto           = $itemp->modalidad_gasto;
                        $elemento_gasto            = $itemp->elemento_gasto;
                        $mes                       = $itemp->mes;
                        $trimestre                 = $itemp->trimestre;
                        $programacion              = $itemp->programacion;
                        $calendario                = $itemp->calendario;
                        $ejecucion                 = $itemp->ejecucion;
                        $monto_a_aprobado          = $itemp->monto_a_aprobado;
                        $monto_a_solicitado        = $itemp->monto_a_solicitado;
                        $monto_a_interno           = $itemp->monto_a_interno;
                        $monto_de_aprobado         = $itemp->monto_de_aprobado;
                        $monto_de_solicitado       = $itemp->monto_de_solicitado;
                        $monto_de_interno          = $itemp->monto_de_interno;
                        $archivo                   = $itemp->archivo;
                        $calendario_ampliacion     = $itemp->calendario_ampliacion;
                        $calendario_actualizacion  = $itemp->calendario_actualizacion;
                        $calendario_ampliacion_dst = $itemp->calendario_ampliacion_dst;
                        $calendario_flexible       = $itemp->calendario_flexible;
                        $id_clasificador           = $itemp->id_clasificador;
                        $pptm                      = $itemp->pptm;
                        $compromiso                = $itemp->compromiso;
                        $devengado                 = $itemp->devengado;
                        $girado                    = $itemp->girado;
                        $pagado                    = $itemp->pagado;

                        $this->Model_Consulta->insert_Gasto_acumulado($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso,
                            $sec_func, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto,
                            $mes, $trimestre, $programacion, $calendario, $ejecucion,
                            $monto_a_aprobado, $monto_a_solicitado, $monto_a_interno, $monto_de_aprobado,
                            $monto_de_solicitado, $monto_de_interno, $archivo, $calendario_ampliacion,
                            $calendario_actualizacion, $calendario_ampliacion_dst, $calendario_flexible, $id_clasificador,
                            $pptm, $compromiso, $devengado, $girado, $pagado);
                        $data['gasto_acumulado']++;
                    }

                    $data['ejecucion_mpp'] = 0;
                    $ejecucion_mpp_DATA        = $this->Model_SeguimientoCertificado->ejecucion_mpp($anio);
                    foreach ($ejecucion_mpp_DATA as $itemp) {

                        $ano_eje            = $itemp->ano_eje;
                        $sec_ejec           = $itemp->sec_ejec;
                        $mes_eje            = $itemp->mes_eje;
                        $ciclo              = $itemp->ciclo;
                        $origen             = $itemp->origen;
                        $fuente_financ      = $itemp->fuente_financ;
                        $tipo_recurso       = $itemp->tipo_recurso;
                        $clasificador       = $itemp->clasificador;
                        $sec_func           = $itemp->sec_func;
                        $ejecucion          = $itemp->ejecucion;
                        $anulacion          = $itemp->anulacion;
                        $estado             = $itemp->estado;
                        $estado_envio       = $itemp->estado_envio;
                        $cod_error          = $itemp->cod_error;
                        $cod_mensa          = $itemp->cod_mensa;
                        $id_clasificador    = $itemp->id_clasificador;
                        $compromiso         = $itemp->compromiso;
                        $devengado          = $itemp->devengado;
                        $girado             = $itemp->girado;
                        $pagado             = $itemp->pagado;
                        $comprometido_anual = $itemp->comprometido_anual;
                        $certificado        = $itemp->certificado;

                        $this->Model_Consulta->insert_ejecucion_mpp(
                            $ano_eje, $sec_ejec, $mes_eje, $ciclo, $origen, $fuente_financ, $tipo_recurso, $clasificador, $sec_func, $ejecucion, $anulacion, $estado, $estado_envio, $cod_error, $cod_mensa, $id_clasificador, $compromiso, $devengado, $girado, $pagado, $comprometido_anual, $certificado);
                        $data['ejecucion_mpp']++;
                    }

                    $data['gasto'] = 0;
                    $gasto = $this->Model_SeguimientoCertificado->gasto($anio, $unidad_ejec);;
                    foreach ($gasto as $itemp) 
                    {
                        $ano_eje                  = $itemp->ano_eje;
                        $sec_ejec                 = $itemp->sec_ejec;
                        $origen                   = $itemp->origen;
                        $fuente_financ            = $itemp->fuente_financ;
                        $tipo_recurso             = $itemp->tipo_recurso;
                        $sec_func                 = $itemp->sec_func;
                        $categ_gasto              = $itemp->categ_gasto;
                        $grupo_gasto              = $itemp->grupo_gasto;
                        $modalidad_gasto          = $itemp->modalidad_gasto;
                        $elemento_gasto           = $itemp->elemento_gasto;
                        $presupuesto              = $itemp->presupuesto;
                        $m01                      = $itemp->m01;
                        $m02                      = $itemp->m02;
                        $m03                      = $itemp->m03;
                        $m04                      = $itemp->m04;
                        $m05                      = $itemp->m05;
                        $m06                      = $itemp->m06;
                        $m07                      = $itemp->m07;
                        $m08                      = $itemp->m08;
                        $m09                      = $itemp->m09;
                        $m10                      = $itemp->m10;
                        $m11                      = $itemp->m11;
                        $m12                      = $itemp->m12;
                        $modificacion             = $itemp->modificacion;
                        $ejecucion                = $itemp->ejecucion;
                        $monto_a_solicitado       = $itemp->monto_a_solicitado;
                        $monto_de_solicitado      = $itemp->monto_de_solicitado;
                        $ampliacion               = $itemp->ampliacion;
                        $credito                  = $itemp->credito;
                        $id_clasificador          = $itemp->id_clasificador;
                        $monto_financ1            = $itemp->monto_financ1;
                        $monto_financ2            = $itemp->monto_financ2;
                        $compromiso               = $itemp->compromiso;
                        $devengado                = $itemp->devengado;
                        $girado                   = $itemp->girado;
                        $pagado                   = $itemp->pagado;
                        $monto_certificado        = $itemp->monto_certificado;
                        $monto_comprometido_anual = $itemp->monto_comprometido_anual;
                        $monto_precertificado     = $itemp->monto_precertificado;

                        $this->Model_SeguimientoCertificado->insert_Gasto($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso, $sec_func, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto, $presupuesto, $m01, $m02, $m03, $m04, $m05, $m06, $m07, $m08, $m09, $m10, $m11, $m12, $modificacion, $ejecucion, $monto_a_solicitado, $monto_de_solicitado, $ampliacion, $credito, $id_clasificador, $monto_financ1, $monto_financ2, $compromiso, $devengado, $girado, $pagado, $monto_certificado, $monto_comprometido_anual, $monto_precertificado);
                        $data['gasto'] ++;
                    }

                    $data['nota_modificatoria_det'] = 0;
                    $nota_modificatoria_det=$this->Model_SeguimientoCertificado->nota_modificatoria_det($anio);
                    foreach ($nota_modificatoria_det as $itemp) 
                    {
                        $ano_eje                  = $itemp->ano_eje;
                        $sec_ejec                 = $itemp->sec_ejec;
                        $sec_ejec2                = $itemp->sec_ejec2;
                        $sec_nota                 = $itemp->sec_nota;
                        $origen                   = $itemp->origen;                     
                        $fuente_financ            = $itemp->fuente_financ;
                        $tipo_recurso             = $itemp->tipo_recurso;                        
                        $sec_func                 = $itemp->sec_func;
                        $categ_gasto              = $itemp->categ_gasto;                        
                        $grupo_gasto              = $itemp->grupo_gasto;
                        $modalidad_gasto          = $itemp->modalidad_gasto;                        
                        $elemento_gasto           = $itemp->elemento_gasto;
                        $monto_a                  = $itemp->monto_a;
                        $monto_de                 = $itemp->monto_de;
                        $archivo                  = $itemp->archivo;
                        $estado_envio             = $itemp->estado_envio;
                        $cod_error                = $itemp->cod_error;
                        $cod_mensa                = $itemp->cod_mensa;
                        $id_clasificador          = $itemp->id_clasificador;


                        $this->Model_SeguimientoCertificado->insert_NotaModificatoriaDet($ano_eje, $sec_ejec, $sec_ejec2, $sec_nota, $origen, $fuente_financ, $tipo_recurso, $sec_func, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto, $monto_a, $monto_de, $archivo, $estado_envio, $cod_error, $cod_mensa, $id_clasificador);
                        $data['nota_modificatoria_det'] ++;
                    }
                    

                    $this->db->trans_complete();

                    //$data['cantidad']   = count($meta_DATA);

                    //$data['mensaje']   = $this->config->item('active_record');
                    
                    $data['mensaje']   = 'Informacion de Proyectos al anio ' . $anio . ' y Unidad ejecutora ' . $unidad_ejec . ' fueron actualizados correctamente';
                    
                    $data['actualizo'] = true;


                } catch (Exception $e) {
                    $this->db->trans_rollback();
                    $data['mensaje'] = 'Proyectos no actualizados, ocurrio un error durante la actualizacion';
                }
            // } else {
            //     $data['mensaje'] = 'No existe proyectos para actualizar con Anio ' . $anio . ' y Unidad ejecutora ' . $unidad_ejec . '';
            // }
        // } else {
        //     $data['mensaje'] = 'Ingrese Anio Valido';
        // }

        echo json_encode($data, JSON_FORCE_OBJECT);
    }

    public function eliminar_tildes($cadena)
    {

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        $cadena = utf8_encode($cadena);

        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena);

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena);

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena);

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena);

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        return $cadena;
    }
}
