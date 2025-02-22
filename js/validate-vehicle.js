function doValidate(){
    let vehicleNumber=document.forms["vehicleForm"]["plateNumber"].value;


   // Validate Vehicle Number (e.g., ABC-1234)
   let vehicleNumberPattern = /^[A-Za-z]{2,3}-\d{4}$/;
   if (!vehicleNumberPattern.test(vehicleNumber)) {
       alert("Please enter a valid vehicle number (e.g., ABC-1234).");
       return false;
   }
   return true;
}
function confirmDelete(){
   confirm("Are you sure you want to delete this vehicle?");
   
}
// Disable the Save button when a card is clicked
document.addEventListener("DOMContentLoaded", function () {
    let saveButton = document.getElementById('btnsave');
    let updateButton = document.getElementById('btnup'); 
    let deleteButton = document.getElementById('btndlt'); 

  
        // Initially disable Update and Delete buttons
        updateButton.disabled = true;
        deleteButton.disabled = true;
    // Handle multiple cards
    document.querySelectorAll('.card').forEach(function (card) {
        card.addEventListener('click', function () {
            saveButton.disabled = true;   // Disable save button
            updateButton.disabled = false; // Enable update button
            deleteButton.disabled = false; // Enable delete button
        });
    });

    // Enable Save button when Update or Delete is clicked
    [updateButton, deleteButton].forEach(function (button) {
        button.addEventListener('click', function () {
            saveButton.disabled = false;
        });
    });
});