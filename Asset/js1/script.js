
const seatsContainer = document.getElementById('seats-container');
const selectedSeats = document.getElementById('selected-seats');
const totalCostElement = document.getElementById('total-cost');
const confirmBtn = document.getElementById('confirm-btn');
const dateSelect = document.getElementById('date-select');
const timeSelect = document.getElementById('time-select');
const modal = document.getElementById('modal');
const closeModalBtn = document.getElementById('close-modal');

const seatPrice = 440;
const maxSeats = 10;
let selectedSeatsCount = 0;

const seatSVG = `
    <svg viewBox="0 0 24 24">
        <path d="M18 19H6c-1.1 0-2 .9-2 2v1h16v-1c0-1.1-.9-2-2-2zM18 10c-.55 0-1 .45-1 1v5h-1v-5c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v5H7v-5c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1z"/>
    </svg>
`;

const rows = 5;
const columns = 10;
for (let row = 1; row <= rows; row++) {
    const rowDiv = document.createElement('div');
    for (let col = 1; col <= columns; col++) {
        const seat = document.createElement('div');
        seat.classList.add('seat');
        seat.dataset.row = row;
        seat.dataset.col = col;
        seat.innerHTML = seatSVG; 
        seat.addEventListener('click', handleSeatClick);
        rowDiv.appendChild(seat);
    }
    seatsContainer.appendChild(rowDiv);
}

function handleSeatClick() {
    if (selectedSeatsCount >= maxSeats && !this.classList.contains('selected')) {
        showModal();
        return;
    }
    this.classList.toggle('selected');
    updateBasket();
}

function updateBasket() {
    const selected = Array.from(document.querySelectorAll('.seat.selected'));
    selectedSeats.innerHTML = '';
    selectedSeatsCount = selected.length;

    selected.forEach(seat => {
        const seatInfo = document.createElement('li');
        seatInfo.textContent = `Row ${seat.dataset.row}, Seat ${seat.dataset.col}`;
        selectedSeats.appendChild(seatInfo);
    });

    const totalCost = selectedSeatsCount * seatPrice;
    totalCostElement.textContent = totalCost;

    confirmBtn.disabled = selectedSeatsCount === 0;
}

function showModal() {
    modal.style.display = 'flex';
}

closeModalBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});

// Confirm Button Click Event
document.getElementById('confirm-btn').addEventListener('click', () => {
// Get all selected seats dynamically
const selectedSeatElements = document.querySelectorAll('.seat.selected');
const selectedSeats = Array.from(selectedSeatElements).map(seat => ({
    row: parseInt(seat.dataset.row),
    col: parseInt(seat.dataset.col)
}));

// Validate seat selection
if (selectedSeats.length === 0) {
    alert('Please select at least one seat.');
    return;
}

// Get date and time
const date = document.getElementById('date-select').value;
const time = document.getElementById('time-select').value;

// Calculate total cost
const seatPrice = 440;
const totalCost = selectedSeats.length * seatPrice;

// Prepare data for submission
const bookingData = {
    seats: selectedSeats,
    date: date,
    time: time,
    totalCost: totalCost
};

// Send booking request
fetch('save-tickets.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(bookingData)
})
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
})
.then(data => {
    if (data.success) {
        // Success scenario
        alert('Tickets successfully booked!');
        
        // Optionally, disable booked seats
        selectedSeatElements.forEach(seat => {
            seat.classList.add('booked');
            seat.classList.remove('selected');
            seat.removeEventListener('click', handleSeatClick);
        });

        // Reset basket
        selectedSeats.innerHTML = '';
        document.getElementById('total-cost').textContent = '0';
        document.getElementById('confirm-btn').disabled = true;
    } else {
        // Error scenario
        alert('Booking failed: ' + (data.message || 'Unknown error'));
        console.error('Booking error:', data);
    }
})
.catch(error => {
    // Network or parsing error
    console.error('Booking error:', error);
    alert('An error occurred while booking tickets. Please try again.');
});
});

// Modify existing handleSeatClick to prevent booking already booked seats
function handleSeatClick() {
// Check if seat is already booked
if (this.classList.contains('booked')) {
    return;
}

if (selectedSeatsCount >= maxSeats && !this.classList.contains('selected')) {
    showModal();
    return;
}
this.classList.toggle('selected');
updateBasket();
}

document.addEventListener('DOMContentLoaded', () => {
const seatsContainer = document.getElementById('seats-container');
const seatElements = seatsContainer.querySelectorAll('.seat');

// Fetch booked seats when the page loads
fetchBookedSeats();

function fetchBookedSeats() {
    const date = document.getElementById('date-select').value;
    const time = document.getElementById('time-select').value;

    fetch('get-booked-seats.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            date: date,
            time: time
        })
    })
    .then(response => response.json())
    .then(bookedSeats => {
        // Mark booked seats
        bookedSeats.forEach(seat => {
            const bookedSeat = document.querySelector(
                `.seat[data-row="${seat.seat_row}"][data-col="${seat.seat_col}"]`
            );
            if (bookedSeat) {
                bookedSeat.classList.add('booked');
                bookedSeat.style.opacity = '0.3';
                bookedSeat.style.pointerEvents = 'none';
            }
        });
    })
    .catch(error => {
        console.error('Error fetching booked seats:', error);
    });
}

// Update booked seats when date or time changes
document.getElementById('date-select').addEventListener('change', fetchBookedSeats);
document.getElementById('time-select').addEventListener('change', fetchBookedSeats);

const seatSVG = `
    <svg viewBox="0 0 24 24">
        <path d="M18 19H6c-1.1 0-2 .9-2 2v1h16v-1c0-1.1-.9-2-2-2zM18 10c-.55 0-1 .45-1 1v5h-1v-5c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v5H7v-5c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1z"/>
    </svg>
`;

const rows = 5;
const columns = 10;
for (let row = 1; row <= rows; row++) {
    const rowDiv = document.createElement('div');
    for (let col = 1; col <= columns; col++) {
        const seat = document.createElement('div');
        seat.classList.add('seat');
        seat.dataset.row = row;
        seat.dataset.col = col;
        seat.innerHTML = seatSVG; 
        seat.addEventListener('click', handleSeatClick);
        rowDiv.appendChild(seat);
    }
    seatsContainer.appendChild(rowDiv);
}

const selectedSeats = document.getElementById('selected-seats');
const totalCostElement = document.getElementById('total-cost');
const confirmBtn = document.getElementById('confirm-btn');

const seatPrice = 440;
const maxSeats = 10;
let selectedSeatsCount = 0;

function handleSeatClick() {
    // Prevent clicking booked seats
    if (this.classList.contains('booked')) {
        return;
    }

    if (selectedSeatsCount >= maxSeats && !this.classList.contains('selected')) {
        showModal();
        return;
    }
    this.classList.toggle('selected');
    updateBasket();
}

function updateBasket() {
    const selected = Array.from(document.querySelectorAll('.seat.selected'));
    selectedSeats.innerHTML = '';
    selectedSeatsCount = selected.length;

    selected.forEach(seat => {
        const seatInfo = document.createElement('li');
        seatInfo.textContent = `Row ${seat.dataset.row}, Seat ${seat.dataset.col}`;
        selectedSeats.appendChild(seatInfo);
    });

    const totalCost = selectedSeatsCount * seatPrice;
    totalCostElement.textContent = totalCost;

    confirmBtn.disabled = selectedSeatsCount === 0;
}

confirmBtn.addEventListener('click', () => {
    const selectedSeatElements = document.querySelectorAll('.seat.selected');
    const selectedSeatsData = Array.from(selectedSeatElements).map(seat => ({
        row: parseInt(seat.dataset.row),
        col: parseInt(seat.dataset.col)
    }));

    const date = document.getElementById('date-select').value;
    const time = document.getElementById('time-select').value;
    const totalCost = selectedSeatsData.length * seatPrice;

    fetch('save-tickets.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            seats: selectedSeatsData,
            date: date,
            time: time,
            totalCost: totalCost
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Tickets successfully booked!');
            
            // Mark booked seats
            selectedSeatElements.forEach(seat => {
                seat.classList.add('booked');
                seat.classList.remove('selected');
                seat.style.opacity = '0.3';
                seat.style.pointerEvents = 'none';
                seat.removeEventListener('click', handleSeatClick);
            });

            // Reset basket
            selectedSeats.innerHTML = '';
            totalCostElement.textContent = '0';
            confirmBtn.disabled = true;

            // Refresh booked seats
            fetchBookedSeats();
        } else {
            alert('Booking failed: ' + (data.message || 'Unknown error'));
            console.error('Booking error:', data);
        }
    })
    .catch(error => {
        console.error('Booking error:', error);
        alert('An error occurred while booking tickets. Please try again.');
    });
});
});

