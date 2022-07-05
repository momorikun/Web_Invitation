$(function(){
    $('.modal_pop').hide();

    $('.show_pop').each(function(){
        $(this).on('click',function(){
            if($('.delete-mode-toggle-btn').hasClass('mode-active')) return;
            $(this).next('.modal_pop').fadeIn();
        })
    });
    $('.js-modal-close').each(function(){
        $(this).on('click',function(){
            $(this).parent().fadeOut();
        })
    })
    $('.js-modal-close-img').each(function(){
        $(this).on('click',function(){
            $(this).parent().parent().fadeOut();
        })
    })
})