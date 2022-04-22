<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Dashboard_Reporte extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function GetAprobadosEstudio()
    {
        $estudios = $this->db->query("select nombre_naturaleza_inv, count(nombre_pi)as Cantidadpip from PROYECTO_INVERSION right join NATURALEZA_INVERSION ON PROYECTO_INVERSION.id_naturaleza_inv=NATURALEZA_INVERSION.id_naturaleza_inv group by nombre_naturaleza_inv");
        if ($estudios->num_rows()> 0) 
        {
            return $estudios->result();
        } 
        else 
        {
            return false;
        }
    }

    function NaturalezaInversionMontos()
    {
        $estudios = $this->db->query("select nombre_naturaleza_inv, sum (costo_pi) as Monto from PROYECTO_INVERSION left join NATURALEZA_INVERSION ON PROYECTO_INVERSION.id_naturaleza_inv=NATURALEZA_INVERSION.id_naturaleza_inv group by nombre_naturaleza_inv");//listar EVAL
        if ($estudios->num_rows()> 0) {
            return $estudios->result();
        } else {
            return false;
        }
    }

    function CantidadPipFuenteFinancimiento()
    {
        $estudios = $this->db->query("select nombre_fuente_finan , count(nombre_pi)as Cantidadpip from PROYECTO_INVERSION RIGHT JOIN RUBRO_PI on PROYECTO_INVERSION.id_pi=RUBRO_PI.id_pi RIGHT JOIN RUBRO ON RUBRO_PI.id_rubro=RUBRO.id_rubro RIGHT JOIN FUENTE_FINANCIAMIENTO ON RUBRO.id_fuente_finan=FUENTE_FINANCIAMIENTO.id_fuente_finan GROUP BY  nombre_fuente_finan ");//listar EVAL
        if ($estudios->num_rows()> 0) {
            return $estudios->result();
        } else {
            return false;
        }
    }

    function MontoPipFuenteFinanciamiento()
    {
        $estudios = $this->db->query("select nombre_fuente_finan , sum(costo_pi)as Monto from PROYECTO_INVERSION RIGHT JOIN RUBRO_PI on PROYECTO_INVERSION.id_pi=RUBRO_PI.id_pi RIGHT JOIN RUBRO ON RUBRO_PI.id_rubro=RUBRO.id_rubro RIGHT JOIN FUENTE_FINANCIAMIENTO ON RUBRO.id_fuente_finan=FUENTE_FINANCIAMIENTO.id_fuente_finan GROUP BY  nombre_fuente_finan");//listar EVAL
        if ($estudios->num_rows()> 0) {
            return $estudios->result();
        } else {
            return false;
        }
    }

    function CantidadPipModalidad()
    {
        $estudios = $this->db->query("select nombre_modalidad_ejec,count(nombre_pi)as CantidadPip FROM MODALIDAD_EJECUCION left JOIN MODALIDAD_EJECUCION_PI ON MODALIDAD_EJECUCION.id_modalidad_ejec=MODALIDAD_EJECUCION_PI.id_modalidad_ejec left JOIN PROYECTO_INVERSION ON MODALIDAD_EJECUCION_PI.id_pi=PROYECTO_INVERSION.id_pi group by nombre_modalidad_ejec");//listar EVAL
        if ($estudios->num_rows()> 0) {
            return $estudios->result();
        } else {
            return false;
        }
    }

    function MontoPipModalidad()
    {
        $data = $this->db->query("select nombre_modalidad_ejec,sum(costo_pi)as Monto FROM MODALIDAD_EJECUCION left JOIN MODALIDAD_EJECUCION_PI ON MODALIDAD_EJECUCION.id_modalidad_ejec=MODALIDAD_EJECUCION_PI.id_modalidad_ejec left JOIN PROYECTO_INVERSION ON MODALIDAD_EJECUCION_PI.id_pi=PROYECTO_INVERSION.id_pi group by nombre_modalidad_ejec");//listar EVAL
        if ($data->num_rows()> 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function CantidadPipRubro()
    {
        $data = $this->db->query("select nombre_rubro ,count (nombre_pi)as Cantidadpip from RUBRO LEFT JOIN RUBRO_PI on RUBRO.id_rubro=RUBRO_PI.id_rubro LEFT JOIN PROYECTO_INVERSION on RUBRO_PI.id_pi=PROYECTO_INVERSION.id_pi group by nombre_rubro");//listar EVAL
        if ($data->num_rows()> 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function CantidadPipProvincia()
    {
        $data = $this->db->query("select UBIGEO.provincia ,count (nombre_pi)as Cantidadpip from PROYECTO_INVERSION INNER JOIN UBIGEO_PI on PROYECTO_INVERSION.id_pi=UBIGEO_PI.id_pi INNER JOIN UBIGEO on UBIGEO_PI.id_ubigeo=UBIGEO.id_ubigeo group by  UBIGEO.provincia");//listar EVAL
        if ($data->num_rows()> 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function InformacionFinanciera($CodigoUnico)
    {
        $data = $this->db->query("select codigo_unico_pi,SUM(costo_pi) as costo_pi,SUM(pia_meta_pres) as pia_meta_pres ,SUM(pim_acumulado) AS pim_acumulado,
        SUM(compromiso_acumulado) as compromiso_acumulado ,SUM(devengado_acumulado) as devengado_acumulado from 
        PROYECTO_INVERSION inner join META_PRESUPUESTAL_PI on  PROYECTO_INVERSION.id_pi=META_PRESUPUESTAL_PI.id_pi 
        where PROYECTO_INVERSION.codigo_unico_pi='".$CodigoUnico."' GROUP BY codigo_unico_pi");//listar EVAL
        if ($data->num_rows()> 0) {
            return $data->result();
        } else {
            return false;
        }
    }

    function FuncionNumeroPip()
    {
        $data=$this->db->query("select FUNCION.nombre_funcion ,count (nombre_pi)as CantidadPip, sum(costo_pi)as CostoPip from PROYECTO_INVERSION INNER JOIN GRUPO_FUNCIONAL ON PROYECTO_INVERSION.id_grupo_funcional=GRUPO_FUNCIONAL.id_grup_funcional INNER JOIN  DIVISION_FUNCIONAL on GRUPO_FUNCIONAL.id_div_funcional=DIVISION_FUNCIONAL.id_div_funcional INNER JOIN FUNCION on DIVISION_FUNCIONAL.id_funcion=FUNCION.id_funcion group by FUNCION.nombre_funcion");
        if ($data->num_rows()> 0) 
        {
            return $data->result();
        } 
        else 
        {
            return false;
        }
    }
    function ReporteDevengadoPiaPimPorPip($CodigoUnico)
    {
        $opcion='datos_generales_por_cada_pip';
        $data=$this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."', @codigo_snip='".$CodigoUnico."'");
        if ($data->num_rows()> 0) 
        {
            return $data->result()[0];
        } 
        else 
        {
            return false;
        }
    }

    function ReporteEjecucionPresupuestal($CodigoUnico)
    {
        $opcion="listar_act_proy_nombre";
        
        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."', @codigo_snip ='".$CodigoUnico."'");
        
        return $data->result();       
    }

    function MetaAnioProyecto($CodigoUnico,$anio)
    {
        $opcion="listar_meta_proyecto_anio";
        
        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."', @codigo_snip ='".$CodigoUnico."', @anio_meta ='".$anio."'");
        
        return $data->result();       
    }

    function ReporteCorrelativoMeta($CodigoUnico)
    {
        
        $data=$this->db->query("execute sp_Gestionar_SIAF @opcion='listar_acumulado_meta', @codigo_snip ='".$CodigoUnico."'");
            
        return $data->result();    
    }

    function ListaAcumuladoGrafico($CodigoUnico)
    {
        $data=$this->db->query("execute sp_Gestionar_SIAF @opcion='listar_acumulado_grafico', @codigo_snip='$CodigoUnico'");            
        
        return $data->result();  
    }

    function DetalleMensualizadoMeta($correlativoMeta, $anioMeta, $sec_ejec)
    {
        $opcion="listar_mensualizado_meta";

        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."', @correlativo_meta='".$correlativoMeta."', @anio_meta='".$anioMeta."', @sec_ejec='".$sec_ejec."'");
            
        return $data->result();
    }

    function DetalleMensualizadoMetaEst($correlativoMeta, $anioMeta, $sec_ejec)
    {
        $opcion="listar_mensualizado_meta";
        
        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."',  @correlativo_meta='".$correlativoMeta."', @anio_meta='".$anioMeta."', @sec_ejec='".$sec_ejec."'");
            
        return count($data->result())>0 ? $data->result()[0] : false;
    }

    function DetalleMensualizadoMetaFuente($correlativoMeta, $anioMeta, $sec_ejec)
    {
        $opcion="listar_acumulado_meta_fuente_financ";
        
        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."',  @correlativo_meta='".$correlativoMeta."', @anio_meta='".$anioMeta."', @sec_ejec='".$sec_ejec."'");

        return $data->result();
    }

    function DetalleMensualizadoMetaFuenteDatosG($correlativoMeta, $anioMeta,$sec_ejec)
    {
        $opcion="listar_acumulado_meta_fuente_financ";
        
        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."',  @correlativo_meta='".$correlativoMeta."', @anio_meta='".$anioMeta."', @sec_ejec='".$sec_ejec."'");

        return $data->result()[0];
    }

    function ReporteDevengadoPiaPimPorPipGraficos($CodigoUnico)
    {
        $data = $this->db->query("select codigo_unico_pi,SUM(costo_pi) as costo_pi,SUM(pia_meta_pres) as pia_meta_pres ,SUM(pim_acumulado) AS pim_acumulado,
        SUM(compromiso_acumulado) as compromiso_acumulado ,SUM(devengado_acumulado) as devengado_acumulado from 
        PROYECTO_INVERSION inner join META_PRESUPUESTAL_PI on  PROYECTO_INVERSION.id_pi=META_PRESUPUESTAL_PI.id_pi 
        where PROYECTO_INVERSION.codigo_unico_pi='".$CodigoUnico."' GROUP BY codigo_unico_pi");
        if ($data->num_rows()> 0) 
        {
            return $data->result()[0];
        } 
        else 
        {
            return false;
        }
    }
    function ReporteConsolidadoAvanceFisicoFinan($anio, $sec_ejec, $tipo_proyecto)
    {
        $opcion="calificacion_seguimiento_certificado_a_devengado";
        if($tipo_proyecto=='')
        {            
            $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."', @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto=NULL");            
            return $data->result(); 
        }
        else
        {
            $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."', @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto='".$tipo_proyecto."'");            
            return $data->result(); 
        }
    }

    function NotaModificatoriaDet($anio,$sec_ejec,$sec_func)
    {
        $data = $this->db->query("select sum(monto_a) as monto_a, sum(monto_de) as monto_de  from dbsiaf.dbo.nota_modificatoria_det where ano_eje='$anio' and sec_ejec='$sec_ejec' and sec_func='$sec_func'");            
        
        return $data->result()[0]; 
    }

    function ReporteDetalleAnaliticoFinanciero($anio,$codigounico)
    {
        $opcion="listar_analitico_avance_proyecto";
        
        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."',  @anio_meta='".$anio."', @codigo_snip='".$codigounico."'");
            
        return $data->result();
    }

    function ReporteDetalleAnaliticoFinancieroE($anio,$codigounico)
    {
        $opcion="listar_analitico_avance_proyecto";

        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."',  @anio_meta='".$anio."', @codigo_snip='".$codigounico."'");
        
        return count($data->result())>0 ? $data->result()[0] : false;
    }

    function ReporteDetalleClasificador($anio,$codigounico)
    {
        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='listar_montos_proyecto_por_clasificadores',  @anio_meta='".$anio."', @codigo_snip='".$codigounico."'");
            
        return $data->result();
    }

    function ReporteDetalleClasificadorFijos($anio,$codigounico)
    {
        $opcion="listar_montos_proyecto_por_clasificadores";

        $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='".$opcion."',  @anio_meta='".$anio."', @codigo_snip='".$codigounico."'");
        
        return $data->result()[0];
    }

    function DetallePorOrden($correlativoMeta,$anioMeta,$sec_ejec)
    {
        $opcion="listar_orden_compra";
        if($sec_ejec=='000748')
        {
            $db_prueba = $this->load->database('SIGA_ANDAHUAYLAS', true);
            $data = $db_prueba->query("execute sp_Gestionar_SIGA @opcion='".$opcion."',  @anio_meta='".$anioMeta."', @correlativo_meta='".$correlativoMeta."', @sec_ejec='".$sec_ejec."'");        
            return $data->result();
        }
        else
        {   
            $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select SIG_ORDEN_PRESUPUESTO.SEC_FUNC, SIG_ORDEN_ADQUISICION.NRO_ORDEN, SIG_ORDEN_ADQUISICION.EXP_SIAF, 
            SIG_ORDEN_ADQUISICION.EXP_SIGA, SIG_ORDEN_ADQUISICION.TIPO_BIEN, SIG_ORDEN_ADQUISICION.FECHA_ORDEN, 
            SIG_ORDEN_ADQUISICION.DOCUM_REFERENCIA, SIG_ORDEN_ADQUISICION.CONCEPTO, SIG_ORDEN_ADQUISICION.SUBTOTAL_SOLES, 
            SIG_ORDEN_ADQUISICION.TOTAL_IGV_SOLES, SIG_ORDEN_ADQUISICION.TOTAL_FACT_SOLES, SIG_CONTRATISTAS.NOMBRE_PROV, 
            SIG_CONTRATISTAS.DIRECCION, SIG_CONTRATISTAS.GIRO_GENERAL, SIG_CONTRATISTAS.NRO_RUC, SIG_CONTRATISTAS.TELEFONOS, 
            SIG_CONTRATISTAS.CCI, SIG_CONTRATISTAS.TELEFONO_FAX, SIG_ORDEN_ADQUISICION.ANO_EJE, SIG_ORDEN_ADQUISICION.TIPO_PPTO, SIG_ORDEN_ADQUISICION.SEC_EJEC
            FROM SIGA_1549.dbo.SIG_ORDEN_ADQUISICION INNER JOIN
            SIGA_1549.dbo.SIG_CONTRATISTAS ON SIG_ORDEN_ADQUISICION.PROVEEDOR = SIG_CONTRATISTAS.PROVEEDOR INNER JOIN
            SIGA_1549.dbo.SIG_ORDEN_PRESUPUESTO ON SIG_ORDEN_ADQUISICION.NRO_ORDEN = SIG_ORDEN_PRESUPUESTO.NRO_ORDEN AND 
            SIG_ORDEN_ADQUISICION.ANO_EJE = SIG_ORDEN_PRESUPUESTO.ANO_EJE AND 
            SIG_ORDEN_ADQUISICION.SEC_EJEC = SIG_ORDEN_PRESUPUESTO.SEC_EJEC AND 
            SIG_ORDEN_ADQUISICION.TIPO_BIEN = SIG_ORDEN_PRESUPUESTO.TIPO_BIEN AND 
            SIG_ORDEN_ADQUISICION.TIPO_PPTO = SIG_ORDEN_PRESUPUESTO.TIPO_PPTO
            WHERE (SIG_ORDEN_ADQUISICION.ANO_EJE = '$anioMeta')
            AND ISNULL(TRY_CAST( SIG_ORDEN_PRESUPUESTO.SEC_FUNC as int ), 0)  = ISNULL(TRY_CAST( '$correlativoMeta' as int ), 0) 
            GROUP BY SIG_ORDEN_PRESUPUESTO.SEC_FUNC, SIG_ORDEN_ADQUISICION.NRO_ORDEN, SIG_ORDEN_ADQUISICION.EXP_SIAF, 
            SIG_ORDEN_ADQUISICION.EXP_SIGA, SIG_ORDEN_ADQUISICION.TIPO_BIEN, SIG_ORDEN_ADQUISICION.FECHA_ORDEN, 
            SIG_ORDEN_ADQUISICION.DOCUM_REFERENCIA, SIG_ORDEN_ADQUISICION.CONCEPTO, SIG_ORDEN_ADQUISICION.SUBTOTAL_SOLES, 
            SIG_ORDEN_ADQUISICION.TOTAL_IGV_SOLES, SIG_ORDEN_ADQUISICION.TOTAL_FACT_SOLES, SIG_CONTRATISTAS.NOMBRE_PROV, 
            SIG_CONTRATISTAS.DIRECCION, SIG_CONTRATISTAS.GIRO_GENERAL, SIG_CONTRATISTAS.NRO_RUC, SIG_CONTRATISTAS.TELEFONOS, 
            SIG_CONTRATISTAS.CCI, SIG_CONTRATISTAS.TELEFONO_FAX, SIG_ORDEN_ADQUISICION.ANO_EJE, SIG_ORDEN_ADQUISICION.TIPO_PPTO, SIG_ORDEN_ADQUISICION.SEC_EJEC
            ORDER BY SIG_ORDEN_ADQUISICION.FECHA_ORDEN DESC");        
            return $data->result();
        }        
    }
	
	function DetallePorOrdenMES($correlativoMeta,$anioMeta,$sec_ejec,$mess)
    {
       
	   if($mess=="todomes"){
		   
		     $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select SIG_ORDEN_PRESUPUESTO.SEC_FUNC, SIG_ORDEN_ADQUISICION.NRO_ORDEN, SIG_ORDEN_ADQUISICION.EXP_SIAF, 
            SIG_ORDEN_ADQUISICION.EXP_SIGA, SIG_ORDEN_ADQUISICION.TIPO_BIEN, SIG_ORDEN_ADQUISICION.FECHA_ORDEN, 
            SIG_ORDEN_ADQUISICION.DOCUM_REFERENCIA, SIG_ORDEN_ADQUISICION.CONCEPTO, SIG_ORDEN_ADQUISICION.SUBTOTAL_SOLES, 
            SIG_ORDEN_ADQUISICION.TOTAL_IGV_SOLES, SIG_ORDEN_ADQUISICION.TOTAL_FACT_SOLES, SIG_CONTRATISTAS.NOMBRE_PROV, 
            SIG_CONTRATISTAS.DIRECCION, SIG_CONTRATISTAS.GIRO_GENERAL, SIG_CONTRATISTAS.NRO_RUC, SIG_CONTRATISTAS.TELEFONOS, 
            SIG_CONTRATISTAS.CCI, SIG_CONTRATISTAS.TELEFONO_FAX, SIG_ORDEN_ADQUISICION.ANO_EJE, SIG_ORDEN_ADQUISICION.TIPO_PPTO, SIG_ORDEN_ADQUISICION.SEC_EJEC
            FROM SIGA_1549.dbo.SIG_ORDEN_ADQUISICION INNER JOIN
            SIGA_1549.dbo.SIG_CONTRATISTAS ON SIG_ORDEN_ADQUISICION.PROVEEDOR = SIG_CONTRATISTAS.PROVEEDOR INNER JOIN
            SIGA_1549.dbo.SIG_ORDEN_PRESUPUESTO ON SIG_ORDEN_ADQUISICION.NRO_ORDEN = SIG_ORDEN_PRESUPUESTO.NRO_ORDEN AND 
            SIG_ORDEN_ADQUISICION.ANO_EJE = SIG_ORDEN_PRESUPUESTO.ANO_EJE AND 
            SIG_ORDEN_ADQUISICION.SEC_EJEC = SIG_ORDEN_PRESUPUESTO.SEC_EJEC AND 
            SIG_ORDEN_ADQUISICION.TIPO_BIEN = SIG_ORDEN_PRESUPUESTO.TIPO_BIEN AND 
            SIG_ORDEN_ADQUISICION.TIPO_PPTO = SIG_ORDEN_PRESUPUESTO.TIPO_PPTO
            WHERE (SIG_ORDEN_ADQUISICION.ANO_EJE = '$anioMeta')
            AND ISNULL(TRY_CAST( SIG_ORDEN_PRESUPUESTO.SEC_FUNC as int ), 0)  = ISNULL(TRY_CAST( '$correlativoMeta' as int ), 0) 
            GROUP BY SIG_ORDEN_PRESUPUESTO.SEC_FUNC, SIG_ORDEN_ADQUISICION.NRO_ORDEN, SIG_ORDEN_ADQUISICION.EXP_SIAF, 
            SIG_ORDEN_ADQUISICION.EXP_SIGA, SIG_ORDEN_ADQUISICION.TIPO_BIEN, SIG_ORDEN_ADQUISICION.FECHA_ORDEN, 
            SIG_ORDEN_ADQUISICION.DOCUM_REFERENCIA, SIG_ORDEN_ADQUISICION.CONCEPTO, SIG_ORDEN_ADQUISICION.SUBTOTAL_SOLES, 
            SIG_ORDEN_ADQUISICION.TOTAL_IGV_SOLES, SIG_ORDEN_ADQUISICION.TOTAL_FACT_SOLES, SIG_CONTRATISTAS.NOMBRE_PROV, 
            SIG_CONTRATISTAS.DIRECCION, SIG_CONTRATISTAS.GIRO_GENERAL, SIG_CONTRATISTAS.NRO_RUC, SIG_CONTRATISTAS.TELEFONOS, 
            SIG_CONTRATISTAS.CCI, SIG_CONTRATISTAS.TELEFONO_FAX, SIG_ORDEN_ADQUISICION.ANO_EJE, SIG_ORDEN_ADQUISICION.TIPO_PPTO, SIG_ORDEN_ADQUISICION.SEC_EJEC 
            ORDER BY SIG_ORDEN_ADQUISICION.FECHA_ORDEN DESC");        
            return $data->result_array();
			
		   
	   }else{
            $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select SIG_ORDEN_PRESUPUESTO.SEC_FUNC, SIG_ORDEN_ADQUISICION.NRO_ORDEN, SIG_ORDEN_ADQUISICION.EXP_SIAF, 
            SIG_ORDEN_ADQUISICION.EXP_SIGA, SIG_ORDEN_ADQUISICION.TIPO_BIEN, SIG_ORDEN_ADQUISICION.FECHA_ORDEN, 
            SIG_ORDEN_ADQUISICION.DOCUM_REFERENCIA, SIG_ORDEN_ADQUISICION.CONCEPTO, SIG_ORDEN_ADQUISICION.SUBTOTAL_SOLES, 
            SIG_ORDEN_ADQUISICION.TOTAL_IGV_SOLES, SIG_ORDEN_ADQUISICION.TOTAL_FACT_SOLES, SIG_CONTRATISTAS.NOMBRE_PROV, 
            SIG_CONTRATISTAS.DIRECCION, SIG_CONTRATISTAS.GIRO_GENERAL, SIG_CONTRATISTAS.NRO_RUC, SIG_CONTRATISTAS.TELEFONOS, 
            SIG_CONTRATISTAS.CCI, SIG_CONTRATISTAS.TELEFONO_FAX, SIG_ORDEN_ADQUISICION.ANO_EJE, SIG_ORDEN_ADQUISICION.TIPO_PPTO, SIG_ORDEN_ADQUISICION.SEC_EJEC
            FROM SIGA_1549.dbo.SIG_ORDEN_ADQUISICION INNER JOIN
            SIGA_1549.dbo.SIG_CONTRATISTAS ON SIG_ORDEN_ADQUISICION.PROVEEDOR = SIG_CONTRATISTAS.PROVEEDOR INNER JOIN
            SIGA_1549.dbo.SIG_ORDEN_PRESUPUESTO ON SIG_ORDEN_ADQUISICION.NRO_ORDEN = SIG_ORDEN_PRESUPUESTO.NRO_ORDEN AND 
            SIG_ORDEN_ADQUISICION.ANO_EJE = SIG_ORDEN_PRESUPUESTO.ANO_EJE AND 
            SIG_ORDEN_ADQUISICION.SEC_EJEC = SIG_ORDEN_PRESUPUESTO.SEC_EJEC AND 
            SIG_ORDEN_ADQUISICION.TIPO_BIEN = SIG_ORDEN_PRESUPUESTO.TIPO_BIEN AND 
            SIG_ORDEN_ADQUISICION.TIPO_PPTO = SIG_ORDEN_PRESUPUESTO.TIPO_PPTO
            WHERE (SIG_ORDEN_ADQUISICION.ANO_EJE = '$anioMeta')
            AND ISNULL(TRY_CAST( SIG_ORDEN_PRESUPUESTO.SEC_FUNC as int ), 0)  = ISNULL(TRY_CAST( '$correlativoMeta' as int ), 0) and MONTH (FECHA_ORDEN)='$mess'
            GROUP BY SIG_ORDEN_PRESUPUESTO.SEC_FUNC, SIG_ORDEN_ADQUISICION.NRO_ORDEN, SIG_ORDEN_ADQUISICION.EXP_SIAF, 
            SIG_ORDEN_ADQUISICION.EXP_SIGA, SIG_ORDEN_ADQUISICION.TIPO_BIEN, SIG_ORDEN_ADQUISICION.FECHA_ORDEN, 
            SIG_ORDEN_ADQUISICION.DOCUM_REFERENCIA, SIG_ORDEN_ADQUISICION.CONCEPTO, SIG_ORDEN_ADQUISICION.SUBTOTAL_SOLES, 
            SIG_ORDEN_ADQUISICION.TOTAL_IGV_SOLES, SIG_ORDEN_ADQUISICION.TOTAL_FACT_SOLES, SIG_CONTRATISTAS.NOMBRE_PROV, 
            SIG_CONTRATISTAS.DIRECCION, SIG_CONTRATISTAS.GIRO_GENERAL, SIG_CONTRATISTAS.NRO_RUC, SIG_CONTRATISTAS.TELEFONOS, 
            SIG_CONTRATISTAS.CCI, SIG_CONTRATISTAS.TELEFONO_FAX, SIG_ORDEN_ADQUISICION.ANO_EJE, SIG_ORDEN_ADQUISICION.TIPO_PPTO, SIG_ORDEN_ADQUISICION.SEC_EJEC 
            ORDER BY SIG_ORDEN_ADQUISICION.FECHA_ORDEN DESC");        
            return $data->result_array();
	   }
                
    }
	
	

    function numeroComprobanteExpediente($expediente, $anio, $mes)
    {        
        $data = $this->db->query("execute ComprobantedePagoSiaf @expediente='$expediente', @anio='$anio', @mes='$mes'");
        
        return $data->result();
    }

    function DetallePedidoCompraMeta($correlativoMeta,$anioMeta,$sec_ejec)
    {
        $opcion="listar_pedidos_proyecto";
        if($sec_ejec=='000748')
        {
            $db_prueba = $this->load->database('SIGA_ANDAHUAYLAS', true);
            $data = $db_prueba->query("execute sp_Gestionar_SIGA @opcion='".$opcion."',  @anio_meta='".$anioMeta."', @correlativo_meta='".$correlativoMeta."', @sec_ejec='".$sec_ejec."'");        
            return $data->result();
        }
        else
        {
            $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.NRO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, 
            SIG_PEDIDOS.MOTIVO_PEDIDO, SIG_PEDIDOS.sec_func, SIG_PEDIDOS.ESTADO, SIG_PEDIDOS.FECHA_APROB, 
            SIG_PEDIDOS.FECHA_ATENC, SIG_PEDIDOS.FECHA_REG, SIG_PEDIDOS.EQUIPO_REG, SIG_PEDIDOS.fecha_reg_vb, 
            SIG_PEDIDOS.equipo_reg_vb, SIG_PERSONAL.nombres + ' '+ SIG_PERSONAL.apellido_paterno + ' '+ SIG_PERSONAL.apellido_materno as personal, SIG_PEDIDOS.SEC_EJEC
            FROM SIGA_1549.dbo.SIG_PEDIDOS INNER JOIN
            SIGA_1549.dbo.SIG_PERSONAL ON SIG_PEDIDOS.SEC_EJEC = SIG_PERSONAL.sec_ejec AND SIG_PEDIDOS.EMPLEADO = SIG_PERSONAL.empleado
            WHERE (SIG_PEDIDOS.ANO_EJE = '$anioMeta') AND SIG_PEDIDOS.SEC_EJEC = '$sec_ejec' AND
            ISNULL(TRY_CAST( SIG_PEDIDOS.sec_func as int ), 0)  = ISNULL(TRY_CAST( '$correlativoMeta' as int ), 0) ORDER BY SIG_PEDIDOS.FECHA_PEDIDO DESC");        
            return $data->result();

            // $data = $this->db->query("execute sp_Gestionar_SIGA @opcion='".$opcion."',  @anio_meta='".$anioMeta."', @correlativo_meta='".$correlativoMeta."', @sec_ejec='".$sec_ejec."'");        
            // return $data->result();
        }          
    }

    function DetallePorCadaPedido($nropedido,$anio,$tipopedido,$tipobien, $sec_ejec)
    {
        $opcion="listar_detalle_pedidos_proyecto";
        if($sec_ejec=='748')
        {
            $db_prueba = $this->load->database('SIGA_ANDAHUAYLAS', true);
            $data = $db_prueba->query("execute sp_Gestionar_SIGA @opcion='".$opcion."',  @num_pedido='".$nropedido."', @anio_meta='".$anio."', @tipo_pedido='".$tipopedido."',@tipo_bien='".$tipobien."', @sec_ejec=".$sec_ejec."");        
            return $data->result();
        }
        else
        {
            $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select SIG_DETALLE_PEDIDOS.ANO_EJE, SIG_DETALLE_PEDIDOS.sec_ejec,catalogo_bien_serv.NOMBRE_ITEM, SIG_DETALLE_PEDIDOS.TIPO_BIEN, 
            SIG_DETALLE_PEDIDOS.TIPO_PEDIDO, SIG_DETALLE_PEDIDOS.NRO_PEDIDO, SIG_DETALLE_PEDIDOS.SECUENCIA, 
            SIG_DETALLE_PEDIDOS.CANT_SOLICITADA, SIG_DETALLE_PEDIDOS.CANT_APROBADA, SIG_DETALLE_PEDIDOS.CANT_ATENDIDA, 
            SIG_DETALLE_PEDIDOS.PRECIO_UNIT, SIG_DETALLE_PEDIDOS.VALOR_TOTAL, SIG_DETALLE_PEDIDOS.FECHA_CONFOR, 
            SIG_DETALLE_PEDIDOS.FECHA_CUADRO, SIG_DETALLE_PEDIDOS.FECHA_REG, SIG_DETALLE_PEDIDOS.FECHA_PECOSA, 
            SIG_DETALLE_PEDIDOS.FECHA_APROB, SIG_CLASIFICADOR_GASTO.CLASIFICADOR, SIG_CLASIFICADOR_GASTO.NOMBRE_CLASIF
            FROM SIGA_1549.dbo.SIG_DETALLE_PEDIDOS INNER JOIN
            SIGA_1549.dbo.SIG_CLASIFICADOR_GASTO ON SIG_DETALLE_PEDIDOS.ID_CLASIFICADOR = SIG_CLASIFICADOR_GASTO.ID_CLASIFICADOR AND 
            SIG_DETALLE_PEDIDOS.ANO_EJE = SIG_CLASIFICADOR_GASTO.ANO_EJE
            INNER JOIN SIGA_1549.dbo.catalogo_bien_serv ON SIG_DETALLE_PEDIDOS.GRUPO_BIEN=catalogo_bien_serv.GRUPO_BIEN AND
            SIG_DETALLE_PEDIDOS.CLASE_BIEN=catalogo_bien_serv.CLASE_BIEN AND
            SIG_DETALLE_PEDIDOS.FAMILIA_BIEN=catalogo_bien_serv.FAMILIA_BIEN AND
            SIG_DETALLE_PEDIDOS.ITEM_BIEN=catalogo_bien_serv.ITEM_BIEN
            WHERE (SIG_DETALLE_PEDIDOS.ANO_EJE = '$anio') AND SIG_DETALLE_PEDIDOS.SEC_EJEC = '$sec_ejec' AND
            (SIG_DETALLE_PEDIDOS.TIPO_BIEN = '$tipobien') and
            (SIG_DETALLE_PEDIDOS.TIPO_PEDIDO = '$tipopedido' ) and
            ISNULL(TRY_CAST( SIG_DETALLE_PEDIDOS.NRO_PEDIDO as int ), 0)  = ISNULL(TRY_CAST( '$nropedido' as int ), 0)");        
            return $data->result();
        }  
    }
    function DetallePorCadaPedido1($nropedido,$anio,$tipopedido,$tipobien, $sec_ejec)
    {
        
            $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select sdp.GRUPO_BIEN+sdp.CLASE_BIEN+sdp.FAMILIA_BIEN+sdp.ITEM_BIEN as codigo,(select NOMBRE_ITEM from CATALOGO_BIEN_SERV_ORIGINAL WHERE GRUPO_BIEN+CLASE_BIEN+FAMILIA_BIEN+ITEM_BIEN=sdp.GRUPO_BIEN+sdp.CLASE_BIEN+sdp.FAMILIA_BIEN+sdp.ITEM_BIEN) as DESCRIPCION,
            (select ABREVIATURA from UNIDAD_MEDIDA where UNIDAD_MEDIDA=sdp.UNIDAD_MEDIDA) as UNIDAD,sdp.CANT_SOLICITADA,sdp.CANT_APROBADA,sdp.CANT_ATENDIDA,sca.NRO_CONS_PAAC,sca2.NRO_ORDEN,sdp.NRO_PECOSA
            from (SIG_DETALLE_PEDIDOS sdp left join SIG_CUADRO_ADQUISICION sca
            on (sdp.NRO_CUADRO =sca.SEC_CUADRO and sdp.TIPO_BIEN=sca.tipo_bien and sdp.ANO_EJE=sca.ANO_EJE)) left JOIN SIG_CUADRO_ADQUISICION sca2
            on (sca.NRO_CONS_PAAC=sca2.NRO_CONS_PAAC and sca.tipo_bien=sca2.tipo_bien and sca.ANO_EJE=sca2.ANO_EJE and sca2.ESTADO=2)
            where sdp.ANO_EJE=".$anio." AND sdp.tipo_pedido=".$tipopedido." AND sdp.NRO_PEDIDO=".$nropedido." and sdp.TIPO_BIEN='".$tipobien."' order by sdp.TIPO_BIEN,sdp.NRO_PEDIDO,DESCRIPCION");
             return $data->result();
    }

    function listaExpedientes($anio,$codigounico,$sec_ejec)
    {
        $opcion='';
        if($sec_ejec=='001359')
            $opcion='listar_expedientes_proyecto_chinc';
        if($sec_ejec=='001546')
            $opcion='listar_expedientes_proyecto_cotab';

        $data=$this->db->query("exec sp_gestionar_siaf @opcion = '$opcion', @anio_meta = '$anio', @codigo_snip='$codigounico'");        
        return $data->result(); 
    }

    function DetalleOrdenExpedSiaf($anio,$expsiaf,$sec_ejec)
    {
        if($sec_ejec=='748')
        {
            $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='consulta_expediente_siaf_anda', @anio_meta='".$anio."', @expediente_siaf='".$expsiaf."'");        
            return $data->result();
        }
        else
        {
            $data = $this->db->query("execute sp_Gestionar_SIAF @opcion='consulta_expediente_siaf', @anio_meta='".$anio."', @expediente_siaf='".$expsiaf."'");        
            return $data->result();
        } 
    }

    function DetalleConsultaExpedSiaf($anio,$expsiaf,$sec_ejec)
    {
        $data = $this->db->query("execute Consulta_Dato_Expediente_Administrativo @sec_ejec='$sec_ejec', @expediente='$expsiaf', @anio='$anio'");        
        
        return $data->result();
    }

    function Consulta_Expediente_Secuencia($anio, $expsiaf, $sec_ejec)
    {
        $data = $this->db->query("execute Consulta_Expediente_Secuencia @sec_ejec='$sec_ejec', @expediente='$expsiaf', @anio='$anio'");        
        
        return $data->result();
    }

    function ExpedienteDevengadoMeta($sec_ejec, $meta, $anio, $mes, $fuenteFinanciamiento)
    {
        if($fuenteFinanciamiento=='TODOS')
        {
            $data = $this->db->query("execute Consulta_Expediente_Devengado_Meta @sec_ejec='$sec_ejec', @meta='$meta', @anio='$anio', @mes='$mes'");

            return $data->result();
        }
        else
        {
            $data = $this->db->query("execute Consulta_Expediente_Devengado_Fuente @sec_ejec='$sec_ejec', @meta='$meta', @anio='$anio', @mes='$mes', @fuente='$fuenteFinanciamiento'");

            return $data->result();
        }        
    }

    function DatosOrdenSiga($meta, $nro_orden, $anio, $expediente)
    {
        $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select SIG_ORDEN_ADQUISICION.ANO_EJE, SIG_ORDEN_ADQUISICION.SEC_EJEC, SIG_ORDEN_PRESUPUESTO.SEC_FUNC, SIG_ORDEN_ADQUISICION.NRO_ORDEN, SIG_ORDEN_ADQUISICION.EXP_SIAF, 
            SIG_CONTRATISTAS.NOMBRE_PROV, SIG_ORDEN_ADQUISICION.TIPO_BIEN, SIG_ORDEN_ADQUISICION.TIPO_PPTO
            from SIG_ORDEN_ADQUISICION INNER JOIN
            SIG_CONTRATISTAS ON SIG_ORDEN_ADQUISICION.PROVEEDOR = SIG_CONTRATISTAS.PROVEEDOR INNER JOIN
            SIG_ORDEN_PRESUPUESTO ON SIG_ORDEN_ADQUISICION.NRO_ORDEN = SIG_ORDEN_PRESUPUESTO.NRO_ORDEN AND 
            SIG_ORDEN_ADQUISICION.ANO_EJE = SIG_ORDEN_PRESUPUESTO.ANO_EJE AND 
            SIG_ORDEN_ADQUISICION.SEC_EJEC = SIG_ORDEN_PRESUPUESTO.SEC_EJEC AND 
            SIG_ORDEN_ADQUISICION.TIPO_BIEN = SIG_ORDEN_PRESUPUESTO.TIPO_BIEN AND 
            SIG_ORDEN_ADQUISICION.TIPO_PPTO = SIG_ORDEN_PRESUPUESTO.TIPO_PPTO 
            WHERE SIG_ORDEN_PRESUPUESTO.SEC_FUNC='".$meta."' and SIG_ORDEN_PRESUPUESTO.ANO_EJE='".$anio."' and SIG_ORDEN_PRESUPUESTO.NRO_ORDEN='".$nro_orden."' and SIG_ORDEN_ADQUISICION.EXP_SIAF='".$expediente."'");
             return $data->result();
        
    }

    function ConsultaDetalleOrden($nro_orden, $tipo_bien, $tipo_ppto, $sec_ejec, $anio)
    {
        $data = $this->db->query("execute Consulta_Detalle_Orden @nro_orden='$nro_orden', @tipo_bien='$tipo_bien', @tipo_ppto='$tipo_ppto', @sec_ejec='$sec_ejec', @anio='$anio'");

        return $data->result();
    }

    function ConsultaTipoDocumento($expediente, $anio)
    {
        $data = $this->db->query("execute Consulta_Tipo_Documento @expediente='$expediente', @anio='$anio'");

        return $data->result();      
    }

    function ConsultaComprobantePago($expediente, $anio)
    {
        $data = $this->db->query("execute Consulta_Comprobante_Pago @expediente='$expediente', @anio='$anio'");

        return $data->result();      
    }

    function ConsultaNombreComprobante($expediente, $anio)
    {
        $data = $this->db->query("execute Consulta_Nombre_Comprobante @expediente='$expediente', @anio='$anio'");

        return $data->result();      
    }

    function ConsultaClasificadorExpediente($expediente, $meta, $anio)
    {
        $data = $this->db->query("execute Consulta_Clasificador_Expediente @expediente='$expediente', @meta='$meta', @anio='$anio'");

        return $data->result();      
    }

    function ConsultaClasificadorMeta($meta, $anio)
    {
        $data = $this->db->query("execute Consulta_Clasificador_Meta @meta='$meta', @anio='$anio'");

        return $data->result();      
    }

    function ConsultaMetaProyecto($codigoUnico)
    {
        $data = $this->db->query("execute Consulta_Metas_Proyecto @codigo_snip='$codigoUnico'");

        return $data->result(); 
    }

    function ConsultaMetaAcumulado($codigoUnico, $ano_eje)
    {
        $data = $this->db->query("execute ConsultaMetaAcumulado @ano_eje='$ano_eje', @act_proy='$codigoUnico'");

        return $data->result(); 
    }

    function ConsultaDevengadoAcumulado($ano_eje, $sec_ejec, $sec_func)
    {
        $data = $this->db->query("execute devengadoPorMeta @ano_eje='$ano_eje', @sec_ejec='$sec_ejec', @sec_func='$sec_func'");

        return $data->result(); 
    }

    function ListaExpedienteDevengadoOrden($anio, $meta, $mes)
    {
        $data = $this->db->query("execute SiafSigaExpeDevengado '$anio', '$meta', '$mes'");

        return $data->result();
    }

    function ConsultaFuenteFinanciamiento($sec_ejec, $anio, $meta)
    {
        $data = $this->db->query("execute Consulta_Fuente_Financiamiento @sec_ejec='$sec_ejec', @meta='$meta', @anio='$anio'");

        return $data->result();
    }

    function ConsultaFuenteFinanciamientoMeta($sec_ejec, $anio, $meta, $fuente_finan)
    {
        $data = $this->db->query("execute Consulta_Fuente_Financiamiento @sec_ejec='$sec_ejec', @meta='$meta', @anio='$anio', @fuente_finan='$fuente_finan'");

        return $data->result();
    }

    function ConsultaDevengadoMes($opcion, $meta, $sec_ejec, $anio, $mes)
    {
        $data = $this->db->query("execute Consulta_Devengado_Acumulado @opcion='$opcion',@meta='$meta', @anio='$anio', @mes='$mes',@sec_ejec='$sec_ejec'");

        return $data->result();        
    }

    function SumatoriaExpediente($ano_eje, $sec_ejec, $meta)
    {
        $data = $this->db->query("exec SumatoriaExpedientePorFase @ano_eje='$ano_eje', @sec_ejec='$sec_ejec', @sec_func='$meta'");

        return $data->result();  
    }

    function ExpedienteMensualizado($ano_eje, $sec_ejec, $meta,$mes_eje)
    {
        $data = $this->db->query("exec ExpedienteMensualizadoPorFase @ano_eje='$ano_eje', @sec_ejec='$sec_ejec', @sec_func='$meta', @mes_eje='$mes_eje'");

        return $data->result();  
    }

    function GastoPorClasificador($ano_eje, $sec_ejec, $act_proy)
    {
        $data = $this->db->query("exec sumatoriaPorClasificador @ano_eje='$ano_eje', @sec_ejec='$sec_ejec', @act_proy='$act_proy'");

        return $data->result();  
    }

    function RendidoPorClasificador($ano_eje, $sec_ejec, $act_proy)
    {
        $data = $this->db->query("exec sumatoriaRendicionPorClasificador @ano_eje='$ano_eje', @sec_ejec='$sec_ejec', @act_proy='$act_proy'");

        return $data->result();  
    }

    function DetalleOrdenExpedSiafUE($anio,$expsiaf,$sec_ejec)
    {
        $opcion='';
        if($sec_ejec=='001359')
            $opcion='consulta_expediente_siaf_chinc';
        if($sec_ejec=='001546')
            $opcion='consulta_expediente_siaf_cotab';

        $data = $this->db->query("exec sp_gestionar_siaf @opcion = '$opcion', @expediente_siaf= '$expsiaf', @anio_meta='$anio', @sec_ejec='$sec_ejec'");        
        return $data->result(); 
    }

    function DetallePorCadaNumOrden($anio,$tipobien,$numorden,$tipoppto, $sec_ejec)
    {
        $opcion="listar_detalle_orden_compra";
        if($sec_ejec=='748')
        {
            $db_prueba = $this->load->database('SIGA_ANDAHUAYLAS', true);
            $data = $db_prueba->query("execute sp_Gestionar_SIGA @opcion='".$opcion."',  @anio_meta='".$anio."', @tipo_bien='".$tipobien."', @num_orden='".$numorden."',@tipo_ppto='".$tipoppto."', @sec_ejec=".$sec_ejec."");        
            return $data->result(); 
        }
        else
        {
            $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select CATALOGO_BIEN_SERV.CODIGO_ITEM, CATALOGO_BIEN_SERV.NOMBRE_ITEM, SIG_ORDEN_ITEM.CANT_ITEM, 
            SIG_ORDEN_ITEM.PREC_UNIT_MONEDA, SIG_ORDEN_ITEM.PREC_TOT_MONEDA, SIG_ORDEN_ITEM.ITEM_BIEN
            FROM SIGA_1549.dbo.SIG_ORDEN_ITEM INNER JOIN
            SIGA_1549.dbo.CATALOGO_BIEN_SERV ON SIG_ORDEN_ITEM.ITEM_BIEN = CATALOGO_BIEN_SERV.ITEM_BIEN AND 
            SIG_ORDEN_ITEM.GRUPO_BIEN = CATALOGO_BIEN_SERV.GRUPO_BIEN AND 
            SIG_ORDEN_ITEM.CLASE_BIEN = CATALOGO_BIEN_SERV.CLASE_BIEN AND 
            SIG_ORDEN_ITEM.FAMILIA_BIEN = CATALOGO_BIEN_SERV.FAMILIA_BIEN AND 
            SIG_ORDEN_ITEM.SEC_EJEC = CATALOGO_BIEN_SERV.SEC_EJEC AND 
            SIG_ORDEN_ITEM.TIPO_BIEN = CATALOGO_BIEN_SERV.TIPO_BIEN
            WHERE SIG_ORDEN_ITEM.ano_eje = '$anio' and SIG_ORDEN_ITEM.sec_ejec = '$sec_ejec' and SIG_ORDEN_ITEM.NRO_ORDEN = '$numorden' and 
            SIG_ORDEN_ITEM.TIPO_BIEN = '$tipobien' and SIG_ORDEN_ITEM.TIPO_PPTO = '$tipoppto'
            ORDER BY CATALOGO_BIEN_SERV.NOMBRE_ITEM");        
            return $data->result();
        }
    }

    function EspecificacionOrden($anio,$tipobien,$numorden, $sec_ejec)
    {
        $opcion="listar_pedidos_proyecto";
        if($sec_ejec=='748')
        {
            $db_prueba = $this->load->database('SIGA_ANDAHUAYLAS', true);
            $data = $db_prueba->query("select o.FECHA_REG,c.NOMBRE_ITEM,m.ABREVIATURA,o.CANT_ITEM,o.PREC_UNIT_MONEDA,o.PREC_TOT_MONEDA,o.ESPECIFICACIONES  
            from SIGA_1549.dbo.SIG_ORDEN_ITEM o inner join SIGA_1549.dbo.CATALOGO_BIEN_SERV c 
            on o.TIPO_BIEN=c.TIPO_BIEN and o.GRUPO_BIEN=c.GRUPO_BIEN and o.CLASE_BIEN=c.CLASE_BIEN and o.FAMILIA_BIEN=c.FAMILIA_BIEN and o.ITEM_BIEN=c.ITEM_BIEN
            inner join SIGA_1549.dbo.UNIDAD_MEDIDA m on c.UNIDAD_MEDIDA=m.UNIDAD_MEDIDA
            where o.ANO_EJE='$anio' and o.SEC_EJEC='$sec_ejec' and o.TIPO_BIEN='$tipobien' and o.NRO_ORDEN='$numorden'");        
            return $data->result(); 
        }
        else
        {
            $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
            $data = $db_sedecentral->query("select o.FECHA_REG,c.NOMBRE_ITEM,m.ABREVIATURA,o.CANT_ITEM,o.PREC_UNIT_MONEDA,o.PREC_TOT_MONEDA,o.ESPECIFICACIONES 
            from SIGA_1549.dbo.SIG_ORDEN_ITEM o inner join SIGA_1549.dbo.CATALOGO_BIEN_SERV c 
            on o.TIPO_BIEN=c.TIPO_BIEN and o.GRUPO_BIEN=c.GRUPO_BIEN and o.CLASE_BIEN=c.CLASE_BIEN and o.FAMILIA_BIEN=c.FAMILIA_BIEN and o.ITEM_BIEN=c.ITEM_BIEN
            inner join SIGA_1549.dbo.UNIDAD_MEDIDA m on c.UNIDAD_MEDIDA=m.UNIDAD_MEDIDA
            where o.ANO_EJE='$anio' and o.SEC_EJEC='$sec_ejec' and o.TIPO_BIEN='$tipobien' and o.NRO_ORDEN='$numorden'");        
            return $data->result(); 
        }
    }
    function ReporteConsolidadoAvancePorOficina($cod_principal,$anio, $sec_ejec, $tipo_proyecto)
    {
       
        if($tipo_proyecto=='')
        {            
            $data = $this->db->query("execute sp_AvancePorOficinas @cod_principal='".$cod_principal."', @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto=NULL");            
            return $data->result(); 
        }
        else
        {
            $data = $this->db->query("execute sp_AvancePorOficinas @cod_principal='".$cod_principal."', @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto='".$tipo_proyecto."'");            
            return $data->result(); 
        }
    }
    function avanceSinOficina($anio, $sec_ejec, $tipo_proyecto)
    {
        if($tipo_proyecto=='')
        {            
            $dataSinOfi = $this->db->query("execute sp_avanceSinOficina @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto=NULL");            
            return $dataSinOfi->result(); 
        }
        else
        {
            $dataSinOfi = $this->db->query("execute sp_avanceSinOficina @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto='".$tipo_proyecto."'");            
            return $dataSinOfi->result(); 
        }
    }
    function proyectosPorOficina($cod_principal,$anio,$sec_ejec,$tipo_proyecto)
    {
        if($tipo_proyecto=='')
        {            
            $data = $this->db->query("execute sp_ProyectosPorOficina @cod_principal='".$cod_principal."', @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto=NULL");            
            return $data->result(); 
        }
        else
        {
            $data = $this->db->query("execute sp_ProyectosPorOficina @cod_principal='".$cod_principal."', @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto='".$tipo_proyecto."'");            
            return $data->result(); 
        }
    }
    function proysinoficina($anio, $sec_ejec, $tipo_proyecto)
    {
        if($tipo_proyecto=='')
        {            
            $dataSinOfi = $this->db->query("execute proysinofi @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto=NULL");            
            return $dataSinOfi->result(); 
        }
        else
        {
            $dataSinOfi = $this->db->query("execute proysinofi @anio_meta ='".$anio."', @sec_ejec='".$sec_ejec."', @tipo_proyecto='".$tipo_proyecto."'");            
            return $dataSinOfi->result(); 
        }
    }
    function detalleProys($sec_func,$act_proy,$anio)
    {
        $dataDetalle=$this->db->query("execute sp_detalleProys @sec_func='".$sec_func."',@act_proy ='".$act_proy."', @ano_eje='".$anio."'");
        return $dataDetalle->result();
    }
}
