<!DOCTYPE html>
<html> 

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ahorcado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src='ahorcado.js'></script>


    <!-- <link rel="stylesheet"   type="text/css" href="debug.css">    -->

    <script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

    <style>
      .center {
        display: flex;
        justify-content: center;
        align-items: center;


      }

      .letter {
        padding: 5px;
      }
    </style>

  </head>

<body style="padding: 20px; background: #F5F5DC;"> 

    <?php 
                session_start();
                require 'funciones.php';

           //No hay juego empezado. Vamos a la pantalla de inicio
          if (!isset($_SESSION['peli']))  
            header('Location:empezar.php');

                  $final = false;
                  if (isset($_GET['letra'])) {
                    $letra = strtoupper($_GET['letra']);

                      $resultado = jugar($letra);
                      switch ($resultado) {
                        case 1:
                          $mensaje = '<hr><div class="content center "><h3 class="title has-text-primary center">Letra ya jugada</h3></div>';
                          break;
                        case 2:
                          $mensaje = '<hr><div class="content center "><h3 class="title has-text-danger"> La letra no esta.</h3></div>';
                          break;
                        case 3:
                          $mensaje = '<hr><div class="content center"><h3 class="title has-text-red">Letra incorrecta</h3></div>';
                          break;
                        case 9:
                          $mensaje = "<hr><div class='content center'><h3 class='title has-text-danger'>Estas ahorcado el resultado es: " . $_SESSION['peli'] . "</h3></div>";
                          $final = true;
                          break;
                        case 0:
                          $mensaje = '<hr><div class="content center"><h3 class="title has-text-success">Muy bien letra correcta</h3></div>';
                          break;
                        case -1:
                          $mensaje = "<hr><div class='content center'> <h4 class='title has-text-primary'>FELICIDADES HAS ACERTADO!</h4></div>";
                          $final = true;
                          break;
                      }
                    } ?>
              <div class="columns center">

                <a class="button has-text-primary" style="margin-left:-10px "> <?= $idiomas[$_SESSION['idioma']]['nombre'] ?> </a>


                <div class="colum center">
                  <!-- canvas ahorcado -->
                  <canvas id='horca' width='200' height='190'></canvas>
                </div>
              </div>


    <script>
      ahorcado('horca', <?= $_SESSION['fallos'] ?>);
    </script>


    <div class="center" style="font-size:20px;padding:5px;margin:2px;background:#dec;margin:auto;border:1px solid blue">

      <?php
      $peli = $_SESSION['peli'];

      for ($i = 0; $i < strlen($peli); $i++) {
        if ($peli[$i] == ' ')
          echo '&nbsp;&nbsp;';
        elseif (!yajugada($peli[$i]))
          echo '_&nbsp; ';
        else
          echo $peli[$i] . ' ';
      }
      echo '</div>';
      if (!$final) { // No se ha acabado el juego
      ?>
    </div>
    <hr> 
                <div class='table-container'>
                  <table class='table'>
                    <tr>
                      <div class="container buttons center">

                        <!-- letra -->
                        <?php
                        $letras = $idiomas[$_SESSION['idioma']]['letras'];

                        foreach (mbstr_split($letras) as $letra) {
                          if (!yajugada($letra)) {
                            echo "
                                        <a class=' letra button is-success is-small' href='?letra=$letra'>$letra</a>";
                          } else
                            echo "<p class='button is-danger is-small disabled'><span>$letra</span></p>";
                        }

                        ?>

                      </div>
                    <tr>
                  </table> 
                              <?php
                                } else
                                  echo '<p>';
                                if (isset($mensaje)) echo "<span class=mensaje>$mensaje</span>";
                              ?>
                </div>
      <div class="container center"><a class="button is-primary" href='empezar.php'>Empezar de nuevo</a> 
                    </div>
                    <hr>

    <?php if ($final)
      session_destroy(); ?>
   

        <footer class="footer" style="background: ;">
          <div class="content has-text-centered">
            <p>
              <strong>Ahorcado</strong> by <a href="https://androidytecnologia.blogspot.com/?m=1">Android y tecnologia</a>.

            </p>
          </div>
        </footer>

</body>

</html>