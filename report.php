<?php
    session_start();
    require("config/db.php");
    require("config/config.php");
    $q= "SELECT * FROM Categorie WHERE 1";
    $ris=mysqli_query($conn,$q);
    //$q2= "SELECT * FROM Ubicazioni WHERE 1";
    //$ris2=mysqli_query($conn,$q2);
        
                        
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PROblemSolver</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/main.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/report.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
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
                <li><a href="http://localhost/PROblemSolver/prova.php">Naviga Problemi</a></li>
                <li><a href="#">Riporta Problema</a></li>
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
                <li><a href="http://localhost/PROblemSolver/cerca.php"> Cerca Problemi</a><li>
            </div>
    </div>

<!--FORM INSERIMENTO PROBLEMA-->

    <div>
        <form method= 'POST' action="insert.php"  enctype="multipart/form-data">
            <label for="titolo"><b> Inserisci il titolo del problema: </b></label> <br>
            <input type="text" id="titolo" name="titolo" class="titolo" placeholder="TITOLO" required> <br>

            <label for="descrizione"><b> Descrivi il problema che hai riscontrato: </b></label> <br>
            <textarea name="descrizione" id="descrizione" class="descrizione" placeholder="Descrivi il problema che hai riscontrato..." required> </textarea><br>

            <label for="tag"><b>Inerisci alcuni tag per caratterizzare il problema</b></label> <br>
            <input type="text" id="tag" name="tag" class="tag" placeholder="Inserisci dei tag per caratterizzare il problema "> <br><br>

            <label for="tag"><b>Inerisci l'ubicazione del problema</b></label> <br>
            <input type="text" name="ubicazione" class="tag" placeholder="Inserisci l'ubicazione del problema"> <br><br>

            <input type="checkbox" id="anonimo" name="anonimo" class="anonimo">Desideri rimanere anonimo? <br><br>
            <p class="posiziona">Seleziona una categoria</p>
            <select type="text" id="categoria" name="categoria" class="categoria" required>
                <?php  
                        $i=0;
                        $categorie= mysqli_fetch_all($ris,MYSQLI_ASSOC);
                        while($i<count($categorie)){
                            echo'<option value="'.$categorie[$i]['descrizione'].'">'.$categorie[$i]['descrizione']."</option>";
                            $i++;
                        }
                        $i=0;
                ?>
            </select>
            <!--select type="text"name="ubicazione" class="categoria" required>
                <?php  
                        $i=0;
                        $ubicazioni= mysqli_fetch_all($ris2,MYSQLI_ASSOC);
                        while($i<count($ubicazioni)){
                            echo'<option value="'.$ubicazioni[$i]['descrizione'].'">'.$ubicazioni[$i]['descrizione']."</option>";
                            $i++;
                        }
                        $i=0;
                ?>
            </select-->
            <!--button type="submit" id="button"style ="margin-left: 300px;" onclick="sendProb()">Invia!</button-->
            <button type="submit" id="button"style ="margin-left: 300px;">Invia!</button>

        </form>
    </div>


   <script>
   //script per il menù a scomparsa 
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