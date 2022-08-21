$(function(){
    $role_flg = $('#role_flg');
    $input_for_guest = $('#inputForGuest');

    $('#role_flg').on('click', function(){
        if($input_for_guest.hasClass('hidden')){
            $input_for_guest.removeClass("hidden");
        } else {
            $input_for_guest.addClass("hidden");
        }
    })
})