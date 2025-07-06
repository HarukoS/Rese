<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <title>Stripeテスト決済</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Stripe決済（Payment Intents + 3DS対応）</h2>

    <!-- メッセージ表示用 -->
    <div id="payment-message" class="alert" style="display:none;"></div>

    <!-- カードフォーム -->
    <form id="payment-form">
        @csrf
        <div class="mb-3">
            <label>カード情報</label>
            <div id="card-element" style="border: 1px solid #ccc; padding: 10px;"></div>
        </div>
        <div id="card-errors" class="text-danger mb-3"></div>
        <button id="submit-button" class="btn btn-primary">支払う</button>
    </form>

    <div class="back__button">
        <a href="{{ url()->previous() }}" class="btn btn-secondary" style="margin-top: 10px">戻る</a>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    const paymentMessage = document.getElementById('payment-message');
    const errorElement = document.getElementById('card-errors');
    const submitButton = document.getElementById('submit-button');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        submitButton.disabled = true;

        try {
            const response = await fetch("{{ route('payment.intent') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({})
            });

            const data = await response.json();
            const clientSecret = data.clientSecret;

            const {paymentIntent, error} = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                }
            });

            if (error) {
                errorElement.textContent = error.message;
                submitButton.disabled = false;
            } else {
                if (paymentIntent.status === 'succeeded') {
                    paymentMessage.classList.add('alert-success');
                    paymentMessage.textContent = '支払いが成功しました！';
                    paymentMessage.style.display = 'block';
                }
            }

        } catch (error) {
            console.error(error);
            errorElement.textContent = '決済処理でエラーが発生しました。';
            submitButton.disabled = false;
        }
    });
</script>
</body>
</html>