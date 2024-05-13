$(function () {
    var language = document.getElementById('langs_login').querySelector('.active').id;
    var div = document.getElementById("code_of_conduct_div");

    if (language === "en") {
        div.style.display = "none"; // Hide the div
    } else {
        div.style.display = "block"; // Show the div
    }

    let popup = document.getElementById("popupGuide")
})

function addService(){
    var count = 0;
    if(count < 3){

    }
}

function displayPopUpGeneralGuide() {
    document.getElementById("popupGuide").classList.add("openpopup")
    $('#defaultpopupthings1').load('volunteersGuideGeneral');
}

function displayPopUpVolunteerGuide() {
    document.getElementById("popupGuide").classList.add("openpopup")
    $('#defaultpopupthings1').load('volunteersGuide');
}

function closePopUp() {
    document.getElementById("popupGuide").classList.remove("openpopup")
}