/* =====================================================
   CEK LOGIN SAAT WEBSITE DIBUKA
===================================================== */

document.addEventListener("DOMContentLoaded", function () {

    const currentUser = localStorage.getItem("currentUser");

    if (currentUser) {

        const user = JSON.parse(currentUser);

        if (user.role === "admin") {

            window.location.href = "beranda-admin.html";

        } else {

            window.location.href = "beranda-user.html";

        }

    }

});


/* =====================================================
   DATA ADMIN
===================================================== */

const adminAccount = {

    username: "adminsm",

    password: "admin123",

    nama: "Administrator Seni Multikalter",

    role: "admin"

};


/* =====================================================
   LOGIN
===================================================== */

const loginForm = document.getElementById("loginForm");


if (loginForm) {

    loginForm.addEventListener("submit", function (event) {

        event.preventDefault();


        const username =
            document.getElementById("username").value.trim();

        const password =
            document.getElementById("password").value;

        const role =
            document.getElementById("role").value;


        /* =========================
           CEK ROLE
        ========================= */

        if (role === "") {

            alert("Silahkan pilih role terlebih dahulu.");

            return;

        }


        /* =========================
           LOGIN ADMIN
        ========================= */

        if (role === "admin") {

            if (
                username === adminAccount.username &&
                password === adminAccount.password
            ) {

                localStorage.setItem(
                    "currentUser",
                    JSON.stringify(adminAccount)
                );

                alert("Login sebagai Admin berhasil!");

                window.location.href = "beranda-admin.html";

            } else {

                alert(
                    "Login Admin gagal! Username atau password Admin tidak sesuai."
                );

            }

            return;
        }


        /* =========================
           LOGIN USER
        ========================= */

        const users =
            JSON.parse(localStorage.getItem("users")) || [];


        const user = users.find(function (item) {

            return (
                item.username === username &&
                item.password === password
            );

        });


        if (user) {

            /* Pastikan user memang login sebagai user */

            const loginData = {

                nama: user.nama,

                username: user.username,

                role: "user"

            };


            localStorage.setItem(
                "currentUser",
                JSON.stringify(loginData)
            );


            alert("Login berhasil! Selamat datang " + user.nama);


            window.location.href = "beranda-user.html";


        } else {

            alert(
                "Username atau password salah. Silahkan cek kembali atau daftar terlebih dahulu."
            );

        }

    });

}


/* =====================================================
   REGISTER / DAFTAR
===================================================== */

const registerForm =
    document.getElementById("registerForm");


if (registerForm) {

    registerForm.addEventListener("submit", function (event) {

        event.preventDefault();


        const nama =
            document.getElementById("nama").value.trim();

        const username =
            document.getElementById("regUsername").value.trim();

        const password =
            document.getElementById("regPassword").value;

        const confirmPassword =
            document.getElementById("confirmPassword").value;


        /* =========================
           CEK PASSWORD
        ========================= */

        if (password !== confirmPassword) {

            alert("Konfirmasi password tidak sama!");

            return;

        }


        /* =========================
           AMBIL DATA USER
        ========================= */

        const users =
            JSON.parse(localStorage.getItem("users")) || [];


        /* =========================
           CEK USERNAME
        ========================= */

        const usernameExists = users.some(function (user) {

            return user.username === username;

        });


        if (usernameExists) {

            alert("Username sudah digunakan!");

            return;

        }


        /* =========================
           BUAT USER BARU
        ========================= */

        const newUser = {

            id: Date.now(),

            nama: nama,

            username: username,

            password: password,

            role: "user"

        };


        users.push(newUser);


        /* =========================
           SIMPAN KE LOCAL STORAGE
        ========================= */

        localStorage.setItem(
            "users",
            JSON.stringify(users)
        );


        alert(
            "Pendaftaran berhasil! Silahkan login."
        );


        window.location.href = "index.html";

    });

}


/* =====================================================
   LOGOUT
===================================================== */

function logout() {

    localStorage.removeItem("currentUser");

    window.location.href = "index.html";

}