

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .receipt-container {
            background-color: #fff;
            border: 2px solid #000; 
            padding: 20px;
            width: 400px;
            min-height: 300px; 
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #e67e22; 
            margin-bottom: 15px;
        }

        .address {
            font-size: 14px;
            color: #34495e;
            margin-bottom: 20px;
        }

        .stars {
            font-size: 12px;
            margin: 10px 0;
        }

        .stars:before,
        .stars:after {
            content: "************************";
            display: block;
        }

        .items {
            text-align: left;
            margin: 20px 0;
        }

        .items .line {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 14px;
        }

        .items .line .dotted {
            flex: 1;
            border-bottom: 1px dotted #000;
            margin: 0 5px;
        }

        .total {
            font-size: 18px;
            margin-top: 20px;
        }

        .total .dotted {
            flex: 1;
            border-bottom: 2px dotted #000;
            margin: 0 5px;
        }

        .payment-method {
            font-size: 14px;
            color: #34495e;
            margin-top: 15px;
        }

        .thank-you {
            margin-top: 30px;
            font-size: 10px;
            color: #07155d; 
        }
    </style>
</head>
<body>

    <div class="receipt-container">
        <h1>RECEIPT</h1>
        <div class="address">
            <p>Royale Cinema</p>
            <p>143 Royale Street, North Caloocan City</p>
        </div>
        <div class="stars"></div>
        
        <div class="items">
            <div class="line">
                <span><strong>Cinema Name</strong></span>
                <span class="dotted"></span>
                <span>Royale Cinema</span>
            </div>
            <div class="line">
                <span><strong>Cinema Room</strong></span>
                <span class="dotted"></span>
                <span>1</span>
            </div>
            <div class="line">
                <span><strong>Booked on</strong></span>
                <span class="dotted"></span>
                <span>12-02-24 1:00pm</span>
            </div>
            <div class="line">
                <span><strong>Screening Time</strong></span>
                <span class="dotted"></span>
                <span>5:00pm</span>
            </div>
            <div class="line">
                <span><strong>Screenig Date</strong></span>
                <span class="dotted"></span>
                <span>12-24-24</span>
            </div>
            <div class="line">
                <span><strong>Movie Title</strong></span>
                <span class="dotted"></span>
                <span>Deadpool and Wolverine</span>
            </div>
            <div class="line">
                <span><strong>Showtime</strong></span>
                <span class="dotted"></span>
                <span>7:00 PM</span>
            </div>
            <div class="line">
                <span><strong>Seats</strong></span>
                <span class="dotted"></span>
                <span>R1-S2, R2-S3, R2-S4</span>
            </div>
            <div class="line">
                <span><strong>Price</strong></span>
                <span class="dotted"></span>
                <span>₱440.00 x 3</span>
            </div>
        </div>

        <div class="total">
            <strong>Total</strong>
            <span class="dotted"></span>
            <strong>₱1320.00</strong>
        </div>

        <div class="payment-method">
            <p><strong>Payment Method:</strong> Credit Card</p>
        </div>

        <div class="stars"></div>
        <p class="thank-you">Thank you for choosing Royale Cinema!<br>Enjoy the movie!</p>
    </div>
</body>
</html>
