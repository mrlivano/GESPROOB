<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>FORMATO FE-16</title>

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
    <h5>FORMATO FE-16</h5>
    <h5>CRONOGRAMA DE AVANCE DE OBRA VALORIZADO</h5>
    <div class="container">
      <p><b>1) CPDIGO SNIP N° </b> <?= $expedienteTecnico->codigo_unico_pi ?></p>
      <p><b>FECHA: </b> <?= $expedienteTecnico->fecha_registro_pi ?></p>
      <p><b>MONTO TOTAL PRESUPUESTADO:</b> </p>
    </div>
    <div class="container">
      <table id="iseqchart">

      <tr>
      	<td id="index" rowspan="2" align="center">N°</td>
      	<td id="value" colspan="2" rowspan="2" align="center">PARTIDAS  </td>
        <td id="change" align="center"></td>
      	<td id="change" colspan="16" align="center">PERIODO</td>
      </tr>
      <tr>
        <td></td>
      	<td colspan="4" align="center">1° MES</td>
      	<td colspan="4" align="center">2° MES</td>
      	<td colspan="4" align="center">3° MES</td>
        <td colspan="4" align="center">4° MES</td>
      </tr>
      <tr>
      	<td rowspan="3">1</td>
      	<td colspan="2" rowspan="3"></td>
      	<td align="center">S/.</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">P</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">E</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td rowspan="3"></td>
      	<td colspan="2" rowspan="3"></td>
      	<td align="center">S/.</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">P</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">E</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td rowspan="3"></td>
      	<td colspan="2" rowspan="3"></td>
      	<td align="center">S/.</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">P</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">E</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td rowspan="3"></td>
      	<td colspan="2" rowspan="3"></td>
      	<td align="center">S/.</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">P</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">E</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td rowspan="3"></td>
      	<td colspan="2" rowspan="3"></td>
      	<td align="center">S/.</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">P</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
      	<td align="center">E</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td rowspan="2" align="left"></td>
      	<td rowspan="2" align="left">AVANCE MENSUAL (%)</td>
        <td>PROGRAMADO</td>
      	<td align="center">-</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      </tr>
      <tr>
      	<td>EJECUCION</td>
        <td align="center">-</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      </tr>
      <tr>
        <td rowspan="2" align="left"></td>
      	<td rowspan="2" align="left">AVANCE ACUMULADO (%)</td>
        <td>PROGRAMADO</td>
      	<td align="center">-</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      </tr>
      <tr>
      	<td>EJECUCION</td>
        <td align="center">-</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      	<td colspan="4">_______________________________</td>
      </tr>
      </table>
      <hr>
      <table id="iseqchart">

      <tr>
      	<td>AMPLIACIONES PPTALES N°</td>
      	<td>AÑO</td>
      	<td>CORRELATIVO META</td>
      	<td>MONTO</td>
      	<td>FECHA INICIO DE OBRA</td>
      	<td>-</td>
      </tr>
      <tr>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td>PLAZO DE EJECUCION</td>
      	<td></td>
      </tr>
      <tr>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td>FECHA DE TERMINO</td>
      	<td></td>
      </tr>
      <tr>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      	<td></td>
      </tr>
      </table>
      <hr>
      <table id="iseqchart">
      <tr>
        <td><b>AMPLIACIONES DE PLAZO</b></td>
      </tr>
      <tr>
      	<td>FECHA</td>
      	<td>N°</td>
      	<td>PLAZO VIGENCIA</td>
      	<td>FIN DE OBRA</td>
      	<td>OBSERVACIONES</td>
      </tr>
      <tr>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      </tr>
      <tr>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      </tr>
      <tr>
      	<td></td>
      	<td></td>
      	<td></td>
        <td></td>
      	<td></td>
      </tr>
      </table>
    </div>
    <br><br>
    <div id="block-container">
      <div class="block">
        <p>________________________________</p>
        <p>RESIDENTE</p>
      </div>
      <div class="block">
        <p>_________________________________________</p>
        <p>INSPECTOR Y/O SUPERVISOR DE OBRA</p>
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
