$(function(){
    $("#").on('click', function(){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: "/admin/getAddress",
            data: data,
            dataType: 'json',
        })

    })
        
    function initMap(lat, lng) {
        let latlng = new google.maps.LatLng( 34.808502, 135.639683 );//中心の緯度, 経度
        let map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,//ズームの調整
          center: latlng//上で設定した中心
        });
        var marker = new google.maps.Marker({
          position: latlng,
          map: map
        });
      }
})