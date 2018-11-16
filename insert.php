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
    if ($anonimo == "on"){
        $anonimo = 1;
    } else{
        $anonimo = 0;
    }
    var_dump($_REQUEST);


    //la variabile secretID viene presa dalla sessione dell'utente loggato per tanto per ora è arbitraria come la variabile votourgenza
    // allineare variabili categoria con quelle del db
    //query di inserimento problema nel db
    $qProb= "INSERT INTO Problemi (secretID, votoUrgenza, tag, boolAnonimo, idUbicazione, idCategoria, descrizione, titolo) VALUES (0, 0, '".$tag."', ".$anonimo.", 2, 1, '".$descrizione."', '".$titolo."')" ;
   
   
    if (mysqli_query($conn, $qProb)) {
        echo "New record created successfully";
        //query per ottenere l'id del problema appena creato
        $qID= "SELECT idProblema FROM Problemi WHERE (secretID = 0) && (boolAnonimo = '$anonimo') && (descrizione = '$descrizione') && (titolo = '$titolo')";
        $risID = mysqli_query($conn, $qID);
        $idProb = mysqli_fetch_assoc($ris1);
    } else {
        echo "Error: " . $qProb . "<br>" . mysqli_error($conn);
    }

    //query per ottenere l'id del problema appena creato
    $qID= "SELECT idProblema FROM Problemi WHERE (secretID = 0) &&  (descrizione = '$descrizione') && (titolo = '$titolo')";
    $risID = mysqli_query($conn, $qID);
    $idProb = mysqli_fetch_assoc($risID);
    echo("<p>".$idProb["idProblema"]."</p>");
    //la variabile $a equivale all'id del problema
    $a=$idProb["idProblema"]; 
    //echo($idProb["idProblema"]); //query funzionante

    //query di creazione della segnalazione
    $qSegn="INSERT INTO Segnalazioni (idProblema) VALUES($a)";
    if (mysqli_query($conn, $qSegn)) {
        $b= "La segnalazione del problema è avvenuta correttamente!";
        echo($b);
    }else {
        $b= "si è verificato un errore riprova";
        echo($b);
        die(mysqli_error($conn));
    }

    /*
    //inserimento tag nel database
    $arrayTag= explode(" ", $tag); //divido la singola stringa che ricevo come input dei tag in tanti piccoli tag da inserire nel dizionario o da legare al problema
    for($i=0; i<count($arrayTag) ; $i++){
        //query di inserimento tag
        $qTag = "INSERT INTO DizionarioTag (descrizione) VALUES ('$arrayTag[$i]')";

        //query per ottenere l'id del tag appena inserito nel dizionario
        $qIdTag= "SELECT idTag FROM DizionarioTag WHERE descrizione = '$arrayTag[$i]'";

        $risIdTag= mysqli_query($conn,$qIdTag);

        if(mysqli_query($conn, $qTag) && $risIdTag){
            
            $idTag = mysqli_fetch_assoc($risIdTag);
            //query di collegamento Tag-Problema sostituire l'id problema provvisorio con la variabile $a
            $qBridge = "INSERT INTO tagBridge (idProblema, idTag) VALUES (30,'{$idTag["idTag"]}')";
            $conn->query($qBridge);
            echo("il tag è stato inserito correttamente");
        }
    
    }

*/
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Segnala</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/main.css">
</head>
<body background= "messina.jpg">
<div class="stripe">
<h1> <?php echo($b);?> </h1>
<a class="button button-default" href="http://localhost/PROblemSolver/index.html"><b>Torna alla home</b></a>
</div>
    
</body>
</html>