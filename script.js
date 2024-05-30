document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            if (!validateEmail(email)) {
                alert('Invalid email format');
                event.preventDefault();
            }
            if (!validatePassword(password)) {
                alert('Password must be at least 8 characters long');
                event.preventDefault();
            }
        });
    }

    // AJAX for dynamic content loading
    const loadTrainSchedule = async () => {
        try {
            const response = await fetch('train-schedule.php');
            const data = await response.text();
            document.getElementById('trainSchedule').innerHTML = data;
        } catch (error) {
            console.error('Error loading train schedule:', error);
        }
    };

    if (document.getElementById('trainSchedule')) {
        loadTrainSchedule();
    }

    // Interactive elements
    const datePicker = document.getElementById('datePicker');
    if (datePicker) {
        datePicker.addEventListener('focus', function() {
            // Initialize date picker
        });
    }

    // Real-time feedback
    const bookTicketForm = document.getElementById('bookTicketForm');
    if (bookTicketForm) {
        bookTicketForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(bookTicketForm);
            try {
                const response = await fetch('book-ticket.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                if (result.success) {
                    alert('Ticket booked successfully');
                    loadBookedTickets();
                } else {
                    alert('Error booking ticket: ' + result.message);
                }
            } catch (error) {
                console.error('Error booking ticket:', error);
            }
        });
    }

    // Load booked tickets dynamically
    const loadBookedTickets = async () => {
        try {
            const response = await fetch('booked-tickets.php');
            const data = await response.text();
            document.getElementById('bookedTickets').innerHTML = data;
        } catch (error) {
            console.error('Error loading booked tickets:', error);
        }
    };

    if (document.getElementById('bookedTickets')) {
        loadBookedTickets();
    }
});

// Helper functions
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
    return password.length >= 8;
}
