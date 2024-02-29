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