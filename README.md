
# Web Invitation
Laravel自作アプリケーション

## 概要
結婚式の招待状～受付までをWebアプリケーションにしました。
ユーザーは主催者・来客の2種類準備してあります。

## 機能
管理者ユーザ：
 - 出席者名簿PDF
 - QRコードリーダ
 - LINEメッセージ送信
 - 各種投稿機能、編集機能（質問、新郎新婦エピソード、写真）<br>
 <br>
来客ユーザ：<br>
 - 出欠連絡
 - 投稿機能（質問回答、メッセージ）
 - QRコード表示
 
## テスト
管理者ユーザー：
    アドレス：test1@test.com<br>
    PW：123456789<br>
<br>
来客ユーザ：
    アドレス：test2@test.com<br>
    PW：123456789<br>
    
## 環境
XAMPP 8.0.3<br>
MariaDB 10.4.18<br>
Laravel 8.83.16<br>
ほか、外部パッケージについては下記ファイルをご確認ください。<br>
・comporser.json<br>
・package.json<br>
・tailwind.config.js<br>

## データベース
DB名：Web-Invitation<br>
テーブルなどはmigrationファイルがございますので<br>
```php artisan migrate```<br>
コマンドを実行してください。<br>
