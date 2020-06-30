
<div class="container-fluid">
    <div class="titre p-2 my-2 rounded">
        <h1  class="d-flex justify-content-center"><i class="fas fa-archive"></i> - Liste des bons de commande - <i class="fas fa-archive"></i></h1>
    </div>    
    <input class="form-control mb-4" id="tableSearch" type="int"
    placeholder="Taper le numéro de bon de commande recherché">
    <table id="listeCommandes" class="table table-responsive-lg table-striped table-bordered table-sm" cellspacing="0">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Commande</th>
            <th scope="col">Date de la commande</th>
            <th scope="col">Date de livraison</th>
            <th scope="col">Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order): ?>
                <tr>
                    <td scope=row> <a href="order-form.php?orderNumber=<?= $order['orderNumber'] ?>"><?= $order['orderNumber'] ?></a></td>
                    <td><?= $order['orderDate'] ?></td>
                    <td><?= $order['shippedDate'] ?></td>
                    <td><?= $order['status'] ?></td>
                </tr>
            <?php endforeach ?>    
        </tbody>
    </table>

</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
