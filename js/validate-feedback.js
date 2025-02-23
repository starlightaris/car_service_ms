function openFeedbackForm() {
    document.getElementById("feedbackForm").style.display = "block";
}

function closeFeedbackForm() {
    document.getElementById("feedbackForm").style.display = "none";
}

function submitFeedback() {
    let feedback = document.getElementById("feedbackText").value;
    if (feedback.trim() === "") {
        alert("Please enter your feedback.");
        return;
    }
    alert("Thank you for your feedback!");
    document.getElementById("feedbackText").value = "";
    closeFeedbackForm();
}