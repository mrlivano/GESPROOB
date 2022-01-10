<style>
    #tablaConsulta th
    {
        color:white;
        background-color:#337ab7;

    }
</style>
<table id="tablaConsulta" width="100%" class="table table-striped table-hover" cellspacing="0">
	<thead >
        <tr>
            <th>Codigo Unico</th>
            <th>Proyecto de Inversión</th>                     
            <th>Costo de Expediente</th>
            <th>Avance Físico Real</th>
        </tr>
	</thead>
	<tbody>
		<?php foreach ($listaProyecto as $key => $value) {?>
			<tr>

				<td style="text-align: left; text-transform: uppercase;"><?=$value->codigo_unico_pi?></td>
				<td style="text-align: left;text-transform: uppercase;"><?=$value->nombre_pi?></td>
                <td><?=a_number_format($value->costo_pi, 2, '.',",",3)?></td>
                <td><?=a_number_format($value->avanceFisico, 2, '.',",",3)?>%</td>
			</tr>
		<?php } ?>							
	</tbody>						
</table>
<!-- <br>
<div style="background-color: #fff6df; font-size:20px;padding:10px;text-align:center;">
    <p><i class="fa fa-info"></i></p>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit aut nobis minus recusandae quod facilis voluptatum quo, natus voluptates ullam minima ut eligendi nostrum distinctio illum laboriosam. Ea, saepe debitis. </p>
</div> -->

					