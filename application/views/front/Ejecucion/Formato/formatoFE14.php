<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>FORMATO FE-14</title>

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

    </style>
  </head>
  <body>
    <h5>FORMATO FE-14</h5>
    <h5>MEMORIA DESCRIPTIVA VALORIZADA</h5>
    <div class="container">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th scope="row">Nombre del Proyecto:</th>
            <td><?= $expedienteTecnico->nombre_pi ?></td>
          </tr>
          <tr>
            <th>Unidad Ejecutora</th>
            <td><?= $expedienteTecnico->nombre_ue ?></td>
          </tr>
          <tr>
            <th>Residente de Obra</th>
            <td></td>
          </tr>
          <tr>
            <th>Supervisor de Obra</th>
            <td></td>
          </tr>
          <tr>
            <th>Fecha:</th>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="container">
    <h6><b>I.- GENERALIDADES DEL PROYECTO</b></h6>
    <h6>1.1.- GENERALIDADES DEL PROYECTO</h6>
      <h6>&ensp;&ensp;1.1.1.- Ubicación</h6>
      <p>&ensp;&ensp;&ensp;&ensp;Departamento: <?= $expedienteTecnico->distrito_provincia_departamento_ue ?></p>
      <p>&ensp;&ensp;&ensp;&ensp;Provincia:</p>
      <p>&ensp;&ensp;&ensp;&ensp;Distrito</p>
      <p>&ensp;&ensp;&ensp;&ensp;Distrito</p>
      <p>&ensp;&ensp;&ensp;&ensp;Dirección y/o Ubicación: <?= $expedienteTecnico->direccion_ue ?></p>
    <h6>&ensp;&ensp;1.1.2.- Función Programática</h6>
      <p>&ensp;&ensp;&ensp;&ensp;FUNCIÓN: <?= $expedienteTecnico->funcion_et ?></p>
      <p>&ensp;&ensp;&ensp;&ensp;PROGRAMA: <?= $expedienteTecnico->programa_et ?></p>
      <p>&ensp;&ensp;&ensp;&ensp;SUB PROGRAMA: <?= $expedienteTecnico->sub_programa_et ?></p>
      <p>&ensp;&ensp;&ensp;&ensp;PROYECTO: <?= $expedienteTecnico->proyecto_et ?></p>
      <p>&ensp;&ensp;&ensp;&ensp;COMPONENTE: <?= $expedienteTecnico->componente_et ?></p>
      <p>&ensp;&ensp;&ensp;&ensp;META: <?= $expedienteTecnico->meta_et ?></p>
      <p>&ensp;&ensp;&ensp;&ensp;MODALIDAD: <?= $expedienteTecnico->modalidad_ejecucion_et ?></p>
    <h6>&ensp;&ensp;1.1.3.- Aspectos Financieros</h6>
      <p>&ensp;&ensp;&ensp;&ensp;MONTO APROBADO:</p>
      <p>&ensp;&ensp;&ensp;&ensp;MONTO ASIGNADO:</p>
      <p>&ensp;&ensp;&ensp;&ensp;FUENTE FINANCIAMIENTO:</p>
      <p>&ensp;&ensp;&ensp;&ensp;18 Canon, Sobre canon, Reg y Part.:</p>
      <p>&ensp;&ensp;&ensp;&ensp;07 Recursos Ordinarios:</p>
      <p>&ensp;&ensp;&ensp;&ensp;13 Donaciones y Transferencias:</p>
      <p>&ensp;&ensp;&ensp;&ensp;09 Recursos Directamente Recaudados:</p>
      <p>&ensp;&ensp;&ensp;&ensp;TOTAL:</p>
    <h6>1.2.- OBJETIVOS Y DESCRIPCION DEL PROYECTO</h6>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th>&ensp;&ensp;</th>
          </tr>
        </tbody>
      </table>
    <h6><b>II.- PROYECTO EJECUTADO:</b></h6>
    <h6>2.1.- PLAZO DE EJECUCION</h6>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td>Fecha de Entrega de Terreno</td>
            <td>Fecha de Inicio de Obra</td>
            <td>Fecha de Termino Programada Original</td>
            <td>Fecha de Termino REAL</td>
          </tr>
          <tr>
            <th></th>
            <td></td>
            <th></th>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
