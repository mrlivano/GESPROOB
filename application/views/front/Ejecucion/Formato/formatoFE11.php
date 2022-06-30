<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>FORMATO FE-11</title>

    <style media="screen">
      body {
        /* padding: 50px; */
        margin: 10px 50px;
      }
      p {
        text-align: center;
        font-weight: bold;
      }

      .borderless td, .borderless th {
          border: none;
      }

      #block-container {
        text-align: center;
      }

      #block1, #block2 {
        display: inline-block;
        margin: 50px;
      }

    </style>
  </head>
  <body>
    <p>FORMATO FE-11</p>
    <p>CONSUMO DE COMBUSTIBLE</p>
    <p>LUBRICANTES REPUESTOS Y OTROS DE MAQUINARIA PROPIA MENSUAL</p>
    <p>MES DE ...</p>

    <table class="table borderless">
      <!-- <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead> -->
      <tbody>
        <tr>
          <th scope="row">PROYECTO</th>
          <td><?= $expedienteTecnico->nombre_pi ?></td>
          <th scope="row">MAQUINARIA</th>
          <td></td>
        </tr>
        <tr>
          <th scope="row">POTENCIA</th>
          <td></td>
          <th scope="row">CAPACIDAD</th>
          <td></td>
        </tr>
        <tr>
          <th scope="row">FTE - FTO</th>
          <td><?= $expedienteTecnico->fuente_financiamiento_et ?></td>
          <th scope="row">PLACA N° MOT</th>
          <td></td>
        </tr>
        <tr>
          <th scope="row">MODALIDAD</th>
          <td><?= $expedienteTecnico->modalidad_ejecucion_et ?></td>
          <th scope="row">AÑO</th>
          <td></td>
        </tr>
      </tbody>
    </table>

    <table class="table" border="1">
      <!-- <col>
      <colgroup span="2"></colgroup>
      <colgroup span="2"></colgroup> -->
      <tr>
        <th rowspan="2">DIA</th>
        <th colspan="3" scope="colgroup">COMBUSTIBLE</th>
        <th colspan="3" scope="colgroup">LUBRICANTE</th>
        <th colspan="3" scope="colgroup">REPUESTOS</th>
        <th colspan="3" scope="colgroup">OTROS</th>
        <th rowspan="2" scope="colgroup">COSTO TOTAL (S/.)</th>
      </tr>
      <tr>
        <th scope="col">Acumulado Anterior</th>
        <th scope="col">Mes</th>
        <th scope="col">Acumulado Actual</th>
        <th scope="col">Acumulado Anterior</th>
        <th scope="col">Mes</th>
        <th scope="col">Acumulado Actual</th>
        <th scope="col">Acumulado Anterior</th>
        <th scope="col">Mes</th>
        <th scope="col">Acumulado Actual</th>
        <th scope="col">Acumulado Anterior</th>
        <th scope="col">Mes</th>
        <th scope="col">Acumulado Actual</th>
      </tr>
      <tr>
        <th scope="row"></th>
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
        <th scope="row"></th>
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
        <th scope="row">TOTAL</th>
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
    </table>
    <br>
    <br>
    <br>
    <div id="block-container">
      <div id="block1">
        <p>________________________________</p>
        <p>ING. RESIDENTE DE OBRA</p>
        <p>Firma y Sello</p>
      </div>
      <div id="block2">
        <p>________________________________</p>
        <p>OPERADOR</p>
        <p>Firma y D.N.I</p>
      </div>
      <div id="block2">
        <p>________________________________</p>
        <p>ALMACENERO</p>
        <p>Firma y Sello<p>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
