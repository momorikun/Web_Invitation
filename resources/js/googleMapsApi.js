$(function(){
  /**
   * Googleマップのインスタンス化 
   */
  function initMap(lat, lng) {
    let latlng = new google.maps.LatLng( lat, lng );//中心の緯度, 経度
    let map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,//ズームの調整
      center: latlng//上で設定した中心
    });
    let marker = new google.maps.Marker({
      position: latlng,
      map: map
    });
  }

  const address = $('#venue_address').val();
  const data = {
    appid: process.env.MIX_YAHOO_API_CLIENT_ID,
    query: address,
  }

  $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        'Access-Control-Allow-Origin': '*',
    },
  });
  $.ajax({
    type: "GET",
    url: "https://map.yahooapis.jp/geocode/V1/geoCoder?output=json",
    data: data,
    dataType: "jsonp",
  })
  .then(function($result){
    const Coordinates = $result.Feature[0].Geometry.Coordinates;
    const geo = Coordinates.split(',');
    const lng = geo[0];
    const lat = geo[1];
    initMap(lat, lng);
  })
  .fail(function(error){
    alert('予期せぬエラーが起こりました');
    console.log(error);
  })

      
  
})