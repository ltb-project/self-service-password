const fields = ["oldpassword", "newpassword", "confirmpassword"];
fields.map((field) => {
    const passwordField = document.getElementById(field);
    const togglePassword = passwordField.parentElement.querySelector(".password-toggle-icon i");

    const showPassword = () => {
            passwordField.type = "text";
            togglePassword.classList.replace("fa-eye", "fa-eye-slash");
    };
    const hidePassword = () => {
            passwordField.type = "password";
            togglePassword.classList.replace("fa-eye-slash", "fa-eye");
    };
    togglePassword.addEventListener("mousedown", showPassword);
    togglePassword.addEventListener("touchstart", showPassword);
    togglePassword.addEventListener("mouseup", hidePassword);
    togglePassword.addEventListener("mouseleave", hidePassword);
    togglePassword.addEventListener("touchend", hidePassword);
})
