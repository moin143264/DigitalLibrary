<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 100px;
            max-width: 500px;
        }
        h2 {
            color: #343a40;
            margin-bottom: 30px;
            font-weight: bold;
        }
        #card-element {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
        }
        #card-element:focus {
            box-shadow: 0 0 5px rgba(0,123,255,.5);
            outline: none;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .payment-result {
            margin-top: 20px;
            font-size: 1.1em;
            font-weight: bold;
        }
        .success {
            color: #28a745;
        }
        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Secure Payment</h2>
    <form id="payment-form" class="border p-4 bg-white rounded shadow-sm">
        <div id="card-element"></div>
        <button id="submit" class="btn btn-primary btn-block">Pay Now</button>
        <div id="payment-result" class="text-center payment-result"></div>
    </form>
</div>

<script>
    // Get client secret from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const clientSecret = urlParams.get('client_secret');
    const pdfId = urlParams.get('pdf_id');

    const stripe = Stripe('pk_test_51Q8uua07CIuzAORvOPkNphnVDvfztI3AGlwMeVXceeQZrHsnAEvF0wOzvTvqLylyZTZ1puQVzotwQOIbFABkAoRS00BR5GdjVN');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    document.getElementById('payment-form').addEventListener('submit', async (event) => {
        event.preventDefault();

        const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: cardElement,
            }
        });

        const paymentResult = document.getElementById('payment-result');
        if (error) {
            paymentResult.innerText = error.message;
            paymentResult.classList.add('error');
        } else {
            if (paymentIntent.status === 'succeeded') {
                paymentResult.innerText = "Payment succeeded!";
                paymentResult.classList.remove('error');
                paymentResult.classList.add('success');
                // Redirect to the renew page after successful payment
                window.location.href = `renew.php?pdf_id=${pdfId}`; 
            }
        }
    });
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
