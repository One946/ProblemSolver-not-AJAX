<?php
    require("config/config.php");
    require("config/db.php");
	session_start();
	$_SESSION["IdProblema"] = mysqli_real_escape_string($conn,$_GET["id"]);

    //recupera l'id
    $id = mysqli_real_escape_string($conn,$_GET["id"]);

    $query1 = "SELECT * FROM Segnalazioni WHERE idProblema = ".$id;
    $query2 = "SELECT * FROM Problemi WHERE idProblema =".$id;
    
    //Prendi il risultato
    $ris1 = mysqli_query($conn, $query1);
    $ris2 = mysqli_query($conn, $query2);
    //inserisco i risultati delle due query in due array associativi necessari per mostrare il problema e recuperare le informazioni sull'utente se necessario
    $segnalazioni = mysqli_fetch_all($ris1, MYSQLI_ASSOC);
    $problemi= mysqli_fetch_assoc($ris2);
    $query3 ="SELECT * FROM Utenti WHERE Utenti.secretID = ". $problemi ["secretID"]; //" SELECT Nome, Cognome FROM Utenti WHERE  Utenti.secretID =".$segnalazioni["secretID"];
    $ris3 = mysqli_query($conn, $query3);
    $utenti = mysqli_fetch_assoc($ris3);
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Titolo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
		<link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/main.css"
		> 
		<link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/report.css">
        
</head>
<body class="parallax" >
    <!-- navbar -->
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
					<li> <a href="http://localhost/PROblemSolver/index.php">Home</a></li>
					<li> <a href="http://localhost/PROblemSolver/prova.php" style="color">Naviga Problemi</a></li>
					<li> <a href="http://localhost/PROblemSolver/report.php">Riporta Problema</a></li>
					<li> <a href="http://localhost/PROblemSolver/login.php">Login/Registrati</a></li>
				</ul>

			</nav>
		<!--Menu a scomparsa-->
			<div id="side-menu" class="side-nav">
					<a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
					<a href="#">Home</a>
					<a href="#">Naviga Problemi</a></a>
					<a href="#">Riporta Problema</a>
					<a href="#">Login/Registrati</a>
			</div>

			
			


<!--Descrizione problema -->
	<div class="stripe" style="opacity:0.95;">
			<h1><?php echo $problemi["titolo"];?></h1>
			<div>	<p> id Problema:</p> <p id="idProblema"> <?php echo $problemi["idProblema"];?> </p> </div>
			<h3 style="color: black;"><?php echo $problemi["descrizione"];?></h3>
            <p> codice segreto utente : <?php echo $utenti["secretID"];?></p>
            <p>
				<?php if ($utenti["anonimo"] = 0) {
						  echo ("che corrisponde all'utente: ".$utenti["Nome"]." " . $utenti[ "Cognome"]);
					  }
					  else{
						  	echo "<b> L'utente ha deciso di effetturare la segnalazione in modo anonimo </b>";
					  }
					  
					 
					 
					 
				?> <br> <br>
			<a class="btn btn-default" style="margin-left: 46%;"href="http://localhost/PROblemSolver/index.html" style="active : lightblue;"> <b> Torna alla home! </b> </a>  
			
			<!--Sezione inserimento commenti--> 
			<form>
				<label for="commento"> <b>Commenta il problema!</b> </label><br>
				<textarea name="commento" id="commento" class="descrizione" placeholder="Esprimi una tua opinione riguardo al problema" required> </textarea><br>
				<button type="submit" id="button" onclick="	console.log(createJason())	">Invia!</button>
			</form>
	</div>
	
				<!--Sezione display commenti-->

    
    
    
    <script>
		function createJson(){
			var myObj = {
				secretIdUtente: <?php echo $_SESSION["secretID"];?>,
				commento: document.getElementById("commento").value,
				idProblema: document.getElementById("idProblema").value
			};
			return myObj;
		}
		// funzione per effetturare la richiesta asincrona
		function comment(){
			var json = createJson();
			var xhr = new XMLHttpRequest();
			xhr.open("POST","comment.php",true);
			xhr.send(json);
		}

			//script per aprire e chiudere il menù a scomparsa in modalità mobile
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