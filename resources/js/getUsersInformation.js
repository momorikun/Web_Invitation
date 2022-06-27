$(function(){
    
    //inputタグ選択時にEnterキーを押された際にボタンクリックイベントを発火させる
    $('#guestSearchInputKana').on('keypress', function(event){
        event.preventDefault();
        if(event.code == 'Enter') {
            return $('#guestSearchButton').trigger('click');
        }
    });
    
    $('#guestSearchButton').on('click', function(){
        $('.addSection').remove();
        let kana = $('#guestSearchInputKana').val();
        let id = $('#guestSearchCeremonyId').val();    
        let data = {
            id: id,
            kana: kana,
        };

        if(data.kana == '') {
            alert('ゲスト名を入力してください。');
            return false;
        }

        // FIXME: クリックイベントでCSRF対策が発火するため更新作業もajaxを用いる必要がある
        $.ajaxSetup({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
          });
        $.ajax({
            type: "POST",
            url: "/admin/getGuest",
            data: data,
            dataType: 'json',
        })
        .then(function(res){
            console.log(res);
            let html = '';
            
            $.each(res, function(index, value){
                
                let receivedCeremonyId = value.ceremonies_id;
                let receivedName = value.name;
                let receivedKana = value.kana;
                let receivedEmail = value.email;
                let receivedGiftMoney = value.gift_money;
                let receivedRemarks = value.remarks;
                

                if(receivedGiftMoney == null) receivedGiftMoney = '';
                if(receivedRemarks == null) receivedRemarks = '';

                html = `
                <form id="updateUser${index}" class="mt-5 addSection"> 
                    <div class="grid grid-cols-2 md:grid-cols-4 w-full justify-center mx-auto">
                        <input id="updateId" type="hidden" value="${receivedCeremonyId}">
                        <div class="form-control w-full max-w-xs">
                            <label for="receivedGuestName" class="label">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text" class="input input-bordered receivedData dark:bg-white" id="receivedGuestName" name="receivedGuestName" value="${receivedName}">
                        </div>
                        <div class="form-control w-full max-w-xs px-1">
                            <label for="receivedGuestKana" class="label">
                                <span class="label-text">Kana</span>
                            </label>
                            <input type="text" class="input input-bordered receivedData dark:bg-white" id="receivedGuestKana" name="receivedGuestKana" value="${receivedKana}">
                        </div>
                        <div class="form-control w-full max-w-xs px-1">
                            <label for="receivedGuestEmail" class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="email" class="input input-bordered receivedData dark:bg-white" id="receivedGuestEmail" name="receivedGuestEmail" value="${receivedEmail}" readonly>
                        </div>
                        <div class="form-control w-full max-w-xs">
                            <label for="receivedGiftMoney" class="label">
                                <span class="label-text">Gift Money</span>
                            </label>
                            <input type="text" class="input input-bordered receivedData dark:bg-white" id="receivedGuestGiftMoney" name="receivedGiftMoney" value="${receivedGiftMoney}">
                        </div>
                        <div class="form-control w-full max-w-xs px-1">
                            <label for="receivedGuestRemarks" class="label">
                                <span class="label-text">Remarks</span>
                            </label>
                            <input type="text" class="input input-bordered receivedData dark:bg-white" id="receivedGuestRemarks" name="receivedGuestRemarks value="${receivedRemarks}">
                        </div>
                    </div> 
                    <div class="w-full flex justify-end mt-5">
                        <button type="button" class="btn btn-active btn-ghos" id="updateGuestUser">更新</button>
                    </div>               
                </form>
                `;
                $('#planToAttendedUserSection').append(html);              
            });

            //inputタグ選択時にEnterキーを押された際にボタンクリックイベントを発火させる
            $('.receivedData').on('keypress', function(event){
                event.preventDefault();
                if(event.code == 'Enter') {
                    return $('#updateGuestUser').trigger('click');
                }
            });

            //生成されたFormの非同期通信処理
            $('#updateGuestUser').on('click', function(){
                let updateId = $('#updateId').val();
                let updateName = $('#receivedGuestName').val();
                let updateKana = $('#receivedGuestKana').val();
                let updateEmail = $('#receivedGuestEmail').val();
                let updateGiftMoney = Number($('#receivedGuestGiftMoney').val());
                let updateRemarks = $('#receivedGuestRemarks').val();

                let updateData = {
                    updateId: updateId,
                    updateName: updateName,
                    updateKana: updateKana,
                    updateEmail: updateEmail,
                    updateGiftMoney: updateGiftMoney,
                    updateRemarks: updateRemarks,
                };
                
                // FIXME: クリックイベントでCSRF対策が発火するため更新作業もajaxを用いる必要がある
                $.ajaxSetup({
                    headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                $.ajax({
                    type: "POST",
                    url: "/admin/updateGuest",
                    data: updateData,
                })
                .then(function(){
                    alert('更新しました');                  
                })
                .fail((error)=>{
                    //異常終了の際の処理
                    alert('更新に失敗しました');
                    console.log(error);
                });                 
            
    })         
            
        })
        .fail((error)=>{
            //異常終了の際の処理
            console.log(error.message);
            alert('検索できませんでした。');
        })

    })


    
        

})