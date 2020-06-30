<?php

    include 'connect-bdd.php';
    // si le formulaire n'a pas été rempli fait la recherche des employers
    if(empty($_POST)){
        $query = $pdo -> prepare
            (
                "SELECT employeeNumber, 
                        firstName,
                        lastName
                 FROM   employees
                 ORDER BY  firstName;"
            );


        $query->execute();

        
        $employees = $query->fetchAll(PDO::FETCH_ASSOC);
        
        //aller au formulaire d'enregistrement de clients
        $template = "templates/addCustomer";
        include 'layout.php'; 
    } // si le formulaire a été rempli fait l'enregistrement du client
    else {
        $query = $pdo -> prepare
        (
            "INSERT INTO customers (customerName, contactLastname, contactFirstName,
                                    phone, addressLine1, addressLine2, 
                                    city, state, postalCode, 
                                    country, salesRepEmployeeNumber, creditLimit)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?);"            
        );


        $query->execute([htmlspecialchars($_POST["customerName"]), htmlspecialchars($_POST["contactLastName"]), 
                        htmlspecialchars($_POST["contactFirstName"]), htmlspecialchars($_POST["phone"]), 
                        htmlspecialchars($_POST["address1"]), htmlspecialchars($_POST["address2"]), 
                        htmlspecialchars($_POST["city"]), htmlspecialchars($_POST["state"]), 
                        htmlspecialchars($_POST["postalCode"]), htmlspecialchars($_POST["country"]), 
                        $_POST["employee"], $_POST["creditLimit"]]);
                        
        //retourner au formulaire de bons de commande
        header('Location: addBons.php');
        exit(); 
    }


?>