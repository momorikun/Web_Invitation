const { post } = require("jquery");

$(function(){
    //削除モード切り替え
    $('.delete-mode-toggle-btn').on('click', function(){
        if($(this).hasClass('mode-active')){
            //モード解除
            $(this).removeClass('mode-active btn-active btn-ghos');
            $(this).addClass('btn-outline');
            $('.delete_target').addClass('hidden');
            $(this).text('削除機能を使う');
            $('.delete_target').text(''); //削除モードをやめる際に✓マークを残さない（残す設定はこの１行をコメントアウト）
            $('#delete-btn').addClass('hidden');
        } else {
            //モード設定
            $(this).removeClass('btn-outline');
            $(this).addClass('mode-active btn-active btn-ghos');
            $('.delete_target').removeClass('hidden');
            $(this).text('削除機能をやめる');
            $('#delete-btn').removeClass('hidden');
        }
    })

    //チェックを入れる
    $('.delete_target').each(function(){
        $(this).on('click', function(){
            if($(this).text() === '✓'){
                $(this).text('');
                $(this).removeClass('plan-to-delete');
            } else {
                $(this).text('✓');
                $(this).addClass('plan-to-delete');
            }
        })
    });

    //削除ボタンを押す
    $('#delete-btn').on('click', function(){
        
        //✓が入った要素(.plan-to-delete)のsrcを集める
        const delete_target_img = [];
        let data = {};
        $(".plan-to-delete").next().each(function(index, element){
            delete_target_img.push(element.attributes.src.value);
        });
        
        delete_target_img.forEach(function(element){
            
            element = element.replace('http://127.0.0.1:8000/storage/', ''); //TODO:URL書き換え
            
            data = {
                photo_path: element,
            };
            
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                url: "/guest/delete_photos",
                type: "POST",
                data: data,
            })
            .then(function(){
                alert('ok');
            })
            .fail(function(){
                alert('fail');
            });
        })
        
        
    })   
})
