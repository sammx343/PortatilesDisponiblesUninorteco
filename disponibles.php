<?php
  require('func_disponibles.php');
?>

<!doctype html>
<html lang="en">

    <head>
        <title>Préstamo de portátiles - UNINORTE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">

        <!-- Theme Style -->
        <link rel="stylesheet" href="css/style.css">
    </head>

  <!--Just an image-->
  <section class="site-hero site-sm-hero overlay" data-stellar-background-ratio="0.5"
     style="background-image: url(res.JPG);">
  </section>

    <body>


        <header role="banner">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="icono-lap">
                    <h5 class="navbar-brand absolute" href="index.html">Préstamo de portátiles - UN</h5>
                    <span class="ion-android-laptop"></span>
                </div>            
            </nav>

        </header>

        <!-- END header -->
             
        <div class="site-section bg-light">            
            <div class="aligncenter"> 
                <?php
                    $elem = ejecutar();
                    foreach($elem as $row){                 
                        echo'<div class="row1">';
                            echo'<div class="col-12">';
                                echo'<div class="card-deck">';
                                    echo'<div class="card">';
                                        echo'<img class="card-img-top img-adjusted">';
                                        echo'<div class="card-body">';
                                            echo'<div id="textbox">';
                                                echo'<h5 class="alignleft" class="card-title" >';
                                                echo substr($row['UBICACION'],0,7); 
                                                echo'</h5> <!--Nombre de la sala-->';
                                                echo'<div class="sdu">';
                                                    echo'<p class="alignright">';
                                                        echo'<a class="btn">';
                                                            if(strlen( $row['DISPONIBLES']) == 3){
                                                                echo $row['DISPONIBLES']; 
                                                            }else{
                                                                echo " ".$row['DISPONIBLES']." ";
                                                            }
                                                            
                                                        echo'</a>';
                                                    echo'</p> <!-- Pcs disponibles en la sala-->';
                                                echo'</div>';
                                            echo'</div>';
                                            echo'<br>';
                                            echo'<p class="card-text">';
                                                echo substr($row['UBICACION'],9); 
                                            echo'</p> <!--Bloque en el que se encuentra la sala-->';
                                            echo'<div class="puntos"></div>';
                                        echo'</div>';
                                    echo'</div>';
                                echo'</div>';
                            echo'</div>';
                        echo'</div>';
                    }
                ?>
            </div>
        </div>

        <!-- Fin salas -->
        <div style="height:5px;">&nbsp;</div>
        <div class="res">        
            <p class="text-center"><a class="btn btn-lg" href="g_temporizador.php">Ver mi préstamo actual</a></p> <!-- Funcionalidad btn enviar a sala_virtual -->
        </div>
        <div style="height:10px;">&nbsp;</div>
        <div class="res">
            <div  class="text-center">
                <p class="sub">¿Necesitas algún software especializado?</p>
            </div>
        </div>
        <div style="height:5px;">&nbsp;</div>
        <div class="res">        
            <p class="text-center"><a class="btn btn-lg" href="sala_virtual.php">Conoce tu escritorio virtual</a></p> <!-- Funcionalidad btn enviar a sala_virtual -->
        </div>
        <div style="height:5px;">&nbsp;</div>
        

        <!-- Fin escritorio virtual -->
        
                       
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery-migrate-3.0.0.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.waypoints.min.js"></script>
        <script src="js/jquery.stellar.min.js"></script>
        <script src="js/jquery.animateNumber.min.js"></script>
        <script src="js/main.js"></script>

    </body>

</html>