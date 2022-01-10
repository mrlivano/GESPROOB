<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Pre-Liquidación</title>
    <style media="screen">
      .title-pl {
        text-align: center;
      }
      table#preliquidacion tr td:first-child{font-weight: bold;}
    </style>
  </head>
  <body>
    <h1 class="title-pl">PRE-LIQUIDACIÓN</h1>
     <table id="preliquidacion">
       <tr>
         <td>Proyecto: </td>
         <td><?=$listPreliquidacion[0]->proyecto?></td>
       </tr>
       <tr>
         <td>Unidad Ejecutora: </td>
         <td><?=$listPreliquidacion[0]->unidad_ejec?></td>
       </tr>
       <tr>
         <td>Modalidad / Ejecución: </td>
         <td><?=$listPreliquidacion[0]->mod_ejec?></td>
       </tr>
       <tr>
         <td>Correlativo de meta: </td>
         <td><?=$listPreliquidacion[0]->correlativo?></td>
       </tr>
       <tr>
         <td>Funcion: </td>
         <td><?=$listPreliquidacion[0]->funcion?></td>
       </tr>
       <tr>
         <td>Programa: </td>
         <td><?=$listPreliquidacion[0]->programa?></td>
       </tr>
       <tr>
         <td>Sub programa: </td>
         <td><?=$listPreliquidacion[0]->sub_programa?></td>
       </tr>
       <tr>
         <td>ACT / Proyecto: </td>
         <td><?=$listPreliquidacion[0]->act_proyecto?></td>
       </tr>
       <tr>
         <td>Componente: </td>
         <td><?=$listPreliquidacion[0]->componente?></td>
       </tr>
       <tr>
         <td>Meta: </td>
         <td><?=$listPreliquidacion[0]->meta?></td>
       </tr>
       <tr>
         <td>Ubicación: </td>
         <td><?=@$listPreliquidacion[0]->ubicacion?></td>
       </tr>
       <?php foreach ($responsables as $responsable): ?>
       <tr>
         <td><?=$responsable->tipo?></td>
         <td><?=$responsable->nombres?><?=$responsable->apellido_p?><?=$responsable->apellido_m?> &ensp; &ensp; - &ensp; &ensp;
           <b>Fecha:</b> <?=$responsable->fecha_inicio?> <b>Al</b> <?=$responsable->fecha_fin?>
         </td>
       </tr>
       <?php endforeach; ?>
     </table>
  </body>
</html>
