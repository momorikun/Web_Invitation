$(function(){
    //削除モード切り替え
    $('.delete-mode-toggle-btn').on('click', function(){
        if($(this).hasClass('mode-active')){
            $(this).removeClass('mode-active btn-active btn-ghos').addClass('btn-outline');
            $(this).addClass('btn-outline');
            $(this).text('削除機能を使う');
        } else {
            $(this).removeClass('btn-outline');
            $(this).addClass('mode-active btn-active btn-ghos');
            $(this).text('削除機能をやめる');
        }
    })

    //チェックボックスの出現制御
    
    
    //チェックを入れる
    $('.delete_target').each(function(){
        $(this).on('click', function(){
            if($(this).hasClass('checked-target')){
                $(this).removeClass('checked-target');
            } else {
                $(this).addClass('checked-target');
            }
        })
    });
})