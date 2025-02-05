function doValidate() {
    // Get form values
    let vehicleNumber = document.forms["appointmentForm"]["vehicleNumber"].value;
    let vehicleType = document.forms["appointmentForm"]["vehicleType"].value;
    let date = document.forms["appointmentForm"]["date"].value;
    let time = document.forms["appointmentForm"]["time"].value;
    let serviceStation = document.forms["appointmentForm"]["serviceStation"].value;
    let services = document.querySelectorAll("input[name='service[]']:checked");

    // Validate Vehicle Number (e.g., ABC-1234)
    let vehicleNumberPattern = /^[A-Za-z]{2,3}-\d{4}$/;
    if (!vehicleNumberPattern.test(vehicleNumber)) {
        alert("Please enter a valid vehicle number (e.g., ABC-1234).");
        return false;
    }

    // Validate Vehicle Type
    if (vehicleType === "Select Vehicle Type") {
        alert("Please select a vehicle type.");
        return false;
    }

    // Validate Date
    if (date === "") {
        alert("Please select a date.");
        return false;
    }

    // Validate Time
    if (time === "") {
        alert("Please select a time.");
        return false;
    }

    // Validate Service Station
    if (serviceStation === "") {
        alert("Please select a service station.");
        return false;
    }

    // Validate Services (at least one service must be selected)
    if (services.length === 0) {
        alert("Please select at least one service.");
       
        return false;
    }

    // If all validations pass, allow form submission
    return true;
}