<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FE_Presupuesto_Inv extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('Model_FE_Presupuesto_Inv');
		$this->load->model('Model_FE_Detalle_Gasto');
	}

	public function index()
    {
		$idEstInv = isset($_GET['id_est_inv']) ? $_GET['id_est_inv'] : '';
    	$nombreProyecto=$this->Model_FE_Presupuesto_Inv->nombreProyectoInvPorId($idEstInv);
    	$ListarPresupuesto=$this->Model_FE_Presupuesto_Inv->ListarPresupuesto($idEstInv);

        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view('Front/PresupuestoEstudioInversion/FEPresupuesto/index', ['ListarPresupuesto' => $ListarPresupuesto, 'nombreProyectoInv' => $nombreProyecto]);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

	public function insertar()
	{
		if($_POST)
		{
			$idEstudioInversion=$this->input->post('idEstudioInversion');
			$idSector=$this->input->post('cbx_Sector');
			$txtPliego=$this->input->post('txtPliego');

			$this->Model_FE_Presupuesto_Inv->insertar($idEstudioInversion, $idSector, $txtPliego);

			$data=$this->Model_FE_Presupuesto_Inv->ultimoIdPresupuestoInv();

			$idPresupuestoFE=$data->id;
			$idFuenteFinan=$this->input->post('hdIdFuente');
			$hdCorrelativoMeta=$this->input->post('hdCorrelativoMeta');
			$hdAnio=$this->input->post('hdAnio');

	    	for($i=0; $i<count($hdAnio); $i++)
	    	{
	    		$this->Model_FE_Presupuesto_Inv->insertarPresupuestoFuente($idPresupuestoFE, $idFuenteFinan[$i], $hdCorrelativoMeta[$i], $hdAnio[$i]);
	    	}

			echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Dastos registrados correctamente.', 'idEstudioInversion' => "?id_est_inv=".$idEstudioInversion]);exit;


		}

		$idEstInv=$this->input->get('idEstInv');

		$nombreProyectoInver=$this->Model_FE_Presupuesto_Inv->nombreProyectoInvPorId($idEstInv);

		$listarSector=$this->Model_FE_Presupuesto_Inv->listarSector();
		$listarFuenteFinanciamiento=$this->Model_FE_Presupuesto_Inv->listarFuenteFinanciamiento();

	    $this->load->view('Front/PresupuestoEstudioInversion/FEPresupuesto/insertar', ['listarSector' => $listarSector,'listarFuenteFinanciamiento' => $listarFuenteFinanciamiento,'nombreProyectoInver' => $nombreProyectoInver]);



	}

	public function verDetalle()
	{

		$id_est_inv=$this->input->get('id_est_inv');
		$nombreProyectoInver=$this->Model_FE_Presupuesto_Inv->nombreProyectoInvPorId($id_est_inv);

	    $SectorPliego=$this->Model_FE_Presupuesto_Inv->SectorPliego($id_est_inv)[0];

	    $id_detalle_presupuesto=$this->input->get('id');
	    $listaFEDetallePresupuestoT=$this->Model_FE_Presupuesto_Inv->TipoGastoDetallePresupuesto($id_detalle_presupuesto);

	    foreach($listaFEDetallePresupuestoT as $key => $value)
	    {
	    	$value->childFEDetalleGasto=$this->Model_FE_Detalle_Gasto->ListarPorIdDetallePresupuesto($value->id_detalle_presupuesto);
	    }

	    //var_dump($listaFEDetallePresupuestoT);exit;

	    $id_presupuesto_fe=$this->input->get('id');
	   // $ListarFuente=$this->Model_FE_Presupuesto_Inv->ListarFuente($id_presupuesto_fe);

	    $listaFEPresupuestoFuente=$this->Model_FE_Presupuesto_Inv->listarFEPresupuestoFuente($id_presupuesto_fe);

		$this->load->view('Front/PresupuestoEstudioInversion/FEPresupuesto/verDetalle',['nombreProyectoInver' => $nombreProyectoInver, 'SectorPliego' => $SectorPliego ,'listaFEDetallePresupuestoT'=>$listaFEDetallePresupuestoT , 'listaFEPresupuestoFuente' => $listaFEPresupuestoFuente]);
	}


	public function editar()
	{
		if($this->input->post('hdIdPresupuestoFE'))
		{
			$idPresupuestoFE=$this->input->post('hdIdPresupuestoFE');
			$idSector=$this->input->post('cbx_Sector');
			$txtPliego=$this->input->post('txtPliego');

			$Data=$this->Model_FE_Presupuesto_Inv->editar($idPresupuestoFE, $idSector, $txtPliego);

			$this->Model_FE_Presupuesto_Inv->FEPresupuestoFuenteEliminarPorIdPresupuestoFE($idPresupuestoFE);

			$hdIdFuente=$this->input->post('hdIdFuente');
			$hdCorrelativoMeta=$this->input->post('hdCorrelativoMeta');
			$hdAnio=$this->input->post('hdAnio');

	    	for($i=0; $i<count($hdIdFuente); $i++)
	    	{
	    		$this->Model_FE_Presupuesto_Inv->insertarPresupuestoFuente($idPresupuestoFE, $hdIdFuente[$i], $hdCorrelativoMeta[$i], $hdAnio[$i]);
	    	}

	    	echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Datos guardados correctamente.', 'idEstudioInversion' => "?id_est_inv=".$this->input->post('idEstudioInversion')]);exit;
		}

		$fePresupuestoInv=$this->Model_FE_Presupuesto_Inv->FEPresupuestoInvParaEditar($this->input->post('idPresupuestoFE'));

		$listarSector=$this->Model_FE_Presupuesto_Inv->listarSector();
		$listarFuenteFinanciamiento=$this->Model_FE_Presupuesto_Inv->listarFuenteFinanciamiento();
		$listaFEPresupuestoFuente=$this->Model_FE_Presupuesto_Inv->listarFEPresupuestoFuente($this->input->post('idPresupuestoFE'));

	    $this->load->view('Front/PresupuestoEstudioInversion/FEPresupuesto/editar', ['fePresupuestoInv' => $fePresupuestoInv, 'listarSector' => $listarSector, 'listarFuenteFinanciamiento' => $listarFuenteFinanciamiento, 'listaFEPresupuestoFuente' => $listaFEPresupuestoFuente]);
	}

	public function reportePdfDetalleGasto()
	{
		$id_presupuesto_fe = isset($_GET['id_pres']) ? $_GET['id_pres'] : '';

 	    $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('DETALLE');
        $pdf->SetTitle('DETALLE PRESUPUESTO');
        $pdf->SetSubject('');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->setFontSubsetting(true);



		$pdf->SetFont('times', '', 10);



        $pdf->AddPage();

        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


        $FE_Presupuesto_Inv=$this->Model_FE_Presupuesto_Inv->listarPresupuestoInverAfe($id_presupuesto_fe);
        foreach ($FE_Presupuesto_Inv as $Item)
        {
        	$nombreSecto=$Item->nombre_sector;
        	$pliego=$Item->pliego;
        	$ultimaFuente=$Item->ultima_fuente_finan;
        	$corelativoMeta=$Item->correlativo_meta;
        	$porcentaje_imprevisto=$Item->porcentaje_imprevistos;
        	$monto_imprevistos=number_format(($Item->monto_imprevistos),2);
        	$total_presupuesto=number_format(($Item->total_presupuesto),2);
        	$sub_total_presupuesto=$Item->sub_total_presupuesto;
        }

       $opcion="";
        $html = '';
        $html .= "<style type=text/css>";
        //$html .= "th{color: #000000; font-weight: bold; background-color: #B0eC4D ; border: 1px solid #000000}";
       // $html .= "table{background-color: #bbb; }";
        //$html .= "div{background-color: #bbb;margin-top:-1000px }";
        $html .= "td{background-color: #FFFFFF; color: #000000; border: 0px solid #000000}";
        $html .= "</style>";
        $html .= "<h2> </h2>";
        $html .= "<table cellspacing='0' width='50%'>";
        $html .= <<<EOD
<table  cellpadding="7">
    <tr>
         <th colspan="12" ><center><strong>13. AFECTACIÓN PRESUPUESTAL</strong></center></th>
   </tr>
    <tr>
         <th colspan="12" style="background-color:#f5f5f5;">&nbsp;&nbsp;Financiamiento: Recursos ordinarios - Oficina Regional  de Pre Inversión - Universidad Nacional Intercultural de Quillabamba</th>
   </tr>
</table>
<table border="0"  cellpadding="3">
    <tr>
         <th colspan="6" ><center><strong>Cuadro N° 5:Afectación presupuestal</strong></center></th>
   </tr>

</table>
<table border="1"  cellpadding="7">
    <tr>
         <th colspan="6" ><center><strong>SECTOR: </strong></center></th>
         <th colspan="6" ><center><strong>$nombreSecto </strong></center></th>
   </tr>
    <tr>
         <th colspan="6" ><center><strong>PLIEGO: </strong></center></th>
         <th colspan="6" ><center><strong>$pliego</strong></center></th>
   </tr>
   <tr>
         <th colspan="6" ><center><strong>FUENTE DE FINANCIAMIENTO: </strong></center></th>
         <th colspan="6" ><center><strong>$ultimaFuente</strong></center></th>
   </tr>
   <tr>
         <th colspan="6" ><center><strong>CORRELATIVO META:</strong></center></th>
         <th colspan="6" ><center><strong>$corelativoMeta</strong></center></th>
   </tr>
</table>
<table  cellpadding="7">
    <tr>
         <th colspan="12" ><center><strong>14. PRESUPUESTO PARA LA ELABORACIÓN DEL ESTUDIO</strong></center></th>
   </tr>
    <tr>
         <th colspan="12" style="background-color:#f5f5f5;">&nbsp;&nbsp;<strong>14.1 Valoración estimado</strong></th>
   </tr>
   <tr>
         <th colspan="12" style="background-color:#f5f5f5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   El valor estimado para la elaboración del perfil, según estudio de mercado y análisis de <br>
          &nbsp;&nbsp; &nbsp; precios unitarios asciende a la suma de $total_presupuesto Soles.
         </th>
   </tr>
</table>
<table border="0"  cellpadding="0">
    <tr>
         <th colspan="6" ><center><strong></strong></center></th>
   </tr>
</table>
EOD;
	$html .= "</table>";
	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
    $FE_DetalleGastoPadres=$this->Model_FE_Presupuesto_Inv->listarDetalleGastoPadres($id_presupuesto_fe);

    $prov="";
    $contenido="";
	$pdf->Write(0, 'Cuadro N° 6: Valoración  Referencial para la formulación de la PIP', '', 0, 'L', true, 0, false, false, 0);
	$pdf->Ln(1);
	$i=1;

			$pdf->SetFont('times','B', 11);
			$pdf->Cell(72, 5,'DESCRIPCIÓN', 1, 'l', 1,0);
			$pdf->Cell(30, 5,'UNIDAD', 1, 'C', 1, 0);
			$pdf->Cell(30, 5,'CANTIDAD.', 1, 'C', 1, 0);
			$pdf->Cell(30, 5,'COSTO U', 1, 'C', 1, 0);
			$pdf->Cell(30, 5,'COSTO TOTAL', 1, 'C', 1, 0);$pdf->Ln();
	foreach($FE_DetalleGastoPadres as $key => $valor)
		{

			$pdf->SetFont('times','B', 11);
			$pdf->Cell(162, 5,$FE_DetalleGastoPadres[$key]['desc_tipo_gasto'], 1, 'l', 1,(int)$i);
			$pdf->Cell(30, 5,$FE_DetalleGastoPadres[$key]['total_detalle'], 1, 'C', 1,(int)$i);
			$pdf->Ln();
			$i=((int)$i)+1;
			$subInten=$FE_DetalleGastoPadres[$key]['id_detalle_presupuesto'];
			$FE_DetalleGastoHijo=$this->Model_FE_Presupuesto_Inv->listarDetalleGasto($id_presupuesto_fe,$subInten);

			foreach ($FE_DetalleGastoHijo as $key => $valor)
			{
				$pdf->SetFont('times','', 11);
				$pdf->Cell(72, 5,$FE_DetalleGastoHijo[$key]['desc_detalle_gasto'], 1, 'l', 1,(int)$i);
				$pdf->Cell(30, 5,$FE_DetalleGastoHijo[$key]['unidad'], 1, 'C', 1, (int)$i);
				$pdf->Cell(30, 5,$FE_DetalleGastoHijo[$key]['cantidad_detalle_gasto'], 1, 'C', 1, (int)$i);
				$pdf->Cell(30, 5,$FE_DetalleGastoHijo[$key]['costo_uni_detalle_gasto'], 1, 'C', 1, (int)$i);
				$pdf->Cell(30, 5,$FE_DetalleGastoHijo[$key]['sub_total_detalle_gasto'], 1, 'C', 1, (int)$i);
				$pdf->Ln();
				$i=((int)$i) +1;
			}
		}
			$pdf->SetFont('times','B', 11);
			$pdf->Cell(72, 5,'SUB TOTAL'.$contenido, 1, 'l', 1,(int)$i+1);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i+1);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i+1);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i +1);
			$pdf->Cell(30, 5,$sub_total_presupuesto, 1, 'C', 1, (int)$i +1);$pdf->Ln();

			$pdf->Cell(72, 5,'Imprevistos('.$porcentaje_imprevisto.'% de S.T.)', 1, 'l', 1,(int)$i+2);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i+2);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i+2);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i +2);
			$pdf->Cell(30, 5,$sub_total_presupuesto, 1, 'C', 1, (int)$i +2);$pdf->Ln();

			$pdf->Cell(72, 5,'COSTO TOTAL'.$contenido, 1, 'l', 1,(int)$i+3);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i+3);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i+3);
			$pdf->Cell(30, 5,$contenido, 1, 'C', 1, (int)$i +3);
			$pdf->Cell(30, 5,$total_presupuesto, 1, 'C', 1, (int)$i +3);

		    $nombre_archivo = utf8_decode("Presupuesto de ".$prov.".pdf");
		    $pdf->Output($nombre_archivo, 'I');

	}

}
