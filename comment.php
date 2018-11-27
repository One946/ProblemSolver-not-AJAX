<?php
    require("config/config.php");
    require("config/db.php");
    $request_body = file_get_contents('php://input'); //sto passando dati tramite il body http invece che direttamente dal form pertanto devo utilizzare questa funzione per accedere al contenuto
    $data = json_decode($request_body,true); //dopo semplicemente  eseguo un decode per inserire i dati in un array il parametro true serve a far si che vengano effettivamente inseriti in un array
    //preparazione variabili per inserimento nel db

    //echo($data["commento"]);
    $commento = $data["commento"];
    $secretId = $data["secretIdUtente"];
    $idProblema = $data["idProblema"];
    if($commento === " "){
        echo"non puoi inserire un commento vuoto";
        mysqli_close($conn);
    }

    $qCom = "INSERT INTO Commenti (secretId, idProblema, descrizione, boolVisibile) VALUES ('$secretId', '$idProblema', '$commento', 1) ";
    //$QcOM="SELECT descrizione from Commenti where 1;";
    //$a = mysqli_query($conn, $qCom);
    //$ris=mysqli_fetch_assoc($a);
    //var_dump($a);
    if(mysqli_query($conn, $qCom)){
    echo"inserimento avvenuto con successo";
    }  else{
            echo'errore:'.mysqli_error($conn);
        }
?>      