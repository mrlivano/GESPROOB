<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="list-group">
							<?php foreach ($recurso as $key => $value) { ?>
							<a href="<?=base_url();?>index.php/ET_RelacionInsumo/insertar?id_et=<?=$id_et?>&id_recurso=<?=$value->id_recurso?>" target="_blank"  class="list-group-item"><?=$value->desc_recurso?></a>
							<?php } ?>
						</div>
					</div>					
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
