$(document).ready(function(){
  onmouseover();
  onmouseout();
  onclicks();
});

function onmouseover(){
       $("img[alt='rate']").mouseenter(function(event){
	     $(this).css('cursor','pointer');
	   });
	   
	   $(".1star").mouseenter(function(event){
		  $(this).attr("src", "img/star.png");
	   });
	   
	    $(".2star").mouseenter(function(event){
		  $(".1star").attr("src", "img/star.png");
		  $(this).attr("src", "img/star.png");
	   });
	   
	   $(".3star").mouseenter(function(event){
		  $(".1star").attr("src", "img/star.png");
		  $(".2star").attr("src", "img/star.png");
		  $(this).attr("src", "img/star.png");
	   });
	   
	   $(".4star").mouseenter(function(event){
		  $(".1star").attr("src", "img/star.png");
		  $(".2star").attr("src", "img/star.png");
		  $(".3star").attr("src", "img/star.png");
		  $(this).attr("src", "img/star.png");
	   });
	   
	   $(".5star").mouseenter(function(event){
		  $(".1star").attr("src", "img/star.png");
		  $(".2star").attr("src", "img/star.png");
		  $(".3star").attr("src", "img/star.png");
		  $(".4star").attr("src", "img/star.png");
		  $(this).attr("src", "img/star.png");
	   });
}

function onmouseout(){
	$("img[alt='rate']").mouseleave(function(event){	
		$("img[alt='rate']").each(function (event) {
		  var title = $(this).attr("title");
		  $(this).attr("src", "img/"+title+".png");
		});
	});
}

function onclicks(){
    $(".5star").click(function(event){
	  insertRating("5");
	});
	
	$(".4star").click(function(event){
	  insertRating("4");
	});
	
	$(".3star").click(function(event){
	  insertRating("3");
	});
	
	$(".2star").click(function(event){
	  insertRating("2");
	});
	
	$(".1star").click(function(event){
	  insertRating("1");
	});

}

function insertRating(rate){
    var src = $("#src").val();
	$.ajax({
	  type: "POST",
	  url: src+"&rate="+rate,
	  data: { action: "insert"}
	}).done(function( msg ) {
	   location.reload();
    });
}