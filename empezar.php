<!DOCTYPE html>
<html>
  <head>
  <meta>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ahorcado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
     
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   
  
    <!-- <link rel="stylesheet"   type="text/css" href="debug.css">    -->
     
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

    <style>
      .center{
        display: flex;
        justify-content: center;
        align-items: center;
        
      } 
    </style>
  </head>
  <body style="padding:20px">  
   
  <section class="section center" style="border: 1px solid black">
    <div class="container">
     
                <?php
                session_start();
                    
                    require 'funciones.php';

                  if(isset($_GET['idioma'])){
                    $idioma=$_GET['idioma'];
                    if(!isset($idiomas[$idioma])) die('Idioma incorrecto');
                    empezar($idioma);
                    header('Location:index.php');
                   } 
                      ?> 
 
                   <div class="has-background-black "><h1 class="title center has-text-white ">Ahorcado</h1></div> 
                  <hr> 
                  <h2 class="subtitle center">Selecciona categoria:</h2>
                  
                  <?php

                    foreach($idiomas as $codigo=>$datos)
                      echo "<div class='buttons center '><a href=?idioma=$codigo class='button has-text-white is-link is-rounded  is-fullwidth'>".$datos['nombre'].'</a></div>';
                    ?>
                    

                    <!-- <a href="https://www.etsy.com/shop/carlum"><img src="assets/images/carlum.png" style="max-width: 80%; display: block;margin: auto"></a> -->

    </div>

    
  </section>

  <footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Ahorcado</strong> by <a href="https://androidytecnologia.blogspot.com/?m=1">Android y tecnologia</a>. 
        
    </p>
  </div>
</footer>
  </body>
</html>


 
   
   
   

		
	
  
  
   