<?php 
  include "header.php";
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="<?=site_url('CrudIndicadorFormulario');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Modificar Indicador Infraestructura</h2>
                        <!-- <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);">Action</a></li>
                        <li><a href="javascript:void(0);">Another action</a></li>
                        <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                        </li>
                        </ul> -->
                    </div>
                    <div class="body">
                        <form method="post" action="" id="contenido" enctype="multipart/form-data">
                            <h2 class="card-inside-title text-center">Modifique los datos</h2>
                            <!--  <input type="hidden" id="idTramite" name="idTramite" value="<?=$idTramite?>"> -->
                            <input type="hidden" id="idIndicador" name="idIndicador" value="<?php echo $idIndicador ?>">
                            <div style="text-align: center" class="row ">
                                <div class="col-md-4 col-md-offset-2 ">
                                    <label>Nombre de indicador</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="nombreIndicador"  name="nombreIndicador" type="text" class="form-control"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float" style="margin-top: 13px;">
                                        <div class="form-line">
                                            <label for="tipoUser">Tipo de Indicador</label>
                                            <select id="tipoIdi" name="tipoIdi"  onchange="traerInf()" style="width: 100%; border: none;" required>
                                                <option value="">Seleccione Tipo</option>
                                                <option value="1">Opción Multiple</option>
                                                <option value="2">Abierto</option>
                                                <option value="3">Formato numerico</option>
                                                <option value="4">Palomita</option>
                                                <option value="5">Fecha</option>
                                                <option value="6">Evidencia Fotografica</option>
                                                <option value="7">Observaciones</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="complementarios" style="display:none">
                                    <div class="col-sm-4 col-md-2">
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                                <label for="tipoUser">Concepto</label>
                                                <select id="abPc"  name="abPc" onchange="modalIndicadorRiesgo()" style="width: 100%; border: none;" >
                                                    <option value="0">N/A</option>
                                                    <option value="multiplicador" data-toggle="modal" data-target="#modalIndicadorRiesgo">Multiplicador</option>
                                                      <?php
                                                          foreach ($abreviaturaPc as $row) 
                                                          {
                                                              $idAbreviaturaPc = $row["idAbreviaturaPc"];
                                                              $abreviatura = $row["abreviatura"];
                                                              echo "<option value='$idAbreviaturaPc'>$abreviatura</option>";
                                                          }
                                                      ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div id="modalIndicadorRiesgo" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 class="modal-title">INDICADORES DE RIESGO</h3>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="text-center">¿A cuál de los siguientes indicadores se va a multiplicar?</h5>
                                                <table class="table table-striped" id="tblGrid">
                                                    <thead id="tblHead">
                                                        <tr>
                                                            <th style="text-align: center;" colspan="2">INDICADORES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="TbodyIndicadorRiesgo">
                                                        <?php
                                                          foreach ($abreviaturaIndicador as $row) 
                                                          {
                                                            $idAbreviaturaPc = $row["IdAbIndicador"];
                                                            $abreviaturaIndicador = $row["nombreIndicador"];
                                                            echo 
                                                            "<tr>
                                                                <td class='align-justify' colspan='2'>
                                                                    <input type='radio' value='$idAbreviaturaPc' class='with-gap' name='MultiRadio' id='MultiRadio$idAbreviaturaPc'>
                                                                    <label for='MultiRadio$idAbreviaturaPc'>$abreviaturaIndicador</label>
                                                                </td>
                                                            </tr>";
                                                          }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                                            </div>     
                                        </div><!-- /modal-content -->
                                    </div><!-- /modal-dialog -->
                                </div><!-- /modal -->
                                <div class="row">
                                    <div id="btnSubmit" class="col-sm-12" style="display: flex;justify-content: center;">
                                        <div class="form-line">
                                            <input type="submit" class="btn bg-red waves-effect waves-light" value="Aceptar">
                                        </div>
                                        <div id="btnModal" style="display: none">
                                            <div style="display: flex;justify-content: center;margin-left: .2em;">
                                                <button form="3695" class="btn bg-red waves-effect waves-light" data-toggle="modal" data-target="#modalIndicadorRiesgo">Modificar Indicador</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Archivo JQuery-->
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<!--
================================================
=               Funciones script               =
================================================
--> 
<script type="text/javascript">
    window.onload=CargarDatos;
    function CargarDatos()
    {
        var idInd=$("#idIndicador").val();
        $.ajax({
            url : "<?php echo site_url('CrudIndicadorFormulario/getDatosIndiucador')?>/" + idInd,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#nombreIndicador").val(data.nombreIndicador);
                $("#tipoIdi").val(data.tipoIndicador);

                if (data.idMultiplicador) 
                {
                    $('#abPc').val('multiplicador');
                    $('#MultiRadio'+data.IdAbIndicador).attr('checked', true);
                    $("#btnModal").show("linear");
                }
                else if (data.idAbreviaturaPc) 
                {
                    $('#abPc').val(data.idAbreviaturaPc);
                }
                else
                {
                    $('#abPc').val(0);
                }
                traerInf();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
    function traerInf()
    {
        var tipoIdi=$("#tipoIdi").val();
        if (tipoIdi==3)
        {
            $("#complementarios").show();
            $("#TipoIndicador").addClass("col-md-2");
            if ($(window).width() < 992) 
            {
                $("#NombIndicador").removeClass("col-sm-offset-2");
            }
        }
        else if (tipoIdi!=3)
        {
            $("#complementarios").hide();
            $("#TipoIndicador").removeClass("col-md-2");
            if ($(window).width() < 992) 
            {
                $("#NombIndicador").addClass("col-sm-offset-2");
            }
            $("#abPc").val("");
        }
    }

    function modalIndicadorRiesgo()
    {
        var abPc=$("#abPc").val();
        if (abPc=='multiplicador')
        {
            $("#btnModal").show("linear");
            $("#modalIndicadorRiesgo").modal("show");
        }
        else
        {
            $("#btnModal").hide("linear");
            $("#modalIndicadorRiesgo").modal("hide");
        }
    }

    $(function()
    {
        $("#contenido").on("submit", function(e)
        {
            var url;
            $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorFormulario/modificarDatos/';?>";
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("contenido"));
            $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(res)
            {
                swal({
                    title: "HECHO!",
                    text:  "Se modificó el registro exitosamente",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
                window.setTimeout(function()
                { 
                 window.history.back();
                },2000);
            });
        });
    });
</script>
<!--
=================================================
=           Terminan Funciones script           =
=================================================
-->              
<?php 
  include "footer.php";
?>