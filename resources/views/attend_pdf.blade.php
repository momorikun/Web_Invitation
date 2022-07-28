<html lang="ja">
    <head>
        <title>Wedding-Invitation | 出席予定者名簿</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            @font-face{
                font-family: migmix;
                font-style: normal;
                font-weight: normal;
                src: url("{{ storage_path('fonts/migmix-2p-regular.ttf')}}") format('truetype');
            }
            @font-face{
                font-family: migmix;
                font-style: bold;
                font-weight: bold;
                src: url("{{ storage_path('fonts/migmix-2p-bold.ttf')}}") format('truetype');
            }
            body {
                font-family: migmix;
                line-height: 80%;
            }
            .attend-table {
                border: 1px solid #000;
                border-collapse: collapse;
                width: 100%;
            }
            .attend-table tr th{
                background: #cbd5e0;
                padding: 5px;
                border: 1px solid #000;
            }
            .attend-table tr td{
                padding: 5px;
                border: 1px solid #000;
            }
            .money-gift {
                width: 10rem;
            }
            .width-rem {
                width: 3rem
            }
            .remarks {
                width: 25rem;
            }
        </style>
    </head>
    <body>
        <div>            
            <table class="table-auto text-center attend-table">
                <thead>
                <tr class="w-full">
                    <th class="px-4 py-2">出席済</th>
                    <th class="px-4 py-2">名前</th>
                    <th class="px-4 py-2">メールアドレス</th>
                    <th class="px-4 py-2 money-gift">ご祝儀</th>
                    <th class="px-4 py-2 remarks">備考</th>
                </tr>
                </thead>
                <tbody>
                @foreach($guests as $guest)
                    <tr>
                        <td class="border px-4 py-2">
                            @if ($guest->is_attended)
                                出席済み
                            @else
                                -
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{$guest->name}}</td>
                        <td class="border px-4 py-2">{{$guest->email}}</td>
                        <td class="border px-4 py-2">
                            ￥
                            @if($guest->gift_money)
                                {{ $guest->gift_money }}
                            @endif
                            
                        </td>
                        <td class="border px-4 py-2">
                            @if ($guest->remarks)
                                {{ $guest->remarks }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>