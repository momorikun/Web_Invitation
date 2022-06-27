
const video  = document.querySelector("#camera");
const canvas = document.querySelector("#canvas");
const uuid = document.querySelector("#uuid");

const ctx = canvas.getContext("2d");

window.onload = () => {
  /** カメラ設定 */
  const constraints = {
    audio: false,
    video: {
        width: video.width,
        height: video.height,
        facingMode: "user"   // フロントカメラを利用する
    }
  };

  /**
   * カメラを<video>と同期
   */

  alert(navigator.mediaDevices);

   navigator.mediaDevices.getUserMedia(constraints)
  .then( (stream) => {
    video.srcObject = stream;
    video.onloadedmetadata = (e) => {
      video.play();

      // QRコードのチェック開始
      checkPicture();
    };
  })
  .catch( (err) => {
    console.log(err.name + ": " + err.message);
  });
};

/**
 * QRコードの読み取り
 */
function checkPicture(){
  // カメラの映像をCanvasに複写
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

  // QRコードの読み取り
  const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  const code = jsQR(imageData.data, canvas.width, canvas.height);

  //----------------------
  // 存在する場合
  //----------------------
  if( code ){
    // 結果を表示
    let showData = setQRResult("#result", code.data);  // 文字列
    let checkInData = escapeHTML(code.data);

    uuid.setAttribute('value', checkInData);//inputタグのvalue値を更新する
    drawLine(ctx, code.location);       // 見つかった箇所に線を引く
    
    $(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: "/admin/check_in",
            data: {
                checkInData: checkInData,
            }
        })
        .then(function(){
            alert('出席確認しました');
            location.reload();
        })
        .fail(function(error){
            //異常終了の際の処理
            alert('失敗しました');

        }); 
    })
    
    
  }
  //----------------------
  // 存在しない場合
  //----------------------
  else{
    // 0.3秒後にもう一度チェックする
    setTimeout( () => {
      checkPicture();
    }, 300);
  }
}


/**
 * 発見されたQRコードに線を引く
 *
 * @param {Object} ctx
 * @param {Object} pos
 * @param {Object} options
 * @return {void}
 */
function drawLine(ctx, pos, options={color:"blue", size:2}){
  // 線のスタイル設定
  ctx.strokeStyle = options.color;
  ctx.lineWidth   = options.size;

  // 線を描く
  ctx.beginPath();
  ctx.moveTo(pos.topLeftCorner.x, pos.topLeftCorner.y);         // 左上からスタート
  ctx.lineTo(pos.topRightCorner.x, pos.topRightCorner.y);       // 右上
  ctx.lineTo(pos.bottomRightCorner.x, pos.bottomRightCorner.y); // 右下
  ctx.lineTo(pos.bottomLeftCorner.x, pos.bottomLeftCorner.y);   // 左下
  ctx.lineTo(pos.topLeftCorner.x, pos.topLeftCorner.y);         // 左上に戻る
  ctx.stroke();
}

/**
 * QRコードの読み取り結果を表示する
 *
 * @param {String} id
 * @param {String} data
 * @return {void}
 */
function setQRResult(id, data){
    document.querySelector(id).innerHTML = escapeHTML(data);
}



/**
 * HTML表示用に文字列をエスケープする
 *
 * @param {string} str
 * @return {string}
 */
function escapeHTML(str){
  let result = "";
  result = str.replace("&", "&amp;");
  result = str.replace("'", "&#x27;");
  result = str.replace("`", "&#x60;");
  result = str.replace('"', "&quot;");
  result = str.replace("<", "&lt;");
  result = str.replace(">", "&gt;");
  result = str.replace(/\n/, "<br>");

  return(result);
}