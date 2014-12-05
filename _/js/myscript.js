$(function(){
    $("#home a:contains('Here')").parent().addClass("active"),
    $("#search a:contains('Search')").parent().addClass("active"),
    $("#faq a:contains('FAQ')").parent().addClass("active"),
    $("#about a:contains('About')").parent().addClass("active")});
    
/* Carousel */    
$(document).ready(function(){
    /* Automatically rotates the carousel */
    $('.carousel').carousel({
      interval: 3000
    })

    /* Navigation control on the carousel */
    $('.carousel-control.left').click(function() {
      $('.carousel').carousel('prev');
    });

    $('.carousel-control.right').click(function() {
      $('.carousel').carousel('next');
    });
});  
  
/* Form Options */
$('.collapse').collapse();

/* Tab Bar JS */
$('#myTab a').click(function(e) {
    e.preventDefault()
    $(this).tab('show')
});

