// Validate vehicle number format
function doValidate() {
    let vehicleNumber = document.forms["vehicleForm"]["plateNumber"].value;
    let vehicleNumberPattern = /^[A-Za-z]{2,3}-\d{4}$/;
    if (!vehicleNumberPattern.test(vehicleNumber)) {
        alert("Please enter a valid vehicle number (e.g., ABC-1234).");
        return false;
    }
    return true;
}

// Load vehicle data into the form
function loadVehicleData(plateNumber, brand, model, fuelType, manufacturedYear) {
    document.getElementById("plateNumber").value = plateNumber;
    document.getElementById("brand").value = brand;
    document.getElementById("model").value = model;
    document.getElementById("fuelType").value = fuelType;
    document.getElementById("manufacturedYear").value = manufacturedYear;
}

// Confirm deletion
function confirmDelete() {
    return confirm("Are you sure you want to delete this vehicle?");
}

// Handle button states
document.addEventListener("DOMContentLoaded", function () {
    let saveButton = document.getElementById('btnsave');
    let updateButton = document.getElementById('btnup');
    let deleteButton = document.getElementById('btndlt');

    // Initially disable Update and Delete buttons
    updateButton.disabled = true;
    deleteButton.disabled = true;

    // Handle card clicks
    document.querySelectorAll('.card').forEach(function (card) {
        card.addEventListener('click', function () {
            saveButton.disabled = true;   // Disable save button
            updateButton.disabled = false; // Enable update button
            deleteButton.disabled = false; // Enable delete button
        });
    });

    // Reset button states when the form is reset
    document.getElementById('vehicleForm').addEventListener('reset', function () {
        saveButton.disabled = false;
        updateButton.disabled = true;
        deleteButton.disabled = true;
    });
});

// Clear reminder form
function clearReminderForm() {
    document.getElementById("reminderForm").reset();
}

// Remove reminder
function removeReminder(reminderId) {
    if (confirm("Are you sure you want to delete this reminder?")) {
        console.log("Reminder ID to delete:", reminderId); // Debugging

        // Send a POST request to the server
        fetch('delete_reminder.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ reminderId: reminderId }), // Send the reminder ID as JSON
        })
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            if (data.success) {
                console.log("Reminder deleted successfully."); // Debugging
                alert("Reminder deleted successfully!");
                location.reload(); // Refresh the page to update the UI
            } else {
                console.error("Failed to delete reminder:", data.error); // Debugging
                alert("Failed to delete reminder: " + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error); // Debugging
            alert("An error occurred while deleting the reminder.");
        });
    }
}