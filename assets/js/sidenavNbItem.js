//Javascript contenant le code pour afficher le nombre d'articles dans le Panier, et pour ajouter des produits sur la page des produits.
//On peut ainsi facilement ajouter une fonction d'ajout de produit sur la page "home"

function updateBasket(result){
  $("#basketNbItem").html("Vous avez "+result+" articles dans votre panier");
}

function updateBasketAJAX(){
  $.ajax({url: "/nbItem",type:'GET', async: true, success: function(result){
              updateBasket(result);
          }});
}

$(document).ready(function(){
updateBasketAJAX();
$("#addButton").click(function(){

  var quantity=$("#addInput").val();

  $.ajax({
     url : addurl,
     type : 'POST',
     data : 'quantity=' + quantity,
     success : function(result){
       updateBasket(result);
     }
    });

});

})
