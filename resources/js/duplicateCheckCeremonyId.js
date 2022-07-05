$(function(){
    $('#registerForm').on('submit', function(event){
        if($('#user_categories_id').prop('checked')){
            const ceremonies_id_value = $('#ceremonies_id').val();
            const notice = "この挙式IDは既に使われています。"+"\n"+"同じ挙式IDで作成できる主催者アカウントは1つのみです。";
            
            $.ajaxSetup({
                headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                type: "POST",
                data: {
                    ceremonies_id: ceremonies_id_value,
                },
                url: "/duplicate-check",
            })
            .then(function(res){
                if(res) {
                    
                } else {
                    alert(notice);
                    event.preventDefault();
                } 
            })
        };
        
    });
})