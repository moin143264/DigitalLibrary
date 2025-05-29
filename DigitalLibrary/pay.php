<?php
require 'vendor/autoload.php'; // Include Stripe PHP library
include "conn.php";

\Stripe\Stripe::setApiKey('sk_test_51Q8uua07CIuzAORvoSqGHBKwha3AcjbDcvsI4qwpAtViFMp3dhFq8TUq1PUnlSq5dTeAbTEjwfmfpugUd159Z3Mk009H1nXMUh'); // Replace with your Stripe Secret Key

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdf_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['contact'];

    // Fetch the PDF name from the database using pdf_id
    $stmt = $conn->prepare("SELECT name FROM card WHERE id = ?");
    if (!$stmt) {
        // If the statement preparation failed, output the error
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("i", $pdf_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pdf_data = $result->fetch_assoc();
        $pdf_name = $pdf_data['name'];
    } else {
        echo "PDF not found.";
        exit;
    }

    // Create a PaymentIntent with the order amount and currency
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 1000, // Set the amount in cents
        'currency' => 'usd',
        'payment_method_types' => ['card'],
        'metadata' => [
            'pdf_id' => $pdf_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ],
    ]);

    $clientSecret = $paymentIntent->client_secret;
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Complete Your Payment</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
        <script src="https://js.stripe.com/v3/"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert CDN -->
        <style>
            body {
                background: linear-gradient(135deg, #f0f4f8, #d9e4f5);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .payment-container {
                background: #fff;
                padding: 2rem;
                border-radius: 15px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                width: 400px;
                position: relative;
                overflow: hidden;
                transition: transform 0.3s;
            }
            .payment-container:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2);
            }
            .payment-header {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
                font-size: 1.5rem;
                position: relative;
            }
            .payment-header::after {
                content: '';
                display: block;
                width: 50px;
                height: 3px;
                background: #007bff;
                margin: 0.5rem auto;
                border-radius: 5px;
            }
            .user-info {
                margin-bottom: 20px;
                color: #555;
                font-size: 0.9rem;
                padding: 1rem;
                border: 1px solid #e0e0e0;
                border-radius: 10px;
                background-color: #f8f9fa;
            }
            #card-element {
                border: 2px solid #007bff;
                border-radius: 10px;
                padding: 10px;
                margin-top: 1rem;
                transition: border-color 0.3s;
                display: none; /* Initially hidden */
            }
            #card-element:focus {
                border-color: #0056b3;
                outline: none;
            }
            #submit {
                margin-top: 1rem;
                background-color: #007bff;
                border: none;
                color: white;
                padding: 10px;
                border-radius: 10px;
                cursor: pointer;
                transition: background-color 0.3s, transform 0.3s;
                font-weight: bold;
            }
            #submit:hover {
                background-color: #0056b3;
                transform: translateY(-2px);
            }
            #payment-message {
                margin-top: 1rem;
                color: red;
            }
            .footer {
                text-align: center;
                margin-top: 20px;
                font-size: 0.8rem;
                color: #777;
            }
            .show {
                display: block !important; /* Show card element when needed */
            }
        </style>
    </head>
    <body>
        <div class="payment-container">
            <div class="payment-header">
                <h1>Complete Your Payment</h1>
            </div>
            <div class="user-info">
                <strong>Email:</strong> <?php echo htmlspecialchars($email); ?><br>
                <strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?><br>
                <strong>PDF Name:</strong> <?php echo htmlspecialchars($pdf_name); ?><br>
            </div>
            <button id="pay-with-card" class="btn btn-primary btn-lg">Pay with Debit/Credit Card</button>
            <form id="payment-form" style="display:none;">
                <div id="card-element" class="form-control"></div>
                <button id="submit" class="btn btn-success btn-lg">Pay</button>
                <div id="payment-message" class="hidden"></div>
            </form>
            <div class="footer">
                <p>Secure payment processing powered by <i class="fab fa-stripe"></i></p>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
        <script>
            const stripe = Stripe('pk_test_51Q8uua07CIuzAORvOPkNphnVDvfztI3AGlwMeVXceeQZrHsnAEvF0wOzvTvqLylyZTZ1puQVzotwQOIbFABkAoRS00BR5GdjVN'); // Replace with your Stripe Publishable Key
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            // Show card element on button click
            document.getElementById('pay-with-card').addEventListener('click', function() {
                document.getElementById('payment-form').style.display = 'block';
                document.getElementById('card-element').classList.add('show');
                this.style.display = 'none'; // Hide the button after clicking
            });

            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const {error, paymentIntent} = await stripe.confirmCardPayment('<?php echo $clientSecret; ?>', {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: '<?php echo htmlspecialchars($name); ?>',
                            email: '<?php echo htmlspecialchars($email); ?>',
                            phone: '<?php echo htmlspecialchars($phone); ?>'
                        },
                    },
                });

                if (error) {
                    // Show error to your customer (e.g., insufficient funds)
                    document.getElementById('payment-message').innerText = error.message;
                } else {
                    // The payment has been processed successfully, show SweetAlert
                    Swal.fire({
                        title: 'Payment Successful!',
                        text: 'Your payment has been completed.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to redirect.php after clicking OK
                            window.location.href = "redirect.php?payment_intent=<?php echo $paymentIntent->id; ?>&pdf_id=<?php echo $pdf_id; ?>";
                        }
                    });
                }
            });
        </script>
    </body>
    </html>

<?php
}
?>
