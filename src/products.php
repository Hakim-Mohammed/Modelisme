<?php

    include 'connect-bdd.php';

    if(isset($_POST["getNewOrderItem"])){
        
        $query = $pdo -> prepare
            (
                "SELECT productCode,
                        productName
                FROM    products
                ORDER BY productCode;"
            );


        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <!-- Ajoute une nouvelle ligne de produit au tableau  -->
        <tr>
            <td><b class="number">1</b></td>
            <td><select name="productCode[]" class="form-control productCode" required>
                    <option value="">- Sélectionnez un produit -</option>
                    <?php foreach($products as $product): ?>
                        <option value="<?= $product['productCode']?>"><?= htmlspecialchars($product['productName']) ?></option>
                    <?php endforeach ?>         
                </select>
            </td>
            <td><input type="number" class="form-control stock" name="stock[]" readonly></td>
            <td><input type="number" class="form-control buyPrice" name="buyPrice[]" readonly></td>
            <td><input type="number" class="form-control quantityOrdered" name="quantityOrdered[]"></td>
            <td><input type="number" class="form-control totalItem" name="totalItem[]" readonly></td>
            <td><input type="hidden" class="form-control productName" name="productName[]" ></td>
        </tr>
        <?php
        exit();
    }

   

?>