<?php
    include "connect-bdd.php";

    $query = $pdo -> prepare 
        (
            "SELECT addressLine1, 
                    addressLine2,  
                    city,  
                    country,
                    phone
             FROM customers
             WHERE customerNumber = ?"
        );

    $query -> execute([$_POST["customerNumber"]]);

    $dataCustomer = $query->fetchAll(PDO::FETCH_ASSOC);

    //le retour doit être un JSON 
    echo json_encode($dataCustomer);

?>