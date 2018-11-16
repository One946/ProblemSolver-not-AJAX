<?php
    require("config/config.php");
    require("config/db.php");
    session_start();

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
    var_dump($utenti);
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Titolo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/main.css">
</head>
<body class="parallax" >
    <div class="stripe" style="opacity:0.95;">
            <h1><?php echo $problemi["titolo"];?></h1>
            <h3 style="color: black;"><?php echo $problemi["descrizione"];?></h3>
            <p> codice segreto utente : <?php echo $utenti["secretID"];?></p>
            <p> che corrisponde all'utente <?php echo ($utenti["Nome"]." " . $utenti[ "Cognome"]);?> <br>
            <a class="btn btn-default" style="margin-left: 46%;"href="http://localhost/PROblemSolver/index.html"> Torna alla home! </a>  
    </div>

    
</body>
</html>