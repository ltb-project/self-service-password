const fields = ["oldpassword", "newpassword", "confirmpassword"];
fields.map((field) => {
    const passwordField = document.getElementById(field);
    const togglePassword = passwordField.parentElement.querySelector(".password-toggle-icon i");

    togglePassword.addEventListener("click", () => {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePassword.classList.remove("fa-eye");
            togglePassword.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            togglePassword.classList.remove("fa-eye-slash");
            togglePassword.classList.add("fa-eye");
        }
    });
})