<?php
    include "connect-bdd.php";

    $query = $pdo -> prepare 
        (
            "SELECT productName,
                    buyPrice,
                    quantityiInStock
            FROM    products
            WHERE   productCode = ?"
        );

    $query -> execute([$_POST["productNumber"]]);

    $dataProducts = $query->fetchAll(PDO::FETCH_ASSOC);

    //le retour doit être un JSON 
    echo json_encode($dataProducts);
    exit();
?>