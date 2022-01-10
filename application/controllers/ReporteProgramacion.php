<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReporteProgramacion extends CI_Controller {
 
 public function __construct(){
      parent::__construct();
      $this->load->model('Model_ProyectoInversion');
      $this->load->model('Model_Programacion');
  }
 function index()
  {
    $this->load->model("Model_ProyectoInversion");
    $data["employee_data"] = $this->Model_Programacion->ExelProgramacionProyectos();
    $this->load->view("excel_export_view", $data);
  }
//Generar el excel de programaciones
function action()
{
	$año_apertura_actual=$this->input->post('hdAnioCartera');
	$this->load->library("excel");

	$object=new PHPExcel();

	$object->getProperties()->setCreator("Fabian Schmick")->setLastModifiedBy("Current User")->setTitle("Foobar");

	$object->getActiveSheet()->mergeCells('A1:Z1');
	$object->getActiveSheet()->mergeCells('AA1:AE1');
	$object->getActiveSheet()->mergeCells('AF1:AH1');
	$object->getActiveSheet()->mergeCells('AI1:AK1');

	$object->getActiveSheet()
		->getStyle('A1:Z2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('FFE699');

	$object->getActiveSheet()
		->getStyle('AA1:AH2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('F8CBAD');

	$object->getActiveSheet()
		->getStyle('AI1:AK2')
		->getFill()
		->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
		->getStartColor()
		->setRGB('C6E0B4');

	$object->getActiveSheet()->getColumnDimension('A')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('B')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('C')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('D')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('E')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('F')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('G')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('H')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('I')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('J')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('K')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('L')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('M')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('N')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('O')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('P')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('Q')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('R')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('S')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('T')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('U')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('V')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('W')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('X')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('Y')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('Z')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AA')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AB')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AC')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AD')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AE')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AF')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AG')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AH')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AI')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AJ')->setWidth("15");
	$object->getActiveSheet()->getColumnDimension('AK')->setWidth("15");

	$object->getActiveSheet()
		->getStyle('A1:AK500')
		->getAlignment()
		->setWrapText(true);

	$object->getActiveSheet()->getStyle('A1:AK500')->getAlignment()->applyFromArray(
		array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	);

	$object->getActiveSheet()->getStyle("A1:AK500")->applyFromArray(
		array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			)
		)
	);

	$object->getActiveSheet()->getStyle('A1:AK2')->getFont()->setBold(true);

	$object->setActiveSheetIndex(0)
		->setCellValue('A1','Detalle de proyecto')
		->setCellValue('AA1','Programación')
		->setCellValue('AF1','Programación del monto de inversión')
		->setCellValue('AI1','Programación del monto de O&M');

	$column=0;

	$table_columns=array("Cod. Proyecto","Tipo de Inversión", "Ciclo de Inversión", "Tipología", "Naturaleza","Inversión","Nivel de Gobierno","Prioridad","U. Ejecutora","Departamento","Provincia","Distrito","Función","Div. Funcional","Grupo Funcional","Costo inversión","Dev. Acum. Año Anterior","PIM Año Actual","Fuente Finan.","Rubro","Fuente Finan. 2","Rubro 2","Mod. Ejecución","Servicio","Brecha Asociada","Programa Presup.","Fecha Registro","Fecha Viabilidad","Inicio Programación","Fin Programación","Saldo a Programar",($año_apertura_actual+1),($año_apertura_actual+2),($año_apertura_actual+3),($año_apertura_actual+1),($año_apertura_actual+2),($año_apertura_actual+3));

	//para la segunda cabecera
	foreach($table_columns as $field)
	{
		$object->getActiveSheet()->setCellValueByColumnAndRow($column,2, $field);

		$column++;
	}

	$valor="";//para traer la programacion mandando un parametro vacio
	
	$employee_data=$this->Model_Programacion->ExelProgramacionProyectos($valor,$año_apertura_actual);
	$excel_row=3;//para decir donde va a empezar 
	$departamento="Apurímac";
	$funtefinanciamiento="";
	$rubro="";
	$funtefinanciamiento2="";
	$rubro2="";
	$nombre_modalidad_ejec="";

	foreach($employee_data as $row)
	{
		$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->codigo_unico_pi);
		$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nombre_tipo_inversion);
		$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->nombre_estado_ciclo);
		$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->nombre_tipologia_inv);
		$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->nombre_naturaleza_inv);
		$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->nombre_pi);
		$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->nombre_nivel_gob);
		$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->prioridad_prog);
		$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->nombre_ue);
		$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $departamento);
		$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->provincias);
		$object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row->distritos);
		$object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->nombre_funcion);
		$object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row->nombre_div_funcional);
		$object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $row->nombre_grup_funcional);
		$object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $row->costo_pi);
		$object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, '');
		$object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, ''); //ACA DEBE SER PIM AÑO ACTUAL
		$object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $funtefinanciamiento);
		$object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, $rubro); 
		$object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, $funtefinanciamiento2); //ACA ES FUENTE FINAN 2 Y ES CAMPO VACIO
		$object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $rubro2); //ACA RUBRO DOS  2 Y ES CAMPO VACIO
		$object->getActiveSheet()->setCellValueByColumnAndRow(22, $excel_row, $nombre_modalidad_ejec);
		$object->getActiveSheet()->setCellValueByColumnAndRow(23, $excel_row, $row->nombre_serv_pub_asoc);
		$object->getActiveSheet()->setCellValueByColumnAndRow(24, $excel_row, $row->nombre_brecha); 
		$object->getActiveSheet()->setCellValueByColumnAndRow(25, $excel_row, $row->nombre_programa_pres); 
		$object->getActiveSheet()->setCellValueByColumnAndRow(26, $excel_row, $row->fecha_registro_pi);
		$object->getActiveSheet()->setCellValueByColumnAndRow(27, $excel_row, $row->fecha_viabilidad_pi); 
		$object->getActiveSheet()->setCellValueByColumnAndRow(28, $excel_row, ""); //ACA LOS DATOS SON VACIOS DE INICIO PROGRAMACION
		$object->getActiveSheet()->setCellValueByColumnAndRow(29, $excel_row, "");//ACA LOS DATOS SON VACIOS DE FIN PROGRAMACION
		$object->getActiveSheet()->setCellValueByColumnAndRow(30, $excel_row, 0);//SALDO A PROGRAMAR ES VACIO
		$object->getActiveSheet()->setCellValueByColumnAndRow(31, $excel_row, $row->Inv_2018);//SALDO A PROGRAMAR ES VACIO
		$object->getActiveSheet()->setCellValueByColumnAndRow(32, $excel_row, $row->Inv_2019);//SALDO A PROGRAMAR ES VACIO
		$object->getActiveSheet()->setCellValueByColumnAndRow(33, $excel_row, $row->Inv_2020);//SALDO A PROGRAMAR ES VACIO
		$object->getActiveSheet()->setCellValueByColumnAndRow(34, $excel_row, $row->OyM_2018);//MONTOS PROGRAMADOR POR LOS TRES AÑOS 
		$object->getActiveSheet()->setCellValueByColumnAndRow(35, $excel_row, $row->OyM_2019);//MONTOS PROGRAMADOS POR LOS TRES AÑOS
		$object->getActiveSheet()->setCellValueByColumnAndRow(36, $excel_row, $row->OyM_2020);//MONTO PROGRAMADOPOR LOS TRES AÑOS*/

		$excel_row++;
	}

	$object_writer=PHPExcel_IOFactory::createWriter($object, 'Excel5');

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="programacion.xls"');
	
	$object_writer->save('php://output');
}

  //fin generar reporte de programaciones

//pdf de proyectos programados por proyectos

    function  PdfProyectoProgramado()//Detalla los proyecto programados en PDF DE CADA PROYECTO 
    {
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('DETALLE');
        $pdf->SetTitle('DETALLE DE PROYECTOS');
        $pdf->SetSubject('PROYECTO EN CARTERA');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 		
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
       /* $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' :', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));*/
       // $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 		
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '',8, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir


        $html = '';
        $html .= "<style type=text/css>";
        //$html .= "th{color: #000000; font-weight: bold; background-color: #B0eC4D ; border: 1px solid #000000}";
       // $html .= "table{background-color: #bbb; }";
        //$html .= "div{background-color: #bbb;margin-top:-1000px }";
        $html .= "td{background-color: #FFFFFF; color: #000000; border: 1px solid #000000}";
        $html .= "</style>";
        $html .= "<h2> </h2>";
        $html .= "<div>";
        $html .= "<table cellspacing='0' width='50%'>";
        $opcion=1;//mostrar un solo proyecto
        $opcion2=2;//mostra todos los proyecto programados
        $id_pi=$this->input->post("CodigoProgramacion");
        $anio=$this->input->post("CarteradeProgramacion");//observacion
        $anio1=explode('-',$anio);
        $año_apertura_actual=$anio1[0];
        $ProyectoProgramado =$this->Model_Programacion->GetProgramacion($id_pi,$año_apertura_actual,0, 0, '');//para mostra uno solo del detallado de los proyectos
        foreach ($ProyectoProgramado as $rows) 
        {
            
            $nombre_pi = $rows->nombre_pi;
            $codigo_unico_pi = $rows->codigo_unico_pi;
            $fecha_registro_pi=$rows->fecha_registro_pi;
            $fecha_viabilidad_pi= $rows->fecha_viabilidad_pi;
            $departamento= "Apurímac";
            $provincia= $rows->provincias;
            $distrito=$rows->distritos;
            //RESPONSABILIDAD FUNCIONAL DEL PROGRAMA DE INVERSIÓN
             $codigo_funcion=$rows->codigo_funcion;
            $nombre_funcion=$rows->nombre_funcion;
            $codigo_div_funcional=$rows->codigo_div_funcional;
            $nombre_div_funcional=$rows->nombre_div_funcional;
            $codigo_grup_funcional=$rows->codigo_grup_funcional;
            $nombre_grup_funcional=$rows->nombre_grup_funcional;
            $nombre_sector=$rows->nombre_sector;
            //META PRESUPUESTAL
            //$nombre_meta_pres=$rows->nombre_meta_pres;
            //$año_meta_pres=$rows->año_meta_pres;
            $pim_meta_pres=$rows->pim_meta_pres;
            //$numero_meta_pres=$rows->numero_meta_pres;
            //UNIDAD EJECUTORA
            $nombre_ue=$rows->nombre_ue;
            //TIPO DE INVERSION
            $nombre_tipo_inversion=$rows->nombre_tipo_inversion;
            //NIVEL DE GOBIERNO
            $nombre_nivel_gob=$rows->nombre_nivel_gob;
            //TIPOLOGIA INVERSION
            $nombre_tipologia_inv=$rows->nombre_tipologia_inv;
            //MODALIDAD DE EJECUCION
           //$nombre_modalidad_ejec=$rows->nombre_modalidad_ejec;
            //$fecha_modalidad_ejec_pi=$rows->fecha_modalidad_ejec_pi;
            //FUENTE DE FINANCIAMIENTO
            //$nombre_fuente_finan=$rows->nombre_fuente_finan;
            //$nombre_programa_pres=$rows->nombre_programa_pres;
             //RUBRO EJECUCION
            //$nombre_rubro=$rows->nombre_rubro;
            //NATURALEZA DE INVERSION
            $nombre_naturaleza_inv=$rows->nombre_naturaleza_inv;
            //PROGREMACION
             /*$nombre_pi=$rows->nombre_pi;
            $costo_pi=$rows->costo_pi;
            $año_prog=$rows->año_prog;
            $monto_prog=$rows->monto_prog;
            $monto_opera_mant_prog=$rows->monto_opera_mant_prog;
            $tipo_prog="";*/
            //programa presupuestal//
            $Inv_2018=$rows->Inv_2018;
            $Inv_2019=$rows->Inv_2019;
            $Inv_2020=$rows->Inv_2020;

            $OyM_2018=$rows->OyM_2018;
            $OyM_2019=$rows->OyM_2019;
            $OyM_2020=$rows->OyM_2020;
                            

         $html .= <<<EOD

<form method="post" action="http://localhost/printvars.php" enctype="multipart/form-data">
<table border="1"  cellpadding="7">

    <tr>
         <th colspan="12" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center><strong>DETALLE DE PROYECTOS DE INVERSIÓN</strong></center></th>
   </tr>
    <tr>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;DATOS DEL PROYECTOS DE INVERSIÓN</th>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
   </tr>
    <tr>
         <th colspan="6"><strong><i>Código Único </i></strong></th>
         <th colspan="6">$codigo_unico_pi</th>
   </tr>
   <tr>
   <th colspan="6"><strong><i>Nombre del Proyecto</i></strong></th>
       <th colspan="6">$nombre_pi</th>
   </tr>
     <tr>
     <th colspan="6"><strong><i>Fecha Registro</i></strong></th>
         <th colspan="6">$fecha_registro_pi</th>
   </tr>
   <tr>
   <th colspan="6"><strong><i>Fecha de viabilidad</i></strong></th>
       <th colspan="6">$fecha_viabilidad_pi</th>
   </tr>
    <tr>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;LOCALIZACIÓN DEL PROYECTO</th>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
   </tr>
     <tr>
         <th colspan="6">Departamento</th>
         <th colspan="6">$departamento</th>
   </tr>
   <tr>
       <th colspan="6">Provincia</th>
       <th colspan="6">$provincia</th>
   </tr>
   <tr>
       <th colspan="6">Distrito</th>
       <th colspan="6">$distrito</th>
   </tr>
   <tr>
         <th colspan="12" style="background-color:#f5f5f5;">&nbsp;&nbsp;RESPONSABILIDAD FUNCIONAL DEL PROGRAMA DE INVERSION</th>
   </tr>
    <tr>
         <th colspan="6">Función</th>
         <th colspan="6">$codigo_funcion:$nombre_funcion</th>
   </tr>
   <tr>
       <th colspan="6">División Funcional</th>
       <th colspan="6">$codigo_div_funcional:$nombre_div_funcional</th>
   </tr>
   <tr>
       <th colspan="6">Grupo Funcional</th>
       <th colspan="6">$codigo_grup_funcional:$nombre_grup_funcional</th>
   </tr>
   <tr>
       <th colspan="6">Sector</th>
       <th colspan="6">$nombre_sector</th>
   </tr>
      <tr>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;Tipologia de inversion</th>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
   </tr>
   <tr>
       <th colspan="6">Naturaleza de Inversion</th>
       <th colspan="6">$nombre_naturaleza_inv</th>
   </tr>
    <tr>
       <th colspan="6">Tipologia de inversion </th>
       <th colspan="6">$nombre_tipologia_inv </th>
   </tr>
   <tr>
       <th colspan="6">Tipo de Inversion</th>
       <th colspan="6">$nombre_tipo_inversion</th>
   </tr>
   <tr>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;META PRESUPUESTAL</th>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
   </tr>
    <tr>
         <th colspan="6"></th>
         <th colspan="6">Nombre Meta Presupuestal</th>
   </tr>
   <tr>
       <th colspan="6">Año Meta Presupuestal</th>
       <th colspan="6"></th>
   </tr>
   <tr>
       <th colspan="6">PIM</th>
       <th colspan="6">$pim_meta_pres</th>
   </tr>
   <tr>
       <th colspan="6">N° Meta Presupuestal</th>
       <th colspan="6"></th>
   </tr>
    <tr>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;UNIDAD EJECUTORA</th>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
   </tr>
   <tr>
       <th colspan="6">Unidad Ejecutora</th>
        <th colspan="6">$nombre_ue</th>
   </tr>
    <tr>
       <th colspan="6">Modalidad de Ejecucion</th>
       <th colspan="6"></th>
   </tr>
   <tr>
       <th colspan="6">Nivel de Gobierno</th>
       <th colspan="6"></th>
   </tr>
     <tr>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;INFORMACION PRESUPUESTAL</th>
         <th colspan="6" style="background-color:#f5f5f5;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
   </tr>
   <tr>
       <th colspan="6">Fuente de financiamiento</th>
       <th colspan="6"></th>
   </tr>
    <tr>
       <th colspan="6">Rubro de Ejecucion</th>
       <th colspan="6"></th>
   </tr>
   <tr>
       <th colspan="3">Programación</th>
       <th colspan="3">$Inv_2018</th>
       <th colspan="3">$Inv_2019</th>
       <th colspan="3">$Inv_2020</th>
   </tr>
    <tr>
       <th colspan="3">Programación Operación y Mantenimineto</th>
       <th colspan="3">$OyM_2018</th>
       <th colspan="3">$OyM_2019</th>
       <th colspan="3">$OyM_2020</th>
   </tr>
</table>
</form>
EOD;
            

        }

        $html .= "</table>";
        $html .= "</div>";
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
 
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Reporte de comprobante ".$opcion.".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }


//fin de pdf de proyectos programados por proyecto

}