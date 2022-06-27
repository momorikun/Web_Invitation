const { data } = require("jquery");

$(function(){
    let questionNum = 1;
    
    $('#addQuestion').on('keypress', function(event){
        event.preventDefault();
        if(event.code == 'Enter') {
            return $('#addQuestion').trigger('click');
        }
    })

    $('#addQuestion').on('click', function(){
        if(questionNum === 5) return;
        questionNum++;
        let questionHTML = `
            <div class="w-full mt-2">
                <div>
                    <label class="w-full">
                        <span class="label-text">Question ${questionNum}</span>
                    </label>
                    <input type="text" name="QforGuest" id="Q${questionNum}forGuest" class="input input-bordered w-full dark:bg-white">
                </div>
            </div>
        `;
        $('#QuestionforGuest').append(questionHTML);
    });

    $('#uploadQuestionButton').on('keypress', function(event){
        event.preventDefault();
        if(event.code == 'Enter') {
            return $('#uploadQuestionButton').trigger('click');
        }
    })

    $('#uploadQuestionButton').on('click', function(){
        
        for(let i = 0; i < questionNum; i++){
            let addQuestionInput = $(`input[name="QforGuest"]:eq(${i})`).val();
            
            if(addQuestionInput === '') continue;

            console.log(addQuestionInput);
            $.ajax({
                type: "POST",
                url: "/admin/upload_question",
                data: addQuestionInput, 
            })
            .then(function(){
                $(`input[name="QforGuest"]:eq(${i})`).val("");
            })
            .fail(function(){
                alert('質問投稿に失敗しました');
            })
        }
    })
})