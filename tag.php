<?php
    require("config/db.php");
    if (isset($_REQUEST)){
}

    $tag = $_REQUEST["tag"];

    //inserimento tag nel database
    $arrayTag= explode(" ", $tag); //divido la singola stringa che ricevo come input dei tag in tanti piccoli tag da inserire nel dizionario o da legare al problema
  
       foreach ($arrayTag as $arrayTag){
            //query di inserimento tag
            $qTag = "INSERT INTO DizionarioTag (descrizione) VALUES ('$arrayTag')";
            $exqTag=mysqli_query($conn,$qTag);
//           devo verificare che la query è andata a buon fine?
    
            //query per ottenere l'id del tag appena inserito nel dizionario
            $qIdTag= "SELECT idTag FROM DizionarioTag WHERE descrizione = '$arrayTag'";
            $risIdTag= mysqli_query($conn,$qIdTag);
            $idTag = mysqli_fetch_assoc($risIdTag);
            $valId = $idTag['idTag'];
            echo($valId);
            if($valId){
                
                
                //query di collegamento Tag-Problema sostituire l'id problema provvisorio con la variabile $a
                $qBridge = "INSERT INTO tagBridge (idProblema, idTag) VALUES (30,'$valId')";
                echo($conn->query($qBridge)); //PDO
                if($conn->query($qBridge)){
                    
                    $b="il tag è stato inserito correttamente";
                    echo($b);
                }else{ echo 'errore!';}
       }
        
        } 
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
<a class="button button-default" href="http://localhost/PROblemSolver/index.php">Torna alla home</a>
</div>
    
</body>
</html>