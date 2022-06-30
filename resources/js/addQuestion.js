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
                    <input type="text" name="Q${questionNum}forGuest" id="Q${questionNum}forGuest" class="input input-bordered w-full dark:bg-white">
                </div>
            </div>
        `;
        $('#QuestionforGuest').append(questionHTML);
    });
})