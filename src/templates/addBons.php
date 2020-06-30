
<div class="container-fluid">
    <div class="titre p-2 my-2 rounded">
        <h1 class="d-flex justify-content-center"><i class="fas fa-car-side"></i>  - Bons de commande - <i class="fas fa-car-side"></i></h1>
    </div>    

    <form id="formBons" name="formBons" onsubmit="return false" >
        <div class="form-group row">   
            <label for="orderDate" class="col-sm-10 col-form-label text-right">Date de la commande :</label>
            <div class="col-sm-2">   
                <input type="text" class="form-control" id="orderDate" name="orderDate" readonly value="<?= date("d-m-yy"); ?>">
            </div>
        </div>
<h2>Informations du client:</h2>
        <div class="form-row info">
            <div class=" col-md-12">
                <label for="customerNumber">Client:</label>
                <select id="customerNumber" name="customerNumber" class="form-control" onchange="dataCustomer(this)" required>
                    <option value="">- Sélectionnez un client -</option>
                    <?php foreach($customers as $customer): ?>
                        <option value="<?= intval($customer['customerNumber'])?>"><?= htmlspecialchars($customer['customerName']) ?></>
                    <?php endforeach ?>
                </select>
            </div>
           
        
            <div class="col-md-12">
                <label for="address">Adresse :</label>   
                <input type="text" class="form-control" id="customerAddress" disabled>
            </div>
            
            <div class="col-md-12">
                <label for="phone"> Ville :</label>
                <input type="text" class="form-control w-100" id="customerCity" disabled >
            </div>
            <div class=" col-md-12">
                <label for="phone"> Pays :</label>
                <input type="text" class="form-control w-100" id="customerCountry" disabled >
            </div>
            <div class=" col-md-12">
                <label for="phone"> Téléphone :</label>
                <input type="text" class="form-control w-100" id="customerPhone" disabled >
            </div>
            
            <div class="col-md-12 align-content-center text-center"></br>
                <a href="addCustomer.php" class="btn bg-custom text-white"><i class="fas fa-user-plus text-white"></i> Ajouter un nouveau client</a>
            </div>
        </div>


        <hr>
<h2>Commande:<h2>
      

<div class="commande">
        <div class="tableau d-flex justify-content-center">
        <table id="tableProducts" class="table table-responsive ">
            <thead class="black white-text ">
                <tr>
                    <th scope="col">Produit</th>
                    <th scope="col">Description</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Montant</th>
                </tr>
            </thead>
            <tbody id="tableProductsBody" class="col-md-12">
            </tbody>
        </table>
        </div>
        <div class="text-center">
            <button type="button" class="btn bg-custom mb-5 text-white" onclick="ajouterProduitLigne()"><i class="fas fa-plus text-white"></i> Ajouter produit</button>
            <button type="button" class="btn bg-custom mb-5 text-white" onclick="supprimerProduitLigne()"><i class="fas fa-minus text-white"></i> Supprimer produit</button>
        </div>
        
        <div class="form-row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="form-group">
                    <div class="form-group row justify-content-end">   
                        <label for="total">Total : </label>
                        <div>   
                            <input type="number" class="form-control" id="total" name="total" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">   
                        <label for="tva">T.V.A ( 20% ) : </label>
                        <div>   
                            <input type="number" class="form-control" id="tva" name="tva" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">   
                        <label for="totalTtc">Total T.T.C : </label>
                        <div>   
                            <input type="number" class="form-control" id="totalTtc" name="totalTtc" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 d-flex justify-content-center">
                <div class="form-group">
                    <label for="comments">Commentaires :</label>
                    <textarea class="form-control" id="comments" name="comments" rows="5"></textarea>
                </div>
        </div>

        <div class="text-center">
            <button type="submit" id="saveOrder" class="btn bg-custom mb-5 align-content-end text-white" onclick="commande()"><i class="far fa-save text-white"></i> Sauvegarder</button>
            <button type="reset" class="btn bg-custom mb-5  align-content-end text-white"><i class="fas fa-undo text-white"></i> Reinitializer</button>
        </div>
</div>        
    </form>
        <div class="modal" id="reponseModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Votre commande a bien été enregistrée. Merci.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
                </div>
            </div>
        </div>
</div>
</div>
<script src="js/addbons.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
