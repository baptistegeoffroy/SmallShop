


function generate_Products(){
  var data_description=["a","b","c","d","e","f","g","h","i","j","k","l"];

  var line_max=3;
  var line_count=0;
  var i=0;

  for(var x = 0; x < 4 ; x++) {
    var html_row = $("<div class='row'> </div>");
    html_row.appendTo('#cont_products');
        for(var y = 0; y < 3; y++) {
          var html_column=$("<div class='col-md-4' </div>");
          html_column.appendTo(html_row);

          var html_card_main=$("<div class='card mb-4 box-shadow'> </div>");
          html_card_main.appendTo(html_column);

          var html_card_body=$("<div class='card-body'></div>");
          html_card_body.appendTo(html_card_main);

          var html_card_title=$("<h5 class='card-title'>Keyboard</h5>");
          html_card_title.appendTo(html_card_body);

          var html_card_text=$("<p class='card-text'></p>");
          html_card_text.text(data_description[x*3+y]);
          html_card_text.appendTo(html_card_body);

          var html_card_bottom=$("<div class='d-flex justify-content-between align-items-center'></div>");
          html_card_bottom.appendTo(html_card_body);


        }
    }

}
$(document).ready(function(){
generate_Products();

})
