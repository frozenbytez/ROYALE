const cinemaContainer = document.querySelector('.cinema');
const selectedSeatSpan = document.getElementById('selected-seat');
const reserveButton = document.getElementById('reserve-btn');

let selectedSeat = null;
let seats = [];

const rows = 10;  // Number of rows
const cols = 10;  // Number of columns

// Generate cinema seats
function createSeats() {
    for (let row = 0; row < rows; row++) {
        let rowArray = [];
        for (let col = 0; col < cols; col++) {
            const seat = document.createElement('div');
            seat.classList.add('seat');
            seat.dataset.row = row;
            seat.dataset.col = col;
            seat.addEventListener('click', () => selectSeat(seat));
            cinemaContainer.appendChild(seat);
            rowArray.push(seat);
        }
        seats.push(rowArray);
    }
}

// Select a seat
function selectSeat(seat) {
    if (seat.classList.contains('reserved')) {
        alert("This seat is already reserved!");
        return;
    }

    if (selectedSeat) {
        selectedSeat.classList.remove('selected');
    }

    selectedSeat = seat;
    selectedSeat.classList.add('selected');
    selectedSeatSpan.textContent = `Row ${parseInt(seat.dataset.row) + 1}, Column ${parseInt(seat.dataset.col) + 1}`;
    reserveButton.disabled = false;  // Enable the reserve button
}

// Reserve the selected seat
reserveButton.addEventListener('click', () => {
    if (!selectedSeat) return;
    
    selectedSeat.classList.add('reserved');
    selectedSeat.classList.remove('selected');
    selectedSeatSpan.textContent = 'None';
    reserveButton.disabled = true;

    selectedSeat = null;
});

// Initialize the seat grid
createSeats();
