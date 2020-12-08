<html>
  <head>
    <title>Ejemplo de Mapas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">    
      <div class="container">
        <a class="navbar-brand" href="../restaurantes.html">Inicio</a>
      </div>
    </nav>
    <br><br>
    <br><br><br class="d-lg-none d-block"><br class="d-lg-none d-block">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-4 col-10 order-lg-1 order-2">
        <?php

            $respuesta = file_get_contents("https://maps.googleapis.com/maps/api/directions/json?key=AIzaSyDbPXOOo9OcRaKinhJjDub-21vavOb9zYE&origin=16.912585535881615,-92.08202177644347&destination=16.7528115,-93.1120312&mode=driving");
            $json = json_decode($respuesta);

            $distancia = $json->{"routes"}[0]->{"legs"}[0]->{"distance"}->{"text"};
            $duracion = $json->{"routes"}[0]->{"legs"}[0]->{"duration"}->{"text"};
            $resumen = $json->{"routes"}[0]->{"summary"};
        ?>
        <div class="card sombra">
          <div class="card-header">
            <h3 class="card-title"><?php echo $resumen; ?></h3>
          </div>
          <div class="card-body">
            <blockquote class="blockquote mb-0">
              <p><?php echo "<strong>Distancia:</strong> " . $distancia; ?></p>
              <p><?php echo "<strong>Duración:</strong> " . $duracion; ?></p>
              <footer class="blockquote-footer">Modo <cite title="Source Title" class="parpadeo">driving</cite></footer>
            </blockquote>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-10 order-lg-2 order-1">
        <iframe class="sombra" width="100%" height="450" frameborder="0" style="border:0" 
            src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyDbPXOOo9OcRaKinhJjDub-21vavOb9zYE&origin=16.912585535881615,-92.08202177644347&destination=16.7528115,-93.1120312&mode=driving" allowfullscreen></iframe>
        <br class="d-lg-none d-block"><br class="d-lg-none d-block">
      </div>
    </div>
  </body>
</html>