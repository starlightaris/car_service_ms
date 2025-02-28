function doValidate() {
    const form = document.getElementById("appointmentForm");
    const vehicleSelect = document.querySelector("select[name='vehicleId']");
    const dateInput = document.querySelector("input[name='date']");
    const timeButtons = document.querySelectorAll(".timeSelect");
    const serviceCheckboxes = document.querySelectorAll("input[name='service[]']");
    const timeError = document.getElementById("timeError");
    const vehicleError = document.getElementById("vehicleError");
    const dateError = document.getElementById("dateError");
    const servicesError = document.getElementById("servicesError");

    let isValid = true;

    // Reset error messages
    vehicleError.style.display = "none";
    dateError.style.display = "none";
    timeError.style.display = "none";
    servicesError.style.display = "none";

    // Validate Vehicle Selection
    if (vehicleSelect.value === "") {
        vehicleError.style.display = "block";
        isValid = false;
    }

    // Validate Date (must be today or later)
    const today = new Date().toISOString().split("T")[0]; // Get today's date in YYYY-MM-DD format
    if (dateInput.value === "") {
        dateError.textContent = "Please select a date.";
        dateError.style.display = "block";
        isValid = false;
    } else if (dateInput.value < today) {
        dateError.textContent = "Please select a date that is today or in the future.";
        dateError.style.display = "block";
        isValid = false;
    }

    // Validate Time Selection
    const selectedTime = document.getElementById("selectedTime").value;
    if (!selectedTime) {
        timeError.style.display = "block";
        isValid = false;
    }

    // Validate at least one service is selected
    let serviceSelected = false;
    serviceCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            serviceSelected = true;
        }
    });
    if (!serviceSelected) {
        servicesError.style.display = "block";
        isValid = false;
    }

    // Prevent form submission if validation fails
    if (!isValid) {
        return false;
    }

    return true;
}

document.addEventListener("DOMContentLoaded", function () {
    const vehicleSelect = document.querySelector("select[name='vehicleId']");
    const dateInput = document.querySelector("input[name='date']");
    const timeButtons = document.querySelectorAll(".timeSelect");
    const serviceCheckboxes = document.querySelectorAll("input[name='service[]']");
    const timeError = document.getElementById("timeError");
    const vehicleError = document.getElementById("vehicleError");
    const dateError = document.getElementById("dateError");
    const servicesError = document.getElementById("servicesError");

    // Event listener for vehicle selection
    vehicleSelect.addEventListener("change", function () {
        if (this.value !== "") {
            vehicleError.style.display = "none";
        }
    });

    // Event listener for date selection
    dateInput.addEventListener("change", function () {
        const today = new Date().toISOString().split("T")[0];
        if (this.value >= today) {
            dateError.style.display = "none";

            // Fetch booked time slots for the selected date
            fetchBookedTimes(this.value).then(bookedTimes => {
                console.log("Fetched Booked Times (Trimmed):", bookedTimes); // Debugging
                timeButtons.forEach(button => {
                    // Enable the button if the time slot is not booked
                    if (!bookedTimes.includes(button.textContent)) {
                        button.disabled = false;
                        button.classList.remove("disabled");
                    } else {
                        button.disabled = true;
                        button.classList.add("disabled");
                    }
                });
            });
        } else {
            timeButtons.forEach(button => {
                button.disabled = true;
            });
        }
    });

    // Event listener for time selection
    timeButtons.forEach(button => {
        button.addEventListener("click", function () {
            timeError.style.display = "none";
        });
    });

    // Event listener for service selection
    serviceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            let serviceSelected = false;
            serviceCheckboxes.forEach(cb => {
                if (cb.checked) {
                    serviceSelected = true;
                }
            });
            if (serviceSelected) {
                servicesError.style.display = "none";
            }
        });
    });

    // Disable time buttons initially
    const today = new Date().toISOString().split("T")[0];
    timeButtons.forEach(button => {
        button.disabled = true;
    });

    // Highlight selected time button
    const timeInput = document.getElementById("selectedTime");
    timeButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Remove 'selected' class from all buttons
            timeButtons.forEach(btn => btn.classList.remove("selected"));

            // Add 'selected' class to the clicked button
            this.classList.add("selected");

            // Set the hidden input value to the selected time
            timeInput.value = this.textContent;
        });
    });
});

// Function to fetch booked time slots for the selected date
function fetchBookedTimes(selectedDate) {
    return fetch(`getBookedTimes.php?date=${selectedDate}`)
        .then(response => response.json())
        .then(data => {
            // Remove seconds from the booked times (e.g., "18:00:00" -> "18:00")
            const bookedTimes = data.bookedTimes.map(time => time.slice(0, 5));
            console.log("Fetched Booked Times (Trimmed):", bookedTimes); // Debugging
            return bookedTimes;
        })
        .catch(error => {
            console.error("Error fetching booked times:", error);
            return [];
        });
}