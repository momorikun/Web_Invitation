$(function(){

    //現在日時
    let time = new Date();
    let year = time.getFullYear();
    let month = time.getMonth() + 1;
    let day = time.getDate();
    
    /**
     * うるう年チェック
     * @param integer year 
     * @return boolean
     */
    function leapYearCheck(year){
        if((Math.floor(year % 4 == 0)) && (Math.floor(year % 100 != 0)) || (Math.floor(year % 400 == 0))){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 30日のみの月チェック
     * @param integer month
     * @return boolean
     */
    function thirty_days_month_check(month){
        const thirty_days_month = [4, 6, 9, 11];
        if(thirty_days_month.includes(Number(month))){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 2月チェック
     * @param integer month
     * @return boolean
     */
    function isFebruary(month){
        return month == 2 ? true :  false;
    }

    /**
     * 月の最終日を返す
     * @params integer, integer (year, month)
     * @return integer end_day
     */
    function get_end_day_in_the_month(year, month){
        let end_day = 31;
        if(leapYearCheck(year)){
            //うるう年条件
            if(isFebruary(month)) {
                return end_day = 29;
            } else if ( thirty_days_month_check(month) ){
                //30日ある月
                return end_day = 30;
            } else {
                //31日ある月
                return end_day;
            }
        } else {
            //うるう年以外の条件
            if(isFebruary($ceremonies_dates_month)) {
                return end_day = 28;
            } else if ( thirty_days_month_check($ceremonies_dates_month) ){
                //30日ある月
                return end_day = 30;
            } else {
                //31日ある月
                return end_day;
            }
        }
    }

    //画面ロード時のセレクトボックス設定
    for (let year_op = year; year_op <= year + 10; year_op++){
        $('#ceremonies_dates_year').append('<option value="' + year_op + '">' + year_op + '</option>');
    }

    for (let month_op = month; month_op <= 12; month_op++){
        $('#ceremonies_dates_month').append('<option value="' + month_op + '">' + month_op + '</option>');
    }

    $ceremonies_dates_year = $('#ceremonies_dates_year').val();
    $ceremonies_dates_month = $('#ceremonies_dates_month').val();

    end_day = get_end_day_in_the_month($ceremonies_dates_year, $ceremonies_dates_month);

    for (let day_op = day; day_op <= end_day; day_op++) {
        $('#ceremonies_dates_day').append('<option value="' + day_op + '">' + day_op + '</option>');
    }


    //年変更で月のSELECT BOXを変更
    
    $('#ceremonies_dates_year').on('change', function(){
        $('#ceremonies_dates_month').children('option').remove();

        $ceremonies_dates_year = $('#ceremonies_dates_year').val();
        let end_month = 12;
        
        if($ceremonies_dates_year == year){
            for(let start_month = month; start_month <= end_month; start_month++){
                $('#ceremonies_dates_month').append('<option value="' + start_month + '">' + start_month + '</option>');
            }
        } else {
            for(let start_month = 1; start_month <= end_month; start_month++){
                $('#ceremonies_dates_month').append('<option value="' + start_month + '">' + start_month + '</option>');
            }
        }
    });

    //年または月変更時に日付変更
    $('#ceremonies_dates_year, #ceremonies_dates_month').on('change', function(){
        $('#ceremonies_dates_day').children('option').remove();

        $ceremonies_dates_year = $('#ceremonies_dates_year').val();
        $ceremonies_dates_month = $('#ceremonies_dates_month').val();
        
        if($ceremonies_dates_year == year && $ceremonies_dates_month == month){
            //今月の条件
            end_day = get_end_day_in_the_month($ceremonies_dates_year, $ceremonies_dates_month)
            for (let start_day = day; start_day <= end_day; start_day++) {
                $('#ceremonies_dates_day').append('<option value="' + start_day + '">' + start_day + '</option>');
            }
        } else {
            //今月以外の条件
            end_day = get_end_day_in_the_month($ceremonies_dates_year, $ceremonies_dates_month);
            for (let start_day = 1; start_day <= end_day; start_day++) {
                $('#ceremonies_dates_day').append('<option value="' + start_day + '">' + start_day + '</option>');
            }
        }       
    });
});