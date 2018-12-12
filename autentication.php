<?php
    session_start();
    require("config/db.php");
    require("config/config.php");
    //query di match tra email e password
        //se va a buon fine prendo tutto da utente e inizializzo la sessione
        //select * from Utenti where email= 'giuseppe.dagostin94@gmail.com' && password=MD5('password')
    $verifica="SELECT * FROM Utenti WHERE email = '{$_POST['email']}' && password = MD5('{$_POST['password']}')";  
    $a=mysqli_query($conn, $verifica);
    if($a){
        $utente=mysqli_fetch_assoc($a);
        $_SESSION["secretID"] = $utente['secretID'];
    }
    
    $benvenuto="Bentornato ".$utente["Nome"]." ".$utente["Cognome"];
    $post= "SELECT COUNT(idProblema) AS NumPost FROM Problemi WHERE secretID = '".$utente["secretID"]."'";
    $f = mysqli_query($conn, $post);
    $numpost= mysqli_fetch_assoc($f);
    $pp="Hai effettuato ".$numpost["NumPost"]." post";
    
    
   // $_SESSION["secretID"] = $utente['secretID'];
    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Segnala</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/main.css">
</head>
<body background= "messina.jpg">


<div class="container">
            <!--NavBar-->
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
					<a href="http://localhost/PROblemSolver/report.php">Riporta Problema</a>
					<a href="http://localhost/PROblemSolver/login.php">Login/Registrati</a>
                    <li><a href="http://localhost/PROblemSolver/cerca.php"> Cerca Problemi</a><li>
			</div>
</div>



<!--Esito dell'operazione-->
<div class="stripe" style="opacity: 0.95;">
<h1> <?php echo($benvenuto);?> </h1>
<h3> <?php echo($pp);?> </h3>
<a class="button button-default" href="http://localhost/PROblemSolver/index.php"><b>Torna alla home</b></a>
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