// Get modal elements
var gcashModal = document.getElementById('gcashModal');
var confirmationModal = document.getElementById('confirmationModal');

// Get button elements
var openModalBtn = document.getElementById('openModalBtn');
var nextBtn = document.getElementById('nextBtn');

// Get the phone input and error message elements
var phoneInput = document.getElementById('phoneInput');
var errorMessage = document.getElementById('error-message');

// When the user clicks the "Pay with GCash" button, open the first modal
openModalBtn.onclick = function() {
    gcashModal.style.display = 'block';
}

// Phone number validation function
function validatePhoneNumber(phoneNumber) {
    // Regular expression for valid phone numbers (e.g., +63 9171234567)
    var phonePattern = /^\+63\s9\d{9}$/;
    return phonePattern.test(phoneNumber);
}

// When the user clicks the "NEXT" button, validate the phone number and switch to the confirmation modal if valid
nextBtn.onclick = function() {
    var enteredPhone = phoneInput.value.trim();
    
    // Add country code if it's missing
    if (!enteredPhone.startsWith("+63")) {
        enteredPhone = "+63 " + enteredPhone;
    }

    // Validate the phone number format
    if (validatePhoneNumber(enteredPhone)) {
        phoneInput.classList.remove("error");
        errorMessage.style.display = "none";  // Hide error message
        gcashModal.style.display = 'none';   // Hide the first modal
        confirmationModal.style.display = 'block';  // Show the confirmation modal
    } else {
        phoneInput.classList.add("error");
        errorMessage.innerHTML = "Please enter a valid phone number (e.g., +63 9171234567).";
        errorMessage.style.display = "block";  // Show error message
    }
}

// When the user clicks outside the modal, close it
window.onclick = function(event) {
    if (event.target == gcashModal) {
        gcashModal.style.display = 'none';
    }
    if (event.target == confirmationModal) {
        confirmationModal.style.display = 'none';
    }
}
