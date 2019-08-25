$(document).ready( function(){ // Document Ready

  $(".article").click( function (){
      var article = $(this).data("article");
      $(".article").removeClass("article-active");
      $(this).addClass("article-active");

      //Show article description

      $(".description").addClass("noDisplay");
      $("#description-"+article).removeClass("noDisplay");
      $(".list-container-63").addClass("noDisplay");
      $(".list-container-64").addClass("noDisplay");
      $(".list-container-tesoreria").addClass("noDisplay");
      $(".list-container-"+article).removeClass("noDisplay");
  });

  $(".list-fraction").click( function(e){
    e.stopPropagation();
    if ( $(this).hasClass("show-list") ) {
      $(this).removeClass("show-list");
      $(this).css("overflow-y", "hidden");
      console.log("algo");
    } else {
      $(".list-fraction").removeClass("show-list");
      $(this).addClass("show-list");
      $(this).css("overflow-y", "scroll");
    }
  });
});
