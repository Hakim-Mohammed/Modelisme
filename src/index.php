<?php

include 'connect-bdd.php';
/*
 * Préparation de la requête SQL, PDO renvoie un objet de la classe PDOStatement
 * http://www.php.net/manual/fr/class.pdostatement.php
 *
 * On peut dire que cet objet représente la requête SQL, on appelle donc la
 * variable $query.
 */
$query = $pdo->prepare
(
    'SELECT
        orderNumber,
        orderDate,
        shippedDate,
        status
     FROM orders
     ORDER BY orderDate'
);

// Demande à PDO d'envoyer la requête à MySQL pour exécution.
$query->execute();

/*
 * Récupération de toutes les données renvoyées par MySQL.
 *
 * La méthode fetchAll() renvoie un tableau à deux dimensions :
 * - la première dimension représente les différentes lignes de données
 * - la deuxième dimension représente les colonnes SQL de chaque ligne de données
 */
$orders = $query->fetchAll(PDO::FETCH_ASSOC);


$template = "templates/index";
include 'layout.php';
?>