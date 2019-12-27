<?php
$tipo=$this->session->userdata('tipoUser');
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    var array=
        {'datos':[]};
</script>
<section class="content">
    <div class="container-fluid">
        <?php
        if(!$desdeMovil)
        {
        ?>
            <div class="block-header">
                <?php 
				
				$tipo=$this->session->userdata('tipoUser');
				$areaUser=$this->session->userdata('area');
				
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
                {
                    if($tipo == 5 && $areaUser==1 || $tipo == 9 && $areaUser==1){
                        echo "<a href='".site_url('menus')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    }
                }

                ?>
            </div>
        <?php
        }
        ?>
	
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Calculo de riesgo de incendio
                        </h2>

                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="tablaRiesgo">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Centros de trabajo</th>
                                <th>Servicio</th>
                                <th>Subservicio</th>
                                <th>Riesgo de incendio</th>
                            </tr>
                            </thead>
                            <!-- <tbody>
                            <?php
							
							$tipo=$this->session->userdata('tipoUser');
                            $areaUser=$this->session->userdata('area');
							
							$contador=1;
							foreach ($cenTra as $row) {
								$nombreCent=$row["nombre"];
								$servicio = $row["servicio"];
								$subservicio = $row["subservicio"];
								$idOti = $row["idOti"];
								
								if($tipo==5 && $areaUser==1 || $tipo==9 && $areaUser==1)
								{
									echo "
										
										<tr>
											<td>$contador</td>
											<td>$nombreCent (Oti $idOti)</td>
											<td>$servicio</td>
											<td>$subservicio</td>
											<td><a ><i class='fa fa-fire'></i> </a></td>
										</tr>";
										
									$contador++;
								}
							}
                            ?>
                            </tbody> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
	window.onload=inicio;
	function inicio()
	{
		//$('#tablaRiesgo').dataTable({"order": [[ 0, "asc" ]]});
        $('#tablaRiesgo').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": "<?php echo base_url('index.php/Crudbotonespc/getListadoCentro/') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
                    "complete": function () {
                        
                    }
                },
                "columns": [
                    { "data": "idAsignacion" },
                    { "data": "nombre" },
                    { "data": "nombreProyecto" },
                    { "data": "subservicio" },
                    { "data": "RI" }
                ],
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }

            });
	}
</script>

