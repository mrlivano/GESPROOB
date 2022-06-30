<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>FORMATO FE-12</title>

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

      .table-responsive {
          display: table;
      }

    </style>
  </head>
  <body>
    <p>FORMATO FE-12</p>
    <p>MAQUINARIA PROPIA / ALQUILADA</p>
    <p>HORAS TRABAJADAS MES DE ...</p>
    <div class="table-responsive">
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
          </tr>
          <tr>
            <th scope="row">FTE - FTO</th>
            <td><?= $expedienteTecnico->fuente_financiamiento_et ?></td>
          </tr>
          <tr>
            <th scope="row">MODALIDAD</th>
            <td><?= $expedienteTecnico->modalidad_ejecucion_et ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="table-responsive">
      <table class="table" border="1">
        <tr>
          <th rowspan="2">PERSONAL</th>
          <th colspan="3" scope="colgroup">DIAS</th>
          <th colspan="3" scope="colgroup">HOMBRES - DIA</th>
        </tr>
        <tr>
          <th scope="col">1</th>
          <th scope="col">2</th>
          <th scope="col">3</th>
          <!-- <th scope="col">4</th>
          <th scope="col">5</th>
          <th scope="col">6</th>
          <th scope="col">7</th>
          <th scope="col">8</th>
          <th scope="col">9</th>
          <th scope="col">10</th>
          <th scope="col">11</th>
          <th scope="col">12</th>
          <th scope="col">13</th>
          <th scope="col">14</th>
          <th scope="col">15</th>
          <th scope="col">16</th>
          <th scope="col">17</th>
          <th scope="col">18</th>
          <th scope="col">19</th>
          <th scope="col">20</th>
          <th scope="col">21</th>
          <th scope="col">22</th>
          <th scope="col">23</th>
          <th scope="col">17</th>
          <th scope="col">18</th>
          <th scope="col">19</th>
          <th scope="col">20</th>
          <th scope="col">21</th>
          <th scope="col">22</th>
          <th scope="col">23</th>
          <th scope="col">24</th>
          <th scope="col">25</th>
          <th scope="col">26</th>
          <th scope="col">27</th>
          <th scope="col">28</th>
          <th scope="col">29</th>
          <th scope="col">30</th>
          <th scope="col">31</th> -->
          <th scope="col">Acumulado Anterior</th>
          <th scope="col">Mes</th>
          <th scope="col">Acumulado Actual</th>
        </tr>
        <tr>
          <th scope="row">1</th>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th scope="row">2</th>
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
        </tr>
      </table>
    </div>
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
        <p>CONTROLADOR DE CAMPO</p>
        <p>DNI N°...........................</p>
      </div>
      <div id="block2">
        <p>________________________________</p>
        <p>CONTROLADOR DE CAMPO</p>
        <p>DNI N°...........................</p>
      </div>
      <div id="block2">
        <p>________________________________</p>
        <p>CONTROLADOR DE CAMPO</p>
        <p>DNI N°...........................</p>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
