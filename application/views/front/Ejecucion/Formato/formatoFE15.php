<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>FORMATO FE-15</title>

    <style media="screen">
      body {
        /* padding: 50px; */
        margin: 10px 50px;
      }

      h5 {
        text-align: center;
        font-weight: bold;
      }

      .borderless td, .borderless th {
          border: none;
      }
      .container {
        text-align: left;
      }
      #block-container {
        text-align: center;
      }

      .block {
        display: inline-block;
        margin: 50px;
      }
      /*Responsive tables with flexbox*/

      #iseqchart	{
    	border:1px solid #000;
    	border-collapse:collapse;
    	font-family:Arial, Sans-Serif;
    	font-size:12px;
    	text-align:right;
    	}

    #iseqchart th	{
    	border:1px solid #333;
    	padding:3px 6px;
    	}

    #iseqchart td	{
    	border:1px solid #999;
    	padding:3px 6px;
    	}

    .neg	{
    	color:red;
    }

    .pos	{
    	color:green;
    }


    @media only screen and (max-width: 768px) {
    	#turnover, tr td:nth-child(9)		{ display:none; visibility:hidden; }
    }

    @media only screen and (max-width: 420px) {
    	#changepercent, tr td:nth-child(4)	{ display:none; visibility:hidden; }
    	#yhigh, tr td:nth-child(5)			{ display:none; visibility:hidden; }
    	#ylow, tr td:nth-child(6)			{ display:none; visibility:hidden; }
    	#turnover, tr td:nth-child(9)		{ display:none; visibility:hidden; }
    }

    @media only screen and (max-width: 320px) {
    	#changepercent, tr td:nth-child(4)	{ display:none; visibility:hidden; }
    	#yhigh, tr td:nth-child(5)			{ display:none; visibility:hidden; }
    	#ylow, tr td:nth-child(6)			{ display:none; visibility:hidden; }
    	#dhigh, tr td:nth-child(7)			{ display:none; visibility:hidden; }
    	#dlow, tr td:nth-child(8)			{ display:none; visibility:hidden; }
    	#turnover, tr td:nth-child(9)		{ display:none; visibility:hidden; }
    }
    </style>
  </head>
  <body>
    <h5>FORMATO FE-15</h5>
    <h5>VALORIZACION DE APORTE</h5>
    <div class="container">
      <p><b>PROYECTO:</b> <?= $expedienteTecnico->nombre_pi ?></p>
      <p><b>FECHA DE INICIO  DE OBRA:</b> <?= $expedienteTecnico->fecha_inicio_et ?></p>
      <p><b>PLAZO DE EJECUCION:</b> </p>
      <p><b>FECHA DE PRESENTACION:</b> <?= $expedienteTecnico->fecha_registro ?></p>
    </div>
    <div class="container">
      <table id="iseqchart">

      <tr>
      	<th id="index" rowspan="3" align="center">CONCEPTO</th>
      	<th id="value" colspan="4" scope="colgroup" rowspan="2" align="center">APORTE  </th>
      	<th id="change" colspan="6" align="center">AVANCES</th>
      	<th id="changepercent"rowspan="3" align="center">%</th>
      </tr>
      <tr>
      	<td colspan="2">Anterior</td>
      	<td colspan="2">Actual</td>
      	<td colspan="2">Acumulado</td>
      </tr>
      <tr>
      	<td>Unid.</td>
      	<td>Cantidad</td>
      	<td>Valor Estimado S/.</td>
      	<td>Parcial</td>
      	<td>Cantidad</td>
      	<td>Valorizado S/.</td>
      	<td>Cantidad</td>
      	<td>Valorizado S/.</td>
      	<td>Cantidad</td>
        <td>Valorizado S/.</td>
      </tr>
      <tr>
      	<td><b>1.0 CAPITAL FIJO</b></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>1.1 Terreno</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>1.2 Equipos</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>1.3 Infraestructura</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>1.4 Instalaciones</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>1.5 Herramientas</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>1.6 Otros</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td><b>2.0 CAPITAL DE TRABAJO</b></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>2.1 Materiales de Construcción</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>2.2 Otros Materiales</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>2.3 Mano de Obra</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>a.- Calificada</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>b.- No Calificada</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td>2.4 Otros (Fletes, etc.)</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td colspan="12" align="left"><b>COSTO DIRECTO TOTAL</b></td>
      </tr>
      <tr>
      	<td colspan="12" align="center"><b>RAZONES DE APORTE</b></td>
      </tr>
      <tr>
      	<td colspan="2" align="center">Por desfase presupuestal ______</td>
        <td colspan="3" align="center">Por estar considerado en el presupuesto ______</td>
        <td colspan="2" align="center">Por ampliación de metas ______</td>
        <td colspan="2" align="center">Otros ______</td>
        <td colspan="3" align="center">Explicar __________________</td>
      </tr>
      <tr>
      	<td colspan="6" align="center">CONTROL DE APORTE</td>
        <td colspan="6" align="center">SITUACION DEL PROYECTO</td>
      </tr>
      <tr>
      	<td colspan="3" scope="colgroup">Aporte Minimo de M. de O. No calificada (S/.): ______%</td>
        <td colspan="3" align="center">Monto ____________</td>
        <td colspan="6" align="center">AVANCE FISICO ______%</td>
      </tr>
      <tr>
        <td colspan="3" scope="colgroup">Aporte Acumulado de M. de O. No calificada (S/.): ______%</td>
        <td colspan="3" align="center">Monto ____________</td>
        <td colspan="6" align="center">AVANCE FINANCIERO ______%</td>
      </tr>
      <tr>
        <td colspan="12" scope="colgroup">Los que abajo suscribimos, certificamos que los montos consignados en el presente informe, han sido aportados durante el proceso de ejecución de la Obra.</td>
      </tr>
      </table>
    </div>
    <br><br>
    <div id="block-container">
      <div class="block">
        <p>________________________________</p>
        <p>ING. RESIDENTE DE OBRA</p>
        <p>Firma y Sello</p>
      </div>
      <div class="block">
        <p>________________________________</p>
        <p>ING. SUPERVISOR DE OBRA</p>
        <p>Firma y Sello<p>
      </div>
    </div>
    <br>
    <br>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
