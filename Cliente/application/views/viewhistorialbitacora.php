    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="margin-top:15px;">
                <h2>Historial de bitacora</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-xs-12" >
                    <b>Ver bitacoras anteriores</b>
                    <div id="contenInput"></div>
                    <select class="form-control" id="bitacorasAnteriores" onchange="verBitacoraAnterior(<?=$idCentroTrabajo.",".$idBitacora?>)">
                        <option value="">Seleccione un respaldo</option>
                        </select>
                 </div>
            </div>
            <!-- #END# Widgets -->
           
        </div>
    </section>

<script type="text/javascript">
    window.onload=getHistorico;
    function getHistorico()
    {
        $("#contenInput").html("");
         $.ajax({
            url: '<?=site_url("Crudnormasgrales/obtenerRespaldos/$idCentroTrabajo/$idBitacora")?>',
            contentType: false,
            dataType: 'JSON',
            processData: false,
            success: function (response)
            {
                for(i=0; i<response.length; i++)
                {
                    $("#bitacorasAnteriores").append("<option value='"+response[i]['idBitacoraRespaldo']+"'>"+response[i]['fecha']+"</option>");
                    $("#contenInput").append('<input type="hidden" id="idAsig'+response[i]['idBitacoraRespaldo']+'" value="'+response[i]['idAsignacion']+'"/>');
                }
            }
        });
    }
    function verBitacoraAnterior(idCentroTrabajo, idBitacora)
    {
        
        var respaldo=$("#bitacorasAnteriores").val();
        var idAsignacion=$("#idAsig"+respaldo).val();
        
       
        if(respaldo)
         window.open("<?=site_url('Crudnormasgrales/verPDFAnterior/')?>"+idCentroTrabajo+"/"+idBitacora+"/"+respaldo);
    }
</script>
