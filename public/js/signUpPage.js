document.addEventListener("DOMContentLoaded", function() {

    // Add event listener to the button to show the hidden content
    document.getElementById("adultButton").addEventListener("click", function() {
        document.getElementById("isAdultInput").value = "1";
        document.getElementById("signUpForm").style.display = "block";
        document.getElementById("ageCheck").style.display = "none";
        document.getElementById("nameKid").style.display = "none";
        document.getElementById("surnameKid").style.display = "none";

    });

    document.getElementById("childButton").addEventListener("click", function() {
        document.getElementById("isAdultInput").value = "0";
        document.getElementById("signUpForm").style.display = "block";
        document.getElementById("ageCheck").style.display = "none";
    });
});
