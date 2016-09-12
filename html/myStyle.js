$(document).ready(function(){
    $('input').css({'border':'1px solid #798790', 'background': 'none'});
    $('input').focus(function(){
        $(this).css('border', '1px solid #1ab188');
    })
    $('input').blur(function(){
        $(this).css('border', '1px solid #798790');
    })
    $('input[type="submit"]').css({'background': '#1ab188', 'border':'none'});
    $('input[type="submit"]').hover(function(){
        $(this).css({'background': '#09a077', 'cursor':'pointer'});
    },(function(){
        $(this).css('background', '#1ab188');
    }))
})

