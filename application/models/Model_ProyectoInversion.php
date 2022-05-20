<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_ProyectoInversion extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    function Insert_pi_pip($data)
    {
        $this->db->insert('PROYECTO_INVERSION', $data);
        return $this->db->insert_id();
    }
    function BuscarLike($like)
    {
        $ProyectoInversionLike=$this->db->query("select codigo_unico_pi ,(codigo_unico_pi+' '+nombre_pi) as proyecto from PROYECTO_INVERSION where codigo_unico_pi like '%'+replace('".$like."', ' ', '')+'%' or nombre_pi like '%'+replace('".$like."', ' ', '')+'%';");
        return $ProyectoInversionLike->result();
    }
    function editar($data, $idPi)
    {
        $this->db->set($data);
        $this->db->where('id_pi', $idPi);
        $this->db->update('PROYECTO_INVERSION');
        return $this->db->affected_rows();
    }

    function GetProyectoInversionUltimo()
    {
        $ProyectoInversionUlti=$this->db->query("execute sp_ProyectoInversionUltimo_r");
        return $ProyectoInversionUlti->result();
    }

    function ProyectoInversion()
    {
        $ProyectoInversion=$this->db->query("execute sp_ProyectoInversion_r");
        return $ProyectoInversion->result();
    }

    function BuscarProyectoInversion($Id_ProyectoInver)
    {
        $ProyectoInversion=$this->db->query("execute sp_ProyectoInversion_Buscar'".$Id_ProyectoInver."'");
        return $ProyectoInversion->result();
    }

    function getProyectoInversionByET($idPI)
    {
        $proyectoInversionET = $this->db->query("select * from PROYECTO_INVERSION where id_pi=".$idPI);
        return $proyectoInversionET->result();
    }

    public function insertConformidad($data)
    {
        $this->db->insert('CONF_ORDEN', $data);
        return $this->db->insert_id();
    }

    public function updateConformidad($pathfile, $nro_orden)
    {
        $data = array(
            'pathfile' => $pathfile,
        );

        $this->db->where('nro_orden', $nro_orden);
        $this->db->update('CONF_ORDEN', $data);
    }

    public function getConformidadOrden($data)
    {
        $conformidadOrden = $this->db->query("select * from CONF_ORDEN where nro_orden=".$data);
        return $conformidadOrden->result();
    }

    public function insertOrdenServicio($data)
    {
        $this->db->insert('ORDEN_SERVICIO', $data);
        return $this->db->insert_id();
    }
	public function ReportePIPPedidosMes($annio,$ue,$meta,$mes)
    {
		
		if($mes=="todomes"){
			
			    $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
			
			$datass = $db_sedecentral->query("	
						select SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.NRO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, 
            CAST(SIG_PEDIDOS.MOTIVO_PEDIDO AS varchar(max)) as DESCRIPCION, SIG_PEDIDOS.sec_func, SIG_PEDIDOS.FECHA_APROB, 
            SIG_PEDIDOS.SEC_EJEC, SUM(SIG_DETALLE_PEDIDOS.CANT_APROBADA ) as TOTAL
            FROM SIGA_1549.dbo.SIG_PEDIDOS , SIGA_1549.dbo.SIG_DETALLE_PEDIDOS
            WHERE    SIG_DETALLE_PEDIDOS.NRO_PEDIDO = SIG_PEDIDOS.NRO_PEDIDO AND SIG_PEDIDOS.TIPO_BIEN=SIG_DETALLE_PEDIDOS.TIPO_BIEN AND SIG_PEDIDOS.TIPO_PEDIDO=SIG_DETALLE_PEDIDOS.TIPO_PEDIDO AND 
			SIG_PEDIDOS.ANO_EJE = SIG_DETALLE_PEDIDOS.ANO_EJE AND SIG_PEDIDOS.SEC_EJEC= SIG_DETALLE_PEDIDOS.SEC_EJEC
			AND (SIG_PEDIDOS.ANO_EJE = '".$annio."') AND SIG_PEDIDOS.SEC_EJEC = '".$ue."' AND
            ISNULL(TRY_CAST( SIG_PEDIDOS.sec_func as int ), 0)  = ISNULL(TRY_CAST( '".$meta."' as int ), 0)   
			GROUP BY SIG_PEDIDOS.NRO_PEDIDO,SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, CAST(SIG_PEDIDOS.MOTIVO_PEDIDO AS varchar(max)) ,SIG_PEDIDOS.sec_func,SIG_PEDIDOS.FECHA_APROB,SIG_PEDIDOS.SEC_EJEC
			ORDER BY SIG_PEDIDOS.FECHA_PEDIDO DESC

			
			"); 
			
            return $datass->result_array();
			
			
		}else{
		
		    $db_sedecentral = $this->load->database('SIGA_SEDECENTRAL', true);
			
			$datass = $db_sedecentral->query("	
						select SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.NRO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, 
            CAST(SIG_PEDIDOS.MOTIVO_PEDIDO AS varchar(max)) as DESCRIPCION, SIG_PEDIDOS.sec_func, SIG_PEDIDOS.FECHA_APROB, 
            SIG_PEDIDOS.SEC_EJEC, SUM(SIG_DETALLE_PEDIDOS.CANT_APROBADA ) as TOTAL
            FROM SIGA_1549.dbo.SIG_PEDIDOS , SIGA_1549.dbo.SIG_DETALLE_PEDIDOS
            WHERE    SIG_DETALLE_PEDIDOS.NRO_PEDIDO = SIG_PEDIDOS.NRO_PEDIDO AND SIG_PEDIDOS.TIPO_BIEN=SIG_DETALLE_PEDIDOS.TIPO_BIEN AND SIG_PEDIDOS.TIPO_PEDIDO=SIG_DETALLE_PEDIDOS.TIPO_PEDIDO AND 
			SIG_PEDIDOS.ANO_EJE = SIG_DETALLE_PEDIDOS.ANO_EJE AND SIG_PEDIDOS.SEC_EJEC= SIG_DETALLE_PEDIDOS.SEC_EJEC
			AND (SIG_PEDIDOS.ANO_EJE = '".$annio."') AND SIG_PEDIDOS.SEC_EJEC = '".$ue."' AND
            ISNULL(TRY_CAST( SIG_PEDIDOS.sec_func as int ), 0)  = ISNULL(TRY_CAST( '".$meta."' as int ), 0) AND MONTH(FECHA_PEDIDO)='".$mes."'  
			GROUP BY SIG_PEDIDOS.NRO_PEDIDO,SIG_PEDIDOS.ANO_EJE, SIG_PEDIDOS.TIPO_BIEN, SIG_PEDIDOS.TIPO_PEDIDO, SIG_PEDIDOS.FECHA_PEDIDO, CAST(SIG_PEDIDOS.MOTIVO_PEDIDO AS varchar(max)) ,SIG_PEDIDOS.sec_func,SIG_PEDIDOS.FECHA_APROB,SIG_PEDIDOS.SEC_EJEC
			ORDER BY SIG_PEDIDOS.FECHA_PEDIDO DESC

			
			"); 
			
            return $datass->result_array();
		}
	
		
		
		
    }
	
	
	
    public function updateOrdenServicio($pathfile, $nro_orden)
    {
        $data = array(
            'pathfile' => $pathfile,
        );

        $this->db->where('nro_orden', $nro_orden);
        $this->db->update('ORDEN_SERVICIO', $data);
    }

    public function getOrdenServicio($data)
    {
        $conformidadOrden = $this->db->query("select * from ORDEN_SERVICIO where nro_orden=".$data);
        return $conformidadOrden->result();
    }

    public function getProyectoInversionPorIdPi($idPi)
    {
        $data=$this->db->query("select p.*, g.id_grup_funcional, d.id_div_funcional, f.id_funcion  
        from PROYECTO_INVERSION p inner join  GRUPO_FUNCIONAL g on p.id_grupo_funcional=g.id_grup_funcional
        inner join DIVISION_FUNCIONAL d on g.id_div_funcional=d.id_div_funcional
        inner join FUNCION f on f.id_funcion=d.id_funcion
        where p.id_pi='$idPi'");
        return $data->result();
    }

    public function getProyectoInversionNoPipPorIdPi($idPi)
    {
        $data=$this->db->query("select p.*, g.id_grup_funcional,d.id_div_funcional,f.id_funcion,n.id_nopip,n.id_tipo_nopip
        from PROYECTO_INVERSION p inner join  GRUPO_FUNCIONAL g on p.id_grupo_funcional=g.id_grup_funcional
        inner join DIVISION_FUNCIONAL d on g.id_div_funcional=d.id_div_funcional
        inner join FUNCION f on f.id_funcion=d.id_funcion inner join NOPIP n on p.id_pi=n.id_pi 
        where p.id_pi='$idPi'");
        return $data->result();
    }

    public function ProyectoPorCodigoUnico($codigoUnico)
    {
        $data = $this->db->query("select * from PROYECTO_INVERSION where codigo_unico_pi='$codigoUnico'");
        return $data->result();
    }

    public function ProyectoPorCodigoUnicoDiferente($codigoUnico, $idPi)
    {
        $data = $this->db->query("select * from PROYECTO_INVERSION where codigo_unico_pi='$codigoUnico' and id_pi<>'$idPi'");
        return $data->result();
    }

    public function RestoreDB($codigo,$proyecto,$fecha,$urlDB){
        $nameDB=(string)$codigo;
        $delete=$this->db->query("delete from [dbo].[BD_S10] where CodigoUnico='".$codigo."'");
        $insert=$this->db->query("insert into [dbo].[BD_S10] ([CodigoUnico],[Proyecto],[FechaSubida]) VALUES('".$codigo."','".$proyecto."','".$fecha."')");
        $query="\"IF EXISTS(SELECT * FROM DBO.SYSDATABASES WHERE NAME = '".$nameDB."') BEGIN ALTER DATABASE [".$nameDB."] set single_user with rollback immediate DROP DATABASE [".$nameDB."] END RESTORE DATABASE [".$nameDB."] FROM DISK = '".$urlDB."' WITH MOVE 'S10_Data' TO 'C:\S102000\Data\ ".$nameDB."_1.mdf', MOVE 'S10_Datos' TO 'C:\S102000\Data\ ".$nameDB."_2.ndf', MOVE 'S10_Log' TO 'C:\S102000\Data\ ".$nameDB."_3.ldf', REPLACE\"";
        $cmd = "osql -U \"my\" -P \"123456789\" -S \"DESKTOP-N1LQMHP\" -Q " .$query;
        return passthru( $cmd );
    }
    public function DeleteDB($codigo){
        $delete=$this->db->query("delete from [dbo].[BD_S10] where CodigoUnico='".$codigo."'");
        $deleteBD=$this->db->query("IF EXISTS(SELECT * FROM DBO.SYSDATABASES WHERE NAME = '".$codigo."') BEGIN ALTER DATABASE [".$codigo."] set single_user with rollback immediate DROP DATABASE [".$codigo."] END");
        return $deleteBD->result();
    }

    /* IMPORTAR S10 A TABLAS */
    function ImportarTableS10($CodigoUnico)
    {
        // Insertar tabla PRESUPUESTO S10
        $listaPresupuesto = $this->db->query("select p.codpresupuesto as Codigo,p.descripcion as Descripcion,i.descripcion as Cliente,  
		p.Fecha,p.Plazo,p.Jornada,p.fechaproceso as Fecha_Proceso, p.CostoDirectoBase1 as Costo_Directo_Base, p.CostoIndirectoBase1 as Costo_Indirecto_Base,
		p.CostoBase1 as Costo_Base, p.CostodirectoOferta1 as Costo_Directo_Oferta, p.CostoIndirectoOferta1 as Costo_Indirecto_Oferta, p.CostoOferta1 as Costo_Oferta,
		p.CostodirectoOfertatotal1 as Costo_Directo_Oferta_Total, p.CostoIndirectoOfertaTotal1 as Costo_Indirecto_Oferta_Total, p.CostoOfertaTotal1 as Costo_Oferta_Total
		from ([".$CodigoUnico."].dbo.presupuesto p inner join [".$CodigoUnico."].dbo.identificador i
		ON p.codidentificador=i.codidentificador )")->result();
		foreach($listaPresupuesto as $valor){
            $validarPresupuesto = count($this->db->query("select * from S10_PRESUPUESTO where Codigo='".$valor->Codigo."' and Codigo_Proyecto='".$CodigoUnico."'")->result());
            if ($validarPresupuesto===0) {
                $p_data['Codigo'] = $valor->Codigo;           
                $p_data['Codigo_Proyecto'] = $CodigoUnico;         
                $p_data['Descripcion'] = $valor->Descripcion;           
                $p_data['Cliente'] = $valor->Cliente;          
                $p_data['Lugar'] = '';           
                $p_data['Fecha'] = $valor->Fecha;                          
                $p_data['Jornada'] = $valor->Jornada;           
                $p_data['Fecha_Proceso'] = $valor->Fecha_Proceso;                          
                $p_data['Costo_Indirecto_Base'] = $valor->Costo_Indirecto_Base;           
                $p_data['Costo_Base'] = $valor->Costo_Base;           
                $p_data['Costo_Directo_Oferta'] = $valor->Costo_Directo_Oferta;           
                $p_data['Costo_Indirecto_Oferta'] = $valor->Costo_Indirecto_Oferta;         
                $p_data['Costo_Oferta'] = $valor->Costo_Oferta;          
                $p_data['Costo_Directo_Oferta_Total'] = $valor->Costo_Directo_Oferta_Total;           
                $p_data['Costo_Indirecto_Oferta_Total'] = $valor->Costo_Indirecto_Oferta_Total;           
                $p_data['Costo_Oferta_Total'] = $valor->Costo_Oferta_Total;
                $this->db->insert('S10_PRESUPUESTO',$p_data);           
            } else {       
                $p_data['Descripcion'] = $valor->Descripcion;           
                $p_data['Cliente'] = $valor->Cliente;          
                $p_data['Lugar'] = $valor->Lugar;           
                $p_data['Fecha'] = $valor->Fecha;                          
                $p_data['Jornada'] = $valor->Jornada;           
                $p_data['Fecha_Proceso'] = $valor->Fecha_Proceso;                          
                $p_data['Costo_Indirecto_Base'] = $valor->Costo_Indirecto_Base;           
                $p_data['Costo_Base'] = $valor->Costo_Base;           
                $p_data['Costo_Directo_Oferta'] = $valor->Costo_Directo_Oferta;           
                $p_data['Costo_Indirecto_Oferta'] = $valor->Costo_Indirecto_Oferta;         
                $p_data['Costo_Oferta'] = $valor->Costo_Oferta;          
                $p_data['Costo_Directo_Oferta_Total'] = $valor->Costo_Directo_Oferta_Total;           
                $p_data['Costo_Indirecto_Oferta_Total'] = $valor->Costo_Indirecto_Oferta_Total;           
                $p_data['Costo_Oferta_Total'] = $valor->Costo_Oferta_Total; 
                $this->db->set($p_data);
                $this->db->where('Codigo',$valor->Codigo);
                $this->db->where('Codigo_Proyecto',$CodigoUnico);
                $this->db->update('S10_PRESUPUESTO');
            }
            //Insertar tabla COMPONENTE S10
			$listaSubPresupuesto= $this->db->query("select sp.descripcion AS descripcion,sp.CodSubpresupuesto from [".$CodigoUnico."].[dbo].presupuesto p inner join  [".$CodigoUnico."].[dbo].subpresupuesto sp 
            ON p.codpresupuesto=sp.codpresupuesto where p.Nivel=3 and sp.codsubpresupuesto!='999' and p.CodPresupuesto='".$valor->Codigo."'")->result();
			foreach($listaSubPresupuesto as $valorS){
               $SubPresupuesto = $this->db->query("select * from S10_COMPONENTE where Codigo='".$valorS->CodSubpresupuesto."' and Codigo_Presupuesto='".$valor->Codigo."' and Codigo_Proyecto='".$CodigoUnico."'")->result();
               $validarSubPresupuesto = count($SubPresupuesto);
               $idSubpresupuesto = $this->db->insert_id();
                if ($validarSubPresupuesto===0) {
                    $sp_data['Codigo'] = $valorS->CodSubpresupuesto;
                    $sp_data['Codigo_Presupuesto'] = $valor->Codigo;           
                    $sp_data['Codigo_Proyecto'] = $CodigoUnico;         
                    $sp_data['Descripcion'] = $valorS->descripcion;    
                    $this->db->insert('S10_COMPONENTE',$sp_data); 
                    $idSubpresupuesto = $this->db->insert_id();          
                } else {
                    $sp_data['Descripcion'] = $valorS->descripcion;           
                    $this->db->set($sp_data);
                    $this->db->where('Codigo',$valorS->CodSubpresupuesto);
                    $this->db->where('Codigo_Presupuesto',$valor->Codigo);
                    $this->db->where('Codigo_Proyecto',$CodigoUnico);
                    $this->db->update('S10_COMPONENTE');
                    foreach($SubPresupuesto as $valorSP){$idSubpresupuesto = $valorSP->Id;}
                }
                // Insertar tabla META - PARTIDA S10
                $listaMetaPartida= $this->db->query("select spd.codpresupuesto,spd.codsubpresupuesto,spd.secuencial,spd.nivel,spd.orden,t.Descripcion as titulos,p.descripcion as partida,u.simbolo, u.Descripcion as unidadDesc, 
                spd.metrado, spd.precio1 as Precio, spd.parcial1 as Parcial, spd.Tipo,spd.codtitulo,spd.codpartida,(spd.codpresupuesto+' '+spd.propiopartida) as Codigo
                ,p.Jornada,(select sum(ppa.Parcial1)  from ([".$CodigoUnico."].[dbo].partidadetalle pd inner join [".$CodigoUnico."].[dbo].insumo i on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].[dbo].presupuestopartidaanalisis ppa ON i.codinsumo=ppa.codinsumo
                where pd.codpresupuesto='".$valor->Codigo."' and pd.codpartida=spd.CodPartida and ppa.codpresupuesto='".$valor->Codigo."' and ppa.codsubpresupuesto='".$valorS->CodSubpresupuesto."'
                and ppa.codpartida=spd.CodPartida  and ppa.tipo=1) as Mano_Obra,(select sum(ppa.Parcial1)  from ([".$CodigoUnico."].[dbo].partidadetalle pd inner join [".$CodigoUnico."].[dbo].insumo i on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].[dbo].presupuestopartidaanalisis ppa ON i.codinsumo=ppa.codinsumo
                where pd.codpresupuesto='".$valor->Codigo."' and pd.codpartida=spd.CodPartida  and ppa.codpresupuesto='".$valor->Codigo."' and ppa.codsubpresupuesto='".$valorS->CodSubpresupuesto."'
                and ppa.codpartida=spd.CodPartida  and ppa.tipo=2) as Materiales,(select sum(ppa.Parcial1)  from ([".$CodigoUnico."].[dbo].partidadetalle pd inner join [".$CodigoUnico."].[dbo].insumo i on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].[dbo].presupuestopartidaanalisis ppa ON i.codinsumo=ppa.codinsumo
                where pd.codpresupuesto='".$valor->Codigo."' and pd.codpartida=spd.CodPartida  and ppa.codpresupuesto='".$valor->Codigo."' and ppa.codsubpresupuesto='".$valorS->CodSubpresupuesto."'
                and ppa.codpartida=spd.CodPartida  and ppa.tipo=3) as Equipos,spd.subcontrato1 as Subcontratos,spd.subpartida1 as Subpartidas,
                p.Horashombrepartida as Productividadhh,p.HorasMaquinaPotencia as Productividadhm,p.RendimientoMO as Rendimiento_MO,p.rendimientoEQ as Rendimiento_EQ ,p.peso,p.precio1 as Precio_Unitario
                from (([".$CodigoUnico."].[dbo].subpresupuestodetalle spd inner JOIN [".$CodigoUnico."].[dbo].titulo t
                on spd.codtitulo=t.codtitulo) LEFT join [".$CodigoUnico."].[dbo].partida p
                on spd.codpartida=p.codpartida) left join [".$CodigoUnico."].[dbo].unidad u on p.codunidad=u.codunidad
                where spd.codpresupuesto='".$valor->Codigo."' and spd.codsubpresupuesto='".$valorS->CodSubpresupuesto."'and (p.PropioPartida='01' or p.PropioPartida='99') and(p.codpresupuesto='".$valor->Codigo."' or p.codpartida='999999999999') 
                order by spd.orden,spd.secuencial")->result();
                foreach($listaMetaPartida as $valorMP){
                    $metaPartida = $this->db->query("select * from S10_META_PARTIDA where Cod_Titulo='".$valorMP->codtitulo."' and Cod_Partida='".$valorMP->codpartida."' and Codigo_Presupuesto='".$valor->Codigo."' and Codigo_Subpresupuesto='".$valorS->CodSubpresupuesto."' and Codigo_Proyecto='".$CodigoUnico."' and Secuencial='".$valorMP->secuencial."'")->result();
                    $validarMetaPartida = count($metaPartida);
                    if ($validarMetaPartida===0) {
                        $mp_data['Codigo_Subpresupuesto'] = $valorS->CodSubpresupuesto;   
                        $mp_data['Codigo_Presupuesto'] = $valor->Codigo;           
                        $mp_data['Codigo_Proyecto'] = $CodigoUnico;    
                        $mp_data['Cod_Titulo'] = $valorMP->codtitulo;  
                        $mp_data['Cod_Partida'] = $valorMP->codpartida;       
                        $mp_data['Secuencial'] = $valorMP->secuencial; 
                        $mp_data['Nivel'] = $valorMP->nivel;  
                        $mp_data['Orden'] = $valorMP->orden;     
                        $mp_data['Titulo'] = $valorMP->titulos;  
                        $mp_data['Partida'] = $valorMP->partida;  
                        $mp_data['Simbolo'] = $valorMP->simbolo;  
                        $mp_data['Metrado'] = $valorMP->metrado;  
                        $mp_data['Precio'] = $valorMP->Precio;  
                        $mp_data['Parcial'] = $valorMP->Parcial;  
                        $mp_data['Tipo'] = $valorMP->Tipo;  
                        $mp_data['Codigo'] = $valorMP->Codigo;  
                        $mp_data['Jornada'] = $valorMP->Jornada;  
                        $mp_data['Mano_Obra'] = $valorMP->Mano_Obra;  
                        $mp_data['Materiales'] = $valorMP->Materiales;
                        $mp_data['Equipos'] = $valorMP->Equipos;  
                        $mp_data['Subcontrato'] = $valorMP->Subcontratos;  
                        $mp_data['Subpartida'] = $valorMP->Subpartidas;
                        $mp_data['ProductividadHH'] = $valorMP->Productividadhh;  
                        $mp_data['ProductividadHM'] = $valorMP->Productividadhm;  
                        $mp_data['Rendimiento_MO'] = $valorMP->Rendimiento_MO;
                        $mp_data['Rendimiento_EQ'] = $valorMP->Rendimiento_EQ;  
                        $mp_data['Peso'] = $valorMP->peso;  
                        $mp_data['Precio_Unitario'] = $valorMP->Precio_Unitario;
                        $mp_data['Id_Subpresupuesto'] = $idSubpresupuesto;
                        $mp_data['UnidadDesc'] = $valorMP->unidadDesc;
                        $this->db->insert('S10_META_PARTIDA',$mp_data);  
                        $idMetaPartida = $this->db->insert_id();      
                    } else {  
                        $mp_data['Nivel'] = $valorMP->nivel;  
                        $mp_data['Orden'] = $valorMP->orden;     
                        $mp_data['Titulo'] = $valorMP->titulos;  
                        $mp_data['Partida'] = $valorMP->partida;  
                        $mp_data['Simbolo'] = $valorMP->simbolo;  
                        $mp_data['Metrado'] = $valorMP->metrado;  
                        $mp_data['Precio'] = $valorMP->Precio;  
                        $mp_data['Parcial'] = $valorMP->Parcial;  
                        $mp_data['Tipo'] = $valorMP->Tipo;  
                        $mp_data['Codigo'] = $valorMP->Codigo;  
                        $mp_data['Jornada'] = $valorMP->Jornada;  
                        $mp_data['Mano_Obra'] = $valorMP->Mano_Obra;  
                        $mp_data['Materiales'] = $valorMP->Materiales;
                        $mp_data['Equipos'] = $valorMP->Equipos;  
                        $mp_data['Subcontrato'] = $valorMP->Subcontratos;  
                        $mp_data['Subpartida'] = $valorMP->Subpartidas;
                        $mp_data['ProductividadHH'] = $valorMP->Productividadhh;  
                        $mp_data['ProductividadHM'] = $valorMP->Productividadhm;  
                        $mp_data['Rendimiento_MO'] = $valorMP->Rendimiento_MO;
                        $mp_data['Rendimiento_EQ'] = $valorMP->Rendimiento_EQ;  
                        $mp_data['Peso'] = $valorMP->peso;  
                        $mp_data['Precio_Unitario'] = $valorMP->Precio_Unitario; 
                        $mp_data['Id_Subpresupuesto'] = $idSubpresupuesto;        
                        $mp_data['UnidadDesc'] = $valorMP->unidadDesc;        
                        $this->db->set($mp_data);
                        $this->db->where('Codigo_Subpresupuesto',$valorS->CodSubpresupuesto); 
                        $this->db->where('Codigo_Presupuesto',$valor->Codigo);
                        $this->db->where('Codigo_Proyecto',$CodigoUnico);
                        $this->db->where('Cod_Titulo',$valorMP->codtitulo);
                        $this->db->where('Cod_Partida',$valorMP->codpartida);
                        $this->db->where('Secuencial',$valorMP->secuencial);
                        $this->db->update('S10_META_PARTIDA');
                        $idMetaPartida =  $metaPartida[0]->Id; 
                    }
                    if($valorMP->codtitulo === '9999999'){
                        // Insertar tabla COSTO UNITARIO S10
                        $deleteCostoUnitario = $this->db->query("delete from S10_COSTO_UNITARIO where Codigo_Partida='".$valorMP->codpartida."' and Codigo_Presupuesto='".$valor->Codigo."' and Codigo_Subpresupuesto='".$valorS->CodSubpresupuesto."' and Codigo_Proyecto='".$CodigoUnico."'");
                        $listaCostoUnitario= $this->db->query("select pd.codpresupuesto,u.Descripcion as unidadDesc,ppa.codsubpresupuesto,pd.codpartida,pd.CodPartidaR,i.codinsumo,i.descripcion,
                        (select Descripcion from [".$CodigoUnico."].dbo.Partida where CodPresupuesto='".$valor->Codigo."' and CodSubpresupuesto='".$valorS->CodSubpresupuesto."' and CodPartida=pd.CodPartidaR and PropioPartida='01') DescripcionR 
                        ,i.CodInsumoR,i.DescripcionAlterna,ppa.tipo,ppa.unidad,pd.cuadrilla,ppa.cantidad,ppa.precio1 as Precio,ppa.parcial1 as Parcial
                            from ([".$CodigoUnico."].dbo.partidadetalle pd inner join [".$CodigoUnico."].dbo.insumo i
                        on pd.codinsumo=i.codinsumo) inner join [".$CodigoUnico."].dbo.presupuestopartidaanalisis ppa
                        ON i.codinsumo=ppa.codinsumo and pd.CodPartidaR=ppa.CodPartidaR inner join [".$CodigoUnico."].dbo.Unidad u on u.simbolo=ppa.unidad
                        where pd.codpresupuesto='".$valor->Codigo."' and pd.codpartida='".$valorMP->codpartida."' and ppa.codpresupuesto='".$valor->Codigo."' and ppa.codsubpresupuesto='".$valorS->CodSubpresupuesto."'  and ppa.codpartida='".$valorMP->codpartida."' and pd.PropioPartida=(select top 1 max(pd.PropioPartida) 
                        from ([".$CodigoUnico."].dbo.partidadetalle pd inner join [".$CodigoUnico."].dbo.insumo i
                        on pd.codinsumo=i.codinsumo ) inner join [".$CodigoUnico."].dbo.presupuestopartidaanalisis ppa
                        ON i.codinsumo=ppa.codinsumo and pd.CodPartidaR=ppa.CodPartidaR
                       where pd.codpresupuesto='".$valor->Codigo."' and pd.codpartida='".$valorMP->codpartida."' and 
                       ppa.codpartida='".$valorMP->codpartida."' and ppa.codsubpresupuesto='".$valorS->CodSubpresupuesto."' and ppa.codpresupuesto='".$valor->Codigo."'
                       group by pd.PropioPartida order by pd.PropioPartida desc)")->result();
                        foreach($listaCostoUnitario as $valorCU){
                                $cu_data['Codigo_Subpresupuesto'] = $valorS->CodSubpresupuesto;   
                                $cu_data['Codigo_Presupuesto'] = $valor->Codigo;           
                                $cu_data['Codigo_Proyecto'] = $CodigoUnico;    
                                $cu_data['Codigo_Partida'] = $valorMP->codpartida;  
                                $cu_data['Codigo_Insumo'] = $valorCU->codinsumo;       
                                $cu_data['Descripcion'] = $valorCU->descripcion; 
                                $cu_data['Codigo_PartidaR'] = $valorCU->CodPartidaR;        
                                $cu_data['DescripcionR'] = $valorCU->DescripcionR; 
                                $cu_data['Tipo'] = $valorCU->tipo;  
                                $cu_data['Unidad'] = $valorCU->unidadDesc;    
                                $cu_data['Cuadrilla'] = $valorCU->cuadrilla;  
                                $cu_data['Cantidad'] = $valorCU->cantidad;  
                                $cu_data['Precio'] = $valorCU->Precio;  
                                $cu_data['Parcial'] = $valorCU->Parcial;  
                                $cu_data['Id_Partida'] = $idMetaPartida;  
                                $this->db->insert('S10_COSTO_UNITARIO',$cu_data);  
                        }
                    }
                }
            }
		}
    }
}
