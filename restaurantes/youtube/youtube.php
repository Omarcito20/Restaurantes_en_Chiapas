<html>
  <head>
    <title>Buscador de videos</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link href="../css/modern-business.css" rel="stylesheet">    
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">    
      <div class="container">
        <a class="navbar-brand" href="../restaurantes.html">Inicio</a>
      </div>
    </nav>
    <br><br>
  <div id="formulario" class="row align-intems-center justify-content-around">
		<div class="col-lg-4 col-10">
			<h2 id="letrero">Buscador de videos</h2>
			<br><br>
		  <form method="post" action="#">
			  <div class="form-row">
			 	  <div class="col">
			   	  <label for="busqueda">Busca tu Restaurante favorita: </label>
					  <input type="search" class="form-control" placeholder="Realiza una busqueda" name="busqueda">
					  <label for="busqueda">Máximo: </label>
					  <input type="number" class="form-control" name="busqueda">
				    <br><button type="submit" class="btn btn-primary">Buscar</button>
				  </div>
			 </div>
		  </form>
	  </div>

  <div class="col-lg-6 col-10">
   <?php
      require_once '../googleapi/vendor/autoload.php';
        $tiene_busqueda = isset( $_POST['busqueda'] );
        $max = isset( $_POST['max'] ) ? $_POST['max'] : "5";
      if( $tiene_busqueda ) {
          $DEVELOPER_KEY = 'AIzaSyDfSp7AENaRJ72kh6Bi-L5gSLWFjGRHAhY';

          $client = new Google_Client();
          $client->setApplicationName('UTselva4A');
          $client->setDeveloperKey($DEVELOPER_KEY);

          $youtube = new Google_Service_YouTube($client);
          $respuesta = $youtube->search->listSearch('id, snippet', 
            array(
              'q' => $_POST['busqueda'],
              'maxResults' => $max,
              'order' => 'date'
            )
          );
          //print_r($respuesta);
                    
          foreach ($respuesta['items'] as $video){
            $titulo = $video['snippet']['title'];
            $texto = $video['snippet']['description'];
            $fecha = $video['snippet']['publishedAt'];

            $thumbnails = $video['snippet']['thumbnails'];
            $imagen = $thumbnails['medium']['url'];

            $id = $video['id']['videoId'];
  ?>
  
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4" > 
              <a href="https://www.youtube.com/watch?v=<?php echo $id; ?>" target="_blank">
                <img src="<?php echo $imagen; ?>" class="card-img" alt="...">
              </a>
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?php echo $titulo; ?></h5>
              <p class="card-text"><?php echo $texto; ?></p>
              <p class="card-text"><small class="text-muted"><?php echo $fecha; ?></small></p>
            </div>
          </div>
        </div>  
      </div>
        <?php
            }
          } else {
        ?>
            <br><br><br><p id="ruta">Escribe tu búsqueda</p>
        <?php        
          }
        ?>
            
    </div>
  </div>
</body>
</html>
