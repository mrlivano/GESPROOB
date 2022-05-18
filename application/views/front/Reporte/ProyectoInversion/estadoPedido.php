<style media="screen">
	.badge {
	padding: 1px 9px 2px;
	font-size: 12.025px;
	font-weight: bold;
	white-space: nowrap;
	color: #ffffff;
	background-color: #999999;
	-webkit-border-radius: 9px;
	-moz-border-radius: 9px;
	border-radius: 9px;
	}
	.badge:hover {
	color: #ffffff;
	text-decoration: none;
	cursor: pointer;
	}
	.badge-error {
	background-color: #b94a48;
	}
	.badge-error:hover {
	background-color: #953b39;
	}
	.badge-warning {
	background-color: #f89406;
	}
	.badge-warning:hover {
	background-color: #c67605;
	}
	.badge-success {
	background-color: #468847;
	}
	.badge-success:hover {
	background-color: #356635;
	}
	.badge-info {
	background-color: #3a87ad;
	}
	.badge-info:hover {
	background-color: #2d6987;
	}
	.badge-inverse {
	background-color: #333333;
	}
	.badge-inverse:hover {
	background-color: #1a1a1a;
	}
</style>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
				var i = 0;
				var myvar = <?php echo json_encode($historialPedidoEstado); ?>;
				myvar.forEach(function(entry) {
					i++;
					var timeStampOrder = entry.timestamp;
					var dateTimePedido = moment(timeStampOrder, "YYYYMMDD HH:mm:ss");
					document.querySelector('label[for="q' + (i) + 'b"]').innerHTML = "("+dateTimePedido.fromNow()+")";
				});
    });
});
</script>
<div class="modal-body">
   <div class="row">
        <div class="col-xs-12">
            <form id="formAddEstadoPedido" class="feedback" name="feedback">
							<div class="form-row">
								<div class="form-group col-md-3">
									<label for="inputCity">Pedido</label>
									<input type="text" class="form-control" value="<?=$listadetalleporcadapedido[0]->NRO_PEDIDO ?>" disabled>
									<input type="hidden" name="inputOrder" id="inputOrder" value="<?=$nropedido ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="inputState">Proceso de adquisición</label>
									<select name="inputOffice" id="inputOffice" class="form-control">
										<option value="adquisiciones" <?php if(isset($orderStatus->oficina) != '' || isset($orderStatus->oficina) != null){ echo $orderStatus->oficina=='adquisiciones' ? 'selected="selected"' : ''; } ?> >Ingreso de pedido SIGA a adquisiciones</option>
										<option value="cotizacion" <?php if(isset($orderStatus->oficina) != '' || isset($orderStatus->oficina) != null){ echo $orderStatus->oficina=='cotizacion' ? 'selected="selected"' : ''; } ?> >Cotización de pedidos</option>
										<option value="cuadro" <?php if(isset($orderStatus->oficina) != '' || isset($orderStatus->oficina) != null){ echo $orderStatus->oficina=='cuadro' ? 'selected="selected"' : ''; } ?> >Elaboración de cuadros comparativos</option>
										<option value="orden" <?php if(isset($orderStatus->oficina) != '' || isset($orderStatus->oficina) != null){ echo $orderStatus->oficina=='orden' ? 'selected="selected"' : ''; } ?> >Orden de compra o servicio</option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="inputZip">Responsable</label>
									<select name="inputResponsable" id="inputResponsable" class="form-control">
										<?php foreach ($getPersonal as $getPersona): ?>
											<option value="<?= $getPersona->id_persona ?>" <?php if(isset($orderStatus->id_responsable) != '' || isset($orderStatus->id_responsable) != null){ echo $orderStatus->id_responsable == $getPersona->id_persona ? 'selected="selected"' : ''; } ?> >
												<?php echo $getPersona->nombres." ".$getPersona->apellido_p." ".$getPersona->apellido_m; ?>
											</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="inputState">Estado</label>
									<?php if (isset($orderStatus->estado)): ?>
											<?php if ($orderStatus->estado=='tramite'): ?>
												<span class="badge badge-warning">En tramite</span>
											<?php elseif($orderStatus->estado=='aprobado'): ?>
												<span class="badge badge-success">Aprobado</span>
											<?php elseif($orderStatus->estado=='observado'): ?>
												<span class="badge badge-error">Observado</span>
											<?php elseif($orderStatus->estado=='anulado'): ?>
												<span class="badge badge-secondary">Anulado</span>
											<?php endif; ?>
									<?php endif; ?>
									<select name="inputStatus" id="inputStatus" class="form-control">
										<option value="tramite" <?php if(isset($orderStatus->estado) != '' || isset($orderStatus->estado) != null){ echo $orderStatus->estado=='tramite' ? 'selected="selected"' : ''; } ?> >En trámite</option>
										<option value="aprobado" <?php if(isset($orderStatus->estado) != '' || isset($orderStatus->estado) != null){ echo $orderStatus->estado=='aprobado' ? 'selected="selected"' : ''; } ?> >Aprobado</option>
										<option value="observado" <?php if(isset($orderStatus->estado) != '' || isset($orderStatus->estado) != null){ echo $orderStatus->estado=='observado' ? 'selected="selected"' : ''; } ?> >Observado</option>
										<option value="anulado" <?php if(isset($orderStatus->estado) != '' || isset($orderStatus->estado) != null){ echo $orderStatus->estado=='anulado' ? 'selected="selected"' : ''; } ?> >Anulado</option>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6" name="inputDescription" id="inputDescription">
									<label for="exampleFormControlTextarea1">Descripción de Observación</label><textarea class="form-control" name="exampleFormControlTextarea1" id="exampleFormControlTextarea1" rows="3"><?php if(isset($orderStatus->descripcion) != '' || isset($orderStatus->descripcion) != null){ echo $orderStatus->descripcion; } ?></textarea>
								</div>
								<div class="form-group col-md-6" name="inputFile" id="inputFile">
									<label for="exampleFormControlFile1">Documento</label><input type="file" value="<?= isset($orderStatus->documento) ?>" class="form-control-file" name="exampleFormControlFile1" id="exampleFormControlFile1">
									<?php if (isset($orderStatus->documento)):?>
										<div style="margin-top:15px;">
											<i class='fa fa-file fa-2x'></i><a href="../../uploads/EstadoPedido/<?php echo $orderStatus->documento; ?>" target="_blank"> <?php echo $orderStatus->documento; ?></a>
		                </div>
									<?php endif; ?>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="col-sm-10">
									<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button class="btn btn-primary" id="send" type="submit">Guardar</button>
								</div>
								<div class="col-sm-2">
									<button type="button" class="btn btn-info" id="myBtn" data-toggle="modal" data-target="#my_modal">Historial de Pedido</button>
								</div>
							</div>
						</form>
        </div>
    </div>
</div>


<div class="modal" id="my_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<h4 class="modal-title">Historial</h4>
					<!-- <button type="button" class="close custom-close" data-dismiss="modal" aria-hidden="true">×</button> -->
			</div>
			<div class="modal-body">
				<table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Nro. 	Pedido</th>
				      <th scope="col">Procesos de adquisición</th>
				      <th scope="col">Responsable</th>
							<th scope="col">Estado</th>
							<th scope="col">Descripción</th>
							<th scope="col">Documento</th>
							<th scope="col">Fecha</th>
				    </tr>
				  </thead>
				  <tbody>
						<?php $count = 0; ?>
						<?php if (is_array($historialPedidoEstado) || is_object($historialPedidoEstado)): ?>
							<?php foreach ($historialPedidoEstado as $historial): ?>
					    <tr>
					      <th scope="row"><?= $count++; ?></th>
					      <td><?= $historial['nro_pedido'] ?></td>
					      <td>
									<?php
										if ($historial['oficina'] == 'adquisiciones') {
											echo "Ingreso de pedido SIGA a adquisiciones";
										} elseif ($historial['oficina'] == 'cotizacion') {
											echo "Cotización de pedidos";
										} elseif ($historial['oficina'] == 'cuadro') {
											echo "Elaboración de cuadros comparativos";
										} elseif ($historial['oficina'] == 'orden') {
											echo "Orden de compra o servicio";
										}
									?>
								</td>
								<td>
									<?php foreach ($getPersonal as $getPersona): ?>
										<?php if ($historial['id_responsable']==$getPersona->id_persona): ?>
											<?php echo $getPersona->nombres." ".$getPersona->apellido_p." ".$getPersona->apellido_m; ?>
										<?php endif; ?>
									<?php endforeach; ?>
								</td>
					      <td>
									<?php if ($historial['estado']=='tramite'): ?>
										<span class="badge badge-warning">En tramite</span>
									<?php elseif($historial['estado']=='aprobado'): ?>
										<span class="badge badge-success">Aprobado</span>
									<?php elseif($historial['estado']=='observado'): ?>
										<span class="badge badge-error">Observado</span>
									<?php elseif($historial['estado']=='anulado'): ?>
										<span class="badge badge-secondary">Anulado</span>
									<?php endif; ?>
								</td>
								<td><?= $historial['descripcion'] ?></td>
								<td>
									<?php if ($historial['documento'] != '' || $historial['documento'] != null): ?>
										<a href="../../uploads/EstadoPedido/<?= $historial['documento']; ?>" target="_blank"><i class='fa fa-file fa-2x'></i> <?= $historial['documento']; ?></a>
									<?php endif; ?>
								</td>
								<td>
									<label for="q<?=$count?>b"></label>
									<?= $historial['timestamp'] ?>
								</td>
					    </tr>
							<?php endforeach; ?>
						<?php endif; ?>
				  </tbody>
				</table>
			</div>
			<div class="modal-footer">
				<div class="col-sm-12">
					<button class="btn btn-default custom-close">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	// moment.js locale configuration
	// locale : spanish (es)
	// author : Julio Napurí : https://github.com/julionc
	(function (factory) {
	    factory(moment);
	}(function (moment) {
	    var monthsShortDot = 'ene._feb._mar._abr._may._jun._jul._ago._sep._oct._nov._dic.'.split('_'),
	        monthsShort = 'ene_feb_mar_abr_may_jun_jul_ago_sep_oct_nov_dic'.split('_');
	    return moment.defineLocale('es', {
	        months : 'enero_febrero_marzo_abril_mayo_junio_julio_agosto_septiembre_octubre_noviembre_diciembre'.split('_'),
	        monthsShort : function (m, format) {
	            if (/-MMM-/.test(format)) {
	                return monthsShort[m.month()];
	            } else {
	                return monthsShortDot[m.month()];
	            }
	        },
	        weekdays : 'domingo_lunes_martes_miércoles_jueves_viernes_sábado'.split('_'),
	        weekdaysShort : 'dom._lun._mar._mié._jue._vie._sáb.'.split('_'),
	        weekdaysMin : 'Do_Lu_Ma_Mi_Ju_Vi_Sá'.split('_'),
	        longDateFormat : {
	            LT : 'H:mm',
	            LTS : 'LT:ss',
	            L : 'DD/MM/YYYY',
	            LL : 'D [de] MMMM [de] YYYY',
	            LLL : 'D [de] MMMM [de] YYYY LT',
	            LLLL : 'dddd, D [de] MMMM [de] YYYY LT'
	        },
	        calendar : {
	            sameDay : function () {
	                return '[hoy a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
	            },
	            nextDay : function () {
	                return '[mañana a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
	            },
	            nextWeek : function () {
	                return 'dddd [a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
	            },
	            lastDay : function () {
	                return '[ayer a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
	            },
	            lastWeek : function () {
	                return '[el] dddd [pasado a la' + ((this.hours() !== 1) ? 's' : '') + '] LT';
	            },
	            sameElse : 'L'
	        },
	        relativeTime : {
	            future : 'en %s',
	            past : 'hace %s',
	            s : 'unos segundos',
	            m : 'un minuto',
	            mm : '%d minutos',
	            h : 'una hora',
	            hh : '%d horas',
	            d : 'un día',
	            dd : '%d días',
	            M : 'un mes',
	            MM : '%d meses',
	            y : 'un año',
	            yy : '%d años'
	        },
	        ordinalParse : /\d{1,2}º/,
	        ordinal : '%dº',
	        week : {
	            dow : 1, // Monday is the first day of the week.
	            doy : 4  // The week that contains Jan 4th is the first week of the year.
	        }
	    });
	}));

$(function () {
    $(".custom-close").on('click', function() {
        $('#my_modal').modal('hide');
    });
});

var base_url = '<?php echo base_url(); ?>';

			$("#formAddEstadoPedido").submit(function(event)
			{
					event.preventDefault();

					var formData=new FormData($("#formAddEstadoPedido")[0]);

					$.ajax({
							url: base_url+"index.php/EstadoPedido/register",
							type:'POST',
							enctype: 'multipart/form-data',
							data:formData,
							cache: false,
							contentType:false,
							processData:false,
							success:function(resp)
							{
								swal("Bien!", "Se registro correctamente!", "success");
							},
							error: function ()
							{
									swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error");
							}
					});
			});

			$(function() {

			$('#tag-form-submit').on('click', function(e) {
			    e.preventDefault();
					$.ajax({
						type: "POST",
		        url: base_url+"index.php/EstadoPedido/historialPedidoEstado",
		        data: $('form.feedback').serialize(),
		        success: function(response) {
							$("#myModal").modal('show');
		        },
		        error: function() {
		            alert('Error');
		        }
					});
			    return false;
			});
			});
</script>
