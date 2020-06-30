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