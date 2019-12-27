 <script type="text/javascript">
 window.onload=inicio;
    function inicio()
    {
     $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerEstados')?>/",
            type: "get",
            dataType: "json",
            success: function(data)
            {
              
              for(var i=0; i<data.length; i++)
              {
                
                $("#estadoModal").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']))
              }
              obtenerMunicipios();
            }
          });
    }
    //window.onload=obtenerMunicipios;
    function obtenerMunicipios()
    {
      $("#coloniaModal").empty();
      $("#codigoPostal").val("");
      var idEstado=$("#estadoModal").val();
           $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerMunicipios')?>/"+idEstado,
            type: "get",
            dataType: "json",
            success: function(data)
            {
              $("#municipioModal").empty();
              for(var i=0; i<data.length; i++)
              {
                $("#municipioModal").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']))
              }
              obtenerColonias();
            }
          });

    }
    function obtenerColonias()
    {
      $("#codigoPostal").val("");
      var idMunicipio=$("#municipioModal").val();
           $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerColonias')?>/"+idMunicipio,
            type: "get",
            dataType: "json",
            success: function(data)
            {
              $("#coloniaModal").empty();
              for(var i=0; i<data.length; i++)
              {
                $("#coloniaModal").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']))
              }
              obtenerCodigoPostal();
            }
          });
    }
    function obtenerCodigoPostal()
    {
      var idColonia=$("#coloniaModal").val();
           $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerCodigoPostal')?>/"+idColonia,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#codigoPostalModal").val(data[0]["cp"]);
            }
          });
    }
    
    function habilitarAtencionClientes()
    {
        $("#horarioAtencionInicio").prop('disabled', $("#aplicaHorarioAtencion").is(":checked"));
        $("#horarioAtencionFin").prop('disabled', $('#aplicaHorarioAtencion').is(':checked'));

    }


  $(function(){
    $("#form").on("submit", function(e){
      
      var url;
      $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/assets/img/loading.gif"/>');
      url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/altaCentroTrabajo';?>";
      e.preventDefault();
      var f = $(this);
      var formData = new FormData(document.getElementById("form"));
      
      $.ajax({
                  url: url,
                  type: "post",
                  dataType: "html",
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false
              }).done(function(res){
                    if(res==1)
                    {
                      /*swal({
                        title: "HECHO",
                        text: "El centro de trabajo se ha registrado exitosamente.",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false
                      },
                      function(){
                        //window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo")
                        
                      });*/
                      swal("HECHO", "Centro de trabajo registrado", "success")
                       //$('#myModalCentro').modal('hide');
                       $("#myModalCentro").hide();
                       inicioFormatos=1;
                      obtenerDatosFormato();
                
                    
                   }
                   if(res==2)
                   {
                    //swal("HECHO", "Centro de trabajo registrado", "success")
                   }
                   
                  });
      });
  });

  function ponerIdFormato()
  {
    var idFormato=$("#idFormato").val();
    //alert("entra")
    $("#idFormatoModal").val(idFormato);
    $("#myModalCentro").show();
  }

  function actualizaSelectCentro()
  {

  }
  </script>
    