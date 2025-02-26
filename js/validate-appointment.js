document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("appointmentForm");
    const vehicleSelect = document.querySelector("select[name='vehicleId']");
    const timeSelect = document.querySelector("select[name='time']");
    const serviceCheckboxes = document.querySelectorAll("input[name='service[]']");
    const vehicleError = document.getElementById("vehicleError");
    const dateError = document.getElementById("dateError");
    const timeError = document.getElementById("timeError");
    const servicesError = document.getElementById("servicesError");

    form.addEventListener("submit", function (event) {
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

        // Validate Date (should be today or future)
        const dateInput = document.querySelector("input[name='date']");
        const today = new Date().toISOString().split("T")[0];
        if (dateInput.value === "" || dateInput.value < today) {
            dateError.style.display = "block";
            isValid = false;
        }

        // Validate Time Selection
        if (timeSelect.value === "") {
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
            event.preventDefault();  // Prevents the form from refreshing
        }
    });

    // Prevent reselecting "Select Vehicle" or "Select Time"
    vehicleSelect.addEventListener("change", function () {
        if (this.value !== "") {
            this.querySelector("option[value='']").disabled = true;
        }
    });

    timeSelect.addEventListener("change", function () {
        if (this.value !== "") {
            this.querySelector("option[value='']").disabled = true;
        }
    });
});
