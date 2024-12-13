<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCash Payment</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 360px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #0051c8;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
        }

        .profile {
            text-align: center;
            margin: 20px 0;
        }

        .profile-circle {
            width: 60px;
            height: 60px;
            background-color: #d9d9d9;
            border-radius: 50%;
            line-height: 60px;
            font-size: 24px;
            color: #555;
            margin: 0 auto;
        }

        .profile-text {
            font-size: 16px;
            margin-top: 10px;
            color: #333;
        }

        .section {
            padding: 15px 20px;
        }

        .section h2 {
            font-size: 14px;
            margin: 0;
            margin-bottom: 10px;
            color: #666;
        }

        .payment-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f5f5f5;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .payment-option span {
            font-size: 14px;
            color: #333;
        }

        .payment-option .checkmark {
            color: #0051c8;
            font-size: 18px;
        }

        .summary {
            font-size: 14px;
            color: #333;
        }

        .summary div {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }

        .summary div:last-child {
            font-weight: bold;
        }

        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .footer button {
            background-color: #0051c8;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .footer button:hover {
            background-color: #003a92;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Parse URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const movieId = urlParams.get('movieId');
            const date = urlParams.get('date');
            const time = urlParams.get('time');
            const seats = JSON.parse(urlParams.get('seats'));
            const totalCost = urlParams.get('totalCost');

            // Update page with booking details
            document.querySelector('.profile-text').textContent = 'Booking Confirmation';
            
            // Update summary section
            const summarySection = document.querySelector('.summary');
            if (summarySection) {
                summarySection.innerHTML = `
                    <div>
                        <span>Movie Booking</span>
                        <span>php ${totalCost}.00</span>
                    </div>
                    <div>
                        <span>Date</span>
                        <span>${date}</span>
                    </div>
                    <div>
                        <span>Time</span>
                        <span>${time}</span>
                    </div>
                    <div>
                        <span>Seats</span>
                        <span>${seats.map(seat => `Row ${seat.row}, Seat ${seat.col}`).join('; ')}</span>
                    </div>
                    <div>
                        <span>Total Amount</span>
                        <span>php ${totalCost}.00</span>
                    </div>
                `;
            }

            // Add event listener to pay button
            const payButton = document.querySelector('.footer button');
            if (payButton) {
                payButton.addEventListener('click', () => {
                    // Send booking details to server
                    fetch('../../Asset/connection/save-tickets.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            movie_id: movieId,
                            date: date,
                            time: time,
                            seats: seats
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Tickets successfully booked!');
                            // Redirect to a confirmation or home page
                            window.location.href = 'home.php';
                        } else {
                            alert('Booking failed: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Booking error:', error);
                        alert('An error occurred while booking tickets. Please try again.');
                    });
                });
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Payment</h1>
        </div>
        <div class="profile">
            <div class="profile-circle">W</div>
            <div class="profile-text">WEB COM PH</div>
        </div>
        <div class="section">
            <h2>PAY WITH</h2>
            <div class="payment-option">
                <span>GCash</span>
                <span class="checkmark">&#10003;</span>
            </div>
            <h2>YOU ARE ABOUT TO PAY</h2>
            <div class="summary">
                <div>
                    <span>Amount Due</span>
                    <span>php 1,500.00</span>
                </div>
                <div>
                    <span>Discount</span>
                    <span>No available voucher</span>
                </div>
                <div>
                    <span>Total Amount</span>
                    <span>php 1,500.00</span>
                </div>
            </div>
        </div>
        <div class="footer">
            <p>Please review to ensure that the details are correct before you proceed.</p>
            <button>Pay php 1,500.00</button>
        </div>
    </div>
</body>
</html>