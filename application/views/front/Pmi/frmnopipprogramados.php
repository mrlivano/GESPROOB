<style>
  #table-ProyectoInversionProgramado > tbody > tr > td
  {
    vertical-align: middle;
  }
   #table_operacion_mantenimiento>tbody>tr>td:nth-child(0n+6)
  {
    text-align: right;
  }
</style>
<div class="right_col" role="main">
    <div class="">
    <div class="page-title"></div>
    <div class="clearfix"></div>
    <div class="">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>PROYECTOS<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-4">
                            <select  id="Cbx_AnioCartera_no_pip" selected name="Cbx_AnioCartera_no_pip"  class="selectpicker"></select>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="table_operacion_mantenimiento" class="table table-striped table-bordered table-hover table-responsive display  compact " ellspacing="0" width="100%">
                            <thead style="background-color: #5A738E;color:#FFFFFF; ">
                                <tr>
                                    <th style="width: 1%">Id</th>
                                    <th style="width: 5%">Cód único</th>
                                    <th style="width: 5%">Tipo NO PIP</th>
                                    <th style="width: 20%">Inversión</th>
                                    <th style="width: 4%">Prioridad</th>
                                    <th style="width: 14%">Brecha</th>
                                    <th style="width: 4%">AÑO 1</th>
                                </tr>
                            </thead>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    </div>
</div>
<script>
    $(document).ready(function()
    {
        $('#table_operacion_mantenimiento').DataTable(
        {
            "language":idioma_espanol
        });
    });
</script>
