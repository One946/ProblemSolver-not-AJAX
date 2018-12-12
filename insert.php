<?php
    require("config/db.php");
    session_start();

    //inizializzazione variabili da inserire nel db
    //il comando myqli_real_escape_string non funziona come mi aspetto
    $anonimo = $_REQUEST["anonimo"];
    $titolo = $_REQUEST["titolo"];
    $descrizione = $_REQUEST["descrizione"];
    $tag = $_REQUEST["tag"];
    //$anonimo= mysqli_real_escape_string($conn,$_REQUEST["anonimo"]); non mi serve usare l'escape perchè sovrascrivo la variabile
    $categoria = $_REQUEST["categoria"];
    $ubicazione =  $_REQUEST["ubicazione"];
//***************************************************************************** */

$qIU="INSERT INTO Ubicazioni(descrizione) VALUES('$ubicazione')";
if(mysqli_query($conn, $qIU)){
    $qIdUb="SELECT idUbicazione FROM Ubicazioni WHERE descrizione = '".$ubicazione."'"; //query selezione idUbicazione
    $rIdUb = mysqli_query($conn,$qIdUb); //esecuzione delle query
    $idUbicazione= mysqli_fetch_assoc($rIdUb);  //risultato della query
}else{
    $qIdUb="SELECT idUbicazione FROM Ubicazioni WHERE descrizione = '".$ubicazione."'"; //query selezione idUbicazione
    $rIdUb = mysqli_query($conn,$qIdUb); //esecuzione delle query
    $idUbicazione= mysqli_fetch_assoc($rIdUb);  //risultato della query
  }


//**********************************************************+ */


    if ($anonimo == "on"){
        $anonimo = 1;
    } else{
        $anonimo = 0;
    }
    
    $qCat= "SELECT idCategoria FROM Categorie WHERE descrizione ='".$categoria."'"; 
    $risCat=mysqli_query($conn, $qCat);
    if($risCat){
        $cate=mysqli_fetch_assoc($risCat);
    }else{
        echo("errore nella selezione della categoria");
    }

    //la variabile secretID viene presa dalla sessione dell'utente che ha effettuato il login
    //query di inserimento problema nel db
    $qProb= "INSERT INTO Problemi (secretID, boolAnonimo, idUbicazione, idCategoria, descrizione, titolo) VALUES (".$_SESSION["secretID"].", ".$anonimo.", ".$idUbicazione["idUbicazione"].",".$cate["idCategoria"]." , '".$descrizione."', '".$titolo."')" ;
    echo($Prob);
    if (mysqli_query($conn, $qProb)) { //se la query va a buon fine eseguo la queri per ottenere l'id del problema creato che viene creato in automatico tramite l'auto increment
        //query per ottenere l'id del problema appena creato

        $qID= "SELECT idProblema FROM Problemi WHERE (boolAnonimo = '$anonimo') &&  (descrizione = '$descrizione') && (titolo = '$titolo')";
        $risID = mysqli_query($conn, $qID);
        $idProb = mysqli_fetch_assoc($risID);   
        //la variabile $a equivale all'id del problema
        $a=$idProb["idProblema"]; 

        $j= "il problema è stato inserito correttamente nella base di dati";
    } else {
        //altrimenti stampo un messagio d'errore
        echo "Error: ". mysqli_error($conn);
    }


    
    //inserimento tag nel database

    $arrayTag= explode(" ", $tag); //divido la singola stringa che ricevo come input dei tag in tanti piccoli tag da inserire nel dizionario o da legare al problema
  
    foreach ($arrayTag as $arrayTag){
            //query di inserimento tag
        $qTag = "INSERT INTO DizionarioTag (descrizione) VALUES ('$arrayTag')";
        $exqTag=mysqli_query($conn,$qTag);
        //devo verificare che la query è andata a buon fine?    
        //query per ottenere l'id del tag appena inserito nel dizionario
        $qIdTag= "SELECT idTag FROM DizionarioTag WHERE descrizione = '$arrayTag'";
        $risIdTag= mysqli_query($conn,$qIdTag);
        $idTag = mysqli_fetch_assoc($risIdTag);
        $valId = $idTag['idTag'];
        if($valId){                        
            //query di collegamento Tag-Problema
            $qBridge = "INSERT INTO tagBridge (idProblema, idTag) VALUES ($a,   $valId)";
            if($conn->query($qBridge)){  //metodo PDO per eseguire la query
                
                $k="inserimento tag  avvenuto con successo";
            }else{ 
                echo 'errore!';
            }
        }
        
    } 
    
    mysqli_close($conn);

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
<?php echo("<p> ".$j."</p>");?>
<?php echo("<p> ".$k."</p>");?>
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