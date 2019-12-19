<?php
  require('func_temporizador.php');
?>

<!DOCTYPE HTML>
<html>
    <head>

        <title>Préstamo de portátiles - UNINORTE</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">


        <!-- Clock Theme Style -->
        <link rel="stylesheet" href="css/style.css">

            <style>
                p {
                text-align: center;
                border-radius: 15px !important;
                font-size: 30px !important;
                font-weight: 266.6 !important;
                position: absolute !important;
                top: 70px;
                left: 0px !important;
                width: 200px !important;
                }
                .p1 {
                font-size: 12px !important;
                text-align: center !important;
                font-weight: 266.6 !important;
                position: absolute !important;
                top: 0px !important;
                width: 200px !important;
                }
            </style>
            
        </link>

    </head>

       <body>

        <header role="banner"></header>    

        <div style="height:5px;">&nbsp;</div>
        <div class="timer-group">
            <div class="timer hour">
                <div class="hand"><span></span></div>
                <div class="hand"><span></span></div>
            </div>
            <div class="timer minute">
                <div class="hand"><span></span></div>
                <div class="hand"><span></span></div>
            </div>
            <div class="timer second">
                <div class="hand"><span></span></div>
                <div class="hand"><span></span></div>
            </div>
            <div class="face">
                <p id="demo"></p> 
            </div>
        </div>

        <?php
        $tiempos = ejecutar();
        foreach($tiempos as $row){ 
         $mes = substr($row['FECHA_VENCIMIENTO'],3,2); 
         $dia = substr($row['FECHA_VENCIMIENTO'],0,2); 
         $anno = substr($row['FECHA_VENCIMIENTO'],6,4); 
         $hora = substr($row['HORA_VENCIMIENTO'],0,2); 
         $minuto = substr($row['HORA_VENCIMIENTO'],3,2); 
         $tiempo = $mes."/".$dia."/".$anno." ".$hora.":".$minuto.":00";
        }
        ?>   
        

        <script>
        
            //var to js
            var tiempojs ='<?php echo $tiempo;?>';

            // date we're counting down to
            var countDownDate = new Date(tiempojs).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // today's date and time
                var now = new Date().getTime();
                    
                // distance between now and the count down date
                var distance = countDownDate - now;
                    
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                // Output the result in an element with id="demo"
                if(hours!=0){
                    document.getElementById("demo").innerHTML = hours + "h "
                    + minutes + "m " + seconds + "s ";
                }
                else{
                        document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
                }
                
                    
                // If the count down is over, write some text "Tienes multa"
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "¡Tienes multa!";
                }
            }, 1000);
        </script>

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
                                                    echo "Entrega el portátil antes de:";
                                                echo'</h5> <!--Nombre de la sala-->';                                                    
                                            echo'</div>';
                                            echo '<div class="aligncenter" style="height:20px;">&nbsp;</div>';
                                            echo'<p class="p1">';
                                                echo '<div style="height:5px;">&nbsp;</div>';
                                                echo $row['HORA_VENCIMIENTO']; //hora para entregar pc
                                            echo'</p> <!--Bloque en el que se encuentra la sala-->';
                                            echo'<div class="puntos"></div>';
                                        echo'</div>';
                                    echo'</div>';
                                echo'</div>';
                            echo'</div>';
                        echo'</div>';

                        echo'<div class="row1">';
                        echo'<div class="col-12">';
                            echo'<div class="card-deck">';
                                echo'<div class="card">';
                                    echo'<img class="card-img-top img-adjusted">';
                                    echo'<div class="card-body">';
                                        echo'<div id="textbox">';
                                            echo'<h5 class="alignleft" class="card-title" >';
                                                echo "Entrega el portátil en:"; 
                                            echo'</h5> <!--Nombre de la sala-->';                                                    
                                        echo'</div>';
                                        echo '<div style="height:20px;">&nbsp;</div>';
                                        echo'<p class="p1">';
                                            echo '<div style="height:5px;">&nbsp;</div>';
                                            echo $row['UBICACION']; //sala para entregar pc
                                        echo'</p> <!--Bloque en el que se encuentra la sala-->';
                                        echo'<div class="puntos"></div>';
                                        echo '<div style="height:30px;">&nbsp;</div>';
                                    echo'</div>';
                                echo'</div>';
                            echo'</div>';
                        echo'</div>';
                    echo'</div>';
                    }
                ?>

            </div>
        </div>

        
    </body>
</html> 