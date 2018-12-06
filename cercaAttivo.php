<?php //BACHECA VISUALIZZAZIONE PROBLEMI
    require("config/db.php");
    require("config/config.php");
    session_start();
//Query per selezionare tutti i problemi che non sono stati risolti e visualizzarli2
    $query1 = "SELECT * FROM Utenti  WHERE secretID = (SELECT secretID FROM Problemi GROUP BY secretID ORDER BY COUNT(*) DESC LIMIT    1)";

    
    //Prendi il risultato
    $ris1 = mysqli_query($conn, $query1);
    //Inserisco il risultato della query in un array associativo
    $prob = mysqli_fetch_all($ris1,MYSQLI_ASSOC);
    mysqli_free_result($ris);
    mysqli_close($conn);

?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Titolo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/main.css">
</head>
<body class="parallax" >     
<div class="container">
<nav class="navbar">
            <span class="open-slide">
                <a href="#" onclick="openSlideMenu()">
                <svg width="30" height="30">
                    <path d = "M0,5 30,5" stroke="#fff" stroke-width="5"/>
                    <path d = "M0,14 30,14" stroke="#fff" stroke-width="5"/>
                    <path d = "M0,23 30,23" stroke="#fff" stroke-width="5"/>
                </svg>
                </a>
            </span>
            <ul class="navbar-nav">
                <li><a href="http://localhost/PROblemSolver/index.php">Home</a></li>
                <li><a href="#">Naviga Problemi</a></li>
                <li><a href="http://localhost/PROblemSolver/report.php">Riporta Problema</a></li>
                <li><a href="http://localhost/PROblemSolver/login.php">Login/Registrati</a></li>
                <li><a href="http://localhost/PROblemSolver/cerca.php"> Cerca Problemi</a><li>
            </ul>

            </nav>
        <!--Menu a scomparsa-->
            <div id="side-menu" class="side-nav">
                <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
                <a href="http://localhost/PROblemSolver/index.php">Home</a>
                <a href="http://localhost/PROblemSolver/prova.php">Naviga Problemi</a></a>
                <a href="#">Riporta Problema</a>
                <a href="http://localhost/PROblemSolver/login.php">Login/Registrati</a>
            </div>
    </div>



   <!-- faccio un ciclo per mostrare tutti i problemi-->
    <?php
    
        foreach($prob as $titoli) : ?>

        <div style="opacity:0.95; background: #f4f4f4; margin: auto; width:1000px; border-radius: 20px; text-align: center; color: #3b5998;   ">
            <h1>L'utente che ha riportato più problemi è:    </h1>
            <h2><?php echo ("Nome: ".$titoli["Nome"]."<br> Cognome: ". $titoli["Cognome"]);?></h2>
            <p> <?php echo ("SecretID: ".$titoli["secretID"]);?></p>
        </div>
    <?php endforeach;?> 

</div>

   <script>
        function openSlideMenu(){
            document.getElementById("side-menu").style.width="250px"
            document.getElementById("main.").style.marginLeft="250px"
        }
        function closeSlideMenu(){
            document.getElementById("side-menu").style.width="0px"
            document.getElementById("main.").style.marginLeft="0px"
        }
    </script>   
</body>
</html>