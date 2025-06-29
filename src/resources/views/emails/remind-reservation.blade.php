<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>予約リマインドメール</title>
</head>
<body>
    <h2>予約リマインダー</h2>

    <p>{{ $reservation->user->name }} 様</p>

    <p>こんにちは！</p>
    <p>以下の予約について、リマインドのご連絡です。</p>

    <ul>
        <li>店舗名：{{ $reservation->shop->shop_name }}</li>
        <li>予約日：{{ \Carbon\Carbon::parse($reservation->date)->format('Y年m月d日') }}</li>
        <li>予約時間：{{ \Carbon\Carbon::parse($reservation->time)->format('H時i分') }}</li>
        <li>予約人数：{{ $reservation->number }} 名様</li>
    </ul>

    <p>ご来店を心よりお待ちしております。</p>

    <p>────────────</p>
    <p>Rese</p>
</body>
</html>