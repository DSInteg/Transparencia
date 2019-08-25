$(document).ready( function(){ // Document Ready

  $(".clearfix").click( function (){
  console.log("algo");
  // Button View GRID/LIST
if ( $(this).attr('aria-expanded')==='false' ) {
      $(this).attr('aria-expanded','true');
      $(this).attr('aria-selected','true');
      $(this).removeClass("ui-corner-all");
      $(this).addClass("ui-according-header-active");
      $(this).addClass("ui-state-active");
      $(this).addClass("ui-corner-top");
      $(this).next("div").addClass("ui-accordion-content-active")
      $(this).next("div").attr('aria-hiden','false');
      $(this).next("div").css("display","block");
   } else {
      $(this).attr('aria-expanded','false');
      $(this).attr('aria-selected','false');
      $(this).addClass("ui-corner-all");
      $(this).removeClass("ui-according-header-active");
      $(this).removeClass("ui-state-active");
      $(this).removeClass("ui-corner-top");
      $(this).next("div").removeClass("ui-accordion-content-active")
      $(this).next("div").attr('aria-hiden','true');
      $(this).next("div").css("display","none");      
   }
  });

});