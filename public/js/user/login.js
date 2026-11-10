/* =========================================
   TAMPILKAN / SEMBUNYIKAN PASSWORD
========================================= */

document.addEventListener("DOMContentLoaded", function () {
    const showPassword = document.getElementById("showPassword");
    const password = document.getElementById("password");

    if (showPassword && password) {
        showPassword.addEventListener("click", function (e) {
            e.preventDefault();
            if (password.type === "password") {
                password.type = "text";
                showPassword.innerText = "🙈";
                showPassword.setAttribute("aria-label", "Sembunyikan password");
            } else {
                password.type = "password";
                showPassword.innerText = "👁";
                showPassword.setAttribute("aria-label", "Lihat password");
            }
        });
    }

    /* =========================================
       LOGIN
    ========================================= */
    const loginForm = document.getElementById("loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            const usernameInput = document.getElementById("username");
            const passwordInput = document.getElementById("password");
            const roleInput = document.getElementById("role");
            const message = document.getElementById("loginMessage");

            const username = usernameInput ? usernameInput.value.trim() : "";
            const passwordValue = passwordInput ? passwordInput.value : "";
            const role = roleInput ? roleInput.value : "";

            if (role === "") {
                event.preventDefault();
                if (message) message.innerText = "Silahkan pilih role terlebih dahulu.";
                return;
            }

            if (username === "" || passwordValue === "") {
                event.preventDefault();
                if (message) message.innerText = "Username dan password harus diisi.";
                return;
            }
        });
    }
});
