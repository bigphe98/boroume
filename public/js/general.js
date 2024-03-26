function togglePassword(passwordInput, invisibleIcon, visibleIcon) {
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        invisibleIcon.style.display = 'none';
        visibleIcon.style.display  = 'block';
    } else {
        passwordInput.type = "password";
        invisibleIcon.style.display = 'block';
        visibleIcon.style.display  = 'none';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    var forms = document.getElementsByTagName("form");
    for (var i = 0; i < forms.length; i++) {
        forms[i].addEventListener("submit", function() {
            var inputs = this.getElementsByTagName("input");
            for (var j = 0; j < inputs.length; j++) {
                if (inputs[j].type === "password" || inputs[j].type === "text") {
                    inputs[j].setAttribute("autocomplete", "off");
                }
            }
        });
    }
});

document.getElementById("start").valueAsDate = new Date();