<?php //BACHECA VISUALIZZAZIONE PROBLEMI
    require("config/db.php");
    require("config/config.php");
    session_start();

    $query1 = "SELECT * FROM Problemi";

    
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
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cerulean/bootstrap.min.css"> <!--bootstrap utilizzato per rendere più gradevole la  visualizzazione dei problemi-->
    <!--CSS UTILIZZATI PER LA NAVBAR E MENU' A SCORRIMENTO-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/PROblemSolver/css/main.css">
</head>
<body class="parallax" >     
<div class="container">

        <a class="btn btn-default stripe" href="http://localhost/PROblemSolver/index.php"> <b>Torna alla home! </b></a>
        <h1> BACHECA PROBLEMI</h1> 

   <!-- faccio un ciclo per mostrare tutti i problemi-->
    <?php foreach($prob as $titoli) : ?>

        <div class="well" style="opacity:0.9; background: #f4f4f4;">
            <h3><?php echo $titoli["titolo"];?></h3>
            <p> <?php echo $titoli["descrizione"];?></p>
            <a class="btn btn-default" href="<?php echo ROOT_URL;?>problema.php?id=<?php echo $titoli["idProblema"]; ?>"><b>Per saperne di più</b></a>
            <a class="btn btn-default" href="http://localhost/PROblemSolver/index.php"> <b>Torna alla home! </b></a>
            <hr>
        </div>
    <?php endforeach;?>



</div>


    
</body>
</html>