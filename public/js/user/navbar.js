document.addEventListener("DOMContentLoaded", function () {

    const navbar = document.getElementById("navbar");
    const toggle = document.getElementById("navbarToggle");
    const menu = document.getElementById("navbarMenu");

    if (!toggle || !menu) {
        return;
    }


    // ==============================
    // BUKA / TUTUP MENU HP
    // ==============================

    toggle.addEventListener("click", function () {
        menu.classList.toggle("active");
        toggle.classList.toggle("active");

        const isOpen = menu.classList.contains("active");
        toggle.setAttribute("aria-expanded", isOpen);
    });


    // ==============================
    // TUTUP MENU SETELAH KLIK LINK
    // ==============================

    const menuLinks = menu.querySelectorAll("a");

    menuLinks.forEach(function (link) {
        link.addEventListener("click", function () {
            menu.classList.remove("active");
            toggle.classList.remove("active");
            toggle.setAttribute("aria-expanded", "false");
        });
    });


    // ==============================
    // TUTUP MENU KALAU KLIK DI LUAR
    // ==============================

    document.addEventListener("click", function (event) {
        if (
            !navbar.contains(event.target) &&
            menu.classList.contains("active")
        ) {
            menu.classList.remove("active");
            toggle.classList.remove("active");
            toggle.setAttribute("aria-expanded", "false");
        }
    });


    // ==============================
    // EFEK NAVBAR SAAT SCROLL
    // ==============================

    window.addEventListener("scroll", function () {

        if (window.scrollY > 20) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }

    });

});