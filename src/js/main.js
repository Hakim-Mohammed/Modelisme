$(document).ready(function () {
    ajouterProduitLigne();  
   
});


// fonction pour quand on saissie le nom de la société toutes les données de la bdd remplisse le champs approprier automatiquement 
function dataCustomer(client) {
    let idClient = parseInt(client.value);  //mettre en nombre 
    console.log(idClient);
    $.ajax({ 
        method: "POST",
        url: "dataCustomer.php", //Chemin d'accès du script php
        data: {customerNumber : idClient} , //variables à envoyer 
        dataType: "json", //format
        success: function(reponse){ //Si tout se déroule bien on traite le retour
            console.log(reponse);  
            var address = reponse[0].addressLine1 + ' ' + reponse[0].addressLine2;   //creer une variable pour chaque ligne du formulaire client existant dans la bdd
            console.log(address);
            var city = reponse[0].city;
            console.log(city);
            var country = reponse[0].country;
            console.log(country);
            var phone = reponse[0].phone;
            console.log(phone);
           

            //remplir le formulaire avec les valeurs récupérées de la bdd
            $('#customerAddress').val(address);
            $('#customerCity').val(city);  
            $('#customerCountry').val(country);   
            $('#customerPhone').val(phone);       
        },
        error: function(jqXHR, textStatus, errorThrown) { //si il y a une erreur  
            console.log(textStatus, errorThrown);
        }
    });
}

// fonction pour quand on saissie le produit toutes les données de la bdd remplisse  le nom la quantité en stock et le prix unitaire
$("#tableProductsBody").delegate(".productCode","change",function(){
    console.log($(this));
    let idProduct = $(this).val();
    let tr = $(this).parent().parent();  // variable pour associer le produit a son parent
    console.log(idProduct);
    $.ajax({
        method: "POST",
        url: "dataProduct.php", //Chemin d'accès du script php
        data: {productNumber : idProduct} , //variables à envoyer 
        dataType: "json", //format
        success: function(reponse){ //Si tout se déroule bien on traite le retour
            console.log(reponse);
            var name = reponse[0].productName; // creer une variable pour chaque colone preenregistrer du bon de commande selon l'article choisie 
            console.log(name);
            var price = reponse[0].buyPrice;
            console.log(price);
            var stock = reponse[0].quantityInStock;
            console.log(stock);
           

            //remplir le formulaire avec les valeurs récupérées
            tr.find('.productName').val(name);
            tr.find('.buyPrice').val(price);  
            tr.find('.stock').val(stock); 
            tr.find('.quantityOrdered').val(1);
            tr.find('.totalItem').val(price);
            calculs();
        },
        error: function(jqXHR, textStatus, errorThrown) { //si il y a une erreur 
            console.log(textStatus, errorThrown);
        }
    })
})
    

// fonction pour calculer le montant total d'un produit (quantite * prix)
$("#tableProductsBody").delegate(".quantityOrdered","change",function(){
    let quantite = $(this);
    console.log(quantite);
    let tr= $(this).parent().parent();
    let stock = tr.find('.stock').val()-0;
// creation de la boucle pour verifier la quantité choisie par rapport au stock     
    if (quantite.val() <= 0) {
        alert("Inserez un nombre superieur à 0");
        quantite.val(1);
    }   else if ((quantite.val()-0) > stock) {
        alert("Quantité superieur à la disponibilité du produit, rectifiquez s'il vous plaît");
        quantite.val(1);
    }   else {
        console.log("quantite "+ quantite.val());
        console.log("prix "+tr.find(".buyPrice").val());
        console.log(quantite.val() * tr.find(".buyPrice").val());
        tr.find(".totalItem").val((quantite.val() * tr.find(".buyPrice").val()).toFixed(2));
        calculs();
    }
})


// fonction pour ajouter des lignes de commandes au formulaire en autoacremention des lignes de commande
function ajouterProduitLigne() {
    $.ajax({
        url : "products.php",
        method : "POST",
        data : {getNewOrderItem:1},
        success : function(data){
            $("#tableProductsBody").append(data);
            var n = 0;
            $(".number").each(function(){
                $(this).html(++n);
            })
        }
    })
}


// fonction pour supprimer une ligne de commande saissie en trop 
function supprimerProduitLigne() {
    $("#tableProductsBody").children("tr:last").remove();
    calculs();
}

// fonction pour le prix en ht +TVA + le prix TTC du formulaire de commande 
function calculs() {
    let total = 0;
    $(".totalItem").each(function() {
        total = total + ($(this).val()*1);
    })
    $("#total").val(total);
    let tva = (total * 0.20).toFixed(2);
    $("#tva").val(tva);
    let totalTtc = (total + parseInt(tva)).toFixed(2);
    $("#totalTtc").val(totalTtc);
}

// addbons.js obliger de le mettre a part pour que la commande ce fasse !!!!
// fonction pour que la commande se valide et s'enregistre dans la BDD avec un boucle qui oblige la saissie de tous les champs 
function commande() {    
    if ($("#customerNumber").val() === "") {
        alert("Saisissez un client");
    } else if ($("#total").val() === "") {
        alert("Saisissez un produit");
    } else {
        $.ajax({
            url: "addBons.php",
            method: "POST",
            data: $("#formBons").serialize(),
            success: function(data){
                $('#reponseModal').modal('toggle');
                $("#formBons").trigger("reset");
            }
        })
    }    
} 