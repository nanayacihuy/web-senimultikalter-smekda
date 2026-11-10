
/* =====================================================
   SHOW / HIDE PASSWORD
===================================================== */

const passwordButtons =
    document.querySelectorAll(".show-password");


passwordButtons.forEach(function (button) {

    button.addEventListener("click", function () {

        const targetId =
            button.getAttribute("data-target");

        const input =
            document.getElementById(targetId);


        if (input.type === "password") {

            input.type = "text";

            button.innerText = "🙈";

        } else {

            input.type = "password";

            button.innerText = "👁";

        }

    });

});



/* =====================================================
   VALIDASI PASSWORD
===================================================== */

const registerForm =
    document.getElementById("registerForm");


if (registerForm) {

    registerForm.addEventListener(
        "submit",
        function (event) {


            const password =
                document.getElementById(
                    "regPassword"
                ).value;


            const confirmPassword =
                document.getElementById(
                    "confirmPassword"
                ).value;


            const message =
                document.getElementById(
                    "registerMessage"
                );


            /* =========================
               CEK PASSWORD
            ========================== */

            if (password !== confirmPassword) {

                event.preventDefault();

                message.innerText =
                    "Konfirmasi password tidak sesuai.";

                return;

            }


            /* =========================
               MINIMAL PASSWORD
            ========================== */

            if (password.length < 6) {

                event.preventDefault();

                message.innerText =
                    "Password minimal 6 karakter.";

                return;

            }


            /*
                Kalau semua benar,
                form akan diteruskan ke
                AuthController Laravel.
            */

        }
    );

}