<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>予約確認</title>
</head>
<body>
    <p>{{ $user->name }} 様</p>
    <p>予約が確定しました。</p>
    <p>以下のQRコードを当日ご提示ください。</p>
    <p>
        <img src="{{ $qrCodeUrl }}" alt="QR Code">
    </p>
</body>
</html>