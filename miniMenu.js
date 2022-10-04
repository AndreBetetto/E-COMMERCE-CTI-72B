$(document).ready(function() 
{
    var botao = $('.btn1');
    var dropDown = $('.menu-menu');    
   
    botao.on('click', function(event)
    {
        dropDown.stop(true,true).slideToggle();
        event.stopPropagation();
    });
});